<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Rekening extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='kop_simpanan';
	private $sql="select t.nomor, t.kode_anggota,a.nama, t.tanggal_daftar, t.jenis_simpanan 
	 from kop_simpanan t left join kop_anggota a on a.no_anggota=t.kode_anggota ";

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
	 	$this->load->model("koperasi/rekening_model");
	 	$this->load->model("koperasi/jenis_simpanan_model");
		$this->load->model("koperasi/anggota_model");
		
	}
	function nomor_bukti($add=false)
	{
		$key="Tabungan Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!RKT~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!RKT~$00001');
				$rst=$this->rekening_model->get_by_id($no)->row();
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
			$data['nomor']=$this->nomor_bukti();
			$data['tanggal_daftar']= date("Y-m-d H:i:s");
			$data['anggota']='';
			$data['jenis_simpanan']='';			
		} else {
			$this->anggota_model->get_by_id($data['kode_anggota']);
			$data['anggota']=$this->anggota_model->get_info();
		}
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('koperasi/rekening',$data);
	}
	function save(){
			$data=$this->input->post();
			$id=$this->input->post("nomor");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$id=$this->nomor_bukti();
				$data['nomor']=$id;
				$ok=$this->rekening_model->save($data);
			} else {
				$ok=$this->rekening_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"nomor"=>$id));} 
			else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
		    
		  
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $model=$this->rekening_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input('koperasi/rekening',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('kode_anggota','Isi nomor anggota', 'required');
		 $this->form_validation->set_rules('nomor','Isi nomor rekening simpanan', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR REKENING';
		$data['controller']='koperasi/rekening';		
		$data['fields_caption']=array('Nomor','Tanggal','Nama Anggota','Jenis','Alamat','Kota');
		$data['fields']=array('nomor','tanggal_daftar','nama','jenis_simpanan','street','city');
		$data['field_key']='nomor';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql. " where 1=1";
		$s=$this->input->get('sid_nomor');		
		if($s!=''){
			$sql.=" and nomor='$s'";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and nama like '$s%'";
		}			
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->load->model("koperasi/rekening_model");
	 	$this->rekening_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select no_simpanan,t.no_anggota, p.nama	from kop_tabungan t 
		left join kop_anggota p on p.no_anggota=t.no_anggota
		where nama like '$search%'
		order by nama limit 100";
		 
		echo datasource($sql);
	}
}
