<?php
class Template_frontend {
 protected $_ci;
 private $js='';
 private $css='';
 function __construct()
 {
    $this->_ci =&get_instance();
     
    $this->_ci->load->library(array('sysvar'));
	$this->css="<link rel='stylesheet' type='text/css' href='".base_url()."assets/bootstrap/css/bootstrap.css'>";
	$this->js="<script src='".base_url()."assets/jquery/jquery-1.11.3.min.js'></script>";
    $this->js.="<script src='".base_url()."assets/bootstrap/js/bootstrap.js'></script>";
    $this->js.="<script src='".base_url()."js/lib.js'></script>";
	$themes=$this->_ci->sysvar->getvar('themes','standard');
	
	add_log_ip_address();
}

 function display($template,$data=null){
  	$data['library_src']=$this->js;
  	$data['script_head']=$this->css;
	$data['file_content']=$template;
	$this->_ci->load->view("template/frontend/layout",$data);		 
 }
 
}
