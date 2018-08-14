<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Cash_adjust extends CI_Controller {
    private $limit=10;
    private $table_name='check_writer';
    private $sql="select voucher,check_date,payment_amount
            ,account_number,payee,trans_type,check_number,memo,trans_id
                from check_writer
                where trans_type in ('cash out','trans out','cheque out')
                ";
    private $file_view='bank/cash_out';
    private $primary_key='voucher';
    private $controller='cash_out';  
    
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
		$this->load->model("syslog_model");
	}
	function nomor_bukti($add=false)
	{
		$key="Cash Out Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!KK~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!KK~$00001');
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
		if(!allow_mod2('_60080'))return false;   
		echo "Silahkan buat dengan transaksi kas masuk atau kas keluar untuk koreksi.";
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		if(!allow_mod2('_60081'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $data['mode']='add';
		 $data['voucher']=$this->nomor_bukti();
	     $this->template->display_form_input($this->file_view,$data,'');
	}
	function save(){
		$data=$this->get_posts();
		$data['voucher']=$this->nomor_bukti();
		$id=$this->check_writer_model->save($data);
        $message='update success';
		$this->nomor_bukti(true);
		$this->syslog_model->add($id,"cash_adjust","add");			

        header('location: '.base_url().'index.php/cash_out/view/'.$data['voucher']);
	}
	
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post($this->primary_key);
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                    
            unset($data['trans_id']);
            $this->check_writer_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"cash_adjust","edit");			

		} else {
			$message='Error Update';
		}	  
        header('location: '.base_url().'index.php/cash_out/view/'.$data['voucher']);
	}
	function view($id,$message=null){
		if(!allow_mod2('_60080'))return false;   
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->check_writer_model->get_by_id($id)->row();
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
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Jumlah','Rekening','Untuk'
		,'Jenis Transaksi','Nomor Giro','Keterangan','Trans Id');
		$data['fields']=array('voucher','check_date','payment_amount'
            ,'account_number','payee','trans_type','check_number','memo','trans_id');
		$data['field_key']='voucher';
		$data['caption']='DAFTAR TRANSAKSI KAS/BANK KELUAR';
		$data['posting_visible']=true;

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Bukti","sid_number");
		$faa[]=criteria("Rekening","sid_rek");
		$faa[]=criteria("Jenis","sid_type");
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
		}
        //$sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function items($voucher) {
		$voucher=urldecode($voucher);
		$sql="select cwi.account_id,coa.account,coa.account_description as description,
			amount,comments,invoice_number,ref1,line_number	
			from check_writer_items cwi
			left join chart_of_accounts coa on coa.id=cwi.account_id
			where trans_id in (
			select trans_id from check_writer where voucher='$voucher')";
		echo datasource($sql);
	}
	function save_item() {
		$voucher=$this->input->post('voucher_item');
		if($voucher=="") {
			echo json_encode(array('success'=>false,'msg'=>'Nomor voucher tidak ada atau kosong.'));
			return false;
		}
		$this->load->model('check_writer_model');
		$trans_id=$this->check_writer_model->get_by_id($voucher)->row()->trans_id;
		
		$this->load->model('chart_of_accounts_model');
		$account=$this->input->post('account');
		$coa=$this->chart_of_accounts_model->get_by_id($account)->row();
		$this->load->model('check_writer_items_model');
		$data['trans_id']=$trans_id;
		$data['account_id']=$coa->id;
		$data['account']=$account;
		$data['description']=$coa->account_description;
		$data['amount']=$this->input->post('amount');
		$data['comments']=$this->input->post('comments');
		if($this->check_writer_items_model->save($data)){
			echo json_encode(array('success'=>true,'msg'=>'Sukses tambah data.'));
			return true;
		} else {
			echo json_encode(array('success'=>false,'msg'=>'Gagal menyimpan data.'));
			return false;
		}
	}
	function unposting($voucher) {
		if(!allow_mod2('_60085'))return false;   
		$voucher=urldecode($voucher);
		$message=$this->check_writer_model->unposting($voucher);
		$this->view($voucher,$message);
	}
	function posting($voucher) {
		if(!allow_mod2('_60085'))return false;   
		$voucher=urldecode($voucher);
		$message=$this->check_writer_model->posting($voucher);
		$this->view($voucher,$message);
	}
	function delete($voucher) {
		if(!allow_mod2('_60083'))return false;   
		$voucher=urldecode($voucher);
		$message=$this->check_writer_model->delete($voucher);
		if($message!=""){
			$this->view($voucher,$message);
			$this->syslog_model->add($voucher,"cash_adjust","delete");			

			return false;
		} 
		$this->browse();
	}
	
}
