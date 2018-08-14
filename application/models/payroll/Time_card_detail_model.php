<?php
class Time_card_detail_model extends CI_Model {

private $primary_key='id';
private $table_name='time_card_detail';
private $hadir=0;
private $tidak=0;
private $pay_no="";
function __construct(){
	parent::__construct();        
      
	$this->load->model("payroll/paycheck_model");
	}
	function save($data){
	if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));		
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		//var_dump($data);
		//echo "</br>";
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function calc_hari_absen($pay_no){
		$this->pay_no=$pay_no;
		if($this->hadir==0)$this->calc_absensi();
		return $this->tidak;
	}
	function calc_hari_hadir($pay_no){
		$this->pay_no=$pay_no;
		if($this->hadir==0)$this->calc_absensi();
		return $this->hadir;
	}
	function calc_absensi(){
		$pay_no=$this->pay_no;
		$ret=0;
		$tidak=0; $hadir=0;
		if($slip=$this->paycheck_model->get_by_id($pay_no)){
			if($row=$slip->row()){
				 
				$from=$row->from_date;
				$to=$row->to_date;
				$nip=$row->employee_id;
				if($absensi=$this->loadlist($from,$to,$nip)){
					foreach($absensi->result() as $row){
						if($row->absen_type==1){
							$tidak++;
						} else {
							$hadir++;
						}
					}
				}
			}
		}
		$this->hadir=$hadir;
		$this->tidak=$tidak;
	}
	function loadlist($from,$to,$nip){
		$s="select * from time_card_detail 
		where tanggal>='".$from."' and tanggal<='".$to."'
		and nip='".$nip."'";
		return $this->db->query($s);
	}

}
