<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Pinjaman extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='hr_emp_loan';
	private $sql="select * from hr_emp_loan";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
	 	$this->load->model("payroll/employee_model");
	 	$this->load->model("payroll/pinjaman_model");
	}
	function nomor_bukti($add=false)
	{
		$key="Loan Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!LN~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!LN~$00001');
				$rst=$this->pinjaman_model->get_by_id($no)->row();
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
		$data['nama_pegawai']='';
		if($record==NULL){
			$data['loan_number']=$this->nomor_bukti();
			$data['date_loan']= date("Y-m-d H:i:s");		
		}
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('payroll/pinjaman',$data);
	}
	function save(){
		 
			$data=$this->input->post();
			$id=$this->input->post("loan_number");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$id=$this->nomor_bukti();
				$data['loan_number']=$id;
				$ok=$this->pinjaman_model->save($data);
			} else {
				$ok=$this->pinjaman_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"loan_number"=>$id));} 
			else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
		    
		  
	}
	function view($id,$message=null){

		 $id=urldecode($id);
		 $model=$this->pinjaman_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $data['nama_pegawai']=$this->employee_model->info($data['nip']);
		
		 $this->template->display_form_input('payroll/pinjaman',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('loan_number','Isi nomor pinjaman', 'required');
		 $this->form_validation->set_rules('nip','Isi NIP Pegawai', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR PINJAMAN  KARYAWAN';
		$data['controller']='payroll/pinjaman';		
		$data['fields_caption']=array('Nomor','NIP','Nama Pegawai','Dept','Divisi','Tanggal','Jml Pinjaman','Jk Waktu','Jumlah');
		$data['fields']=array('loan_number','nip','nama','dept','divisi','loan_date','loan_amount','loan_count');
		$data['field_key']='loan_number';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nomor","sid_loan_number");
		$faa[]=criteria("NIP","sid_nip");
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Dept","sid_dept");
        
		$data['criteria']=$faa;
        $data['fields_format_numeric']=array("loan_amount");
        $this->template->display_browse2($data);            
        
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select l.loan_number,e.nip,e.nama,e.dept,e.divisi,l.loan_amount 
		from hr_emp_loan l 
		left join employee e on e.nip=l.nip 
		where 1=1";
		$s=$this->input->get('sid_loan_number');		
		if($s!=''){
			$sql.=" and loan_number='$s'";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and nama like '$s%'";
			$s=$this->input->get('sid_nip');if($s!='')$sql.=" and nip='$s'";
			$s=$this->input->get('sid_dept');if($s!='')$sql.=" and dept='$s'";
		}			
        echo datasource($sql);		
    }
      
	function delete_by_id($id){
		$id=urldecode($id);
	 	$ok=$this->pinjaman_model->delete_row_id($id);
	 	echo json_encode(array("success"=>$ok));
	 	
	}
	function delete($loan_number){
		$id=urldecode($loan_number);
	 	$ok=$this->pinjaman_model->delete($id);
	 	echo json_encode(array("success"=>$ok));
	 	
	}
	
	function select($search=''){
		$search=urldecode($search);
		$sql="select nama,nip,dept,divisi	from employee 
		where nama like '$search%')
		order by nama limit 100";
		echo datasource($sql);
	}
	function cicilan($cmd,$id="") {
		$id=urldecode($id);
		if($cmd=="list") {
			$sql="select tanggal_jth_tempo,awal,pokok,bunga,angsuran,akhir, 
			payment_no,comments,loan_number,id 
			from hr_emp_loan_schedule	
			where loan_number='$id'
			order by tanggal_jth_tempo";
			echo datasource($sql);
		}
	}
}
