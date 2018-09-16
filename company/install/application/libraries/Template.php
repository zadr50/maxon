<?php
class Template {
 protected $_ci;
 private $jquery='';
 private $bootstrap='';
 private $easyui='';
 private $mylib='';
 function __construct()
 {
    $this->_ci =&get_instance();

    $this->_ci->load->library(array('javascript'));
	
}

 function display($page,$data=null)
 {
		$data['header']=$this->_ci->load->view('header',$data, true);
		$data['footer']=$this->_ci->load->view('footer',$data, true);
		$data['page']=$this->_ci->load->view($page,$data, true);
		$this->_ci->load->view('template',$data);              
 }
 
}
