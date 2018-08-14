<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Pinjaman extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='kop_pinjaman';
	private $sql="select * from kop_pinjaman";

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
                
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
	 	$this->load->model("koperasi/pinjaman_model");
		$this->load->model("koperasi/jenis_pinjaman_model");
		$this->load->model("koperasi/anggota_model");
		
	}
	function nomor_bukti($add=false)
	{
		$key="Koperasi Pinjaman Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!KPLN~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!KPLN~$00001');
				$rst=$this->pinjaman_model->get_by_id($no)->row();
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
		$data['nama']='';
		$data['tanggal']= date("Y-m-d H:i:s");
		$data['tanggal_tempo']=$data['tanggal'];
		$data['jenis_pinjaman_list']=$this->jenis_pinjaman_model->item_list();
		if($record==NULL)$data['no_pinjaman']=$this->nomor_bukti();
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('koperasi/pinjaman',$data);
	}
	function save(){
		 
			$data=$this->input->post();
			$id=$this->input->post("no_pinjaman");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$id=$this->nomor_bukti();
				$data['no_pinjaman']=$id;
				$ok=$this->pinjaman_model->save($data);
			} else {
				$ok=$this->pinjaman_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"no_pinjaman"=>$id));} 
			else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
		    
		  
	}
	function view($id,$message=null){

		 $id=urldecode($id);
		 $model=$this->pinjaman_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);

		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $data['nama']=$this->anggota_model->info($data['no_anggota']);
		 $this->template->display_form_input('koperasi/pinjaman',$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('loan_number','Isi nomor pinjaman', 'required');
		 $this->form_validation->set_rules('nip','Isi NIP Pegawai', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR PINJAMAN  ANGGOTA';
		$data['controller']='koperasi/pinjaman';		
		$data['fields_caption']=array('Nomor','No Anggota','Nama','Jenis','Tanggal','Jml Pinjaman');
		$data['fields']=array('no_pinjaman','no_anggota','nama','jenis_pinjaman','tanggal','jumlah');
		$data['field_key']='no_pinjaman';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select l.no_pinjaman,l.no_anggota,e.nama, l.jenis_pinjaman,l.tanggal,l.jumlah 
		from kop_pinjaman l
		left join kop_anggota e on e.no_anggota=l.no_anggota 
		where 1=1";
		$s=$this->input->get('sid_nomor');		
		if($s!=''){
			$sql.=" and l.no_pinjaman='$s'";
		} else {
			$s=$this->input->get('sid_nama');if($s!='')$sql.=" and e.nama like '$s%'";
		}			
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->load->model("pinjaman_model");
	 	$this->pinjaman_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select nama,nip,dept,divisi	from employee 
		where nama like '$search%')
		order by nama limit 100";
		echo datasource($sql);
	}
	function cicilan($cmd,$id="") {
		$id=urldecode($id);
		if($cmd=="list") {
			$sql="select tanggal_jth_tempo,awal,pokok,bunga,angsuran,akhir, 
			payment_no,comments,no_pinjaman,id 
			from kop_cicilan	
			where no_pinjaman='$id'
			order by tanggal_jth_tempo";
			echo datasource($sql);
		}
	}
}
