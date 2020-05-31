<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Kolektor extends CI_Controller {
    private $limit=100;
    private $table_name='ls_invoice_header';
    private $file_view='leasing/kolektor';
    private $controller='leasing/kolektor';
    private $primary_key='invoice_number';
    private $sql="";
	private $title="DAFTAR TAGIHAN ANGSURAN TELAT";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		if($this->help=="")$this->help=$this->table_name;
		
		$this->load->model('leasing/loan_master_model');
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index(){
		$this->add();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$data['message']='';
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$this->load->model('leasing/invoice_header_model');
		$data['faktur_telat']=$this->invoice_header_model->list_not_paid_today();
		$kolektor_list=array(""=>"- Pilih -");
			if($qs=$this->db->query("select user_id,username from user order by username")){
				foreach($qs->result() as $surv){
					$kolektor_list[$surv->user_id]=$surv->username;
				}
			}
		$data['kolektor_list']=$kolektor_list;
		$this->template->display_form_input($this->file_view,$data);			
    }
	function save(){
		$faktur=$this->input->post("faktur");
		$faktur_list=$this->input->post("faktur_list");
		$tanggal=$this->input->post("tanggal");
		$kolektor=$this->input->post("kolektor");
		//var_dump($faktur);
		for($i=0;$i<count($faktur_list);$i++){
			$found=false;
			$data['user_col']='';
			for($j=0;$j<count($faktur);$j++){
				if($faktur[$j]==$faktur_list[$i]){
					$found=true;
					$data['user_col']=$kolektor[$i];
					break;
				}
			}
			if($found){
				$data['invoice_no']=$faktur_list[$i];
				$data['sch_date']=date("Y-m-d",strtotime($tanggal[$i]));
				$ok=$this->db->insert("ls_loan_col_sched",$data);
			}
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
 	}	
    function view($id,$message=null)	{
		$id=urldecode($id);
		$message=urldecode($message);
		$data[$this->primary_key]=$id;
		$model=$this->loan_master_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['message']=$message;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		 
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
		$data['fields']=array("loan_id","app_id","loan_date","loan_amount","max_mount","status","cust_id");
		$data['fields_caption']=array("Kode","AppId","Tanggal","Jumlah","Tenor","Status","Pelanggan");
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Pelanggan","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get("sid_nama"))$sql .= " and description like '%".$this->input->get("sid_nama")."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->loan_master_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where loan_id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function proses_tagih(){
		$data["visit_date"]=date("Y-m-d H:i:s",strtotime($this->input->post("visit_date")));
		$data["visit_notes"]=$this->input->post("visit_notes");
		$data["collected"]=$this->input->post("tertagih");
		$data['amount_col']=$this->input->post("tertagih_jumlah");
		$promise_date=date("Y-m-d H:i:s",strtotime($this->input->post("janji_tanggal")));
		$data['promise_date']=$promise_date;
		$faktur=$this->input->post("invoice_no");
		$data['visit_ke']=$this->input->post("visit_ke");
		$data['visited']=1;
		$ok=$this->db->where("invoice_no",$faktur)->update("ls_loan_col_sched",$data);

		//update ke visit_count billing
		$cnt=$this->db->query("select count(1) as cnt from ls_loan_col_sched 
			where invoice_no='".$faktur."'")->row()->cnt;
		$this->db->where("invoice_number",$faktur)->update("ls_invoice_header",
				array("visit_count"=>$cnt));


		if($ok){
			$message="Belum tertagih invoice $faktur janji bayar tanggal $promise_date";
			$from=user_id();
			$to_user="AdmLs";
			inbox_send($from,$to_user,$faktur." - belum tertagih",$message);		
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Tidak bisa simpan !"));
		}
	}
}
?>
