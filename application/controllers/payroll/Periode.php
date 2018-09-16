<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Periode extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='hr_period';
	private $sql="select * from hr_period";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
		$this->load->model('payroll/periode_model');
	}
	
	function index(){$this->browse();}

	function add()	{
	 	$this->_set_rules();
		$data['mode']='add';
		$data['period']=date("Y-m");
		$data['period_name']=date("M");
		$data['from_date']=date("Y-m-d");
		$data['to_date']=date("Y-m-d");
		$data['status']="0";
        $this->template->display_form_input('payroll/periode',$data);
	}
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("period");
		$mode=$data["mode"];
		unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->periode_model->save($data);
		} else {
			$ok=$this->periode_model->update($id,$data);				
		}
		if($ok){echo json_encode(array("success"=>true,"period"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function update(){
		$data=$this->input->post();
		$id=$data['period'];
		$ok=$this->periode_model->update($id,$data);				
		if($ok){echo json_encode(array("success"=>true,"period"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function view($id,$message=null){

		 $id=urldecode($id);
		 $model=$this->periode_model->get_by_id($id)->row();
		 $data['period']=$model->period;
		 $data['period_name']=$model->period_name;
		 $data['from_date']=$model->from_date;
		 $data['to_date']=$model->to_date;
		 $data['status']=$model->status;
		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('payroll/periode',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('period','Isi kode periode YYYY-MM', 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR PERIODE  PENGGAJIAN';
		$data['controller']='payroll/periode';		
		$data['fields_caption']=array('Period','Description','Tanggal Awal','Tanggal Akhir','Divisi','Status');
		$data['fields']=array('period','period_name','from_date','to_date','status');
		$data['field_key']='period';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Period","sid_period");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=12,$nama=''){
		$sql="select p.* from hr_period p ";
        
        $sql=$this->sql." where 1=1";
        if($this->input->get('sid_period')!='')$sql.=" and year_id like '".$this->input->get('sid_period')."%'";
        if($this->input->get('tb_search')!='')$sql.=" and year_id like '%".$this->input->get('tb_search')."%'";
 
        $sql=$this->sql." order by period";
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->load->model("payroll/period_model");
	 	$this->period_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select period,period_name,from_date,to_date	from hr_period 
		where period_name like '$search%')
		order by nama limit 100";
		echo datasource($sql);
	}
}
