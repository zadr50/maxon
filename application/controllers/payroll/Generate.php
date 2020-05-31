<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Generate extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                 
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
		$this->load->library("list_of_values");
		$this->load->library("sysvar");
		$this->load->model("payroll/paycheck_model");
	}
	function index()
	{	
		$data['message']='';
		$data['lookup_periode']=$this->list_of_values->render(array(
				"dlgBindId"=>"pay_period","dlgId"=>"LovPeriode",
				"dlgUrlQuery"=>base_url()."index.php/payroll/periode/browse_data/",
				"dlgCols"=>array(
					array("fieldname"=>"period","caption"=>"Kode","width"=>"80px"),
					array("fieldname"=>"period_name","caption"=>"Keterangan","width"=>"200px"),				
					array("fieldname"=>"from_date","caption"=>"From","width"=>"80px"),
					array("fieldname"=>"to_date","caption"=>"To","width"=>"80px")
				),
				"dlgRetFunc"=>"$('#pay_period').val(row.period);"
			));
		
		$this->template->display_form_input('payroll/generate_slip',$data,'');
	}
	function proses(){
		$this->load->model('payroll/periode_model');
		$pay_period=$this->input->get('pay_period');
		$nip_cari=$this->input->get("nip_cari");
		if($pr=$this->periode_model->get_by_id($pay_period)->row()){
			$from_date=$pr->from_date;
			$to_date=$pr->to_date;
		} else {
			$from_date=Date('Y-m-d');
			$to_date=$from_date;
		}
		$s="select nip,nama,emptype from employee where 1=1 ";
		if($nip_cari!=""){
			$s.=" and nip='$nip_cari'";
		}
		if($rec=$this->db->query($s)){
			foreach($rec->result() as $emp){
				$pay_no="";
				$new=true;
				$nip=$emp->nip;
				if($q=$this->db->query("select pay_no from hr_paycheck where employee_id='$emp->nip' and pay_period='$pay_period'")){
					if($r=$q->row()){
						$new=false;
						$pay_no=$r->pay_no;
					}
				}
				if($pay_no==""){
					$pay_no=$this->nomor_bukti();
					
				}
								
				
				if($nip!=""){
					$data['employee_id']=$nip;
					$data['pay_period']=$pay_period;
					$data['pay_date']=Date('Y-m-d');
					$data['pay_no']=$pay_no;
					$data['from_date']=$from_date;
					$data['to_date']=$to_date;
					$data['emp_level']=$emp->emptype;
					//simpan kalau belum ada saja
					if ($new){
						$this->nomor_bukti(true);
						echo "<br>Success: Nip: ".$emp->nip." SlipNo: ".$pay_no;
					} else {
						echo "<br>Exist: Nip: ".$emp->nip." SlipNo: ".$pay_no;
					}
					$ok=$this->paycheck_model->save($data);
						
					
				}
				
			}
			echo "<br>Finish.<br>Data slip gaji sudah dibuat untuk melihat slip gaji klik menu slip gaji.";
		}
		
	}
	function nomor_bukti($add=false)
	{
		$key="Paycheck Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!SL~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!SL~$00001');
				$rst=$this->paycheck_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;			
		}
	}
	
}