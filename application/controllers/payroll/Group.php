<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Group extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='hr_emp_level';
	private $sql="select * from hr_emp_level";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
	 	$this->load->model("payroll/employee_group_model");
		$this->load->model("payroll/jenis_tunjangan_model");
		$this->load->model("payroll/jenis_potongan_model");
		$this->load->model("payroll/hr_emp_level_com_model");
		
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('payroll/group',$data);
	}
	function save(){		 
		$data=$this->input->post();
		$id=$this->input->post("kode");
		$mode=$data["mode"];
		unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->employee_group_model->save($data);
		} else {
			$ok=$this->employee_group_model->update($id,$data);				
		}
		if($ok){echo json_encode(array("success"=>true,"kode"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->employee_group_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 
		 $data['jenis_tunjangan']=$this->jenis_tunjangan_model->dropdown();
		 $data['jenis_potongan']=$this->jenis_potongan_model->dropdown();

		 $data['salary_com_code']='';
		 $data['formula_string']='';
		 $data['no_urut']='';
		 

		 $data['salary_com_code2']='';
		 $data['formula_string2']='';
		 $data['no_urut2']='';
		 
		 $this->template->display_form_input('payroll/group',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('kode','Isi kode group', 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='kode',$order_type='asc')	{
        $data['caption']='DAFTAR GROUP KOMPONEN GAJI';
		$data['controller']='payroll/group';		
		$data['fields_caption']=array('Kode','Nama Group');
		$data['fields']=array('kode','keterangan');
		$data['field_key']='kode';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nomor","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select t.* from hr_emp_level t where 1=1";
		$s=$this->input->get('sid_kode');		
		if($s!=''){
			$sql.=" and kode='$s'";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and t.keterangan like '$s%'";
		}			
		$sql.=" order by t.kode";
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";

        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->employee_group_model->delete($id);
	 	$this->browse();
	}
	function deduct($group){
		$sql="select c.no_urut,c.salary_com_code,c.formula_string,
		c.take_home_pay,t.keterangan as salary_com_name,c.id
		from hr_emp_level_com c
		left join hr_jenis_potongan t on t.kode=c.salary_com_code
		where c.level_code='$group'  and t.keterangan is not null 
		order by c.no_urut";
		echo datasource($sql);
	}
	function income($group){
		$sql="select c.no_urut,c.salary_com_code,c.formula_string,
		c.take_home_pay,t.keterangan  as salary_com_name,c.id
		from hr_emp_level_com c
		left join hr_jenis_tunjangan t on t.kode=c.salary_com_code
		where c.level_code='$group' and t.keterangan is not null 
		order by c.no_urut";
		echo datasource($sql);		
	}
	function save_component($group){	
		if($this->input->post("salary_com_code2")){
			$data['salary_com_code']=$this->input->post("salary_com_code2");
			$data['formula_string']=$this->input->post("formula_string2");
			$data['no_urut']=$this->input->post("no_urut2");
			$data['level_code']=$this->input->post("level_code2");
			$data['id']=$this->input->post("id2");
		} else {
			$data=$this->input->post();
		}
		$id=$data['id'];
		unset($data['mode']);
		unset($data['id']);
		if($id==""){ 
			$ok=$this->hr_emp_level_com_model->save($data);
		} else {
			$ok=$this->hr_emp_level_com_model->update($id,$data);				
		}
		if($ok){echo json_encode(array("success"=>true,"kode"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function delete_component($id){
		$id=urldecode($id);
		$ok=$this->hr_emp_level_com_model->delete($id);				
		if($ok){echo json_encode(array("success"=>true,"msg"=>"Sukses"));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
}
