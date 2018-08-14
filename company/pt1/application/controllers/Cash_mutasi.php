<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Cash_mutasi extends CI_Controller {
    private $limit=10;
    private $table_name='check_writer';
    private $sql="select voucher,check_date,payment_amount,posted
            ,account_number,payee,supplier_number
            ,trans_type,check_number,memo,trans_id
                from check_writer
                where trans_type in ('cash trx','trans trx','cheque trx')
                ";
    private $file_view='bank/cash_mutasi';
    private $primary_key='voucher';
    private $controller='cash_mutasi';
    
	function __construct()
	{
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('check_writer_model');
		$this->load->model('bank_accounts_model');
		$this->load->model('syslog_model');
	}
	function nomor_bukti($add=false)
	{
		$key="Cash Trx Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!KT~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!KT~$00001');
				$rst=$this->check_writer_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	function set_defaults($record=NULL){
            
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            $data['account_number_list']=$this->bank_accounts_model->account_number_list();
			$data['closed']=0;
            return $data;
	}
	function index()
	{	
		if(!allow_mod2('_60030'))return false;   
        $this->browse();
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		if(!allow_mod2('_60031'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $data['mode']='add';
		 $data['voucher']=$this->nomor_bukti();
	     $this->template->display_form_input($this->file_view,$data,'');
	}
	function save(){
		$data=$this->get_posts();
		$data['voucher']=$this->nomor_bukti();
        $data['deposit_amount']=0;		
		if($data['trans_type']=="")$data['trans_type']="trans trx";
		$id=$this->check_writer_model->save($data);
		
        $data['account_number']=$data['supplier_number'];
        $data['deposit_amount']=$data['payment_amount'];
        $data['payment_amount']=0;		
		$id=$this->check_writer_model->save($data);
		
		$message=mysql_error();
		if($message=="") $message='update success';
		$this->nomor_bukti(true);
		$this->syslog_model->add($id,"cash_mutasi","add");			

		$this->view($data['voucher'],$message);
	}
	
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post($this->primary_key);
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                    
            $data['deposit_amount']=$data['payment_amount'];
            unset($data['trans_id']);
            $this->check_writer_model->update_trx($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"cash_mutasi","edit");			

		} else {
			$message='Error Update';
		}	  
		$message=mysql_error();
		if($message=="") $message='update success';
		$this->view($data['voucher'],$message);
	}
	
	function view($id,$message=null){
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->check_writer_model->get_by_id_trx($id)->row();
		 $data=$this->set_defaults($model);
		  
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
     function browse($offset=0,$limit=50,$order_column='voucher',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Jumlah','Posted','Rekening Sumber','Untuk'
		,'Rekening Tujuan','Jenis Transaksi','Nomor Giro','Keterangan','Trans Id');
		$data['fields']=array('voucher','check_date','payment_amount','posted'
            ,'account_number','payee','supplier_number'
            ,'trans_type','check_number','memo','trans_id');
		$data['field_key']='voucher';
		$data['caption']='DAFTAR TRANSAKSI MUTASI ANTAR REKENING';
		$data['posting_visible']=true;

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Bukti","sid_number");
		$faa[]=criteria("Rekening","sid_rek");
		$faa[]=criteria("Jenis","sid_type");
		$faa[]=criteria("Posted","sid_posted");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$rek=$this->input->get('sid_rek');
		$no=$this->input->get('sid_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql=$this->sql;
		if($no!=''){
			$sql.=" and voucher='".$no."'";
		} else {
			$sql.=" and check_date between '$d1' and '$d2'";
			if($rek!='')$sql.=" and account_number like '$rek%'";	
			if($this->input->get('sid_type')!='')$sql.=" trans_type='".$this->input->get('sid_type')."'";
			if($this->input->get('sid_posted')!=''){
				if($this->input->get('sid_posted')=='1'){
					$sql.=" and posted=true";
				} else {
					$sql.=" and posted=false";				
				}
			}
		}
		$sql.=" and payment_amount>0";
        //$sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function unposting($voucher) {
		if(!allow_mod2('_60035'))return false;   
		$voucher=urldecode($voucher);
		$message=$this->check_writer_model->unposting($voucher);
		$this->view($voucher,$message);
	}
	function posting($voucher) {
		if(!allow_mod2('_60035'))return false;   
		$voucher=urldecode($voucher);
		$message=$this->check_writer_model->posting($voucher);
		$this->view($voucher,$message);
	}
	function delete($voucher) {
		if(!allow_mod2('_60033'))return false;   
		$voucher=urldecode($voucher);
		$message=$this->check_writer_model->delete($voucher);
		$this->syslog_model->add($voucher,"cash_mutasi","delete");
		if($message!=""){
			$this->view($voucher,$message);
			return false;
		} 
		$this->browse();
	}	

	function posting_all() {
		$this->load->model('check_writer_model');
    	$rek=$this->input->get('sid_rek');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
		$sql="select distinct voucher from check_writer"; 
		$sql.=" where trans_type in ('cash trx','trans trx','cheque trx') and (posted is null or posted=false) and check_date between '$d1' and '$d2'";
		if($rek!='')$sql.=" and account_number like '$rek%'";	
		if($this->input->get('sid_type')!='')$sql.=" and trans_type='".$this->input->get('sid_type')."'";
		if($q=$this->db->query($sql)){
			foreach($q->result() as $r){
				echo "<p>Posting..".$r->voucher;
				$message=$this->check_writer_model->posting($r->voucher);
				if($message!=''){
					echo ': '.$message;
				}
				echo "</p>";
			}
		}
		echo "<p>Finish.</p>";
	}		
}
