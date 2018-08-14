<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Maxon_Chat extends CI_Controller {
	function __construct() {
		parent::__construct();        
        
	}
	function index() {
	}
	function load() {
		$msg="";
		$last_id=0;
		if($q=$this->db->query("select id,userid,message from maxon_chat order by id desc limit 20")){
			foreach($q->result() as $row){
				$last_id=$row->id;
				$msg.="{b}".$row->userid."{eb} : ".$row->message."<br>";
			}
		}
		//$this->db->query("delete from maxon_chat where id<'$last_id'");
		if($xchat_user=$this->session->userdata('xchat_user')) {
			$userid=$xchat_user;
		} else {
			$userid="Guest";
		}
		if($userid=="Guest"){
			$this->load->helper('mylib_helper');
			$userid=user_name();
		}
		if($userid=="")$userid="Guest";
		$data['userid']=$userid;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	function save() {
		$userid=$this->input->get('u');
		
		if($uid_old=$this->session->userdata('xchat_user')) {
			if($uid_old!=$userid){
				$this->session->set_userdata('xchat_user',$userid);
			}
		} else {
			$this->session->set_userdata('xchat_user',$userid);
		}

		$userid=substr($userid,0,10);
		$msg=$this->input->get('m');
        $msg=htmlspecialchars($msg);
		$msg=substr($msg,0,190);
		$sql="insert into maxon_chat(userid,message) values('$userid','$msg')";
		$this->db->query($sql);
		 
		echo "<b>".$userid."</b>: ".$msg."<br>";
	}
 
}
