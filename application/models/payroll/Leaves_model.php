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
	$ok = $this->db->insert_id();
	$this->recalc($data['nip']);
    
	return $ok;
}
function update($id,$data){
	if(isset($data['from_date']))$data['from_date']= date('Y-m-d H:i:s', strtotime($data['from_date']));
	if(isset($data['to_date']))$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));
	$this->db->where($this->primary_key,$id);
	$ok= $this->db->update($this->table_name,$data);
    
	$this->recalc($data['nip']);
	
    return $ok;
    
}
function delete($id){
	$nip="";
	if($q=$this->db->query("select nip from hr_leaves where id='$id'")){
		if($r=$q->row()){
			$nip=$r->nip;
		}
	}
	
	$this->db->where($this->primary_key,$id);
	$ok = $this->db->delete($this->table_name);
	
	if($nip!=""){
		$this->recalc($nip);
	}
	return $ok;
}
function recalc($nip){
    $s="select sum(if(s.plus_minus=1,-1,1)*h.leave_day) as sisa  
	from hr_leaves h
	left join (select * from system_variables 
	where varname='lookup.doc_type_cuti') s on s.varvalue=h.doc_type
	where h.nip='$nip' ";
	$sisa=0;
    if($q=$this->db->query($s)){
        $sisa=$q->row()->sisa;
    }
	$s="update employee set sisa_cuti='$sisa' where nip='$nip'";
	$this->db->query($s);
	return $sisa;	
} 
	
}
