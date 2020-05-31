<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Customer_type extends CI_Controller {
    private $limit=100;
    private $table_name='customer_type';
    private $file_view='sales/customer_type';
    private $controller='customer_type';
    private $primary_key='type_id';
    private $sql="";

    function __construct()    {
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		$this->load->model('customer_type_model');
		$this->load->model("syslog_model");

		$this->fields=$this->customer_type_model->fields;
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index()    {	
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
				$data=$this->get_posts();
				$this->customer_type_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
				$data['mode']='add';
				$data['message']='';
				$data['fields']=$this->fields;
				$data['data']=$data;
				$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("type_name");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->customer_type_model->save($data);
			$this->syslog_model->add($id,"customer_type","add");

		} else {
			$ok=$this->customer_type_model->update($id,$data);				
			$this->syslog_model->add($id,"customer_type","edit");

		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}	
    function view($id,$message=null)	{
		$id=urldecode($id);
		$message=urldecode($message);
		$data[$this->primary_key]=$id;
		$model=$this->customer_type_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['message']=$message;
		$data['fields']=$this->fields;
		$data['show_posting']=false;

		$this->load->model("customer_type_model");
		$data['item_prices']=$this->customer_type_model->get_prices($id);
		$data['lookup_inventory']=$this->list_of_values->lookup_inventory();
		$this->template->display_form_input($this->file_view,$data);
    }
     // validation rules
    function _set_rules(){}
    function valid_date($str){
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str)){
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']=$this->controller;
		$data['fields']=$this->customer_type_model->fields;
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']=$this->primary_key;
		$data['caption']='DAFTAR KELOMPOK CUSTOMER';

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Kelompok","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		$nama=$this->input->get('nama');
		if($nama!="")$sql .= " and type_name  like '%$nama%'";
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
		
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->customer_type_model->delete($id);
		$this->syslog_model->add($id,"customer_type","delete");

		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where type_name='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function delete_item_price($id){
		$ok=$this->db->where("id",$id)->delete("inventory_price_customers");
		echo json_encode(array("success"=>true,"msg"=>"Data berhasil dihapus"));
	}
	function save_item_price()
	{
		if($this->input->post()){
			$id=$this->input->post("id");
			$data['sales_price']=$this->input->post('sales_price');
			$data['min_qty']=$this->input->post('min_qty');
			$data['disc_prc_from']=$this->input->post('disc_prc_from');
			$data['disc_prc_to']=$this->input->post('disc_prc_to');			
			$data['cust_type']=$this->input->get("cust_type");
			$data['item_no']=$this->input->post('item_number');
			
		} else {
			$id=$this->input->get('i');
			$data['sales_price']=$this->input->get('p');
			$data['min_qty']=$this->input->get('q');
			$data['disc_prc_from']=$this->input->get('d1');
			$data['disc_prc_to']=$this->input->get('d2');			
			$data['cust_type']=$this->input->get('cust_type');
			$data['item_no']=$this->input->get('item_no');
		}
		if($id=="")$id=0;
		$message="Data berhasil disimpan, tekan refresh bila diperlukan";
		if($id>0){
			$ok=$this->db->where("id",$id)->update("inventory_price_customers",$data);
		} else {
			$ok=$this->db->insert("inventory_price_customers",$data);
		}
		if(!$ok)$message="Data tidak bisa disimpan !";
		echo json_encode(array("success"=>$ok,"msg"=>$message));
	}
	function browse_json($offset=0,$limit=100){
		$sql="select i.item_number,i.description,i.retail,ipc.sales_price,
			ipc.min_qty,ipc.disc_prc_from,ipc.disc_prc_to,ipc.id
			from inventory i left join inventory_price_customers ipc 
			on i.item_number=ipc.item_no";
		if($cust_type=$this->session->userdata("cust_type_price")){
			$sql.=" where ipc.cust_type='$cust_type' ";
		}
			
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
						
		echo datasource($sql); 
	}
}
?>
