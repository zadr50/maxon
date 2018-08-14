<?php
class Promosi_point_model extends CI_Model {

	private $primary_key='promosi_code';
	private $table_name='promosi_disc';

	function __construct(){
		parent::__construct();        
       
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function datalist(){
		$ret['']='- Select -';
		$this->db->where("category",6);
		if($query=$this->db->get($this->table_name))
		{
			foreach ($query->result() as $row){
				$ret[$row->promosi_code]=$row->description;
			}
		}			
		return $ret;
	}	
} 