<?php
class Branch_model extends CI_Model {

private $primary_key='branch_code';
private $table_name='branch';

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
		$query=$this->db->query("select branch_code,branch_name from ".$this->table_name);
		$ret=array();$ret['']='- Select -';
 		foreach ($query->result() as $row){$ret[$row->branch_code]=$row->branch_name;}		 
		return $ret;
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	
}
