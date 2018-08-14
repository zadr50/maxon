<?php
class Overtime_model extends CI_Model {

private $primary_key='id';
private $table_name='overtime_detail';

	function __construct(){
		parent::__construct();        
      
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_by_tcid($tcid){
		$this->db->where("tcid",$tcid);
		return $this->db->get($this->table_name);
	}

	function save($data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));		
		$data=$this->recalc($data);
		$id=$this->db->insert($this->table_name,$data);
		return $id;
	}
	function update($id,$data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));		
		$data=$this->recalc($data);
		$this->db->where($this->primary_key,$id);
		$id=$this->db->update($this->table_name,$data);
		return $id;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function recalc($data) {
		
		$first  = new DateTime( $data['time_in'] );
		$second = new DateTime( $data['time_out'] );

		$diff = $first->diff( $second );

		$ot_hour=$diff->format( '%H:%I:%S' ); // -> 00:25:25
		$data['time_total']=$ot_hour;
		$data['ttc_1x']=0;
		$data['ttc_2x']=0;
		$data['ttc_3x']=0;
		$data['ttc_4x']=0;
		
		$hari_libur=false;
		
		if(isset($data['hari_libur']))$hari_libur=true;
		
		if($ot_hour>0){
			$data['ttc_1x']=1.5;
			if($hari_libur)$data['ttc_1x']=0;
			$ot_hour--;
		}
		if($ot_hour>0){
			if($hari_libur){
				if($ot_hour>6){
					$data['ttc_2x']=6*2;
				} else {
					$data['ttc_2x']=$ot_hour*2;
				}
				$ot_hour=$ot_hour-6;
			} else {
				$data['ttc_2x']=$ot_hour*2;
			}
		}
		if($hari_libur and $ot_hour>0) {
			$data['ttc_3x']=$ot_hour*3;
		}
		if($hari_libur){
			$data['hari_libur']=1;
		} else {
			$data['hari_libur']=0;
		}
		$data['time_total_calc']=$data['ttc_1x']+$data['ttc_2x']+$data['ttc_3x']+$data['ttc_4x'];
		return $data;
	}

}
