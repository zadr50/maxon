<?php
class Payables_bill_detail_model extends CI_Model {

private $primary_key='id';
private $table_name='payables_bill_detail';
	function __construct(){
		parent::__construct();        
       
        
	}
	 
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
	    $nama='';
	    if(isset($_GET['nama'])) $nama=$_GET['nama'];
	    $this->db->select('nomor,tanggal,tgl_jth_tempo,supplier_number,supplier_name');
	    $this->db->from($this->table_name);
	    if($nama!='') $this->db->where("supplier_number like '%$nama%' 
	            or nomor like '%$nama%'
	            ");
	    if (empty($order_column)||empty($order_type))
	    { 
	        $this->db->order_by($this->primary_key,'asc');
	    } else {
	        $this->db->order_by($order_column,$order_type);
	    }
	    return $this->db->get('',$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		if(isset($data['tgl_jth_tempo']))$data['tgl_jth_tempo']= date('Y-m-d H:i:s', strtotime($data['tgl_jth_tempo']));
        $data["create_by"]=user_id();
        $data["create_date"] = date('Y-m-d H:i:s');
        
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		if(isset($data['tgl_jth_tempo']))$data['tgl_jth_tempo']= date('Y-m-d H:i:s', strtotime($data['tgl_jth_tempo']));
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		$this->recalc($id);
		return $ok;
	}
	function delete($id){	
		$this->db->where($this->primary_key,$id);
		$this->db->delete('payables_bill_detail');        
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function recalc($id){
		$total=$this->db->query("select sum(jumlah) as z from payables_bill_detail where nomor='$id'")->row()->z;
		$this->db->query("update payables_bill_header set amount='$total' where nomor='$id'");
		return true;
	}
}	 
