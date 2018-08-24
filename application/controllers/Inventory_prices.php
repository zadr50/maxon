<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Inventory_prices extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_prices';
    private $sql="select item_number,customer_pricing_code,quantity_high,quantity_low,date_from,date_to
                from inventory_class
                ";
    private $file_view='inventory/inventory_prices';
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_prices_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		if($record==NULL){
			$data['item_number']='';
			$data['customer_pricing_code']='';
		} else {
			$data['item_number']=$record->item_number;
			$data['customer_pricing_code']=$record->customer_pricing_code;
		}
		return $data;
	}
	function index()
	{	
            $this->browse();
	}
	function get_posts(){
		$data['item_number']=$this->input->post('item_number');
		$data['customer_pricing_code']=$this->input->post('customer_pricing_code');
		$data['quantity_high']=$this->input->post('quantity_high');
		$data['quantity_low']=$this->input->post('quantity_low');
		$data['date_from']=$this->input->post('date_from');
		$data['date_to']=$this->input->post('date_to');
		
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->inventory_prices_model->save($data);
	        $data['mode']='view';
	        $this->browse();
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post('item_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                      
			$this->inventory_prices_model->update($id,$data);
	        $message='Update Success';
			$this->syslog_model->add($id,"inventory_prices","edit");

	        $this->browse();
		} else {
			$message='Error Update';
     		$this->view($id,$message);		
		}	  
	}
	
	function view($id,$message=null){
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->inventory_prices_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
         $this->template->display_form_input('inventory/inventory_prices',$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('item_number','Kode', 'required|trim');
	}
	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'date format is not valid. yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')
	{
        $data['caption']='DAFTAR HARGA SATUAN BARANG';
		$data['controller']='inventory_prices';		
		$data['fields_caption']=array('Kode Barang','Satuan','Harga Jual','From Qty','To Qty','From Date','To Date');
		$data['fields']=array('item_number','customer_pricing_code','retail','quantity_high','quantity_low','date_from','date_to');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='item_number';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_kode");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql." where 1=1";
		if($this->input->get('sid_kode')!='')$sql.=" and customer_pricing_code='".$this->input->get('sid_kode')."'";
        echo datasource($sql);		
    }
	function delete($id){
		$id=urldecode($id);
	 	$this->inventory_prices_model->delete($id);
		$this->syslog_model->add($id,"inventory_prices","delete");

	 	$this->browse();
	}
	function filter($item='',$unit=''){
		$item=urldecode($item);
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'customer_pricing_code';
		$sql="select customer_pricing_code,quantity_high,cost,retail
		from inventory_prices  
		where item_number='".$item."' and customer_pricing_code like '%".$unit."%' 
		 order by $sort limit 1000 ";
		echo datasource($sql);
	}
}
