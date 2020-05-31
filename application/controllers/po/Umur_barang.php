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
	
    function browse_data($offset=0,$limit=30,$nama=''){
		$sql="select il.item_number,il.description,
		il.last_inventory_date,now() as tgl_hrini,coalesce(datediff(now(),il.last_inventory_date),0) as umur,
		il.quantity_in_stock,il.supplier_number,s.supplier_name,il.category
		from inventory il join suppliers s on s.supplier_number=il.supplier_number 
		where 1=1";
		$umur=30;
		if($data=$this->input->get()){
			if($data['supplier']!="")$sql.=" and il.supplier_number='".$data['supplier']."'";
			if($data['item_no']!="")$sql.=" and (il.item_number='".$data['item_no']."' or il.description like '".$data['item_no']."%')";
			if($data['category']!="")$sql.=" and il.category='".$data['category']."'";
			if($data['umur']!="")$umur=$data['umur'];
		} 
		$sql.=" and coalesce(datediff(now(),il.last_inventory_date),0)>$umur";		
		
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
		//echo $sql;
		
        echo datasource($sql);
    }	 	
}
