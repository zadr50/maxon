<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Absensi extends CI_Controller {
    
    private $nip_data=null;
    private $salary_no="";
    private $nip="";
    private $pay_period="";
    
	function __construct()
	{
		parent::__construct();
                
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		if(!$this->access->is_login())redirect(base_url());
	 	$this->load->model("payroll/time_card_detail_model");
		$this->load->model('payroll/periode_model');
		$this->load->model('payroll/employee_model');
		$this->load->model('payroll/overtime_model');
        $this->load->model('payroll/paycheck_model');
		
		
	}
	function index()
	{
        if (!allow_mod2('_12002')) exit;
        
        $user=$this->session->userdata('logged_in');
        
		$data['title']='DATA ABSENSI';
		$data['tanggal']= date("Y-m-d H:i:s");	
		
		$data['periode']=date("Y-m");	///$this->periode_model->current_periode();
		$data['periode_list']=$this->periode_model->dropdown();
        
		$data['nip']=$user['nip'];
		$data['nama']=$user['username'];
		$data['dept']='';
		$data['divisi']='';		
		$data['nip_id']='';
        if($user['nip']!=""){
            $ruser=$this->employee_model->get_by_id($user['nip'])->row();
            $data['dept']=$ruser->dept;
            $data['divisi']=$ruser->divisi;
			$data['nip_id']=$ruser->nip_id;
        }
        $data['flag1']=$user['flag1'];
        
        $data['lookup_employee']=$this->list_of_values->render(array(
            "dlgBindId"=>"employee",
            "dlgRetFunc"=>"$('#nip').val(row.nip);$('#nama').val(row.nama);
                $('#dept').val(row.dept);
                $('#divisi').val(row.divisi);
                $('#nip_id').val(row.nip_id); 
                load_absen();",
            "dlgColsData"=>array("nip","nama","dept","divisi","nip_id","emptype")
        ));
        
        $this->template->display('payroll/absensi_data',$data,'');
	}
	function data(){
		$sql="select e.nip,e.nama,a.time_in,a.time_out,a.id,a.salary_no 
		from employee e left join time_card_detail a 
		on a.nip=e.nip and year(tanggal)=".date("Y")." and month(tanggal)=".date('m')." and day(tanggal)=".date('d');
		echo datasource($sql);
	}
	function view($periode,$nip){
        if (!allow_mod2('_12002')) exit;
        
		$data['title']='DATA ABSENSI';
		$data['tanggal']= date("Y-m-d H:i:s");	
		
		$data['periode']=$periode;
		$data['periode_list']=$this->periode_model->dropdown();
        
		$data['nip']=$nip;
		$data['dept']='';
		$data['divisi']='';		
		$data['nip_id']='';
		$data['flag1']=false;
        if($data['nip']!=""){
            $ruser=$this->employee_model->get_by_id($data['nip'])->row();
            $data['dept']=$ruser->dept;
            $data['divisi']=$ruser->divisi;
			$data['nip_id']=$ruser->nip_id;
			$data['nama']=$ruser->nama;
        }
        
        $data['lookup_employee']=$this->list_of_values->render(array(
            "dlgBindId"=>"employee",
            "dlgRetFunc"=>"$('#nip').val(row.nip);$('#nama').val(row.nama);
                $('#dept').val(row.dept);
                $('#divisi').val(row.divisi);
                $('#nip_id').val(row.nip_id); 
                load_absen();",
            "dlgColsData"=>array("nip","nama","dept","divisi","nip_id","emptype")
        ));
        
        $this->template->display('payroll/absensi_data',$data,'');
		
	}
	function data_nip($periode,$nip=''){
		 $nip=urldecode($nip);
		 $periode=urldecode($periode);
		
		$this->load->model('periode_model');
		$prd=$this->periode_model->get_by_id($periode)->row();
		$sql="select a.absen_type,e.nip,e.nama,e.dept,e.divisi,a.tanggal,e.nip,e.nama,a.time_in,
		a.time_out,a.id,a.ot_in,a.ot_out,a.salary_no,a.shift_code, dayname(a.tanggal) as hari,
		a.work_status 
		from employee e left join time_card_detail a 
		on a.nip=e.nip where a.tanggal between '"
			.$prd->from_date."' and '".$prd->to_date."'";
		if($nip<>"")$sql.=" and a.nip='".$nip."'";
		$sql.=" order by a.tanggal";
		
		//echo $sql;
		
		echo datasource($sql);
	}	
	function data_salary_no($salary_no,$nip=''){
		 $nip=urldecode($nip);
		 $salary_no=urldecode($salary_no);
		$sql="select a.absen_type,e.nip,e.nama,e.dept,e.divisi,a.tanggal,e.nip,e.nama,a.time_in,
		a.time_out,a.id,a.ot_in,a.ot_out,a.salary_no,a.work_status,a.shift_code,a.salary_no,
		dayname(a.tanggal) as hari 
		from employee e left join time_card_detail a 
		on a.nip=e.nip where a.salary_no = '$salary_no' ";
		if($nip<>"")$sql.=" and a.nip='".$nip."'";
		$sql.=" order by a.tanggal";
		
		echo datasource($sql);
	}	
		
	function delete_rows(){
		$ok=false;
		$msg="Data tidak bisa dihapus.";
		
		if($ids=$this->input->post('rows')){
			for($i=0;$i<count($ids);$i++){
				$id=$ids[$i];
				
				$sql="delete from time_card_detail where id='$id'";
				$this->db->query($sql);
			}
			$msg="Data sudah dihapus.";
			$ok=true;
		}
		echo json_encode(array("success"=>$ok,"msg"=>$msg));
	}
	function delete($id){
		if($ok=$this->db->where("id",$id)->delete("time_card_detail")){
			echo json_encode(array("success"=>true,"msg"=>"Data sudah dihapus."));
		} else {
			echo json_encode(array("success"=>false,"msg"=>mysql_error()));
		}		
	}
	function save_rows(){
		$ok=false;
		$msg="Data tidak bisa disimpan.";
		
		if($ids=$this->input->post('rows')){
			for($i=0;$i<count($ids);$i++){
				$id=$ids[$i];
				
				$sql="select * from time_card_detail where id='$id'";
				if($q=$this->db->query($sql)){
					if($data=$q->row()){
						$this->save_data((array)$data);
					}
				}
			}
			$msg="Data sudah disimpan.";
			$ok=true;
		}
		echo json_encode(array("success"=>$ok,"msg"=>$msg));
	}
	function save_data($vdata=null){
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

        $tanggal=$data['tanggal'];
        
        $nip=$data['nip'];
        $this->nip=$nip;
		
		$data['salary_no']=$this->paycheck_model->salary_no_from_date($tanggal,$nip);
        $this->salary_no=$data['salary_no'];
        $this->time_card_detail_model->pay_no=$this->salary_no;
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
			unset($data['id']);
			$ok=$this->time_card_detail_model->update($id,$data);				
			
		} else {
			$ok=$this->time_card_detail_model->save($data);			
		}
		return $ok;	
	}
 	function save($vdata=null){
 		$ok = $this->save_data($vdata);
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
        $nip_cari=$this->input->post("nip_cari");
		
        $filename=$_FILES["file_excel"]["tmp_name"];
        if($_FILES["file_excel"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            $i=0;
            $ok=false;
            $this->db->trans_begin();
            while (($emapData = fgetcsv($file, 10000, chr(9))) !== FALSE)
            {
                $nip=$emapData[$c_nip];     
				if($nip_cari!=""){
					if($nip_cari!=$nip){
						$nip="";
					}
				}  
                $time_in=$emapData[$c_time_in];
                if(! ($nip == null or $nip == "" or $nip == "NIP") ) {
                    $i++;
                    //$data["create_by"]=user_id();
                    $data["nip"]=$nip;
                    $data['tanggal']=date("Y-m-d",strtotime($emapData[$c_tanggal]));                    
					$data['salary_no']=$this->paycheck_model->get_salary_no($nip,$data['tanggal']);
					
                    if($c_time_in>0)$data["time_in"]=$emapData[$c_time_in];
                    if($c_time_out>0)$data["time_out"]=c_($emapData[$c_time_out]);
                    if($c_ot_in>0)$data["ot_in"]=c_($emapData[$c_ot_in]);
                    if($c_ot_out>0)$data["ot_out"]=c_($emapData[$c_ot_out]);
                    if($c_status>0)$data["absen_type"]=$emapData[$c_status];
					if($data['absen_type']=='ALPHA'){
						$data['absen_type']=1;
					} else if ( $data['absen_type']=='OFF') {
						$data['absen_type']=9;
					} else if ( $data['absen_type']=='DINAS') {
						$data['absen_type']=3;
					} else {
						$data['absen_type']=0;
						
					}
					
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
    function get_shift(){
        $retval=null;
        if($q=$this->db->order_by("time_in")->get("hr_shift")){
            foreach($q->result_array() as $row){
                $row['time_in']=str_replace(":", "", $row['time_in']);
                $row['time_out']=str_replace(":", "", $row['time_out']);
                $retval[]=$row;
            }
            
        }
        return $retval;
    }
    function get_nip($nip_id){
        if(!$this->nip_data){
            $s="select nip,nama,shift_group from employee where nip_id='$nip_id'";
            if($q=$this->db->query($s)){
                foreach($q->result() as $row){
                    $this->nip_id[$nip_id]=(array)$row;                    
                }
            }
        }
        if(!isset($this->nip_id[$nip_id])){
            $this->nip_id[$nip_id]['nip']='';
            $this->nip_id[$nip_id]['nama']='';
            $this->nip_id[$nip_id]['shift_group']='';
        } 
        return $this->nip_id[$nip_id];
        
    }
    function import_text_tab(){
        if (!$this->input->post()){
            $data['caption']="IMPORT DATA ABSENSI";
            $this->template->display("payroll/absensi_import_text_tab",$data);            
        } else  {
          
        $shift_data=$this->get_shift();
        if(count($shift_data)==0){
            echo "<br>Tabel shift tidak ada isinya !";
            return false;
        }
             
        $c_userid=$this->input_col("USERID");                 $c_checktime=$this->input_col("CHECKTIME");
        $c_checktype=$this->input_col("CHECKTYPE");         $c_verifycode=$this->input_col("VERIFYCODE");
        $c_sensorid=$this->input_col("SENSORID");             $c_logid=$this->input_col("LOGID");
        $c_workcode=$this->input_col("WorkCode");             
        $c_sn=$this->input_col("sn");             
        $c_userextfmt=$this->input_col("UserExtFmt");             
                
        $filename=$_FILES["file_txt"]["tmp_name"];
        if($_FILES["file_txt"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            $i=0;
            $ok=false;
            $this->db->trans_begin();
            while (($emapData = fgetcsv($file, 100000, chr(9))) !== FALSE)
            {
                //print_r($emapData[$c_kode]);
                //exit();
                $tgl=$emapData[$c_checktime];
                if($tgl!="CHECKTIME"){
                    $nip_data=$this->get_nip($emapData[$c_userid]);
                    $nip=$nip_data["nip"];
                    $nama=$nip_data["nama"];
                
                    $checktype=$emapData[$c_checktype];
                    if(! ($nip == null or $nip == "" or $nip == "NIP") ) {
                        $i++;
                        $data=null;
                        $month=substr($tgl,0,2);
                        $day=substr($tgl,3,2);
                        $year=substr($tgl,6,4);
                        if($year<2018){
                            echo "$i";
                        }
                        
                        $time = date('H:i', strtotime($tgl));
                        $tgl= date('Y-m-d', strtotime($tgl));
                        $tcid = "T$year$month$day$nip";
                        $s="select * from time_card_detail where nip='$nip' and tanggal='$tgl' ";
                        if($q=$this->db->query($s)){
                            $data['nip']=$nip;
                            $data['tanggal']=$tgl;
							$data['salary_no']=$this->paycheck_model->get_salary_no($nip,$tgl);
                            if($checktype=="I"){
                                $data['time_in']=$time;                                
                                $data['absen_type']=0;
                                $time_in=$time;
                                $time_out="";
                            } else {
                                $data['time_out']=$time;
                                $data['absen_type']=1;
                                $time_out=$time;
                            }
                            if($q->num_rows()==0){
                                
                                $ok=$this->time_card_detail_model->save($data);
                                echo "<br>Insert: Row $i : $nip - $nama, tgl: $tgl";
                                
                            } else {
                                $data_rec=(array)$q->row();
                                
                                $data_time_in=$data_rec['time_in'];
                                $data_time_out=$data_rec['time_out'];
                                $data_hour=$data_time_out-$data_time_in;
                                $data['time_hour']=$data_hour;
                                if($data_time_in!="" && $time_out!=""){
                                    //hitung overtime
                                    $time=str_replace(':','',$time);
                                   for($shift_idx=0;$shift_idx<count($shift_data);$shift_idx++){
                                       $shift_time_in=$shift_data[$shift_idx]['time_in'];
                                       $shift_time_out=$shift_data[$shift_idx]['time_out'];
                                       $normal_hour=$shift_data[$shift_idx]['time_count'];
                                       $time_rest=$shift_data[$shift_idx]['time_rest'];
                                       $shift_code=$shift_data[$shift_idx]['kode'];
                                       //$data['shift_code']="";
                                       //toleransi 15
                                           if($time_out=="17:45"){
                                               //echo 1;
                                           }
                                       if($time>strzero($shift_time_in-30,4) && $time<strzero($shift_time_out+60,4)){
                                           $data['shift_code']=$shift_code;
                                           $ok=$this->time_card_detail_model->update($data_rec['id'],$data); 
                                           
                                       }
                                                                              
                                       //if(strzero($time>$shift_time_in-15,4) && $time<strzero($shift_time_out+15,4)){
                                           $ot_hour=$data_hour-$normal_hour;
                                           if($ot_hour>30 && $data['ot_in']!=""){
                                               //apabila sisa ot >30
                                               $data['ot_in']=$shift_time_out;
                                               $data['ot_out']=$data_time_out;
                                               $data['time_out']=$data_time_in+$normal_hour;
                                               $data['ot_hour']=$ot_hour;
                                               $ok=$this->time_card_detail_model->update($data_rec['id'],$data); 
                                           }
                                           
                                           
                                       //}
                                       
                                   }
                                   $ok=$this->time_card_detail_model->update($data_rec['id'],$data); 
                                   echo "<br>Update: Row $i : $nip - $nama, tgl: $tgl";
                                }
                            }
                        }

                    }                    
                    
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

    }

    function import_dat(){
        if (!$this->input->post()){
            $data['caption']="IMPORT DATA ABSENSI";
            $this->template->display("payroll/absensi_import_dat",$data);            
        } else  {
          
        $shift_data=$this->get_shift();
        if(count($shift_data)==0){
//            echo "<br>Tabel shift tidak ada isinya !";
//            return false;
        }
             
        $c_userid=$this->input_col("USERID");                 $c_checktime=$this->input_col("CHECKTIME");
        $c_checktype=$this->input_col("CHECKTYPE");         $c_verifycode=$this->input_col("VERIFYCODE");
        $c_sensorid=$this->input_col("SENSORID");             $c_logid=$this->input_col("LOGID");
        $c_workcode=$this->input_col("WorkCode");             
        $c_sn=$this->input_col("sn");             
        $c_userextfmt=$this->input_col("UserExtFmt");             
                
        $filename=$_FILES["file_txt"]["tmp_name"];
        if($_FILES["file_txt"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            $i=0;
            $ok=true;
			
            //$this->db->trans_begin();
            while (($emapData = fgetcsv($file, 100000, chr(9))) !== FALSE)
            {
                $tgl=$emapData[$c_checktime];
            	$nipid=trim($emapData[$c_userid]);
                $nip_data=$this->get_nip($nipid);
                $nip=$nip_data["nip"];
                $nama=$nip_data["nama"];
				if($nipid==179){
					//echo 1;
				}
            
                $checktype=$emapData[$c_checktype];
                if(! ($nip == null or $nip == "" or $nip == "NIP") ) {
                    $i++;
                    $data=null;
                    $year=substr($tgl,0,4);
                    $month=substr($tgl,5,2);
                    $day=substr($tgl,8,2);                        
                    $time = date('H:i', strtotime($tgl));
                    $tgl= date('Y-m-d', strtotime($tgl));
					$hari= date('D', strtotime($tgl));
                    
                    $tcid = "T$year$month$day$nip";
                    $s="select * from time_card_detail where nip='$nip' and tanggal='$tgl' ";
                    
					
                    
                    if($q=$this->db->query($s)){
                        $data['nip']=$nip;
                        $data['tanggal']=$tgl;

                        if($q->num_rows()==0){
                            $data['time_in']=$time;                                
                            $data['absen_type']=0;
							if($hari=="Sun"){
								$data['absen_type']=9;
							}
                            $time_in=$time;
                            $time_out="";                                
                            $ok=$this->time_card_detail_model->save($data);
                            echo "<br>Insert: Row $i : $nip - $nama, tgl: $tgl";                            
                        } else {
                            $data_rec=(array)$q->row();
							$data=$data_rec;
							
	                        $data['nip']=$nip;
	                        $data['tanggal']=$tgl;
							if($time>$data['time_out']){							
								$data['time_out']=$time;
							}
							
							//cek lebih besar timein ? tukar
							if($data['time_in']>$data['time_out']){
								$time_in=$data['time_in'];
								$data['time_in']=$data['time_out'];
								$data['time_out']=$time_in;
							}
							//hitung berapa jam?
							$first  = new DateTime( $data['time_in'] );
							$second = new DateTime( $data['time_out'] );
					
							$diff = $first->diff( $second );
					
							$data['time_hour']=$diff->format( '%H.%I' ); // -> 00:25:25
														
 							$ot_in="";
							$ot_out=$data['time_out'];
                            if($data['time_in']!="" && $data['time_out']!="" && $data['time_hour']>4){                            	
								$normal_hour=8;
								$ot_in=$first->modify("+$normal_hour hours")->format('H:I');
								if(strlen($ot_in)<5)$ot_in=$ot_in."0";
								$shift_code="";
								$shift_time_out=$data['time_out'];
								$find_data_shift=$this->get_shift_data($data['time_in'],$ot_in,$shift_data);
								if($find_data_shift){
									$normal_hour=$find_data_shift['time_count'];
									$shift_code=$find_data_shift['kode'];
									$ot_in=$find_data_shift['time_out'];
								}
								if($shift_code==""){
									$shift_code=$nip_data['shift_group'];
								}
								if(!$find_data_shift){
									for($isf=0;$isf<count($shift_data);$isf++){
										if($shift_data[$isf]['kode']==$shift_code){
											$find_data_shift=$shift_data[$isf];
											$normal_hour=$find_data_shift['time_count'];
											$ot_in=$find_data_shift['time_out'];
											break;
										}
										
									}
								}
								$data['shift_code']=$shift_code;
								
//save data overtime
                                   //if(strzero($time>$shift_time_in-15,4) && $time<strzero($shift_time_out+15,4)){
                                       $ot_hour=$data['time_hour']-$normal_hour;
                                       if($ot_hour>0 && $ot_in!=""){
                                           //apabila sisa ot >30
                                           $data['ot_in']=$ot_in;
                                           $data['ot_out']=$ot_out; 
                                           //$data['time_out']=$data['time_in']+$normal_hour;
                                           $data['ot_hour']=$ot_hour;
										   if($data['ot_in']>$data['ot_out']){
										   		//gak mungkin ot in lebih besar otout
										   		$data['ot_in']="";
												$data['ot_out']="";
												$data['ot_hour']="";
										   }
                                       }
                                       
                                       
                                   //}
                            }
                           $ok=$this->time_card_detail_model->update($data_rec['id'],$data); 
                           echo "<br>Update: Row $i : $nip - $nama, tgl: $tgl";

                        }
                    }

                }                    
            }
            fclose($file);

			echo "<br>";

            if ($ok){
            	echo json_encode(array("success"=>true,'msg'=>'Success.'));
			} else {
				echo json_encode(array('success'=>false,'msg'=>'Some errors occured.'));
			}      
        }
        echo "<div class='alert alert-success'>FINISH.</div>";            
        }

    }
	function get_shift_data($time_in,$time_out,$shift_settting){
		$data_retval=null;
		$shift_data=$shift_settting;
		$toleransi=35;	//toleransi utk masuk dan keluar 30 menit
        $time_in=str_replace(':','',$time_in);
        $time_out=str_replace(':','',$time_out);
	
       for($shift_idx=0;$shift_idx<count($shift_data);$shift_idx++){
           $shift_time_in=$shift_data[$shift_idx]['time_in'];
           $shift_time_out=$shift_data[$shift_idx]['time_out'];
           $normal_hour=$shift_data[$shift_idx]['time_count'];
           $time_rest=$shift_data[$shift_idx]['time_rest'];
           $shift_code=$shift_data[$shift_idx]['kode'];
		   
			$sti  = new DateTime( $shift_time_in );
			$shift_time_in=$sti->modify("-$toleransi minutes")->format('HI0');
			$sto  = new DateTime( $shift_time_out );
			$shift_time_out=$sto->modify("+$toleransi minutes")->format('HI0');
		   
           if($time_in>$shift_time_in && $time_out<$shift_time_out){
           		$data_retval=$shift_data[$shift_idx];
			   break;
           }
       }
		return $data_retval;	
	}
}
