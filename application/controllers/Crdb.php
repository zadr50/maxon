<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class CrDb extends CI_Controller {
    private $limit=10;
    private $sql="select kodecrdb,docnumber,tanggal,amount from crdb_memo";
    private $controller='CrDb';
    private $primary_key='kodecrdb';
    private $file_view='sales/crdb';
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
	function nomor_bukti($add=false,$type="")
	{
		if($type==""){
		$key="CrDB Numbering";
		} else {
			$key=$type." CrDB Numbering";
		}
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!CRDB~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!CRDB~$00001');
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
	function add()
	{
		$docnumber=$this->input->get('docnumber');
		if(!$docnumber){
			echo 'Salah nomor faktur, atau faktur tidak ada ! ';
		} else {
			$data['kodecrdb']=$this->nomor_bukti();
			$data['tanggal']=date('Y-m-d');
			$data['docnumber']=$docnumber;
			$data['amount']=0;
			$data['keterangan']="";
			$data['mode']='add';
			$this->load->view('sales/crdb',$data);
		}
	}
	function save()
	{
		$invoice_number=$this->input->post('docnumber');
		$mode=$this->input->post('mode');
		$type="";
		if($this->input->post('trans_type'))$type=$this->input->post('trans_type');
		if($invoice_number!="")
		{
			if($mode=="add"){
		        $id=$this->nomor_bukti(false,$type);
			} else {
				$id=$this->input->post('kodecrdb');			
			}
			$data['kodecrdb']=$id;
			$data['tanggal']=$this->input->post('tanggal');
			$data['docnumber']=$invoice_number;
			$data['amount']=$this->input->post('amount');
			if($data['amount']=="")$data["amount"]=0;
			$data['keterangan']=$this->input->post('keterangan');
			$data['transtype']=$this->input->post('transtype');
			if($this->input->post("supplier_number")){
				$data['cust_supp']=$this->input->post("supplier_number");
			}
			if($this->input->post("customer_number")){
				$data['cust_supp']=$this->input->post("customer_number");
			}
			$data['doc_type']=$this->input->post('doc_type');
			$data['outlet']=$this->input->post("outlet");
			
			if($mode=="add"){
				$ok=$this->crdb_model->save($data);
				$this->syslog_model->add($id,"crdb","add");
				
			} else {
				$ok=$this->crdb_model->update($id,$data);
				$this->syslog_model->add($id,"crdb","edit");
				
			}
			if ($ok){
				if($mode=="add")$this->nomor_bukti(true,$type);
				echo json_encode(array('success'=>true,'kodecrdb'=>$id));
			} else {
				echo json_encode(array('msg'=>'Some errors occured.'));
			}
		}
	}
	function items($kode,$type="json"){
		$kode=urldecode($kode);
		$sql="select c.account,c.account_description as description,d.amount,d.lineid as line_number 
		from crdb_memo_dtl d left join chart_of_accounts c 
		on c.id=d.accountid
		 where kodecrdb='$kode'";
		echo datasource($sql);
	}
	function save_item(){
		$acc=$this->input->post('account');
		$amt=$this->input->post("amount");
		$kode=$this->input->post('kodecrdb_no');
		if($amt=='')$amt=0;
		if($acc){
			$this->load->model('chart_of_accounts_model');
			$accid=$this->chart_of_accounts_model->get_by_id($acc)->row()->id;
			if($accid){
				$data['accountid']=$accid;
				$data['kodecrdb']=$kode;
				$data['amount']=$amt;
				if ($this->crdb_model->save_item($data)){
					$this->nomor_bukti(true);
					echo json_encode(array('success'=>true));
				} else {
					echo json_encode(array('msg'=>'Some errors occured.'));
				}
			}
		}
		
	}
    function delete_item(){
    	$id=$this->input->post('line_number');
        $this->load->model('crdb_model');
		$this->syslog_model->add($id,"crdb","delete");
        $ok = $this->crdb_model->delete_item($id);
        echo json_encode(array("success"=>$ok));
    }   
	function print_bukti($nomor){
		$nomor=urldecode($nomor);
        $crdb=$this->crdb_model->get_by_id($nomor)->row_array();
		$data=$crdb; 		 
        $data['content']=load_view('sales/rpt/print_crdb',$data);    	
        $this->load->view('pdf_print',$data);    	
    }	
}

?>
