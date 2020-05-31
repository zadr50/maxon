<?php
class Paycheck_model extends CI_Model {

	private $primary_key='pay_no';
	private $table_name='hr_paycheck';
	private $pay_no='';				//--- nomor slip gaji yang aktif
	private $level_code='';			//--- kelompok slip gaji karyawan
	private $employee_id='';
	private $gaji_pokok=0,$total_pendapatan=0,$total_potongan=0,$salary=0;
	
	function __construct(){
		parent::__construct();        
       
	 	$this->load->model("payroll/jenis_tunjangan_model");
	 	$this->load->model("payroll/jenis_potongan_model");
		$this->load->model('payroll/paycheck_sal_com_model');
		$this->load->model('payroll/hr_emp_level_com_model');

	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_pay_no($nip,$pay_period){
		$this->db->where(array("employee_id"=>$nip,"pay_period"=>$pay_period));
		if($row=$this->db->get($this->table_name)->row()){
			return $row->pay_no;
		} else {
			return null;
		}
	}

	function save($data){
		if($data['from_date'])$data['from_date']= date('Y-m-d H:i:s', strtotime($data['from_date']));		
		if($data['to_date'])$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));		
		if($data['pay_date'])$data['pay_date']= date('Y-m-d H:i:s', strtotime($data['pay_date']));		
		$this->pay_no=$data['pay_no'];
		$this->employee_id=$data['employee_id'];		
		if($emp=$this->employee_model->get_by_id($this->employee_id)->row()){
			$this->level_code=$emp->emptype;
			$this->gaji_pokok=$emp->gp;
		}
		if($data['emp_level']=='')$data['emp_level']=$this->level_code;
        $id=0;
        if(isset($data["id"]))$id=$data["id"];
        if($id==0){
        	if($q=$this->db->query("select id from hr_paycheck where pay_no='$this->pay_no' ")){
        		if($r=$q->row()){
        			$id=$r->id;
        		}
        	}
        }
		if($id==0){
            $this->db->insert($this->table_name,$data);			
			$id=$this->db->insert_id();
		} else {
			$this->db->where("id",$id)->update($this->table_name,$data);
		}
		$this->save_slip_gaji();
		return $id;
	}
	function update($id,$data){
		if($data['from_date'])$data['from_date']= date('Y-m-d H:i:s', strtotime($data['from_date']));		
		if($data['to_date'])$data['to_date']= date('Y-m-d H:i:s', strtotime($data['to_date']));		
		if($data['pay_date'])$data['pay_date']= date('Y-m-d H:i:s', strtotime($data['pay_date']));		
		$this->pay_no=$data['pay_no'];
		$this->employee_id=$data['employee_id'];		
		if($emp=$this->employee_model->get_by_id($this->employee_id)->row()){
			$this->level_code=$emp->emptype;
			$this->gaji_pokok=$emp->gp;
		}
		if($data['emp_level']=='')$data['emp_level']=$this->level_code;
		$id=$this->db->where("pay_no",$id)->update($this->table_name,$data);
		return $id;
	}
	function delete($kode){
		$this->db->where("pay_no",$kode);
		$this->db->delete("hr_paycheck_sal_comp");
		
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function save_slip_gaji(){
		$rec_level=$this->hr_emp_level_com_model->loadlist($this->level_code);
		$com_code=$this->input->post('com_code');
		for($i=0;$i<count($rec_level);$i++){
			$rec=$rec_level[$i];
			$data=null;
			$data['pay_no']=$this->pay_no;		
			$data['salary_com_code']=$rec->salary_com_code;
			if(isset($com_code))$data['org_value']=$com_code[$rec->salary_com_code];
			$data['calc_value']=0;
			$data['unit']='';
			if($rec->salary_com_code=="G_POKOK"){
				$data['org_value']=$this->gaji_pokok;
			}
			 
			$id=$this->paycheck_sal_com_model->get_id($this->pay_no,$rec->salary_com_code);
			if( $id == null ) {
				$this->paycheck_sal_com_model->save($data);
			} else {
				$this->paycheck_sal_com_model->update($id,$data);	
			}
		}
		$this->paycheck_sal_com_model->recalc($this->pay_no,$this->level_code);
	}
    function salary_no_from_date($tanggal,$nip){
    	return $this->get_salary_no($nip, $tanggal);
    }
	function get_salary_no($nip,$tanggal){
		$s="select pay_no from hr_paycheck where '$tanggal' between from_date and to_date 
			and employee_id='$nip' ";
		$pay_no="";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$pay_no=$r->pay_no;
			}
		}
		$this->pay_no=$pay_no;
		return $this->pay_no;
		
	}
        
    
}