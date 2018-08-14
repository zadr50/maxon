<?php
class Periode_model extends CI_Model {

private $primary_key='period';
private $table_name='hr_period';

function __construct(){
	parent::__construct();        
       
    
	$this->check_this_year();
}
function check_this_year(){
	$year=date("Y");
	for($bln=1;$bln<=12;$bln++){
		$period=$year."-".strzero($bln,2);
		if(!$this->exist($period)){
			$last_date=date("Y-m-t", strtotime($year."-".strzero($bln,2)."-01"));	//lastday
			$this->save(array(
				"period"=>$period,"period_name"=>date("M",strtotime($last_date)),
				"from_date"=>$year."-".strzero($bln,2)."-01 00:00:00",
				"to_date"=>$last_date." 23:59:59",
				"status"=>0)			
			);
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

function exist($id){
   return $this->db->count_all($this->table_name." where period='".$id."'")>0;
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
function dropdown(){
        $query=$this->db->query("select period from ".$this->table_name);
        $ret=array();
        $ret['']='- Select -';
        foreach ($query->result() as $row) {
                $ret[$row->period]=$row->period;
        }		 
        return $ret;
}
function current_periode(){
	$this->db->where("status=0");
	$this->db->order_by("period","desc");
	$q=$this->db->get($this->table_name);
	if($q){
		return $q->row()->period;
	} else {
		return '';
	}
}
	function closed($date_trans)
	{
		$retval=false;
		$sql="select status from hr_period where '".$date_trans."' 
			between from_date and to_date";
	
		$q=$this->db->query($sql);
		if($q){
			if($q->row())$retval=$q->row()->closed;
		}
		return $retval;
	}
	function loadlist() {
		$rows=null;
		$this->db->order_by("period");
		if($q=$this->db->get($this->table_name)){
			foreach($q->result() as $r) {
				$rows[]=$r;
			}
		}
		return $rows;
	}
	
}
