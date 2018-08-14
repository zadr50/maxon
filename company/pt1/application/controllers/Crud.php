<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Crud extends CI_Controller {
    private $limit=100;
    private $table_name='';

    function __construct()    {
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
    }
    function index()    {	
    }
    function browse_data($hwnd){
        $retval=false;
        $session=$this->session->userdata($hwnd);
        $key_field=$session["key_field"];
        $table=$session['table'];
		$session=$this->session->userdata($hwnd);
		$sql=$session['sql'];
        $search_field=$session["search_field"];
        $tb_search="";
        $tb_search=$this->input->get("tb_search");
            
        if(isset($data["search_field"]))$search_field=$data["search_field"];
        $npos=strpos(strtolower($sql)," where ");
        
        if($npos>0){
            if($search_field!=""){
                $sql.=" and $search_field like '$tb_search%'";
            }
        }
        
        echo datasource($sql);
    }
	function save($hwnd)
	{
		$session=$this->session->userdata($hwnd);
        if(!$session){
            echo json_encode(array("success"=>false,"msg"=>"Unknown Error" ));
            exit;
        }
		$table=$session['table'];
		$data=$this->input->post();
		$mode=$data['mode'];
		unset($data['mode']);
        $key_field=$session["key_field"];
		if($mode=="edit"){ 
			$id=$data[$key_field];
			unset($data[$key_field]);
			$retval=$this->db->where($key_field,$id)->update($table,$data);				
		} else {
			unset($data[$key_field]);
			$retval=$this->db->insert($table,$data);
		}
		 
		if($retval){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("success"=>false,"msg"=>"Error ".$this->CI->db->_error_message()));
		}
	}
	function delete($class_name,$id)
	{
        $session=$this->session->userdata($hwnd);
        if(!$session){
            echo json_encode(array("success"=>false,"msg"=>"Unknown Error" ));
            exit;
        }
		$retval=false;
		$session=$this->session->userdata($class_name);
        $key_field=$session["key_field"];
		$table=$session['table'];
		$retval=$this->db->where($key_field,$id)->delete($table);
		if($retval){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("success"=>false,"msg"=>"Error ".mysql_error()));
		}
		
	}
}
?>
