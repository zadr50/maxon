<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Dashboard extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index() {	
		if( !$this->session->userdata('cust_login')) {
			header("location: ".base_url()."index.php/eshop/home");
			exit;
		}
		$data['message']='';
		$data['caption']="Administrator Page";
		$breadcrumb=array();		
		$data['breadcrumb']=$breadcrumb;
		$sql="select period,count(1) as visit_count from maxon_log_ip 
		where DATE_FORMAT(NOW(),'%Y%m')='".date("Ym")."'";

		$data['user_online_count']=$this->db->query($sql)->row()->visit_count;
		$this->template_eshop_admin->display('eshop/admin/dashboard',$data);
	}	
	function gfx_sales()
	{
		$sql="select DATE_FORMAT(sales_date, '%Y-%m-%d') as period,sum(s.amount) as x_amount 
		from sales_order s 
		group by DATE_FORMAT(sales_date, '%Y-%m-%d')
		having sum(s.amount)>0	
		limit 0,100";
//		where s.paid=true
		$query=$this->db->query($sql);
		
		foreach($query->result() as $row){
			$kode=$row->period;
			$amount=$row->x_amount;
			if($amount==null)$amount=0;
			//if($amount>0)$amount=round($amount/1000);
			$data2[]=array(substr($kode,0,20),$amount);
		}
		header('Content-type: application/json');
		$data['label']="Grafik Penjualan";
		$data['data']=$data2;
		echo json_encode($data);
	}
	function gfx_visit()
	{
		$sql="select period,count(1) as cnt from maxon_log_ip 
		group by period";
		$query=$this->db->query($sql);
		foreach($query->result() as $row) 
		{
			$kode=$row->cnt;
			$data2[]=array($row->period,(int)$row->cnt);
		}
		header('Content-type: application/json');
		$data['label']="Grafik Kunjungan";
		$data['data']=$data2;
		echo json_encode($data);
	}
	function gfx_purchase()
	{
		$sql="select DATE_FORMAT(purchase_date, '%Y-%m-%d') as period,sum(s.amount) as x_amount 
		from purchase_order s 
		group by DATE_FORMAT(sales_date, '%Y-%m-%d')
		having sum(s.amount)>0	
		limit 0,100";
		$query=$this->db->query($sql);
		foreach($query->result() as $row) 
		{
			$kode=$row->cnt;
			$data2[]=array($row->period,$row->cnt);
		}
		header('Content-type: application/json');
		$data['label']="Grafik Pembelian";
		$data['data']=$data2;
		echo json_encode($data);
	}
	function gfx_item_value()
	{
		$sql="select item_number,sum(d.amount) as x_amount 
		from  sales_order s left join sales_order_lineitems d 
		on s.sales_order_number=d.sales_order_number
		group by item_number
		having sum(d.amount)>0	
		limit 0,100";
		$query=$this->db->query($sql);
		foreach($query->result() as $row) 
		{
			$data2[]=array($row->item_number,(int)$row->x_amount);
		}
		header('Content-type: application/json');
		$data['label']="Grafik Item Value Summary";
		$data['data']=$data2;
		echo json_encode($data);
	}
	
}