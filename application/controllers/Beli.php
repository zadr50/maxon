<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Beli extends CI_Controller {
        private $limit=10;
	function __construct()
	{
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('purchase_order_model');
		$this->load->model('supplier_model');
		$this->load->model('inventory_model');
		$this->load->model('syslog_model');
		 
	}
	function set_defaults($record=NULL){
		$data['library_src'] = $this->jquery->script();
		$data['script_head'] = $this->jquery->_compile();
		$data['mode']='';
		$data['message']='';
		$data['lineitems']='';
		$data['beli_list']='';
		$data['warehouse_code']=$this->access->cid;
		$data['sum_info']='';
		if($record==NULL){
			$data['purchase_order_number']=$this->sysvar
                                ->autonumber($this->access->cid." Pembelian Numbering",0,
                                '!FB'.$this->access->cid.'~$00001');
			$data['supplier_number']='';
			$data['po_date']= date("Y-m-d");
                        $data['potype']='I';
                        $data['amount']='0';
                        $data['items']='';
		} else {
			$data['purchase_order_number']=$record->purchase_order_number;
			$data['supplier_number']=$record->supplier_number;
			$data['po_date']=$record->po_date;
                        $data['potype']='I';
                        $data['amount']=$record->amount;
                        $data['items']='';
		}
		return $data;
	}
	function index()
	{	
            
            $this->browse();
           
	}
	function get_posts(){
		$data['purchase_order_number']=$this->input->post('purchase_order_number');
		$data['supplier_number']=$this->input->post('supplier_number');
		$data['po_date']=$this->input->post('po_date');
                $data['potype']=$this->input->post('potype');
                $data['amount']=$this->input->post('amount');
                $data['warehouse_code']=$this->access->cid;
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                           
                        $data['potype']='I';
			$this->purchase_order_model->save($data);
			$id=$this->input->post('purchase_order_number');
			$this->sysvar->autonumber_inc($this->access->cid." Pembelian Numbering");

			$this->syslog_model->add($id,"purchase_invoice","add");			

			redirect('/beli/view/'.$id, 'refresh');
		} else {
                        
			$data['mode']='add';
			$data['message']='';
                        $data['supplier_number']=$this->input->post('supplier_number');
                        $data['supplier_list']=$this->supplier_model->supplier_list();
                        if($data['po_date']=='')$data['po_date']= date("Y-m-d");
                        $data['potype']='I';
                        $data['amount']=$this->input->post('amount');
			$this->template->display_form_input('beli',$data,'purchase_order_menu');			
		}
             
                 
	}
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('purchase_order_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->purchase_order_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"purchase_invoice","edit");			

		} else {
			$message='Error Update';
		}
                
 		$this->view($id,$message);		
	}
	function add_item($id){
		$id=urldecode($id);
		$item=$this->input->get('item');  
		$qty=$this->input->get('qty');  
		$this->purchase_order_model->add_item($id,$item,$qty);
		echo $this->lineitems($id);
	}
	function del_item($line,$id){
		$id=urldecode($id);
		$this->purchase_order_model->del_item($line);
		echo $this->lineitems($id);
	}
	function view($id,$message=null){
		$id=urldecode($id);
		$this->load->model('inventory_model');
		$data['id']=$id;
		$model=$this->purchase_order_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['mode']='view';
		$data['message']=$message;
		$data['supplier_list']=$this->supplier_model->lookup();  
		$data['table']=$this->inventory_model->lookup();
		$data['pagination']='';
		$data['lineitems']=$this->lineitems($id);                 
		$this->load->model('supplier_model');
		$data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
		$this->purchase_order_model->recalc($id);
		$data['sum_info']= '
		Jumlah Faktur Rp. '.number_format($this->purchase_order_model->amount)
		 .'<br/>Jumlah Bayar   Rp. '.number_format($this->purchase_order_model->amount_paid)
		 .'<br/>Jumlah Saldo   Rp. '.number_format($this->purchase_order_model->saldo);


		$this->template->display_form_input('beli',$data,'purchase_order_menu');
	}
	function lineitems($id){
		$id=urldecode($id);
		$sql="select item_number,description,price,
			quantity,total_price,line_number
			from purchase_order_lineitems where purchase_order_number='".$id."' 
			order by line_number    
			";
		$s=browse_select(array('sql'=>$sql,
			'hidden'=>array('line_number','price'),
			'field_key'=>'line_number'
		));
	   return $s;
    }
         
	function _set_rules(){	
		 $this->form_validation->set_rules('purchase_order_number','Nomor Faktur', 'required|trim');
		 $this->form_validation->set_rules('po_date','Tanggal','callback_valid_date');
	}
	 
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'Format tanggal salah, seharusnya yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
	function browse($offset=0,$limit=50,$order_column='purchase_order_number',$order_type='asc'){
		//var_dump($_GET);
		$header=array('Nomor','Tanggal','Jumlah','Supplier','Supplier Name','Kota','Toko');
		$caption="DAFTAR FAKTUR PEMBELIAN";
		$data['_content']=browse("select purchase_order_number, 
			po_date, amount, 
			i.supplier_number,c.supplier_name,c.city,i.warehouse_code
			from purchase_order i
			left join suppliers c on c.supplier_number=i.supplier_number
			where potype='i' and warehouse_code='".$this->access->cid."'
			",$caption,'beli'
			,$offset,$limit,$order_column,$order_type,$header
				
			);
		$this->template->display_browse('template_browse',$data);
	}
	 
	function delete($id){
		$id=urldecode($id);
	 	$this->purchase_order_model->delete($id);
		$this->syslog_model->add($id,"purchase_invoice","delete");			

		$this->browse();
	}
        
	function print_faktur($nomor){
		$nomor=urldecode($nomor);
		$this->load->helper('mylib');
		$invoice=$this->purchase_order_model->get_by_id($nomor)->row();
		$data['purchase_order_number']=$invoice->purchase_order_number;
		$data['po_date']=$invoice->po_date;
		$data['supplier_number']=$invoice->supplier_number;
		$data['amount']=$invoice->amount;
		$caption='';
		$sql="select item_number,description,
			quantity,unit,price,amount 
			from purchase_order_lineitems i
			where purchase_order_number='".$nomor."'";
		$caption='';$class='';$field_key='';$offset='0';$limit=100;
		$order_column='';$order_type='asc';
		$item=browse_select($sql, $caption, $class, $field_key, $offset, $limit, 
					$order_column, $order_type,false);
		$data['lineitems']=$item;
		$this->load->model('suppliers_model');
		$data['supplier_info']=$this->suppliers_model->info($data['supllier_number']);
		$data['header']=company_header();
		
		$this->load->view('purchase_order_print',$data);
	}
	function sum_info(){
		$nomor=$_GET['nomor'];
		$saldo=$this->purchase_order_model->recalc($nomor);
		echo 'Jumlah Faktur: Rp. '.  number_format($this->purchase_order_model->amount);
		echo '<br/>Jumlah Bayar : Rp. '.  number_format($this->purchase_order_model->amount_paid);
		echo '<br/>Jumlah Sisa  : Rp. '.  number_format($saldo);            
	}
}
