<?php
class Leaves_model extends CI_Model {

private $primary_key='id';
private $table_name='hr_leaves';

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
	if(isset($data['from_date']))$data['from_date']= date('Y-m-d H:i:s', strtotime($data['from_date']));
	if(isset($data['to_date']))$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function update($id,$data){
	if(isset($data['from_date']))$data['from_date']= date('Y-m-d H:i:s', strtotime($data['from_date']));
	if(isset($data['to_date']))$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));
	$this->db->where($this->primary_key,$id);
	return $this->db->update($this->table_name,$data);
}
function delete($id){
	$this->db->where($this->primary_key,$id);
	return $this->db->delete($this->table_name);
}
 
	
}
