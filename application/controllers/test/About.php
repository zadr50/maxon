<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class About extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form','mylib'));
		$this->load->library('template');;
	}
	function index()
	{	
		echo "</br>".getvar('default_cash_payment_account');
		var_dump($this->session);
		
	}
 
}