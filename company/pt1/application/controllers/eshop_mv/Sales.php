<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sales extends CI_Controller {
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
	function view($so_number) {
		if($so_number==""){
			header("location: ".base_url()."index.php/eshop/home");
		}
		$cust_id=$this->session->userdata("cust_id");
		$so=$this->db->where("sales_order_number",$so_number)
			->get("sales_order")->row();
		$so_item=$this->db->where("sales_order_number",$so_number)
			->get("sales_order_lineitems");
		$so_pay=$this->db->where("invoice_number",$so_number)->get("payments")->row();
		$data['cust']=$this->db->where("customer_number",$cust_id)->get("customers")->row();
		$data['so']=$so;
		$data['so_detail']=$so_item;
		$data['so_pay']=$so_pay;
		$data['caption']="TAGIHAN";
		$data['so_list']=$this->db->where('sold_to_customer',$cust_id)->order_by('sales_date desc')
			->get('sales_order');
		$this->template_eshop->display("eshop/sales",$data);
	}
}
?>