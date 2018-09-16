<?php
class Customer_type_model extends CI_Model {

	private $primary_key='type_id';
	private $table_name='customer_type';
	public $fields=null;

	function __construct(){
		parent::__construct();
		
		$this->fields[]=array('name'=>'type_id','type'=>"nvarchar",'size'=>50,'caption'=>"Kode",'control'=>'text');
		$this->fields[]=array('name'=>'type_name','type'=>'nvarchar','size'=>50,'caption'=>"Nama Kelompok",'control'=>'text');
		
		$this->load->dbforge();
		if(!$this->db->table_exists($this->table_name)){	
			foreach($this->fields as $fld){
				$size="";$type=$fld['type'];
				if($fld['type']=="nvarchar")$size="(".$fld['size'].")";
				if($fld['name']=="id"){	$type="";} else {$type =" ".$type.' '.$size;}
				$this->dbforge->add_field($fld['name'].$type);
			}
			$this->dbforge->add_key($this->primary_key,TRUE);
			$this->dbforge->create_table($this->table_name);
		}	
	}
	function get_paged_list($limit=100,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['type_name']))$nama=$_GET['type_name'];
		if($nama!='')$this->db->where("type_name like '%$nama%'");
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
		$this->db->where(	$this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function get_price($cust_type,$item)
	{
		$retval=null;
		if($q=$this->db->where("cust_type",$cust_type)
			->where("item_no",$item)->get("inventory_price_customers"))
		{
			$retval=$q->row();
		}
		return $retval;
	}
	function get_prices($cust_type){
		$retval=array();
		$sql="select i.item_number,i.description,i.retail,ipc.*
			from inventory i join inventory_price_customers ipc 
			on i.item_number=ipc.item_no where ipc.cust_type='$cust_type'";
		if(!$query=$this->db->query($sql)){
			foreach($query->result_array() as $row){
				$retval[]=$row;
			}
		}
		
		return $retval;
	}
}

?>