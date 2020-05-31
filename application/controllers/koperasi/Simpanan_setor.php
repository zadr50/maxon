<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Simpanan_setor extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='kop_tabungan';
	private $sql="select * from kop_tabungan";

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
		$this->load->model('chart_of_accounts_model');
	 	$this->load->model("koperasi/jenis_pinjaman_model");
		$this->load->model("koperasi/tabungan_model");
		
	}
	
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
		$data['sandi']=0;
		if($record==null){
			$data['tanggal']=date("Y-m-d H:i:s");
			$data['petugas']=user_id();
		}
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('koperasi/simpanan_setor',$data);
	}
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("id");
		unset($data['id']);
		$mode=$data["mode"];
	 	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->tabungan_model->save($data);
		} else {
			$ok=$this->tabungan_model->update($id,$data);				
		}
		if($ok){echo json_encode(array("success"=>true,"nama"=>$id));} 
		else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
	}
	function view($id='',$message=null){
	 
		 $id=urldecode($id);
		 $model=$this->tabungan_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('koperasi/simpanan_setor',$data);
	 
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('no_rekening','Isi nomor rekening', 'required');
		 $this->form_validation->set_rules('no_anggota','Isi nomor anggota', 'required');
	}
	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR TRANSAKSI SIMPANAN';
		$data['controller']='koperasi/simpanan_setor';		
		$data['fields_caption']=array('Tanggal','No Rek','No Ang','Jenis','Sandi','Jumlah','Id');
		$data['fields']=array('tanggal','no_rekening','no_anggota','jenis_setor','sandi','jumlah','id');
		$data['field_key']='id';
		$data['fields_format_numeric']=array("jumlah");
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select t.tanggal,t.no_rekening,t.no_anggota,t.jenis_setor,t.sandi,a.nama,t.id
		,t.jumlah,t.jumlah_setor,t.jumlah_admin  
		from kop_tabungan t join kop_anggota a on a.no_anggota=t.no_anggota	
		where 1=1";
		$s=$this->input->get('sid_nama');		
		if($s!=''){
			$sql.=" and a.nama like '$s%'";
		}			
        echo datasource($sql);		
    }
	function history($no_rekening){
		$s="select * from kop_tabungan where no_rekening='$no_rekening' order by tanggal desc limit 50";
		echo datasource($s);
	}
      
	function delete($id){
		$id=urldecode($id);
	 	return $this->tabungan_model->delete($id);
	}
}
