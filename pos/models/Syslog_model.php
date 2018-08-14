<?php
class Syslog_model extends CI_Model {

private $primary_key='id';
private $table_name='syslog';

	function __construct(){
		parent::__construct();
 		        
       

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
		if($id!=''){
			$this->db->where($this->primary_key,$id);
			$this->db->update($this->table_name,$data);
		}
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function add($nomor,$modul,$mode,$text=''){
		$ip="";
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$data['userid']=user_id();
		$data['no_bukti']=$nomor;
		$data['jenis']=$modul;
		$data['jenis_cmd']=$mode;
		$data['logtext']=$text;
		$data['tgljam']=date("Y-m-d H:i:s");
		$data['tcp_ip']=$ip;
		$this->save($data);
	}
}
