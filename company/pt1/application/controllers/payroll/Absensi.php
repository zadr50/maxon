<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Absensi extends CI_Controller {
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
        
        
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		if(!$this->access->is_login())redirect(base_url());
	 	$this->load->model("payroll/time_card_detail_model");
		$this->load->model('payroll/periode_model');
		$this->load->model('payroll/employee_model');
		$this->load->model('payroll/overtime_model');
		
	}
	function index()
	{
        if (!allow_mod2('_12002')) exit;
        
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
        $this->template->display('payroll/absensi_data',$data,'');
	}
	function data(){
		$sql="select e.nip,e.nama,a.time_in,a.time_out,a.id 
		from employee e left join time_card_detail a 
		on a.nip=e.nip and year(tanggal)=".date("Y")." and month(tanggal)=".date('m')." and day(tanggal)=".date('d');
		echo datasource($sql);
	}
	function data_nip($periode,$nip=''){
		 $nip=urldecode($nip);
		 $periode=urldecode($periode);
		
		$this->load->model('periode_model');
		$periode=$this->periode_model->get_by_id($periode)->row();
		$sql="select a.absen_type,e.nip,e.nama,e.dept,e.divisi,a.tanggal,e.nip,e.nama,a.time_in,
		a.time_out,a.id,a.ot_in,a.ot_out 
		from employee e left join time_card_detail a 
		on a.nip=e.nip where a.tanggal between '"
			.$periode->from_date."' and '".$periode->to_date."'";
		if($nip<>"")$sql.=" and a.nip='".$nip."'";
		$sql.=" order by a.tanggal";
		
		echo datasource($sql);
	}	
	
	function delete($id){
		if($ok=$this->db->where("id",$id)->delete("time_card_detail")){
			echo json_encode(array("success"=>true,"msg"=>"Data sudah dihapus."));
		} else {
			echo json_encode(array("success"=>false,"msg"=>mysql_error()));
		}		
	}
 	function save($vdata=null){
		if($vdata){
			$data=$vdata;
		} else {
			if($this->input->post()){
				$data=$this->input->post();
			} else {
				$data=$this->input->get();
			}
		}
		$id="";
		if(isset($data['id']))$id=$data['id'];
		$data['salary_no']=0;
		$nip=$data['nip'];
		$tanggal=$data['tanggal'];
		$jenis="";
		if(isset($data['jenis'])){
				$jenis=$data['jenis'];
				unset($data['jenis']);
		}
		$sql="select time_in,time_out,id from time_card_detail 
		where nip='$nip' ";
		if($id==""){
			$sql=$sql." and year(tanggal)=".date("Y",strtotime($tanggal))
			." and month(tanggal)=".date('m',strtotime($tanggal))
			." and day(tanggal)=".date('d',strtotime($tanggal));
		} else {
			$sql=$sql." and id=".$id;
		}
		$query=$this->db->query($sql);
		if($query->num_rows()>0) {
			$id=$data['id'];
			if($id==""){
				$row=$query->row();
				$id=$row->id;
			}
			//unset($data['tanggal']);
			//unset($data['time_in']);
			unset($data['id']);
			$ok=$this->time_card_detail_model->update($id,$data);				
			
		} else {
			$ok=$this->time_card_detail_model->save($data);			
		}
		if($data["ot_in"] != "" && $data["ot_out"] != ""){
			if($rid=$this->overtime_model->get_by_tcid($id)){
				$dataot["tanggal"]=$data["tanggal"];
				$dataot["nip"]=$data["nip"];
				$dataot["time_in"]=$data["ot_in"];
				$dataot["time_out"]=$data["ot_out"];
				$dataot["tcid"]=$id;
				if($ridd=$rid->row()){
					$this->overtime_model->update($ridd->id,$dataot);
				} else {
					$this->overtime_model->save($dataot);
				}			
			}
		}
		if($ok){echo json_encode(array("success"=>true));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function detail($nip=''){
		 $nip=urldecode($nip);
		$data['nip']=$nip;
		$data['periode']=date("Y-m");	///$this->periode_model->current_periode();
		$data['periode_list']=$this->periode_model->dropdown();

		$data['nama']='Not Found !';
		$data['dept']='';
		$data['divisi']='';

		$q=$this->employee_model->get_by_id($nip);
		if($q){
			if($emp=$q->row()){
				$data['nama']=$emp->nama;
				$data['dept']=$emp->dept;
				$data['divisi']=$emp->divisi;		
			}
		}
		$this->template->display('payroll/absensi_data',$data);
	}
	function import_from_user_login($date_from,$date_to){
		$s="select * from syslog where jenis in ('LOGIN','LOGOUT') 
			and tgljam between '".date("Y-m-d",strtotime($date_from))."' 
				and '".date("Y-m-d",strtotime($date_to))." 23:59:59' 
				and userid is not null
				order by userid,tgljam";
		if($query=$this->db->query($s)) { 
			foreach($query->result() as $row){
				$nip="";
				$data=null;
				if($quser=$this->db->query("select nip from `user` 
					where user_id='".$row->userid."'")){
					if($ruser=$quser->row()){
						$nip=$ruser->nip;
						if($nip==null)$nip="";
					}
				}
				if($nip==null)$nip="";
				if($nip=="")$nip=$row->userid;
				if($nip<>""){
					$data['time_in']=date("H:i",strtotime($row->tgljam));
					$data['time_out']=date("H:i",strtotime($row->tgljam));
					$data['nip']=$nip;
					$data['tanggal']=date("Y-m-d",strtotime($row->tgljam));
					$data['jenis']=$row->jenis;
					$this->save($data);
				}
			}
		}
	}
	function convert_login_absen(){
		if($this->input->post('date_from')){
			$data=$this->input->post();
			$d1=date("Y-m-d H:i:s",strtotime($data['date_from']));
			$d2=date("Y-m-d H:i:s",strtotime($data['date_to'])); 
			//hapus dulu data absensi lama
			$s="delete from time_card_detail where tanggal between '$d1' and '$d2' ";
			//$this->db->query($s);

			$this->import_from_user_login($d1,$d2);
				$data['message']="Data absensi sudah dibuatkan berdasarkan periode tanggal tersebut.";
				$sql="select nip,tanggal,time_in,time_out  
					from time_card_detail where tanggal between '$d1' and '$d2' 
					order by nip,tanggal,time_in";
				// save session untuk export ke excel
				$this->session->set_userdata("date_from",$d1);
				$this->session->set_userdata("date_to",$d2);
				
				if($query=$this->db->query($sql)){
					$data['absen_list']=$query;
				}
		} else {
			$data['date_from']=date("m/d/Y");
			$data['date_to']=date("m/d/Y");		
		}
		$this->template->display("payroll/absensi_import_login",$data);
	}
	function export_xls(){
		$d1=$this->session->userdata("date_from");
		$d2=$this->session->userdata("date_to");
		$sql="select nip,tanggal,time_in,time_out  
					from time_card_detail where tanggal between '$d1' and '$d2' 
					order by nip,tanggal,time_in";
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=hasil-export.xls");
		echo html_table($sql,false);
	}
	function generate_proses($data){
		$periode=$data['periode'];
		$dept=$data['dept'];
		$divisi=$data['divisi'];
		$nip=$data['nip'];
		$rperiode=$this->periode_model->get_by_id($periode)->row();
		if(!$rperiode){
			echo "Periode tidak ditemukan !";
			return false;
		}
		$this->db->select("nip,nama,dept,divisi");
		if($dept<>"")$this->db->where("dept",$dept);
		if($divisi<>"")$this->db->where("divisi",$divisi);
		if($nip<>"")$this->db->where("nip",$nip);
		if($remp=$this->db->get("employee")){
			foreach($remp->result() as $emp){
				echo "Generate absensi untuk [".$emp->nama." - $emp->nip ]...</br>";
				$from_date=new DateTime($rperiode->from_date);
				$day_count=$from_date->diff(new DateTime($rperiode->to_date))->days;
				$first_date=new DateTime($rperiode->from_date);
				$time_in=new DateTime("08:00");
				$time_out="17:00";
				for($i=0;$i<$day_count;$i++){
					$d["salary_no"]=0;
					$d["nip"]=$emp->nip;
					$d["tanggal"]=$first_date->format('Y-m-d');
					$d["absen_type"]="NORMAL";
					$d["shift_code"]="GS";
					$d["work_status"]="";
					$time_hour = $time_in->diff(new DateTime($time_out));
					$d["time_in"]=$time_in->format('H:i:s');
					$d["time_out"]=Date("H:i:s",strtotime($time_out));
					$d["time_hour"]=$time_hour->h;
					 
					$this->db->where("nip",$emp->nip)->where("tanggal",$d["tanggal"]);
					if( !$rabsen=$this->db->get("time_card_detail")->row()){
						$this->db->insert("time_card_detail",$d);						
					} else {
						//var_dump($rabsen);
					}
					$first_date=date_add(new DateTime($d["tanggal"]),new DateInterval('P1D'));
				}
				
			}			
		}
	}
	function generate(){
		if($data=$this->input->post()){
			$this->generate_proses($data);	
			echo "</br>Finish.";
		} else {
			$this->load->model('department_model');
			$this->load->model('division_model');
			$this->load->library('list_of_values');
			$data['periode']=date("Y-m");	///$this->periode_model->current_periode();
			$data['periode_list']=$this->periode_model->dropdown();
			$data['dept_list']=$this->department_model->lookup();
			$data['divisi_list']=$this->division_model->lookup();
			$data['dept']='';
			$data['divisi']='';
			$data['nip']='';
			$data['nama']='';
			 $data['lookup_employee']=$this->list_of_values->render(array(
					"dlgBindId"=>"nip","dlgId"=>"LovNip",
					"dlgUrlQuery"=>base_url()."index.php/payroll/employee/browse_data/",
					"dlgCols"=>array(
						array("fieldname"=>"nip","caption"=>"NIP","width"=>"80px"),
						array("fieldname"=>"nama","caption"=>"Nama","width"=>"200px")
					),
					"dlgRetFunc"=>"$('#nip').val(row.nip);$('#nama').val(row.nama);"
				));
			
			$this->template->display("payroll/absensi_generate",$data);
		}
	} 
    function input_col($colname){
        $c=0;
        if($this->input->post($colname)!=""){
            $c=65-ord(strtoupper($this->input->post($colname)));
        }
        return abs($c);
    }
    function import_excel(){
        $c_nip=$this->input_col("nip");                 $c_tanggal=$this->input_col("tanggal");
        $c_time_in=$this->input_col("time_in");         $c_time_out=$this->input_col("time_out");
        $c_ot_in=$this->input_col("ot_in");             $c_ot_out=$this->input_col("ot_out");
        $c_status=$this->input_col("status");             
        
        $filename=$_FILES["file_excel"]["tmp_name"];
        if($_FILES["file_excel"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            $i=0;
            $ok=false;
            $this->db->trans_begin();
            while (($emapData = fgetcsv($file, 10000, chr(9))) !== FALSE)
            {
                //print_r($emapData[$c_kode]);
                //exit();
                $nip=$emapData[$c_nip];     $time_in=$emapData[$c_time_in];
                if(! ($nip == null or $nip == "" or $nip == "NIP") ) {
                    $i++;
                    //$data["create_by"]=user_id();
                    $data["nip"]=$nip;
                    $data['tanggal']=$emapData[$c_tanggal];
                    
                    if($c_time_in>0)$data["time_in"]=$emapData[$c_time_in];
                    if($c_time_out>0)$data["time_out"]=c_($emapData[$c_time_out]);
                    if($c_ot_in>0)$data["ot_in"]=c_($emapData[$c_ot_in]);
                    if($c_ot_out>0)$data["ot_out"]=c_($emapData[$c_ot_out]);
                    //if($c_status>0)$data["status"]=$emapData[$c_status];
                    $ok=$this->time_card_detail_model->save($data)==1;
                    echo "Insert: Row $i : ".$nip." - ".$emapData[$c_tanggal]."</br>";
                    
                }
            }
            if ($this->db->trans_status() === FALSE)
            {
                echo "Error: Row $i : ".$nip." : ".$this->db->display_error()."</br>";
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }           
            fclose($file);
            if ($ok){echo json_encode(array("success"=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}      
        }
        echo "<div class='alert alert-success'>FINISH.</div>";
    }
    function import(){
        $data['caption']="IMPORT DATA ABSENSI";
        $this->template->display("payroll/absensi_import",$data);
    }

}
