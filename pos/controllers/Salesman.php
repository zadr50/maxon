<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Salesman extends CI_Controller {
    private $limit=10;
    private $table_name='salesman';
    private $sql="select salesman,salestype,commission_rate_1,user_id,lock_report from salesman";

	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('salesman_model');
		$this->load->library("list_of_values");		
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		if($record==NULL){
			$data['salesman']='';
			$data['salestype']='';
			$data['commission_rate_1']='0';
			$data['commission_rate_2']='0';
            $data['lock_report']=0;
			$data['user_id']="";
		} else {
			$data['salesman']=$record->salesman;
			$data['salestype']=$record->salestype;
			$data['commission_rate_1']=$record->commission_rate_1;
			$data['commission_rate_2']=$record->commission_rate_2;
			$data['lock_report']=$record->lock_report;
			$data['user_id']=$record->user_id;
		}
		$setting['dlgBindId']="salestype";
		$setting['dlgCols']=array( 
			array("fieldname"=>"groupid","caption"=>"Kelompok","width"=>"280px")
		);
		$setting['dlgRetFunc']="$('#salestype').val(row.groupid);";
		$data['lookup_salesman_type']=$this->list_of_values->render($setting);

		$setting['dlgBindId']="user_id";
		$setting['dlgCols']=array( 
			array("fieldname"=>"user_id","caption"=>"User Id","width"=>"180px"),
			array("fieldname"=>"username","caption"=>"User Name","width"=>"180px")
		);
		$setting['dlgRetFunc']="$('#user_id').val(row.user_id);";
		$data['lookup_user']=$this->list_of_values->render($setting);
		
		return $data;
	}
	function index()
	{	
		if (!allow_mod2('_30020'))  exit;
        $this->browse();
	}
	function get_posts(){
		$data['salesman']=$this->input->post('salesman');
		$data['salestype']=$this->input->post('salestype');
		$data['commission_rate_1']=$this->input->post('commission_rate_1');
		$data['commission_rate_2']=$this->input->post('commission_rate_2');
		$data['user_id']=$this->input->post('user_id');
		$data['lock_report']=$this->input->post('lock_report');
		return $data;
	}
	function add()
	{
		if (!allow_mod2('_30021'))  exit;
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->salesman_model->save($data);
			$message='update success';
			$this->syslog_model->add($id,"salesman","add");

			$this->browse();		 
		} else {
			$data['mode']='add';
			$this->template->display_form_input('sales/salesman',$data,'');
		}
	}
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post('salesman');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                      
			$this->salesman_model->update($id,$data);
			$message='Update Success';
			$this->syslog_model->add($id,"salesman","edit");

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
		 $model=$this->salesman_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('sales/salesman',$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('salesman','Salesman', 'required|trim');
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
	
	function search(){$this->browse();}
	
	function browse($offset=0,$limit=10,$order_column='salesman',$order_type='asc')
	{
        $data['caption']="DAFTAR SALESMAN";
		$data['controller']='salesman';
		$data['fields_caption']=array('Salesman','Kelompok','Komisi','User Id','lock_report');
		$data['fields']=array('salesman','salestype','commission_rate_1','user_id','lock_report');
		$data['field_key']='salesman';
		
		$this->load->library('search_criteria');
		$faa[]=criteria("Nama","sid_salesman");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        $sql=$this->sql." where salesman like '".$this->input->get('sid_salesman')."%'";
        echo datasource($sql);       
    }        
	function delete($id){
		if (!allow_mod2('_30023'))  exit;
		$id=urldecode($id);
	 	$this->salesman_model->delete($id);
		$this->syslog_model->add($id,"salesman","delete");

	 	$this->browse();
	}
	function select($search=""){
		$search=urldecode($search);
		echo datasource("select salesman from salesman");
	}
	function kelompok($cmd,$id='')
	{
		if($cmd=='save'){
			$data=$this->input->post();
			if($data['mode']=='add'){
				unset($data['mode']);
				$ok=save_data_table('salesman_group',$data);
			}
			if($data['mode']='view'){
				unset($data['mode']);
				$id=$data['groupid'];
				unset($data['groupid']);
				$ok=save_data_table('salesman_group',$data,$id,'groupid');				
			}
			$this->browse_kelompok();		 
		}
		if($cmd=='browse'){
			$this->browse_kelompok();		 			
		}
		if($cmd=='add'){
			$data['mode']='add';
			$data['groupid']='';
			$data['komisiprc']=0;
			$data['remarks']='';
			$this->template->display_form_input('sales/salesman_group',$data,'');
		}
		if($cmd=="view"){
			$id=urldecode($id);
			$data=$this->db->where('groupid',$id)->get('salesman_group')->row_array();
			$data['mode']='view';
			$data['message']='';
			$this->template->display_form_input('sales/salesman_group',$data,'');
		}
		if($cmd=="delete"){
			$id=urldecode($id);
			$this->db->where("groupid",$id)->delete('salesman_group');
			$this->browse_kelompok();
			
		}
		
	}
	function browse_kelompok($offset=0,$limit=10,$order_column='groupid',$order_type='asc')
	{
        $data['caption']="DAFTAR KELOMPOK SALESMAN";
		$data['controller']='salesman';
		$data['sub_controller']='kelompok';
		$data['fields_caption']=array('Kelompok','Komisi','Keterangan');
		$data['fields']=array('groupid','komisiprc','remarks');
		$data['field_key']='groupid';
		
		$this->load->library('search_criteria');
		$faa[]=criteria("Nama","sid_group");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);
    }
    function browse_data_kelompok($offset=0,$limit=10,$nama=''){
        $sql="select * from salesman_group where groupid like '".$this->input->get('sid_group')."%'";
        echo datasource($sql);       
    }        
	
	
}
