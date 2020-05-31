<?php
class Check_writer_items_model extends CI_Model {

	private $primary_key='line_number';
	private $table_name='check_writer_items';
	public $amount_total=0;
	private $trans_id=0;
	private $trans_type='';

	function __construct(){
		parent::__construct();        
        $this->load->model(array("check_writer_model"));
        
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_by_trans_id($id) {
		$this->db->where("trans_id",$id);
		return $this->db->get($this->table_name);
	}
	function list_by_trans_id($id) {
		$sql="select i.line_number,i.account_id,c.account,c.account_description,
			i.invoice_number,i.amount,i.comments
			from check_writer_items i 
			left join chart_of_accounts c on c.id=i.account_id
			where i.trans_id='$id'";
		echo datasource($sql);
	}
	function get_trans_id($trans_id){
		if($trans_id>0){
			if($q=$this->check_writer_model->get_by_trans_id($this->trans_id)){
				if($r=$q->row()){
					$this->trans_type=$r->trans_type;
				}
			}
		}
		
	}
	function save($data){
		$this->trans_id=$data['trans_id'];
		$this->get_trans_id($this->trans_id);
		$this->db->insert($this->table_name,$data);
		$id =  $this->db->insert_id();
		$this->recalc_total();
		return $id;
	}
	function update($id,$data){		
		$this->trans_id=$data['trans_id'];
		$this->get_trans_id($this->trans_id);
		
		$this->db->where($this->primary_key,$id);
		$ok = $this->db->update($this->table_name,$data);
		$this->recalc_total();
		return $ok;
	}
	function recalc_total(){
		$s="select sum(coalesce(amount,0)) as amount_total from check_writer_items 
			where trans_id='$this->trans_id'";
		$this->amount_total=$this->db->query($s)->row()->amount_total;
		$fld='payment_amount';
		if($this->trans_type=="cash in" || $this->trans_type=='trans in' || $this->trans_type=='cheque in'){
			$fld='deposit_amount';
		}
		$s="update check_writer set $fld='$this->amount_total' where trans_id='$this->trans_id' ";
		$this->db->query($s);
		
	}
	function delete($id){
		$s="select h.trans_id,h.trans_type from check_writer h 
		left join check_writer_items d on d.trans_id=h.trans_id 
			where d.line_number='$id' ";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$this->trans_id=$r->trans_id;
				$this->trans_type=$r->trans_type;
			}
		}
		
		
		$this->db->where($this->primary_key,$id);
		$ok = $this->db->delete($this->table_name);
		
		$this->recalc_total();
		
		return $ok;
	}

}
