<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Shift extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='hr_shift';
	private $sql="select kode,time_in,time_out,time_count,time_rest,time_rest_count, 
			different_day from hr_shift";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
	 	 $this->load->model("payroll/shift_model");
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
		$data['_right_menu']="payroll/menu_payroll";
        $this->template->display_form_input('payroll/shift',$data);
	}
	function save(){
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->input->post();
			$id=$this->input->post("kode");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$ok=$this->shift_model->save($data);
			} else {
				$ok=$this->shift_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"status"=>$id));} 
			else {echo json_encode(array("msg"=>"Error 1".mysql_error()));}
		 }  
		 else {echo json_encode(array("msg"=>"Error 2".validation_errors()));}
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->shift_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['kode']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('payroll/shift',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('kode','Isi kode', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')	{
        $data['caption']='DAFTAR KODE SHIFT';
		$data['controller']='payroll/shift';		
		$data['fields_caption']=array('Kode','Time In','Time Out','Time Count','Diff Day','Time Rest','Rest Count');
		$data['fields']=array('kode','time_in','time_out','time_count','different_day','time_rest','time_rest_count');
		$data['field_key']='kode';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql." where 1=1";
		$s=$this->input->get('sid');		
		if($s!=''){
			$sql.=" and kode='$s'";
		} 			
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->shift_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select kode,time_in,time_out from hr_shift 
		where kode like '$search%')
		order by kode limit 100";
		echo datasource($sql);
	}
}
