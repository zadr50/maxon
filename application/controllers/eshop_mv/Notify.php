<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Notify extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['title']='Notifikasi Harga';
		$this->template_eshop->display("eshop/notify",$data);		
	}
}