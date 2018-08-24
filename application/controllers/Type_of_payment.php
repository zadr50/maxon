<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Type_of_payment extends CI_Controller {
    private $limit=10;
   	private $table_name='type_of_payment';
    private $sql="select type_of_payment,discount_percent,discount_days,days
                from type_of_payment";
    private $file_view='admin/type_of_payment';
	private $controller="type_of_payment";
	private $primary_key="type_of_payment";
	function __construct()
	{
		parent::__construct();        
       
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('type_of_payment_model');
		$this->load->model("syslog_model");
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
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->type_of_payment_model->save($data);
            $message='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"type_of_payment","add");
			echo json_encode(array("success"=>true,"msg"=>$message));
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 
		 $data=$this->set_defaults(); 
		 $this->_set_rules();
 		 $id=$this->input->post('type_of_paymnet');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$data['type_of_payment']; 
			unset($data['type_of_paymnet']);                       
			$this->type_of_payment_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"type_of_payment","edit");
			echo json_encode(array("success"=>true,"msg"=>$message));
		} else {
			$message='Error Update';
         	$this->view($id,$message);		
		}	  
	}
	function save(){
		$mode=$this->input->post('mode');
		if($mode=="add"){
			$this->add();			
		} else {
			$this->update();
		}
	}	
	function view($id,$message=null){
		 $id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->type_of_payment_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
         $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('type_of_payment','type_of_payment', 'required|trim');
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
	function browse($offset=0,$limit=10,$order_column='type_of_payment',$order_type='asc')
	{
        $data['caption']="DAFTAR TERMIN PEMBAYARAN";
		$data['controller']='type_of_payment';
		$data['fields_caption']=array('Termin Pembayaran','Discount%','Discount Day','Days');
		$data['fields']=array('type_of_payment','discount_percent','discount_days','days');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='type_of_payment';
		
		$this->load->library('search_criteria');
		$faa[]=criteria("Nama","sid_type");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        $sql=$this->sql." where type_of_payment like '$nama%'";
        echo datasource($sql);
    }
	function delete($id){
		$id=urldecode($id);
	 	$this->type_of_payment_model->delete($id);
		$this->syslog_model->add($id,"type_of_payment","delete");

	 	$this->browse();
	}
	
}