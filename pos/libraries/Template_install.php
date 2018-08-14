<?php
class Template_install {
	protected $_ci;
	private $jquery='';
	private $bootstrap='';
	private $easyui='';
	private $mylib='';
 
	 function __construct()
	 {
		$this->_ci =&get_instance();
     

		$this->_ci->load->library(array('javascript'));
		
		$base=base_url();
		$this->bootstrap='';
		$this->bootstrap.="<link rel='stylesheet' type='text/css' href='$base/assets/bootstrap-3.3.5/css/bootstrap.css'>";
		$this->bootstrap.=$this->_ci->jquery->script($base.'assets/bootstrap-3.3.5/js/bootstrap.min.js',true);

		$this->jquery="";
		$this->jquery.=$this->_ci->jquery->script($base.'assets/jquery/jquery-1.11.3.min.js',true);
		$this->jquery.=$this->_ci->jquery->script($base.'assets/bootstrap-3.3.5/js/bootstrap.min.js',true);

		$this->mylib=$this->_ci->jquery->script($base.'js/lib.js',true);
	  }

	 function display($page,$data=null)
	 {
		$data['jquery']=$this->jquery;
		$data['bootstrap']=$this->bootstrap;
		$data['mylib']=$this->mylib;
		$page="install/$page";
		$data['header']=$this->_ci->load->view('install/header',$data, true);
		$data['footer']=$this->_ci->load->view('install/footer',$data, true);
		$data['page']=$this->_ci->load->view($page,$data, true);
		$this->_ci->load->view('install/template',$data);              
	 }
	 function display_internal($page,$data=null)
	 {
		$this->_ci->load->helper("mylib_helper");
		$data['jquery']=$this->jquery;
		$data['bootstrap']=$this->bootstrap;
		$data['mylib']=$this->mylib;
		$data['cid']=cid();
		$data['user_id']=user_id();
		$data['user_pass']=user_pass();
		$page="install_in/$page";
		$data['header']=$this->_ci->load->view('install_in/header',$data, true);
		$data['footer']=$this->_ci->load->view('install_in/footer',$data, true);
		$data['page']=$this->_ci->load->view($page,$data, true);
		$this->_ci->load->view('install_in/template',$data);              
	 }
}
