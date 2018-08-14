<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Dept_prod extends CI_Controller {

private $limit=10;
    private $file_view='manuf/dept_prod';
    private $table_name='departments';
    private $sql="select dept_code,dept_name from departments";
    private $primary_key='dept_code';
    private $controller='manuf/dept_prod';

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                 
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('department_model');
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
		$data=$this->input->post();
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->department_model->save($data);
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
		$id=$data['dept_code'];
		unset($data['mode']);

		 if ($this->form_validation->run()=== TRUE){
			if($mode=="add"){
				$ok=$this->department_model->save($data);
			} else {
				$ok=$this->department_model->update($id,$data);			
			}
			$this->browse();
		} else {
			$data['message']='Error Update';
       		$this->view($data['dept_code'],$data);		
		}	  
	}
	function view($id=null,$data=null){
		 if($id==null)	{
			 $data=$this->set_defaults();
			 $data['mode']='add';
		 } else {
			$id=urldecode($id);
			 $model=$this->department_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			 $data['mode']='view';
		 }
		 $this->template->display_form_input($this->file_view,$data,'');
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('dept_code','Kode Department', 'required|trim');
	}
    function browse($offset=0,$limit=50,$order_column='dept_code',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Dept Code','Dept Name');
		$data['fields']=array( 'dept_code','dept_name');
		$data['field_key']='dept_code';
		$data['caption']='DAFTAR KODE DEPARTMENTS';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_no");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
		if($this->input->get('sid_no')!='')$sql.=" and dept_code='".$this->input->get('sid_no')."'";	
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function delete($id){
		$id=urldecode($id);
	 	$this->department_model->delete($id);
	 	$this->browse();
	}
}
?>
