<?php
class Employee_level_model extends CI_Model {

private $primary_key='levelkode';
private $table_name='employee_level';

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
		$query=$this->db->query("select levelkode,keterangan from ".$this->table_name);
		$ret=array();$ret['']='- Select -';
 		foreach ($query->result() as $row){$ret[$row->levelkode]=$row->keterangan;}		 
		return $ret;
	}

}
