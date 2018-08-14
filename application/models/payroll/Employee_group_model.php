<?php
class Employee_group_model extends CI_Model {

private $primary_key='kode';
private $table_name='hr_emp_level';

function __construct(){
	parent::__construct();        
     
}
	function get_by_id($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function exist($id){
		$id=urldecode($id);
	   return $this->db->count_all($this->table_name." where kode='".$id."'")>0;
	}

	function save($data){
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($kode){
		$kode=urldecode($kode);
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function lookup(){
		$query=$this->db->query("select kode,keterangan from ".$this->table_name);
		$ret=array();$ret['']='- Select -';
 		foreach ($query->result() as $row){$ret[$row->kode]=$row->keterangan;}		 
		return $ret;
	}
}
