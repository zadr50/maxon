<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Jenis_simpanan extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='kop_jenis_simpanan';
	private $sql="select * from kop_jenis_simpanan";

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
	 	$this->load->model("koperasi/jenis_simpanan_model");
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
        $this->template->display_form_input('koperasi/jenis_simpanan',$data);
	}
	function acc_id($account){
		$data=explode(" - ", $account);
		$coa=$this->chart_of_accounts_model->get_by_id($data[0])->row();
		if($coa){
			return $coa->id;
		} else {
			return 0;
		}
	}
		
	function save(){
		 
			$data=$this->input->post();
			$id=$this->input->post("nama");
			$mode=$data["mode"];
			$data['coa_ag_kas']=$this->acc_id($data['coa_ag_kas']);
			$data['coa_ag_simpanan']=$this->acc_id($data['coa_ag_simpanan']);
			$data['coa_ag_admin']=$this->acc_id($data['coa_ag_admin']);
			$data['coa_ag_beban_bunga']=$this->acc_id($data['coa_ag_beban_bunga']);
			$data['coa_nag_kas']=$this->acc_id($data['coa_nag_kas']);
			$data['coa_nag_simpanan']=$this->acc_id($data['coa_nag_simpanan']);
			$data['coa_nag_admin']=$this->acc_id($data['coa_nag_admin']);
			$data['coa_nag_beban_bunga']=$this->acc_id($data['coa_nag_beban_bunga']);
			 
		 	unset($data['mode']);
			if($mode=="add"){ 
				$data['nama']=$id;
				$ok=$this->jenis_simpanan_model->save($data);
			} else {
				$ok=$this->jenis_simpanan_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"nama"=>$id));} 
			else {echo json_encode(array("msg"=>"Error ".mysql_error()));}
		    
		  
	}
	function view($id='',$message=null){
	 
			 $id=urldecode($id);
			 $model=$this->jenis_simpanan_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			$data['coa_ag_kas']=account($data['coa_ag_kas']);
			$data['coa_ag_simpanan']=account($data['coa_ag_simpanan']);
			$data['coa_ag_admin']=account($data['coa_ag_admin']);
			$data['coa_ag_beban_bunga']=account($data['coa_ag_beban_bunga']);
			$data['coa_nag_kas']=account($data['coa_nag_kas']);
			$data['coa_nag_simpanan']=account($data['coa_nag_simpanan']);
			$data['coa_nag_admin']=account($data['coa_nag_admin']);
			$data['coa_nag_beban_bunga']=account($data['coa_nag_beban_bunga']);
			
			 $data['id']=$id;
			 $data['mode']='view';
			 $data['message']=$message;
			 $this->template->display_form_input('koperasi/jenis_simpanan',$data);
	 
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('nama','Isi nama jenis simpanan', 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='loan_number',$order_type='asc')	{
        $data['caption']='DAFTAR JENIS  SIMPANAN';
		$data['controller']='koperasi/jenis_simpanan';		
		$data['fields_caption']=array('Nama','Jenis','Jangka Waktu','Keterangan');
		$data['fields']=array('nama','jenis','jangka_waktu','keterangan');
		$data['field_key']='nama';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql="select nama,jenis,jangka_waktu,keterangan from kop_jenis_simpanan 
		where 1=1";
		$s=$this->input->get('sid_nama');		
		if($s!=''){
			$sql.=" and nama like '$s%'";
		}			
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->load->model("jenis_simpanan_model");
	 	$this->jenis_simpanan_model->delete($id);
	 	$this->browse();
	}
	function select($search=''){
		$search=urldecode($search);
		$sql="select nama,jenis  
		where nama like '$search%')
		order by nama limit 100";
		echo datasource($sql);
	}
}
