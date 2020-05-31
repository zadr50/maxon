<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Help extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
	}
	function index() {	
		echo "Help not yet available.";
	}
}