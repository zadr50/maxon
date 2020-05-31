<?php
class Time_card_detail_model extends CI_Model {

private $primary_key='id';
private $table_name='time_card_detail';
private $hadir=0;
private $tidak=0;
public $pay_no="";
function __construct(){
	parent::__construct();              
		$this->load->model("payroll/paycheck_model");
		$this->load->model('payroll/overtime_model');
	}
	function get_id($nip,$tanggal){
		$ret=0;
		$s="select id from time_card_detail where nip='$nip' and tanggal='$tanggal'";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$ret=$r->id;
			}
		}
		return $ret;
	}

	function save($data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		//if($this->pay_no==""){
			$this->pay_no=$this->paycheck_model->get_salary_no($data['nip'],$data['tanggal']);
		//}
		if(!isset($data['salary_no']))$data['salary_no']=$this->pay_no;		
		if($data['salary_no']=="")$data['salary_no']=$this->pay_no;
		
		
		$id=$this->get_id($data['nip'],$data['tanggal']);
		if($id>0){
			$ok = $this->update($id,$data);
		} else  {
			$ok = $this->db->insert($this->table_name,$data);			
		}	
		
		$this->overtime_save($data);
		return $ok;
	}
	function update($id,$data){
		if($data['nip']=='900060'){
			//echo 1;
			
		}
//		if($this->pay_no==""){
			$this->pay_no=$this->paycheck_model->get_salary_no($data['nip'],$data['tanggal']);
//		}		
		if(!isset($data['salary_no']))$data['salary_no']=$this->pay_no;		
		if($data['salary_no']=="")$data['salary_no']=$this->pay_no;
		
		$this->db->where($this->primary_key,$id);
		$ok = $this->db->update($this->table_name,$data);
		$this->overtime_save($data);
		return $ok;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function calc_hari_absen($pay_no){
		$this->pay_no=$pay_no;
		if($this->hadir==0)$this->calc_absensi();
		return $this->tidak;
	}
	function calc_hari_hadir($pay_no){
		$this->pay_no=$pay_no;
		//if($this->hadir==0)
		$this->calc_absensi();
		return $this->hadir;
	}
	function calc_absensi(){
		$pay_no=$this->pay_no;
		$ret=0;
		$tidak=0; $hadir=0;
		if($slip=$this->paycheck_model->get_by_id($pay_no)){
			if($row=$slip->row()){
				 
				$from=$row->from_date;
				$to=$row->to_date;
				$nip=$row->employee_id;
				if($absensi=$this->load_salary_no($pay_no,$nip)){
					foreach($absensi->result() as $row){
						if($row->absen_type==1 or $row->absen_type==9){
							$tidak++;
						} else {
							$hadir++;
						}
					}
				}
			}
		}
		$this->hadir=$hadir;
		$this->tidak=$tidak;
	}
	function load_salary_no($salary_no,$nip){
		$s="select * from time_card_detail 
		where salary_no='$salary_no' and nip='".$nip."'";
		return $this->db->query($s);
		
	}
	function loadlist($from,$to,$nip){
		$s="select * from time_card_detail 
		where tanggal>='".$from."' and tanggal<='".$to."'
		and nip='".$nip."'";
		return $this->db->query($s);
	}
    function overtime_save($data){
    	if(!isset($data['ot_in'])){
    		return false;
    	}
        $dataot["tanggal"]=$data["tanggal"];
        $dataot["nip"]=$data["nip"];
        $dataot["time_in"]=$data["ot_in"];
        $dataot["time_out"]=$data["ot_out"];
        if(isset($data['id']))$dataot["tcid"]=$data['id'];
        $dataot['salary_no']=$data['salary_no'];
		if(!isset($data['work_status']))$data['work_status']="";
		$dataot['work_status']=$data['work_status'];
		if($data['work_status']=="OTL" || $data['work_status']=="OTN"){
			$dataot['hari_libur']=1;
		} else {
			$dataot['hari_libur']=0;
		}
        $this->overtime_model->save($dataot);
    }

}
