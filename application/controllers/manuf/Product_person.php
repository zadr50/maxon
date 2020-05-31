<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Product_person extends CI_Controller {

private $limit=10;
    private $file_view='manuf/product_person';
    private $table_name='employee';
    private $sql="select * from employee";
    private $primary_key='nip';
    private $controller='manuf/product_person';

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                  
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('payroll/employee_model');
	}
	function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		$data['hireddate']='';
		$data['tgllahir']='';
		return $data;
	}
	function index()
	{	
		$this->browse();			
	}
	function get_posts(){
		$data=$this->input->post();
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->employee_model->save($data);
			echo json_encode(array("succes"=>true,"msg"=>"Success"));
		} else {
			$data['mode']='add';
			$data['message']='';
			$this->template->display_form_input($this->file_view,$data,'');			
		}        
	}
	function save()
	{
		$this->_set_rules();
		$mode=$this->input->post('mode');
		$data=$this->input->post();
		$id=$data['nip'];
		unset($data['mode']);

		 if ($this->form_validation->run()=== TRUE){
			if($mode=="add"){
				$ok=$this->employee_model->save($data);
			} else {
				$ok=$this->employee_model->update($id,$data);			
			}
			echo json_encode(array("success"=>true,"msg"=>"Success"));
		} else {
            echo json_encode(array("success"=>false,"msg"=>"Error"));
		}	  
	}
	function view($id=null,$data=null){
		 if($id==null)	{
			 $data=$this->set_defaults();
			 $data['mode']='add';
		 } else {
			$id=urldecode($id);
			 $model=$this->employee_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			 $data['mode']='view';
		 }
		 $this->template->display_form_input($this->file_view,$data,'');
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('nip','Isi NIP Karyawan', 'required|trim');
	}
    function browse($offset=0,$limit=50,$order_column='nip',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('NIP','Nama Karyawan','Dept','Divisi');
		$data['fields']=array( 'nip','nama','dept','divisi');
		$data['field_key']='nip';
		$data['caption']='DAFTAR KODE KARYAWAN PRODUKSI';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_no");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
		if($this->input->get('sid_no')!='')$sql.=" and nip='".$this->input->get('sid_no')."'";	
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);
    }	 
	function delete($id){
		$id=urldecode($id);
	 	$this->employee_model->delete($id);
	 	$this->browse();
	}
}
?>
