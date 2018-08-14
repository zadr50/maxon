<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Aktiva_group extends CI_Controller {
    private $limit=10;
    private $table_name='fa_asset_group';
    private $sql="select id,name,at_cost,accum_depn,profit_on_sale,loss_on_sale,cash_bank
            ,depn_method,useful_lives,salvage_value,expenses_depn
            from fa_asset_group
                ";
    private $file_view='aktiva/asset_group';
    private $primary_key='id';
    private $controller='aktiva_group';
    
	function __construct()
	{
		parent::__construct();

		if(!$this->access->is_login())redirect(base_url());
		
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('aktiva_group_model');
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
		$this->load->model('table_model');
		$table_def=$this->table_model->table_def('fa_asset_group');
		$this->template->display_form_input($this->file_view,$data,'');
	}
	function save(){
		$mode=$this->input->post("mode");
		$this->_set_rules();
		$data=$this->get_posts();
 		$id=$data['id'];
		$data['at_cost']=$this->acc_id($data['at_cost']);
		$data['accum_depn']=$this->acc_id($data['accum_depn']);
		$data['profit_on_sale']=$this->acc_id($data['profit_on_sale']);
		$data['loss_on_sale']=$this->acc_id($data['loss_on_sale']);
		$data['expenses_depn']=$this->acc_id($data['expenses_depn']);
		$data['cash_bank']=$this->acc_id($data['cash_bank']);
		$data['message']='Save Success';
		$data['mode']='view';
		if ($this->form_validation->run()=== TRUE){
			unset($data['message']);
			unset($data['mode']);
			if($mode=="add"){
				$this->aktiva_group_model->save($data);
				$data['message']=mysql_error();
				if($data['message']==''){
					$data['mode']='view';					
					$data['message']='Data sudah disimpan.';
				} else {
					$data['mode']='add';
				}
			} else {
				$this->aktiva_group_model->update($id,$data);
				$data['message']=mysql_error();
				if($data['message']==''){
					$data['message']='Data sudah disimpan.';
				}
				$data['mode']='view';
			}
			
		} else {
			$data['message']='Error Validation.';
		}
		
		$data['at_cost']=account($data['at_cost']);
		$data['accum_depn']=account($data['accum_depn']);
		$data['profit_on_sale']=account($data['profit_on_sale']);
		$data['loss_on_sale']=account($data['loss_on_sale']);
		$data['expenses_depn']=account($data['expenses_depn']);
		$data['cash_bank']=account($data['cash_bank']);
		
		$this->template->display_form_input($this->file_view,$data,'');


	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->aktiva_group_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
		 $data['at_cost']=account($data['at_cost']);
		$data['accum_depn']=account($data['accum_depn']);
		$data['profit_on_sale']=account($data['profit_on_sale']);
		$data['loss_on_sale']=account($data['loss_on_sale']);
		$data['expenses_depn']=account($data['expenses_depn']);
		$data['cash_bank']=account($data['cash_bank']);

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
		$data['fields_caption']=array('Kode Group','Nama Group','Akun Biaya','Akun Depresisi','Akun Laba'
		,'Akun Rugi','Akun Bank','Metode Susut','Jangka Wakut','Nilai Residu','Akun Biaya');
		$data['fields']=array('id','name','at_cost','accum_depn','profit_on_sale','loss_on_sale','cash_bank'
            ,'depn_method','useful_lives','salvage_value','expenses_depn');
		$data['field_key']='id';
		$data['caption']='DAFTAR KELOMPOK AKTIVA TETAP';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_number");
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
		if($this->input->get('sid_number')!='')$sql.=" and id like '".$this->input->get('sid_number')."%'";	
		if($this->input->get('sid_nama')!='')$sql.=" name like '".$this->input->get('sid_nama')."%'";
        $sql.=" limit $offset,$limit";
		
        echo datasource($sql);
    }	 
	function delete($id){
		 $id=urldecode($id);
	 	$this->aktiva_group_model->delete($id);
	 	$this->browse();
	}
	function find($nomor){
		 $nomor=urldecode($nomor);
		$query=$this->db->query("select name,depn_method,useful_lives from fa_asset_group where id='$nomor'");
		echo json_encode($query->row_array());
 	}
	function acc_id($account){
		 $account=urldecode($account);
		$this->load->model('chart_of_accounts_model');
		$data=explode(" - ", $account);
		$coa=$this->chart_of_accounts_model->get_by_id($data[0])->row();
		if($coa){
			return $coa->id;
		} else {
			return 0;
		}
	}

}
