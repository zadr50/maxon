<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Aktiva_proses extends CI_Controller {
	
	private $periode;
	private $asset_id;
	
	function __construct()
	{
		parent::__construct();
		
		date_default_timezone_set("Asia/Jakarta");
		
		$this->periode=date("Y-m");
		$this->asset_id="";
		
		if(!$this->access->is_login())redirect(base_url());
        
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('aktiva_model');
	}
	function index()
	{	
		$this->load->model("periode_model");
		$data['message']='';
		$data['asset_list']=$this->aktiva_model->loadlist();
		$data['periode_list']=$this->periode_model->loadlist();
		$this->template->display_form_input('aktiva/proses',$data);
	}
	function exist($asset_id) {
		 $asset_id=urldecode($asset_id);
	
	}
	function save($asset_id) {
		 $asset_id=urldecode($asset_id);
	
	}
	function no_method($asset_id,$period="") {
		$asset_id=urldecode($asset_id);
		$period=urldecode($period);
		$data['amount']=0;
		$data['book']=0;
		return $data;
	}
	
	function load($period,$reload=false) {
		$period=urldecode($period);
		$rows=$this->aktiva_model->load_by_period($period,$reload);
        $data['total']=count($rows);
        $data['rows']=$rows;                    
        echo json_encode($data);
	}
 
}
