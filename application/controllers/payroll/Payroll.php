<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Payroll extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                 
        
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
	}
	function index(){	
            $this->template->display_table();
	}
	function reports(){
		$this->template->display('payroll/menu_reports');
	}
	function income(){
		$data['caption']="JENIS PENDAPATAN";		
		$this->template->display("payroll/income",$data);
	}
   function income_add(){
		$this->load->model('jenis_tunjangan_model');
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$ok=$this->jenis_tunjangan_model->save($data);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
   }
   function income_delete($kode){
   		$kode=htmlspecialchars_decode($kode);
		$this->load->model('jenis_tunjangan_model');
		$ok=$this->jenis_tunjangan_model->delete($kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
   }
	function deduct(){
		$data['caption']="JENIS POTONGAN";		
		$this->template->display("payroll/deduct",$data);
	}
   function deduct_add(){
		$this->load->model('jenis_potongan_model');
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$ok=$this->jenis_potongan_model->save($data);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
   }
   function deduct_delete($kode){
   		$kode=htmlspecialchars_decode($kode);
		$this->load->model('jenis_potongan_model');
		$ok=$this->jenis_potongan_model->delete($kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
   }
	function jabatan(){
		$data['caption']="JENIS JABATAN";		
		$this->template->display("payroll/jabatan",$data);
	}
   function jabatan_add(){
		$this->load->model('employee_level_model');
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$ok=$this->jenis_potongan_model->save($data);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
   }
   function jabatan_delete($kode){
   		$kode=htmlspecialchars_decode($kode);
		$this->load->model('employee_level_model');
		$ok=$this->jenis_potongan_model->delete($kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
   }
   function slip($group){
   		$kode=htmlspecialchars_decode($group);
		$this->load->model('payroll_model');
		$data['kode_group']=$kode;
		$data['com_list']=$this->payroll_model->list_componen();
		$data['salary_com_code']='';
		$data['formula_string']='';
		$data['no_urut']='';
		$data['id']='';
		$this->template->display("payroll/komponen",$data);
   }
	function slip_komponen($group,$command=""){
  		$kode=htmlspecialchars_decode($group);
		if($command=="save"){
			$data=$this->input->post(NULL,TRUE);
			$com_code=htmlspecialchars_decode($data['salary_com_code']);
			$this->load->model('hr_emp_level_com_model');
			$sql="select salary_com_name,id from hr_emp_level_com  where level_code='".$kode
				."' and salary_com_code='".$com_code."'";
			$query=$this->db->query($sql)->result();
			if($query){
				$id=$query->id;
				$ok=$this->hr_emp_level_com_model->update($id,$data);
			} else {
				unset($data['id']);
				$ok=$this->hr_emp_level_com_model->save($data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
			
		} else 	if($command=="delete"){
			$data=$this->input->post(NULL,TRUE);
			$line_number=$data['line_number'];
			$this->load->model('hr_emp_level_com_model');
			$ok=$this->hr_emp_level_com_model->delete($line_number);
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.$this->db->_error_message()));}   	
		} else {
			$sql="select c.no_urut,c.salary_com_code,k.keterangan as salary_com_name,c.formula_string 
				,k.jenis,c.id from hr_emp_level_com c left join qry_payroll_component k on k.kode=c.salary_com_code 
				where c.level_code='".$kode."' order by k.jenis,c.no_urut
			";
			echo datasource($sql);		
		}
	}
	 
}
