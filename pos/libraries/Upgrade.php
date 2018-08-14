<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade
 {
 function __construct()
 {
	$this->CI =& get_instance();	 
 
 }
 function process(){
	$key="Flag [system_variables] change size";
	//if(""==$this->CI->sysvar->getvar($key) ){}	
	//$this->add_field("user","branch_code");  
 }
 function create_table($table,$fields)
 {
	$key="Flag [$table] add table";
	if(""==$this->CI->sysvar->getvar($key) ){		
		$this->CI->sysvar->insert($key,"1",$key);
		$this->CI->load->dbforge();
		for($i=0;$i<count($fields);$i++)
		{
			$fields2[]=$fields[$i];
		}
		$this->CI->dbforge->add_field($fields2);
		$this->CI->dbforge->add_field("id");
		$this->CI->dbforge->create_table($table,TRUE);
		$this->CI->sysvar->update($key,"1");		
	}
 }
 function add_field($table,$field,$type="varchar(50)")
 {
	$key="Flag [$table] add field [$field]";
	if(""==$this->CI->sysvar->getvar($key) ){		
		$this->CI->sysvar->insert($key,"1","auto");
		$fields=$this->CI->db->query("DESCRIBE ".$table)->result();
		$exist=false;
		for($i=0;$i<count($fields);$i++)
		{
			if($fields[$i]->Field==$field){
				$exist=true;
			}
		}
		if(!$exist){
			$s="ALTER TABLE `$table` ADD COLUMN `$field` $type ; "; 
			if($this->CI->db->query($s)){
				$this->CI->sysvar->update($key,"1");
			}
		} else {
			 
			$this->CI->sysvar->update($key,"1");			
		}
	} else {
		 
	}
 }
 function add_fields($table,$fields)
 {
    $key="Flag [$table] add field [".$fields[0]."]";
    if(""==$this->CI->sysvar->getvar($key) ){       
        $this->CI->sysvar->insert($key,"1","auto");
        $fields_tgt=$this->CI->db->query("DESCRIBE ".$table)->result();
        $exist=false;
        $field_new="";
        for($iflds=0;$i<count($fields);$iflds++){            
            $exist=false;
            for($i=0;$i<count($fields_tgt);$i++)
            {
                if($fields_tgt[$i]->Field==$fields[$iflds]){
                    $exist=true;
                    break;
                }
            }
            if(!$exist){
                $field_new.=$fields[$iflds];
                if($flds<count($fields)-1)$field_new.=",";
            }
        }
        if($this->CI->db->query($s)) $this->CI->sysvar->update($key,"1");
    } else {
        $this->CI->sysvar->update($key,"1");            
    }
 }
  
}
