<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Crud extends CI_Controller {
    private $limit=100;
    private $table_name='';

    function __construct()    {
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
    }
    function index()    {	
    }
    function browse_data($class_name){
		$session=$this->session->userdata($class_name);
		$sql=$session['sql'];
        echo datasource($sql);
    }
	function save($class_name)
	{
		$class=$this->session->userdata($class_name);
		 
		$table=$class['table_input'];
		$data=$this->input->post();
		$mode=$data['mode'];
		unset($data['mode']);
		if($mode=="edit"){ 
			$id=$data['id'];
			unset($data['id']);
			$retval=$this->db->where("id",$id)->update($table,$data);				
		} else {
			unset($data['id']);
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
		$retval=false;
		$session=$this->session->userdata($class_name);
		$table=$session['table_input'];
		$retval=$this->db->where("id",$id)->delete($table);
		if($retval){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("success"=>false,"msg"=>"Error ".mysql_error()));
		}
		
	}
}
?>
