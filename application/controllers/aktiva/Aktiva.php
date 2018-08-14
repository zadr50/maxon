<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Aktiva extends CI_Controller {
    private $limit=10;
    private $table_name='fa_asset';
    private $sql="select id,description,group_id,location_id,acquisition_date,
			depn_method,useful_lives
            from fa_asset
                ";
    private $file_view='aktiva/asset';
    private $primary_key='id';
    private $controller='aktiva';
    
	function __construct()
	{
		parent::__construct();

		if(!$this->access->is_login())redirect(base_url());
        
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('aktiva_model');
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            return $data;
	}
	function index()
	{	
            $this->browse();
	}
	function get_posts(){
            $data=  data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$this->load->model('aktiva_group_model');
		$data['group_list']=$this->aktiva_group_model->lookup();
		
		$this->load->model('table_model');
		$table_def=$this->table_model->table_def('fa_asset_group');
		$this->template->display_form_input($this->file_view,$data,'');
	}
	function save(){
		$this->load->model('aktiva_group_model');
		$mode=$this->input->post("mode");
		$this->_set_rules();
		$data=$this->get_posts();
 		$id=$data['id'];
		$data['message']='Save Success';
		$data['mode']='view';
		if ($this->form_validation->run()=== TRUE){
			unset($data['message']);
			unset($data['mode']);
			unset($data['group_list']);
			if($mode=="add"){
				$this->aktiva_model->save($data);
				$data['message']=mysql_error();
				if($data['message']==''){
					$data['mode']='view';					
					$data['message']='Data sudah disimpan.';
				} else {
					$data['mode']='add';
				}
			} else {
				$this->aktiva_model->update($id,$data);
				$data['message']=mysql_error();
				if($data['message']==''){
					$data['message']='Data sudah disimpan.';
				}
				$data['mode']='view';
			}
			
		} else {
			$data['message']='Error Validation.';
		}
		$data['group_list']=$this->aktiva_group_model->lookup();

		$this->template->display_form_input($this->file_view,$data,'');


	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->aktiva_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
		$this->load->model('aktiva_group_model');
		$data['group_list']=$this->aktiva_group_model->lookup();
         $this->template->display_form_input($this->file_view,$data,'');
	}

	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules($this->primary_key,'Kode', 'required|trim');
	}
	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'date format is not valid. yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']='aktiva/'.$this->controller;
		$data['fields_caption']=array('Kode','Nama Aktiva','Kelompok','Lokasi','Tgl Beli'
		,'Metode Susut','Waktu');
		$data['fields']=array( 'id','description','group_id','location_id','acquisition_date','depn_method'
            ,'useful_lives');
		$data['field_key']='id';
		$data['caption']='DAFTAR AKTIVA TETAP';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_number");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
		if($this->input->get('sid_number')!='')$sql.=" and id like '".$this->input->get('sid_number')."%'";	
		if($this->input->get('sid_nama')!='')$sql.=" description like '".$this->input->get('sid_nama')."%'";
        //$sql.=" limit $offset,$limit";
        if($this->input->get('tb_search')!='')$sql.=" and description like '%".$this->input->get('tb_search')."%'";
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        		
        
        echo datasource($sql);
    }	 
	function delete($id){
		 $id=urldecode($id);
	 	$this->aktiva_model->delete($id);
	 	$this->browse();
	}
	function find($nomor){
		 $id=urldecode($id);
		$query=$this->db->query("select description,depn_method,useful_lives from fa_asset where id='$nomor'");
		echo json_encode($query->row_array());
 	}
    function rpt($id){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;		 
    	 switch ($id) {
			 case 'mutasi':
				 $data['criteria1']=true;
				 $data['label1']='Rekening';
				 $data['text1']='';
				 break;			 
			 default:
				 break;
		 }
		 $rpt='aktiva/rpt/'.$id;
		 $data['rpt_controller']=$rpt;
		 
		if(!$this->input->post('cmdPrint')){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view('aktiva/rpt/'.$id);
		}
   }	
   function reports(){
		$this->template->display('aktiva/menu_reports');
	}
	function daftar_saldo(){
		$sql="select fa.description,fa.useful_lives,0 as amount
		from fa_asset fa  ";
		echo datasource($sql);			
	}
	function select($account=''){
		$account=urldecode($account);
		$sql="select description,id from fa_asset where 1=1";
		if($account!="")$sql.=" and (description like '$account%' or description like '%$account%')";
		$sql.=" order by description";
		echo datasource($sql);	
	}
}
