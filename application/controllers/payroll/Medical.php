<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Medical extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='employeemedical';
	private $sql="select * from employeemedical";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
		$this->load->library('list_of_values');
		$this->load->model('payroll/employee_model');
		$this->load->model('payroll/medical_model');
		$this->load->library('search_criteria');
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
		$data['nama_pegawai']='';
		$data['medicaldate']= date('Y-m-d H:i:s', strtotime($data['medicaldate']));
		$id=$data['id'];
		$data['nama_pegawai']=$this->employee_model->info($data['employeeid']);
        $data['lookup_employee']=$this->list_of_values->render(array(
                "dlgBindId"=>"employee", 
                "dlgCols"=>array(
                    array("fieldname"=>"nip","caption"=>"Nip","width"=>"80px"),
                    array("fieldname"=>"nama","caption"=>"Nama","width"=>"200px"),
                    array("fieldname"=>"dept","caption"=>"Dept","width"=>"80px"),
                    array("fieldname"=>"divisi","caption"=>"Divisi","width"=>"80px")
                ),
                "dlgRetFunc"=>"$('#nip').val(row.nip);$('#employeeid').val(row.nip);
                $('#nama_pegawai').val(row.nama);"
            ));
            
		
        return $data;
		
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('payroll/medical',$data);
	}
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("id");
		$mode=$data["mode"];
		unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->medical_model->save($data);
		} else {
			$ok=$this->medical_model->update($id,$data);				
		}
		if($ok){echo json_encode(array("success"=>true,"period"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->medical_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('payroll/medical',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('medicaldate','Isi tanggal', 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='nip',$order_type='asc')	{
        $data['caption']='DAFTAR MEDICAL KARYAWAN';
		$data['controller']='payroll/medical';		
		$data['fields_caption']=array('Nama Karyawan','NIP','Tanggal','Keterangan','Amount','Id');
		$data['fields']=array('nama','employeeid','medicaldate','description','amount','id');
		$data['field_key']='id';
		$data['fields_format_numeric']=array("amount");
		
		$faa[]=criteria("NIP","sid_nip");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select o.employeeid,e.nama, o.medicaldate,o.description,o.id,o.amount 
		from employeemedical o left join employee e on e.nip=o.employeeid ";
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$ok=$this->medical_model->delete($id);
        echo json_encode(array("success"=>$ok,"msg"=>"Sukses"));
	}
}
