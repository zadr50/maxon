<?php
class Shift_model extends CI_Model {

	private $primary_key='kode';
	private $table_name='hr_shift';
	
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
		if($data['different_day']=='0')$data['different_day']='';
		$ok=$this->db->insert($this->table_name,$data);
		return $ok;
	}
	function update($id,$data){
		if($data['different_day']=='0')$data['different_day']='';
		$this->db->where($this->primary_key,$id);
		$ok= $this->db->update($this->table_name,$data);
		return $ok;
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->delete($this->table_name);
		return $ok;
	}	
	function lookup(){
		$query=$this->db->query("select kode,time_in,time_out from ".$this->table_name);
		$ret=array();$ret['']='- Select -';
		if($query)foreach ($query->result() as $row){$ret[$row->kode]=$row->kode;}		 
		return $ret;
	}

	
}