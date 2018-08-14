<?php
class Gl_projects_model extends CI_Model {

private $primary_key='kode';
private $table_name='gl_projects';

function __construct(){
	parent::__construct();        
       
    
}
	function lookup(){
			$query=$this->db->query("select kode,keterangan from gl_projects");
			$ret=array();
			$ret['']='- Select -';
			foreach ($query->result() as $row)
			{
					$ret[$row->kode]=$row->keterangan;
			}		 
			return $ret;
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){           
		$data['tgl_mulai']=date('Y-m-d H:i:s',strtotime($data['tgl_mulai']));
		$data['tgl_selesai']=date('Y-m-d H:i:s',strtotime($data['tgl_selesai']));
		return $this->db->insert($this->table_name,$data);            
		//return $this->db->insert_id();
	}
	function update($id,$data){
		$data['tgl_mulai']=date('Y-m-d H:i:s',strtotime($data['tgl_mulai']));
		$data['tgl_selesai']=date('Y-m-d H:i:s',strtotime($data['tgl_selesai']));
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
}
