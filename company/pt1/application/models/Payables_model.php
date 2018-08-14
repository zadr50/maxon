<?php
class Payables_model extends CI_Model {

private $primary_key='bill_id';
private $table_name='payables';

    function __construct(){
            parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
            
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
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function get_bill_id($invoice)
	{
		$this->db->where('purchase_order_number',$invoice);
		$row=$this->db->get($this->table_name)->row();
		return $row==true?$ret=doubleval($row->bill_id):0;
	}
	
}
