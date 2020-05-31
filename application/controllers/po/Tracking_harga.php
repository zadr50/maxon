<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Tracking_harga extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();        
         
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('supplier_model');
		$this->load->model('type_of_payment_model');
		$this->load->model('syslog_model');
		$this->load->library("browse");
		$this->load->model("inventory_model");
		 
	}
	function index()
	{	
		$data['title']="Tracking Harga Beli";
        $data['supplier_list']=$this->supplier_model->lov('supplier');
		$data['item_list']=$this->inventory_model->lov('item_no');
        $this->template->display("purchase/tracking_harga",$data);                 
	}
	
    function browse_data($offset=0,$limit=30,$nama=''){
		$sql="select il.item_number,il.description,il.price,i.po_date,i.purchase_order_number,
		i.supplier_number,s.supplier_name 
		from purchase_order_lineitems il  join purchase_order i on i.purchase_order_number=il.purchase_order_number
		 join suppliers s on s.supplier_number=i.supplier_number where 1=1";
		if($data=$this->input->get()){
			if($data['supplier']!="")$sql.=" and i.supplier_number='".$data['supplier']."'";
			if($data['item_no']!="")$sql.=" and (il.item_number='".$data['item_no']."' or il.description like '".$data['item_no']."%')";
		} 
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";



        echo datasource($sql);
    }	 
}
