<?php
class Mat_release_detail_model extends CI_Model 
{

	private $primary_key='id';
	private $table_name='mat_release_detail';

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
		$this->load->model('inventory_model');
		if($data['description']==''){
			$item=$this->inventory_model->get_by_id($data['item_number'])->row();
			if($item){
				$data['description']=$item->description;
				if($data['unit']=='')$data['unit']=$item->unit_of_measure;
				if($data['cost']=='0')$data['cost']=$item->cost;
			}
		};
		$data['amount']=$data['cost']*$data['quantity'];
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function delete_by_number($mat_rel_no) {
		$this->db->where('mat_rel_no',$mat_rel_no);
		return $this->db->delete($this->table_name);		
	}
	function exist_item($mat_rel_no,$item_no) {
		$retval=false;
		if($q=$this->db->where("mat_rel_no",$mat_rel_no)
			->where("item_number",$item_no)->get($this->table_name)){
			$retval= $q->num_rows()>0;		
		}
		return $retval;
	}
}