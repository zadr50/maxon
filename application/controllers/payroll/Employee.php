<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Employee extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='employee';
	private $sql="select * from employee ";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('payroll/employee_group_model');
		$this->load->model('department_model');
		$this->load->model('division_model');
		$this->load->model('payroll/employee_level_model');
		$this->load->model('payroll/employee_type_model');
		$this->load->model('payroll/ptkp_model');
		$this->load->model('payroll/employee_model');
        $this->load->model('company_model');

	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $setting['dlgBindId']="shipping_locations";
        $setting['dlgRetFunc']="$('#location').val(row.location_number);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"location_number","caption"=>"Outlet","width"=>"80px"),
                    array("fieldname"=>"attention_name","caption"=>"Keterangan","width"=>"200px")
                );          
        $data['lookup_outlet']=$this->list_of_values->render($setting);
        
        $data['mode']='';
        $data['message']='';
        return $data;
	}
	function index(){
        if (!allow_mod2('_12001')) exit;
	    $this->browse();
    }

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
		$data['_right_menu']="payroll/menu_payroll";
		$data['group_list']=$this->employee_group_model->lookup();
		$data['dept_list']=$this->department_model->lookup();
		$data['div_list']=$this->division_model->lookup();
		$data['level_list']=$this->employee_level_model->lookup();
		$data['type_list']=$this->employee_type_model->lookup();
		$data['status_list']=$this->ptkp_model->lookup();
				
        $this->template->display_form_input('payroll/employee',$data);
	}
	function save(){
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
		 	
			$data=$this->input->post();
			$id=$this->input->post("nip");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$ok=$this->employee_model->save($data);
			} else {
				$ok=$this->employee_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"nip"=>$id));} 
			else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
		 }  
		 else {echo json_encode(array("msg"=>"Error ".validation_errors()));}
	}
	function view($id,$message=null){

	 	 
		 $id=urldecode($id);
		 $model=$this->employee_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		$data['group_list']=$this->employee_group_model->lookup();
		$data['dept_list']=$this->department_model->lookup();
		$data['div_list']=$this->division_model->lookup();
		$data['level_list']=$this->employee_level_model->lookup();
		$data['type_list']=$this->employee_type_model->lookup();
		$data['status_list']=$this->ptkp_model->lookup();

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('payroll/employee',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('nip','Isi NIP Pegawai', 'required|trim');
		 $this->form_validation->set_rules('nama','Isi nama pegawai', 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')	{
        $data['caption']='DAFTAR MASTER PEGAWAI';
		$data['controller']='payroll/employee';		
		$data['fields_caption']=array('Kode','Nama Pegawai','Dept','Divisi','Jabatan',
			'Kelompok','Lokasi','Status','Id Mesin','Npwp','Bank','Rekening','L/P',
			'Tgl Masuk','Cuti','Telpon','Hp','Alamat','Agama');
		$data['fields']=array('nip','nama','dept','divisi','position',
			'emptype','location','status','nip_id','npwp','bank_name','account','kelamin',
			'hireddate','sisa_cuti','telpon','hp','alamat','agama');
		$data['field_key']='nip';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("NIP","sid");
		$faa[]=criteria("Nama","sid_nama");
        $faa[]=criteria("Kelompok","sid_emptype");
        $faa[]=criteria("Jabatan","sid_position");
        $faa[]=criteria("Lokasi","sid_location");
        $faa[]=criteria("Dept","sid_dept");
        $faa[]=criteria("Divisi","sid_div");
        
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        
		$sql="select * from employee where 1=1";
		$s=$this->input->get('sid');		
		if($s!=''){
			$sql.=" and nip='$s'";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and nama like '$s%'";
			$s=$this->input->get('sid_dept');if($s!='')$sql.=" and dept like '$s%'";
			$s=$this->input->get('sid_div');if($s!='')$sql.=" and divisi like '$s%'";
            $s=$this->input->get('sid_location');if($s!='')$sql.=" and location like '$s%'";
            $s=$this->input->get('sid_position');if($s!='')$sql.=" and position like '$s%'";
            $s=$this->input->get('sid_emptype');if($s!='')$sql.=" and emptype like '$s%'";
            		}			
        $search=$this->input->get("tb_search");
        if(!is_numeric($offset))$search=$offset;
        if($search!="")$sql.=" and (nip='$search' or nama like '%$search%')";
        
        $sql.=" order by nip";
        

        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	
	 	$this->employee_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select nama,nip,dept,divisi	from employee 
		where nama like '$search%')
		order by nama limit 100";
		echo datasource($sql);
	}
	function find($nip="",$period_id=""){
		$nip=urldecode($nip);
		$sql="select nama,nip,dept,divisi,emptype,nip_id,gp,tjabatan	from employee";
		if($nip!="")$sql.=" where nip='$nip'";
		$query=$this->db->query($sql);	
		$data=null;
		$ot1=0;
		$ot2=0;
		$ot_jumlah=0;
		$data['success']=false;
		if($query){
			$data=$query->row_array();
			if($data['gp']=="" || $data['gp']==0){
				$salary_no="";
				$s="select pay_no from hr_paycheck where employee_id='$nip' and pay_period='$period_id' ";
				if($q=$this->db->query($s)){
					if($r=$q->row()){
						$salary_no=$r->pay_no;
					}
				}
				$gp=0;	//gaji harian
				$s="select org_value from hr_paycheck_sal_comp where pay_no='$salary_no' 
					and  salary_com_code='GPHARI'";
				if($q=$this->db->query($s)){
					if($r=$q->row()){
						$gp=$r->org_value;
					}
				}
				$data['gp']=$gp;
			}
			$tul=round(($data['gp']+$data['tjabatan'])/173);
			$data["tarip_upah_lembur"]=$tul;
			$data["tarif"]=$tul;
			$data['success']=true;
			if($period_id!=""){
				$this->load->model('payroll/periode_model');
				$prd=$this->periode_model->get_by_id($period_id)->row();
				$s="select sum(ttc_1x*$tul) as ot1,
					sum((ttc_2x+ttc_3x+ttc_4x)*$tul) as ot2,sum(amount) as amt 
					from overtime_detail where nip='$nip' 
					and tanggal between '$prd->from_date' and '$prd->to_date' 
					";
				if($qot=$this->db->query($s)){
					if($r=$qot->row()){
						$ot1=$r->ot1;
						$ot2=$r->ot2;
						$ot_jumlah=$r->amt;
					}
				}	
					
			}
		}
		$data['lembur_jam1']=$ot1;
		$data['lembur_jam2']=$ot2;
		$data['lembur_jumlah']=$ot_jumlah;
		
		echo json_encode($data);
	}
	function find2($nip=""){
		$nip=urldecode($nip);
		$sql="select nama,nip,dept,divisi,emptype,nip_id,emptype	
		from employee";
		if($nip!="")$sql.=" where nip='$nip'";
		echo datasource($sql);
	}	
	function level(){
		$data['caption']="LEVEL PEGAWAI";		
		$this->template->display("payroll/level",$data);
	}
   function level_add(){
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$ok=$this->employee_level_model->save($data);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function level_delete($kode){
		$kode=urldecode($kode);
   		$kode=htmlspecialchars_decode($kode);
		$ok=$this->employee_level_model->delete($kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
	function jenis(){
		$data['caption']="JENIS PEGAWAI";		
		$this->template->display("payroll/type",$data);
	}
   function jenis_add(){
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$ok=$this->employee_type_model->save($data);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function jenis_delete($kode){
		$kode=urldecode($kode);
		$ok=$this->employee_type_model->delete($kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
	function experience($cmd,$id=''){
		$id=urldecode($id);
		if($cmd=="save"){
			 
			$data=$this->input->post();
			if(isset($data['startdate']))$data['startdate']= date('Y-m-d H:i:s', strtotime($data['startdate']));
			if(isset($data['finishdate']))$data['finishdate']= date('Y-m-d H:i:s', strtotime($data['finishdate']));
			 
			
			if($data['id']=="" or $data['id']=="0") {
				unset($data['id']);
				$ok=$this->db->insert("employeeexperience",$data);
			} else {
				$id=$data['id'];
				$this->db->where("id",$id);
				$ok=$this->db->update("employeeexperience",$data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
		if($cmd=="load") {
			$sql="select * from employeeexperience where employeeid='$id'";
			echo datasource($sql);
		}
		if($cmd=="delete") {
			$this->db->where("id",$id);
			$ok=$this->db->delete("employeeexperience");
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
	}
	function education($cmd,$id=''){
		$id=urldecode($id);
		if($cmd=="save"){
			 
			$data=$this->input->post();
			if($data['id']=="" or $data['id']=="0") {
				unset($data['id']);
				$ok=$this->db->insert("employeeeducations",$data);
			} else {
				$id=$data['id'];
				$this->db->where("id",$id);
				$ok=$this->db->update("employeeeducations",$data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));}   	
		}
		if($cmd=="load") {
			$sql="select * from employeeeducations where employeeid='$id'";
			echo datasource($sql);
		}
		if($cmd=="delete") {
			$this->db->where("id",$id);
			$ok=$this->db->delete("employeeeducations");
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
	}	
	function family($cmd,$id=''){
		$id=urldecode($id);
		if($cmd=="save"){
			 
			$data=$this->input->post();
			if($data['id']=="" or $data['id']=="0") {
				unset($data['id']);
				$ok=$this->db->insert("employeefamily",$data);
			} else {
				$id=$data['id'];
				$this->db->where("id",$id);
				$ok=$this->db->update("employeefamily",$data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));}   	
		}
		if($cmd=="load") {
			$sql="select * from employeefamily where employeeid='$id'";
			echo datasource($sql);
		}
		if($cmd=="delete") {
			$this->db->where("id",$id);
			$ok=$this->db->delete("employeeefamily");
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
	}	
	function medical($cmd,$id=''){
		$id=urldecode($id);
		$table_name="employeemedical";
		if($cmd=="save"){
			 
			$data=$this->input->post();
			if($data['id']=="" or $data['id']=="0") {
				unset($data['id']);
				$ok=$this->db->insert($table_name,$data);
			} else {
				$id=$data['id'];
				$this->db->where("id",$id);
				$ok=$this->db->update($table_name,$data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));}   	
		}
		if($cmd=="load") {
			$sql="select * from $table_name where employeeid='$id'";
			echo datasource($sql);
		}
		if($cmd=="delete") {
			$this->db->where("id",$id);
			$ok=$this->db->delete($table_name);
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
	}	
	function reward($cmd,$id=''){
		$id=urldecode($id);
		$table_name="employeerewardpunish";
		if($cmd=="save"){
			 
			$data=$this->input->post();
			if($data['id']=="" or $data['id']=="0") {
				unset($data['id']);
				$ok=$this->db->insert($table_name,$data);
			} else {
				$id=$data['id'];
				$this->db->where("id",$id);
				$ok=$this->db->update($table_name,$data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));}   	
		}
		if($cmd=="load") {
			$sql="select * from $table_name where employeeid='$id'";
			echo datasource($sql);
		}
		if($cmd=="delete") {
			$this->db->where("id",$id);
			$ok=$this->db->delete($table_name);
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
	}	
		
	function license($cmd,$id=''){
		$id=urldecode($id);
		$table_name="employeelicense";
		if($cmd=="save"){
			 
			$data=$this->input->post();
			if($data['id']=="" or $data['id']=="0") {
				unset($data['id']);
				$ok=$this->db->insert($table_name,$data);
			} else {
				$id=$data['id'];
				$this->db->where("id",$id);
				$ok=$this->db->update($table_name,$data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));}   	
		}
		if($cmd=="load") {
			$sql="select * from $table_name where employeeid='$id'";
			echo datasource($sql);
		}
		if($cmd=="delete") {
			$this->db->where("id",$id);
			$ok=$this->db->delete($table_name);
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
	}
	
	function training($cmd,$id=''){
		$id=urldecode($id);
		$table_name="employeetraining";
		if($cmd=="save"){
			 
			$data=$this->input->post();
			if($data['id']=="" or $data['id']=="0") {
				unset($data['id']);
				$ok=$this->db->insert($table_name,$data);
			} else {
				$id=$data['id'];
				$this->db->where("id",$id);
				$ok=$this->db->update($table_name,$data);
			}
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));}   	
		}
		if($cmd=="load") {
			$sql="select * from $table_name where employeeid='$id'";
			echo datasource($sql);
		}
		if($cmd=="delete") {
			$this->db->where("id",$id);
			$ok=$this->db->delete($table_name);
			if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
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
        $c_nip=$this->input_col("NIP");                 $c_nama=$this->input_col("NAMA");
        $c_gaji_bruto=$this->input_col("GAJI_BRUTO");   $c_t_tetap=$this->input_col("T_TETAP");
        $c_t_makan=$this->input_col("T_MAKAN");         $c_t_jabatan=$this->input_col("T_JABATAN");
        $c_level=$this->input_col("LEVEL");             $c_company=$this->input_col("COMPANY");
        $c_dept=$this->input_col("DEPT");               $c_divisi=$this->input_col("DIVISI");
        $c_hired=$this->input_col("HIRED");             $c_kelamin=$this->input_col("KELAMIN");
        $c_agama=$this->input_col("AGAMA");             $c_emp_type=$this->input_col("EMP_TYPE");
        $c_emp_status=$this->input_col("EMP_STATUS");           $c_nip_id=$this->input_col("NIP_ID");
        $c_tempat_lahir=$this->input_col("TEMPAT_LAHIR");       $c_tanggal_lahir=$this->input_col("TANGGAL_LAHIR");
        $c_alamat=$this->input_col("ALAMAT");                   $c_pendidikan=$this->input_col("PENDIDIKAN");
        $c_masa_kerja=$this->input_col("MASA_KERJA");           $c_gol_darah=$this->input_col("GOL_DARAH");
        $c_bank=$this->input_col("BANK");                       $c_rek_bank=$this->input_col("REK_BANK");
        $c_npwp=$this->input_col("NPWP");        
        
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
                $nip=$emapData[$c_nip];
                if(! ($nip == null or $nip == "" or $nip == "NIP" ) ) {
                    $i++;
                    //$data["create_by"]=user_id();
                    $data["nip"]=$nip;
                    if($c_nama>0)$data["nama"]=$emapData[$c_nama];
                    if($c_gaji_bruto>0)$data["gp"]=c_($emapData[$c_gaji_bruto]);
                    ///if($c_t_tetap>0)$data["tjabatan"]=$emapData[$c_t_tetap];
                    if($c_t_makan>0)$data["tmakan"]=c_($emapData[$c_t_makan]);
                    if($c_t_jabatan>0)$data["tjabatan"]=c_($emapData[$c_t_jabatan]);
                    if($c_level>0)$data["level"]=$emapData[$c_level];
                    //if($c_company>0)$data["category"]=$emapData[$c_company];
                    if($c_dept>0)$data["dept"]=$emapData[$c_dept];
                    if($c_divisi>0)$data["divisi"]=$emapData[$c_divisi];
                    if($c_hired>0)$data["hireddate"]=$emapData[$c_hired];
                    if($c_kelamin>0)$data["kelamin"]=$emapData[$c_kelamin];
                    if($c_agama>0)$data["agama"]=$emapData[$c_agama];
                    if($c_emp_type>0)$data["emptype"]=$emapData[$c_emp_type];
                    if($c_emp_status>0)$data["status"]=$emapData[$c_emp_status];
                    if($c_nip_id>0)$data["nip_id"]=$emapData[$c_nip_id];
                    if($c_tempat_lahir>0)$data["tempat_lahir"]=$emapData[$c_tempat_lahir];
                    if($c_tanggal_lahir>0)$data["tgllahir"]=$emapData[$c_tanggal_lahir];
                    if($c_alamat>0)$data["alamat"]=$emapData[$c_alamat];
                    if($c_pendidikan>0)$data["pendidikan"]=$emapData[$c_pendidikan];
                    //if($c_masa_kerja>0)$data["division"]=$emapData[$c_masa_kerja];
                    if($c_gol_darah>0)$data["gol_darah"]=$emapData[$c_gol_darah];
                    if($c_bank>0)$data["bank_name"]=$emapData[$c_bank];
                    if($c_rek_bank>0)$data["account"]=$emapData[$c_rek_bank];
                    if($c_npwp>0)$data["npwp"]=$emapData[$c_npwp];
                                                            
                    
                    if($this->employee_model->exist($nip)){
                        unset($data['nip']);
                        $ok=$this->employee_model->update($nip,$data)==1;
                        echo "Update: Row $i : ".$nip." - ".$emapData[$c_nama]."</br>";
                    } else {
                        $ok=$this->employee_model->save($data)==1;
                        echo "Insert: Row $i : ".$nip." - ".$emapData[$c_nama]."</br>";
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
    function import(){
        $data['caption']="IMPORT DATA MASTER";
        $this->template->display("payroll/employee_import",$data);
    }
}
