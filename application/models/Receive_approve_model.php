<?php
class Receive_approve_model extends CI_Model {

function __construct(){
	parent::__construct();        
       
    
}
	function get_list()
	{
		$this->db->select('p.item_number,i.description,
		p.quantity_received as quantity,
		p.unit,p.id');
		$this->db->join('inventory i','p.item_number=i.item_number');
		$this->db->where($this->primary_key,$id);
		if (empty($order_column)||empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else {
			if($order_column=='item_number')$order_column='p.'.$order_column;
			$this->db->order_by($order_column,$order_type);
		}
		return $this->db->get($this->table_name.' p',$limit,$offset);
	}
	 

}
