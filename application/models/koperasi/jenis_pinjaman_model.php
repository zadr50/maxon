<?php
class Jenis_pinjaman_model extends CI_Model {

private $primary_key='nama';
private $table_name='kop_jenis_pinjaman';

	function __construct(){
		parent::__construct();        
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}

	function save($data){
		 
		$id=$this->db->insert($this->table_name,$data);
		return $id;
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$id=$this->db->update($this->table_name,$data);
		return $id;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function item_list(){
		$query=$this->db->query("select nama from kop_jenis_pinjaman order by nama");
		$ret=array();
		$ret['']='- Select -';
 		foreach ($query->result() as $row)
		{
			$ret[$row->nama]=$row->nama;
		}		 
		return $ret;
	}	
	
}
