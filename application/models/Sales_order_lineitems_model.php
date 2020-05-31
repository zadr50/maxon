<?php
class Sales_order_lineitems_model extends CI_Model {

private $primary_key='line_number';
private $table_name='sales_order_lineitems';
private $sales_order_number=0;
private $line_number=0;

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
	function set_no_urut(){
		$no_urut=0;
		$s="select line_number,no_urut from sales_order_lineitems where sales_order_number='$this->sales_order_number' ";
		if($q=$this->db->query($s)){
			foreach($q->result() as $r){
				$no_urut++;
				if($r->no_urut==''){
					$s="update sales_order_lineitems set no_urut='$no_urut' where line_number='$r->line_number' ";
					$this->db->query($s);
				}
			}
		}
	}

function save($data){
    
    $item_no=$data['item_number']; 
    item_need_update($item_no);
    
    if(!isset($data['warehouse_code']))$data['warehouse_code']=current_gudang();
    
	$tanggal="";
	$gudang="";
	$sales_order_number=$data['sales_order_number'];
	
    $this->sales_order_number=$sales_order_number;
	
	if($qinv=$this->db->query("select p.sales_date,pl.warehouse_code from sales_order p 
		left join sales_order_lineitems pl on pl.sales_order_number=p.sales_order_number 
		where p.sales_order_number='$sales_order_number' ")){
			if($rinv=$qinv->row()){
				$tanggal=$rinv->sales_date;
				$gudang=$rinv->warehouse_code;
			}
		}
	item_need_update_arsip($item_no, $gudang, $tanggal);
	
	$this->db->insert($this->table_name,$data);
	$line_number = $this->db->insert_id();	 
	$this->line_number=$line_number;
	$this->set_no_urut();
	return $line_number;
	
}
function update($id,$data){
     $item_no=$data['item_number']; 
     item_need_update($item_no);
    if(!isset($data['warehouse_code']))$data['warehouse_code']=current_gudang();
	$tanggal="";
	$gudang="";
	$sales_order_number=$data['sales_order_number'];
	if($qinv=$this->db->query("select p.sales_date,pl.warehouse_code from sales_order p 
		left join sales_order_lineitems pl on pl.sales_order_number=p.sales_order_number
			where p.sales_order_number='$sales_order_number' ")){
			if($rinv=$qinv->row()){
				$tanggal=$rinv->sales_date;
				$gudang=$rinv->warehouse_code;
			}
		}
	item_need_update_arsip($item_no, $gudang, $tanggal);
     
	$this->db->where($this->primary_key,$id);
	return $this->db->update($this->table_name,$data);
}
function delete($id){
	$this->db->where($this->primary_key,$id);
	return $this->db->delete($this->table_name);
}
function lineitems($sales_order_number){
    
	$this->db->where('sales_order_number',$sales_order_number);
	return $this->db->get($this->table_name);
}
function total_amount($nomor)
{
	return (double)$this->db->query("select sum(amount) as sum_total_price 
		from sales_order_lineitems 
        where sales_order_number='".$nomor."'")->row()->sum_total_price;
}
function browse($nomor)
{
	$sql="select p.item_number,i.description,p.quantity 
	,p.unit,p.price,p.discount,p.amount,coa.account,coa.account_description,p.line_number
	from sales_order_lineitems p
	left join inventory i on i.item_number=p.item_number
	left join chart_of_accounts coa on coa.id=p.revenue_acct_id
	where sales_order_number='$nomor'";
	$this->load->helper('browse_helper');
	return browse_simple($sql,"Data Barang / Jasa",500,300,"dgItem");
}
}