<?php
class Inventory_assembly_model extends CI_Model {

private $primary_key='item_number';
private $table_name='inventory_assembly';

function __construct(){
	parent::__construct();        
      
    
}
	function save($data){
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$item_asm=$data['assembly_item_number'];
		unset($data['assembly_item_number']);
		return $this->db->where($this->primary_key,$id)
			->where("assembly_item_number",$item_asm)
			->update($this->table_name,$data);
		
	}
	function delete($item_number,$kode){
		$this->db->query("delete from inventory_assembly where item_number='".$item_number."' 
		and (assembly_item_number='".$kode."' or assembly_item_number is NULL) ");
		return true;
	}
	function get_by_id($item_number,$assembly_item_number){
		$sql="select a.assembly_item_number,i.description,a.default_cost,
		a.quantity,a.comment from inventory_assembly a 
		left join inventory i on i.item_number=a.item_number 
		where a.item_number='".$item_number
		."' and a.assembly_item_number='".$assembly_item_number."'";
		return $this->db->query($sql);
	}
	function get_by_parent($item_number){
		$sql="select a.assembly_item_number,i.description,a.default_cost,
		a.quantity,a.comment,i.unit_of_measure as unit  from inventory_assembly a 
		left join inventory i on i.item_number=a.item_number 
		where a.item_number='".$item_number."'";
		return $this->db->query($sql);
	}
	function recalc_cost($item_number){
		$sql="select sum(a.default_cost) as z_total_cost 
		from inventory_assembly a where a.item_number='".$item_number."'";
		$cost=$this->db->query($sql)->row()->z_total_cost;
		if($cost>0){
			$this->db->where("item_number",$item_number)->update("inventory",
				array("cost"=>$cost));
		}
		
	}

}
