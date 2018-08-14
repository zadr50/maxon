<?php
class Inventory_card_header_model extends CI_Model {

private $primary_key='shipment_id';
private $table_name='inventory_card_header';
public $amount=0;
public $shipment_id='';

function __construct(){
	parent::__construct();        
  
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
                $this->shipment_id=$id;
                $this->recalc();
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
        function recalc(){
            $this->db->where($this->primary_key,$this->shipment_id);
            $q=$this->db->get($this->table_name);
            $recv=$q->result();
            $this->db->where($this->primary_key,$this->shipment_id);
            $query=$this->db->get('inventory_products');
            $this->amount=0;
            foreach ($query->result() as $row)
            {
               if($row->cost==0){
                    $this->db->where('item_number',$row->item_number);
                    $q=$this->db->get('inventory');
                    $stock=$q->result();
                    if(count($stock)){
                        $row->cost=$stock[0]->cost;
                        if($row->cost==0)$row->cost=$stock[0]->cost_from_mfg;
                        $row->unit=$stock[0]->unit_of_measure;
                    };
                    $row->total_amount=$row->quantity_received*$row->cost;
               }
                $row->date_received=$recv[0]->date_received;
                $row->supplier_number=$recv[0]->supplier_number;
                $this->db->where('id',$row->id);
                $this->db->update('inventory_products',$row);
                $this->amount=$this->amount+$row->total_amount;
            };
             
            return $this->amount;
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
		$this->db->where('shipment_id',$id);
		$this->db->delete('inventory_products');
	}
	function supplier_list(){
		$query=$this->db->query("select supplier_number,supplier_name from suppliers");
		$ret=array();
		$ret['']='- Select Supplier -';
 		foreach ($query->result() as $row)
		{
			$ret[$row->supplier_number]=$row->supplier_name;
		}		 
		return $ret;
	}
        
	function add_item($data){
            $this->db->insert('inventory_products',$data);
            return $this->db->insert_id();
        } 		

}
