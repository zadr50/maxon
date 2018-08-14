<?php
class Payment_model extends CI_Model {

private $primary_key='no_bukti';
private $table_name='payments';

	function __construct(){
		parent::__construct();        
       
		$this->load->model('invoice_model');
		$this->load->model('bank_accounts_model');
		$this->load->model('check_writer_model');
	}       
    function total_amount($faktur){
        $this->db->select("sum(amount_paid) as total_amount");
        $this->db->where("invoice_number",$faktur);
        $this->db->from("payments");
        $row=$this->db->get();
        $r=$row->row();
        return $r->total_amount;
    }
	
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data,$recalc=true){
		$faktur=$data['invoice_number'];
		$data['date_paid']= date('Y-m-d H:i:s', strtotime($data['date_paid']));
		$this->db->insert($this->table_name,$data);
		$id=$this->db->insert_id();
		if($recalc)$this->invoice_model->recalc($faktur);
		return $id;
	}
	function save_pos($data){
		$data['date_paid']= date('Y-m-d H:i:s', strtotime($data['date_paid']));
		$data['no_bukti']=$this->nomor_bukti();
		$id=$this->save($data);
		$this->nomor_bukti(true);
		$this->save_cash_receive($data);
		return $id;
		
	}
	function save_cash_receive($data){
		$rkas['voucher']=$data['no_bukti'];
		$rkas['check_date']=$data['date_paid'];
		$rkas['deposit_amount']=$data['amount_paid'];
		$rkas['payment_amount']=0;
		$rkas['trans_type']=$this->how_paid($data['how_paid']);
		$rkas['account_number']=$this->default_account($rkas['trans_type']);
		$rkas['payee']="CASH";
		$rkas['supplier_number']="CASH";
		$rkas['memo']="Payment Pos ";

		$trans_id=$this->check_writer_model->save($rkas); 	 
				
		
	}
	function default_account($how_paid){
		switch ($how_paid) {
			case 'trans in':
			case 'cheque in':
				$rek_bank=getvar('default_bank_account_number');
				break;
			default:
				$rek_bank=getvar('default_cash_payment_account');
				break;
		}
		
		$account_id=$rek_bank;
			 
		if($bank=$this->bank_accounts_model->get_by_account($account_id)){
			 
			if($rbank=$bank->row()) {
				$rek_bank=$rbank->bank_account_number;
			}
		}		 
		return $rek_bank;
	}
	function how_paid($how_paid){
		$trtype='cash in';
		switch ($how_paid) {
			case 'CARD':
			case 'DEBIT':
				$trtype='trans in';
				break;
			case 'GIRO':
				$trtype='cheque in';
				break;
			default:
				$trtype='cash in';
				break;
		}
		return $trtype;
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function update_id($id,$data){
		$this->db->where("line_number",$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->query("update invoice set paid=false 
			where invoice_number in (select invoice_number from payments 
				where no_bukti='$id')");
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function delete_id($id){
		$this->db->where("line_number",$id);
		return $this->db->delete($this->table_name);
	}
	function nomor_bukti($add=false){
		if($add){
			$this->sysvar->autonumber_inc("AR Payment Numbering");
		} else {
			return $this->sysvar->autonumber("AR Payment Numbering",0,'!ARP~$00001');
		}
	}
}
