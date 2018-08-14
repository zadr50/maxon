<?php
class Tracking_model extends CI_Model {

private $primary_key='location';
private $table_name='inventory_products';

function __construct(){
	parent::__construct();        
       
    
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc',$where='')
	{
		if (empty($order_column)||empty($order_type))
			$order=' order by location asc';
		else
			$order=' order by '.$order_column.' asc';

		return $this->db->query("select * from inventory_products ".$where.$order);
		
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}

}
