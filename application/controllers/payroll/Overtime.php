<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Overtime extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                 
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		if(!$this->access->is_login())redirect(base_url());
	 	$this->load->model("payroll/overtime_model");
        $this->load->model('payroll/employee_model');
		$this->load->model('payroll/periode_model');
		$this->load->model('payroll/paycheck_model');
		
		
	}
	function index(){

        if (!allow_mod2('_12003')) exit;
        $user=$this->session->userdata('logged_in');
        
		$data['title']='DATA ABSENSI';
		$data['tanggal']= date("Y-m-d H:i:s");	
		$this->load->model('periode_model');
		$data['periode']=date("Y-m");	///$this->periode_model->current_periode();
		$data['periode_list']=$this->periode_model->dropdown();
        
		$data['nip']=$user['nip'];
		$data['nama']=$user['username'];
		$data['dept']='';
		$data['divisi']='';		
        if($user['nip']!=""){
            $ruser=$this->employee_model->get_by_id($user['nip'])->row();
            $data['dept']=$ruser->dept;
            $data['divisi']=$ruser->divisi;
        }
        $data['flag1']=$user['flag1'];
        
        $setwh['dlgBindId']="warehouse";
        $setwh['dlgRetFunc']="$('#warehouse_code').val(row.location_number);";
        $setwh['dlgCols']=array( 
                    array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                    array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                    array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                    array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                );          
        $data['lookup_employee']=$this->list_of_values->render(array(
            "dlgBindId"=>"employee",
            "dlgRetFunc"=>"$('#nip').val(row.nip);$('#nama').val(row.nama);
                $('#dept').val(row.dept);$('#divisi').val(row.divisi);                 
                dlgemployee_close(); cari_nip();",
            "dlgColsData"=>array("nip","nama","dept","divisi")
        ));

        $this->template->display('payroll/overtime',$data,'');
		
	}
	function view($periode,$nip){        if (!allow_mod2('_12003')) exit;
        $user=$this->session->userdata('logged_in');
        
		$data['title']='DATA ABSENSI';
		$data['tanggal']= date("Y-m-d H:i:s");	
		$data['periode']=$periode;
		$data['periode_list']=$this->periode_model->dropdown();
        
		$data['nip']=$nip;
		$data['nama']="";
		$data['dept']='';
		$data['divisi']='';		
        if($data['nip']!=""){
            $ruser=$this->employee_model->get_by_id($data['nip'])->row();
            $data['dept']=$ruser->dept;
            $data['divisi']=$ruser->divisi;
			$data['nama']=$ruser->nama;
			$data['nip_id']=$ruser->nip_id;
			$data['gp']=$ruser->gp;
        }
        $data['flag1']=0;
        
        $data['lookup_employee']=$this->list_of_values->render(array(
            "dlgBindId"=>"employee",
            "dlgRetFunc"=>"$('#nip').val(row.nip);$('#nama').val(row.nama);
                $('#dept').val(row.dept);$('#divisi').val(row.divisi);                 
                dlgemployee_close(); cari_nip();",
            "dlgColsData"=>array("nip","nama","dept","divisi")
        ));

        $this->template->display('payroll/overtime',$data,'');
		
		
	}
	function index_date()
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
		$data=$this->input->get();
		$data['salary_no']=$this->paycheck_model->get_salary_no($data['nip'],$data['tanggal']); 
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
	function save_rows(){
		$ok=false;
		$msg="Data tidak bisa simpan baris-baris.";
		$nip=$this->input->post("nip");
		$period=$this->input->post("period");
		
		if($ids=$this->input->post('rows')){
			for($i=0;$i<count($ids);$i++){
				$id=$ids[$i];
				$data=null;
				if($q=$this->db->where("id",$id)->get("overtime_detail")){
					$data=$q->row_array();
				}
				if($data){
					unset($data['id']);
					$data['periode']=$period;
					$ok=$this->overtime_model->update($id,$data);
					
				}
			}
			$msg="Data sudah disimpan.";
			$ok=true;
		}
		echo json_encode(array("success"=>$ok,"msg"=>$msg));
	}
	
	function data($nip=""){
			if($nip2=$this->input->get("nip")){
				$nip=$nip2;
			}
		$period=$this->input->get("periode");
		$salary_no="";
		$s="select pay_no from hr_paycheck where employee_id='$nip' and  pay_period='$period' ";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$salary_no=$r->pay_no;
			}
		}
		
		$overtime_perjam=$this->overtime_model->get_ratio($nip,$salary_no);
//		if($q=$this->db->query("select gp,tjabatan from employee where nip='$nip'")){
//			if($r=$q->row()){
//				$overtime_perjam=($r->gp+$r->tjabatan)/173;
//			}
//		}
		
		
		$sql="select e.nip,e.nama,a.time_in,a.time_out,a.id,a.time_total,a.supervisor,a.keterangan,
			ttc_1x,ttc_2x,ttc_3x,ttc_4x,a.time_total_calc,a.salary_no,a.hari_libur,a.add_to_slip,
			a.tanggal,a.amount,($overtime_perjam*ttc_1x) as ttc1_amt,
			($overtime_perjam*ttc_2x) as ttc2_amt,($overtime_perjam*ttc_3x) as ttc3_amt,
			a.work_status,dayname(a.tanggal) as hari
		from employee e left join overtime_detail a 
		on a.nip=e.nip where 1=1 ";
		
		$periode="";
		
		if($tanggal=$this->input->get("tgl")){
			if($tanggal==""){
				$tahun=date("Y");	$bulan=date("m");	$hari=date("d");
			} else {
				$tahun=date("Y",strtotime($tanggal)); $bulan=date("m",strtotime($tanggal)); 
				$hari=date("d",strtotime($tanggal));  
			}
			$sql.=" and year(a.tanggal)=$tahun and month(a.tanggal)=$bulan and day(a.tanggal)=$hari";		
		} else {
			if($nip2=$this->input->get("nip")){
				$nip=$nip2;
			}
			
			if($periode2=$this->input->get("periode")){
				$periode=$periode2;
			}
			$prd=$this->periode_model->get_by_id($periode)->row();
			$sql.=" and a.tanggal between '$prd->from_date' and '$prd->to_date' ";
		}
        if($nip!="")$sql.=" and e.nip='$nip'";
        $sql.=" order by e.nip,a.tanggal";
        
		echo datasource($sql);
	}
	function get_id($id){
		$id=urldecode($id);
		$sql="select e.nip,e.nama,a.time_in,a.time_out,a.id,a.time_total,a.supervisor,a.keterangan,
			ttc_1x,ttc_2x,ttc_3x,ttc_4x,a.time_total_calc,a.salary_no,a.hari_libur,a.add_to_slip,e.dept,
			e.divisi,e.emptype,a.tanggal,a.work_status
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
	function delete_rows(){
		$ok=false;
		$msg="Data tidak bisa dihapus.";
		
		if($ids=$this->input->post('rows')){
			for($i=0;$i<count($ids);$i++){
				$id=$ids[$i];
				$sql="delete from overtime_detail where id='$id'";
				$this->db->query($sql);
			}
			$msg="Data sudah dihapus.";
			$ok=true;
		}
		echo json_encode(array("success"=>$ok,"msg"=>$msg));
	}
	function print_data(){
		$nip=$this->input->get("nip");
		$period=$this->input->get("period");
		$prd=$this->periode_model->get_by_id($period)->row();
		$data['date1']=$prd->from_date;
		$data['date2']=$prd->to_date;				
		$data['nip']=$nip;
		$data['period']=$period;
        $this->load->view('payroll/rpt/overtime',$data);                
				
	}
	
}
