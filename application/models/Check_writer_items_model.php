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

}
