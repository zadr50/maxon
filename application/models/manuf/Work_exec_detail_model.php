<?php
class Work_exec_detail_model extends CI_Model {

private $primary_key='id';
private $table_name='work_exec_detail';

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
	$data['price']=0;
	$data['total']=0;
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function update($id,$data){
	$data['price']=0;
	$data['total']=0;
	$this->db->where($this->primary_key,$id);
	return $this->db->update($this->table_name,$data);
}
function delete($id){
	$this->db->where($this->primary_key,$id);
	return $this->db->delete($this->table_name);
}
function lineitems($wo){
	$this->db->where('work_exec_no',$wo);
	return $this->db->get($this->table_name);
}
function update_items($exec_no) {
	if($q=$this->lineitems($exec_no)){
		foreach($q->result() as $row){
			if($row->price==null){
				$qstk=$this->db->query("select cost from inventory where item_number='".$row->item_number."'")->row();
				$data['price']=$qstk->cost;
				$data['total']=$qstk->cost*$row->quantity;
				$this->update($row->id,$data);		
				
			}
		}
	}
}
}