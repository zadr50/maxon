<?php
class Bill_header_collector_model extends CI_Model {

private $primary_key='bill_id';
private $table_name='bill_header_collector';
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
		if($data['bill_date'])$data['bill_date']= date('Y-m-d H:i:s', strtotime($data['bill_date']));
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
        if($data['bill_date'])$data['bill_date']= date('Y-m-d H:i:s', strtotime($data['bill_date']));
		if(isset($data['amount']))$data['amount']=c_($data['amount']);
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		$this->recalc($id);
		return $ok;
	}
	function delete($id){	
		$this->db->where($this->primary_key,$id);
		$this->db->delete('bill_detail_collector');        
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function recalc($id){
		$total=$this->db->query("select sum(amount) as z from bill_detail_collector where bill_id='$id'")->row()->z;
		$this->db->query("update bill_header_collector set amount='$total' where bill_id='$id'");
		return true;
	}
}	 
