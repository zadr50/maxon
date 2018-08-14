<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Query extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template');;
	}
	function index()
	{	
		$data['message']='';
//		$this->template->display_form_input('welcome_message',$data,'');
	}
	function exec($nomor){
		var_dump($nomor);
		
	}
 
}