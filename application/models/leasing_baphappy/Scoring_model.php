<?php
class Scoring_model extends CI_Model {

	private $primary_key='id';
	private $table_name='ls_app_scoring';

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
		$score=0;
		foreach($data as $key=>$value){
			if($value=="1"){
				$score++;
			}
		}
		$score=round($score/14*100);
		$data['create_by']=user_id();
		$data['create_date']=date('Y-m-d H:i:s');
		$ok=$this->db->insert($this->table_name,$data);            
		if($ok){
			if($score>75){
				$this->db->where("app_id",$app_id)->update("ls_app_master",array("scored"=>1,"score_value"=>$score,"status"=>"Wait Review"));
			} else {
				//masuk inbox sa nomor SPK ditolak
				$message="Nomor SPK $app_id tidak memenuhi syarat score value = $score";
				$to=$this->db->select("create_by")->where("app_id",$app_id)->get("ls_app_master")->row()->create_by;
				inbox_send(user_id(),$to,"Not Recomended",$message);
				$this->db->where("app_id",$app_id)->update("ls_app_master",array("scored"=>1,"score_value"=>$score,"status"=>"Not Recomended"));
			}
		}
		return $ok;
	}
	function update($id,$data){
		$data['update_date']=date('Y-m-d H:i:s');
		$data['update_by']=user_id();
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
}
?>