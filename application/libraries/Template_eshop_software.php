<?php
class Template_eshop_software {
 protected $_ci;
 private $library_src='';
 private $script_head='';
 private $bootstrap_only='';
 private $flexslider='';
 function __construct()
 {
    $this->_ci =&get_instance();
     
    
    $this->_ci->load->library(array('javascript','sysvar'));
	$base=base_url();
	$this->bootstrap_only="<link rel='stylesheet' type='text/css' href='$base//assets/bootstrap/css/bootstrap.css'>";
	$this->bootstrap_only.=$this->_ci->jquery->script(base_url().'assets/jquery/jquery-1.11.3.min.js',true);
    $this->bootstrap_only.=$this->_ci->jquery->script(base_url().'assets/bootstrap/js/bootstrap.js',true);
    $this->bootstrap_only.=$this->_ci->jquery->script(base_url().'js/lib.js',true);
    // $this->flexslider=$this->_ci->jquery->script(base_url().'assets/flexslider/jquery.flexslider.js',true);
	$themes=$this->_ci->sysvar->getvar('themes','standard');	
	add_log_ip_address();
}

 function display($template,$data){
  	$data['library_src']=$this->bootstrap_only;
  	$data['script_head']='';
	$data['file_content']=$template;
	$data['content']=true;
	$data['footer']='eshop_software/footer';
	$this->_ci->load->view("eshop_software/layout",$data);		 
 }
 function item($item_id){
	 
 }
 function filter(){
	 
 }
 
 
 
}
