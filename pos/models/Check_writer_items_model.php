<?php
class Check_writer_items_model extends CI_Model {

	private $primary_key='line_number';
	private $table_name='check_writer_items';

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
	
	function save($data){
		$voucher=$data['voucher'];
		$type=$data['memo'];
		$amount=$data['deposit_amount']+$data['payment_amount'];
		$trans_id=$data['trans_id'];
		$account_id=0;
		$invoice_number="";
		$account="";
		$description="";
		$how_paid="CASH";
		if($type=="Payment Pos "){
			
			$s="select i.invoice_number,i.account_id,c.account,c.account_description,p.how_paid
				from invoice i left join payments p 
				on i.invoice_number=p.invoice_number 
				left join chart_of_accounts c on c.id=i.account_id
				where p.no_bukti='$voucher' ";
			if($q=$this->db->query($s)){
				if($r=$q->row()){
					$invoice_number=$r->invoice_number;
					$how_paid=$r->how_paid;
					if($account_id2=$r->account_id){
						$account_id=$account_id;
						$account=$r->account;
						$description=$r->account_description;
						
					}
				}
			}
		}
		$ret_line_number=0;
		$line_number=0;
		$s="select cwi.line_number from check_writer_items cwi 
			left join check_writer cw on cw.trans_id=cwi.trans_id 
			where cw.voucher='$voucher' ";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$line_number=$r->line_number;
			}
		}

		$cwi['trans_type']=$how_paid;
		$cwi['trans_id']=$trans_id; 
		$cwi['account_id']=$account_id;
		$cwi['account']=$account;
		$cwi['description']=$description;
		$cwi['invoice_number']=$invoice_number;
		$cwi['amount']=$amount;
		if($line_number==0){
			$this->db->insert($this->table_name,$cwi);
			$ret_line_number = $this->db->insert_id();
					
		} else {
			$ret_line_number=$line_number;
			$this->db->where("line_number",$line_number)->update($this->table_name,$cwi);
		}
		return $ret_line_number;
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}

}
