<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
function __construct()
{
	 parent::__construct();
	 $this->load->helper(array('url','form'));

	 $this->load->library('template_install');
	}

	function index()
	{
		$this->template_install->display('welcome_message');
	}
	function check_dir() 
	{
		$this->template_install->display("check_dir");
	}
	function cancel_install()
	{
		echo "<h1>See you next time !</h1>";
	}
	function set_db()
	{
		
		$this->template_install->display("set_db");
		
	}
	function cek_db_process(){
		$dpost=$this->input->post();
		$server=$dpost['server'];
		$database=$dpost['database'];
		$user_id=$dpost['user_id'];
		$user_pass=$dpost['user_pass'];
		$ok=false;
		$msg="";
		// cek connection
		$dsn = 'mysqli://'.$user_id.':'.$user_pass.'@'.$server;
		$link = $this->load->database($dsn.'/mysql', true);
		$this->load->dbforge($link);
		if( !$link ){
			$msg="Error connecting server!";
			$ok=false;
		} else {
			$msg="Connecting server success.";
			$ok=true;			
		}
		// cek database if already canot continue
		/* if($ok){
			$ok = $this->load->database($dsn.'/'.$database, true);
			if( $ok ){
				$ok=false;
				$msg.="<br>Invalid Database: [".$database."] already exist cannot continue.";
			} else {
				$ok=true;
			}
		} */
		if( $ok ) {
			// create new database
			$ok=$this->dbforge->create_database($database,true);
			if ( !$ok ) {
				$msg.="<br>Error creating new database [".$database."], cannot continue.";
			} else {
				$msg.="<br>Create new database ".$database." success.";
			}
			if ( $ok ) {
				// select with new database
				$link = $this->load->database($dsn.'/'.$database, true);
				$this->load->dbforge($link);
				$ok=$link;
				if(!$link){
					$msg.="<br>Error opening new database [".$database."].";
				}
			}
		}	
		 
		if( $ok ) {
			$path = realpath('')."/"; 
			$this->load->helper("file");
			$file=$path."application/config/database.php";
			if ($ok = is_writable($file)) {
				if( !$data=read_file($file))
				{
					$msg.="<br>Tidak bisa buka file ($file)<br>";
					$ok=false;
			    }
			    if( $ok ){
					$data=str_replace("<SERVER>",$server,$data);
					$data=str_replace("<DATABASE>",$database,$data);
					$data=str_replace("<USER>",$user_id,$data);
					$data=str_replace("<PASSWORD>",$user_pass,$data);
					
				    if ( !$ok=write_file($file,$data) ) {
						$msg.="<br>Tidak bisa menulis ke file ($file) <br> 
						Periksa seting folder application config <br>>";
						$ok = false;
				    }
			   }
			   if( $ok ){
					$msg.="<br>Success, dapat menulis isi ke file configurasi ($file)";
					$ok=true;
			   }
			} else {
			   $msg.="<br>The file $file is not writable, check permission file or directory. <br>";
			   $ok=false;
			}
			
			$file=$path."application/config/routes.php";
			if($data=read_file($file))
			{
				$src="route['default_controller'] = 'install'";
				$tgt="route['default_controller'] = 'login'";
				$data=str_replace($src,$tgt,$data);
				$ok=write_file($file,$data);
			}
			$file=$path."application/config/autoload.php";
			if($data=read_file($file))
			{
				$src="autoload['libraries'] = array()";
				$tgt="_autoload['libraries'] = array()";
				$data=str_replace($src,$tgt,$data);
				
				$src="autoload['packages'] = array()";
				$tgt="_autoload['packages'] = array()";
				$data=str_replace($src,$tgt,$data);
				
				$ok=write_file($file,$data);
			}
			$file=$path."application/config/config.php";
			if($data=read_file($file))
			{
				$src="config['base_url'] = ";
				$tgt="_config['base_url'] = ";
				$data=str_replace($src,$tgt,$data);
				
				
				$ok=write_file($file,$data);
			}
			
			
			
		}
		$data=array("success"=>$ok,"message"=>$msg);
		echo json_encode($data);
	}
	function cek_db_process_2(){
		$dpost=$this->input->post();
		$server=$dpost['server'];
		$database=$dpost['database'];
		$user_id=$dpost['user_id'];
		$user_pass=$dpost['user_pass'];
//		$this->session->set_userdata('setserver',$dpost);
		// cek connection
		$dsn = 'mysqli://'.$user_id.':'.$user_pass.'@'.$server;
		$link = $this->load->database($dsn.'/'.$database, true);
		$this->load->dbforge($link);
		$ok=true;
		$msg="Creating tables and queries";
		$path = realpath('')."/"; 
		include $path."application/views/install/sql/create_db.php";
		$finish="<h1>Finish.</h1><p>Congratulation you have new application, next button 
		setting your company data master.</p>
		<a href='".base_url()."index.php' 
		class='btn btn-warning' role='button'>Lanjutkan Login</a>		
		";
		///welcome/set_web next release
		$data=array("success"=>$ok,"message"=>$msg,"finish"=>$finish);
		echo json_encode($data);
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