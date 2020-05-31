<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Home extends CI_Controller {
	
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_frontend');
	}
	function index() {
       $data['company_code']=$this->session->userdata("company_code","");
       $data['message']='';
       $data['multi_company']=$this->config->item('multi_company');
       $data['title']='Sistim Informasi Sekolah Online';
       
       $this->load->library("upgrade");       
        $this->upgrade->process();
       
        $user_id=user_id();
        $session_id=$this->session->userdata("__ci_last_regenerate");        
        $this->db->query("update `user` set session_id='$session_id',logged_in='1'   where user_id='$user_id' ");

        if($this->access->is_login()){
            redirect(base_url("login/welcome"));
        }  else  {
            $view="sekolah/home";        
            $this->load->library("tpl/sb_admin/template");
            $this->template->display($view,$data);          
        }               
	} 
	
}