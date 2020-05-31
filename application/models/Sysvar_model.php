<?php
class Sysvar_model extends CI_Model {

private $primary_key='id';
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
	function get_by_varname($varname){
		$this->db->where("varname",$varname);
		return $this->db->get($this->table_name);
	}
    function get_by_id_row($id){
        $this->db->where("id",$id);
        return $this->db->get($this->table_name);
    }
	function save($data){
	    if(isset($data['id']))unset($data['id']);
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
    function update_id($id,$data){
		if(isset($data['id']))unset($data['id']);
		if($data['varlen']=='')$data['varlen']=0;
        $this->db->where("id",$id);
        return       $this->db->update($this->table_name,$data);
    } 
	function delete_id($id){
		$this->db->where("id",$id);
		return $this->db->delete($this->table_name);
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
                $ret[$row->varvalue]=$row->varname;
        }		 
        return $ret;
	}
	function lookup_ex($varname){ return value_list($varname); }
	function lookup($param=null){
		$dlgBindId="varname";
		$dlgRetFunc="$('#varvalue').val(row.varvalue);";
		$dlgId=$dlgBindId;
		if($param){
			if(is_array($param)){
				if(isset($param['dlgRetFunc'])){
					$dlgRetFunc=$param['dlgRetFunc'];
				}
				if(isset($param['dlgBindId'])){
					$dlgBindId=$param['dlgBindId'];
				}
				if(isset($param["dlgId"]))$dlgId=$param['dlgId'];
			}			
		}
        return $this->list_of_values->render(
	        array('dlgBindId'=>$dlgBindId,'dlgRetFunc'=>$dlgRetFunc,
	        	"sysvar_lookup"=>$dlgId,"dlgId"=>$dlgId
			)
		);          
		
	}

}
