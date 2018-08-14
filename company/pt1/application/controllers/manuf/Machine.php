<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Machine extends CI_Controller {

private $limit=10;
    private $file_view='manuf/machine';
    private $table_name='machine';
    private $sql="select mac_id,mac_name,mac_group,location,capacity from machine";
    private $primary_key='mac_id';
    private $controller='machine';

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('manuf/machine_model');
	}
	function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		$data['group_list']=array("G1","G2");
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
			$this->machine_model->save($data);
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
		$id=$data['mac_id'];
		unset($data['mode']);

		 if ($this->form_validation->run()=== TRUE){
			if($mode=="add"){
				$ok=$this->machine_model->save($data);
			} else {
				$ok=$this->machine_model->update($id,$data);			
			}
			$this->browse();
		} else {
			$data['message']='Error Update';
       		$this->view($data['mac_id'],$data);		
		}	  
	}
	function view($id=null,$data=null){
		 if($id==null)	{
			 $data=$this->set_defaults();
			 $data['mode']='add';
		 } else {
			 $model=$this->machine_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			 $data['mode']='view';
		 }
		 $this->template->display_form_input($this->file_view,$data,'');
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('mac_id','Isi kode mesin', 'required|trim');
	}
    function browse($offset=0,$limit=50,$order_column='mac_id',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Kode Mesin','Nama Mesin','Grup','Location','Kapasitas');
		$data['fields']=array( 'mac_id','mac_name','mac_group','location','capacity');
		$data['field_key']='mac_id';
		$data['caption']='DAFTAR KODE MESIN';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_no");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
		if($this->input->get('sid_no')!='')$sql.=" and mac_id='".$this->input->get('sid_no')."'";	
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function delete($id){
		$id=urldecode($id);
	 	$this->machine_model->delete($id);
	 	$this->browse();
	}
}
?>
