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
        if(isset($data['bill_id'])){
        	$bill_id=$data['bill_id'];
        	$s="select p.supplier_number from payables_payments pp join payables p 
        		on p.bill_id=pp.bill_id where pp.bill_id='$bill_id' ";
        	if($q=$this->db->query($s)){
        		if($r=$q->row()){
		        	supplier_need_update($r->supplier_number);        			
        		}
        	}
        }
	
				
		$this->purchase_order_model->recalc($no_bukti);
		return $ok;
	}
	function update($id,$data){
	    if(!isset($data['date_paid']))$data['date_paid']= date('Y-m-d H:i:s');
		if($data['date_paid'])$data['date_paid']= date('Y-m-d H:i:s', strtotime($data['date_paid']));
		$this->db->where($this->primary_key,$id);
		$ok = $this->db->update($this->table_name,$data);
		
    	$s="select p.supplier_number from payables_payments pp join payables p on p.bill_id=pp.bill_id 
    		where pp.bill_id='$id' ";
    	if($q=$this->db->query($s)){
    		if($r=$q->row()){
	        	supplier_need_update($r->supplier_number);        			
    		}
    	}
		
		
		return $ok;
	}
	function delete($no_bukti){
		
		
		$this->db->where($this->primary_key,$no_bukti);
		$this->db->delete($this->table_name);
		
		
    	$s="select p.supplier_number from payables_payments pp join payables p on p.bill_id=pp.bill_id 
    		where pp.no_bukti='$no_bukti' ";
    	if($q=$this->db->query($s)){
    		if($r=$q->row()){
	        	supplier_need_update($r->supplier_number);        			
    		}
    	}
		
	}
	function delete_line($id){
		$this->db->where('line_number',$id);
		$ok = $this->db->delete($this->table_name);

    	$s="select p.supplier_number from payables_payments pp join payables p on p.bill_id=pp.bill_id 
    		where pp.line_number='$id' ";
    	if($q=$this->db->query($s)){
    		if($r=$q->row()){
	        	supplier_need_update($r->supplier_number);        			
    		}
    	}
		
		return $ok;
	}
    function total_amount($faktur){
        //$this->db->select("sum(amount_paid) as total_amount");
        //$this->db->where("purchase_order_number",$faktur);
        //$this->db->from($this->table_name);
        //$row=$this->db->get();
		$s="select sum(amount_paid) as total_amount  from payables_payments
		where purchase_order_number='$faktur' 
		and (how_paid not in ('1','GIRO') or (how_paid in ('1','GIRO') and doc_status='1'))";
		$total=0;
		if($q=$this->db->query($s)){
			if($row=$q->row()){
				$total=c_($row->total_amount);
			}
		}
        return floatval($total);
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
