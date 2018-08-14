<?php
class Leaves_model extends CI_Model {

private $primary_key='id';
private $table_name='hr_leaves';

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
	if(isset($data['from_date']))$data['from_date']= date('Y-m-d H:i:s', strtotime($data['from_date']));
	if(isset($data['to_date']))$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));

    
    if($data["doc_type"]=="SALDO")$this->db->where("nip",$data["nip"])
        ->update("employee",array("sisa_cuti"=>$data["leave_day"]));


    $this->db->insert($this->table_name,$data);
    
	return $this->db->insert_id();
}
function update($id,$data){
	if(isset($data['from_date']))$data['from_date']= date('Y-m-d H:i:s', strtotime($data['from_date']));
	if(isset($data['to_date']))$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));
	$this->db->where($this->primary_key,$id);
	$ok= $this->db->update($this->table_name,$data);
    
    
    if($data["doc_type"]=="SALDO")$this->db->where("nip",$data["nip"])
        ->update("employee",array("sisa_cuti"=>$data["leave_day"]));

    return $ok;
    
}
function delete($id){
	$this->db->where($this->primary_key,$id);
	return $this->db->delete($this->table_name);
}
 
	
}
