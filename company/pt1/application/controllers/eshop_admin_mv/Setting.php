<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Setting extends CI_Controller {
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
		$this->template_eshop_admin->display('eshop/admin/setting',$data);
	}
	
}