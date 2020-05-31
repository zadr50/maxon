<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Project extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='gl_projects';
	private $sql="select kode,keterangan,client,lokasi,tgl_mulai,tgl_selesai,person_in_charge
	    from gl_projects ";

	function __construct()
	{
		parent::__construct();        
        
        
		if(!$this->access->is_login())header("location:".base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('customer_model');
        $this->load->model('chart_of_accounts_model');
        $this->load->model('type_of_payment_model');
        $this->load->model('salesman_model');
        $this->load->model('project/gl_projects_model');
	}
	function set_defaults($record=NULL){
//        $data=data_table("select * from gl_projects limit 1",$record,true); 
        $data=data_table('gl_projects',$record); 
        
		$data['mode']='';
		$data['message']='';
        $data['termin_list']=$this->type_of_payment_model->select_list();
		$data['salesman_list']=$this->salesman_model->select_list();
		
		$data['lookup_status_project']=$this->list_of_values->render(
			array(
				'dlgBindId'=>'status_project',
				'sysvar_lookup'=>'status_project'
			));		
		$data['lookup_category_project']=$this->list_of_values->render(
			array(
				'dlgBindId'=>'category_project',
				'sysvar_lookup'=>'category_project'
			));		
			
		return $data;
	}
	function index()
	{	
        $this->browse();
	}
	function get_posts(){
        $data=data_table_post($this->table_name);
		return $data;
	}
	function add()
	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input('project/project',$data);
	}
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("kode");
		$mode=$data["mode"];
	 	unset($data['mode']); 
		if($mode=="add"){ 
			$ok=$this->gl_projects_model->save($data);
		} else {
			$ok=$this->gl_projects_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}
	function acc_id($account){
		$account=urldecode($account);
		$data=explode(" - ", $account);
		$coa=$this->chart_of_accounts_model->get_by_id($data[0])->row();
		if($coa){
			return $coa->id;
		} else {
			return 0;
		}
	}
        
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('customer_number');
		$data['finance_charge_acct']=$this->acc_id($data['finance_charge_acct']);	
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->customer_model->update($id,$data);
            $message='Success';
            $this->browse();
		} else {
            $message='Error';
     		$this->view($id,$message);		
		}
	}
	
	function view($id='',$message=null){
		 $id=urldecode($id);
		 if($id==''){
			 
			 $this->browse();
		 } else {
			 $model=$this->gl_projects_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			 $data['id']=$id;
			 $data['mode']='view';
			 $data['message']=$message; 
			 $this->template->display_form_input('project/project',$data);
		 }
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('customer_number','Customer Number', 'required|trim');
		 $this->form_validation->set_rules('company','Customer Name',	 'required');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='kode',$order_type='asc')
	{
        $data['caption']='DAFTAR MASTER PROYEK';
		$data['controller']='project/project';		
		$data['fields_caption']=array('Kode Proyek','Nama Proyek','Lokasi','Mulai','Selesai','Person');
		$data['fields']=array('kode','keterangan','lokasi','tgl_mulai','tgl_selesai','person_in_charge');
		$data['field_key']='kode';
		
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Kode","sid_kode");
		$data['list_info_visible']=false;
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql." where 1=1";
		if($this->input->get('sid_kode')!='')$sql.=" and kode='".$this->input->get('sid_kode')."'";
		if($this->input->get('sid_nama')!='')$sql.=" and keterangan like '".$this->input->get('sid_nama')."%'";
		
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
	 	$this->gl_projects_model->delete($id);
	 	$this->browse();
	} 
	 
	function grafik_saldo(){


		$phpgraph = $this->load->library('PhpGraph');		
		$cfg['width'] = 800;
		$cfg['height'] = 200;
		$cfg['compare'] = false;
		$cfg['disable-values']=1;
		$chart_type='vertical-simple-column-graph';
		$data=$this->customer_model->saldo_piutang_summary();
		$file="tmp/".$chart_type.".png";
		$this->phpgraph->create_graph($cfg, $data,$chart_type,'Saldo Piutang Pelanggan',$file);
		echo '<img src="'.base_url().'/'.$file.'"/>';
		echo '*Display only top ten customer';
		
		
		
	}	
	function select($search=''){
		$search=urldecode($search);
		$sql="select kode,keterangan from gl_projects where  (keterangan like '$search%' or kode like '$search%')
		order by keterangan";
	 
 		echo datasource($sql);
	}
	function filter($search=''){
		$search=urldecode($search);
		echo datasource('select kode,keterangan from gl_projects');
	}
	function list_info($offset=0){
		if(isset($_GET['offset'])){
			$offset=$_GET['offset'];
		}
		$data['offset']=$offset;
		$this->load->library('search_criteria');

		$faa[]=criteria("Kode","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
	
		$data['criteria']=$faa;
		$data['criteria_text']=criteria_text($faa);
		$data['sid_kode']=$this->session->userdata('sid_kode');
		$data['sid_nama']=$this->session->userdata('sid_nama');
		
		$this->template->display_form_input('project/project/info_list',$data);	
	}	
}
