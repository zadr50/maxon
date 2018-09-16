<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Aktiva_sale extends CI_Controller {
    private $limit=10;
    private $table_name='fa_asset_transaction';
    private $sql="select f.journal_id,f.trans_date,f.asset_id,f.trans_value,f.trans_type,
    fa.description,f.vendor_id 
	from fa_asset_transaction f 
	left join fa_asset fa on fa.id=f.asset_id
	";
    private $file_view='aktiva/asset_sale';
    private $primary_key='journal_id';
    private $controller='aktiva_sale';
    
	function __construct()
	{
		parent::__construct();

		if(!$this->access->is_login())redirect(base_url());
        
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model(array('aktiva_tran_model','aktiva_model',
			'bank_accounts_model','customer_model','syslog_model'));
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
			$data['trans_date']=date("Y-m-d H:i:s");
			$data['journal_id']=$this->nomor_bukti();
			 $data['bank_name']="";
			 $data['customer_name']="";
			 $data['asset_name']="";
			 
		$data['lookup_fa_asset']=$this->list_of_values->render(array(
			"dlgBindId"=>"fa_asset",
			"dlgColsData"=>array("description","id"),
			"dlgRetFunc"=>"$('#asset_id').val(row.id);
				$('#asset_name').html(row.description);
			"			
		));
			 
		$data['lookup_customers']=$this->list_of_values->render(array(
			"dlgBindId"=>"customers",
			"dlgColsData"=>array("company","customer_number"),
			"dlgRetFunc"=>"$('#vendor_id').val(row.customer_number);
			$('#customer_name').html(row.company);"			
		));
		$data['lookup_bank_accounts']=$this->list_of_values->render(array(
			"dlgBindId"=>"bank_accounts",
			"dlgColsData"=>array("bank_account_number","bank_name"),
			"dlgRetFunc"=>"$('#cash_bank_ap').val(row.bank_account_number);
				$('#bank_name').html(row.bank_name);
			"			
		));
			 
			 
            return $data;
	}
	function nomor_bukti($add=false)
	{
		$key="Asset Tran Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!AI~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!AI~$00001');
				$rst=$this->aktiva_tran_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}	
	function index()
	{	
            $this->browse();
	}
	function get_posts(){
            $data=  data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$this->template->display_form_input($this->file_view,$data,'');
	}
	function save(){
		$mode=$this->input->post("mode");
		$this->_set_rules();
		$data=$this->get_posts();
		$data['asset_name']="";
		$data['customer_name']="";
		$data['bank_name']="";
		$data['trans_type']=0;
 		$id=$data['journal_id'];
		if($mode=="add"){
	        $data['journal_id']=$this->nomor_bukti();
		}
		$data['message']='Save Success';
		$data['mode']='view';
		if ($this->form_validation->run()=== TRUE){
			unset($data['message']);
			unset($data['mode']);
			unset($data['asset_name']);
			unset($data['customer_name']);
			unset($data['bank_name']);
			if($mode=="add"){
				$this->aktiva_tran_model->save($data);
				$data['message']="";
				if($data['message']==''){
					if($mode=="add") $this->nomor_bukti(true);
					$data['mode']='view';					
					$data['message']='Data sudah disimpan.';
					$data['journal_id']=$id;
					
					$this->syslog_model->add($id,"asset_sale","add");
				} else {
					$data['mode']='add';
				}
			} else {
				$this->aktiva_tran_model->update($id,$data);
				$data['message']="";
				if($data['message']==''){
					$data['message']='Data sudah disimpan.';
					$this->syslog_model->add($id,"asset_sale","edit");
				}
				$data['mode']='view';
			}
			 $data['bank_name']=$this->bank_accounts_model->get_bank_name($data["cash_bank_ap"]);
			 $data['customer_name']=$this->customer_model->get_company($data["vendor_id"]);
			 $data['asset_name']=$this->aktiva_model->get_asset_name($data["asset_id"]);
			
		} else {
			$data['message']='Error Validation.';
		}
		$def=$this->set_defaults();
		$data['lookup_fa_asset']=$def['lookup_fa_asset'];
		$data['lookup_customers']=$def['lookup_customers'];		
		$data['lookup_bank_accounts']=$def['lookup_bank_accounts'];	
		$this->template->display_form_input($this->file_view,$data,'');


	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $data['journal_id']=$id;
		 $model=$this->aktiva_tran_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['bank_name']=$this->bank_accounts_model->get_bank_name($data["cash_bank_ap"]);
		 $data['customer_name']=$this->customer_model->get_company($data["vendor_id"]);
		 $data['asset_name']=$this->aktiva_model->get_asset_name($data["asset_id"]);
		 $data['mode']='view';
         $data['message']=$message;
         $this->template->display_form_input($this->file_view,$data,'');
	}

	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules($this->primary_key,'Kode', 'required|trim');
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
    function browse($offset=0,$limit=50,$order_column='',$order_type='asc'){
		$data['controller']='aktiva/'.$this->controller;
		$data['fields_caption']=array('Bukti','Tanggal','Aktiva','Type','Jumlah',"Nama Asset",
			"Customer");
		$data['fields']=array( 'journal_id','trans_date','asset_id','trans_type','trans_value',
			"description",'vendor_id');
		$data['field_key']='journal_id';
		$data['caption']='DAFTAR PENJUALAN AKTIVA TETAP';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_number");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where trans_type='0'";
		if($this->input->get('sid_number')!='')$sql.=" and journal_id like '".$this->input->get('sid_number')."%'";	
		if($this->input->get('sid_nama')!='')$sql.=" asset_id like '".$this->input->get('sid_nama')."%'";
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";

        echo datasource($sql);
    }	 
	function delete($id){
		 $id=urldecode($id);
	 	$this->aktiva_tran_model->delete($id);
	 	$this->browse();
	}
}
