<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Generate extends CI_Controller {
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
		if($pr=$this->periode_model->get_by_id($pay_period)->row()){
			$from_date=$pr->from_date;
			$to_date=$pr->to_date;
		} else {
			$from_date=Date('Y-m-d');
			$to_date=$from_date;
		}
		if($rec=$this->employee_model->loadlist()){
			foreach($rec->result() as $emp){
				$pay_no=$this->nomor_bukti();
				$data['employee_id']=$emp->nip;
				$data['pay_period']=$pay_period;
				$data['pay_date']=Date('Y-m-d');
				$data['pay_no']=$pay_no;
				$data['from_date']=$from_date;
				$data['to_date']=$to_date;
				$data['emp_level']=$emp->emptype;
				//simpan kalau belum ada saja
				if (!$pay_no_x=$this->paycheck_model->get_pay_no($emp->nip,$pay_period)){
					$ok=$this->paycheck_model->save($data);
					$this->nomor_bukti(true);
					echo "<br>Success: Nip: ".$emp->nip." SlipNo: ".$pay_no;
				} else {
					echo "<br>Exist: Nip: ".$emp->nip." SlipNo: ".$pay_no_x;
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