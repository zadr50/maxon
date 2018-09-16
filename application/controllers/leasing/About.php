<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class About extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
                
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		$this->load->library('template');;
	}
	function index()
	{	
		//var_dump($this->session);
		$data['message']='';
		$this->template->display_form_input('welcome_message',$data,'');
	}
 
}