<?php
class Payroll_model extends CI_Model {
function __construct(){
	parent::__construct();        
       
}		
function list_componen(){
	$query=$this->db->query("select kode,keterangan from jenis_tunjangan");
	$ret=array();$ret['']='- Select -';
	if($query)foreach ($query->result() as $row){$ret[$row->kode]=$row->keterangan;}		 

	$query=$this->db->query("select kode,keterangan from jenis_potongan");
	if($query)foreach ($query->result() as $row){$ret[$row->kode]=$row->keterangan;}		 

	return $ret;	
} 
}