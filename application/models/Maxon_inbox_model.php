<?php
class Maxon_inbox_model extends CI_Model {

	private $primary_key='id';
	private $table_name='maxon_inbox';
	public $fields=null;

	function __construct(){
		parent::__construct();        
       
		$this->load->dbforge();
		if(!$this->db->table_exists($this->table_name)){	
			$this->dbforge->add_field("rcp_from nvarchar(250)");
			$this->dbforge->add_field("rcp_to nvarchar(250)");
			$this->dbforge->add_field("subject nvarchar(250)");
			$this->dbforge->add_field("message nvarchar(250)");
			$this->dbforge->add_field("is_read bit");
			$this->dbforge->add_field("msg_date datetime");
			$this->dbforge->add_field("id");
			$this->dbforge->create_table($this->table_name);
			echo "create new table " . $this->table_name;
		}
	}
	function get_by_id($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
	    $subject=$data["subject"];
        $user_id=$data["rcp_from"];
	    $s="select count(1) as cnt from maxon_inbox where subject='$subject' 
	       and rcp_from='$user_id'";
	    $cnt=$this->db->query($s)->row()->cnt;
        if($cnt==0){
            return $this->db->insert($this->table_name,$data);                        
        } else {
            return false;
        }
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
}