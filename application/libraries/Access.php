<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Access
 {
 public $user;
 public $user_id='';
 public $username='';
 public $password='';
 public $cid='';
 public $flag1='';
 public $flag2='';
 public $flag3='';
 private $_current_gudang="";
 private $_initialized=false; 
 /**
 * Constructor
 */
 function __construct()
 {
	 $this->CI =& get_instance();        
 }

 /**
 * Cek login user
 */

 function login($username, $password)
 {

 	 $auth = $this->CI->config->item('auth');
	
	 //$this->CI->load->helper('cookie');
	 //$this->CI->load->library('session');
	 $this->CI->load->model('user_model');
	
	 $this->users_model =& $this->CI->users_model;
	 $result = $this->users_model->get_login_info($username);
	 if ($result) // Result Found
	 {	
//		 $password = md5($password);
		 if ($password === $result->password)
		 {
			 // Start session
			 $this->CI->session->set_userdata('user_id',$result->user_id);
			 return TRUE;
		 }
	 }
	 return FALSE;
 }


 /**
 * cek apakah udah login
 */
    function is_login ()
    {
		
	     if(!isset($_SESSION['logged_in']))  return false;
		 $data=$_SESSION["logged_in"];
	 
		 if(is_array($data)){
			 
			 if(isset($data['user_id'])){
				 $this->user_id=$data['user_id'];
				 $this->username=$data['username'];
				 $this->cid=$data['cid'];   
				 if(isset($data['flag1']))$this->flag1=$data['flag1'];         
				 if(isset($data['flag2']))$this->flag2=$data['flag2'];         
				 if(isset($data['flag3']))$this->flag3=$data['flag3'];         
			 } else {
				 $this->user_id="";
				 $this->user_name="";
				 $this->cid="";
			 	 $this->flag1="";
			 	 $this->flag2="";
			 	 $this->flag3="";			 
			 }
		 }
	     return ($this->user_id!='' ? TRUE :FALSE);
    }
 /**
 * Logout
 *
 */
    function logout ()
   {
           $this->CI->session->unset_userdata('logged_in');
		   $this->log_text("LOGOUT","");
   }
   function log_text($text){
	   
   }
    function print_info(){
    	echo "<img src='".base_url()."images/administrator.png'	align='left'>"; 
        echo ' Welcome [<strong>'.$this->username.'</strong>]';
        echo "</br>";
        
        echo '<a href="'.base_url().'index.php/login/logout"
		class="easyui-linkbutton" 
		data-options="iconCls:\'icon-no\',
		plain:false" style=\'text-color:red;\' ">Logout</a>';
        
        echo '&nbsp&nbsp <a href="#" onclick="edit_user();return false;"
        class="easyui-linkbutton" 
        data-options="iconCls:\'icon-edit\',
        plain:false" style=\'text-color:red;\' ">Edit</a>';
        
//            .'<br/>CID: '.$this->cid; 
    }
	function user_id(){
	    $this->is_login();
        return $this->user_id;
	}
	function user_name(){
	    $this->is_login();
        return $this->username; 
    }
	function cid(){
	    $this->is_login();
        return $this->cid; 
    }
	function user_pass(){
	    $this->is_login();
        return $this->password; 
	}
	function is_admin(){
		$arr= $this->user_with_job('ADM');
		return count($arr)>0;
	}
	function user_with_job($group_id=null)
	{
	    $this->is_login();
		if(!$group_id) return $this->user_id;
		$sql="";
		if( !is_array($group_id) ) {
			$sql="select user_id from user_job where group_id='$group_id'";
		} else {
			$in="";
			for($i=0;$i<count($group_id);$i++)
			{
				$in .= "'".$group_id[$i]."',";
			}
			if(substr($in,-1)==",")$in=substr($in,0,strlen($in)-1);
			if($in=="") {
				$sql="select user_id from user_job where group_id='$group_id' ";				
			} else {
				$sql="select user_id from user_job where group_id in ($in) ";				
			}
		}
		
        $query=$this->CI->db->query($sql);

		return $query->result_array();
	}
	function current_gudang(){
	    $retval="";
		if($this->_initialized){
			return $this->_current_gudang;
		} else {
			$this->_initialized=true;
			$sql="select * from user_roles where user_id='".$this->user_id."'
				and roles_type=2";
			if($q=$this->CI->db->query($sql)){
				if($r=$q->row()){
					$retval= $r->roles_item;
				}
			}
		}
		return $retval;
	}
}
