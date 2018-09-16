<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Home extends CI_Controller {
	
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_frontend');
	}
	function index() {	
		$data['message']='';
		$this->template_frontend->display('sekolah/home',$data);
	} 
	
}