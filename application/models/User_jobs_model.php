<?php
class User_jobs_model extends CI_Model {

private $table_name='user_job';
private $primary_key='user_id';
private $user_id=''; 

    function __construct(){
        parent::__construct();        
      
        $this->load->model('modules_groups_model');
        //$this->load->model('user_group_modules');
    }
    function is_job($job_id,$uid=''){
    	 if($uid!="")$this->user_id=$uid;
         $sql='select * from '.$this->table_name.
                ' where '.$this->primary_key.'=\''.$this->user_id.'\'
                    and group_id=\''.$job_id.'\'';
        $query=$this->db->query($sql);
        return $query->num_rows()>0;
    } 
    function list_jobs($user_id){
    	$this->db->where('user_id',$user_id);
		return $this->db->get($this->table_name);
    }
	function list_jobs_table($user_id){
        $this->user_id=$user_id;
        $groups=$this->modules_groups_model->get_all();
        $i=0;
        $return='';
        foreach($groups->result() as $row){
            $value=$row->user_group_id;
            $name='jobs['.$i.']';
            $checked=$this->is_job($value);
            $return.=form_checkbox($name, $value, $checked,'id="'.$name.'"');
            $return.='&nbsp;'.$value.' - '.$row->user_group_name;
            $return.='<br/>';
            $i++;
        }
        return $return;		
	}
    function update($id,$data){
       $jobs=$data['jobs'];
       $this->user_id=$id;
       //hapus dulu jobs yg ada biar mudah
      $sql="delete from user_job where user_id='".$this->user_id."'";
      $query=$this->db->query($sql);
       //baru tambahkan lagi
      if(is_array($jobs)){
        foreach($jobs as $jb){
            $sql="insert into user_job set user_id='".$this->user_id."',
            group_id='".$jb."'                   
            ";
            $query=$this->db->query($sql);
        }
      }
    }
    function save($data){
	    $this->db->insert($this->table_name,$data);
	    return $this->db->insert_id();
    }
	function delete($job,$user_id){
		return $this->db->query("delete from user_job where user_id='".$user_id."' and group_id='".$job."'");
	}
	function delete_by_user($user_id){
		return $this->db->query("delete from user_job where user_id='".$user_id."'");		
	}
	function add_job($user_id,$group_id){
		if(!$this->db->query("select * from user_job where user_id='$user_id' 
			and group_id='$group_id'")->row()){
            $sql="insert into user_job set user_id='".$user_id."',
            group_id='".$group_id."'";
            return $this->db->query($sql);
		}
	}

}
?>
