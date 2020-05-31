<?php
class Receive_item_model extends CI_Model {

private $primary_key='shipment_id';
private $table_name='inventory_products';

function __construct(){
	parent::__construct();        
      
}
	function get_paged_list($id,$limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
		$this->db->select('p.item_number,i.description,p.quantity_received as quantity,p.unit,p.id');
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
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
        $item_no=$data['item_number']; 
        item_need_update($item_no);
        item_need_update_arsip($item_no, $data['warehouse_code'], $data['date_received']);
				
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
	    
        
        $item_no=$data['item_number']; 
        item_need_update($item_no);
        item_need_update_arsip($item_no, $data['warehouse_code'], $data['date_received']);
    
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function delete_by_id($id){
		$this->db->where('id',$id);
		$this->db->delete($this->table_name);
	}
	function item_list(){
		$query=$this->db->query("select item_number,description from inventory");
		$ret=array();
		$ret['']='- Select Item Number -';
 		foreach ($query->result() as $row)
		{
			$ret[$row->item_number]=$row->description;
		}		 
		return $ret;
	}		
    function lookup($set=null){
            $set['dlgBindId']="recv_po";
            if(!isset($set['dlgRetFunc'])){
                $set['dlgRetFunc']="$('#shipment_id').val(row.shipment_id);
                ";
            }
            $set['dlgCols']=array( 
                        array("fieldname"=>"shipment_id","caption"=>"Receive No","width"=>"180px"),
                        array("fieldname"=>"date_received","caption"=>"Date Recv","width"=>"80px"),
                        array("fieldname"=>"supplier_number","caption"=>"Supplier","width"=>"50px"),
                        array("fieldname"=>"purchase_order_number","caption"=>"PO Number","width"=>"100px")
                    );          
        return $this->list_of_values->render($set);
        
    }


}
