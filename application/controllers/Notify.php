<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Notify extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
	}
	function index()
	{	
		$data['message']='';
	}
    function process(){
        $this->load->library('alert');;
        $this->alert->process();
		echo $this->alert->message_text();
    }
 
}