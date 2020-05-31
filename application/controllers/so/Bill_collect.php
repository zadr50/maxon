<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Bill_collect extends CI_Controller {
    private $limit=10;
    private $sql="select b.*            
    	from bill_header_collector b";
    private $controller='so/bill_collect';
    private $primary_key='bill_id';
    private $file_view='sales/bill_collect';
    private $table_name='bill_header_collector';
	
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('customer_model');
		$this->load->model('type_of_payment_model');
		$this->load->model('syslog_model');
        $this->load->model('sales/bill_header_collector_model');
        $this->load->model('sales/bill_detail_collector_model');
        $this->load->model('payroll/employee_model');
		 
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        if(!$record){
    		$data['mode']='';
    		$data['message']='';
    		$data['bill_id']="AUTO";    //$this->nomor_bukti();
    		$data['bill_date']= date("Y-m-d H:i:s");
    		$data['date_to']=date("Y-m-d H:i:s");
        }
        $data['lookup_employee']=$this->employee_model->lookup();
        
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
		$key="Bill Collector Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!BBC~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!BBC~$00001');
				$rst=$this->bill_header_collector_model->get_by_id($no)->row();
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
		$id=$data['bill_id'];
		$mode=$data['mode'];unset($data['mode']);
		if($mode=="add"){
	        $id=$this->nomor_bukti();
			$data['bill_id']=$id;
			if($ok=$this->bill_header_collector_model->save($data)){
				$this->syslog_model->add($id,"bill_header_collector","add");
				$this->nomor_bukti(true);
			}
		} else {
			unset($data['bill_id']);
			$ok=$this->bill_header_collector_model->update($id,$data);			
			$this->syslog_model->add($id,"bill_header","edit");
		}
         $this->session->set_userdata('bill_id',$id);		 
		
		if ($ok){
			
            $amount=$this->db->query("select sum(amount) as z from bill_detail_collector 
                where bill_id='$id'")->row()->z;
			
			echo json_encode(array('success'=>true,'bill_id'=>$id,"msg"=>"Success","amount"=>$amount));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select p.*,c.company from bill_detail_collector p 
		left join invoice i on i.invoice_number=p.invoice_number
		left join customers c on c.customer_number=i.sold_to_customer
		where bill_id='$nomor'";		 
		echo datasource($sql);
	}
	function view($id,$message=null){
		//if(!allow_mod2('_40130'))return false;
		$id=urldecode($id);
		 $this->bill_header_collector_model->recalc($id);
		 $model=$this->bill_header_collector_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['bill_id']=$id;
		 $data['mode']='view';
         $data['message']=$message;
		
         $this->session->set_userdata('bill_id',$id);		 
         $this->template->display($this->file_view,$data);                 
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('bill_id','Nomor', 'required|trim');
		 $this->form_validation->set_rules('bill_date','Tanggal','callback_valid_date');
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
    function browse($offset=0,$limit=50,$order_column='nomor',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor','Tanggal','Kolektor','Jumlan','Keterangan');
		$data['fields']=array('bill_id','bill_date','collector','amount','comments');
		$data['field_key']='bill_id';
		$data['caption']='DAFTAR TAGIHAN KOLEKTOR';
		$data['posting_visible']=false;
        $data['fields_format_numeric']=array("amount");

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_number");
		$faa[]=criteria("Kolektor","sid_collector");

		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
            
        $sql=$this->sql." where 1=1 ";
        
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
            $sql.=" and bill_id = '$search'";
        } else {
        
        	if($this->input->get('sid_number')!=''){
        		$sql.=" and bill_id='".$this->input->get('sid_number')."'";
    		} else {
    			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
    			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
    			$sql.=" and bill_date between '".$d1."' and '".$d2."'";
    			if($this->input->get('sid_collector')!='')$sql.=" and collector like '".$this->input->get('sid_collector')."%'";
    		}
            
        }
         
        
        echo datasource($sql);
    }	 
	function delete($id){
		//if(!allow_mod2('_40133'))return false;
		$id=urldecode($id);
		$this->db->query("delete from bill_detail_collector where bill_id='$id'");
		$this->db->query("delete from bill_header_collector where bill_id='$id'");
		echo json_encode(array("success"=>true,"msg"=>"Berhasil hapus nomor ini."));		
		$this->syslog_model->add($id,"bill_header_collector","delete");
	}
        function save_item(){ 
			$bill_id=$this->session->userdata('bill_id');	
			$faktur=$this->input->post('faktur');
			$ok=false;
			$message="Tidak ada nomor faktur yang dipilih !";
			if($bill_id!=""){
				for($i=0;$i<count($faktur);$i++){
					$no=$faktur[$i];
					if($no!=""){
						if($q=$this->db->where("invoice_number",$no)->get("invoice")){
							if($r=$q->row()){
							    $amount=$r->amount;
                                if($r->invoice_type=='R')$amount=$r->amount*-1;
								$d['bill_id']=$bill_id;
								$d['invoice_number']=$no;
								$d['invoice_date']=$r->invoice_date;
								$d['amount']=$amount;
								$d['saldo']=$r->saldo_invoice;
								$this->db->insert("bill_detail_collector",$d);
							}
						}
					}
					$ok=true;
					$message="Faktur sudah ditambahkan, silahkan refresh !";
				}
			}
            $amount=$this->db->query("select sum(amount) as z from bill_detail_collector 
                where bill_id='$bill_id'")->row()->z;
            $this->db->query("update bill_header_collector set amount='$amount' where bill_id='bill_id'");
			$data['success']=$ok;
			$data['message']=$message;
			$data['amount']=$amount;
			echo json_encode($data);
			
        }        
        function delete_item($id){
			$id=urldecode($id);
            $bill_id="";
            if($q=$this->db->query("select bill_id from bill_detail_collector where id='$id'")){
                if($r=$q->row()){
                    $bill_id=$r->bill_id;
                }
            }
            $data['success']=$this->db->where("id",$id)->delete("bill_detail_collector");
            $amount=$this->db->query("select sum(amount) as z from bill_detail_collector 
                where bill_id='$bill_id'")->row()->z;
            $this->db->query("update bill_header set amount='$amount' where bill_id='$bill_id'");
            $data['amount']=$amount;
			echo json_encode($data);
        }        
        function print_bukti($nomor){
			$nomor=urldecode($nomor);
            $data=$this->bill_header_collector_model->get_by_id($nomor)->row_array();
			$data['content']=load_view('sales/rpt/print_bill_collector',$data);
			$this->load->view('pdf_print',$data);
        }
        function summary_info($nomor){
			$nomor=urldecode($nomor);
            return "";            
        }
         

	function daftar_saldo_faktur()
	{
		$sql="select p.invoice_number , p.invoice_date ,
		s.company,p.payment_terms,p.amount,p.due_date
		from invoice p
		left join customers s on s.customer_number=p.sold_to_customer
		where invoice_type='I' and (p.due_date<=".date("Y-m-d")." or p.due_date is null) 
		order by p.invoice_date asc limit 5";
		echo datasource($sql);
	}
	function amount_paid($faktur){return $this->invoice_model->paid_amont($faktur);}
	function amount_retur($faktur){return $this->invoice_model->retur_amount($faktur);}
	function amount_crdb($faktur){return $this->invoice_model->crdb_amount($faktur);}
	 
	function find($nomor){
		$this->load->model('invoice_model');

		$saldo=$this->invoice_model->recalc($nomor);
		$query=$this->invoice_model->get_by_id($nomor)->row();
		$data['invoice_date']=$query->invoice_date;
		$data['amount']=number_format($query->amount);
		$data['saldo']=number_format($saldo);
		
		echo json_encode($data);
		
	}
	function select_faktur(){

		$this->load->model('invoice_model');
		$search="";
		if($q=$this->input->get("q")){
			$search=$q;
		}

		$sql="select i.invoice_number,i.invoice_date,i.due_date,i.amount,i.payment_terms,
		i.sold_to_customer,s.company,i.invoice_type
		from invoice i left join customers s on s.customer_number=i.sold_to_customer
		where invoice_type in ('I','R') and i.paid=false ";
		if($search!=""){
			$sql.=" and (s.company like '$search%' or i.sold_to_customer like '$search%')";
		}
		$sql.=" order by i.invoice_number limit 100 ";
		$query=$this->db->query($sql);
		$i=0;
		$rows[0]='';
		$ok=false;
		if($query){ 
			foreach($query->result_array() as $row){
				$nomor=$row['invoice_number'];
				$saldo=$this->invoice_model->recalc($nomor);
                $amount=$row['amount'];
				$company=$row['company'];
                if($row['invoice_type']=='R')$amount=-1*$amount;
				if($saldo!=0){
					$row['amount']=number_format($amount);
					$row['saldo']=number_format($saldo);
					$row['company']=$company;
					$rows[$i++]=$row;
				}
				$ok=true;
			};
		}
		$data['success']=$ok;
		$data['faktur']=$rows;
		echo json_encode($data);
	} 
	
}
