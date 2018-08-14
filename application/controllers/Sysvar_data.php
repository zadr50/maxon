<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sysvar_data extends CI_Controller {
    private $limit=10;
    private $table_name='system_variables';
    private $sql="select * from system_variables";
    private $file_view='admin/sysvar';
    private $primary_key='id';
    private $controller='sysvar_data';

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
        $data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
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
        $data['message']="Sukses update baris [$id], silahkan refresh...";
        $data['content']="<script languange='javascript'>remove_tab_parent();</script>";        
        $this->template->display_form_input("blank",$data);
	}
   function delete($kode){
		$kode=urldecode($kode);
		$ok=$this->sysvar_model->delete_id($kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }	
    function add()   {
        if($data=$this->input->post()){
            $id=$this->sysvar_model->save($data);
            $data['message']="Sukses update baris [$id], silahkan refresh...";
            $data['content']="<script languange='javascript'>remove_tab_parent();</script>";        
            $this->template->display_form_input("blank",$data);
            
        } else {
             $data=$this->set_defaults();
             $data['mode']='add';
            $this->template->display_form_input($this->file_view,$data);
        }
    }
    function update()   {
        $data = $this->input->post(NULL, TRUE); //getallpost            
        $id=$data["id"];
        $ok=$this->sysvar_model->update_id($id,$data);
        $data['message']="Sukses update baris [$id], silahkan refresh atau tunggu beberapa saat untuk close...";
        $data['content']="<script languange='javascript'>remove_tab_parent();</script>";        
        $this->template->display_form_input("blank",$data);
    }

    function view($id,$message=null)	{
		$id=urldecode($id);
		 $model=$this->sysvar_model->get_by_id_row($id)->row();
		 $data=$this->set_defaults($model);
         $data['id']=$id;
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
   function browse($offset=0,$limit=50,$order_column='varname',$order_type='asc'){

		$data['controller']=$this->controller;
		$data['fields_caption']=array('VarName','VarValue','Keterangan','Category','Section','VarType','VarList','ID');
		$data['fields']=array('varname','varvalue','keterangan','category','section','vartype','varlist','id');
		$data['field_key']='id';
		$data['caption']='DAFTAR KODE SYSVAR';

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Variabel","sid_nama");
		$data['criteria']=$faa;
        $data['show_checkbox']=false;
        $this->template->display_browse($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';

        $search=$this->input->get("tb_search");
        
		if($this->input->get('sid_nama')!='')$sql.=" varname='".$this->input->get('sid_nama')."'";
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($search!="")$sql.=" and (varname like '%$search%' or keterangan like '%$search%')";
        $sql.=" order by varname";
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
                
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
        $data['mode']='';
		$this->template->display("admin/sysvar",$data);
	}
 
	
}
?>
