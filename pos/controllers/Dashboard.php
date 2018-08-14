<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
        
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