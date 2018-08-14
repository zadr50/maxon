<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_Company extends CI_Controller {

	/**
	 * Create all new company tables XXX_tablename
	 *
	*/
	 
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library('template_install');
	}

	function index()
	{
		$this->template_install->display_internal('welcome_message');
	}
	function check_dir() 
	{
		$this->template_install->display_internal("check_dir");
	}
	function cancel_install()
	{
		echo "<h1>See you next time !</h1>";
	}
	
	function set_db()
	{		
		$this->template_install->display_internal("set_db");		
	}
	function cek_db_process(){
		$dpost=$this->input->post();
		$company=$dpost['company'];
		$user_id=$dpost['user_id'];
		$user_pass=$dpost['user_pass'];
		$ok=false;
		$msg="";
		$msg="Connecting server success.";
		$ok=true;			
		$data=array("success"=>$ok,"message"=>$msg); 
		//echo json_encode($data);
		$this->template_install->display_internal("sql/create_db",$dpost);
	}
	function cek_db_process_2(){
		$this->load->helper("mylib_helper");
		$dpost=$this->input->post();
		$company=$dpost['company'];
		$user_id=$dpost['user_id'];
		$user_pass=$dpost['user_pass'];
		// cek connection
		$ok=true;
		$msg="Creating tables and queries";
		$path = realpath('')."/"; 
//		include $path."application/views/install_in/sql/create_db.php";
		$this->load->view("install_in/sql/create_db");
		
		$finish="<h1>Finish.</h1><p>Congratulation you have new application, next button 
		setting your company data master.</p>
		<a href='".base_url()."index.php' 
		class='btn btn-warning' role='button'>Lanjutkan Login</a>		
		";
		///welcome/set_web next release
		$data=array("success"=>$ok,"message"=>$msg,"finish"=>"FINISH.");
		//echo json_encode($data);
		echo "Creating tables and queries.";
		
	}
	function set_web(){
		$this->template_install->display("set_web");		
	}
	function set_web_process(){
		$dpost=$this->session->userdata("setserver");
		if(!$dpost){
			$msg="<p>Unable get session server !</p>";
			$ok=false;
		} else {
			$link=mysql_connect($dpost['server'],$dpost['user_id'],$dpost['user_pass']);
			$ok=mysql_select_db($dpost['database']);
			if( !$ok ) {
				$msg="<p>Unable opening database ".$dpost['database']." !</p>";
			} else {
				$dpost2=$this->db->post();
				$company['company_name']=$dpost2['company_name'];
				$company['company_name']=$dpost2['company_name'];
			}			
		}
		$data=array("success"=>$ok,"message"=>$msg,"finish"=>$finish);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */