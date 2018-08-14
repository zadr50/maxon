<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sysvar_data extends CI_Controller {
    private $limit=10;
    private $table_name='system_variables';
    private $sql="select varname,varvalue,keterangan,category,id
                from system_variables
                ";
    private $file_view='sysvar';
    private $primary_key='id';
    private $controller='sysvar';

    function __construct()    {
            parent::__construct();        
       
			if(!$this->access->is_login())redirect(base_url());
            $this->load->helper(array('url','form','mylib_helper'));
	        $this->load->library('sysvar');
            $this->load->library('template');
            $this->load->library('form_validation');
            $this->load->model('sysvar_model');
    }
    function set_defaults($record=NULL){
            $data['mode']='';
            $data['message']='';
            $data=data_table($this->table_name,$record);
             return $data;
    }
    function index()    {	
		if (!allow_mod2('_00000'))	exit;
        $this->browse();
		
    }
    function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
    }
	function save(){
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$ok=$this->sysvar_model->save($data);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
	}
   function delete($kode){
		$kode=urldecode($kode);
		$ok=$this->sysvar_model->delete_id($kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }	
    function add()   {
             $data=$this->set_defaults();
             $this->_set_rules();
             if ($this->form_validation->run()=== TRUE){
                    $data=$this->get_posts();
                    $this->sysvar_model->save($data);
		            $data['message']='update success';
		            $data['mode']='view';
		            $this->view_list($data['varname']);
            } else {
                    $data['mode']='add';
                    $data['message']='';
		            $this->view_list($data['varname']);
            }
    }
    function update()   {

             $data=$this->set_defaults();
             $this->_set_rules();
             $id=$this->input->post('id');
             if ($this->form_validation->run()=== TRUE){
                    $data=$this->get_posts();
                    $this->sysvar_model->update($id,$data);
                    $message='Update Success';
                    $this->browse();
            } else {
                    $message='Error Update';
		            $this->view($id,$message);		
            }
    }

    function view($id,$message=null)	{
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->sysvar_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
		 $data['message']=$message;
		$this->template->display_form_input($this->file_view,$data);
    }
     // validation rules
    function _set_rules(){	
             $this->form_validation->set_rules('varname','VarName', 'required|trim');
    }

     // date_validation callback
    function valid_date($str)
    {
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
     {
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){

		$data['controller']=$this->controller;
		$data['fields_caption']=array('VarName','VarValue','Keterangan','Category','ID');
		$data['fields']=array('varname','varvalue','keterangan','category','id');
		$data['field_key']='id';
		$data['caption']='DAFTAR KODE SYSVAR';

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Variabel","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get('sid_nama')!='')$sql.=" varname='".$this->input->get('sid_nama')."'";
        echo datasource($sql);
    }	   
 
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select varvalue from system_variables where varname='$nomor'");
		echo json_encode($query->row_array());
 	}
	function view_list($varname) {
		$id=urldecode($varname);
		$data['recordset']=null;
		$data['varname']=$varname;
		if($query=$this->db->where('varname',$varname)->get($this->table_name)){
			$data['recordset']=$query;
			$message="Dibawah ini adalah data pilihana untuk varname [$varname]";
		} else {
			$message="No data found !";
		}
		$data['message']=$message;
		$this->template->display("admin/sysvar",$data);
	}
 
	
}
?>
