<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Categories extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$this->view();
	}
	function brand($brand='') {
		$brand=urldecode($brand);
		$this->db->where('manufacturer',$brand)->limit(200);
		$data['cat_items']=$this->db->get("inventory");
		$this->template_eshop->display('eshop/category',$data);
		
	}
	function view($cat_id='',$price_range_type=null) {	
		$cat_id=urldecode($cat_id);
		if($cat_id=='' or $cat_id=="all") {
			$this->template_eshop->display('eshop/category_list');
		} else {
			if( !$search_items=$this->input->post('search_items')){
				$search_items='';
			}
			if( $this->input->post('search_category')) {
				$cat_id=$this->input->post('search_category');
			}
			$this->session->set_userdata("current_category",$cat_id);
			$data['message']='';
			$data['cat_id']=$cat_id;
			$data['mode']='view';
			$data['cat']=$this->db->where("kode",$cat_id)->get("inventory_categories")->row();
			$data['cat_sub']=$this->db->select("kode,category")
					->where("parent_id",$cat_id)->get("inventory_categories");

			$price_from=$this->session->userdata('price_from');
			if(!$price_from)		$price_from=0;
			$data['price_from']		=$price_from;
			
			if($price_range_type) {
				$price_to=$this->session->userdata('price_to');
			} else {
				$price_to=10000000;
			}
			if(!$price_to)			$price_to=10000000;
			$data['price_to']		=$price_to;
			
			$price_range_type=$this->session->userdata('price_range_type');
			if(!$price_range_type)	$price_range_type=4;
			$data['price_range_type']=$price_range_type;
			
			
			$sales_stat_type=$this->session->userdata('sales_stat_type');
			if(!$sales_stat_type)	$sales_stat_type=0;
			
			$this->db->where("category",$cat_id);
			$this->db->where("retail between $price_from and $price_to ","",FALSE);
			$this->db->select('item_number,description,item_picture,retail');
			if($sales_stat_type==0){	//item baru
				$this->db->order_by("view_count");
			}
			if($sales_stat_type==1){	//item paling banyak dilihat
				$this->db->order_by("view_count","desc");
			}	
			if($sales_stat_type==2){	// item terlaris
				$this->db->order_by("sales_count","desc");
			}
			$this->db->limit(200);
			$data['cat_items']=$this->db->get("inventory");
			$data['data']=$data;
			$data['sales_stat_type']=$sales_stat_type;
			$data['search_items']=$search_items;
			$data['search_category']=$cat_id;		
			$data['cat_id']=$cat_id;		
			$this->template_eshop->display('eshop/category',$data);
		}
	}
	function view_price_range($price_range_type=0)
	{
		if(!$cur_cat_id=$this->session->userdata('current_category'))
		{
			$cur_cat_id='';
		}
		$this->session->set_userdata("price_range_type",$price_range_type);
		$this->view($cur_cat_id,$price_range_type);
	}
	function view_sales_stat($stat_type=0)
	{
		if(!$cur_cat_id=$this->session->userdata('current_category'))
		{
			$cur_cat_id='';
		}
		$this->session->set_userdata("sales_stat_type",$stat_type);
		$this->view($cur_cat_id);
	}
		
	
}