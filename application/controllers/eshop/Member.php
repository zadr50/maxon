<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Member extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		header("location: ".base_url()."index.php/eshop/home");
	}
	function add() {
		$data=$this->set_default();
		$data['caption']="Member Registration";		
		$data['mode']="add";
		$data['content']=true;
		$data['footer']='footer';
		//$data['sidebar']='category_list';
		$this->template_eshop->display("customers/member",$data);
	}
	function set_default() {
		$data['customer_number']="";
		$data['company']="";
		$data['street']="";
		$data['city']="";
		$data['phone']="";
		$data['email']="";
		$data['password']="";
		$data['zip_postal_code']="";		
		$data['mode']='add';
		return $data;
	}
 
	function save() {
		$data=$this->input->post();
		$mode=$data['mode'];
		unset($data['mode']);
		$cust_id=$data['customer_number'];
		$ok=false;
		$message="";
		if($mode=="add"){
			if($q=$this->db->query("select company from customers 
				where customer_number='$cust_id' ")){
				if($q->num_rows()){
					$message="Tidak bisa pakai user id ini, silahkan di ganti !";
				} else {
					$ok=$this->db->insert("customers",$data);
				}
			}
		} else {
			unset($data['customer_number']);
			$ok=$this->db->where("customer_number",$cust_id)->update("customers",$data);
		}
		if($message=="" ) $message="Ada kesalahan saat menyimpan data !";
		
		echo json_encode(array("success"=>$ok,"message"=>$message));
	}
}
?>