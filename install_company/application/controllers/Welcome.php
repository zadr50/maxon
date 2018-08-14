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
	    
        error_reporting(E_ALL);	/// & ~E_WARNING);
        
		$dpost=$this->input->post();
        
		$server=$dpost['server'];
		$database=$dpost['database'];
		$user_id=$dpost['user_id'];
		$user_pass=$dpost['user_pass'];
		$ok=false;
		$msg="";
        
        // create new folder database company
        $ok=mkdir("../company/$database");
        if($ok){
            echo "<br>Create new folder company database [$database] success.";
        } else {
            echo "<br>Error create new folder [$database].";
        }
        echo "<br>Connecting MySQL Server, please wait....";
        
        // copying aplikasi
        
        rcopy("../company/pt1","../company/$database"); //$dir -  source path, $dirNew – destination path 
        
        
		// cek connection
		$link=mysqli_connect($server,$user_id,$user_pass);
		if( !$link ){
			echo "<br>Error connecting server! cannot continue....";
			$ok=false;
            exit;
            
		} else {
			echo "<br>Connecting server success.";
			$ok=true;			
		}
        
		// cek database if already canot continue
		if($ok){
			$ok=mysqli_select_db($link,$database);
			if( $ok ){
				$ok=false;
				echo "<br>Invalid Database: [$database] already exist cannot continue.";
                exit;
			} else {
			    echo "<br>Available [$database]";
				$ok=true;
			}
		}
		if( $ok ) {
			// create new database
			$ok=mysqli_query($link,'CREATE DATABASE '.$database);
			if ( !$ok ) {
				echo "<br>Error creating new database [$database], because ".mysqli_error($link)." <br>Can not continue.";
                
				exit;
                
			} else {
				echo "<br>Create new database ".$database." success.";
			}
			if ( $ok ) {
				// select with new database
				$ok=mysqli_select_db($link,$database);
				if(!$ok){
					echo "<br>Error opening new database [".$database."], cannot continue...!!";
					///mysqli_query("DROP DATABASE ".$database,$link);
                    exit;
				} else {
				    echo "<br>Database open [$database]";
				}
			}
		}	
		if($ok){
            echo "<br>Finishing create database, please wait...";
        } else {
            echo "<br>Some error build database, cannot continue...please back.";
            exit;
        }
        
        
		$filename="../company/$database/application/config/database.php";
		$ok=update_file($filename,$database,"pratama");
		
		$filename="../company/$database/application/config/config.php";
		$ok=update_file($filename,"$database","pt1");
            
		// create flag file maxon_installed
		if($ok){
			$filename="../company/$database/application/config/maxon_installed.php";
			$content="OK";
			if ($ok = is_writable($filename)) {
			   if (!$handle = fopen($filename, 'w')) {
					echo "<br>Cannot open file ($filename)";
					$ok=false;
			   }
			   if($ok){
				   if (fwrite($handle, $content) === FALSE) {
					   echo "<br>Cannot write to file ($filename)";
					   $ok=false;
				   }
			   }
			   if( $ok ){
					echo "<br>Success, dapat menulis isi ke file configurasi ($filename)";
					$ok=true;
			   }
			   fclose($handle);
			} else {
			   echo "<br>The file $filename is not writable";
			   $ok=false;
			}
			if( !$ok )	mysqli_query("DROP DATABASE ".$database,$link);

		}
        echo "<br>Database sukses created...";
        
		echo "<br>Your application success build, try open this link...";
		echo "<br><a href='http://maxonerpserver.com/company/$database' target='_blank'>$database</a>";
		echo "<br>Congratulation";
        
        
        //building database
        echo "<br>exec: maxon.sql";$ret=run_sql_file("../maxon.sql",$link);
        echo "<br>FINISH...";
                
	}
	
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
		$ok=mysql_select_db($link,$database);
		$ok=true;
		$msg="Creating tables and queries";
		$path=realpath(dirname(__FILE__));
		include $path."/../views/sql/create_db.php";
		$finish="<h1>Finish.</h1><p>Congratulation you have new application, next button 
		setting your company data master.</p>
		<a href='".base_url()."../index.php' 
		class='btn btn-warning' role='button'>Lanjutkan Login</a>		
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
			$ok=mysql_select_db($link,$dpost['database']);
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


  
/**
 * Recursively copy files from one directory to another
 * 
 * @param String $src - Source of files being moved
 * @param String $dest - Destination of files being moved
 */
function rcopy($src, $dest){

    // If source is not a directory stop processing
    if(!is_dir($src)) return false;

    // If the destination directory does not exist create it
    if(!is_dir($dest)) { 
        if(!mkdir($dest)) {
            // If the destination directory could not be created stop processing
            return false;
        }    
    }

    // Open the source directory to read in files
    $i = new DirectoryIterator($src);
    foreach($i as $f) {
        if($f->isFile()) {
            copy($f->getRealPath(), "$dest/" . $f->getFilename());
        } else if(!$f->isDot() && $f->isDir()) {
            rcopy($f->getRealPath(), "$dest/$f");
        }
    }
}

function run_sql_file($location,$link){
    //load file
    $commands = file_get_contents($location);

    //delete comments
    $lines = explode("\n",$commands);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);
        if( $line && !startsWith($line,'--') ){
            $commands .= $line . "\n";
        }
    }

    //convert to array
    $commands = explode(";", $commands);

    //run commands
    $total = $success = 0;
    foreach($commands as $command){
        if(trim($command)){
            $success += (@mysqli_query($link,$command)==false ? 0 : 1);
            $total += 1;            
        }
        $command=strip_tags($command);
        //echo "<br>".substr($command, 0,150)."...";
        $err=mysqli_error($link);
        if($err!="")        echo "<br>$err";
    }

    //return number of successful queries and total number of queries found
    return array(
        "success" => $success,
        "total" => $total
    );
}


// Here's a startsWith function
function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function create_config_database($filename){
                            
            $content="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');            
            \$active_group = 'default';
            \$active_record = TRUE;
            \$db['default']['hostname'] = '$server';
            \$db['default']['username'] = '$user_id';
            \$db['default']['password'] = '$user_pass';
            \$db['default']['database'] = '$database';
            \$db['default']['dbdriver'] = 'mysql';
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
            
            
            if ($ok = is_writable($filename)) {
               if (!$handle = fopen($filename, 'w')) {
                    echo "<br>Tidak bisa buka file ($filename)<br>";
                    $ok=false;
               }
               if( $ok ){
                   if (fwrite($handle, $content) === FALSE) {
                        echo "<br>Tidak bisa menulis ke file ($filename) <br> 
                        Periksa seting folder application config <br>>";
                        $ok = false;
                   }
               }
               if( $ok ){
                    echo "<br>Success, dapat menulis isi ke file configurasi ($filename)";
                    $ok=true;
               }
               fclose($handle);
            
            } else {
               echo "<br>The file $filename is not writable, check permission file or directory. <br>";
               $ok=false;
            }
            if( !$ok )  mysqli_query("DROP DATABASE ".$database,$link);
        }

function update_file($filename,$search_string,$search){
    $buffer = file_get_contents($filename);
    $buffer = str_replace($search, $search_string, $buffer);
    file_put_contents($filename, $buffer);
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */