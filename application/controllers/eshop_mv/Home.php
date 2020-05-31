<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Home extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['message']='';
		$data['active_tab']=1;
		$this->template_eshop->display('eshop/home',$data);
	}
	function popular() {	
		$data['message']='';
		$data['active_tab']=2;
		$this->template_eshop->display('eshop/home',$data);
	}
	function hot() {	
		$data['message']='';
		$data['active_tab']=3;
		$this->template_eshop->display('eshop/home',$data);
	}
	
}