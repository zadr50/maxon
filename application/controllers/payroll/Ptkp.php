<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Ptkp extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='hr_ptkp';
	private $sql="select kode,keterangan,jumlah from hr_ptkp";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
	 	 $this->load->model("payroll/ptkp_model");
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
        $this->template->display_form_input('payroll/ptkp',$data);
	}
	function save(){
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->input->post();
			$id=$this->input->post("kode");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$ok=$this->ptkp_model->save($data);
			} else {
				$ok=$this->ptkp_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"status"=>$id));} 
			else {echo json_encode(array("msg"=>"Error 1".mysql_error()));}
		 }  
		 else {echo json_encode(array("msg"=>"Error 2".validation_errors()));}
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->ptkp_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['kode']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('payroll/ptkp',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('kode','Isi kode', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')	{
        $data['caption']='DAFTAR KODE PTKP';
		$data['controller']='payroll/ptkp';		
		$data['fields_caption']=array('Kode','Keterangan','Ptkp','Id');
		$data['fields']=array('kode','keterangan','jumlah');
		$data['field_key']='kode';
        $data['fields_format_numeric']=array("jumlah");
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
	 	$this->ptkp_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select kode,keterangan,jumlah from hr_ptkp 
		where kode like '$search%')
		order by kode limit 100";
		echo datasource($sql);
	}
}
