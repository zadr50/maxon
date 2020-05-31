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
private $server="";
private $user_id="";
private $user_pass="";
	 	 
    function __construct()
    {
    	 parent::__construct();
    	 $this->load->helper(array('url','form'));
    	 $this->load->library('template');
         $this->server=$this->config->item("db_server");
         $this->user_id=$this->config->item("db_user_id");
         $this->user_pass=$this->config->item("db_user_pass");
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
		$company=$this->input->post("company");
        if($reval=$this->cek_db_process($company)){
            return json_encode(array(
                "success"=>$retval["success"],
                "msg"=>$retval["msg"],
                "table_count"=>$retval['table_count']));                                
        } else{
            return json_encode(array("success"=>false,"msg"=>"Unknown error !"));        
        }
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
                $this->rcopy($f->getRealPath(), "$dest/$f");
            }
        }
    }
    
    
    function create_folder_copy($company){
        // create new folder database company
        if(! mkdir("../../company/$company")) return false;
        // copying aplikasi
        $this->rcopy("../../application","../../company/$company/application"); //$dir -  source path, $dirNew – destination path 
        $this->rcopy("../../assets","../../company/$company/assets"); 
        $this->rcopy("../../images","../../company/$company/images"); 
        $this->rcopy("../../js","../../company/$company/js"); 
        $this->rcopy("../../system","../../company/$company/system"); 
        $this->rcopy("../../themes","../../company/$company/themes"); 
        $this->rcopy("../../tmp","../../company/$company/tmp"); 
        $this->rcopy("../../addins","../../company/$company/addins"); 
        $this->rcopy("../../market","../../company/$company/market"); 

        $this->rcopy("../../pos","../../company/$company/pos");
        
        copy("../../index.php","../../company/$company/index.php");
        copy("../../pos.php","../../company/$company/pos.php");
        copy("../../.htaccess","../../company/$company/.htaccess");
        copy("../../favicon.ico","../../company/$company/favicon.ico");
        
        return true;
    }
	function cek_db_process($company){		

        //error_reporting(0);

        $server=$this->server;
        $database=$company;
        $user_id=$this->user_id;
        $user_pass=$this->user_pass;
		$ok=false;
		$msg="";
        // create new company directory and start copy files
        if(!$this->create_folder_copy($company)){
            $msg.="Unable create folder for this company [$company] maybe exist.!";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
        }
		// cek connection		
		if( ! $link=mysqli_connect($server,$user_id,$user_pass) ){
			$msg.="Error connecting server!";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
		} 
		$msg.="<br>Connecting server success.";
		// create new database
		if ( ! mysqli_query($link,'CREATE DATABASE '.$database) ) {
            $msg.="Error creating new database [".$database."] maybe exist, cannot continue.";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
		}
                
        $msg.="Create new database ".$database." success.";
        // select with new database
        if( ! mysqli_select_db($link,$database)){
            $msg.="<br>Error opening new database [".$database."].";
            mysqli_query($link,"DROP DATABASE ".$database);
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
        }


        //create config.php
        $base_url=$this->config->item("app_base_url");
        $servername=filter_input(INPUT_SERVER, 'SERVER_NAME');
$content="
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
\$servername=filter_input(INPUT_SERVER, 'SERVER_NAME');
\$port=filter_input(INPUT_SERVER, 'SERVER_PORT');
\$config['base_url']='http://$servername/$base_url/$company';
\$config['index_page'] = 'index.php';
\$config['url_suffix'] = '';
\$config['language'] = 'english';
\$config['charset'] = 'UTF-8';
\$config['enable_hooks'] = FALSE;
\$config['subclass_prefix'] = 'MY_';
\$config['composer_autoload'] = FALSE;
\$config['permitted_uri_chars'] = 'a-z 0-9~%.:_-';
\$config['allow_get_array'] = TRUE;
\$config['enable_query_strings'] = FALSE;
\$config['controller_trigger'] = 'c';
\$config['function_trigger'] = 'm';
\$config['directory_trigger'] = 'd';
\$config['log_threshold'] = 1;
\$config['log_path'] = '';
\$config['log_file_extension'] = '';
\$config['log_file_permissions'] = 0644;
\$config['log_date_format'] = 'Y-m-d H:i:s';
\$config['error_views_path'] = '';
\$config['cache_path'] = '';
\$config['cache_query_string'] = FALSE;
\$config['encryption_key'] = '';
\$config['sess_driver'] = 'files';
\$config['sess_cookie_name'] = 'ci_session';
\$config['sess_expiration'] = 7200;
\$config['sess_save_path'] = NULL;
\$config['sess_match_ip'] = FALSE;
\$config['sess_time_to_update'] = 300;
\$config['sess_regenerate_destroy'] = FALSE;
\$config['cookie_prefix']    = '';
\$config['cookie_domain']    = '';
\$config['cookie_path']      = '/';
\$config['cookie_secure']    = FALSE;
\$config['cookie_httponly']  = FALSE;
\$config['standardize_newlines'] = FALSE;
\$config['global_xss_filtering'] = FALSE;
\$config['csrf_protection'] = FALSE;
\$config['csrf_token_name'] = 'csrf_test_name';
\$config['csrf_cookie_name'] = 'csrf_cookie_name';
\$config['csrf_expire'] = 7200;
\$config['csrf_regenerate'] = TRUE;
\$config['csrf_exclude_uris'] = array();
\$config['compress_output'] = FALSE;
\$config['time_reference'] = 'local';
\$config['rewrite_short_tags'] = FALSE;
\$config['proxy_ips'] = '';
\$config['google_ads_visible']=true;
\$config['donate_visible']=true;
";        
        
        $filename=$this->config->item("app_folder")."company/$company/application/config/config.php";
        $ok=false;if ($handle = fopen($filename, 'w')) $ok=fwrite($handle, $content);
        if(!$ok){
            $msg.="<br>File config.php not writable !";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
       }
       fclose($handle);

       
$content.="\$config['index_page'] = 'index.php';";
        $filename=$this->config->item("app_folder")."company/$company/pos/config/config.php";
        $ok=false;if ($handle = fopen($filename, 'w')) $ok=fwrite($handle, $content);
        if(!$ok){
            $msg.="<br>File config.php not writable !";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
       }
       fclose($handle);
                      
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

        //create database.php
        $filename=$this->config->item("app_folder")."company/$company/application/config/database.php";
        $ok=false;if ($handle = fopen($filename, 'w')) $ok=fwrite($handle, $content);
        if(!$ok){
            $msg.="<br>File database.php not writable !";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
	   }
	   fclose($handle);

        $filename=$this->config->item("app_folder")."company/$company/pos/config/database.php";
        $ok=false;if ($handle = fopen($filename, 'w')) $ok=fwrite($handle, $content);
        if(!$ok){
            $msg.="<br>File database.php not writable !";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
       }
       fclose($handle);
	   		
		// create flag file maxon_installed.php
		$filename=$this->config->item("app_folder")."company/$company/application/config/maxon_installed.php";
		$content="OK";
        $ok=false;if($handle=fopen($filename, 'w')) $ok=fwrite($handle, $content);
        if( ! $ok ){            
            $msg.="<br>File maxon_installed.php not writable !";
            echo json_encode(array("success"=>false,"msg"=>$msg,"table_count"=>0));
            return false;
        }   
        fclose($handle);
        
        $msg="Success create folder company [$company]";
		$data=array("success"=>true,"msg"=>$msg,"table_count"=>44);
		echo json_encode($data);
	}
	
	
    
    function create_table($idx,$com=""){
        $company=$this->input->post("company");
        if($com!="")$company=$com;
        $data['nomor']=$idx;
		$data['server']=$this->server;
		$data['database']=$company;
		$data['user_id']=$this->user_id;
		$data['user_pass']=$this->user_pass;
        
		// cek connection
		if( ! $link=mysqli_connect($data['server'],$data['user_id'],$data['user_pass'])){
		    echo json_encode(array("success"=>false,"msg"=>"Unable open server !"));
            return false;
		}
		if( ! mysqli_select_db($link,$data['database'])){
            echo json_encode(array("success"=>false,"msg"=>"Unable open database [$company] !"));
            return false;
		}
        $data["link"]=$link;
        $data["msg"]="";

        $this->load->view("sql/create_db",$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */