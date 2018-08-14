<?php
class Budget_model extends CI_Model {

	private $primary_key='id';
	private $table_name='budget';
	public $fields=null;

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
	function save($data){
		if($data['id']==""){
			return $this->db->insert($this->table_name,$data);     
		} else {
			$id=$data['id'];
			unset($data['id']);
			return $this->update($id,$data);
		}
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function save_an($data){
		if($data['id']==""){
			return $this->db->insert("mnk_an",$data);     
		} else {
			$id=$data['id'];
			unset($data['id']);
			return $this->update($id,$data);
		}
	}
	function delete_an($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->delete("mn_an");
	}
	
}