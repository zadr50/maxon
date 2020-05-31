<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Admin extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
 		$this->load->library('template');
	}
	function index() {	
		$data['message']='';
		$this->template->display_eshop('eshop/admin/page',$data);
	}
	function orders($page=0) {	
		$data['message']='';
		if($page<0)$page=0;
		$max_page=$this->db->count_all("sales_order");
		if($max_page>0)$max_page=$max_page/10;
		if($page>$max_page)$page=$max_page;
		$data['item_page_max']=$max_page;
		$data['page']=$page;
		$this->template->display_eshop_admin('eshop/admin/orders',$data);
	}
	function items($page=0) {	
		$data['message']='';
		if($page<0)$page=0;
		$max_page=$this->db->count_all("inventory");
		if($max_page>0)$max_page=$max_page/10;
		if($page>$max_page)$page=$max_page;
		$data['item_page_max']=$max_page;
		$data['page']=$page;
		$this->template->display_eshop_admin('eshop/admin/items',$data);
	}
	function customers($page=0) {	
		$data['message']='';
		if($page<0)$page=0;
		$max_page=$this->db->count_all("customers");
		if($max_page>0)$max_page=$max_page/10;
		if($page>$max_page)$page=$max_page;
		$data['item_page_max']=$max_page;
		$data['page']=$page;
		$this->template->display_eshop_admin('eshop/admin/customers',$data);
	}
	function categories($page=0) {	
		$data['message']='';
		if($page<0)$page=0;
		$max_page=$this->db->count_all("inventory_categories");
		if($max_page>0)$max_page=$max_page/10;
		if($page>$max_page)$page=$max_page;
		$data['item_page_max']=$max_page;
		$data['page']=$page;
		$this->template->display_eshop_admin('eshop/admin/categories',$data);
	}
	
}