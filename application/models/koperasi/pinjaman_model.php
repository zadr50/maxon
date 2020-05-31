<?php
class Pinjaman_model extends CI_Model {

private $primary_key='no_pinjaman';
private $table_name='kop_pinjaman';

	function __construct(){
		parent::__construct();        
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}

	function save($data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));		
		if($data['tanggal_tempo'])$data['tanggal_tempo']= date('Y-m-d H:i:s', strtotime($data['tanggal_tempo']));		
		$data=$this->recalc($data);
		$id=$this->db->insert($this->table_name,$data);
		$this->save_cicilan($data['no_pinjaman']);
		return $id;
	}
	function update($id,$data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));		
		if($data['tanggal_tempo'])$data['tanggal_tempo']= date('Y-m-d H:i:s', strtotime($data['tanggal_tempo']));		
		$data=$this->recalc($data);

		$this->save_cicilan($id);

		$this->db->where($this->primary_key,$id);
		$id=$this->db->update($this->table_name,$data);
		return $id;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		$ok = $this->db->delete($this->table_name);
		$this->db->where("no_pinjaman",$kode)->delete("kop_cicilan");
		return $ok;
	}
	function recalc($data) {
		if($data['jangka_waktu']==0)$data['jangka_waktu']=12;
		if($data['jumlah']==0)$data['jumlah']=$data['jumlah']/$data['jangka_waktu'];
		return $data;
	}
	function save_cicilan($id) {
		$table='kop_cicilan';
		$loan=$this->get_by_id($id)->row();
		if(!$loan){
			return false;
		}
		$tanggal=$loan->tanggal;
		$awal=$loan->jumlah;
		$pokok=$loan->angsur_pokok;
		$bunga=$loan->angsur_bunga;
		
		for($i=0;$i<$loan->jangka_waktu-1;$i++) {
			$tanggal = date('Y-m-d', strtotime("+1 months", strtotime($tanggal)));
		
			$data['no_pinjaman']=$id;
			$data['no_urut']=$i+1;
			$data['tanggal_jth_tempo']=$tanggal;
			$data['awal']=$awal;
			$data['pokok']=$pokok;
			$data['bunga']=$bunga;
			$data['angsuran']=$data['pokok']+$data['bunga'];
			$data['akhir']=$awal-$data['angsuran'];
 
			$this->db->where('no_pinjaman',$id);
			$this->db->where('no_urut',$i+1);
			if($this->db->get($table)->row()){
				$this->db->where('no_pinjaman',$id);
				$this->db->where('no_urut',$i+1);
				
				unset($data['no_pinjaman']);
				unset($data['no_urut']);
				$this->db->update($table,$data);
			} else {
				 
				$this->db->insert($table,$data);
			}
			 
			$awal=$data['akhir'];
		}
	}

}
