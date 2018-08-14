<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Payment extends CI_Controller {

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
	private $controller="payment";
	private $primary_key="no_bukti";
    function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select'));
		$this->load->library(array('form_validation','sysvar','template'));
		$this->load->model('payment_model');
		$this->load->model('syslog_model');
                
	}
   function index(){
		if (!allow_mod2('_30110'))  exit;
   		$this->browse();       
   }
   	function search(){$this->browse();}
   		
    function _set_rules(){	
		 $this->form_validation->set_rules('no_bukti','Nomor Bukti','required');
		 $this->form_validation->set_rules('invoice_number','Nomor Faktur', 'required|trim');
		 $this->form_validation->set_rules('date_paid','Tanggal','required');
		 $this->form_validation->set_rules('amount_paid','Jumlah','required');
		 $this->form_validation->set_rules('how_paid','Jenis Bayar','required');
	}
	function nomor_bukti($add=false){
		$key="AR Payment Numbering";
		if($add){
			$this->sysvar->autonumber_inc($key);
		} else {
			$no=$this->sysvar->autonumber($key,0,'!ARP~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!ARP~$00001');
				$rst=$this->payment_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
			
		}
	}
	function add(){
		if (!allow_mod2('_30110'))  exit;
		$this->add_multi();
	}
    function save_invoice(){
        $faktur=$this->input->post('invoice_number');
		if(!$faktur){
			echo "Invalid Invoice Number !";
		} else {
            $this->_set_rules();
            $data['no_bukti']=$this->input->post('no_bukti');
            $data['date_paid']=$this->input->post('date_paid');
            $data['how_paid']=$this->input->post('how_paid');
            $data['amount_paid']=$this->input->post('amount_paid');
            $data['invoice_number']=$this->input->post('invoice_number');
            if ($this->form_validation->run()=== TRUE){
             	$data['no_bukti']=$this->nomor_bukti();               
                $this->payment_model->save($data);
                $this->nomor_bukti(true);
				$this->syslog_model->add($faktur,"payment","add");

                echo '<h3>Success.</h3>';
             } else {
                echo validation_errors();
             }
       }  
   }
	function add_invoice(){
		$faktur=$this->input->get('invoice_number');
		if(!$faktur){
			echo "Please select invoice !";
		} else {
            $data['no_bukti']=$this->nomor_bukti();
            $this->load->model('invoice_model');
            $saldo=$this->invoice_model->recalc($faktur);
            $data['date_paid']=date('Y-m-d');
            $data['how_paid']='Cash';
            $data['amount_paid']=$saldo;
            $data['invoice_number']=$faktur;
            $data['mode']='add';
            $data['saldo']=$saldo;
			$this->load->view('sales/payment',$data);
		}
	}
   function add_multi() {
   		//-- pembayaran dengan banyak faktur
   		//-- step 1 pilih kode pelanggan
   		$this->load->model('customer_model');
		$this->load->model('bank_accounts_model');
   		$data['no_bukti']=$this->nomor_bukti();
		$data['date_paid']=date('Y-m-d');
		$data['how_paid']='Cash';
		$data['amount_paid']=0;
		$data['mode']='add';
		$data['customer_number']='';
		$data['how_paid_acct_id']='';
		$data['how_paid']='';
		$data['customer_list']=$this->customer_model->customer_list();
		$data['account_list']=$this->bank_accounts_model->account_number_list();
		$data['credit_card_number']='';
		$data['expiration_date']=date('Y-m-d');
		$data['from_bank']='';
		$this->template->display_form_input('sales/payment_multi',$data,'');			
		
   }
   function add_multi_save(){
    
    }
   function view($no_bukti,$message=""){
		if (!allow_mod2('_30110'))  exit;
		$no_bukti=urldecode($no_bukti);
		$this->load->model('customer_model');
   		$this->load->model('check_writer_model');
		$cek=$this->check_writer_model->get_by_id($no_bukti);
		$data['closed']=0;
		$data['message']=$message;
		$rcek=$cek->row();
		if($rcek){
			$data['posted']=$rcek->posted;
			$data['voucher']=$rcek->voucher;
			$data['date_paid']=$rcek->check_date;
			$data['amount_paid']=$rcek->deposit_amount;
			$data['account_number']=$rcek->account_number;
			$data['trans_type']=$rcek->trans_type;
			//$data['cust_info']=$rcek->supplier_number.' - '.$rcek->payee;
			$data['cust_info']=$this->customer_model->info($rcek->supplier_number);
			$data['credit_card_number']=$rcek->check_number;
			$data['expiration_date']=$rcek->cleared_date;
			$data['from_bank']=$rcek->from_bank;
			$this->template->display_form_input('sales/payment_multi_view',$data,'');
						
		} else {
			echo 'Nomor voucher tidak ditemukan ! </br>Atau tidak terdaftar di kas masuk ! </br>Nomor Bukti: '.$no_bukti;
		}
   }
   function add_payment(){
		$this->load->model('payment_model');		
   		$this->load->model('bank_accounts_model');
		$this->load->model('customer_model');
		$this->load->model('invoice_model');
		$this->load->model('check_writer_items_model');
		$this->load->model('company_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('check_writer_model');

		$total_paid=$this->input->post('amount_paid');
   		$no_bukti=$this->nomor_bukti();
		$how_paid=strtolower($this->input->post('how_paid'));
		$invoice_no=$this->input->post("invoice_number");
		$date_paid=$this->input->post('date_paid');	
		$invoice=$this->db->select("sold_to_customer,account_id")->where("invoice_number",$invoice_no)
			->get("invoice")->row();
		$cust=$invoice->sold_to_customer;
		$coa_ar_invoice=$invoice->account_id;
		$cust_name=$this->customer_model->get_by_id($cust)->row()->company;		
		$coa_ar=getvar("accounts_receivable");

        $id=$this->input->post("line_number_pay");

		$trtype='cash in';
		$account=getvar('default_cash_payment_account');
		
		switch ($how_paid) {
			case '2':
				$trtype='trans in';
				$account=getvar('default_bank_account_number');
				break;
			case '1':
				$trtype='cheque in';
				$account=getvar('default_bank_account_number');
				break;
			default:
				$trtype='cash in';
				break;
		}
		$account_id=$account;
			 
		if($bank=$this->bank_accounts_model->get_by_account($account_id)){
			 
			if($rbank=$bank->row()) {
				$account=$rbank->bank_account_number;
			}
		}
		 

		$rkas['voucher']=$no_bukti;
		$rkas['check_date']=$date_paid;
		$rkas['deposit_amount']=$total_paid;
		$rkas['payment_amount']=0;
		$rkas['account_number']=$account;
		$rkas['trans_type']=$trtype;
		$rkas['payee']=$cust_name;
		$rkas['supplier_number']=$cust;
		$rkas['memo']="Pelunasan piutang pelangan ".$cust_name;

		$trans_id=$this->check_writer_model->save($rkas); 	 

		$datacw['trans_id']=$trans_id;
		$datacw['account_id']=$coa_ar_invoice;
		if($datacw['account_id']=="")$datacw['account_id']=$coa_ar;
		
		$coa=$this->chart_of_accounts_model->get_by_account_id($datacw['account_id'])->row();
		
		$datacw['account']=$coa->account;
		$datacw['description']=$coa->account_description;
		
		$datacw['amount']=$total_paid;
		$datacw['invoice_number']=$invoice_no;
		
		
		$this->check_writer_items_model->save($datacw);
		
        $data['no_bukti']=$no_bukti;
        $data['date_paid']=$date_paid;
        $data['how_paid']=$trtype;
        $data['amount_paid']=$total_paid;
        $data['invoice_number']=$invoice_no;


        if($id=="0" or $id==""){
			$ok=$this->payment_model->save($data);
			$this->nomor_bukti(true);        	
			$this->syslog_model->add($id,"payment","add");

        } else {
        	$ok=$this->payment_model->update_id($id,$data);
			$this->syslog_model->add($id,"payment","edit");

        }
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
   }
   function save(){
   		 
   		$this->load->model('bank_accounts_model');
		$this->load->model('customer_model');
		$this->load->model('invoice_model');
		$this->load->model('check_writer_items_model');
		$this->load->model('company_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('check_writer_model');
		 
		$faktur=$this->input->post("faktur");
   		$no_bukti=$this->nomor_bukti();
   		$bayar=$this->input->post("bayar");
		$total_paid=$this->input->post('amount_paid');
		$account=$this->input->post('how_paid_acct_id');
		$bank=$this->bank_accounts_model->get_by_id($account)->row();
		$account_id=$bank->account_id;
		$how_paid=strtolower($this->input->post('how_paid'));
		$trtype='cash in';
		
		switch ($how_paid) {
			case '2':
				$trtype='trans in';
				break;
			case '1':
				$trtype='cheque in';
				//check witer
				$rkas['check_number']=$this->input->post('credit_card_number');
				$rkas['cleared_date']=$this->input->post('expiration_date');
				$rkas['from_bank']=$this->input->post('from_bank');
				//payments
				$data['credit_card_number']=$this->input->post('credit_card_number');
				$data['expiration_date']=$this->input->post('expiration_date');
				$data['from_bank']=$this->input->post('from_bank');
				break;
			default:
				$trtype='cash in';
				break;
		}
		$cust=$this->input->post('customer_number');
		$cust_name=$this->customer_model->get_by_id($cust)->row()->company;		
		//-- simpan juga bukti pembayaran di module kas masuk
		$rkas['voucher']=$no_bukti;
		$rkas['check_date']=$this->input->post('date_paid');
		$rkas['deposit_amount']=$total_paid;
		$rkas['payment_amount']=0;
		$rkas['account_number']=$account;
		$rkas['trans_type']=$trtype;
		$rkas['payee']=$cust_name;
		$rkas['supplier_number']=$cust;
		$rkas['memo']="Pelunasan piutang pelangan ".$cust_name;

		$trans_id=$this->check_writer_model->save($rkas); 	 
		$this->syslog_model->add($no_bukti,"payment","add");

		$default_account_id=$this->company_model->setting("accounts_receivable");

		for($i=0;$i<count($bayar);$i++){
			if(intval($bayar[$i])<>0){
				$amount_paid=$bayar[$i];
				$no_faktur=$faktur[$i];
				$rfaktur=$this->invoice_model->get_by_id($no_faktur)->row();
				if($cust==""){
					$rcust=$this->customer_model->get_by_id($rfaktur->sold_to_customer)->row();		
					$cust=$rcust->customer_number;
					$cust_name=$rcust->company;
				}
                $data['no_bukti']=$no_bukti;
                $data['date_paid']=$this->input->post('date_paid');
                $data['how_paid']=$how_paid;
                $data['amount_paid']=$amount_paid;
                $data['invoice_number']=$no_faktur;
				$data['how_paid_acct_id']=$account_id;
				 
                $this->payment_model->save($data);
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

				//echo mysql_error();

			}	
		}

		$this->check_writer_model->recalc($no_bukti,'deposit_amount');
		//echo mysql_error();	
		$this->nomor_bukti(true);
		redirect('payment/view/'.$no_bukti);
   }
    function browse($offset=0,$limit=50,$order_column='no_bukti',$order_type='asc'){
        $data['caption']='DAFTAR PEMBAYARAN';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Tgl Bayar','Faktur','Voucher','Jumlah','Cara Bayar','Nama Customer');
		$data['fields']=array('date_paid','invoice_number','no_bukti','amount_paid','how_paid','company');
		$data['field_key']='no_bukti';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Faktur","sid_invoice_number");
		$faa[]=criteria("Voucher","sid_no_bukti");
		$faa[]=criteria("Pelanggan","sid_cust");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
 		$sql="select p.date_paid,p.invoice_number,p.no_bukti,p.how_paid,
 			p.amount_paid,i.sold_to_customer,c.company
 	 		from payments p
 	 		left join invoice i on i.invoice_number=p.invoice_number 
 	 		left join customers c on c.customer_number=i.sold_to_customer 
 	 		where  1=1";
    	$nama=$this->input->get('sid_cust');
		$no_bukti=$this->input->get('no_bukti');
		$no_faktur=$this->input->get('invoice_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
 		if($no_bukti!=''){
 			$sql.=" and how_paid='$no_bukti'";	
		} else {
 	 		$sql.=" and date_paid between'$d1' and '$d2'";
			if($nama!='')$sql.=" and company like '$nama%'";	
			if($no_faktur!='')$sql.=" and invoice_number='$no_faktur'";	
 	 	}
        echo datasource($sql);
    }	 
	function delete($id){
		if (!allow_mod2('_30113'))  exit;
		$id=urldecode($id);
		$this->load->model('check_writer_model');
		$this->check_writer_model->delete($id);
		$this->load->model('payment_model');
		$this->payment_model->delete($id);
		$this->syslog_model->add($id,"payment","delete");

		$this->browse();
	}
	function data($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select p.no_bukti,p.date_paid,p.how_paid 
		,p.amount_paid,p.line_number
		from payments p
		where invoice_number='$nomor'";
		echo datasource($sql);
	}
    function delete_payment($id=0){
		$id=urldecode($id);
    	if($id==0)$id=$this->input->post('line_number');
        $this->load->model('payment_model');
        if($this->payment_model->delete_id($id)) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
		$this->syslog_model->add($id,"payment","delete");

    }        
   function delete_no_bukti($no_bukti)
   {
		$no_bukti=urldecode($no_bukti);
		$this->load->model("periode_model");
		$this->load->model("check_writer_model");

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
   		$this->payment_model->delete($no_bukti);
		$this->browse();
   }
    function load_nomor($voucher){
		$voucher=urldecode($voucher);
		$sql="select i.invoice_number,i.invoice_date,p.date_paid,i.amount,
		p.amount_paid from payments p left join invoice i on i.invoice_number=p.invoice_number
		where p.no_bukti='$voucher'";
        echo datasource($sql);
    }

	function posting($voucher) {
		if (!allow_mod2('_30115'))  exit;
		$voucher=urldecode($voucher);
		$this->load->model('check_writer_model');
		$this->check_writer_model->posting($voucher);
		$this->view($voucher);
	}
	function unposting($voucher) {
		if (!allow_mod2('_30115'))  exit;
		$voucher=urldecode($voucher);
		$this->load->model('check_writer_model');
		$this->check_writer_model->unposting($voucher);
		$this->view($voucher);
	}
    
}
 
?>
