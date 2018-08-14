<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Complaint extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['title']='Complaint';
		$this->template_eshop->display("eshop/complaint",$data);		
	}
}