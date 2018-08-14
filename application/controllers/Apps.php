<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Apps extends CI_Controller {
    private $limit=100;
    private $table_name='maxon_apps';
    private $file_view='apps';
    private $controller='apps';
    private $primary_key='id';
    private $sql="";

    function __construct()    {
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		$this->load->model('apps_model');
		$this->fields=$this->apps_model->fields;
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index()    {	
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
				$this->apps_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
				$data['mode']='add';
				$data['message']='';
				$data['fields']=$this->fields;
				$data['data']=$data;
				$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("id");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			unset($data['id']);
			$ok=$this->apps_model->save($data);
		} else {
			$ok=$this->apps_model->update($id,$data);				
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
		$model=$this->apps_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['message']=$message;
		$data['fields']=$this->fields;
		$this->template->display_form_input($this->file_view,$data);
    }
    function edit($id)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->apps_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='edit';
		$data['fields']=$this->fields;
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
		$data['fields']=$this->apps_model->fields;
		$data['field_key']=$this->primary_key;
		$data['caption']='DAFTAR APLIKASI';

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
		$data['col_width']=array("app_name"=>100);
		$data['view_mode']='apps_install';
        $this->template->display_browse($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1  ';
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->apps_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where id=$nomor");
		echo json_encode($query->row_array());
 	}	
	function create_zip_backup($zip_file,$dir){
		if ( ! file_exists($dir))
		{
			return FALSE;
		}
		$this->load->helper("file_helper");
			$this->load->library("zip");
			//$this->zip->add_dir($dir); 
			foreach (scandir($dir) as $item) {
				if ($item == '.' || $item == '..') continue;
				$file=$dir . "/" . $item;
				if(is_dir($file)){
					$dir2=$file;
					foreach(scandir($dir2) as $item2) {
						if ($item2 == '.' || $item2== '..') continue;
						$file2=$dir2 . "/" . $item2;
						$this->zip->read_file($file2, TRUE); 
					}
				} else {
					$this->zip->read_file($file, TRUE); 
				}
			}
			$this->zip->archive('addins/'.$zip_file); 
			delete_files($dir,TRUE,1);
	}
	function extract_zip($zip_file,$dir){
		$this->load->library("unzip");
		$this->unzip->extract('addins/'.$zip_file, $dir);		
	}
	function uninstall($id){
		$msg="";
		$ok=true;
		if($query=$this->db->where("app_id",$id)->get("maxon_apps")){
			if($row=$query->row()){
				$file_zip=$row->app_url;
				if($file_zip=="")$file_zip=$row->app_controller;
				$this->create_zip_backup($file_zip.".zip","application/controllers/".$file_zip);
				$this->create_zip_backup($file_zip.".zip","application/views/".$file_zip);
				$this->create_zip_backup($file_zip.".zip","application/models/".$file_zip);
				$this->db->where("app_id",$id)->update("maxon_apps",array("is_active"=>0));
				$ok=true;
			}
		}
		echo json_encode(array('success'=>$ok,'msg'=>$msg));
	}
	function install($id){
		$msg="";
		$ok=true;
		$this->load->library("unzip");
		if($query=$this->db->where("app_id",$id)->get("maxon_apps")){
			if($row=$query->row()){
				$file_zip=$row->app_url;
				if($file_zip=="")$file_zip=$row->app_controller;
				$this->unzip->extract('addins/'.$file_zip.'.zip',"application/../",TRUE);		
				$ok=true;
				$this->db->where("app_id",$id)->update("maxon_apps",array("is_active"=>1));
			}
		}
		echo json_encode(array('success'=>$ok,'msg'=>$msg));
	}
	function download(){
		var_dump($_SESSION);
	}
}
?>
