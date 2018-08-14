<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Risk extends CI_Controller {
    private $limit=100;
    private $table_name='ls_app_survey';
    private $file_view='leasing/risk';
    private $controller='leasing/risk';
    private $primary_key='id';
	private $title="DAFTAR SURVEY APLIKASI";
    private $sql="";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->sql=="")$this->sql="select * from ls_app_verify";
		if($this->help=="")$this->help=$this->table_name;
		$this->load->model("leasing/survey_model");
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
		$data['surveyed']=$this->app_master_model->surveyed();		
		$this->template->display_form_input($this->file_view,$data);			
    }
	function save(){
		$app=$this->input->post('pilih');
		$catatan=$this->input->post('comments');
		for($i=0;$i<count($app);$i++){
			$app_id=$app[$i];
			$ok=$this->db->where("app_id",$app_id)->update("ls_app_survey",array("recomended"=>1));
			$ok=$this->db->where("app_id",$app_id)->update("ls_app_master",array("status"=>"Wait Approval"));
			$from=user_id();
			$to_user=$this->db->select("create_by")->where("app_id",$app_id)
				->get("ls_app_master")->row()->create_by;
			inbox_send($from,$to_user,$app_id." - Recomended By Risk",
				"Nomor Aplikasi: $app_id di setujui oleh $from, Catatan: $catatan"); 
			
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		} 
	}	
	function not_recomend(){
		$app=$this->input->post('pilih');
		$catatan=$this->input->post('comments');
		for($i=0;$i<count($app);$i++){
			$app_id=$app[$i];
			$ok=$this->db->where("app_id",$app_id)->update("ls_app_survey",array("recomended"=>2));
			$ok=$this->db->where("app_id",$app_id)->update("ls_app_master",array("status"=>"Not Recomended"));
			$from=user_id();
			$to_user=$this->db->select("create_by")->where("app_id",$app_id)
				->get("ls_app_master")->row()->create_by;
			inbox_send($from,$to_user,$app_id." - Not Recomended by Risk",
				"Nomor Aplikasi: $app_id tidak setujui $from, catatan: $catatan"); 
			
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		} 
	}	
    function view($id,$message=null)	{
 		$id=urldecode($id);
		$s="select lam.app_id,cm.cust_id,cm.cust_name,cm.street,las.hasil,
		las.foto_depan,las.foto_kanan,las.foto_kiri,las.survey_by,
		las.foto_1,las.foto_ket_1,las.foto_2,las.foto_ket_2,las.foto_3,las.foto_ket_3,
		las.foto_4,las.foto_ket_4,las.foto_5,las.foto_ket_5,cm.kec,cm.kel,cm.rt,cm.rw 
		from ls_app_master lam
		left join ls_cust_master cm on cm.cust_id=lam.cust_id 
		left join ls_app_survey as las on las.app_id=lam.app_id 
		where lam.app_id='$id' 
		";
		$i=0; 
		$row=$this->db->query($s)->result();
		$data=to_array($row);
		if(!$data){
			$data=array("app_id"=>"","cust_id"=>"","cust_name"=>"",
			"street"=>"","hasil"=>"","foto_depan"=>"","foto_kanan"=>"",
			"foto_kiri"=>"","survey_by"=>"","foto_ket_1"=>"","foto_ket_2"=>"",
			"foto_ket_3"=>"","foto_ket_4"=>"","foto_ket_5"=>"");
		}
		$this->template->display_form_input("leasing/survey_form",$data);
    }
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
		$data['fields']=array('cust_name','app_id','app_date','sales_agent','id');
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get("sid_no"))$sql .= " and cust_id='".$this->input->get("sid_no")."'";
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
	function step1($app_id){
		$data['app_id']=$app_id;
		if($q=$this->db->where("app_id",$app_id)->get("ls_app_master")){
			$app=$q->row();
			$cust_id=$app->cust_id;
		}
		if($q=$this->db->where("cust_id",$cust_id)->get("ls_cust_master")){
			$cust=$q->row();
		}
		$this->load->model("leasing/survey_model");
		$sm=$this->survey_model->get_by_app_id($app_id);
		$data['app_id']=$app_id;
		$data['cust_id']=$cust_id;
		$data['cust_name']=$cust->cust_name;
		$this->load->view("leasing/survey_form",$data);
	}
	function proses($app_id){
		$data['app_id']=$app_id;
		if($q=$this->db->where("app_id",$app_id)->get("ls_app_master")){
			$app=$q->row();
			$cust_id=$app->cust_id;
		}
		if($q=$this->db->where("cust_id",$cust_id)->get("ls_cust_master")){
			$cust=$q->row();
		}
		$data['ls_app_master']=$app;
		$data['ls_cust_master']=$cust;
	
		$this->template->display("leasing/survey_proses",$data);
	}
	function hasil_survey(){
		$app_id=$this->input->post('app_id');
		if($app_id!=""){
			$data['hasil']=$this->input->post('hasil');
			$data['foto_depan']=$this->input->post('foto_depan');
			$data['foto_kiri']=$this->input->post('foto_kiri');
			$data['foto_kanan']=$this->input->post('foto_kanan');
			$data['status']=1;
			$ok=$this->db->where("app_id",$app_id)->update("ls_app_survey",$data);
			if($ok){
				echo json_encode(array("success"=>true));
				$dt['surveyed']=1;
				$this->db->where('app_id',$app_id)->update('ls_app_master',$dt);
			} else {
				echo json_encode(array("msg"=>"Error ".mysql_error()));
			}
		}	
	}
	function upload_foto(){
		$config['upload_path'] = './tmp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$userfile=$this->input->get('userfile');

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()){
			$error = array('error' =>'Error upload !! ');
		    echo json_encode($error);
		}else{
			$data = array('success'=>'Sukses','upload_data' => $this->upload->data());
			echo json_encode($data);
		}	
	}
}
?>
