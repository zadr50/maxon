<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Dashboard extends CI_Controller {
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
        
        
 		$this->load->helper(array('url','form'));
		$this->load->library('template',"access");;
	}
	function index()
	{	
		if($this->access->is_login()){
			$data['message']='';
			$this->template->display('bos/home',$data,'');
		} else {
			header("location:login/simple");
		}
	}
 
}