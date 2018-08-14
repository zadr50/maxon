<?php
class Inventory_prices_model extends CI_Model {

private $primary_key='item_number';
private $table_name='inventory_prices';

function __construct(){
	parent::__construct();        

}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
        $nama='';
        if(isset($_GET['nama'])){
            $nama=$_GET['nama'];
        }
        if($nama!='')$this->db->where("class like '%$nama%'");

		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($item_number,$customer_pricing_code){
		return $this->db->where($this->primary_key,$item_number)
			->where("customer_pricing_code",$customer_pricing_code)
			->get($this->table_name);
	}
	function save($data){
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$satuan=$data['customer_pricing_code'];
		unset($data['customer_pricing_code']);
		unset($data['item_number']);
		return $this->db->where($this->primary_key,$id)
			->where("customer_pricing_code",$satuan)
			->update($this->table_name,$data);
	}
	function delete($item_number,$unit){
		$this->db->query("delete from inventory_prices where item_number='".$item_number."' 
		and (customer_pricing_code='".$unit."' or customer_pricing_code is null)");
		return true;
	}

}
