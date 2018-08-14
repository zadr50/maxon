<?php if(!defined('BASEPATH'))exit('No direct script access allowed');
class Lion extends CI_Controller {
 private $library_src='';
 private $script_head='';
 private $data; 
 function __construct()
 {
   parent::__construct();
    $this->load->library('template');
    $this->load->helper(array('url','form','mylib_helper'));
 }

 function index() {
	$this->template->display_single("lion");
 }
 
 
}

