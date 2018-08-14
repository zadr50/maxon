<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class cust_master extends CI_Controller {
    private $limit=100;
    private $table_name='ls_cust_master';
    private $file_view='leasing/cust_master';
    private $controller='leasing/cust_master';
    private $primary_key='cust_id';
    private $sql="";
	private $title="DAFTAR PELANGGAN";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		if($this->help=="")$this->help=$this->table_name;
		
		$this->load->model('leasing/cust_master_model');
    }
    function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		$data['gender']='';
		$data['birth_place']='';
		$data['birth_date']='';
		$data['marital_status']='';
		$data['no_of_dependents']='';
		$data['house_status']='';
//		$data['lama_thn']='';
		
		$data['salary']='0';
		$data['spouse_salary']='0';
		$data['other_income']='0';
		$data['salary_source']='';
		$data['spouse_salary_source']='';
		$data['other_income_source']='';
		

		$data['comp_name']='';
		$data['comp_desc']='';
		$data['job_status']='';
		$data['com_kec']='';
		$data['job_status_etc']='';
		$data['emp_status']='';
		$data['bussiness_type']='';
		$data['emp_status_etc']='';
		$data['since_year']='';
		$data['com_city']='';
		$data['job_level']='';
		$data['com_zip_pos']='';
		$data['job_type']='';
		$data['total_employee']='';
		$data['job_type_etc']='';
		$data['com_contact_phone']='';
		$data['com_street']='';
		$data['office_status']='';
		$data['com_rtrw']='';
		$data['office_status_etc']='';
		$data['com_kel']='';
		$data['phone_ext']='';
		$data['spv_name']='';
		$data['hrd_name']='';
		if($record==NULL) {
			$data['create_date']=date("Y-m-d");
			$data['create_by']=user_id();
			$data['username']=user_name();
		} else {
			$data['username']=user_name($data['create_by']);
		}
		
		return $data;
    }
    function index(){
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
				$data=$this->get_posts();
				$this->cust_master_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
				$data['cust_id']=$this->next_number();
				$data['mode']='add';
				$data['message']='';
				$data['data']=$data;
				$data['title']=$this->title;
				$data['help']=$this->help;
				$data['form_controller']=$this->controller;
				$data['field_key']=$this->primary_key;
				$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("cust_id");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$id=$this->next_number();
			$data['cust_id']=$id;
			$ok=$this->cust_master_model->save($data);
		} else {
			$ok=$this->cust_master_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true,"cust_id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}
	function edit($id){
		$this->view($id,"edit");
	}
    function view($id,$mode="view",$show_tool=true)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->cust_master_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		// field cust_master yg sama dengan company
		$field_sama['street']=$data['street'];
		$field_sama['city']=$data['city'];
		$field_sama['kel']=$data['kel'];
		$field_sama['kec']=$data['kec'];
		$field_sama['rtrw']=$data['rtrw'];
		$field_sama['zip_pos']=$data['zip_pos'];
		
		$data=array_merge($data,
			$this->cust_master_model->personal(),
			$this->cust_master_model->company());

		$data['birth_date']= date("Y-m-d",strtotime($data['birth_date']));

		// benerin field_sama
		$data['com_street']=$data['street'];
		$data['com_city']=$data['city'];
		$data['com_kel']=$data['kel'];
		$data['com_kec']=$data['kec'];
		$data['com_rtrw']=$data['rtrw'];
		$data['com_zip_pos']=$data['zip_pos'];
		$data['com_contact_phone']=$data['contact_phone'];
		// kembalikan
		$data['street']=$field_sama['street'];
		$data['city']=$field_sama['city'];
		$data['kel']=$field_sama['kel'];
		$data['kec']=$field_sama['kec'];
		$data['rtrw']=$field_sama['rtrw'];
		$data['zip_pos']=$field_sama['zip_pos'];
		
		$data['data']=$data;
		
		$data['mode']=$mode;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		
		$data['spouse_birth_date']= date("Y-m-d",strtotime($data['spouse_birth_date']));
		$data['id_card_exp']= date("Y-m-d",strtotime($data['id_card_exp']));
		$data['show_tool']=$show_tool;
		
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
		$data['fields']=array("cust_name","cust_id","phone","province","city","kec","kel");
		$data['fields_caption']=array("Nama Customer","Kode","Telp","Propinsi","Kota","Kecamatan","Kelurahan");
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Debitur","sid_nama");
		$data['criteria']=$faa;
		$data['other_menu']="leasing/cust_master_menu";
		$data['msg_left']="<i>Ketik nama yang ingin dicari, lalu klik tombol cari.</i>";
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		if(user_admin() or $this->access->cid=="ALL"){
			$sql=$this->sql." where 1=1";
		} else {
			$sql=$this->sql." where create_by='".user_id()."'";
		}
		$nama=$this->input->get("sid_nama");
		if($nama!=""){
			$sql .= " and cust_name like '%".$nama."%'";
		} else {
			$sql.=" order by create_date desc limit 10";
		}
		
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	if( $this->cust_master_model->delete($id)){
			$this->browse();
		} else {
			show_error("Tidak bisa dihapus, 
			mungkin masih ada data pengajuan untuk debitur ini, 
			tidak bisa dihapus !");		
		}
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where cust_id='$nomor'");
		echo json_encode($query->row_array());
 	}
	function next_number($add=false)
	{
		$key="Customer Number";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'$00001~!LS~#YY~#MM');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'$00001~!LS~#YY~#MM');
				$rst=$this->cust_master_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	function next_number_inc() { 
		next_number(true); 
	}
	function alamat($cmd="",$id=""){
		if($cmd=="save"){
			$data=$this->input->post();
			$cust_id=$data['frmAddAlamat_cust_id'];
			unset($data['frmAddAlamat_cust_id']);
			unset($data['id']);
			$data['cust_id']=$cust_id;
			$ok=$this->cust_master_model->add_alamat($cust_id,$data);				
			if($ok){
				echo json_encode(array("success"=>true));
			} else {
				echo json_encode(array("msg"=>"Error ".mysql_error()));
			}
		} else if ($cmd=="delete") {
			$this->cust_master_model->delete_alamat($id);
		} else if ($cmd=="view") {
			if($q=$this->cust_master_model->view_alamat($id)){
				if($r=$q->row()){
					$data=(array)$r;
					$data['success']=true;
					echo json_encode($data);
				}				
			}
		} else {
			//else $cmd adalah cust_id
			echo datasource("select * from ls_cust_ship_to where cust_id='".$cmd."'");
		}
	}
	function kartukredit($cmd="",$id=""){
		if($cmd=="save"){
			$data=$this->input->post();
			$cust_id=$data['frmAddCrCard_cust_id'];
			unset($data['frmAddCrCard_cust_id']);
			unset($data['id']);
			$data['cust_id']=$cust_id;
			$ok=$this->cust_master_model->add_crcard($cust_id,$data);				
			if($ok){
				echo json_encode(array("success"=>true));
			} else {
				echo json_encode(array("msg"=>"Error ".mysql_error()));
			}
		} else if ($cmd=="delete") {
			$this->cust_master_model->delete_crcard($id);
		} else if ($cmd=="view") {
			if($q=$this->cust_master_model->view_crcard($id)){
				if($r=$q->row()){
					$data=(array)$r;
					$data['success']=true;
					echo json_encode($data);
				}				
			}
		} else {
			//else $cmd adalah cust_id
			echo datasource("select * from ls_cust_crcard where cust_id='".$cmd."'");
		}	
	}
	function filter($search=''){
		$sql="select * from ls_cust_master where 1=1";
		if($search!=""){
			$sql.=" and cust_name like '%".$search."%'";
		}
		$sql.=" and create_by='".user_id()."'";
		echo datasource($sql);
	}
	function upload_foto(){
		$cust_id=$this->input->get("dlgGambar_cust_id");
		$config['upload_path'] = './tmp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '300';
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
	function view_foto($cust_id,$nomor){
		$fld="cust_foto,cust_foto_2,cust_foto_3,cust_foto_4,cust_foto_5";
			
		if($q=$this->db->select($fld)->where("cust_id",$cust_id)->get("ls_cust_master")){
			if($nomor==0)$fld=$q->row()->cust_foto;	
			if($nomor==2)$fld=$q->row()->cust_foto_2;	
			if($nomor==3)$fld=$q->row()->cust_foto_3;	
			if($nomor==4)$fld=$q->row()->cust_foto_4;	
			if($nomor==5)$fld=$q->row()->cust_foto_5;	
		}
		echo "<img src='".base_url()."tmp/$fld' style='width:300px;height:250px'>";	
	}
	
}
?>
