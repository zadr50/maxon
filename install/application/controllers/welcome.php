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

	 $this->load->library('template');
	}

	function index()
	{
		$this->template->display('welcome_message');
	}
	function check_dir() 
	{
		$this->template->display("check_dir");
	}
	function cancel_install()
	{
		echo "<h1>See you next time !</h1>";
	}
	function set_db()
	{
		
		$this->template->display("set_db");
		
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
		$link=mysqli_connect($server,$user_id,$user_pass);
		if( !$link ){
			$msg="Error connecting server!";
			$ok=false;
		} else {
			$msg="Connecting server success.";
			$ok=true;			
		}
		// cek database if already canot continue
		if($ok){
			$ok=mysqli_select_db($link,$database);
			if( $ok ){
				$ok=false;
				$msg.="<br>Invalid Database: [".$database."] already exist cannot continue.";
			} else {
				$ok=true;
			}
		}
		if( $ok ) {
			// create new database
			$ok=mysqli_query($link,'CREATE DATABASE '.$database);
			if ( !$ok ) {
				$msg.="<br>Error creating new database [".$database."], cannot continue.";
			} else {
				$msg.="<br>Create new database ".$database." success.";
			}
			if ( $ok ) {
				// select with new database
				$ok=mysqli_select_db($link,$database);
				if(!$ok){
					$msg.="<br>Error opening new database [".$database."].";
					mysqli_query($link,"DROP DATABASE ".$database);
				}
			}
		}	
		if( $ok ) {
			// write ../application/config/database.php
			$content="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');			 
\$active_group = 'default';
\$active_record = TRUE;
\$db['default']['hostname'] = '$server';
\$db['default']['username'] = '$user_id';
\$db['default']['password'] = '$user_pass';
\$db['default']['database'] = '$database';
\$db['default']['dbdriver'] = 'mysqli';
\$db['default']['dbprefix'] = '';
\$db['default']['pconnect'] = TRUE;
\$db['default']['db_debug'] = TRUE;
\$db['default']['cache_on'] = FALSE;
\$db['default']['cachedir'] = '';
\$db['default']['char_set'] = 'utf8';
\$db['default']['dbcollat'] = 'utf8_general_ci';
\$db['default']['swap_pre'] = '';
\$db['default']['autoinit'] = TRUE;
\$db['default']['stricton'] = FALSE;
";

			$filename="../application/config/database.php";
			if ($ok = is_writable($filename)) {
			   if (!$handle = fopen($filename, 'w')) {
					$msg.="<br>Tidak bisa buka file ($filename)<br>";
					$ok=false;
			   }
			   if( $ok ){
				   if (fwrite($handle, $content) === FALSE) {
						$msg.="<br>Tidak bisa menulis ke file ($filename) <br> 
						Periksa seting folder application config <br>>";
						$ok = false;
				   }
			   }
			   if( $ok ){
					$msg.="<br>Success, dapat menulis isi ke file configurasi ($filename)";
					$ok=true;
			   }
			   fclose($handle);
				
				$filenamepos="../pos/config/database.php";
			    if ($handle2 = fopen($filenamepos, 'w')) {
				   fwrite($handle2, $content);	   
					fclose($handle2);
			    }			
			} else {
			   $msg.="<br>The file $filename is not writable, check permission file or directory. <br>";
			   $ok=false;
			}
			if( !$ok )	mysqli_query($link,"DROP DATABASE ".$database);
		}
		// create flag file maxon_installed
		if($ok){
			$filename="../application/config/maxon_installed.php";
			$content="OK";
			if ($ok = is_writable($filename)) {
			   if (!$handle = fopen($filename, 'w')) {
					$msg.="<br>Cannot open file ($filename)";
					$ok=false;
			   }
			   if($ok){
				   if (fwrite($handle, $content) === FALSE) {
					   $msg.="<br>Cannot write to file ($filename)";
					   $ok=false;
				   }
			   }
			   if( $ok ){
					$msg.="<br>Success, dapat menulis isi ke file configurasi ($filename)";
					$ok=true;
			   }
			   fclose($handle);
			} else {
			   $msg.="<br>The file $filename is not writable";
			   $ok=false;
			}
			if( !$ok )	mysql_query($link,"DROP DATABASE ".$database,$link);

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
		$this->session->set_userdata('setserver',$dpost);
		// cek connection
		$link=mysqli_connect($server,$user_id,$user_pass);
		$ok=mysqli_select_db($link,$database);
		$ok=true;
		$msg="Creating tables and queries";
		$path=realpath(dirname(__FILE__));
		//rename($path."/../../../install",$path."/../../../install_ex");
		
		include $path."/../views/sql/create_db.php";
		$finish="<h1>Finish.</h1><p>Congratulation you have new application, next button 
		setting your company data master.</p>
		<a href='".base_url()."../index.php' 
		class='btn btn-warning' role='button'>Lanjutkan Login</a>		
		<p>Before continue please delete folder <strong>[install]</strong></p>
		";
		///welcome/set_web next release
		$data=array("success"=>$ok,"message"=>$msg,"finish"=>$finish);
		echo json_encode($data);
	}
	function set_web(){
		$this->template->display("set_web");		
	}
	function set_web_process(){
		$dpost=$this->session->userdata("setserver");
		if(!$dpost){
			$msg="<p>Unable get session server !</p>";
			$ok=false;
		} else {
			$link=mysqli_connect($dpost['server'],$dpost['user_id'],$dpost['user_pass']);
			$ok=mysqli_select_db($link,$dpost['database']);
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