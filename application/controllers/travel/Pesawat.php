<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Pesawat extends CI_Controller {
    private $limit=100;
    private $table_name='al_ticket_pesawat';
    private $file_view='travel/ticket_pesawat';
    private $controller='travel/pesawat';
    private $primary_key='id';
    private $sql="";
	private $title="DAFTAR TICKET PESAWAT";
	private $help="";
    function __construct()    {
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		if($this->help=="")$this->help=$this->table_name;
		
		$this->load->model('travel/pesawat_model');
		$this->fields=$this->pesawat_model->fields;
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
				$this->pesawat_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
				$data['mode']='add';
				$data['message']='';
				$data['fields']=$this->fields;
				$data['data']=$data;

				$data['title']=$this->title;
				$data['help']=$this->help;
				$data['form_controller']=$this->controller;
				$data['field_key']=$this->primary_key;
				
				$this->template->display_form_input("simple_form",$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("id");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->pesawat_model->save($data);
		} else {
			$ok=$this->pesawat_model->update($id,$data);				
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
		$model=$this->pesawat_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		 $data['data']=$data;
		
		 $data['mode']='view';
		 $data['message']=$message;
		 $data['fields']=$this->fields;

		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		 
		$this->template->display_form_input("simple_form",$data);
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
		$data['fields']=$this->pesawat_model->fields;
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Dari","date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","date_to","easyui-datetimebox");
		$faa[]=criteria("Nama Tour","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('date_to')));
		$sql.=" and book_date between '$d1' and '$d2'";		
		//if($this->input->get('sid_nama')!='')$sql.=" tour_name like '".$this->input->get('sid_nama')."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->pesawat_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where ticket_no='$nomor'");
		echo json_encode($query->row_array());
 	}	
}
?>
