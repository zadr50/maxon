<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Login extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['caption']="User Login";
		$this->template_eshop->display("eshop/login",$data);
	}
	function verify() {
		$cust_id=$this->input->post('cust_id');
		$cust_pass=$this->input->post('cust_pass');
		$ok=false;
		$message="Username tidak dikenal atau password salah.!";
		$user_admin="";
		if($q=$this->db->select("company,first_name,phone,email,city,password")
			->where("customer_number",$cust_id)
			->get("customers"))
		{
			if($row=$q->row()){
				if($cust_pass==$row->password){
					$data['cust_id']=$cust_id;
					$data['cust_name']=$row->company;
					$ok=true;
					$message="Login berhasil.";
					$this->session->set_userdata("cust_login",true);
					$this->session->set_userdata("cust_id",$cust_id);
					$this->session->set_userdata("cust_name",$row->company);
					$this->session->set_userdata("cust_first_name",$row->first_name);
					$this->session->set_userdata("cust_city",$row->city);
					// check if this user as admin for backend application ?
					$this->load->model("user_jobs_model");
					$user_admin=$this->user_jobs_model->is_job("ADM",$cust_id);
					$this->session->set_userdata("user_admin",$user_admin);
				}
			}
		}
		$data=array("success"=>$ok,"message"=>$message,"user_admin"=>$user_admin);
		echo json_encode($data);
	}
	function logout(){
		$this->session->unset_userdata("cust_login");
		$this->session->unset_userdata("cust_id");
		$this->session->unset_userdata("cust_name");
		$this->session->unset_userdata("cust_first_name");
		$this->session->unset_userdata("cust_city");
		$this->session->unset_userdata("user_admin");
		header("Location:".base_url()."index.php/eshop/home");
	}
}
?>