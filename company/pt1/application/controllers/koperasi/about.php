<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class About extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form','mylib_helper'));
                
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		$this->load->library('template');
	}
	function index()
	{	
            $data['message']='';
            $this->template->display_form_input('welcome_message',$data,'');
	}
 
}
