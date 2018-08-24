<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Banks extends CI_Controller {
    private $limit=10;
    private $table_name='bank_accounts';
    private $sql="select bank_account_number,bank_name,street,suite,city,country
            ,phone_number,fax_number,org_id
                from bank_accounts
                ";
    private $file_view='bank/bank_accounts';
    private $primary_key='bank_account_number';
    private $controller='banks/banks';
    
	function __construct()
	{
		parent::__construct();
        
		if(!$this->access->is_login())redirect(base_url());
		
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('bank_accounts_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            $setcom['dlgBindId']="preferences";
            $setcom['dlgRetFunc']="$('#org_id').val(row.company_code);";
            $setcom['dlgCols']=array( 
                        array("fieldname"=>"company_code","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"company_name","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $data['lookup_company']=$this->list_of_values->render($setcom);
            
            
            return $data;
	}
	function index()
	{	
		if(!allow_mod2('_60010'))return false;   
        $this->browse();
	}
	function get_posts(){
            $data=  data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		if(!allow_mod2('_60011'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['account_id']=$this->acc_id($data['account_id']);
			$id=$this->bank_accounts_model->save($data);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"banks","add");			
            msgbox("Data sudah tersimpan.");
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function acc_id($account){
		$account=urldecode($account);
		$data=explode(" - ", $account);
		$coa=$this->chart_of_accounts_model->get_by_id($data[0])->row();
		if($coa){
			return $coa->id;
		} else {
			return 0;
		}
	}
	
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post($this->primary_key);
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                      
			$data['account_id']=$this->acc_id($data['account_id']);
            $this->bank_accounts_model->update($id,$data);
			$this->syslog_model->add($id,"banks","edit");			
            msgbox("Data sudah tersimpan.");
		} else {
			$message='Error Update';
     		$this->view($id,$message);		
		}	  
	}
	function save(){
		$mode=$this->input->post("mode");
		if($mode=="add"){
			$this->add();
		} else {
			$this->update();
		}
	}
	function view($id,$message=null){
		if(!allow_mod2('_60010'))return false;   
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->bank_accounts_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
		 $data['account_id']=account($data['account_id']);

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
		$data['fields_caption']=array('Nomor Rekening','Nama Bank','Alamat','Gedung','Kota'
		,'Negara','Telpon','Fax','Company');
		$data['fields']=array( 'bank_account_number','bank_name','street','suite','city','country'
            ,'phone_number','fax_number','org_id');
		$data['field_key']='bank_account_number';
		$data['caption']='DAFTAR REKENING KAS / BANK';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nomor Rekening","sid_number");
		$faa[]=criteria("Nama Bank","sid_bank");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
        
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }
        
		if($this->input->get('sid_number')!='')$sql.=" and bank_account_number like '".$this->input->get('sid_number')."%'";	
		if($this->input->get('sid_bank')!='')$sql.=" bank_name like '".$this->input->get('sid_bank')."%'";
        
        if($search!='')$sql.=" and (bank_account_number like '%$search%' or bank_name like '%$search%')";
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        
        
        
        echo datasource($sql);
    }	 
	function delete($id){
		if(!allow_mod2('_60013'))return false;   
		$id=urldecode($id);
		$this->syslog_model->add($id,"banks","delete");
	 	$this->bank_accounts_model->delete($id);
	 	$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select bank_name from bank_accounts where bank_account_number='$nomor'");
		echo json_encode($query->row_array());
 	}
	function grafik_saldo()
	{
		header('Content-type: application/json');
		$data['label']="SALDO REKENING";
		$data['data']=$this->bank_accounts_model->saldo_rekening();
		echo json_encode($data);
		
	}
	function grafik_saldo_old()
	{
		/* create_graph($konfigurasi_grafik, $data, $tipe_grafik, $judul_pd_grafik, $nama_berkas) */		
		$phpgraph = $this->load->library('PhpGraph');		
		$cfg['width'] = 300;
		$cfg['height'] = 200;
		$cfg['compare'] = false;
		$cfg['disable-values']=1;
		$chart_type='vertical-simple-column-graph';
		$data=$this->bank_accounts_model->saldo_rekening();
		$file="tmp/".$chart_type.".png";
		$this->phpgraph->create_graph($cfg, $data,$chart_type,'Grafik Saldo Rekening',$file);
		echo '<img src="'.base_url().'/'.$file.'"/>';
		echo '*Display only top ten data.';
		
	}
	function daftar_giro_gantung()
	{
		$sql="select cw.voucher,cw.check_date,cw.check_number,cw.trans_type,cw.deposit_amount,cw.payment_amount  
		from check_writer cw";		
		$query=$this->db->query($sql);
		$flds=$query->list_fields();
		$data=$query->result_array();
		echo browse_data($data,$flds);
		
	}
    function rpt($id,$d1="",$d2="",$rek=""){
		 $data['date_from']=date('Y-m-d 00:00:00');
         if($d1!="")$data["date_from"]=$d1;
		 $data['date_to']=date('Y-m-d 23:59:59');
         if($d2!="")$data["date_to"]=$d2;
		 $data['select_date']=true;
         $data["bank_account_number"]=$rek;		 
    	 switch ($id) {
             case 'list_trans_print':
                 $data['criteria1']=true;
                 $data['label1']='Rekening';
                 $data['text1']=$rek;
                 break;          
			 case 'mutasi':
				 $data['criteria1']=true;
				 $data['label1']='Rekening';
				 $data['text1']='';
				 break;			 
			 default:
				 break;
		 }
		 $rpt='banks/banks/rpt/'.$id;
		 $data['rpt_controller']=$rpt;
		 
		if(!$this->input->post('cmdPrint')){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view('bank/rpt/'.$id);
		}
   }	
   function reports(){
		$this->template->display('bank/menu_reports');
	}
	function list_trans($bank_account_number) {
		$bank_account_number=urldecode($bank_account_number);
		$date_from= $this->input->get('d1');
		$date_from=  date('Y-m-d H:i:s', strtotime($date_from));
		$date_to= $this->input->get('d2');
		$date_to = date('Y-m-d H:i:s', strtotime($date_to));

		$sql="select sum(deposit_amount) as z_deposit, sum(payment_amount) as z_payment
			from check_writer where account_number='$bank_account_number' 
			and check_date<'$date_from'";
		 
		
        $query=$this->db->query($sql)->row();
		$awal=$query->z_deposit-$query->z_payment;
		
		$rows[0]=array("voucher"=>"SALDO","check_date"=>"SALDO","trans_type"=>"SALDO"
			,"deposit_amount"=>number_format($query->z_deposit)
			,"payment_amount"=>number_format($query->z_payment)
			,"saldo"=>number_format($awal)
			,"supplier_number"=>"","payee"=>"","memo"=>"");

		$sql="select voucher,check_date,deposit_amount,payment_amount,supplier_number,
			payee,memo,trans_type 
			from check_writer 
			where account_number='$bank_account_number' 
			and check_date between '$date_from' and '$date_to' 
			and trans_type not like '% trx'
			order by check_date
			
			";
        $query=$this->db->query($sql);
        $i=1;
		if($query)foreach($query->result_array() as $row) {
			$awal=$awal+$row['deposit_amount']-$row['payment_amount'];
			$row['deposit_amount']=number_format($row['deposit_amount']);
			$row['payment_amount']=number_format($row['payment_amount']);
			$row["saldo"]=number_format($awal);
			$rows[]=$row;
		};	
		$sql="select voucher,check_date,deposit_amount,payment_amount,supplier_number,
			payee,memo,trans_type ,account_number
			from check_writer 
			where check_date between '$date_from' and '$date_to' 
			and trans_type like '% trx'
			order by check_date
			
			";
        $query=$this->db->query($sql);
        $i=1;
		if($query)foreach($query->result_array() as $row) {
			$found=false;
			$use_account=false;
			if($row['account_number']==$bank_account_number) {
				$found=true;
				$use_account=true;
			} else if($row['supplier_number']==$bank_account_number){
				$found=true;
				$use_account=false;
			}
			if($found) {
				
				if($use_account){
					$row['payment_amount']=number_format($row['payment_amount']);
					$awal=$awal-$row['payment_amount'];
					$row['deposit_amount']=0;
				} else {
					$row['deposit_amount']=number_format($row['deposit_amount']);
					$awal=$awal+$row['deposit_amount'];
					$row['payment_amount']=0;
				}
				$row["saldo"]=number_format($awal);
				$rows[]=$row;
			}
		};	

        $data['total']=$i;
        $data['rows']=$rows;
                    
       echo json_encode($data);

	}
 	function daftar_saldo($limit=0)
	{
		$sql="select b.bank_account_number, b.bank_name, 
		(c.deposit_amount)-sum(c.payment_amount) as amount
		from bank_accounts b
		left join check_writer c on c.account_number=b.bank_account_number
		group by b.bank_account_number,b.bank_name";
        if($limit>0)$sql.=" limit $limit";
        
		echo datasource($sql);
	}
	function select2(){
		
		$sql="select bank_account_number,bank_name from bank_accounts where 1=1";
		if($account=$this->input->get("q")){
			if($account!="")$sql.=" and bank_account_number like '$account%'";
		}
        $sql.=" order by bank_account_number";
		$output="";
		if($qry=$this->db->query($sql)){
			foreach($qry->result() as $row){
				$output.=$row->bank_account_number." - ".$row->bank_name."|".$row->bank_account_number."\n";
			}
		}
		echo $output;
		
	}
	function select($account=''){
		$account=urldecode($account);
		if($q=$this->input->get("q")){
			$account=$q;
		}
		$sql="select bank_account_number,bank_name from bank_accounts where 1=1";
		if($account!="")$sql.=" and (bank_account_number like '$account%' or bank_account_number like '%$account%')";

        $sql.=" order by bank_account_number";

        $offset=0; $limit=10;
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
                
		echo datasource($sql);	
	}

}
