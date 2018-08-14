<?php
class Sysvar_model extends CI_Model {

private $primary_key='varname';
private $table_name='system_variables';

function __construct(){
	parent::__construct();        
        
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
        $nama='';
        if(isset($_GET['varname'])){
            $nama=$_GET['varname'];
        }
        if($nama!='')$this->db->where("varname like '%$varname%'");

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
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		if($id!=''){
			$this->db->where($this->primary_key,$id);
			$this->db->update($this->table_name,$data);
		}
	}
	function delete_id($id){
		$this->db->where("id",$id);
		$this->db->delete($this->table_name);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function value_list($varname){
        $query=$this->db->query("select varvalue from ".$this->table_name
        	." where varname='$varname' order by varvalue");
        $ret=array();
        $ret['']='- Select -';
        foreach ($query->result() as $row)
        {
                $ret[$row->varvalue]=$row->company;
        }		 
        return $ret;
	}
	function lookup($varname){ return value_list($varname); }
    
    
    function lookup_value($varname,$varvalue){
        $retval="";
        $query=$this->db->query("select keterangan 
        from $this->table_name where varname='lookup.$varname' and varvalue='$varvalue' ");
        if($query){
            if($row=$query->row()){
                $retval=$row->keterangan;
            }
        }
        return $retval;
        
    }
    

}
