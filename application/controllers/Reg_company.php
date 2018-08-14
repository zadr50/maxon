<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Reg_company extends CI_Controller {
    private $limit=10;
    private $table_name='preferences';
    private $sql="select company_code,company_name,street,city_state_zip_code,phone_number,
    	fax_number,email
                from preferences
                ";
    private $file_view='admin/company';
    private $primary_key='company_code';
    private $controller='company';
	private $sql_error=array();

    function __construct()    {
            parent::__construct();        
     
            $this->load->helper(array('url','form','mylib_helper'));
	        $this->load->library('sysvar');
            $this->load->library('template');
            $this->load->library('form_validation'); 
    }
    function set_defaults($record=NULL){
            $data['mode']='';
            $data['message']='';
            $data=data_table($this->table_name,$record);
             return $data;
    }
    function index()    {	
	 
		
    }
   function com_list()
   {
	   $data=$this->db->get('com_list')->result_array();
		echo json_encode(array("result"=>true,"data"=>$data));
   }
   function new_folder($company)
   {
	   $company=urldecode($company);
	   $company=str_replace(" ","",$company);
	   	$s='Loading data...';
		$base_folder=__DIR__;
		$root_folder=$base_folder.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
		$base_folder=$root_folder."company".DIRECTORY_SEPARATOR;
		$com_folder=$base_folder.$company;
		$ok=false;
		$source=$base_folder."company.zip";
		$dest=$base_folder.$company.DIRECTORY_SEPARATOR;

		if($folder_exist = @opendir($com_folder))
	   {
		   $data[]="Your company [$company] is exist, cannot continue.!"; 
	   } else {
			$data[]=$s."OK";
			$s='Creating new folder...';
		   if(mkdir($com_folder, 0700))
		   {
				$data[]=$s."OK";

				$s='Copying sample company...';		
				//if(copy($source,$dest)){
					$data[]=$s."OK";
				//}
				$ok=false;
				$s='Extracting...';

 				$zip = new ZipArchive;
				if ($zip->open($source , ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE ) === TRUE) {
					$zip->extractTo($dest	);
					$zip->close();
					$data[]=$s."OK";
					$ok=true;
				} else {
					$data[]=$s."ERROR";
				}
				if($ok){
					$ok=false;
					$s='Installing New Database...';
					$this->load->dbforge();
					$db_name=$company;
					$ok=$this->dbforge->create_database($db_name);
					$data[]=$s."OK";
					
				}
				if($ok){
					$s='Building Database...';
					$dsn2 = 'mysql://root:@localhost/'.$company;
					$dsn2 = 'mysql://simak:atl24nta@192.168.23.10/'.$company;
					$db2= $this->load->database($dsn2, true);
					$file_sql=$root_folder.DIRECTORY_SEPARATOR."simak.sql";
					$ok=$this->execute_sql_file($file_sql,$db2);
					if($ok){
						$data[]=$s."OK";
					} else {
						$data[]=$s."ERROR";						
					}
				}
				if($ok){
					$ok=false;
					$s='Building default setting...';
					if($ok=$this->execute_def_set($db2)){
						$data[]=$s."OK";
					} else {
						$data[]=$s."ERROR";
					}
				}
				if($ok){
					$s="Writing configuration..";
					if($ok=$this->write_config($com_folder,$company)){
						$data[]=$s."OK";
					} else {
						$data[]=$s."ERROR";
					}
				}
				if($ok){
					$data[]='Finish.';
				} else {
					$data[]='Not Finish. Error reporting...!!!';					
				}
		   } else {
				$data[]="Error create new folder [$company], cannot continue.!"; 			   
		   }
	   }
	   if($ok) {
		   $comdata["com_code"]=$company;
		   $comdata["com_db_name"]=$db_name;
		   $comdata["com_url"]=base_url()."/company/".$company."/index.php";
		   $comdata["com_short_desc"]="Company short description";
		   $comdata["com_long_desc"]="This company is long description bla bla bla, change on setting perusahaan";
		   $comdata["com_logo"]=base_url()."/company/".$company."/images/gnome-db.png";

		   $this->db->insert("com_list",$comdata);
	   }
		echo json_encode(array("success"=>$ok,'data'=>$data,
		"company"=>$company,"sql_error"=>$this->sql_error));

	   
   }
   function execute_def_set($db)
   {
	   return true;
   }
   function write_config($folder,$company)
   {
	   $ok=false;
	   $file_conf_db=$folder.DIRECTORY_SEPARATOR."application".
			DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."database.php";
		$this->load->helper("file");
		if($data=read_file($file_conf_db))
		{
			$data=str_replace("simak",$company,$data);
			$ok=write_file($file_conf_db,$data);
		}
	   $file_conf_route=$folder.DIRECTORY_SEPARATOR."application".
			DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."routes.php";
		$this->load->helper("file");
		if($data=read_file($file_conf_route))
		{
			$data=str_replace("frontend/home","login",$data);
			$ok=write_file($file_conf_route,$data);
		}
		return $ok;
   }
   function execute_sql_file($file_sql,$db)
   {
		$this->load->helper("file");
	   $ok=false;
	   $sql = read_file($file_sql);
	   $sqls = explode(';', $sql);
	   $err=array();
		array_pop($sqls);
		foreach($sqls as $statement){
			$statment = $statement . ";";
			$ok=$db->query($statement);  
			if(!$ok){
				$err[]="</br>[$statement]</br>".mysql_error();
			}
		}
		$this->sql_error=$err;
		return $ok;
   }
}
?>
