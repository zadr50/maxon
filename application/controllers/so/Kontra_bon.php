<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Kontra_bon extends CI_Controller {
    private $limit=10;
    private $sql="select b.*,c.company
            from bill_header b
            left join customers c on c.customer_number=b.customer_number";
    private $controller='so/kontra_bon';
    private $primary_key='bill_id';
    private $file_view='sales/kontra_bon';
    private $table_name='bill_header';
	
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
        $this->load->model('sales/bill_header_model');
        $this->load->model('sales/bill_detail_model');
		 
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
        $data['lookup_customer']=$this->customer_model->lookup();
        
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
		$key="Kontra Bon Jual Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!KBJ~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!KBJ~$00001');
				$rst=$this->bill_header_model->get_by_id($no)->row();
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
        if(!isset($data['termin']))$data['termin']="KREDIT";
		$mode=$data['mode'];unset($data['mode']);
		if($mode=="add"){
	        $id=$this->nomor_bukti();
			$data['bill_id']=$id;
			if($ok=$this->bill_header_model->save($data)){
				$this->syslog_model->add($id,"bill_header","add");
				$this->nomor_bukti(true);
			}
		} else {
			unset($data['bill_id']);
			$ok=$this->bill_header_model->update($id,$data);			
			$this->syslog_model->add($id,"bill_header","edit");
		}
         $this->session->set_userdata('bill_id',$id);		 
		
		if ($ok){
			echo json_encode(array('success'=>true,'bill_id'=>$id,"msg"=>"Success"));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select p.* from bill_detail p 
		where bill_id='$nomor'";		 
		echo datasource($sql);
	}
	function view($id,$message=null){
		//if(!allow_mod2('_40130'))return false;
		$id=urldecode($id);
		 $this->bill_header_model->recalc($id);
		 $model=$this->bill_header_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['bill_id']=$id;
		 $data['mode']='view';
         $data['message']=$message;
         $data['customer_info']=$this->customer_model->info($data['customer_number']);
		
		 $this->load->model('periode_model');
		 $data['closed']=$this->periode_model->closed($data['bill_date']);
         $this->session->set_userdata('bill_id',$id);		 
         $this->template->display('sales/kontra_bon',$data);                 
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
		$data['fields_caption']=array('Nomor','Tanggal','Jth Tempo','Termin',
		  'Jumlah','Customer#','Company','Paid');
		$data['fields']=array('bill_id','bill_date','date_to','termin',
		  'amount','customer_number','company','paid');
		$data['field_key']='bill_id';
		$data['caption']='DAFTAR KONTRA BON PENJUALAN';
		$data['posting_visible']=false;
        $data['fields_format_numeric']=array("amount");

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_number");
		$faa[]=criteria("Customer","sid_customer");
		$faa[]=criteria("Paid","sid_paid");

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
    			if($this->input->get('sid_customer')!='')$sql.=" and company like '".$this->input->get('sid_customer')."%'";
    			if($this->input->get('sid_paid')!=''){
    				if($this->input->get('sid_paid')=='1'){
    					$sql.=" and paid=true";
    				} else {
    					$sql.=" and (paid=false or paid is null)";				
    				}
    			}
    		}
            
        }
         
        
        echo datasource($sql);
    }	 
	function delete($id){
		//if(!allow_mod2('_40133'))return false;
		$id=urldecode($id);
		$this->db->query("delete from bill_detail where bill_id='$id'");
		$this->db->query("delete from bill_header where bill_id='$id'");
		echo json_encode(array("success"=>true,"msg"=>"Berhasil hapus nomor ini."));		
		$this->syslog_model->add($id,"bill_header","delete");
	}
        function save_item(){ 
			$kontra_bon=$this->session->userdata('bill_id');	
			$faktur=$this->input->post('faktur');
			$row_type=$this->input->post('row_type');
			$ok=false;
			$message="Tidak ada nomor faktur yang dipilih !";
			if($kontra_bon!=""){
				for($i=0;$i<count($faktur);$i++){
					$no=$faktur[$i];
					if($no!=""){
						if($q=$this->db->where("invoice_number",$no)->get("invoice")){
							if($r=$q->row()){
							    $amount=$r->amount;
							    $saldo=$r->saldo_invoice;
							    if($row_type=="retur"){
							    	$amount=$amount*-1;
									$saldo=$amount;
							    }
								$d['bill_id']=$kontra_bon;
								$d['invoice_number']=$no;
								$d['tanggal']=$r->invoice_date;
								$d['amount']=$amount;
								$d['saldo']=$saldo;
								$d['row_type']=$row_type;
								$this->db->insert("bill_detail",$d);
							}
						}
					}
					$ok=true;
					$message="Faktur sudah ditambahkan, silahkan refresh !";
				}
			}
            $amount=$this->db->query("select sum(amount) as z from bill_detail 
                where bill_id='$kontra_bon'")->row()->z;
            $this->db->query("update bill_header set amount='$amount' where bill_id='$kontra_bon'");
			$data['success']=$ok;
			$data['message']=$message;
			$data['amount']=$amount;
			echo json_encode($data);
			
        }        
        function delete_item($id){
			$id=urldecode($id);
            $kontra_bon="";
            if($q=$this->db->query("select bill_id from bill_detail where id='$id'")){
                if($r=$q->row()){
                    $kontra_bon=$r->bill_id;
                }
            }
            $data['success']=$this->db->where("id",$id)->delete("bill_detail");
            $amount=$this->db->query("select sum(amount) as z from bill_detail 
                where bill_id='$kontra_bon'")->row()->z;
            $this->db->query("update bill_header set amount='$amount' where bill_id='$kontra_bon'");
            $data['amount']=$amount;
			echo json_encode($data);
        }        
        function print_bukti($nomor){
			$nomor=urldecode($nomor);
            $data=$this->bill_header_model->get_by_id($nomor)->row_array();
			$data['content']=load_view('sales/rpt/print_kontra_bon',$data);
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
	function select_faktur($customer_number){
		$customer_number=urldecode($customer_number);

		$this->load->model('invoice_model');

		$sql="select i.invoice_number,i.invoice_date,i.due_date,i.amount,i.payment_terms,
		i.sold_to_customer,s.company,i.invoice_type
		from invoice i left join customers s on s.customer_number=i.sold_to_customer
		where invoice_type='I'
		and i.sold_to_customer='$customer_number'";
 // and (paid=false or isnull(paid))
		$query=$this->db->query($sql);
		$i=0;
		$rows[0]='';
		$ok=false;
		if($query){ 
			foreach($query->result_array() as $row){
				$nomor=$row['invoice_number'];
				$saldo=$this->invoice_model->recalc($nomor);
                $amount=$row['amount'];
                if($row['invoice_type']=='R')$amount=-1*$amount;
				if($saldo!=0){
					$row['amount']=number_format($amount);
					$row['saldo']=number_format($saldo);
					$rows[$i++]=$row;
				}
				$ok=true;
			};
		}
		$data['success']=$ok;
		$data['faktur']=$rows;
		echo json_encode($data);
	} 
	function select_retur($customer_number){
		$customer_number=urldecode($customer_number);

		$this->load->model('invoice_model');

		$sql="select i.invoice_number,i.invoice_date,i.due_date,i.amount,i.payment_terms,
		i.sold_to_customer,s.company,i.invoice_type
		from invoice i left join customers s on s.customer_number=i.sold_to_customer
		where invoice_type='R'
		and i.sold_to_customer='$customer_number'";
 // and (paid=false or isnull(paid))
		$query=$this->db->query($sql);
		$i=0;
		$rows[0]='';
		$ok=false;
		if($query){ 
			foreach($query->result_array() as $row){
				$nomor=$row['invoice_number'];
				$saldo=$this->invoice_model->recalc($nomor);
                $amount=$row['amount']*-1;
				$row['amount']=number_format($amount);
				$row['saldo']=number_format($saldo);
				$rows[$i++]=$row;
				$ok=true;
			};
		}
		$data['success']=$ok;
		$data['faktur']=$rows;
		echo json_encode($data);
	} 
	
}
