<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class sales_crmemo extends CI_Controller {
    private $limit=10;
    private $sql="select kodecrdb,tanggal,docnumber,amount,posted,keterangan,c.account, c.account_description
     from crdb_memo cm left join chart_of_accounts c on c.id=cm.accountid where transtype='SO-CREDIT MEMO'";
    private $controller='sales_crmemo';
    private $primary_key='kodecrdb';
    private $file_view='sales/credit_memo';
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
	}
	function nomor_bukti($add=false)
	{
		$key="Sales CrDB Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!CRDBS~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!CRDBS~$00001');
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
		if (!allow_mod2('_30120'))  exit;
        $this->browse();
	}
    function browse($offset=0,$limit=50,$order_column='',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Faktur','Jumlah','Posted','Keterangan','Kode Akun','Perkiraan');
		$data['fields']=array('kodecrdb','tanggal','docnumber','amount','posted','keterangan','account','account_description');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='kodecrdb';
		$data['caption']='DAFTAR CREDIT MEMO';
		$data['posting_visible']=true;

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Bukti","sid_number");
		$faa[]=criteria("Posted","sid_posted");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
    	if($this->input->get('sid_number')){
    		$sql=$this->sql." and kodecrdb='".$this->input->get('sid_number')."'";
		} else {
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql=$this->sql." and tanggal between '".$d1."' and '".$d2."'";
			if($this->input->get('sid_posted')!=''){
				if($this->input->get('sid_posted')=='1'){
					$sql.=" and posted=true";
				} else {
					$sql.=" and (posted=false or posted is null)";				
				}
			}
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
		if (!allow_mod2('_30121'))  exit;
		$data=$this->set_defaults();
		$data['kodecrdb']="AUTO"; //$this->nomor_bukti();
		$data['tanggal']=date('Y-m-d');
		$data['docnumber']='';
		$data['amount']=0;
		$data['keterangan']="";
		$data['posted']=false;
		$data['mode']='add';
		$this->template->display_form_input('sales/credit_memo',$data,'');			
		
	}
	function save()
	{
		 
		$invoice_number=$this->input->post('docnumber');
		if($invoice_number)
		{
			$data['kodecrdb']=$this->nomor_bukti();
			$data['tanggal']=$this->input->post('tanggal');
			$data['docnumber']=$invoice_number;
			$data['amount']=$this->input->post('amount');
			$data['keterangan']=$this->input->post('keterangan');
			$data['transtype']=$this->input->post('transtype');
			$this->crdb_model->save($data);
			$this->nomor_bukti(true);
			$this->syslog_model->add($data['kodecrdb'],"crdb","edit");

		} else {echo 'Save: Invalid Invoice Number';}
	
	}
	function view($id,$message=null){
		if (!allow_mod2('_30120'))  exit;
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->crdb_model->get_by_id($id)->result_array();
		 $data=$this->set_defaults($model[0]);
		 $data['mode']='view';
		$this->load->model('invoice_model');
		$this->load->model("customer_model");
		 $q=$this->invoice_model->get_by_id($data['docnumber'])->row();
		 $data['customer_number']=$q->sold_to_customer;
		 $data['faktur_info']=$q->invoice_date." Rp. ".number_format($q->amount);
		 $q=$this->customer_model->get_by_id($data['customer_number'])->row();
		 $data['customer_name']=$q->company;
		 $data['customer_info']=$q->company." ".$q->street." ".$q->city;

         $this->template->display('sales/credit_memo',$data);                 
	}
   
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		$data['customer_info']="";
		$data['faktur_info']="";
		$data['customer_number']="";
			
		return $data;
	}
	function posting($nomor) {
		if (!allow_mod2('_30125'))  exit;
		$nomor=urldecode($nomor);
		$this->crdb_model->posting($nomor);
		$this->view($nomor);
	}	
	function unposting($nomor) {
		if (!allow_mod2('_30125'))  exit;
		$nomor=urldecode($nomor);
		$this->crdb_model->unposting($nomor);
		$this->view($nomor);
	}	
	function delete($nomor) {
		if (!allow_mod2('_30123'))  exit;
		$nomor=urldecode($nomor);
		$this->crdb_model->delete($nomor);
		$this->syslog_model->add($nomor,"crdb","delete");

	}
	function posting_all() {
		if (!allow_mod2('_30125'))  exit;
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
		$sql="select distinct kodecrdb from crdb_memo"; 
		$sql.=" where  transtype='SO-CREDIT MEMO'
		and (posted is null or posted=false) and tanggal between '$d1' and '$d2'";
		
		if($q=$this->db->query($sql)){
			foreach($q->result() as $r){
				echo "<p>Posting..
				<a href=".base_url()."index.php/sales_crmemo/view/".$r->kodecrdb."
				class='info_link'>".$r->kodecrdb."</a> : ";
				$message=$this->crdb_model->posting($r->kodecrdb);
				if($message!=''){
					echo ': '.$message;
				}
				echo "</p>";
			}
		}
		echo "<p>Finish.</p>";
	}	
}