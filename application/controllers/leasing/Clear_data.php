<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Clear_data extends CI_Controller {
    private $file_view='leasing/clear_data';
    private $controller='leasing/clear_data';
	private $title="PROSES PENGHAPUSAN DATA";
	private $help="clear_data_leasing";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
    }
    function index($jenis){
    }
	function trans(){
		$data['title']=$this->title;
		$data['help']=$this->help;
		$this->file_view .= "_trans";
		
		$this->template->display($this->file_view,$data);
	
	}
	function master() {
		$data['title']=$this->title;
		$data['help']=$this->help;
		$this->file_view .= "_master";
		
		$this->template->display($this->file_view,$data);
	
	
	}
	
}
?>
