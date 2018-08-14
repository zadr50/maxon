<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sessionset extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
        $this->load->library('upgrade');
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
       $this->upgrade->process();        
        
        
		echo "<script>window.history.back();</script>";
        
	}
	
}
?>
