<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Overtime extends CI_Controller {
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
        
        
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		if(!$this->access->is_login())redirect(base_url());
	 	$this->load->model("payroll/overtime_model");
        $this->load->model('payroll/employee_model');
	}
	function index()
	{
        if (!allow_mod2('_12003')) exit;
        	
        $data['message']='';
		$data['tanggal']= date("Y-m-d H:i:s");	
        
        
        $data['nip']="";        $data['dept']="";
        $data['divisi']="";     $data['nama']="";
        $user=$this->session->userdata('logged_in');
        
        if($user['nip']!=""){
            $ruser=$this->employee_model->get_by_id($user['nip'])->row();
            $data['dept']=$ruser->dept;
            $data['divisi']=$ruser->divisi;
            $data['nip']=$ruser->nip;
            $data['nama']=$ruser->nama;
            
        }
        $data['flag1']=$user['flag1'];
                
        $this->template->display('payroll/overtime',$data,'');
	}
	
  	function save(){
		$data=$this->input->post();
		 
		$id=$data['id'];
		 		
		if($id==0 or $id==''){
			unset($data['id']);
			$ok=$this->overtime_model->save($data);				
			
		} else {
			$ok=$this->overtime_model->update($id,$data);
		}
		
		if($ok){echo json_encode(array("success"=>true));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function data($nip=""){
		$sql="select e.nip,e.nama,a.time_in,a.time_out,a.id,a.time_total,a.supervisor,a.keterangan,
			ttc_1x,ttc_2x,ttc_3x,ttc_4x,a.time_total_calc,a.salary_no,a.hari_libur,a.add_to_slip
		from employee e left join overtime_detail a 
		on a.nip=e.nip and year(tanggal)=".date("Y")." and month(tanggal)=".date('m')." and day(tanggal)=".date('d');
        if($nip!="")$sql.=" and e.nip='$nip'";
		echo datasource($sql);
	}
	function get_id($id){
		$id=urldecode($id);
		$sql="select e.nip,e.nama,a.time_in,a.time_out,a.id,a.time_total,a.supervisor,a.keterangan,
			ttc_1x,ttc_2x,ttc_3x,ttc_4x,a.time_total_calc,a.salary_no,a.hari_libur,a.add_to_slip,e.dept,e.divisi,e.emptype
		from  overtime_detail a  join employee e on e.nip=a.nip
		where a.id='$id'";
		 
		echo json_encode($this->db->query($sql)->row());
	}
  	function delete($id){
		$id=urldecode($id);
		$ok=$this->overtime_model->delete($id);
		if($ok){echo json_encode(array("success"=>true));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}

}
