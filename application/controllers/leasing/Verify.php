<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Verify extends CI_Controller {
    private $limit=100;
    private $table_name='ls_app_verify';
    private $file_view='leasing/verify';
    private $controller='leasing/verify';
    private $primary_key='id';
	private $title="DAFTAR VERIFIKASI APLIKASI";
    private $sql="";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->sql=="")$this->sql="select * from ls_app_verify";
		if($this->help=="")$this->help=$this->table_name;
		$this->load->model("leasing/verify_model");
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
		$data['not_verified']=$this->app_master_model->not_verified();		
		$this->template->display_form_input($this->file_view,$data);			
    }
	function save($save_sementara=false){
		$data=$this->input->post();		
		 
		$id=$this->input->post("id");
		if($id==""){ 
			$ok=$this->verify_model->save($data,$save_sementara);
		} else {
			$ok=$this->verify_model->update($id,$data);				
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
		$model=$this->verify_model->get_by_id($id)->row();
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
	 	$this->verify_model->delete($id);
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
		$s="select am.app_id,am.app_date,am.cust_id,cm.cust_name,
		cm.phone,cm.spouse_phone,cm.spouse_hp,cm.hp from ls_app_master am
		left join ls_cust_master cm on cm.cust_id=am.cust_id 
		where am.app_id='".$app_id."'";
		
		$ret="<p>Nomor Aplikasi Tidak ada !</p>";

		$fam_telp=""; $com_telp=""; $com_ext="";
		$com_name=""; $com_contact="";
	
		if($q=$this->db->query($s)){
			$row=$q->row();
			$cust_id=$row->cust_id;
			
			$s="select hp,phone,relation,first_name from ls_cust_ship_to where cust_id='".$cust_id."' 
				and ship_to_type='Family'";
			$fam_telp="";$fam_name="";$fam_relate="";$fam_hp="";
			if($q=$this->db->query($s)){
				if($rfam=$q->row()) {
					$fam_telp=$rfam->phone;
					$fam_name=$rfam->first_name;
					$fam_relate=$rfam->relation;
					$fam_hp=$rfam->hp;
				}
			}
			$s="select comp_name,contact_phone,phone_ext,contact_name,spv_name,hrd_name 
				from ls_cust_company where cust_id='".$cust_id."'";
			if($q=$this->db->query($s)){
				$rcom=$q->row();
				$com_telp=$rcom->contact_phone;
				$com_ext=$rcom->phone_ext;
				$com_name=$rcom->comp_name;
				$com_contact=$rcom->contact_name.'/'.$rcom->hrd_name;
			}
			
			$ret="<table class='table2' style='width:100%'>
			<tr><td>Nomor Applikasi : </td><td>".$app_id."</td>";
			$ret.="<td>Tanggal Pengajuan : </td><td>".$row->app_date."</td></tr>";
			$ret.="<tr><td>Kode Debitur : </td><td>".$row->cust_id."</td>";
			$ret.="<td>Nama Debitur : </td><td>".$row->cust_name."</td></tr>";
			$ret.="<tr><td>Telpon/HP : </td><td>".$row->hp." - ".$row->phone."</td>";
			$ret.="<td>Telpon Pasangan : </td><td>".$row->spouse_phone."</td></tr>";
			$ret.="<tr><td>HP Pasangan : </td><td>".$row->spouse_hp."</td>";
			$ret.="<td>Saudara Tidak Serumah : </td><td>".$fam_name."(".$fam_relate.")</td></tr>";
			$ret.="<tr><td>HP Saudara : </td><td><input id='fam_hp' readonly value='".$fam_hp."'></td>";
			$ret.="<td>Nama Perusahaan : </td><td><input id='fam_kerja1' readonly value='".$com_name."'></td></tr>";
			$ret.="<tr><td>Telpon Saudara : </td><td><input id='fam_hp' readonly value='".$fam_telp."'></td>";
			$ret.="<tr><td>Telpon Perusahaan / Extension : </td><td>".$com_telp." / ".$com_ext."</td>";
			$ret.="<td>Bagian SPV/HRD/Pemilik : </td><td>".$com_contact."</td></tr>";			
			$ret.="</table>";
		}
		echo $ret;
	}
	function step2($app_id){
		$data['app_id']=$app_id;
		$data['cust_id']="";
		$this->load->view("leasing/verify_form",$data);
	}
	function data($app_id){
		$data=$this->db->where("app_id",$app_id)->get("ls_app_verify")->row();
		echo json_encode($data);
	}
	
}
?>
