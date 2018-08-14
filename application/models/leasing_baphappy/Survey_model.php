<?php
class Survey_model extends CI_Model {

	private $primary_key='id';
	private $table_name='ls_app_survey';

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
		$this->db->where($this->primary_key,$id)
		->where("hasil","<>''");
		return $this->db->get($this->table_name);
	}
	function get_by_app_id($app_id){
		return $this->db->where("app_id",$app_id)
		->get($this->table_name);
	}	
	function save($data){
		$app_id=$this->input->post('pilih');
		$tanggal=$this->input->post('tanggal');
		$surveyor=$this->input->post('surveyor');
		for($i=0;$i<count($surveyor);$i++){
			if(isset($app_id[$i])){
				$d['app_id']=$app_id[$i];
				$d['survey_by']=$surveyor[$i];
				$d['survey_date']=date('Y-m-d H:i:s', strtotime($tanggal[$i]));
				$d['area']='default';
				$d['status']=0;
				$d['create_by']=user_id();
				$d['create_date']=date('Y-m-d H:i:s');
				$ok=$this->db->insert($this->table_name,$d);            
				unset($d);
				if($ok){
					$s="update ls_app_master set surveyed=1 where  app_id='".$app_id[$i]."'";
					$this->db->query($s);
				}
			}
		}
		return $ok;
	}
	function update($id,$data){
		$data['update_by']=user_id();
		$data['update_date']=date('Y-m-d H:i:s');
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
}
?>