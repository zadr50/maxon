<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Complaint extends CI_Controller {
	private $success=false;
	private	$message="";

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
        
        
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['title']='Complaint';
		$this->template_eshop->display("complaint",$data);		
	}
}