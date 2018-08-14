<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Unit_satuan extends CI_Controller {
    private $limit=10;
   	private $table_name='unit_of_measure';
    private $sql="select from_unit,to_unit,unit_value
                from unit_of_measure";
    private $file_view='admin/unit_of_measure';
	private $controller="unit_satuan";
	private $primary_key="id";
	function __construct()
	{
		parent::__construct();        
      
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('unit_of_measure_model');
		$this->load->model("syslog_model");
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            return $data;
	}
	function index()
	{	
            $this->browse();
	}
	function get_posts(){
            $data=  data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->unit_of_measure_model->save($data);
            $message='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"unit_satuan","add");

            $this->browse();
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 
		 $data=$this->set_defaults(); 
		 $this->_set_rules();
 		 $id=$this->input->post('type_of_paymnet');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$data['id']; 
			unset($data['id']);                       
			$this->unit_of_measure_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"unit_satuan","edit");

            $this->browse();
		} else {
			$message='Error Update';
         	$this->view($id,$message);		
		}	  
	}
	function save(){
		$mode=$this->input->post('mode');
		if($mode=="add"){
			$this->add();
		} else {
			$this->update();
		}
	}	
	function view($id,$message=null){
		 $id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->unit_of_measure_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
         $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('from_unit','from_unit', 'required|trim');
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
	function browse($offset=0,$limit=10,$order_column='id',$order_type='asc')
	{
        $data['caption']="DAFTAR UNIT SATUAN";
		$data['controller']='unit_satuan';
		$data['fields_caption']=array('From Unit','To Unit','Unit Value');
		$data['fields']=array('from_unit','to_unit','unit_value');
		$data['field_key']='id';
		
		$this->load->library('search_criteria');
		$faa[]=criteria("Nama","sid_kode");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        $sql=$this->sql." where from_unit like '$nama%'";
        echo datasource($sql);
    }
	function delete($id){
		$id=urldecode($id);
	 	$this->unit_of_measure_model->delete($id);
		$this->syslog_model->add($id,"unit_satuan","delete");

	 	$this->browse();
	}
	
}