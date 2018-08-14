<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Umur_barang extends CI_Controller {

	function __construct()
	{
		parent::__construct();        
         
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->model('supplier_model');
		$this->load->library("browse");
		$this->load->model("inventory_model");
		$this->load->model("category_model");
	}
	function index()
	{	
		$data['title']="Umur Barang";
        $data['supplier_list']=$this->supplier_model->lov('supplier');
		$data['item_list']=$this->inventory_model->lov('item_no');
		$data['category_list']=$this->category_model->lov('category');
        $this->template->display("purchase/umur_barang",$data);                 
	}
	
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select il.item_number,il.description,
		il.last_inventory_date,now() as tgl_hrini,datediff(now(),il.last_inventory_date) as umur,
		il.quantity_in_stock,il.supplier_number,s.supplier_name,il.category
		from inventory il left join suppliers s on s.supplier_number=il.supplier_number 
		where 1=1";
		if($data=$this->input->get()){
			if($data['supplier']!="")$sql.=" and il.supplier_number='".$data['supplier']."'";
			if($data['item_no']!="")$sql.=" and (il.item_number='".$data['item_no']."' or il.description like '".$data['item_no']."%')";
			if($data['category']!="")$sql.=" and il.category='".$data['category']."'";
			if($data['umur']!="")$sql.=" and datediff(now(),il.last_inventory_date)>".$data['umur'];
			
		} else {
			$sql.=" limit 0";
		}
        echo datasource($sql);
    }	 	
}
