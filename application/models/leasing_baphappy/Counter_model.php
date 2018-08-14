<?php
class Counter_model extends CI_Model {

	private $primary_key='counter_id';
	private $table_name='ls_counter';

	function __construct(){
		parent::__construct();
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['counter_name']))$nama=$_GET['counter_name'];
		if($nama!='')$this->db->where("counter_name like '%$nama%'");

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
		$ok=$this->db->get($this->table_name);
		return $ok;
	}
	function save($data){
		$lok=$this->db->insert($this->table_name,$data);
		return $lok;
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		return $ok;
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function dropdown(){
		$query=$this->db->query("select counter_id,counter_name
                     from ls_counter order by counter_name");
		$ret=array();
		$ret['']='- Select -';
 		foreach ($query->result() as $row)
		{
			$ret[$row->counter_id]=$row->counter_name.' - '.$row->counter_id;
		}		 
		return $ret;
	}
	
}

?>
