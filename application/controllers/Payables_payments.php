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
        $this->load->model('purchase_invoice_model');
		
	}
    function browse($offset=0,$limit=50,$order_column='purchase_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukri','Tgl Bayar','Faktur','Tgl Faktur','Jenis','Jumlah Faktur',
			'Jumlah Bayar','Kode Supplier','Nama Supplier','Kota','Line');
		$data['fields']=array('no_bukti','date_paid','purchase_order_number','po_date','how_paid','amount',
				'amount_paid', 'supplier_number','supplier_name','city','line_number');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
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
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
 	 			
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
	    $d=$this->input->post();
        $account=$d['how_paid_account_id'];
        $set_nomor="";
        $key="";
        if($d['no_bukti']=="AUTO"){
            $no_bukti=$this->nomor_bukti();
            $rek=$d['how_paid_account_id'];
            if($qrek=$this->bank_accounts_model->get_by_id($rek)){
                if($rrek=$qrek->row()){
                    $set_nomor=$rrek->no_bukti_out;    
                    $account_id=$rrek->account_id;
                    if($set_nomor!=""){
                        $key="Acc Out $rek Numbering";
                        $no_bukti=$this->sysvar->autonumber($key);
                   }
                }
            }             
        }
        if($no_bukti==""){
            $no_bukti=$this->nomor_bukti();
            $key="";
        }

        if($key==""){
            $this->nomor_bukti(true);
        } else {
            $this->sysvar->autonumber_inc($key);
        }
        

		$supplier_number=$d['supplier_number'];
		$supplier_name='';
		if($supplier_number!=""){
			if($supplier_nameq=$this->supplier_model->get_by_id($supplier_number)){
			   if($supplier_namer=$supplier_nameq->row()){
			     $supplier_name=$supplier_namer->supplier_name;   
			   }   
			}		
		}
		
		$faktur=$d["faktur"];
   		$bayar=$d["bayar"];
		$total_paid=$d['amount_paid'];
		
		$how_paid=strtolower($d['how_paid']);
		$trtype='cash in';
		switch ($how_paid) {
			case '2':
				$trtype='trans out';
				break;
			case '1':
				$trtype='cheque out';
				//checkwriter
				$rkas['check_number']=$d['credit_card_number'];
				$rkas['cleared_date']=$d['expiration_date'];
				$rkas['from_bank']=$d['from_bank'];
				
				//payables payments
				$data['check_number']=$d['credit_card_number'];
				
				break;
			default:
				$trtype='cash out';
				break;
		}

		//-- simpan juga bukti pembayaran di module kas masuk
		$rkas['voucher']=$no_bukti;
		$rkas['check_date']=$d['date_paid'];
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
                $amount_paid=c_($amount_paid);
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
		
		redirect(base_url().'index.php/payables_payments/view/'.$no_bukti);
	}
    function add(){
    	 
        $this->load->model('bank_accounts_model');
		
        $data['mode']='add';
        $data['no_bukti']="AUTO";   //$this->nomor_bukti();        
        $data['date_paid']=date('Y-m-d H:i:s');
        $data['how_paid']='Cash';
		$data['account_list']=$this->bank_accounts_model->account_number_list();
		$data['supplier_number']='';
        $data['amount_paid']=0;
		$data['how_paid_account_id']='';
        $data['credit_card_number']="";
        $data['expiration_date']="";
        $data['from_bank']="";
        $data['ref1']="";
        $data['lookup_rekening']=$this->list_of_values->render(
            array("dlgBindId"=>"bank_accounts",
            "dlgRetFunc"=>"$('#how_paid_account_id').val(row.bank_account_number);",
            "dlgCols"=>array(array("fieldname"=>"bank_account_number","caption"=>"Rekening","width"=>"100px"),
            array("fieldname"=>"bank_name","caption"=>"Nama Bank","width"=>"250px"),
            array("fieldname"=>"org_id","caption"=>"Company","width"=>"80px"))));
            
		$data['lookup_kontra_bon']=$this->list_of_values->render(
            array("dlgBindId"=>"payables_bill_header",
            "dlgRetFunc"=>"selected_bon(row.nomor);",
            "dlgCols"=>array(
                array("fieldname"=>"nomor","caption"=>"Nomor Kontra Bon","width"=>"100px"),
                array("fieldname"=>"tanggal","caption"=>"Supplier","width"=>"90px"),
                array("fieldname"=>"supplier_number","caption"=>"Supplier","width"=>"80px"),
                array("fieldname"=>"termin","caption"=>"Termin","width"=>"80px"),
                array("fieldname"=>"tgl_jth_tempo","caption"=>"Jth Tempo","width"=>"80px"),
                array("fieldname"=>"catatan","caption"=>"Catatan","width"=>"100px"),
                    
                )
            )        
        );
        $setsupp['dlgRetFunc']="
        $('#supplier_number').val(row.supplier_number);
        $('#supplier_name').html(row.supplier_name);
        select_invoice();
        ";

        $data['lookup_suppliers']=$this->supplier_model->lookup($setsupp);
        
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
   function delete_no_bukti($no_bukti='',$line_number='')
   {
       if($no_bukti==""){
           $this->db->query("delete from payables_payments where no_bukti=''");
           $this->db->query("delete from check_writer where voucher=''");
            $this->browse();
            return false;
       }
		$no_bukti=urldecode($no_bukti);
		$line_number=urldecode($line_number);
		if(  $line_number!=""){
			$this->db->query("delete from payables_payments where line_number='$line_number'");
		}
        
		$this->load->model("periode_model");
		$this->load->model("check_writer_model");
		$this->syslog_model->add($no_bukti,"payables_payments","delete");


		if($q=$this->check_writer_model->get_by_id($no_bukti)){
		    if($row_cwm=$q->row()){
		        $date_cwm=$row_cwm->check_date;   
                $posted=$row_cwm->posted;
		    } else {
		        $date_cwm=date("Y-m-d");
                $posted=false;
		    }
			if($this->periode_model->closed($date_cwm)){
					$message="Periode sudah ditutup tidak bisa dihapus !";
					$this->view($no_bukti,$message);
					return false;
			}
			if($posted) {
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
				if($rbank){
				    $bank_account_number=$rbank->bank_account_number;
				} else {
				    $bank_account_number="KAS BESAR";
				}
				$data['voucher']=$no_bukti;
				$data['date_paid']=$rcek->date_paid;
				$data['amount_paid']=number_format($rcek->amount_paid);
				$data['account_number']=$bank_account_number;
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
    function selected_kontra_bon($nomor){
        $nomor=urldecode($nomor);
        $success=false;
        $supplier_number="";
        $how_paid_account_id="";
        $amount_paid=0;
        $voucher="AUTO";
        $msg="Unknown Error";
        if($qpbh=$this->db->where("nomor",$nomor)->get("payables_bill_header")){
            if($rpbh=$qpbh->row()){
                $supplier_number=$rpbh->supplier_number;
                $success=true;
                $msg="Success";
                $sql="select p.faktur,i.supplier_number,p.tanggal,p.saldo,i.rekening 
                from payables_bill_detail p left join purchase_order i 
                on p.faktur=i.purchase_order_number 
                where p.nomor='$nomor'";
                if($qpbhd=$this->db->query($sql)){
                    foreach($qpbhd->result() as $rpbhd){
                        $amount_paid+=$rpbhd->saldo;
                        if($supplier_number=="")$supplier_number=$rpbhd->supplier_number;
                        if($how_paid_account_id=="")$how_paid_account_id=$rpbhd->rekening;
                   }
                }
            } 
        }
        $data["success"]=$success;
        $data["supplier_number"]=$supplier_number;
        $data["how_paid_account_id"]=$how_paid_account_id;
        $data["amount_paid"]=$amount_paid;
        $data["voucher"]=$voucher;
        $data["msg"]=$msg;
        
        echo json_encode($data);        
    }
    function kontra_bon($nomor_bon){
        $nomor_bon=urldecode($nomor_bon);
        $sql="select p.purchase_order_number,p.po_date,p.due_date,p.amount,p.terms 
        from purchase_order p left join payables_bill_detail i 
        on p.purchase_order_number=i.faktur
        where p.potype='I' and (p.paid=false or isnull(p.paid))
        and i.nomor='$nomor_bon'";
 
        $query=$this->db->query($sql);
        $i=0;
        $rows[0]='';
        if($query){ 
            foreach($query->result_array() as $row){
                $nomor=$row['purchase_order_number'];
                $saldo=$this->purchase_invoice_model->recalc($nomor);
                if($saldo!=0){
                    $row['amount']=number_format($row['amount']);
                    $row['saldo']=number_format($saldo);
                    $row['bayar']=form_input("bayar[]",number_format($saldo),"style='width:100px;color:black;text-align:right'");
                    $row['purchase_order_number']=$nomor.form_hidden("faktur[]",$nomor);
                    $rows[$i++]=$row;
                }
            };
        }
        $data['total']=$i;
        $data['rows']=$rows;

        echo json_encode($data);        
    }
      
    
}
 
?>
