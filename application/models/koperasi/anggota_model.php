<?php
class Anggota_model extends CI_Model {

private $primary_key='no_anggota';
private $table_name='kop_anggota';
private $little_info="";
	function __construct(){
		parent::__construct();                
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		$retval = $this->db->get($this->table_name);
		if($retval){
			if($r=$retval->row()){
				$this->little_info=$r->nama." - ".$r->street;
			}
		}
		return $retval;
	}
	function get_info(){
		return $this->little_info;
	}

	function save($data){
		if($data['join_date'])$data['join_date']= date('Y-m-d H:i:s', strtotime($data['join_date']));		
		if($data['birth_date'])$data['birth_date']= date('Y-m-d H:i:s', strtotime($data['birth_date']));		
		$id=$this->db->insert($this->table_name,$data);
		return $id;
	}
	function update($id,$data){
		if($id==''){
			return false;
		} else {
			if($data['join_date'])$data['join_date']= date('Y-m-d H:i:s', strtotime($data['join_date']));		
			if($data['birth_date'])$data['birth_date']= date('Y-m-d H:i:s', strtotime($data['birth_date']));	 
			$this->db->where($this->primary_key,$id);
			$id=$this->db->update($this->table_name,$data);
			return $id;
		}
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function info($id){
		$ang=$this->get_by_id($id)->row();
		return $ang->nama.' '.$ang->street;
	}
	
}
