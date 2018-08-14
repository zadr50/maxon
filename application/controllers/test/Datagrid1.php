<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Datagrid1 extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form','mylib'));
		$this->load->library('template');;
	}
	function index()
	{	
        $this->template->display("test/datagrid1");
		
	}
 
}