<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Coa_group extends CI_Controller {
        private $sql="select group_type,group_name,parent_group_type,
         account_type
         from gl_report_groups 
         where 1=1 ";
        private $file_view='gl/group';
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
        $this->load->model('gl_report_groups_model');
        $this->load->model('chart_of_accounts_model');
		$this->load->model('syslog_model');
	} 
	function index()
	{	
		if(!allow_mod2('_10060'))return false;   
        $this->browse();
	}
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']='coa_group';
		$data['fields_caption']=array('Kode','Nama Kelompok Akun Perkiraan','Parent','Type');
		$data['fields']=array('group_type','group_name','parent_group_type','account_type');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
				$data['field_key']='group_type';
		$data['caption']='DAFTAR KELOMPOK PERKIRAAN';

		$this->load->library('search_criteria');
		$faa[]=criteria("Kelompok","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql;
		if($this->input->get('sid_nama')!='')$sql.=" and group_name like '".$this->input->get('sid_nama')."%'";
		$sql.=" order by group_type";
        echo datasource($sql);
    }	      
    
	function add()
	{
		if(!allow_mod2('_10061'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			unset($data['mode']); 
			$id=$this->gl_report_groups_model->save($data);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"coa_group","add");

            $this->browse();
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
        
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
       	$data['account_type_list']=$this->chart_of_accounts_model->account_type_list();
        $data['account_type']='';
        $data['group_type']='';
        $data['group_name']='';
        $data['parent_group_type']='';
		if($record!=NULL){
			$data['group_type']=$record->group_type;
			$data['group_name']=$record->group_name;
			$data['account_type']=$record->account_type;
            $data['parent_group_type']=$record->parent_group;
		}
		return $data;
	}
	function get_posts(){
		$data['mode']=$this->input->post('mode');
		$data['account_type']=$this->input->post('account_type');
		$data['group_type']=$this->input->post('group_type');
		$data['group_name']=$this->input->post('group_name');
		$data['parent_group_type']=$this->input->post('parent_group_type');
        return $data;
	}        
    function _set_rules(){	
		 $this->form_validation->set_rules('account_type','Account Type', 'required|trim');
		 $this->form_validation->set_rules('group_type','Group Type', 'required|trim');
	}
    function delete($id){
		if(!allow_mod2('_10065'))return false;   
		$id=urldecode($id);
	 	$this->gl_report_groups_model->delete($id);
		$this->syslog_model->add($id,"coa_group","delete");

	 	$this->browse();
	}
	function view($id,$message=null){
		if(!allow_mod2('_10060'))return false;   
		$id=urldecode($id);
		 $data['id']=$id;
		 $rst=$this->gl_report_groups_model->get_by_id($id)->row();
         if(count($rst)){
            $data['account_type']=$rst->account_type;
            $data['group_type']=$rst->group_type;
            $data['group_name']=$rst->group_name;
            $data['parent_group_type']=$rst->parent_group_type;
         }
		 $data['mode']='view';
         $data['message']=$message;
         $data['account_type_list']=$this->chart_of_accounts_model->account_type_list();
         $this->template->display_form_input($this->file_view,$data,'');
	}        
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('group_type');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();           
			unset($data['mode']);           
			$this->gl_report_groups_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"coa_group","edit");

            $this->browse();
		} else {
			$message='Error Update';
     		$this->view($id,$message);		
		}	  	
	}        
	function select($group=''){
		$group=urldecode($group);
		$sql="select group_type,group_name from gl_report_groups where 1=1";
		if($group!="")$sql.=" and group_type like '$group%'";
		echo datasource($sql);	
	}
}
