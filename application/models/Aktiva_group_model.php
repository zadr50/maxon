<?php
class Aktiva_group_model extends CI_Model {

private $primary_key='id';
private $table_name='fa_asset_group';

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
                if($nama!='')$this->db->where("name like '%$nama%'");

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
		if(isset($data['warranty_date']))$data['warranty_date']= date('Y-m-d H:i:s', strtotime($data['warranty_date']));
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}	
	function lookup(){
			$query=$this->db->query("select id,name from fa_asset_group");
			$ret=array();
			$ret['']='- Select -';
			foreach ($query->result() as $row)
			{
					$ret[$row->id]=$row->name;
			}		 
			return $ret;
	}
	
}