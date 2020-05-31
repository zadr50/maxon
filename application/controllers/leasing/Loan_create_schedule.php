<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Loan_create_schedule extends CI_Controller {
	private $title="JADWAL PEMBUATAN KONTRAK";
    private $sql="";
	private $help="contract_schedule";
	private $file_view="leasing/contract_schedule";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		$this->load->model("leasing/loan_master_model");
    }
    function set_defaults($record=NULL,$table_name=""){
		$data['mode']='';
		$data['message']='';
		return $data;
    }
    function index(){
		$this->add();
    }
	function admin(){
		$this->add_with_admin();
	}
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$data['mode']='add';
		$data['message']='';
		$data['data']=$data;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['new_contract_list']=$this->loan_master_model->new_contract_list();		
		$this->template->display_form_input($this->file_view,$data);			
    }
	function save(){
		$data=$this->input->post();	
		$ok=$this->loan_master_model->save_schedule($data);
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}	
    function add_with_admin()   {
		$data=$this->set_defaults();
		$data['mode']='add';
		$data['message']='';
		$data['data']=$data;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['new_contract_list']=$this->loan_master_model->new_contract_list(true);		
		$this->template->display_form_input('leasing/contract_schedule_admin',$data);			
    }
	function save_admin(){
		$data=$this->input->post();	
		//var_dump($data);
		$ok=$this->loan_master_model->process_schedule($data);
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}	

}
?>
