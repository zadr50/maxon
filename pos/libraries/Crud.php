<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud
{
	var $table="";				
	var $controller="";
	var $action="";
	var $key="";
	var $value="";
	var $mode="";
	var $sql="";
	var $class_name="";
	var $title="";
	var $table_input="";
	var $fnc_edit="";
	function __construct(){
		$this->CI =& get_instance();        
 
		$this->CI->load->helper('mylib');	 
	}
	function fnc_edit($fnc){$title=$this->fnc_edit;}
	function title($title){$title=$this->title;}
	function set_name($name){$this->class_name=$name;}
	function set_sql($sql){$this->sql=$sql;}
	function set_mode($mode){$this->mode=$mode;}
	function set_value($key,$value){
		$this->key=$key;
		$this->value=$value;
	}
	function set_table($table){$this->table=$table;}
	function set_controller($controller){$this->controller=$controller;}
	function set_action($action="",$key="",$value=""){
		$CI->action=$action;
		$this->key=$key;
		$this->value=$value;
	}
	function render(){
		if($this->sql==""){
			$setting['fields']=$this->CI->db->query("DESCRIBE ".$this->table)->result();
			$setting['row']=$this->CI->db->query("select * from ".$this->table);
			$sql="select * from ".$this->table;
		} else {
			$sql=$this->sql;
			$query=$this->CI->db->query($this->sql);
			$setting['fields']=$query->list_fields();
			$setting['row']=$query;
		}
		$this->sql=$sql;
		if($this->controller==""){
			$this->controller="crud";
		}
		$setting['controller']=$this->controller;
		$setting['table']=$this->table;
		$setting['class_name']=$this->class_name;
		$setting['title']=$this->title;
		$setting['table_input']=$this->table_input;
		$setting['fnc_edit']=$this->fnc_edit;
		$setting['sql']=$this->sql;
		$key=$this->class_name;
		$this->CI->session->set_userdata($key,$setting);


		if($this->action==""){
			return load_view('crud_browse',$setting);
		}
	}
}
?>