<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class About extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template');;
	}
	function index()
	{	
		//var_dump($this->session);
		$data['message']='';
		$this->template->display_form_input('welcome_message',$data,'');
	}
 
}