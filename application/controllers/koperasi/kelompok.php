<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Kelompok extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='kop_kelompok';
	private $sql="select * from kop_kelompok";

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
	 	$this->load->model("koperasi/kelompok_model");
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
        $this->template->display_form_input('koperasi/kelompok',$data);
	}
	function save(){
			$data=$this->input->post();
			$id=$this->input->post("kode");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$data['kode']=$id;
				$ok=$this->kelompok_model->save($data);
			} else {
				$ok=$this->kelompok_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"kode"=>$id));} 
			else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
		    
		  
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->kelompok_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('koperasi/kelompok',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('no_anggota','Isi kode kelompok', 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='kode',$order_type='asc')	{
        $data['caption']='DAFTAR KELOMPOK ANGGOTA';
		$data['controller']='koperasi/kelompok';		
		$data['fields_caption']=array('Kode','Kelompok');
		$data['fields']=array('kode','kelompok');
		$data['field_key']='kode';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_kode");
		$faa[]=criteria("Kode","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select kode,kelompok from kop_kelompok 
		where 1=1";
		$s=$this->input->get('sid_kode');		
		if($s!=''){
			$sql.=" and kode='$s'";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and kelompok like '$s%'";
		}			
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->load->model("koperasi/kelompok_model");
	 	$this->kelompok_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select kelompok,kode from kop_kelompok
		where kelompok like '$search%')
		order by kelompok limit 100";
		
		echo datasource($sql);
	}
}
