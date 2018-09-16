<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud
{
	var $table="",			  		$search_field="";
	var $controller="",       		$show_box=true;
	var $action="",           		$column_numeric=null; 
	var $key_field="",              $column_width=null;
	var $value="",            		$other_buttons=null;
	var $mode="",			  		$show_toolbar=true;
	var $sql="",					$default_value=null;
	var $class_name="",				$show_button_close=true;
	var $title="";
	var $fnc_edit="";
	function __construct(){
		$this->CI =& get_instance();        
       
	   $this->CI->load->helper('mylib');	 
	}
	function set_mode($value){
		$this->mode=$value;
	}
	function set_table($value){
		$this->table=$value;
	}
	function set_controller($value){
		$this->controller=$value;
	}
	function set_value($key,$value){
		$this->key=$key;
		$this->value=$value;
	}
	function set_action($action="",$key="",$value=""){
		$this->CI->action=$action;
		$this->key_field=$key;
		$this->value=$value;
	}
	function render($param=null){
		if($param){
			$cr_table="";
			if(isset($param["cr_table"]))$cr_table=$param["cr_table"];
			$this->sql="";
			$this->table=$cr_table;
			
			if(isset($param["cr_key_field"]))$this->key_field=$param["cr_key_field"];			
			if(isset($param["cr_show_toolbar"]))$this->show_toolbar=$param["cr_show_toolbar"];			
			if(isset($param["cr_show_box"]))$this->show_box=$param["cr_show_box"];
			if(isset($param["cr_default_value"]))$this->default_value=$param["cr_default_value"];
			
			
		}
		if($this->sql==""){
            $sql="select * from ".$this->table;
            $query=$this->CI->db->query($sql);
			$setting['row']=$query;
            $fieldsx=$this->CI->db->query("DESCRIBE ".$this->table)->result();
		} else {
			$sql=$this->sql;
			$query=$this->CI->db->query($this->sql);
			$fieldsx=$query->list_fields();
		}
        $fields=(array)$fieldsx;
        if($this->fnc_edit==""){
            for($i=0;$i<count($fields);$i++){
                $field=$fields[$i];
                if(is_object($field)){
                    $fn=$field->Field;        
                } else {
                    $fn=$field;
                }
                $this->fnc_edit.="$('#$fn').val(row.$fn);";                    
            }
            $this->fnc_edit.="$('#mode').val('edit');";
        }            
        if($this->title=="")$this->title=$this->table;
		$this->sql=$sql;
        if($this->key_field=="")$this->key_field="id";
        $setting["search_field"]=$this->search_field;
        $setting['row']=$query;
        $setting["fnc_edit"]=$this->fnc_edit;
        $setting['fields']=$fields;                    
		$setting['table']=$this->table;
		$setting['hwnd']="ID".rand();
		$setting['title']=$this->title;
		$setting['sql']=$this->sql;
        $setting['key_field']=$this->key_field;
        $setting['show_box']=$this->show_box;
        $setting['column_numeric']=$this->column_numeric;
        $setting['column_width']=$this->column_width;
        $setting['other_buttons']=$this->other_buttons;
		$setting['show_toolbar']=$this->show_toolbar;
        $setting['default_value']=$this->default_value;
		$setting['show_button_close']=$this->show_button_close;
		
        $hwnd=$setting["hwnd"];
        $this->CI->session->set_userdata($hwnd,$setting);
		return load_view('crud_browse',$setting);
	}

}
?>