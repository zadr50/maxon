<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sessionset extends CI_Controller {
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
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
	}
	function index(){
	}
	function save($key="",$value=""){
		$old=$this->session->userdata($key);
		if($key!=""){
			$this->session->set_userdata($key,$value);
		}
		if($value==""){
			if($old=="false"){
				$value="true";
			}else {
				$value="false";
			}
			
			$this->session->set_userdata($key,$value);
		}
		if($key=="sidebar_show"){
			$this->session->set_userdata("header_visible",$value);
		}
		echo "<script>window.history.back();</script>";
	}
	
}
?>
