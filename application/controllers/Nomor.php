<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Nomor extends CI_Controller {
    private $limit=10;
    private $table_name='system_variables';
    private $file_view='admin/nomor';
    private $primary_key='id';
    private $controller='nomor';
	function __construct()
	{
		parent::__construct();        
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->model('sysvar_model');
	}
	function index(){
		$this->browse();	
	}
	function browse(){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('VarName','VarValue','Description','Id');
		$data['fields']=array('varname','varvalue','keterangan','id');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='id';
		$data['caption']='DAFTAR KODE PENOMORAN TRANSAKSI';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Search: ","sid_nama");
		$data['criteria']=$faa;
        $data['col_width']=array("var_name"=>300);
        $this->template->display_browse2($data);            
	}
    function browse_data($nama=''){
		$nama=urldecode($nama);
    	$sql="select * from system_variables 
    	where varname like '% numbering' ";
		if($this->input->get('sid_nama')!='')$sql.=" and varname like '".$this->input->get('sid_nama')."% numbering'";
        
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
            $sql.=" and varname like '$search% numbering'";
        }
        $sql.=" order by varname";

        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";


        
        echo datasource($sql);
    }	 
    function add()	{
    	if($this->input->post()){
	    	$id=$this->input->post('varname');
	    	$id=urldecode($id);
	        $data['varname']=$id;
	        $data['varvalue']=$this->input->post('varvalue');
	        $data['keterangan']=$this->input->post('keterangan');
	        $this->sysvar_model->save($data);
	        $message='Update Success';
	        $this->browse();
    		
		} else {
			 $data=$this->set_defaults();
	         $data['mode']='add';
	        $this->template->display_form_input($this->file_view,$data);
		}
    }

    function view($id,$message=null)	{
    	 $id=urldecode($id);
         $data['id']=$id;
         $model=$this->sysvar_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
         $data['mode']='view';
        $this->template->display_form_input($this->file_view,$data);
    }
	function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
        return $data;
	}
    function save()   {
    	$data=$this->input->post();    
    	$mode=$data['mode'];
        unset($data['mode']);
        $id_ret=0;
        if($mode=="add"){
            unset($data["id"]);
            $id_ret=$this->sysvar_model->save($this->table_name,$data);
        } else {
            $id_ret=$this->sysvar_model->update($data['id'],$data);
            
        }
        if($id_ret>0){
            echo json_encode(array("success"=>true,"id"=>$id_ret,"msg"=>"Data sudah tersimpan"));
        } else {
            echo json_encode(array("success"=>false,"id"=>$id_ret,"msg"=>"Gagal simpan !"));
        }
    }
    function delete($id){
        $this->db->where("id",$id);
        $ok=$this->db->delete($this->table_name);
        if($ok){
            echo json_encode(array("success"=>true,"msg"=>"Success"));
        } else {
            echo json_encode(array("success"=>false,"msg"=>"Error !"));
        }
    }
}
