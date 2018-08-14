<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class LoadView extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
        
        $this->load->library('sysvar');
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
	}
	function index()
	{
	}
	function view($fileView){
		$data['message']="";
        $this->template->display_form_input($fileView,$data);
		
	}
 
}
