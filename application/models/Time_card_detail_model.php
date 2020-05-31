<?php
class Time_card_detail_model extends CI_Model {

private $primary_key='id';
private $table_name='time_card_detail';

	function __construct(){
		parent::__construct();        
	        
	    
	}
	function get_id($nip,$tanggal){
		$ret=0;
		$s="select id from time_card_detail where nip='$nip' and tanggal='$tanggal'";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$ret=$r->id;
			}
		}
		return $ret;
	}
	function save($data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		$id=$this->get_id($data['nip'],$data['tanggal']);
		if($id>0){
			$ok = $this->update($id,$data);
		} else  {
			$ok = $this->db->insert($this->table_name,$data);			
		}	
		return $ok;
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
