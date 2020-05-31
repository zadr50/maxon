<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Service extends CI_Controller {
    private $limit=10;
    private $sql="select b.*,c.company
            from service_order b
            left join customers c on c.customer_number=b.customer";
    private $controller='so/service';
    private $primary_key='no_bukti';
    private $file_view='sales/service';
    private $table_name='service_order';
	
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library(array('sysvar','javascript','template','list_of_values'));
		$this->load->library('form_validation');
		$this->load->model(array('sysvar_model','sales/service_order_model',
			'customer_model','syslog_model','inventory_model',));
		 
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        if(!$record){
    		$data['mode']='';
    		$data['message']='';
    		$data['no_bukti']="AUTO";    //$this->nomor_bukti();
    		$data['tanggal']= date("Y-m-d H:i:s");
        }
        $data['lookup_customer']=$this->customer_model->lookup();
        $data['lookup_jenis_masalah']=$this->sysvar_model->lookup(
        	array("dlgBindId"=>"jenis_masalah_service",
        		"dlgId"=>"jenis_masalah_service",
        		"dlgRetFunc"=>"$('#jenis_masalah').val(row.varvalue);")
			);
		$data['lookup_item_service']=$this->inventory_model->lookup_by_class(
			array("class"=>"service","dlgRetFunc"=>"$('#serial').val(row.item_number);")
			);
		
		return $data;
	}
	function index()
	{	
        $this->browse();
	}
	function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
	}
	function nomor_bukti($add=false)
	{
		$key="Service Order Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!SOW~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!SOW~$00001');
				$rst=$this->service_order_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}

	function add()
	{
		//if(!allow_mod2('_40131'))return false;
		
	 	$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$data['message']='';
        $data['customer_info']="";
		$this->template->display_form_input($this->file_view,$data,'');			                 
		
	}
	function save(){
		$data=$this->input->post();
		$id=$data['no_bukti'];
		$mode=$data['mode'];unset($data['mode']);
		if($mode=="add"){
	        $id=$this->nomor_bukti();
			$data['no_bukti']=$id;
			if($ok=$this->service_order_model->save($data)){
				$this->syslog_model->add($id,"service_order","add");
				$this->nomor_bukti(true);
			}
		} else {
			unset($data['service_order']);
			$ok=$this->service_order_model->update($id,$data);			
			$this->syslog_model->add($id,"service_order","edit");
		}
		if ($ok){
			echo json_encode(array('success'=>true,'no_bukti'=>$id,"msg"=>"Success"));
		} else {
			echo json_encode(array('success'=>false,'msg'=>'Some errors occured.'));
		}
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select p.* from service_jobs p where service_number='$nomor'";		 
		echo datasource($sql);
	}
	function view($id,$message=null){
		//if(!allow_mod2('_40130'))return false;
		$id=urldecode($id);
		 $model=$this->service_order_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['no_bukti']=$id;
		 $data['mode']='view';
         $data['message']=$message;
         $data['customer_info']=$this->customer_model->info($data['customer']);
		
         $this->template->display('sales/service',$data);                 
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('no_bukti','Nomor', 'required|trim');
		 $this->form_validation->set_rules('tanggal','Tanggal','callback_valid_date');
	}
	 
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date','Format tanggal salah, seharusnya yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
    function browse($offset=0,$limit=50,$order_column='nomor',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor','Tanggal','Customer','Jumlah',
		  'Mesin','Teknisi','Masalah');
		$data['fields']=array('no_bukti','tanggal','company','service_amt',
		  'serial','serv_rep','masalah');
		$data['field_key']=$this->primary_key;
		$data['caption']='DAFTAR SERVICE ORDER';
		$data['posting_visible']=false;
        $data['fields_format_numeric']=array("service_amt");

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_number");
		$faa[]=criteria("Customer","sid_customer");
		$faa[]=criteria("Teknisi","sid_teknisi");
		$faa[]=criteria("Mesin/Item","sid_item");

		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
            
        $sql=$this->sql." where 1=1 ";
        
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
            $sql.=" and no_bukti = '$search'";
        } else {
        
        	if($this->input->get('sid_number')!=''){
        		$sql.=" and no_bukti='".$this->input->get('sid_number')."'";
    		} else {
    			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
    			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
    			$sql.=" and tanggal between '".$d1."' and '".$d2."'";
    			if($this->input->get('sid_customer')!='')$sql.=" and company like '".$this->input->get('sid_customer')."%'";
    		}
            
        }
        echo datasource($sql);
    }	 
	function delete($id){
		//if(!allow_mod2('_40133'))return false;
		$id=urldecode($id);
		$this->db->query("delete from service_order where no_bukti='$id'");
		$this->db->query("delete from service_jobs where service_number='$id'");
		echo json_encode(array("success"=>true,"msg"=>"Berhasil hapus nomor ini."));		
		$this->syslog_model->add($id,"service_order","delete");
	}
        function print_bukti($nomor){
			$nomor=urldecode($nomor);
            $data=$this->service_order_model->get_by_id($nomor)->row_array();
			$data['content']=load_view('sales/rpt/print_service',$data);
			$this->load->view('pdf_print',$data);
        }
        function summary_info($nomor){
			$nomor=urldecode($nomor);
            return "";            
        }
        function create_invoice($from_service_no){
        	$service=null;
			if($q=$this->service_order_model->get_by_id($from_service_no)){
				$service=$q->row();
			}
			if(!$service){
				$this->view($from_service_no,array("message"=>"Error create new invoice !"));
				return false;
			}
			if($service->service_amt<=0){
				$this->view($from_service_no,array("message"=>"Jumlah service belum diisi !"));
				return false;
			}
			$this->load->model(array("invoice_model","invoice_lineitems_model","inventory_model"));
			
			$nomor_faktur=$this->invoice_model->nomor_bukti();
			
			$data_head=array("invoice_number"=>$nomor_faktur,"invoice_date"=>date("Y-m-d H:i:s"), 
				"invoice_type"=>"I","type_of_invoice"=>"Service","sold_to_customer"=>$service->customer,
				"ship_to_customer"=>$service->customer,"amount"=>$service->service_amt,
				"comments"=>$service->masalah,"payment_terms"=>"KREDIT","warehouse_code"=>current_gudang(),
				"salesman"=>user_id(),"currency_code"=>"IDR","currency_rate"=>1,
				"shipped_via"=>$service->transportasi,"sales_order_number"=>$from_service_no,
				"due_date"=>date("Y-m-d H:i:s")
			);
			$ok = $this->invoice_model->save($data_head);
			if($ok){
				$kode_jasa=$service->serial;
				$nama_jasa="Service Item";
				$unit="Pcs";
				if($qstk=$this->inventory_model->get_by_id($kode_jasa)){
					if($rstk=$qstk->row()){
						$nama_jasa=$rstk->description;
						$unit=$rstk->unit_of_measure;
					}
				}
				$data_item=array(
					"invoice_number"=>$nomor_faktur,"item_number"=>$kode_jasa,
					"description"=>$nama_jasa,"quantity"=>1,"unit"=>$unit,
					"price"=>$service->service_amt,"amount"=>$service->service_amt,
					"warehouse_code"=>current_gudang(),"currency_code"=>"IDR",
					"currency_rate"=>1
				);
				$this->invoice_lineitems_model->save($data_item);
			}
			redirect("invoice/view/".$nomor_faktur);
        }
}
