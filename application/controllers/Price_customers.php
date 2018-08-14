<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Price_customers extends CI_Controller {
    function __construct()    {
		parent::__construct();        
       
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		$this->load->model('syslog_model');
    }
    function index()    
	{
		$data['caption']="SALES PRICES BASED ON CUSTOMER TYPE";
		$this->template->display_form_input('sales/prices',$data);		
	}
	
}

?>