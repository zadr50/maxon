<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Dashboard extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index() {	
		$data['message']='';
		$data['caption']="Administrator Page";
		$this->template_eshop_admin->display('eshop/admin/dashboard',$data);
	}	
}