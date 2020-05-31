<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Deduct extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='hr_jenis_potongan';
	private $sql="select * from hr_jenis_potongan";

	function __construct()
	{
		parent::__construct();
                 
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
	 	$this->load->model("payroll/jenis_potongan_model");
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
        $this->template->display_form_input('payroll/deduct',$data);
	}
	function save(){		 
		$data=$this->input->post();
		$id=$this->input->post("kode");
		$mode=$data["mode"];
		unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->jenis_potongan_model->save($data);
		} else {
			$ok=$this->jenis_potongan_model->update($id,$data);				
		}
		if($ok){echo json_encode(array("success"=>true,"kode"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->jenis_potongan_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('payroll/deduct',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('kode','Isi kode jenis tunjangan', 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='kode',$order_type='asc')	{
        $data['caption']='DAFTAR JENIS  POTONGAN';
		$data['controller']='payroll/deduct';		
		$data['fields_caption']=array('Kode','Nama Potongan');
		$data['fields']=array('kode','keterangan');
		$data['field_key']='kode';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nomor","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select t.* from hr_jenis_potongan t where 1=1";

		$s=$this->input->get('sid_kode');
		$s2="";
		if($this->input->get('tb_search')){
			$s2=$this->input->get('tb_search');
		}		
		if($s!=''){
			$sql.=" and kode='$s'";
		} else {
			$s=$this->input->get('sid_nama');
			if($s2!=""){
				$s=$s2;
			}
			if($s!='')$sql.=" and t.keterangan like '%$s%'";
		}			
		$sql.=" order by t.kode";

		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
		
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->jenis_potongan_model->delete($id);
	 	$this->browse();
	}
}
