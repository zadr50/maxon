<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Inventory_class extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_class';
    private $sql="select kode,class
                from inventory_class
                ";
    private $file_view='inventory/inventory_class';
	function __construct()
	{
		parent::__construct();        
         
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_class_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		if($record==NULL){
			$data['kode']='';
			$data['class']='';
		} else {
			$data['kode']=$record->kode;
			$data['class']=$record->class;
		}
		return $data;
	}
	function index()
	{	
		if(!allow_mod2('_80010'))return false;   
        $this->browse();
	}
	function get_posts(){
		$data['kode']=$this->input->post('kode');
		$data['class']=$this->input->post('class');
		return $data;
	}
	function add()
	{
		if(!allow_mod2('_80010'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->inventory_class_model->save($data);
			$data['mode']='view';
			$this->browse();
		} else {
			$data['mode']='add';
			$this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 	 $data=$this->set_defaults(); 
		 $this->_set_rules();
 		 $id=$this->input->post('kode');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                      
			$this->inventory_class_model->update($id,$data);
			$message='Update Success';
			$this->syslog_model->add($id,"inventory","edit");

			$this->browse();
		} else {
			$message='Error Update';
         		$this->view($id,$message);		
		}	  
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80012'))return false;   
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->inventory_class_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
                 $data['message']=$message;
                 $this->template->display_form_input('inventory/inventory_class',$data,'');

	
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('kode','Kode', 'required|trim');
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
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')
	{
        $data['caption']='DAFTAR KELAS BARANG DAN JASA';
		$data['controller']='inventory_class';		
		$data['fields_caption']=array('Kode','Nama Kelas Barang/Jasa');
		$data['fields']=array('kode','class');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='kode';
		$data['_form']=$this->file_view;
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql." where 1=1";
		if($this->input->get('sid_nama')!='')$sql.=" and inventory_class like '".$this->input->get('sid_nama')."%'";
        echo datasource($sql);		
    }
	function delete($id){
		if(!allow_mod2('_80013'))return false;   
		$id=urldecode($id);
	 	$this->inventory_class_model->delete($id);
		$this->syslog_model->add($id,"inventory","delete");

	 	$this->browse();
	}
	
}
