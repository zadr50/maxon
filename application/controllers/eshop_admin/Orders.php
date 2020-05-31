<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Orders extends CI_Controller {
	private $success=false;
	private	$message="";
	private $sql="select sales_order_number,sales_date,sold_to_customer,
	comments,amount,status,paid,payment_terms 
	from sales_order";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index(){ $this->browse(); }
	
	function browse($page=0,$limit=0) {	
		$data['message']='';
		$data['breadcrumb']=array(array("url"=>"orders/browse","title"=>"Orders"));	
		$data['page']=$page;
		$data['limit']=$limit;
		$data['cmd']='list';
		
		$this->template_eshop_admin->display('eshop/admin/order',$data);
	}
	function view($id) {
		$id=urldecode($id);
		
		$this->sql.=" where sales_order_number='$id'";
		$record=$this->db->query($this->sql)->result();
		$data=to_array($record); 
		
		$data['caption']="Manage Sales Order";
		$data['sales_order_number']=$id;
		$data['mode']='view';
		$breadcrumb=array(
			array("url"=>"orders/browse","title"=>"Orders"),
			array("url"=>"orders/view/".$id,"title"=>"Edit")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
		$data['status_payment']=array("Lunas","Belum Lunas");
		$this->template_eshop_admin->display("eshop/admin/order",$data);
	}
	function add() { $this->browse(); }
	
	function addnew(){
		 
		$data=array("sales_order_number"=>"",'sales_date'=>'','sold_to_customer'=>'',
		'amount'=>'','payment_terms'=>'','comments'=>'','status'=>'',
		'paid'=>''); 
		
		$data['caption']='Addnew Sales Order';
		$data['mode']='add';
		$breadcrumb=array(
			array("url"=>"orders/browse","title"=>"Orders"),
			array("url"=>"orders/add","title"=>"Addnew")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='add';
		$this->template_eshop_admin->display("eshop/admin/order",$data);
	}
	function delete($id) {
		$id=urldecode($id);
		$data['success']=$this->db->where("sales_order_number",$id)->delete("sales_order");
		$data['success']=$this->db->where("sales_order_number",$id)->delete("sales_order_lineitems");
		$data['success']=$this->db->where("invoice_number",$id)->delete("payments");
		$data['message']="OK";
		echo json_encode($data);
	}
	function save(){
		$data=$this->input->post();
		$kode=$data['sales_order_number'];
		$mode=$data['mode'];
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->db->insert("sales_order",$data);
		} else {
			unset($data['sales_order_number']);
			$ok=$this->db->where("sales_order_number",$kode)->update("sales_order",$data);
		}
		$data2['success']=$ok;
		if($ok){
			$data2['message']="Berhasil.";
		} else {
			$data2['message']="Gagal.";
		}
		echo json_encode($data2);
	}	
	function update()
	{
		$data_order['status']=$this->input->get('status');
		$data_order['paid']=$this->input->get('paid');

		$nomor=$this->input->get('sales_order_number');

		$data_order['shipped_via']=$this->input->get("courier");
		$data_order['ship_date']=date('Y-m-d',strtotime($this->input->get("dvDate")));
		$data_order['ship_day']=$this->input->get("dvDay");
		$data_order['ship_weight']=$this->input->get("dvWg");
		$data_order['ship_no']=$this->input->get("dvNo");
		
		$success=$this->db->where("sales_order_number",$nomor)->update("sales_order",$data_order);
		
/* 		$data_delivery['shipped_via']=$this->input->get("courier");
		$data_delivery['ship_date']=$this->input->get("date_delivery");
		$data_delivery['ship_day']=$this->input->get("day_delivery");
		$data_delivery['ship_weight']=$this->input->get("weight_items");
 */		
		$message=($success)?"Data berhasil disimpan.":"Error !";
		echo json_encode(array("success"=>$success,"message"=>$message));
	}
	
} ?>