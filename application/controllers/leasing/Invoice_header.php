<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Invoice_header extends CI_Controller {
    private $limit=100;
    private $table_name='ls_invoice_header';
    private $file_view='leasing/invoice_header';
    private $controller='leasing/invoice_header';
    private $primary_key='invoice_no';
    private $sql="";
	private $title="DAFTAR invoice_header";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		if($this->help=="")$this->help=$this->table_name;
		
		$this->load->model('leasing/invoice_header_model');
		$this->load->model('leasing/payment_model');
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index(){
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
				$data=$this->get_posts();
				$this->loan_master_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
				$data['mode']='add';
				$data['message']='';
				$data['data']=$data;
				$data['title']=$this->title;
				$data['help']=$this->help;
				$data['form_controller']=$this->controller;
				$data['field_key']=$this->primary_key;
				$data['sales_name']='';
				$data['sales_id']='';
				
				$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("invoice_no");
		if( !$id ) $id=$this->input->post('invoice_number');
		$mode=$data["mode"];	unset($data['mode']);
		
		if($mode=="add"){ 			
			$ok=$this->invoice_header_model->save($data);
		} else {
			//$data['invoice_date']=$this->input->post('invoice_date');
			//$data['date_paid']=$data['invoice_date'];
//			var_dump($data);
			unset($data['cust_name']);
			if(isset($data['date_paid']))$data['date_paid']=date('Y-m-d',strtotime($data['date_paid']));
			if(isset($data['amount']))$data['amount']=str_replace(",","",$data['amount']);
			if(isset($data['pokok']))$data['pokok']=str_replace(",","",$data['pokok']);
			if(isset($data['bunga']))$data['bunga']=str_replace(",","",$data['bunga']);
			if(isset($data['amount_paid']))$data['amount_paid']=str_replace(",","",$data['amount_paid']);
			if(isset($data['admin_amount']))$data['admin_amount']=str_replace(",","",$data['admin_amount']);
			if(isset($data['pokok_paid']))$data['pokok_paid']=str_replace(",","",$data['pokok_paid']);
			if(isset($data['bunga_paid']))$data['bunga_paid']=str_replace(",","",$data['bunga_paid']);
			if(isset($data['denda']))$data['denda']=str_replace(",","",$data['denda']);
			if(isset($data['bunga_finalty']))$data['bunga_finalty']=str_replace(",","",$data['bunga_finalty']);

			$ok=$this->invoice_header_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error atau loan_id sudah ada."));
		}
	}	
	function edit($id){
		$id=urldecode($id);
		$this->view($id,"edit");
	}
    function view($id,$mode="view",$show_tool=true){
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->invoice_header_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$cst_name="";
		if($data['cust_deal_id']!=""){
			$cst=$this->db->select("cust_name")->where("cust_id",$model->cust_deal_id)->get("ls_cust_master");
			if($cst){
				$cst_name=$cst->row()->cust_name;
			}
		}
		$data['cust_name']=$cst_name;
		$data['mode']=$mode;
		$data['message']="View Invoice";
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		//$data['only_posting']=true;
		$this->template->display_form_input($this->file_view,$data);
    }
     // validation rules
    function _set_rules(){}
    function valid_date($str){
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str)){
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']=$this->controller;
		$data['fields']=array("cust_name","invoice_date","invoice_number","amount","paid","date_paid","voucher","cust_deal_id");
		$data['fields_caption']=array("Pelanggan","Tanggal","Nomor invoice_header","Jumlah");
		$data['fields_format_numeric']=array("amount");
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Pelanggan","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$s="select c.cust_name,i.invoice_date,i.invoice_number,i.amount
		from ls_invoice_header i 
		left join ls_cust_master c on c.cust_id=i.cust_deal_id ";
        $s .= ' where 1=1';
		if($this->input->get("sid_nama"))$s .= " and c.cust_name like '%".$this->input->get("sid_nama")."%'";
		$s.=" order by invoice_date";
        echo datasource($s);
    }	   
	function delete($id){
		$id=urldecode($id);
		echo "canot delete !";
//	 	$this->loan_master_model->delete($id);
		$this->browse();
	}
	function find($nomor){ 
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where invoice_no='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function delete_payment($id){
		$id=urldecode($id);
		$invoice_number=$this->db->select('invoice_number')
			->where('id',$id)->get('ls_invoice_payments')->row()->invoice_number;			
		if($id!=""){
			$this->payment_model->delete($id);
		}
		$this->view($invoice_number);
	}
	function add_payment($faktur){
		$faktur=urldecode($faktur);
		$data['date_paid']=$this->input->post('date_paid');
		$data['date_paid']=date("Y-m-d",strtotime($data['date_paid']));
		$data['paid']=1;
		$data['payment_method']=$this->input->post('how_paid');
		$data['amount_paid']=$this->input->post('amount_paid');
		$data['voucher']="P".$faktur;
		$data['denda']=$this->input->post("denda");
		$data['bunga_paid']=$this->input->post("bunga");
		$data['pokok_paid']=$this->input->post("pokok");
		
		$ok=$this->db->where('invoice_number',$faktur)->update("ls_invoice_header",$data);
		if($ok){
			//update ls_loan_master
			if($query=$this->db->where("invoice_number",$faktur)->get("ls_invoice_header")){
				$loan=$query->row();
				$loan1['last_idx_month']=$loan->idx_month;
				$loan1['last_date_paid']=$data['date_paid'];
				$loan1['last_amount_paid']=$data['amount_paid'];
				$this->db->where("loan_id",$loan->loan_id)->update("ls_loan_master",$loan1);
				$this->db->query("update ls_loan_master set total_amount_paid=
					(select sum(pokok_paid+bunga_paid)  as z_amt 
					from ls_invoice_header where loan_id='".$loan->loan_id."') 
					where loan_id='".$loan->loan_id."'");
				$this->db->query("update ls_loan_master set ar_bal_amount=loan_amount-total_amount_paid 
				where loan_id='".$loan->loan_id."'");
				
			}
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}		
		
	}
	function unposting($invoice_no) {
		$message=$this->invoice_header_model->unposting($invoice_no);
		$this->view($invoice_no,$message);
	}
	function posting($invoice_no) {
		$message=$this->invoice_header_model->posting($invoice_no);
		$this->view($invoice_no,$message);
	}
	function recalc_balance_view($faktur,$update_denda=false){
		$this->recalc_balance($faktur,$update_denda);
		$this->view($faktur);
	}
	function recalc_balance($faktur,$update_denda=false){
		$faktur=urldecode($faktur);
		 $this->invoice_header_model->recalc_hari_telat($faktur);
		 $this->invoice_header_model->recalc_saldo($faktur);
		$success=true;
		$data=$this->payment_model->summary($faktur);
		 
		$saldo_titip=$this->invoice_header_model->saldo_titip($faktur);
		$data_return=array("success"=>$success,"data"=>$data,"saldo_titip"=>$saldo_titip);
		echo json_encode($data_return);
		
	}
	 
	function get_payment_json($faktur){
		$faktur=urldecode($faktur);
		$success=true;
		$data=$this->payment_model->summary($faktur);		
		$data['saldo_titip']=$this->invoice_header_model->saldo_titip($faktur);
		$data_return=array("success"=>$success,"data"=>$data);
		echo json_encode($data_return);
	}
	
}
?>
