<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class createpdf extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		echo 'hai';	
	}
	function pdf()
	{
	    $this->load->helper('pdf_helper');
	    /*
	        ---- ---- ---- ----
	        your code here
	        ---- ---- ---- ----
	    */
	    $data['html']='<h1>hallo message</h1>';
	   	$this->load->view('pdfreport', $data);
	}
	
 
}

