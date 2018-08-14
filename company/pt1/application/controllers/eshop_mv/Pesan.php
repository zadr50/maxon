<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Pesan extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['title']='Pesan';
		$data['messages']=$this->db->where('rcp_to',cust_id())->where('is_archieve',false)
			->where('is_trash',false)->get('maxon_inbox');
		$data['message_send']=$this->db->where('rcp_from',cust_id())->where('is_archieve',false)
			->where('is_trash',false)->get('maxon_inbox');
		$data['message_arsip']=$this->db->where('rcp_to',cust_id())->where('is_archieve',true)->get('maxon_inbox');
		$data['message_sampah']=$this->db->where('rcp_to',cust_id())->where('is_trash',true)->get('maxon_inbox');
		$data['toko']=array('user_id'=>cust_id());
		$this->template_eshop->display("eshop/pesan",$data);		
	}
	function save($user_id){
		$user_id=urldecode($user_id);
		$data['rcp_from']=cust_id();
		$data['rcp_to']=$user_id;
		$data['msg_date']=date('Y-m-d H:i:s');
		$data['message']=$this->input->post('message');
		$data['subject']=$this->input->post('subject');
		$data['is_read']=0;
		if($id=$this->input->post('id')){
			$data['rcp_to']=$this->db->where('id',$id)->get('maxon_inbox')->row()->rcp_from;
			$data['reply_id']=$id;
		}
		$success=$this->db->insert('maxon_inbox',$data);
		echo json_encode(array("success"=>$success,"message"=>($success)?"Sukses":"Error"));
	}
}