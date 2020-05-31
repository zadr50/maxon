<?php
Class User extends CI_Model
{
 function login($user_id, $password)
 {
 	if($user_id=='' or $password=='')
	{
		return false;
	}
   $this -> db -> from('user');
   $this -> db -> where('user_id', $user_id);
   $this -> db -> where('password', ($password)); //MD5($password)
   $this -> db -> limit(1);

   $query = $this -> db -> get();
   
   return $query;

   if($query -> num_rows() == 1)
   {
     	
     return $query->result();
	 
   }
   else
   {
     return false;
   }
 }
 function change_password($user_id,$password){
     return $this->db->where("user_id",$user_id)->update("user",array("password"=>$password));
 }
}
?>