<?php
Class User extends CI_Model
{
 function login($user_id, $password)
 {
 	if($user_id=='' or $password=='')
	{
		return false;
	}
   $this -> db -> select('user_id, username, cid, password, flag1,flag2,flag3');
   $this -> db -> from('user');
   $this -> db -> where('user_id', $user_id);
   $this -> db -> where('password', ($password)); //MD5($password)
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     	
     return $query->result();
	 
   }
   else
   {
     return false;
   }
 }
}
?>