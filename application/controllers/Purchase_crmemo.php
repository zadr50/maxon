<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Purchase_CrMemo extends CI_Controller {
    private $limit=10;
    private $sql="select kodecrdb,tanggal,docnumber,amount,keterangan,c.account, 
    c.account_description,cm.posted
     from crdb_memo cm left join chart_of_accounts c on c.id=cm.accountid where transtype='PO-CREDIT MEMO'";
    private $controller='purchase_crmemo';
    private $primary_key='kodecrdb';
    private $file_view='purchase/credit_memo';
    private $table_name='crdb_memo';
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('crdb_model');
		$this->load->model('syslog_model');
        $this->load->model('supplier_model');
        $this->load->model('purchase_order_model');
				
	}
	function nomor_bukti($add=false)
	{
		$key="Purchase CrDB Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!CRDBP~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!CRDBP~$00001');
				$rst=$this->crdb_model->get_by_id($no)->row();
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
		if(!allow_mod2('_40090'))return false;   
        $this->browse();
	}
    function browse($offset=0,$limit=50,$order_column='',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Faktur','Jumlah','Keterangan','Kode Akun','Perkiraan',"Posted");
		$data['fields']=array('kodecrdb','tanggal','docnumber','amount','keterangan','account','account_description','posted');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='kodecrdb';
		$data['caption']='DAFTAR CREDI MEMO';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor BUkti","sid_number");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        
        $sql=$this->sql;
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }
        
    	if($this->input->get('sid_number')){
    		$sql.=" and kodecrdb='".$this->input->get('sid_number')."'";
    	} if($search!="") {
    		    $sql.=" and kodecrdb='$search'";
		} else {
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql.=" and tanggal between '".$d1."' and '".$d2."'";
		}
       

        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	
	function add()
	{
		if(!allow_mod2('_40091'))return false;   
        $data=$this->set_defaults();
		$data['kodecrdb']="AUTO";
		$data['tanggal']=date('Y-m-d H:i:s');
		$data['docnumber']='';
		$data['amount']=0;
		$data['keterangan']="";
		$data['mode']='add';
		$this->template->display_form_input('purchase/credit_memo',$data,'');			
		
	}
	function save()
	{
		 
		$invoice_number=$this->input->post('docnumber');
		if($invoice_number)
		{
            if($no=="AUTO")$no=$this->nomor_bukti();
            $data['kodecrdb']=$no;
			$data['tanggal']=$this->input->post('tanggal');
			$data['docnumber']=$invoice_number;
			$data['amount']=$this->input->post('amount');
			$data['keterangan']=$this->input->post('keterangan');
			$data['transtype']=$this->input->post('transtype');
            $data['prc_value']=$this->input->post('prc_value');
            
			$this->crdb_model->save($data);
			$this->nomor_bukti(true);
			$this->syslog_model->add($data['kodecrdb'],"crdb","edit");

		} else {echo 'Save: Invalid Invoice Number';}
	
	}
	function view($id,$message=null){
		if(!allow_mod2('_40090'))return false;   
		$id=urldecode($id);
        $id=urldecode($id);
         $data['id']=$id;
         $model=$this->crdb_model->get_by_id($id)->result_array();
         $data=$this->set_defaults($model[0]);
         $data['mode']='view';
         $q=$this->purchase_order_model->get_by_id($data['docnumber'])->row();
         $data['supplier_number']=$q->supplier_number;
         $data['faktur_info']=$q->po_date." Rp. ".number_format($q->amount);
         $q=$this->supplier_model->get_by_id($data['supplier_number'])->row();
         $data['supplier_name']=$q->supplier_name;
         $data['supplier_info']=$q->supplier_name." ".$q->street." ".$q->city;
         
         $this->template->display('purchase/credit_memo',$data);                 
	}
   
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            
            $data['mode']='';
            $data['message']='';
            $data['supplier_info']="";
            $data['faktur_info']="";
            if(!$record){
                $data['supplier_number']="";        
                
            }
            $data['lookup_suppliers']=$this->supplier_model->lookup();
            
			return $data;
	}


    function posting($nomor) {
        $nomor=urldecode($nomor);
        $this->crdb_model->posting($nomor);
        $this->view($nomor);
    }   
    function unposting($nomor) {
        $nomor=urldecode($nomor);
        $this->crdb_model->unposting($nomor);
        $this->view($nomor);
    }   
    function delete($nomor) {
        $nomor=urldecode($nomor);
        $this->crdb_model->delete($nomor);
        $this->syslog_model->add($nomor,"crdb","delete");

    }



	
}