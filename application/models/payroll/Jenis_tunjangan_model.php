<?php
class Jenis_tunjangan_model extends CI_Model {

private $primary_key='kode';
private $table_name='hr_jenis_tunjangan';

function __construct(){
	parent::__construct();        
      
}
function count_all(){
	return $this->db->count_all($this->table_name);
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
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function update($id,$data){
	$id=urldecode($id);
	$this->db->where($this->primary_key,$id);
	return $this->db->update($this->table_name,$data);
}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function dropdown(){
		$query=$this->db->query("select kode,keterangan from ".$this->table_name." order by keterangan");
		$ret=array();
		$ret['']='- Select -';
		foreach ($query->result() as $row) {
			$ret[$row->kode]=$row->keterangan." - [$row->kode]";
		}		 
		return $ret;
	}
	function loadlist() {
		$rows=null;
		$this->db->order_by("kode");
		if($q=$this->db->get($this->table_name)){
			foreach($q->result() as $r) {
				$rows[]=$r;
			}
		}
		return $rows;
	}
	
}
