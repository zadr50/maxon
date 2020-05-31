<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Comment extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
	}	
	function save($item_id)
	{
		$data=$this->input->post();
		$data['cm_username']=$this->session->userdata("cust_id");
		$data['cm_date']=date('Y-m-d H:i:s');
		$data['item_id']=$item_id;
		$success=$this->db->insert('eshop_comments',$data);
		echo json_encode(array("success"=>$success,"message"=>($success)?"Sukses":"Error"));
	}
}