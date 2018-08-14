<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Preference extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
        
 		$this->load->helper(array('url','form'));
		$this->load->library(array('template','sysvar'));;
	}
	function indexx()
	{	
		if(!$this->access->is_login())redirect(base_url());
		$data['message']='';
		$data['google_ads_visible']=$this->_ci->sysvar->getvar('google_ads_visible','true');
		$this->template->display('preference',$data,'');
	}
 
}
