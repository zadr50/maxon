<?php
class Time_card_detail_model extends CI_Model {

private $primary_key='id';
private $table_name='time_card_detail';

function __construct(){
	parent::__construct();        
        
    
}
	function save($data){
	if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));		
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}

}
