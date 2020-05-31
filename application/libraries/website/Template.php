<?php
class Template {
 protected $_ci;
 private $js='';
 private $css='';
 function __construct()
 {
    $this->_ci =&get_instance();
     
    $this->_ci->load->library(array('sysvar'));
	$this->css="
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/bootstrap-3.3.5/css/bootstrap.min.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/bootstrap-3.3.5/css/bootstrap-reset.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/font-awesome/css/font-awesome.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/animate.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/owlcarousel/owl.carousel.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/owlcarousel/owl.theme.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/superfish.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/magnific-popup.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/component.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/website/css/style.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/website/css/style-responsive.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/website/css/theme.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/parallax-slider/parallax-slider.css'>
	<link rel='stylesheet' type='text/css' href='".base_url()."assets/flexslider/flexslider.css'>
	

								
	";
	$this->js="
	
	<script src='".base_url()."assets/jquery/jquery-1.11.3.min.js'></script> 
	<script src='".base_url()."assets/jquery.easing.min.js'></script>
	<script src='".base_url()."assets/jquery.magnific-popup.js'></script>	
	<script src='".base_url()."assets/bootstrap/js/bootstrap.js'></script>	
	<script src='".base_url()."assets/parallax-slider/jquery.cslider.js'></script>
	<script src='".base_url()."assets/parallax-slider/modernizr.custom.28468.js'></script> 
	<script src='".base_url()."assets/jquery.flexslider.js'></script>
	<script src='".base_url()."assets/jquery.parallax-1.1.3.js'></script>
	<script src='".base_url()."assets/hover-dropdown.js'></script>
	<script src='".base_url()."assets/bxslider/jquery.bxslider.js'></script>
	<script src='".base_url()."assets/wow.min.js'></script>
	<script src='".base_url()."assets/owlcarousel/owl.carousel.js'></script>
	<script src='".base_url()."assets/link-hover.js'></script>
	<script src='".base_url()."assets/superfish.js'></script>
	<script src='".base_url()."assets/mixitup.js'></script>	
	<script src='".base_url()."assets/common-scripts.js'></script>
	<script src='".base_url()."js/lib.js'></script>	
	
	
	";
	
	
	
	
	
		
	$themes=$this->_ci->sysvar->getvar('themes','standard');
	
	add_log_ip_address();
}

 function display($template,$data=null){
  	$data['library_src']=$this->js;
  	$data['script_head']=$this->css;
	$data['file_content']=$template;
	$this->_ci->load->view("template/website/layout",$data);		 
 }
 
}
