<?php
class Approve_model extends CI_Model {

	private $primary_key='id';
	private $table_name='ls_app_master';

	function __construct(){
		parent::__construct();
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['cust_name']))$nama=$_GET['cust_name'];
		if($nama!='')$this->db->where("cust_name like '%$nama%'");

		if (empty($order_column)||empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else
			$this->db->order_by($order_column,$order_type);
			
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$app_id=$data['app_id'];
		if($q=$this->db->query("select a.cust_id,c.cust_name,c.phone 
			from ls_app_master a left join ls_cust_master c
			on a.cust_id=c.cust_id where a.app_id='".$app_id."'")){
			if($row=$q->row()){
				$data['cust_id']=$row->cust_id;
				$data['cust_name']=$row->cust_name;
				$data['phone']=$row->phone;
			}			
		}
//		$data['app_ver_date']=date('Y-m-d H:i:s', strtotime($data['app_ver_date']));
		$ok=$this->db->insert($this->table_name,$data);            
		if($ok){
			$s="update ls_app_master set verified=1 where app_id='".$app_id."'";
			$this->db->query($s);
		}
		return $ok;
	}
	function update($id,$data){
//		$data['app_date']=date('Y-m-d H:i:s', strtotime($data['app_date']));
//		$data['app_ver_date']=date('Y-m-d H:i:s', strtotime($data['app_ver_date']));
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
}
?>