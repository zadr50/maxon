<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Scoring extends CI_Controller {
    private $limit=100;
    private $table_name='ls_app_scoring';
    private $file_view='leasing/scoring';
    private $controller='leasing/scoring';
    private $primary_key='id';
	private $title="DAFTAR SCORING APLIKASI";
    private $sql="";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->sql=="")$this->sql="select * from ls_app_verify";
		if($this->help=="")$this->help=$this->table_name;
		$this->load->model("leasing/scoring_model");
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index(){
		$this->add();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$data['message']='';
		$data['data']=$data;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$this->load->model("leasing/app_master_model");
		$data['not_scored']=$this->app_master_model->not_scored();		
		$this->template->display_form_input($this->file_view,$data);			
    }
	function save(){
		$data=$this->input->post();		
		
		$id=$this->input->post("id");
		if($id==""){ 
			$ok=$this->scoring_model->save($data);
		} else {
			$ok=$this->scoring_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}	
    function view($id,$message=null)	{
		$id=urldecode($id);
		$message=urldecode($message);
		$data[$this->primary_key]=$id;
		$model=$this->scoring_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['message']=$message;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$this->template->display_form_input($this->file_view,$data);
    }
     // validation rules
    function _set_rules(){}
    function valid_date($str){
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str)){
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nomor Aplikasi","sid_no","","style='width:400px'");
		$faa[]=criteria("Nama Debitur","sid_nama","","style='width:400px'");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Nama Debitur','Nomor Aplikasi','Tanggal','Sales Agent','Id');
		$data['fields']=array('cust_name','app_id','app_ver_date','sales_agent','id');
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get("sid_no"))$sql .= " and cust_no='".$this->input->get("sid_no")."'";
		if($this->input->get("sid_nama"))$sql .= " and cust_name like '%".$this->input->get("sid_nama")."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->scoring_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function filter($id=""){
		$sql="select * from ".$this->table_name;
		if($id!=""){
			$sql.=" where cust_name like '%".$id."%'";
		}
		echo datasource($sql);	
	}
	function step1($app_id,$load_default_view=true){
		$data['app_id']=$app_id;
		if($q=$this->db->where("app_id",$app_id)->get("ls_app_master")){
			$app=$q->row();
			$cust_id=$app->cust_id;
		}
		if($q=$this->db->where("cust_id",$cust_id)->get("ls_cust_master")){
			$cust=$q->row();
		}
		if($q=$this->db->where("cust_id",$cust_id)->get("ls_cust_personal")){
			$personal=$q->row();
		}
		if($q=$this->db->where("cust_id",$cust_id)->get("ls_cust_company")){
			$com=$q->row();
		}
		if($q=$this->db->where("cust_id",$cust_id)
			->get("ls_cust_company")){
			$com=$q->row();
		}
		$fam_first_name="";$fam_relation="";$fam_street="";
		$fam_kel="";$fam_kec="";$fam_city="";$fam_zip_pos="";
		$fam_phone="";
		$data['catatan']='';
		if($q=$this->db->where("cust_id",$cust_id)
			->where("ship_to_type","family")
			->get("ls_cust_ship_to")){
			if($fam=$q->row()){
				$fam_first_name=$fam->first_name;
				$fam_relation=$fam->relation;
				$fam_street=$fam->street;
				$fam_kel=$fam->kel;
				$fam_kec=$fam->kec;
				$fam_city=$fam->city;
				$fam_zip_pos=$fam->zip_pos;
				$fam_phone=$fam->phone;
			
			}
		}
		$data['sa_v2_place_birth']=$personal->birth_place;
		$data['sa_v2_date_birth']=$personal->birth_date;
		$data['sa_v2_cust_name']=$cust->cust_name;
		$data['sa_v2_mother_name']=$cust->mother_name;
		$data['sa_v1_fam_name']=$fam_first_name;
		$data['sa_v1_fam_relation']=$fam_relation;
		$data['sa_v1_fam_street']=$fam_street;
		$data['sa_v1_fam_kel']=$fam_kel;
		$data['sa_v1_fam_kec']=$fam_kec;
		$data['sa_v1_fam_kota']=$fam_city;
		$data['sa_v1_fam_pos']=$fam_zip_pos;
		$data['sa_v1_fam_phone']=$fam_phone;
		$data['sa_v1_cust_name']=$cust->first_name;
		$data['sa_v1_mother_name']=$cust->mother_name;
		$data['sa_v1_street']=$cust->street;
		$data['sa_v1_rtrw']=$cust->rtrw;
		$data['sa_v1_kel']=$cust->kel;
		$data['sa_v1_kec']=$cust->kec;
		$data['sa_v1_kota']=$cust->city;
		$data['sa_v1_pos']=$cust->zip_pos;
		$data['sa_v1_phone']=$cust->phone;
		$data['sa_v1_hp']=$cust->hp;
		$house_status=array('Sendiri','Dinas','Orang Tua','Saudara/Kerabat','Kontrak/Kos');
		$data['sa_v1_house_status']=$house_status[$personal->house_status];
		$data['sa_v3_com_name']=$com->comp_name;
		$data['sa_v3_street']=$com->street;
		$data['sa_v3_bidang']=$com->bussiness_type;
		$emp_status=array('Tetap','Kontrak','Wirausaha','Lainnya');
		$data['sa_v3_emp_status']=$emp_status[$com->emp_status];
		$data['sa_v3_jabatan']=$com->job_level;
		$office_status=array('Sendiri','Perusahaan','Keluarga','Lainnya');
		$data['sa_v3_com_status']=$office_status[$com->office_status];
		$data['sa_v3_year']=$com->since_year;
		$data['sa_v3_salary']=number_format($personal->salary);
		$data['sa_v3_supervisor']=$com->spv_name;
		$data['sa_v3_hrd']=$com->hrd_name;
		$data['sa_v1_lama_tahun']=$cust->lama_thn;
		
		if($q=$this->db->where("app_id",$app_id)
			->get("ls_app_verify")){
			$ver=$q->row();
			$data['pv_v2_cust_name']=$ver->v2_cust_name;
			$data['pv_v2_place_birth']=$ver->v2_place_birth;
			$data['pv_v2_date_birth']=$ver->v2_date_birth;
			$data['pv_v2_place_birth']=$ver->v2_place_birth;
			$data['pv_v2_date_birth']=$ver->v2_date_birth;
			$data['pv_v1_cust_name']=$ver->v1_cust_name;
			$data['pv_v2_mother_name']=$ver->v2_mother_name;
			$data['pv_v1_fam_name']=$ver->v1_fam_name;
			$data['pv_v1_fam_relation']=$ver->v1_fam_relation;
			$data['pv_v1_fam_street']=$ver->v1_fam_street;
			$data['pv_v1_fam_kel']=$ver->v1_fam_kel;
			$data['pv_v1_fam_kec']=$ver->v1_fam_kec;
			$data['pv_v1_fam_kota']=$ver->v1_fam_kota;
			$data['pv_v1_fam_pos']=$ver->v1_fam_pos;
			$data['pv_v1_fam_phone']=$ver->v1_fam_phone;
			$data['pv_v1_cust_name']=$ver->v1_cust_name;
			$data['pv_v1_mother_name']=$ver->v1_mother_name;
			$data['pv_v1_street']=$ver->v1_street;
			$data['pv_v1_rtrw']=$ver->v1_rtrw;
			$data['pv_v1_kel']=$ver->v1_kel;
			$data['pv_v1_kec']=$ver->v1_kec;
			$data['pv_v1_kota']=$ver->v1_kota;
			$data['pv_v1_pos']=$ver->v1_pos;
			$data['pv_v1_phone']=$ver->v1_phone;
			$data['pv_v1_hp']=$ver->v1_hp;
			$data['pv_v1_house_status']=$ver->v1_house_status;
			$data['pv_v3_com_name']=$ver->v3_com_name;
			$data['pv_v3_street']=$ver->v3_street;
			$data['pv_v3_bidang']=$ver->v3_bidang;
			$data['pv_v3_emp_status']=$ver->v3_emp_status;
			$data['pv_v3_jabatan']=$ver->v3_jabatan;
			$data['pv_v3_com_status']=$ver->v3_com_status;
			$data['pv_v3_year']=$ver->v3_year;
			$data['pv_v3_salary']=number_format($ver->v3_salary);
			$data['pv_v3_supervisor']=$ver->v3_supervisor;
			$data['pv_v3_hrd']=$ver->v3_hrd;
			$data['pv_v1_lama_tahun']=$ver->v1_lama_tahun;	
		}
		if($load_default_view) {
			$this->load->view("leasing/score_form",$data);
		} else {
			return $data;
		}
	}
	function recomend(){
		$this->load->model("leasing/app_master_model");
		$data['score_result']=$this->app_master_model->list_scored_result();
		$this->template->display("leasing/scoring_result",$data);
	}
	function recomend_save(){
		// boleh disurvey karena hasil score bagus
		$data_spk=$this->input->post("pilih");
		$catatan=$this->input->post('catatan');
		for($i=0;$i<count($data_spk);$i++){
			$from=user_id();
			$app_id=$data_spk[$i];
			$app=$this->db->select("create_by,cust_id")->where("app_id",$app_id)
				->get("ls_app_master")->row();
			if($app) {
				$to_user=$app->create_by;
				$cust_name=$app->cust_id;
				if($cust_name!="" ){
					$cust_name=$this->db->select("cust_name")->where("cust_id",$cust_name)
					->get("ls_cust_master")->row()->cust_name;
				}
			}
			inbox_send($from,$to_user,$app_id." - Nama: $cust_name - boleh disurvey",
				"Nomor Aplikasi: $app_id boleh disurvey $from  - Nama: $cust_name. 
				Catatan: $catatan"); 
			$ok=$this->db->where("app_id",$data_spk[$i])->update("ls_app_master",array("confirmed"=>1,"status"=>"Need Survey"));
		}
	}
	function not_recomend_save(){
		// tidak boleh disurvey karena hasil score kurang
		$data_spk=$this->input->post("pilih");
		$catatan=$this->input->post('catatan');
		for($i=0;$i<count($data_spk);$i++){
			$from=user_id();
			$app_id=$data_spk[$i];
			$app=$this->db->select("create_by,cust_id")->where("app_id",$app_id)
				->get("ls_app_master")->row();
			if($app) {
				$to_user=$app->create_by;
				$cust_name=$app->cust_id;
				if($cust_name!="" ){
					$cust_name=$this->db->select("cust_name")->where("cust_id",$cust_name)
					->get("ls_cust_master")->row()->cust_name;
				}
			}
			inbox_send($from,$to_user,$app_id." - Nama: $cust_name - tidak boleh disurvey",
				"Nomor Aplikasi: $app_id tidak boleh disurvey $from  - Nama: $cust_name.
				Catatan: $catatan"); 
			$ok=$this->db->where("app_id",$app_id)->update("ls_app_master",array("confirmed"=>2,"status"=>"Not Recomend"));
		}
	}
	
    function view_result($app_id)	{
		$data=$this->step1($app_id,false);
		if($q=$this->db->where("app_id",$app_id)
			->get("ls_app_scoring")){
			$ver=$q->row();
			$data['catatan']=$ver->catatan;
			$data['v2_cust_name']=$ver->v2_cust_name=="1"?"checked":"";
			$data['v2_place_birth']=$ver->v2_place_birth=="1"?"checked":"";
			$data['v2_date_birth']=$ver->v2_date_birth=="1"?"checked":"";
			$data['v2_place_birth']=$ver->v2_place_birth=="1"?"checked":"";
			$data['v2_date_birth']=$ver->v2_date_birth=="1"?"checked":"";
			$data['v2_cust_name']=$ver->v2_cust_name=="1"?"checked":"";
			$data['v2_mother_name']=$ver->v2_mother_name=="1"?"checked":"";
			$data['v1_fam_name']=$ver->v1_fam_name=="1"?"checked":"";
			$data['v1_fam_relation']=$ver->v1_fam_relation=="1"?"checked":"";
			$data['v1_fam_street']=$ver->v1_fam_street=="1"?"checked":"";
			$data['v1_fam_kel']=$ver->v1_fam_kel=="1"?"checked":"";
			$data['v1_fam_kec']=$ver->v1_fam_kec=="1"?"checked":"";
			$data['v1_fam_kota']=$ver->v1_fam_kota=="1"?"checked":"";
			$data['v1_fam_pos']=$ver->v1_fam_pos=="1"?"checked":"";
			$data['v1_fam_phone']=$ver->v1_fam_phone=="1"?"checked":"";
			$data['v1_cust_name']=$ver->v1_cust_name=="1"?"checked":"";
			$data['v1_mother_name']=$ver->v1_mother_name=="1"?"checked":"";
			$data['v1_street']=$ver->v1_street=="1"?"checked":"";
			$data['v1_rtrw']=$ver->v1_rtrw=="1"?"checked":"";
			$data['v1_kel']=$ver->v1_kel=="1"?"checked":"";
			$data['v1_kec']=$ver->v1_kec=="1"?"checked":"";
			$data['v1_kota']=$ver->v1_kota=="1"?"checked":"";
			$data['v1_pos']=$ver->v1_pos=="1"?"checked":"";
			$data['v1_phone']=$ver->v1_phone=="1"?"checked":"";
			$data['v1_hp']=$ver->v1_hp=="1"?"checked":"";
			$data['v1_house_status']=$ver->v1_house_status=="1"?"checked":"";
			$data['v3_com_name']=$ver->v3_com_name=="1"?"checked":"";
			$data['v3_street']=$ver->v3_street=="1"?"checked":"";
			$data['v3_bidang']=$ver->v3_bidang=="1"?"checked":"";
			$data['v3_emp_status']=$ver->v3_emp_status=="1"?"checked":"";
			$data['v3_jabatan']=$ver->v3_jabatan=="1"?"checked":"";
			$data['v3_com_status']=$ver->v3_com_status=="1"?"checked":"";
			$data['v3_year']=$ver->v3_year=="1"?"checked":"";
			$data['v3_salary']=$ver->v3_salary=="1"?"checked":"";
			$data['v3_supervisor']=$ver->v3_supervisor=="1"?"checked":"";
			$data['v3_hrd']=$ver->v3_hrd=="1"?"checked":"";
			$data['v1_lama_tahun']=$ver->v1_lama_tahun=="1"?"checked":"";
		}
		$score_value=$this->db->where("app_id",$app_id)->get("ls_app_master")->row()->score_value;
		$data['score_value']=$score_value;
		$this->template->display("leasing/score_form",$data);
    }
}
?>