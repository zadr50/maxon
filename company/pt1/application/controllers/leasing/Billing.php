<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Billing extends CI_Controller {
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
        
        
		$this->load->helper(array('url','form','mylib_helper','browse_select_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
	}
	function index()
	{	
		//var_dump($this->session);
		$data['message']='';
		$this->template->display('leasing/billing',$data);
	}
 
}