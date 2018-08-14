<?php
class Manifest_model extends CI_Model {

	private $primary_key='code';
	private $table_name='manifest';

	function __construct(){
		parent::__construct();        
         
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['pengirim']))$nama=$_GET['pengirim'];
		if($nama!='')$this->db->where("pengirim like '$nama%'");
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
        $this->db->where("code_mf",$id)->delete("manifest_detail");

		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
    function items($id){
        $this->db->where("code_mf",$id);
        return $this->db->get("manifest_detail");
    }
}

?>
