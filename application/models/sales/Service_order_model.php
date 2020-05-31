<?php
class Service_order_model extends CI_Model {

private $primary_key='no_bukti';
private $table_name='service_order';
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
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		return $ok;
	}
	function delete($id){
			
		$this->db->where($this->primary_key,$id);
		$ok = $this->db->delete($this->table_name);
		        
		$this->db->where("service_number",$id);
		$this->db->delete("service_jobs");
		
		return $ok;
		
	}
}	 
