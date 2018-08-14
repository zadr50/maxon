<?php
class Inventory_products_model extends CI_Model {

private $primary_key='shipment_id';
private $table_name='inventory_products';

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
		$this->load->model("inventory_model");
		$this->load->model("inventory_prices_model");
		$itemno=$data['item_number'];
		$item=$this->inventory_model->get_by_id($itemno)->row();
		if($item){			 
			if(trim($data['unit'])=="") $data['unit']=$item->unit_of_measure;
			if($data['cost']=="") $data['cost']=$item->cost;
			if($data['cost']==0) $data['cost']=$item->cost;
		}

		$data['date_received']= date( 'Y-m-d H:i:s', strtotime($data['date_received']));
		
		// apabila default satuan tidak sama dg inputan 
		$lFoundOnPrice=false;
		if($item){
			if($item->unit_of_measure!=$data['unit']) {
				if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
					$data['unit'])->row())
				{
					 
					$lFoundOnPrice=true;
					if($unit_price->quantity_high>0) $data['mu_qty']=$data['quantity_received']*$unit_price->quantity_high;
					$data['mu_price']=$item->cost_from_mfg;
					if($data['mu_price']==0)$data['mu_price']=$item->cost;			
					$data['multi_unit']=$item->unit_of_measure;			
				}
			}
		}
		if($unit=exist_unit($data['unit']) && !$lFoundOnPrice ){
			$lFoundOnPrice=true;
			$data['mu_qty']=$data['quantity_received']*$unit['unit_value'];
			$data['mu_price']=item_cost($data['item_number']);
			$data['multi_unit']=$unit['from_unit'];					
		} 
		if(!$lFoundOnPrice){
			$data['mu_qty']=$data['quantity_received'];
			$data['mu_price']=$data['cost'];
			$data['multi_unit']=$data['unit'];
		}	

		$data['total_amount']=floatval($data['quantity_received'])*floatval($data['cost']);
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->load->model("inventory_model");
		$this->load->model("inventory_prices_model");
		$itemno=$data['item_number'];
		$item=$this->inventory_model->get_by_id($itemno)->row();
		if($item){			 
			 
			if(trim($data['unit'])=="") $data['unit']=$item->unit_of_measure;
			if($data['cost']=="") $data['cost']=$item->cost;
			if($data['cost']=="0") $data['cost']=$item->cost;
		}
		
		$data['date_received']= date( 'Y-m-d H:i:s', strtotime($data['date_received']));
		// apabila default satuan tidak sama dg inputan 
		$lFoundOnPrice=false;
		if($item){
			if($item->unit_of_measure!=$data['unit']) {
				if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
					$data['unit'])->row())
				{
					$lFoundOnPrice=true;
					if($unit_price->quantity_high>0) $data['mu_qty']=$data['quantity_received']*$unit_price->quantity_high;
					$data['mu_price']=$item->cost_from_mfg;
					if($data['mu_price']==0)$data['mu_price']=$item->cost;			
					$data['multi_unit']=$item->unit_of_measure;			
				}
			}
		}
		if($unit=exist_unit($data['unit']) && !$lFoundOnPrice ){
			$lFoundOnPrice=true;
			$data['mu_qty']=$data['quantity_received']*$unit['unit_value'];
			$data['mu_price']=item_cost($data['item_number']);
			$data['multi_unit']=$unit['from_unit'];					
		} 
		if(!$lFoundOnPrice){
			$data['mu_qty']=$data['quantity_received'];
			$data['mu_price']=$data['cost'];
			$data['multi_unit']=$data['unit'];
		}	
		$data['total_amount']=floatval($data['quantity_received'])*floatval($data['cost']);
		$this->db->where("id",$id);
		return $this->db->update($this->table_name,$data);
	}
	function validate_delete_receive_po($nomor_receive)
	{
		$cnt=$this->db->query("select count(1) as cnt from purchase_order_lineitems pol
			join inventory_products ip on ip.id=pol.from_line_number
			where ip.shipment_id='$nomor_receive'")->row()->cnt;
		if(intval($cnt)>0) {
			return false;
		} else {
			return true;
		}
	}
	function has_invoice($shipment_id){
		return $this->validate_delete_receive_po($shipment_id);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function delete_by_id($id){
		$this->db->where('id',$id);
		$this->db->delete($this->table_name);
	}
	function delete_item($id){
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	function list_receive($purchase_order_number)
	{
		$query=$this->db->query("select distinct shipment_id,
			date_received,warehouse_code,receipt_by 
			from inventory_products
			where receipt_type='PO' 
			and purchase_order_number='$purchase_order_number'");
		return $query;
	}

}
?>