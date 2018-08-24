<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Cash_out extends CI_Controller {
    private $limit=10;
    private $table_name='check_writer';
    private $sql="select voucher,check_date,payment_amount,posted
            ,account_number,payee,trans_type,check_number,memo,trans_id,
            org_id
                from check_writer
                where trans_type in ('cash out','trans out','cheque out')
                ";
    private $file_view='bank/cash_out';
    private $primary_key='voucher';
    private $controller='cash_out';  
    
	function __construct()
	{
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('check_writer_model');
		$this->load->model('bank_accounts_model');
		$this->load->model('check_writer_items_model');
		$this->load->model('syslog_model');
	}
	function nomor_bukti($add=false,$rekening="")
    {
        $key="Cash Out Numbering";
        
        //Acc In BCA Numbering
        $key2="Acc Out $rekening Numbering";
        
        $no2=$this->sysvar->getvar($key2);
        if($no2!=""){
            $key=$key2;
        }
        
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
            if($data['org_id']=='')$data['org_id']=session_company_code();
            
            $data['mode']='';
            $data['message']='';
//            $data['account_number_list']=$this->bank_accounts_model->account_number_list();
			$data['closed']=0;
            
            $setting['dlgBindId']="doc_type";
            $setting['sysvar_lookup']='doc_type_cash_out';
            $setting['dlgRetFunc']="$('#doc_type').val(row.varvalue);";
            $data['lookup_doc_type']=$this->list_of_values->render($setting);

            $setting['dlgBindId']="doc_status";
            $setting['sysvar_lookup']='doc_status';
            $setting['dlgRetFunc']="$('#doc_status').val(row.varvalue);";
            $data['lookup_doc_status']=$this->list_of_values->render($setting);

            $data['lookup_rekening']=$this->list_of_values->render(
                array("dlgBindId"=>"bank_accounts",
                "dlgRetFunc"=>"$('#account_number').val(row.bank_account_number);",
                "dlgCols"=>array(array("fieldname"=>"bank_account_number","caption"=>"Rekening","width"=>"100px"),
                array("fieldname"=>"bank_name","caption"=>"Nama Bank","width"=>"250px"),
                array("fieldname"=>"org_id","caption"=>"Company","width"=>"80px"))));
            
            $setsupp['dlgBindId']="suppliers";
            $setsupp['dlgRetFunc']="$('#supplier_number').val(row.supplier_number);
			$('#payee').val(row.supplier_name);
            ";
            $setsupp['dlgCols']=array( 
                        array("fieldname"=>"supplier_name","caption"=>"Nama Supplier","width"=>"180px"),
                        array("fieldname"=>"supplier_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"first_name","caption"=>"Kontak","width"=>"50px"),
                        array("fieldname"=>"city","caption"=>"Kota","width"=>"200px")
                    );          
            $data['lookup_suppliers']=$this->list_of_values->render($setsupp);

            $data['lookup_department']=$this->list_of_values->render(
                array("dlgBindId"=>"departments",
                "dlgRetFunc"=>"$('#org_id_item').val(row.dept_code);",
                "dlgCols"=>array(array("fieldname"=>"dept_code","caption"=>"Dept Code","width"=>"100px"),
                array("fieldname"=>"dept_name","caption"=>"Keterengan","width"=>"250px"))));
                                    
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
		 $data['voucher']="AUTO"; //$this->nomor_bukti();
         $data['org_id']=session_company_code();
 	     $this->template->display_form_input($this->file_view,$data,'');
	}
	function save(){
		$data=$this->get_posts();
		$data['voucher']=$this->nomor_bukti();
        $account=$data["account_number"];
        $data['voucher']=$this->nomor_bukti(false,$account);
		$id=$this->check_writer_model->save($data);
        $message='update success';
		$this->nomor_bukti(true,$account);
		
		if($message=="")$message='Update Success';
		$this->syslog_model->add($id,"cash_out","add");			

		$this->view($data['voucher'],$message);
//        header('location: '.base_url().'index.php/cash_out/view/'.$data['voucher']);
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
			$this->syslog_model->add($id,"cash_out","edit");			

		} else {
			
			$message='Update Gagal';
		}	  
		$this->view($id,$message);
//        header('location: '.base_url().'index.php/cash_out/view/'.$data['voucher']);
	}
	function view($id,$message=null){
		if(!allow_mod2('_60030'))return false;   
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
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Jumlah','Posted','Rekening','Untuk'
		,'Jenis Transaksi','Nomor Giro','Keterangan','Company','Trans Id');
		$data['fields']=array('voucher','check_date','payment_amount','posted'
            ,'account_number','payee','trans_type','check_number','memo','org_id','trans_id');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='voucher';
		$data['caption']='DAFTAR TRANSAKSI KAS/BANK KELUAR';
		$data['posting_visible']=true;
        $data['fields_format_numeric']=array("payment_amount");

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
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }
        
        $sql=$this->sql;
		if($no!=''){
			$sql.=" and voucher='".$no."'";
		} else {
			$sql.=" and check_date between '$d1' and '$d2'";
			if($rek!='')$sql.=" and account_number like '$rek%'";	
			if($this->input->get('sid_type')!='')$sql.=" and trans_type='".$this->input->get('sid_type')."'";
			if($this->input->get('sid_posted')!=''){
				if($this->input->get('sid_posted')=='1'){
					$sql.=" and posted=true";
				} else {
					$sql.=" and posted=false";				
				}
			}
            if($search!="")$sql.=" or voucher like '$search%'";
		}
        $sql.=" order by voucher";
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function items($voucher) {
		$voucher=urldecode($voucher);
		$sql="select cwi.account_id,coa.account,coa.account_description as description,
			amount,comments,invoice_number,ref1,line_number,cwi.org_id	
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
		if(!$line_number=$this->input->post("line_number")){
			$line_number=0;
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
		$data['org_id']=$this->input->post('org_id_item');
		
		
		$ret['success']=false;
		$ret['msg']="Unknown Error";
		if($line_number==0){
			if($ok = $this->check_writer_items_model->save($data)){
				$ret['success']=true;
				$ret['msg']='Sukses tambah data';
			}
		} else {
			if($ok = $this->check_writer_items_model->update($line_number,$data)){
				$ret['success']=true;
				$ret['msg']='Sukses tambah data';
			}			
		}
		echo json_encode($ret);
		return $ok;
	}
	function delete_item(){
		$id=$this->input->post("line_number");
		$data["success"]=false;
		$data["msg"]="Unknown Error !";
		if($this->check_writer_items_model->delete($id)){
			$data["success"]=true;
			$data["msg"]="Berhasil.";
			$this->syslog_model->add($id,"cash_out","delete");

		}
		echo json_encode($data);
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
		if($message!=""){
			$this->syslog_model->add($voucher,"cash_out","delete");

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
		$sql.=" where trans_type in ('cash out','trans out','cheque out') and (posted is null or posted=false) and check_date between '$d1' and '$d2'";
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
	function print_bukti($nomor){
            $nomor=urldecode($nomor);
            $data['voucher']=$nomor;
            $this->load->view("bank/rpt/cash_out",$data);           	    
	}
}
