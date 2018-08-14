<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Approve extends CI_Controller {
    private $limit=100;
    private $table_name='ls_app_master';
    private $file_view='leasing/approve';
    private $controller='leasing/approve';
    private $primary_key='id';
	private $title="DAFTAR APLIKASI";
    private $sql="";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->sql=="")$this->sql="select * from ls_app_verify";
		if($this->help=="")$this->help=$this->table_name;
		$this->load->model("leasing/approve_model");
    }
    function set_defaults($record=NULL,$table_name=""){
		$data['mode']='';
		$data['message']='';
		if($table_name=="")$table_name=$this->table_name;
		$data=data_table($table_name,$record);
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
		$data['data']=$data;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$this->load->model("leasing/app_master_model");
		$data['not_approved_list']=$this->app_master_model->not_approved(false);		
		$this->template->display_form_input($this->file_view,$data);			
    }
	function save(){
		$data=$this->input->post();		
		$ok=$this->approve_model->save($data);
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
		$model=$this->survey_model->get_by_id($id)->row();
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
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nomor Aplikasi","sid_no","","style='width:400px'");
		$faa[]=criteria("Nama Debitur","sid_nama","","style='width:400px'");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Nama Debitur','Nomor Aplikasi','Tanggal','Sales Agent','Id');
		$data['fields']=array('cust_name','app_id','app_date','sales_agent','id');
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get("sid_no"))$sql .= " and cust_id='".$this->input->get("sid_no")."'";
		if($this->input->get("sid_nama"))$sql .= " and cust_name like '%".$this->input->get("sid_nama")."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->scoring_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function filter($id=""){
		$sql="select * from ".$this->table_name;
		if($id!=""){
			$sql.=" where cust_name like '%".$id."%'";
		}
		echo datasource($sql);	
	}
	function view_spk($app_id){
		$data['app_id']=$app_id;
		if($q=$this->db->where("app_id",$app_id)->get("ls_app_master")){
			$app=$q->row();
		}

		$this->load->model("leasing/cust_master_model");
		
		$model=$this->cust_master_model->get_by_id($app->cust_id)->row();
		$data=$this->set_defaults($model,"ls_cust_master");

		// field cust_master yg sama dengan company
		$field_sama['street']=$data['street'];
		$field_sama['city']=$data['city'];
		$field_sama['kel']=$data['kel'];
		$field_sama['kec']=$data['kec'];
		$field_sama['rtrw']=$data['rtrw'];
		$field_sama['zip_pos']=$data['zip_pos'];

		$data=array_merge($data,$this->cust_master_model->personal(),
				$this->cust_master_model->company());
		// benerin field_sama
		$data['com_street']=$data['street'];
		$data['com_city']=$data['city'];
		$data['com_kel']=$data['kel'];
		$data['com_kec']=$data['kec'];
		$data['com_rtrw']=$data['rtrw'];
		$data['com_zip_pos']=$data['zip_pos'];
		$data['com_contact_phone']=$data['contact_phone'];
		// kembalikan
		$data['street']=$field_sama['street'];
		$data['city']=$field_sama['city'];
		$data['kel']=$field_sama['kel'];
		$data['kec']=$field_sama['kec'];
		$data['rtrw']=$field_sama['rtrw'];
		$data['zip_pos']=$field_sama['zip_pos'];
		$data['mode']='view';
		$data['app']=$app;
		$data['app_id']=$app_id;
		$data['username']=user_name();
		$this->template->display("leasing/approve_form",$data);
	}
}
?>
