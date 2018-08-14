<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Payables_payments extends CI_Controller {
    private $limit=10;
    private $sql="select purchase_order_number,i.terms,po_date,amount, 
            i.supplier_number,c.supplier_name,c.city,i.warehouse_code
            from purchase_order i
            left join suppliers c on c.supplier_number=i.supplier_number
            where i.potype='I'";
    private $controller='payables_payments';
    private $primary_key='no_bukti';
    private $file_view='purchase/payables_payments';
    private $table_name='payables';
    function __construct()
	{
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('form_validation','sysvar'));
        $this->load->library('template');
		$this->load->model('payables_payments_model');
   		$this->load->model('check_writer_model');
   		$this->load->model('supplier_model');                
   		$this->load->model('bank_accounts_model');
		$this->load->model('supplier_model');
		$this->load->model('purchase_order_model');
		$this->load->model('payables_model');
		$this->load->model('check_writer_model');
		$this->load->model('check_writer_items_model');
		$this->load->model('company_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('syslog_model');

		
	}
    function browse($offset=0,$limit=50,$order_column='purchase_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukri','Tgl Bayar','Faktur','Tgl Faktur','Jenis','Jumlah Faktur',
			'Jumlah Bayar','Kode Supplier','Nama Supplier','Kota','Line');
		$data['fields']=array('no_bukti','date_paid','purchase_order_number','po_date','how_paid','amount',
				'amount_paid', 'supplier_number','supplier_name','city','line_number');
		$data['field_key']='no_bukti';
		$data['caption']='DAFTAR PEMBAYARAN FAKTUR PEMBELIAN';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","no_bukti");
		$faa[]=criteria("Faktur","invoice_number");
		$faa[]=criteria("Supplier","sid_supplier");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
 		$sql="select p.no_bukti, p.date_paid,p.purchase_order_number,i.po_date,p.how_paid,
 			i.amount,p.amount_paid,i.supplier_number,c.supplier_name,c.city,p.line_number
 	 		from payables_payments p
 	 		left join purchase_order i on i.purchase_order_number=p.purchase_order_number 
 	 		left join suppliers c on c.supplier_number=i.supplier_number 
 	 		where  1=1";
    	$nama=$this->input->get('sid_supplier');
		$no_bukti=$this->input->get('no_bukti');
		$no_faktur=$this->input->get('invoice_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
 		if($no_bukti!=''){
 			$sql.=" and no_bukti='$no_bukti'";	
		} elseif($no_faktur!="") {
			$sql.=" and i.purchase_order_number='$no_faktur'";
		} else {
 	 		$sql.=" and date_paid between'$d1' and '$d2'";
			if($nama!='')$sql.=" and supplier_name like '$nama%'";	
			if($no_faktur!='')$sql.=" and purchase_order_number='$no_faktur'";	
 	 	}
		
        echo datasource($sql);
    }	 
	
   function index(){
		if(!allow_mod2('_40070'))return false;   
       $this->browse();
   }
    function _set_rules(){	
		 $this->form_validation->set_rules('no_bukti','Nomor Bukti','required');
		 $this->form_validation->set_rules('purchase_order_number','Nomor Faktur', 'required|trim');
		 $this->form_validation->set_rules('date_paid','Tanggal','required');
		 $this->form_validation->set_rules('amount_paid','Jumlah','required');
		 $this->form_validation->set_rules('how_paid','Jenis Bayar','required');
	}
	function save()
	{
   		$no_bukti=$this->nomor_bukti();

		$supplier_number=$this->input->post('supplier_number');
		$supplier_name='';
		if($supplier_number!=""){
			$supplier_name=$this->supplier_model->get_by_id($supplier_number)->row()->supplier_name;		
		}
		
		$faktur=$this->input->post("faktur");
   		$bayar=$this->input->post("bayar");
		$total_paid=0;
		
		$account=$this->input->post('how_paid_account_id');
		$bank=$this->bank_accounts_model->get_by_id($account)->row();
		$account_id=$bank->account_id;
		
		$how_paid=strtolower($this->input->post('how_paid'));
		$trtype='cash in';
		switch ($how_paid) {
			case '2':
				$trtype='trans out';
				break;
			case '1':
				$trtype='cheque out';
				//checkwriter
				$rkas['check_number']=$this->input->post('credit_card_number');
				$rkas['cleared_date']=$this->input->post('expiration_date');
				$rkas['from_bank']=$this->input->post('from_bank');
				
				//payables payments
				$data['check_number']=$this->input->post('credit_card_number');
				
				break;
			default:
				$trtype='cash out';
				break;
		}

		//-- simpan juga bukti pembayaran di module kas masuk
		$rkas['voucher']=$no_bukti;
		$rkas['check_date']=$this->input->post('date_paid');
		$rkas['deposit_amount']=0;
		$rkas['payment_amount']=$total_paid;
		$rkas['account_number']=$account;
		$rkas['trans_type']=$trtype;
		$rkas['payee']=$supplier_name;
		$rkas['supplier_number']=$supplier_number;
		$rkas['memo']="Pelunasan hutang supplier ".$supplier_name;
		$rkas['bill_payment']=1; 	
		
		$trans_id=$this->check_writer_model->save($rkas); 	 
		$this->syslog_model->add($no_bukti,"payables_payments","add");

		$default_account_id=$this->company_model->setting("accounts_payable");

		for($i=0;$i<count($bayar);$i++){
			if(intval($bayar[$i])<>0){
				$amount_paid=$bayar[$i];
				$no_faktur=$faktur[$i];

				$rfaktur=$this->purchase_order_model->get_by_id($no_faktur)->row();
				$bill_id=$this->payables_model->get_bill_id($no_faktur);

                $data['no_bukti']=$no_bukti;
                $data['date_paid']=$this->input->post('date_paid');
                $data['how_paid']=$how_paid;
                $data['amount_paid']=$amount_paid;
                $data['purchase_order_number']=$no_faktur;
				$data['how_paid_account_id']=$account_id;
				$data['bill_id']=$bill_id;
								 
                $this->payables_payments_model->save($data);
				$total_paid=$total_paid+$amount_paid;
				
				$datacw['trans_id']=$trans_id;
				$datacw['account_id']=$rfaktur->account_id;
				if($datacw['account_id']=="")$datacw['account_id']=$default_account_id;
				
				$coa=$this->chart_of_accounts_model->get_by_account_id($datacw['account_id'])->row();
				
				$datacw['account']=$coa->account;
				$datacw['description']=$coa->account_description;
				
				$datacw['amount']=$amount_paid;
				$datacw['invoice_number']=$no_faktur;
				
				
				$this->check_writer_items_model->save($datacw);

				 
				
			}	
		}
		
		$this->check_writer_model->recalc($no_bukti);
		
		 
		
		
		$this->nomor_bukti(true);
		
		redirect(base_url().'index.php/payables_payments/view/'.$no_bukti);
	}
    function add(){
    	 
        $this->load->model('bank_accounts_model');
		
        $data['mode']='add';
        $data['no_bukti']=$this->nomor_bukti();        
        $data['date_paid']=date('Y-m-d');
        $data['how_paid']='Cash';
		$data['account_list']=$this->bank_accounts_model->account_number_list();
		$data['supplier_number']='';
        $data['amount_paid']=0;
		$data['how_paid_account_id']='';
        $data['credit_card_number']="";
        $data['expiration_date']="";
        $data['from_bank']="";
		
		$this->template->display_form_input('purchase/payment_multi',$data,'');			                 
   }
	function nomor_bukti($add=false)
	{
		$key="AP Payment Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!APP~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!APP~$00001');
				$rst=$this->payables_payments_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
			
		}
	}
	
   function delete($line_number)
   {
		if(!allow_mod2('_40073'))return false;   
   		$this->payables_payments_model->delete_line($line_number);
   }
   function delete_no_bukti($no_bukti)
   {
		$no_bukti=urldecode($no_bukti);
		$this->load->model("periode_model");
		$this->load->model("check_writer_model");
		$this->syslog_model->add($no_bukti,"payables_payments","delete");


		if($q=$this->check_writer_model->get_by_id($no_bukti)){
			if($this->periode_model->closed($q->row()->check_date)){
					$message="Periode sudah ditutup tidak bisa dihapus !";
					$this->view($no_bukti,$message);
					return false;
			}
			if($q->row()->posted) {
				$message="Sudah dijurnal tidak bisa dihapus !";
				$this->view($no_bukti,$message);
				return false;
			}
		} else {
			$message="Not Found !";
			$this->view($no_bukti,$message);
			return false;
		}
   		$this->payables_payments_model->delete($no_bukti);
		$this->browse();
   }
   function list_by_invoice($invoice)
   {
		$invoice=urldecode($invoice);
		$s="
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
		<script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
		";

   		$this->load->model('payables_model');
   		$bill_id=$this->payables_model->get_bill_id($invoice);
		 
   		echo $s.browse_simple('select no_bukti,date_paid,how_paid,how_paid_account_id,
   		amount_paid,line_number,bill_id from payables_payments where bill_id='.$bill_id);
   }
        
   function view($no_bukti,$message=""){
		if(!allow_mod2('_40070'))return false;   
		$no_bukti=urldecode($no_bukti);
		$rcek=$this->check_writer_model->get_by_id($no_bukti)->row();
		 
		$data['closed']=0;
		$data['message']=$message;
		$data['posted']=false;
		$data['credit_card_number']='';
		$data['expiration_date']='';
		$data['from_bank']='';
		if($rcek){
			$data['posted']=$rcek->posted;
			$data['voucher']=$rcek->voucher;
			$data['date_paid']=$rcek->check_date;
			$data['amount_paid']=number_format($rcek->payment_amount);
			$data['account_number']=$rcek->account_number;
			$data['trans_type']=$rcek->trans_type;
			$data['supplier_number']=$rcek->supplier_number;
			$data['supplier_info']=$rcek->payee;
			$data['credit_card_number']=$rcek->check_number;
			$data['expiration_date']=$rcek->cleared_date;
			$data['from_bank']=$rcek->from_bank;
			
			
			if($data['supplier_number']=="") { //???
				$q=$this->db->query("select cwi.invoice_number,inv.supplier_number 
					from check_writer_items cwi
					left join purchase_order inv on inv.purchase_order_number=cwi.invoice_number
					where cwi.trans_id=".$rcek->trans_id." and cwi.invoice_number<>''")->row();
				if($q) {
					$data['supplier_number']=$q->supplier_number;
					$q=$this->supplier_model->get_by_id($data['supplier_number'])->row();
					if($q)$data['supplier_info']=$q->supplier_name;
					$this->db->query("update check_writer set supplier_number='".$data['supplier_number']."',
						payee='".$data['supplier_info']."'
						where voucher='".$rcek->voucher."'");
				
					 
				}
			}
			
  		
			$this->template->display_form_input('purchase/payment_multi_view',$data,'');
						
		} else {
			 
			$rcek=$this->payables_payments_model->get_by_id($no_bukti)->row();
			if($rcek){
				$rbill=$this->payables_model->get_by_id($rcek->bill_id)->row();
				$rsupplier=$this->supplier_model->get_by_id($rbill->supplier_number)->row();
				$rbank=$this->bank_accounts_model->get_by_account($rcek->how_paid_account_id)->row();
				$data['voucher']=$no_bukti;
				$data['date_paid']=$rcek->date_paid;
				$data['amount_paid']=number_format($rcek->amount_paid);
				$data['account_number']=$rbank->bank_account_number;
				$data['trans_type']=$rcek->how_paid;
				$data['supplier_number']=$rbill->supplier_number;
				$data['supplier_info']=$rsupplier->supplier_name;

				
				$this->template->display_form_input('purchase/payment_multi_view',$data,'');
			} else {
				echo 'Nomor voucher tidak ditemukan ! </br>Atau tidak terdaftar di kas masuk ! </br>Nomor Bukti: '.$no_bukti;
			}
		}
   }
    function load_nomor($voucher){
		$voucher=urldecode($voucher);
		$sql="select i.purchase_order_number,i.po_date,p.date_paid,i.amount,
		p.amount_paid from payables_payments p left join purchase_order i 
		on i.purchase_order_number=p.purchase_order_number
		where p.no_bukti='$voucher'";
        echo datasource($sql);
    }
	
	function posting($voucher) {
		if(!allow_mod2('_40075'))return false;   
		$voucher=urldecode($voucher);
		$this->load->model('check_writer_model');
		$this->check_writer_model->posting($voucher);
		$this->view($voucher);
	}
	function unposting($voucher) {
		if(!allow_mod2('_40075'))return false;   
		$voucher=urldecode($voucher);
		$this->load->model('check_writer_model');
		$this->check_writer_model->unposting($voucher);
		$this->view($voucher);
	}

      
    
}
 
?>
