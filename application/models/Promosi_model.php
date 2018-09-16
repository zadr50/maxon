<?php
class Promosi_model extends CI_Model {

	private $primary_key='promosi_code';
	private $table_name='promosi_disc';
	public $fields=null;

	function __construct(){
		parent::__construct();        
       
        
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function datalist(){
		$ret['']='- Select -';
		if($query=$this->db->get($this->table_name))
		{
			foreach ($query->result() as $row){
				$ret[$row->kode]=$row->category;
			}
		}			
		return $ret;
	}	
	function discount_save($data){
		$q=$this->db->select("id")->where("cust_no",$data['cust_no'])
			->where("category",$data["cat"])
			->get("inventory_price_customers");
		$d['cust_no']=$data['cust_no'];
		$d['sales_price']=$data['price'];
		$d['disc_prc_to']=$data['disc_prc'];
		$d['disc_amount']=$data['disc_amt'];
		$d['disc_prc_2']=$data['disc_prc_2'];
		$d['disc_prc_3']=$data['disc_prc_3'];
		$d['min_qty']=$data['min_qty'];
		 
		if($q->num_rows()){
			$id=$q->row()->id;
			return $this->db->where("id",$id)->update("inventory_price_customers",$d);
		} else {
			$d['category']=$data['cat'];
			$d['description']=$this->db->where("kode",$d["category"])->get($this->table_name)->row()->category;
			$q=$this->db->insert("inventory_price_customers",$d);
			return $this->db->insert_id();
		}
	}
	function discount_list($cust_no)
	{
		$ret=false;
		$data=array();
		if($q=$this->db->where("cust_no",$cust_no)->get("inventory_price_customers"))
		{
			foreach($q->result() as $row){
				$data[]=array('kode'=>$row->category,
					'category'=>$row->description,
					'price'=>$row->sales_price,
					'disc_prc'=>$row->disc_prc_to,
					'disc_prc_2'=>$row->disc_prc_2,
					'disc_prc_3'=>$row->disc_prc_3,
					'disc_amount'=>$row->disc_amount,
					'min_qty'=>$row->min_qty,
					'id'=>$row->id);
			}
		}
		return $data;
	}
	function discount_delete($rowid){
		return $this->db->where("id",$rowid)->delete("inventory_price_customers");	
	}
	function promo_qty_extra($item_number,$qty_sold){
		$ret=0;
		$sql="select extra_items,min_qty from promosi_item where disc_type=2 
		and item_number='$item_number' 
		and (now() between from_date and to_date)";
		if($q=$this->db->query($sql)){
			if($row=$q->row()){
				if($qty_sold>=$row->min_qty){
					$ret=($qty_sold/$row->min_qty)*$row->extra_items;
				}
			}
		}
		return $ret;
	}
	
}