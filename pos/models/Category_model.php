<?php
class Category_model extends CI_Model {

private $primary_key='kode';
private $table_name='inventory_categories';

function __construct(){
	parent::__construct();        
      
    
}
	function lov($bind_id,$other=""){
		$this->load->library("list_of_values");
		$setting['dlgBindId']=$bind_id;
		$setting['dlgRetFunc']="$('#".$bind_id."').val(row.kode);";
		if($other!=""){
			$setting['dlgRetFunc']=$setting['dlgRetFunc']."$('#$other').val(row.kode);";
		}
		$setting['dlgCols']=array( 
					array("fieldname"=>"kode","caption"=>"Kode","width"=>"80px"),
					array("fieldname"=>"category","caption"=>"Kelompok","width"=>"200px")
				);			
		$setting['dlgUrlQuery']=base_url()."index.php/category/browse_data/";
		return $this->list_of_values->render($setting);
	}
	
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
                $nama='';
                if(isset($_GET['nama'])){
                    $nama=$_GET['nama'];
                }
                if($nama!='')$this->db->where("category like '%$nama%'");

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
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
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
}
