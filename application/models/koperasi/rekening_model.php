<?php
class Rekening_model extends CI_Model {

private $primary_key='nomor';
private $table_name='kop_simpanan';

	function __construct(){
		parent::__construct();        
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}

	function save($data){
		if(isset($data['tanggal_daftar']))$data['tanggal_daftar']= date('Y-m-d H:i:s', strtotime($data['tanggal_daftar']));		
		$id=$this->db->insert($this->table_name,$data);
		return $id;
	}
	function update($id,$data){
		if(isset($data['tanggal_daftar']))$data['tanggal_daftar']= date('Y-m-d H:i:s', strtotime($data['tanggal_daftar']));		
		$this->db->where($this->primary_key,$id);
		$id=$this->db->update($this->table_name,$data);
		return $id;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
}
