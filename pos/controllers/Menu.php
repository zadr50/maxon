<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Menu extends CI_Controller {
   
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper','path_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
             
	}
	function index(){
    }
	function load($m){

		$this->load->model('company_model');
		$company=$this->company_model->get_by_id($this->access->cid)->row();
		$data['company_name']=$company->company_name;
		$data['street']=$company->street;
		$data['suite']=$company->street;
		$data['city_state_zip_code']=$company->city_state_zip_code;
		$data['phone_number']=$company->phone_number;
		$data['default_warehouse']=$this->session->userdata("default_warehouse");
		$url=$m.'/menu';
		$table_model=APPPATH.'models/'. $m . '/table_model.php';
		if ( file_exists($table_model)){
			$this->load->model($m . '/table_model');
			$this->table_model->check_tables();
		}
		$this->session->set_userdata('_left_menu_caption',$m);
		$this->session->set_userdata('_left_menu', $url);
		$this->session->set_userdata('_right_menu','');
		if(is_ajax()){
			echo $this->load->view($url);
		} else {
			$data['_content']=$url;
			$data['ajaxed']=false;
			$this->template->display_main($url,$data);
		}
	}
}
