<?php
class Modules_groups_model extends CI_Model {
	private $table_name='modules_groups';
	private $primary_key='user_group_id';
	
	function __construct(){
		parent::__construct();        
         
	}
	function count_all(){
	        return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
	        $this->db->where($this->primary_key,$id);
	        return $this->db->get($this->table_name);
	} 
	function get_all(){
	        $this->db->order_by($this->primary_key);
	        return $this->db->get($this->table_name);
	} 
	function save($data){
	 
	    $id=$data['user_group_id'];
	     $mgm=$this->get_by_id($id)->row();
	        if(count($mgm)){
	            return $this->update($id,$data);
	            
	        } else {
	            $this->db->insert($this->table_name,$data);
	            return $this->db->insert_id();
	        }
	
	}
	function update($id,$data){
	        $this->db->where($this->primary_key,$id);
	        return $this->db->update($this->table_name,$data);
	        
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function list_modules($group_id){
		$sql="select m.module_id,m.module_name,m.description,m.parentid 
		from modules m left join user_group_modules ugm on ugm.module_id=m.module_id
		where ugm.group_id='$group_id'  ";
		return $this->db->query($sql);
	}
	function exist($group_id,$module_id){
		$sql="select count(1) as cnt from user_group_modules 
		where group_id='$group_id' and module_id='$module_id'";
		$q=$this->db->query($sql)->row();
		return $q->cnt>0;
	}
	function add_module($group_id,$module_id){
		$sql="insert into user_group_modules(group_id,module_id) 
		values('$group_id','$module_id')";
		$this->db->query($sql);
		echo "add";
	}
	function delete_module($group_id,$module_id){
		$sql="delete from user_group_modules 	
		where group_id='$group_id' and module_id='$module_id'";
		$this->db->query($sql);
		echo "delete";
	}
	
	function save_module($group_id,$modules){
		//hapus dulu sebelum masuk
		//jangan hapus !!!
//		$query=$this->db->query("delete  from user_group_modules where group_id='$group_id'");
	
		for($i=0;$i<count($modules);$i++){
			$data['group_id']=$group_id;
			$data['module_id']=$modules[$i];
			if($data['module_id']=='_19000'){
				echo 1;
			}
			try{
				if(!$this->exist($group_id, $data['module_id'])){
					$this->db->insert("user_group_modules",$data);					
				}
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			unset($data);		
		}
	}
}
?>
