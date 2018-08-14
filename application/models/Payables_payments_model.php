<?php
class Payables_payments_model extends CI_Model {

private $primary_key='no_bukti';
private $table_name='payables_payments';
 
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
		$this->load->model('purchase_order_model');
		$no_bukti=$data['purchase_order_number'];
		if($data['date_paid'])$data['date_paid']= date('Y-m-d H:i:s', strtotime($data['date_paid']));
		$ok=$this->db->insert($this->table_name,$data);
		//return $this->db->insert_id();
		
		$this->purchase_order_model->recalc($no_bukti);
		return $ok;
	}
	function update($id,$data){
		if($data['date_paid'])$data['date_paid']= date('Y-m-d H:i:s', strtotime($data['date_paid']));
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($no_bukti){
		$this->db->where($this->primary_key,$no_bukti);
		$this->db->delete($this->table_name);
	}
	function delete_line($id){
		$this->db->where('line_number',$id);
		$this->db->delete($this->table_name);
	}
    function total_amount($faktur){
        $this->db->select("sum(amount_paid) as total_amount");
        $this->db->where("purchase_order_number",$faktur);
        $this->db->from($this->table_name);
        $row=$this->db->get();
        $r=$row->row();
        return floatval($r->total_amount);
    }
	function browse($purchase_order_number)
	{
		$sql="select p.no_bukti,p.date_paid,p.how_paid,p.how_paid_account_id,
		p.amount_paid,p.paid_by,p.check_number
		from payables_payments p 
		where purchase_order_number='$purchase_order_number'";
		$this->load->helper('browse_helper');
		return browse_simple($sql,"Data Pembayaran",500,300,"dgPay");
	}
}
