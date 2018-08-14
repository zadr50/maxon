<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Autonumber extends CI_Controller {
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
        
        
        $this->load->library('sysvar');
		if(!$this->access->is_login())redirect(base_url());
	}
	function index()
	{
            $kode=$this->input->get('q');
            if($kode){
                echo $this->sysvar->autonumber($kode);
                $this->sysvar->autonumber_inc($kode);
            }
	}
 
}
