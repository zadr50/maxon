<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Table extends CI_Controller {
    private $sql='';
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
        $this->load->model('table_model');
	}
	function index(){}
    function exist_key(){
		$table_name=$this->input->get("table");
		$field_name=$this->input->get("field");
		$field_val=$this->input->get("value");
		if($field_name=="" or $field_val=="")	return false;
        $query=$this->db->where($field_name,$field_val)->get($table_name);
		if($query->num_rows()){
			echo json_encode(array("exist"=>true));
		} else {
			echo json_encode(array("exist"=>false));
		}
    }
	function load($table)
	{
		$retval=false;
		$data=null;
		if($q=$this->db->get($table)){
			foreach($q->result_array() as $row)
			{
				$data[]=$row;
			}
			$retval=true;
		}
		echo json_encode(array("success"=>$retval,"data"=>$data));
	}
 }
	 
