<?php
class Inventory_suppliers_model extends CI_Model {

private $primary_key='item_number';
private $table_name='inventory_suppliers';

function __construct(){
	parent::__construct();        
     
}
	function save($data){
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$supp=$data['supplier_number'];
		unset($data['supplier_number']);
		unset($data['item_number']);
		return $this->db->where($this->primary_key,$id)
			->where("supplier_number",$supp)
			->update($this->table_name,$data);
	}
	function delete($item_number,$kode){
		$this->db->query("delete from inventory_suppliers where item_number='".$item_number."' 
		and supplier_number='".$kode."'");
		return true;
	}
	function get_by_id($item_number,$supplier_number){
		$sql="select a.supplier_number,a.lead_time,a.cost,a.supplier_item_number
		,s.supplier_name from inventory_suppliers  a 
		left join suppliers s on s.supplier_number=a.supplier_number 
		where a.item_number='".$item_number."' and a.supplier_number='".$supplier_number."'";
		return $this->db->query($sql);
	}

}
