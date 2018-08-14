<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Profit_sharing extends CI_Controller {
	
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
		$this->load->model('syslog_model');
		$this->load->library("browse");
		$this->load->model("inventory_model");
		$this->load->model("category_model");
		 
	}
	function index()
	{	
		$data['title']="Profit Sharing Konsinyasi";
        $data['supplier_list']=$this->supplier_model->lov('supplier','item_no');
		$data['item_list']=$this->inventory_model->lov('item_no');
		$data['category_list']=$this->category_model->lov('category','item_no');
        $this->template->display("purchase/profit_sharing",$data);                 
	}
	
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select p.type_code,p.item_no,p.item_name,p.profit_prc,p.date_from,p.date_to,
		p.remarks,p.id
		from profit_sharing p 
		where 1=1";
		if($data=$this->input->get()){
			if($data['item_no']!="")$sql.=" and p.item_no='".$data['item_no']."'";
		}  
        echo datasource($sql);
    }	 
	function save(){
		$data['success']=false;
		if($data=$this->input->post()){
			if($data['item_no']=="" or $data['type_code']==""){
				$data['msg']="Item belum dipilih atau profit belum diisi !";
			} else {
				$data['success']=$this->db->insert("profit_sharing",$data);
			}			
		} 
		echo json_encode($data);
	}
	function delete_row($id){
		$data['success']=$this->db->where("id",$id)->delete("profit_sharing");
		echo json_encode($data);
	}
}
