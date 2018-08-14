<?php
class Chart_of_accounts_model extends CI_Model {

private $table_name='chart_of_accounts';
private $primary_key='account';

    function __construct(){
            parent::__construct();        
       
            
    }
	function select_list(){
		$query=$this->db->query("select id,account,account_description
                    from ".$this->table_name);
		$ret=array();
		$ret['']='- Select -';
 		foreach ($query->result() as $row)
		{
			$ret[$row->id]=$row->account.' - '.$row->account_description;
		}		 
		return $ret;
	}
	function account_type_list(){
			$query=$this->db->query("select account_type_num,account_type
				from chart_of_account_types order by account_type");
			$ret=array();
			$ret['']='- Select -';
			foreach ($query->result() as $row)
			{
					$ret[$row->account_type_num]=$row->account_type_num.' - '.$row->account_type;
			}		 
			return $ret;
	}
	function group_type_list(){
			$query=$this->db->query("select group_type,group_name 
				from gl_report_groups where group_type<>'' order by group_type");
			$ret=array();
			$ret['']='- Select -';
			foreach ($query->result() as $row)
			{
					$ret[$row->group_type]=$row->group_type.' - '.$row->group_name;
			}		 
			return $ret;
	}
	function save($data){
        $id=$data['account'];
        $fld['account_type']=$data['account_type'];
        $fld['account']=$id;
        $fld['account_description']=$data['account_description'];
        $fld['group_type']=$data['group_type'];
        $fld['beginning_balance']=$data['beginning_balance'];
        $db_or_cr=$data['db_or_cr'];
        if($db_or_cr=='D'){
            $db_or_cr='0';
        } else {
            $db_or_cr='1';
        };
        $fld['db_or_cr']=$db_or_cr;
        if($data['mode']=='view'){
            $this->db->where($this->primary_key,$id);
            $this->db->update($this->table_name,$fld);            
        } else {
            $rst=$this->get_by_id($id)->row();
            if(count($rst)==0){
            	 
                $this->db->insert($this->table_name,$fld);            
                $this->db->insert_id();
                return true;
            } else {
                return false;
            }
        }
	}
    function update($id,$data){
        $id=$data['account'];
        $fld['account_type']=$data['account_type'];
        $fld['account']=$id;
        $fld['account_description']=$data['account_description'];
        $fld['group_type']=$data['group_type'];
        $fld['beginning_balance']=$data['beginning_balance'];
        $db_or_cr=$data['db_or_cr'];
        if($db_or_cr=='D'){
            $db_or_cr='0';
        } else {
            $db_or_cr='1';
        };
        $fld['db_or_cr']=$db_or_cr;
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$fld);
	}
	function delete($id){
        $rst=$this->get_by_id($id)->row();
        if(count($rst)){  
            $this->db->where($this->primary_key,$id);
            $this->db->delete($this->table_name);
        } else {
            $this->db->where('group_type',$id);
            $this->db->delete('gl_report_groups');
        }
	}
    function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
    function get_group_by_id($id){
		$this->db->where('group_type',$id);
		return $this->db->get('gl_report_groups');
	}
    function get_by_account_id($id){
		$this->db->where("id",$id);
		return $this->db->get($this->table_name);
	}


}
?>
