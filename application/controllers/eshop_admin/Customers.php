<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Customers extends CI_Controller {
	private $success=false;
	private	$message="";
	private $sql="select customer_number,company,street,city,
	phone,email,password,zip_postal_code
	from customers";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index() {
		$this->browse();
	}
	function browse($page=0,$limit=10)
	{
		$data['message']='';
		$data['breadcrumb']=array(array("url"=>"customers/browse","title"=>"Customers"));	
		$data['page']=$page;
		$data['limit']=$limit;
		$data['cmd']='list';
		$this->template_eshop_admin->display('eshop/admin/customer',$data);		
	}
	function add() {
		$data=$this->set_default();
		$data['caption']='Addnew Customer';
		$data['mode']='add';
		$breadcrumb=array(
			array("url"=>"customers/browse","title"=>"Customers"),
			array("url"=>"customers/add","title"=>"Addnew")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
		$this->template_eshop_admin->display("eshop/admin/customer",$data);
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
	
	function load_json($id) 
	{
		$id=urldecode($id);
		$success=false;
		$message='Unknown $id';
		$data=$this->set_default();
		if($q=$this->db->where("customer_number",$id)->get("customers"))
		{
			if($row=$q->row())
			{
				$data['customer_number']=$row->customer_number;
				$data['company']=$row->company;
				$data['street']=$row->street;
				$data['city']=$row->city;
				$data['zip_postal_code']=$row->zip_postal_code;
				$data['password']=$row->password;
				$data['email']=$row->email;
				$data['password']=$row->password;				
				$success=true;
				$message='Loaded';
			}
		}
		$data['success']=$success;
		$data['message']=$message;
		echo json_encode($data);
	}
	function delete($id)
	{
		$id=urldecode($id); 
		$message="Success";
		if( !$success=$this->db->where("customer_number",$id)->delete("customers") )
		{
			$message="Unable Delete Record.";
		}
		echo json_encode(array("result"=>$success,"message"=>$message));
	}
	function view($id)
	{
		$id=urldecode($id);
		
		$this->sql.=" where customer_number='$id'";
		$record=$this->db->query($this->sql)->result();
		$data=to_array($record); 
		
		$data['caption']="Manage Customers";
		$data['item_number']=$id;
		$data['mode']='view';
		$breadcrumb=array(
			array("url"=>"customers/browse","title"=>"Customers"),
			array("url"=>"customers/view/".$id,"title"=>"Edit")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
		$this->template_eshop_admin->display("eshop/admin/customer",$data);
	}
	function save(){
		$data=$this->input->post();
		$kode=$data['customer_number'];
		$mode=$data['mode'];
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->db->insert("customers",$data);
		} else {
			unset($data['customer_number']);
			$ok=$this->db->where("customer_number",$kode)->update("customers",$data);
		}
		$data2['success']=$ok;
		if($ok){
			$data2['message']="Berhasil.";
		} else {
			$data2['message']="Gagal.";
		}
		echo json_encode($data2);
	}	
}