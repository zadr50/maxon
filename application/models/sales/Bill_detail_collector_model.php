<?php
class Bill_detail_collector_model extends CI_Model {

private $primary_key='id';
private $table_name='bill_detail_collector';
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
		if($data['invoice_date'])$data['invoice_date']= date('Y-m-d H:i:s', strtotime($data['invoice_date']));
        $data["create_by"]=user_id();
        $data["create_date"] = date('Y-m-d H:i:s');        
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		if($data['invoice_date'])$data['invoice_date']= date('Y-m-d H:i:s', strtotime($data['invoice_date']));
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		$this->recalc($id);
		return $ok;
	}
	function delete($id){	
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
}	 
