<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Counter extends CI_Controller {
    private $limit=100;
    private $table_name='ls_counter';
    private $file_view='leasing/counter';
    private $controller='leasing/counter';
    private $primary_key='counter_id';
	private $title="DAFTAR KODE COUNTER";
    private $sql="";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->sql=="")$this->sql="select * from ls_counter";
		if($this->help=="")$this->help=$this->table_name;
		
		$this->load->model('leasing/counter_model');
		$this->load->model('leasing/sales_agent_model'); 
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		$data['sales_agent_list']=$this->sales_agent_model->dropdown();
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
				$this->counter_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
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
		$id=$this->input->post("counter_id");
		$mode=$data["mode"];	unset($data['mode']);
		if(isset($data['active'])){
			$data['active']=true;
		} else {
			$data['active']=false;
		}
		if($mode=="add"){ 
			$ok=$this->counter_model->save($data);
		} else {
			$ok=$this->counter_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
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
		$model=$this->counter_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$data['mode']=$mode;
		$data['show_tool']=$show_tool;
		$data['message']='';
		 
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
		$faa[]=criteria("Nama Counter","sid_nama","","style='width:400px'");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Kode','Nama Counter','Area','Nama Area','Sales Agent','Telfon','Alamat');
		$data['fields']=array('counter_id','counter_name','area','area_name','sales_agent','phone','address');
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get("sid_nama"))$sql .= " and counter_name like '%".$this->input->get("sid_nama")."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->counter_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where counter_id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function filter($id=""){
		$sql="select * from ".$this->table_name;
		if($id!=""){
			$sql.=" where counter_name like '%".$id."%'";
		}
		echo datasource($sql);
	
	}
}
?>