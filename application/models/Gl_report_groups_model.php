<?php
class Gl_report_groups_model extends CI_Model {

private $primary_key='group_type';
private $table_name='gl_report_groups';

function __construct(){
	parent::__construct();        
      
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
                $nama='';
                if(isset($_GET['group_name'])){
                    $nama=$_GET['group_name'];
                }
                if($nama!='')$this->db->where("group_name like '%$nama%'");

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
	    $group_type=$data["group_type"];
        $cnt=$this->db->query("select count(1) as cnt from gl_report_groups 
            where group_type='$group_type'")->row()->cnt;     
        if($cnt==0){
            $this->db->insert($this->table_name,$data);
            return $this->db->insert_id();            
        } else {
            unset($data['group_type']);
            return $this->update($group_type,$data);
        }
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
	   return $this->db->delete($this->table_name);
	}

}
