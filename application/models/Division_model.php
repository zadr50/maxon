<?php
class Division_model extends CI_Model {

private $primary_key='div_code';
private $table_name='divisions';

function __construct(){
	parent::__construct();        
      
}
	function save($data){
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function lookup(){
		$query=$this->db->query("select div_code,div_name from ".$this->table_name);
		$ret=array();$ret['']='- Select -';
		if($query)foreach ($query->result() as $row){$ret[$row->div_code]=$row->div_name;}		 
		return $ret;
	}
}
