<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud
{
	var $table="",				$search_field="";
	var $controller="";
	var $action="";
	var $key="";
	var $value="";
	var $mode="";
	var $sql="";
	var $class_name="";
	var $title="";
	var $fnc_edit="";
	function __construct(){
		$this->CI =& get_instance();        
       $multi_company=$this->CI->config->item('multi_company');
       if($multi_company){
            $company_code=$this->CI->session->userdata("company_code","");
            if($company_code!=""){
               $this->CI->db = $this->CI->load->database($company_code, TRUE);
           }
       }         
	   $this->CI->load->helper('mylib');	 
	}
	function set_value($key,$value){
		$this->key=$key;
		$this->value=$value;
	}
	function set_action($action="",$key="",$value=""){
		$CI->action=$action;
		$this->key=$key;
		$this->value=$value;
	}
	function render(){
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
        
        $setting["search_field"]=$this->search_field;
        $setting['row']=$query;
        $setting["fnc_edit"]=$this->fnc_edit;
        $setting['fields']=$fields;                    
		$setting['table']=$this->table;
		$setting['hwnd']="ID".rand();
		$setting['title']=$this->title;
		$setting['sql']=$this->sql;
        $setting['key_field']="id";
        $hwnd=$setting["hwnd"];
        $this->CI->session->set_userdata($hwnd,$setting);
		return load_view('crud_browse',$setting);
	}
}
?>