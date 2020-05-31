<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Anggota extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='kop_anggota';
	private $sql="select * from kop_anggota";

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
	 	$this->load->model("koperasi/anggota_model");
	 	$this->load->model("koperasi/kelompok_model");
	}
	function nomor_bukti($add=false)
	{
		$key="Koperasi Anggota Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!KAN~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!KAN~$00001');
				$rst=$this->anggota_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
			
		}
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
		if($record==NULL){
			$data['no_anggota']=$this->nomor_bukti();
			$data['join_date']= date("Y-m-d H:i:s");
		} 
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('koperasi/anggota',$data);
	}
	function save(){
			$data=$this->input->post();
		 
			$id=$this->input->post("no_anggota");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$id=$this->nomor_bukti();
				$data['no_anggota']=$id;
				$ok=$this->anggota_model->save($data);
			} else {
				$ok=$this->anggota_model->update($id,$data);				
			}
			
			 
			if($ok){echo json_encode(array("success"=>true,"no_anggota"=>$id));} 
			else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
		    
		  
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->anggota_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('koperasi/anggota',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('no_anggota','Isi nomor anggota', 'required');
		 $this->form_validation->set_rules('nama','Isi nama anggota', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR ANGGOTA';
		$data['controller']='koperasi/anggota';		
		$data['fields_caption']=array('Nomor','Nama Anggota','Kelompok','Alamat','Kota');
		$data['fields']=array('no_anggota','nama','group_type','street','city');
		$data['field_key']='no_anggota';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("NIP","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select no_anggota,nama,street,city,group_type 
		from kop_anggota 
		where 1=1";
		$s=$this->input->get('sid_nomor');		
		if($s!=''){
			$sql.=" and no_anggota='$s'";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and nama like '$s%'";
		}			
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->load->model("koperasi/anggota_model");
	 	$this->anggota_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select nama,no_anggota,join_date	from kop_anggota 
		where nama like '$search%'
		order by nama limit 100";
 
		echo datasource($sql);
	}
}
