<?php
class Bill_detail_model extends CI_Model {

private $primary_key='id';
private $table_name='bill_detail';
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
		if(isset($data['tgl_jth_tempo']))$data['tgl_jth_tempo']= date('Y-m-d H:i:s', strtotime($data['tgl_jth_tempo']));
        $data["create_by"]=user_id();
        $data["create_date"] = date('Y-m-d H:i:s');        
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		if(isset($data['tgl_jth_tempo']))$data['tgl_jth_tempo']= date('Y-m-d H:i:s', strtotime($data['tgl_jth_tempo']));
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
