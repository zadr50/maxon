<?php
class Payroll_model extends CI_Model {
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
function list_componen(){
	$query=$this->db->query("select kode,keterangan from jenis_tunjangan");
	$ret=array();$ret['']='- Select -';
	if($query)foreach ($query->result() as $row){$ret[$row->kode]=$row->keterangan;}		 

	$query=$this->db->query("select kode,keterangan from jenis_potongan");
	if($query)foreach ($query->result() as $row){$ret[$row->kode]=$row->keterangan;}		 

	return $ret;	
} 
}