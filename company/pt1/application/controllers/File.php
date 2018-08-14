<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class File extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form','file_helper'));
		$this->load->library('template');;
	}
	function index()
	{	
//		var_dump($this->session);
		$data['message']='';
	}
	function edit($filename){
		echo $filename;
		$content=read_file($filename);
		echo $content;
	}
 
}