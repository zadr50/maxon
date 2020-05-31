<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Salary extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='hr_paycheck';
	private $sql="select * from hr_paycheck";

	function __construct()
	{
		parent::__construct();
          
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
		$this->load->model('payroll/paycheck_sal_com_model');
		$this->load->library("List_of_values");
	 	$this->load->model("payroll/employee_model");
	 	$this->load->model("payroll/paycheck_model");
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
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
		if($record==NULL)$data['pay_no']=$this->nomor_bukti();
		$data['nama_pegawai']='';
		
		$data['from_date']= date('Y-m-d', strtotime($data['from_date']));
		$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));
		$data['pay_date']= date('Y-m-d', strtotime($data['pay_date']));
		$id=$data['pay_no'];
		 $data['nama_pegawai']=$this->employee_model->info($data['employee_id']);
		 $this->paycheck_sal_com_model->employee_id=$data['employee_id'];
		 $this->paycheck_sal_com_model->paycheck_no=$id;
		 $this->paycheck_sal_com_model->init();
		 $data['tunjangan_list']=$this->paycheck_sal_com_model->tunjangan_list();
		 $data['potongan_list']=$this->paycheck_sal_com_model->potongan_list();
		 $data['absensi_list']=$this->paycheck_sal_com_model->absensi_list();

		 
		 $data['lookup_periode']=$this->list_of_values->render(array(
				"dlgBindId"=>"hr_period",
				"dlgCols"=>array(
					array("fieldname"=>"period","caption"=>"Kode","width"=>"80px"),
					array("fieldname"=>"period_name","caption"=>"Keterangan","width"=>"200px"),				
					array("fieldname"=>"from_date","caption"=>"From","width"=>"80px"),
					array("fieldname"=>"to_date","caption"=>"To","width"=>"80px")
				),
				"dlgRetFunc"=>"$('#pay_period').val(row.period);
    				$('#from_date').datebox({value:row.from_date,formatter:format_date,parser:parse_date});
    				$('#to_date').datebox({value:row.to_date,formatter:format_date,parser:parse_date});				
				"
			));
		 $data['lookup_emp_type']=$this->list_of_values->render(array(
				"dlgBindId"=>"hr_emp_level",
				"dlgCols"=>array(
					array("fieldname"=>"kode","caption"=>"Kode","width"=>"80px"),
					array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
				),
				"dlgRetFunc"=>"$('#emp_level').val(row.kode);"
			));
		$data["lookup_employee"]=$this->list_of_values->render(array(
		  "dlgBindId"=>"employee",
		  "dlgColsData"=>array("nip","nama","dept","divisi"),
		  "dlgRetFunc"=>"$('#nip').val(row.nip);
		  	  $('#employee_id').val(row.nip);
		      $('#nama').html(row.nama);
		      $('#dept').html(row.dept);
		      $('#divisi').html(row.divisi);"
		));
        return $data;
	}
	function index(){$this->browse();}

	function add($nip="")	{
		$data=$this->set_defaults();           
		if($nip!=""){
			$data["employee_id"]=$nip;
			$data["pay_period"]=date("Y-m");
			if($q=$this->db->query("select emptype,nama,gp,status from employee where nip='$nip' ")){
				if($r=$q->row()){
					$data["emp_level"]=$r->emptype;
					$data["nama_pegawai"]=$r->nama.", Status: ".$r->status.", Gaji Pokok: ".number_format($r->gp);
				}
			}
		}
	 	$this->_set_rules();
		$data['mode']='add';
		$data['from_date']= date('Y-m-d');
		$data['to_date']= date('Y-m-d H:i:s');
		$data['pay_date']= date('Y-m-d');
				
        $this->template->display_form_input('payroll/paycheck',$data);
	}
	function save(){		 
		$data=$this->input->post();
		$id=$this->input->post("pay_no");
		$manual=$this->input->post("manual");
		
		$mode=$data["mode"];
		unset($data['mode']);
		if($mode=="add"){ 
			$id=$this->nomor_bukti();
			$data['pay_no']=$id;
			$ok=$this->paycheck_model->save($data);
		} else {
			$data_pay['employee_id']=$data['employee_id'];
			$data_pay['pay_period']=$data['pay_period'];
			$data_pay['from_date']=$data['from_date'];
			$data_pay['to_date']=$data['to_date'];
			$data_pay['pay_date']=$data['pay_date'];
			$data_pay['pay_type']=$data['pay_type'];
			$data_pay['emp_level']=$data['emp_level'];
			$data_pay['pay_no']=$data['pay_no'];
			$ok=$this->paycheck_model->update($id,$data_pay);	
			$this->paycheck_model->save_slip_gaji();
		}
		if($ok){echo json_encode(array("success"=>true,"pay_no"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function recalc($pay_no){
			$this->load->model("payroll/paycheck_model");
		$this->load->model("payroll/employee_model");
		$this->load->model("payroll/paycheck_sal_com_model");
		$nip="";	$level_code="";
		if(!$pay=$this->paycheck_model->get_by_id($pay_no)){
			echo "Unable load paycheck model !";
			return;
		}
		$nip=$pay->row()->employee_id;
		if($emp=$this->employee_model->get_by_id($nip)->row()){
			$level_code=$emp->emptype;
		}
		$this->paycheck_sal_com_model->recalc($pay_no,$level_code);
	}
    function recalc_group($pay_no,$new_group=""){
        $this->load->model("payroll/paycheck_model");
        //hapus dulu kemudian bikin lagi
        $data=null;
        if($q=$this->paycheck_model->get_by_id($pay_no)){
            if($r=$q->row()) {
                $data=(array)$r;   
            }  
        }
        //$this->db->where("pay_no",$pay_no)->delete("hr_paycheck_sal_comp");
        
        $this->paycheck_model->save($data);
        
        $this->view($pay_no);
    }
   
	function view($id,$message=null){
		
		 $id=urldecode($id);
		 $model=$this->paycheck_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		//$data['total_pendapatan']=$this->paycheck_model->total_pendapatan;
		//$data['total_potongan']=$this->paycheck_model->total_potongan;
		$data['hari_hadir']=0;
		$data['hari_absen']=0;
		//$data['salary']=$this->paycheck_model->salary;
		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 
		 $this->template->display_form_input('payroll/paycheck',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('pay_no','Isi nomor slip gaji', 'required');
		 $this->form_validation->set_rules('employee_id','Isi NIP Pegawai', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR SLIP GAJI';
		$data['controller']='payroll/salary';		
		$data['fields_caption']=array('Nomor','NIP','Nama Pegawai','Periode','Tanggal','Kelompok',
		'Dept','Divisi','Nip Id');
		$data['fields']=array('pay_no','employee_id','nama','pay_period','pay_date','emptype',
		'dept','divisi','nip_id');
		$data['field_key']='pay_no';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Periode YYYY-MM","sid_periode");
		$faa[]=criteria("Nomor","sid_pay_no");
		$faa[]=criteria("NIP","sid_employee_id");
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Dept","sid_dept");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        $d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
        $d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        if($d1<'2000-01-01')$d1=date("Y-m-d");        
        if($d2<'2000-01-01')$d2=date("Y-m-d H:i:s");        
        
		$sql="select l.pay_no,l.employee_id,e.nama,e.dept,e.divisi,l.pay_date,l.pay_period,
		e.emptype,e.nip_id 
		from hr_paycheck l
		left join employee e on e.nip=l.employee_id 
		where 1=1 ";	//l.pay_date between '$d1' and '$d2' ";
		$s=$this->input->get('sid_pay_no');
		if($s1=$this->input->get("tb_search")){
			$s=$s1;
		}		
		if($s!=''){
			$sql.=" and (pay_no='$s' or e.nama like '%$s%' or e.nip='$s' )";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and e.nama like '$s%'";
			$s=$this->input->get('sid_employee_id');if($s!='')$sql.=" and e.nip='$s'";
			$s=$this->input->get('sid_dept');if($s!='')$sql.=" and e.dept='$s'";
			$s=$this->input->get('sid_periode');if($s!='')$sql.=" and l.pay_period='$s'";
		}			
        $sql.=" order by l.pay_period,e.nama";
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        //echo $sql;
		
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->load->model("payroll/paycheck_model");
	 	$this->paycheck_model->delete($id);
	 	$this->browse();
	}
	function print_slip($pay_no){
		$pay_no=urldecode($pay_no);
		$pay=$this->paycheck_model->get_by_id($pay_no)->row(); 
		$emp=$this->employee_model->get_by_id($pay->employee_id)->row();
        if(!$emp){
            echo "Employee Id not found ! [$pay->employee_id]";
            exit;
        }
        
		$data['pay']=$pay;
		$data['emp']=$emp;
		$this->paycheck_sal_com_model->employee_id=$emp->nip;
		$this->paycheck_sal_com_model->paycheck_no=$pay_no;
		$this->paycheck_sal_com_model->init();
		$data['absensi']=$this->paycheck_sal_com_model->absensi_list();
		$data['pendapatan']=$this->paycheck_sal_com_model->tunjangan_list();
		$data['potongan']=$this->paycheck_sal_com_model->potongan_list();
		$data['content']=load_view('payroll/rpt/print_slip.php',$data);
        
		$this->load->view('pdf_print',$data);		
	}
	function generate(){
		redirect("payroll/generate");
	}
	function employee($nip){
		$s="select * from hr_paycheck where employee_id='$nip' order by pay_period";
		echo datasource($s);
	}
	function manual_check($row_id){
		$s="update hr_paycheck_sal_comp set manual=1 where id='$row_id' ";
		$this->db->query($s);
		echo json_encode(array("success"=>true,"message"=>"Sukses"));
	}
	function manual_uncheck($row_id){
		$s="update hr_paycheck_sal_comp set manual=0 where id='$row_id' ";
		$this->db->query($s);		
		echo json_encode(array("success"=>true,"message"=>"Sukses"));
	}
}
