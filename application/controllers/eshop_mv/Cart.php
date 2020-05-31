<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Cart extends CI_Controller {
	private $success=false;
	private	$message="";
	private $sales_no="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop',"sysvar");
	}
	function index() {	
		$cart=$this->session->userdata('cart');	
		$data['cart']=$cart;
		$data['caption']='CHECKOUT';

		$this->template_eshop->display("eshop/cart",$data);
	}
	function checkout_save() {
		$cart=$this->session->userdata('cart');
		if(!$cart){
			$data['message']="Belum ada barang yang dibeli.
			Silahkan pilih barang yang diinginkan.";
			$data['so_number']=$this->session->userdata("so_number");
		} else {
		
			$data['cart']=$cart;
			
			$cust_id=$this->session->userdata("cust_id");
			$cust=$this->db->where("customer_number",$cust_id)->get("customers")->row();
			$data['cust']=$cust;
			
			$so_number=$this->nomor_bukti();
			$data['so_number']=$so_number;

			$so['sales_order_number']=$so_number;
			$so['sold_to_customer']=$cust_id;
			$so['ship_to_customer']=$cust_id;
			$so['sales_date']=date("Y-m-d H:i:s");
			$so['due_date']=date("Y-m-d H:i:s");
			$so['payment_terms']="KREDIT";
			$so['salesman']="ONLINE";
			$so['status']="OPEN";
			$so['paid']=0;
			$so['delivered']=0;

			$this->load->model("sales_order_model");
			$ok=$this->sales_order_model->save($so);
			if($ok) {
				$this->session->set_userdata("so_number",$so_number);
				$this->nomor_bukti(true);
				$this->session->set_userdata("so",$so);
				$this->save_detail(); 
			}
		}
		$this->template_eshop->display("eshop/checkout",$data);
	}
	function clear_cart(){
		$this->session->unset_userdata('cart');	
	}
	function save_detail(){
		$so_number=$this->session->userdata("so_number");
		$cart=$this->session->userdata('cart');
		$detail["sales_order_number"]=$so_number;
		$this->load->model("sales_order_lineitems_model");
		$ar_detail=array();
		for($i=0;$i<count($cart);$i++){
			$item_no=$cart[$i]['item_number'];
			$qty=$cart[$i]['qty'];
			$item=$this->db->select("description,unit_of_measure,
				retail,cost,sales_count,create_by")
				->where("item_number",$item_no)
				->get("inventory")->row();
			$detail['item_number']=$item_no;
			$detail['quantity']=$qty;
			$detail['description']=$item==null?"":$item->description;
			$detail['unit']=$item==null?"":$item->unit_of_measure;
			$price=$item==null?0:$item->retail;
			$detail['price']=$price;
			$cost=$item==null?0:$item->cost;
			$detail['cost']=$cost;
			$detail['amount']=$price*$qty;
			$detail['warehouse_code']="ONLINE";
			$ok=$this->sales_order_lineitems_model->save($detail);
			if($ok){
				array_push($ar_detail,$detail);
			}
			$sales_count=$item->sales_count+$qty;
			$this->db->where("item_number",$item_no)->update('inventory',
				array("sales_count"=>$sales_count));
			$this->db->where('sales_order_number',$so_number)->update('sales_order',
				array('supplier_number'=>$item->create_by));
		}
		$this->session->set_userdata("so_detail",$ar_detail);
		$this->sales_order_model->recalc($so_number);		
	}
	function checkout_view() {
		$data['caption']="CHECKOUT";
		$cart=$this->session->userdata('cart');	
		$data['cart']=$cart;
		$cust_id=$this->session->userdata("cust_id");
		$cust=$this->db->where("customer_number",$cust_id)->get("customers")->row();
		$data['cust']=$cust;
		$so_number=$this->session->userdata("so_number");
		$data['so_number']=$so_number;
		$data['message']='';
		$this->template_eshop->display("eshop/checkout",$data);
	}
	function checkout() {
		$cust_login=$this->session->userdata('cust_login');
		$cart=$this->session->userdata("cart");
	
		if($cust_login){
			$so_number=$this->session->userdata("so_number");
			if(!$so_number) {
				$this->checkout_save();
			} else {
				$this->checkout_view();
			}
			$this->clear_cart();
		} else {
			$url=base_url()."index.php/eshop/login";
			header("location:".$url);
		}
	}
	function nomor_bukti($add=false)
	{
		$this->load->model("sales_order_model");
		$key="Sales Online Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!1~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!1~$00001');
				$rst=$this->sales_order_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	function confirm(){
		$data['caption']='KONFIRMASI';
		$this->template_eshop->display("eshop/confirm",$data);
	}
	function confirm_save(){
		$so_number=$this->session->userdata("so_number");
		$data=$this->input->post();
		$data['invoice_number']=$so_number;
		$data['how_paid']="TRANSFER";
		$this->load->model("payment_model");
		$ok=$this->payment_model->save($data);
		
		$this->load->model("sales_order_model");
		$this->sales_order_model->recalc($so_number);
		$this->db->where("sales_order_number",$so_number)
			->update("sales_order",array("status"=>1));
		
		$this->session->unset_userdata("so_number");
		
		echo json_encode(array("success"=>$ok,$message="Finih"));
	}
	
}
?>