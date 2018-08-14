<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Lookup extends CI_Controller {
    private $limit=10;
    private $table_name='system_variables';
    private $file_view='admin/lookup';
    private $primary_key='id';
    private $controller='lookup';

	function __construct(){
		parent::__construct();        
        
		$this->load->helper("mylib_helper");
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->model('sysvar_model');
        $this->load->library("list_of_values");
	}
	function index(){	
		$this->browse();	
	}
	function browse(){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Kode','Var Value','keterangan','id');
		$data['fields']=array('varname','varvalue','keterangan',"id");
		$data['field_key']=$this->primary_key;
		$data['caption']='DAFTAR LOOKUP PILIHAN';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Search: ","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
	}
    function browse_data($nama='',$offset=0,$limit=10){
		$nama=urldecode($nama);
    	$sql="select varname,varvalue,keterangan,id from system_variables 
    	where varname like 'lookup.%' ";
		if($this->input->get('sid_nama')!='')$sql.=" and varname like 'lookup.".$this->input->get('sid_nama')."%'";
        if($this->input->get('tb_search')!='')$sql.=" and varname like 'lookup.".$this->input->get('tb_search')."%'";

        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");


   		$sql.=" order by varname,varvalue";
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        
        echo datasource($sql);
    }	 
    function add()	{
    	if($this->input->post()){
	        $varname=$this->input->post("varname");
            if(!strpos($varname,"lookup")){
                $varname="lookup.$varname";
            }
            $data['varname']=$varname;
	        $data['varvalue']=$this->input->post('varvalue');
	        $data['keterangan']=$this->input->post('keterangan');
	        $this->sysvar_model->save($data);
	        $data['message']='Tambah variabel sukses. Silahkan refresh...';
            $data['content']="<script languange='javascript'>remove_tab_parent();</script>";   		
            $this->template->display_form_input("blank",$data);
		} else {
			 $data=$this->set_defaults();
	         $data['mode']='add';
	        $this->template->display_form_input($this->file_view,$data);
		}
    }

    function view($id,$message=null)	{
    	 $id=urldecode($id);
         $data['id']=$id;
         $model=$this->sysvar_model->get_by_id_row($id)->row();
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
    function update()   {
    	$id=$this->input->post('id');
    	$id=urldecode($id);
		
        $data['varname']=$this->input->post('varname');
        $data['varvalue']=$this->input->post('varvalue');
        $data['keterangan']=$this->input->post('keterangan');
        $this->sysvar_model->update_id($id,$data);
        $data['message']="Sukses update baris [$id], silahkan refresh...";
        $data['content']="<script languange='javascript'>remove_tab_parent();</script>";        
        $this->template->display_form_input("blank",$data);
        
    }	
	function query_sysvar_lookup($key,$search=""){
		$sql="select varvalue,keterangan from system_variables where varname='lookup.$key'";
		if($search!="")$sql.=" where varvalue like '%$search%'";
		echo datasource($sql);
	}
	function query($what,$search=''){
        $sql=$this->list_of_values->get_by_name($what,$search);
		if($sql==""){
			echo "<div class='alert alert-warning'>Invalid Query Check Controller Lookup.php !!!</div>";
		} else {
		    if($what=="recv_po"){
                echo datasource($sql,true,"shipment_id");
		        
		    } else {
                echo datasource($sql);
		        
		    }
		}
	}
    function delete($id){
        $id=urldecode($id);
        $this->sysvar_model->delete_id($id);
        $data['message']="Sukses update baris [$id], silahkan refresh...";
        $data['content']="<script languange='javascript'>remove_tab_parent();</script>";        
        echo json_encode(array("success"=>true,"data"=>$data));
    }
    
 
}

?>