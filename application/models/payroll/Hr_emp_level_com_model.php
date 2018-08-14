<?php
class Hr_emp_level_com_model extends CI_Model {

private $primary_key='id';
private $table_name='hr_emp_level_com';

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
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function loadlist($level_code) {
		$rows=null;
		$this->db->where('level_code',$level_code);
		$this->db->order_by("salary_com_code");
		if($q=$this->db->get($this->table_name)){
			foreach($q->result() as $r) {
				$rows[]=$r;
			}
		}
		return $rows;
	}

}