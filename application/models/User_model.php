<?php
class User_model extends CI_Model {

private $primary_key='user_id';
private $table_name='user';

function __construct(){
	parent::__construct();        
        
    
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
                $nama='';
                if(isset($_GET['nama'])){
                    $nama=$_GET['nama'];
                }
                if($nama!='')$this->db->where("username like '%$nama%'");

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
	function info($id){
		$data=$this->get_by_id($id)->row();
		if(count($data)){    
			$ret='<br/><strong>'.$id.' - '.$data->username.'</strong><br/>'
					.$data->cid.'<br/>';
		} else $ret='';
		return $ret;
	}
	function save($data){
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		/*
		$jobs=$_POST['jobs'];
		unset($data['jobs']);
		if($jobs){
			$this->load->model('user_jobs_model');
			$data_jobs['jobs']=$jobs;
			$data_jobs['user_id']=$id;
			$this->user_jobs_model->update($id,$data_jobs);
		}
		*/
		//var_dump($data);
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
		
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
		$this->user_jobs_model->delete_by_user($id);
	}
	 function get_login_info($user_id)
	 {
		 $this->db->where('$user_id', $user_id);
		 $this->db->limit(1);
		 $query = $this->db->get($this->table);
		 return ($query->num_rows() > 0) ? $query->row() : FALSE;
	 }
	 function list_user_by_group($group_id){
		$sql="select u.user_id,u.username,u.path_image from user u
			left join user_job uj on uj.user_id=u.user_id 
			where uj.group_id='".$group_id."'";
		return $this->db->query($sql);
	 }
	 
	function roles_list($user_id,$type) {
		$user_id=urldecode($user_id);
		$s="select roles_item,roles_value1,roles_value2,
			description,id 
			from user_roles
			where user_id='$user_id' and roles_type='$type'";
		echo datasource($s);
	}
	function roles_add($data){
		return $this->db->insert("user_roles",$data);
	}
	function roles_delete($id) {
		return $this->db->where("id",$id)->delete("user_roles");		
	}
	function roles_update($id,$data){
		return $this->db->where("id",$id)->update("user_roles",$data);
	}
	function roles_gudang($user_id=""){
		return $this->roles_type($user_id,"2");
	}	
	function roles_division($user_id=""){
		return $this->roles_type($user_id,"1");
	}	
	function roles_type($user_id="",$type='1'){
		$user_id=urldecode($user_id);
		if($user_id=="")$user_id=user_id();
		$s="select roles_item,roles_value1,roles_value2,
			description,id 
			from user_roles
			where user_id='$user_id' and roles_type='$type'";
		$rows=$this->db->query($s);
		$data=array();
		$type="";
		foreach($rows->result() as $row){
			$data[]=$row->roles_item;
		}
		if(count($data)>1) {
			return $data;
		} else {
			if(count($data)){
				return $data[0];
			} else {
				return "";
			}
		}
	}	

	
}
