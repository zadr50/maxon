<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Rekening extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='kop_tabungan';
	private $sql="select t.no_simpanan, t.no_anggota,a.nama, t.tanggal, t.jenis 
	 from kop_tabungan t left join kop_anggota a on a.no_anggota=t.no_anggota ";

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
	 	$this->load->model("koperasi/rekening_model");
	 	$this->load->model("koperasi/jenis_simpanan_model");
		
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
		$data['tanggal']= date("Y-m-d H:i:s");
		$data['anggota']='';
		$data['jenis_list']=$this->jenis_simpanan_model->item_list();
		if($record==NULL)$data['no_simpanan']=$this->nomor_bukti();
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
			$id=$this->input->post("no_simpanan");
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$id=$this->nomor_bukti();
				$data['no_simpanan']=$id;
				$ok=$this->rekening_model->save($data);
			} else {
				$ok=$this->rekening_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"no_simpanan"=>$id));} 
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
		 $this->form_validation->set_rules('no_anggota','Isi nomor anggota', 'required');
		 $this->form_validation->set_rules('no_simpanan','Isi nomor rekening simpanan', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR REKENING';
		$data['controller']='koperasi/rekening';		
		$data['fields_caption']=array('Nomor','Tanggal','Nama Anggota','Kelompok','Alamat','Kota');
		$data['fields']=array('no_simpanan','tanggal','nama','group_type','street','city');
		$data['field_key']='no_simpanan';
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
			$sql.=" and no_simpan='$s'";
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
