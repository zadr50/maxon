<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Jurnal extends CI_Controller {
    private $limit=10,$offset=0;
    private $table_name='gl_transactions';
    private $sql="select gl_id,date,account,account_description
        ,debit,credit,source,operation,custsuppbank,account_id
        ,transaction_id
        from gl_transactions g
        left join chart_of_accounts c on c.id=g.account_id ";
    private $primary_key='transaction_id';
    private $file_view='gl/jurnal';
	private $controller='jurnal';
	
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
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('syslog_model');
		$this->load->model("periode_model");
		
	}
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		if($record==NULL){
			$data['operation']='';
			$data['gl_id']='';
			$data['date']=date("Y-m-d");
			$data['source']='';
			$data['debit']='0';
			$data['credit']='0';
                        
		} else {
			$data['operation']=$record->operation;
			$data['gl_id']=$record->gl_id;
			$data['date']=$record->date;
			$data['source']=$record->source;
			$data['debit']=$record->debit;
			$data['credit']=$record->credit;
		}
		return $data;
	}
	function index()
	{	
		if(!allow_mod2('_10060'))return false;   
       $this->browse();     
	}
	function get_posts(){
		$data['operation']=$this->input->post('operation');
		$data['gl_id']=$this->input->post('gl_id');
		$data['date']=$this->input->post('date');
		$data['source']=$this->input->post('source');
		$data['debit']=$this->input->post('debit');
		$data['credit']=$this->input->post('credit');
		return $data;
	}
	function nomor_bukti($add=false)
	{
		$key="GL Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!GL~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!GL~$00001');
				$rst=$this->jurnal_model->get_by_id($no)->row();
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
		if(!allow_mod2('_10061'))return false;   
	 	$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$data['gl_id']=$this->nomor_bukti();
        $data['db_tot']=0;  $data["cr_tot"]=0;      $data["sisa"]=0;
		$this->nomor_bukti(true);	//langsung tambah satu
	    $this->template->display_form_input($this->file_view,$data,'');
	}
	function save(){
		$items=$this->input->post("items");
        $success=true;
        $gl_id="";
        for($i=0;$i<count($items);$i++){
            $data=$items[$i];
            if($gl_id=="")$gl_id=$data["gl_id"];
            if(isset($data['account'])){
                $id=$this->jurnal_model->save($data);
            }
        }
        $this->syslog_model->add($gl_id,"jurnal","add");
        $ret['success']=$success;
        $ret['message']='Success data jurnal sudah tersimpan.';
        echo json_encode($ret);		
	}
	function view($gl_id,$message="")
	{
		if(!allow_mod2('_10060'))return false;
		$gl_id=urldecode($gl_id);
		$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='view';
        $data['db_tot']=0;  $data["cr_tot"]=0;      
        if($q=$this->db->query("select sum(debit) as db,sum(credit) as cr 
            from gl_transactions where gl_id='$gl_id'")->row()){
            $data['db_tot']=$q->db;
            $data["cr_tot"]=$q->cr;
        }
        $data["sisa"]=$data['db_tot']-$data['cr_tot'];
        
		$this->db->select("gl_id,date,source,operation");
		$this->db->from('gl_transactions');
		$this->db->where('gl_id',$gl_id);
		$this->db->limit(1);
		$query=$this->db->get();
		foreach($query->result_array() as $r){
			$data['gl_id']=$r['gl_id'];
			$data['date']=$r['date'];
			$data['source']=$r['source'];
			$data['operation']=$r['operation'];
		}
		$data['message']=$message;	
		$this->load->model('periode_model');
		$data['closed']=$this->periode_model->closed($data['date']);
		
	    $this->template->display_form_input($this->file_view,$data,'');
	}
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post('gl_id');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                      
			
			unset($data['closed']);
			
			$this->jurnal_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"jurnal","edit");

		} else {
			$message='Error Update';
		}	  
 		$this->view($id,$message);		
	}
	
	function view_jurnal($gl_id){
		$gl_id=urldecode($gl_id);
		$sql="select account,account_description
		,debit,credit,custsuppbank as ref,org_id,transaction_id as id from gl_transactions g
		left join chart_of_accounts c on c.id=g.account_id
		where gl_id='$gl_id'";
		$s="
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
			<script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
		";
		echo $s." ".browse_simple($sql);

	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('gl_id','gl_id', 'required|trim');
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
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Kode Akun','Nama Akun','Debit'
		,'Kredit','Source','Jenis');
		$data['fields']=array('gl_id','date','account','account_description'
        ,'debit','credit','source','operation');
		$data['field_key']='gl_id';
		$data['caption']='DAFTAR TRANSAKSI JURNAL';
		$data['export_visible']=true;

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Bukti","sid_number");
		$faa[]=criteria("Jenis","sid_opr");
		$faa[]=criteria("Only Not Balance","sid_balance","checkbox");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        if($this->input->get('page'))$offset=$this->input->get('page');
        if($this->input->get('rows'))$limit=$this->input->get('rows');
        $this->limit=$limit;
        $this->offset=$offset;
		$sql=$this->build_sql();
        echo datasource($sql);
    }	      
	function build_sql(){
		$no=$this->input->get('sid_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $search=$this->input->get('sid_opr');
        $tb_search=$this->input->get('tb_search');
        if($no=="")$no=$tb_search;
		$not_balance="";
		if(isset($_GET['sid_balance'])){
			$not_balance="select gl_id from gl_transactions
				group by gl_id
				having sum(debit)<>sum(credit)";
		}
		 		
        $sql=$this->sql.' where 1=1';
        
		if($no!=''){
			$sql.=" and gl_id='".$no."'";
		} else {
			$sql.=" and date between '$d1' and '$d2'";
			if($search!='')$sql.=" operation like '$search%'";
		}
		if($not_balance!="")$sql.=" and gl_id in ($not_balance)";
		
        $sql.=" limit $this->offset,$this->limit";
        //echo $sql;
		return $sql;
	}
	function delete($id=''){
		if(!allow_mod2('_10063',false))return false;   
		$id=urldecode($id);
		$this->load->model("periode_model");
		
		if($q=$this->jurnal_model->get_by_gl_id($id)) {
			if($r=$q->row()){
				$tgl=$r->date;	
				if($this->periode_model->closed($tgl)){
					$message="Periode sudah ditutup tidak bisa dihapus !";
					$this->view($id,$message);
					return false;
				}
				if($this->jurnal_model->del_jurnal($id)){
					$this->syslog_model->add($id,"jurnal","delete");
					$this->browse();
				} else {
					$this->view($id,"Tidak bisa hapus jurnal ini");
				}			
			}
		}
		$this->browse();		
	}
    function delete_item($id){
		$id=urldecode($id);
        if($this->jurnal_model->delete_item($id)){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }
	function add_item(){
		if(isset($_GET)){
			$data['gl_id']=$_GET['gl_id'];
			$data['date']=$_GET['date'];
			$data['operation']=$_GET['operation'];
			$data['source']=$_GET['source'];
		} else {
			$data['gl_id']='';
			$data['date']='';
			$data['operation']='';
			$data['source']='';                
		}

		$this->load->model('chart_of_accounts_model');
		$data['account_lookup']=$this->chart_of_accounts_model->select_list();
		$this->load->view('gl/add_account',$data);
    }
	function save_item(){
		$account=$this->input->post('account');
		$accid=$this->chart_of_accounts_model->get_by_id($account)->row()->id;
		$data['gl_id']=$this->input->post('gl_id');
		$data['date']=$this->input->post('date');
		$data['account_id']=$accid;
		$data['debit']=$this->input->post('debit');
		if($data['debit']=='')$data['debit']='0';
		$data['credit']=$this->input->post('credit');
		if($data['credit']=='')$data['credit']='0';
		$data['source']=$this->input->post('source');
		$data['operation']=$this->input->post('operation');
		if($this->jurnal_model->save($data)){
			$this->syslog_model->add($data['gl_id'],"jurnal","add");

			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	function items($kode){
		$kode=urldecode($kode);
		$sql="select c.account,c.account_description,g.debit,g.credit,
		g.source,g.operation,g.transaction_id,g.custsuppbank
		from gl_transactions g left join chart_of_accounts c 
		on c.id=g.account_id
		 where gl_id='$kode' order by transaction_id";
        $query=$this->db->query($sql);
		 
        $i=0;
		$rows[0]='';
		if($query){ 
	        foreach($query->result_array() as $row){
				$row['debit']=number_format($row['debit']);
				$row['credit']=number_format($row['credit']);
	            $rows[$i++]=$row;
	        };
		}
        /*
		$jurnal=$this->db->query("select sum(debit) as z_db,sum(credit) as z_cr 
			from gl_transactions where gl_id='$kode'")->row();
            
		$rows[$i++]=array("account"=>"<strong>TOTAL</strong>","account_description"=>"",
			"debit"=>"<strong>".number_format($jurnal->z_db)."</strong>",
			"credit"=>"<strong>".number_format($jurnal->z_cr)."</strong>",
			"custsuppbank"=>"<strong>BALANCE</strong>",
			"operation"=>"<strong>".number_format($jurnal->z_db-$jurnal->z_cr)."</strong>",
			"transaction_id"=>"",
			"source"=>"");
	   */		
			
        $data['total']=$i;
        $data['rows']=$rows;
                    
        echo json_encode($data);
	}
	function export_xls(){
		$sql=$this->build_sql();
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=hasil-export.xls");
		echo html_table($sql,false);
	}
    function validate(){
        if(!allow_mod2('_10069'))return false;   
        $data['caption']="Validasi Jurnal Umum";
        $this->template->display_form_input("gl/validate",$data);
    }
}
?>