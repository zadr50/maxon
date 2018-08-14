<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Gudang extends CI_Controller {
    private $limit=10;
    private $table_name='shipping_locations';
    private $sql="select location_number,address_type  
                from shipping_locations
                ";
    private $file_view='inventory/gudang';

	function __construct()
	{
		parent::__construct();        
       
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('shipping_locations_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		if($record==NULL){
			$data['location_number']='';
			$data['address_type']='';
		} else {
			$data['location_number']=$record->location_number;
			$data['address_type']=$record->address_type;
		}
		return $data;
	}
	function index()
	{	
		if(!allow_mod2('_80030'))return false;   
        $this->browse();
	}
	function get_posts(){
		$data['location_number']=$this->input->post('location_number');
		$data['address_type']=$this->input->post('address_type');
		return $data;
	}
	function add()
	{
		if(!allow_mod2('_80031'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->shipping_locations_model->save($data);
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
			$this->shipping_locations_model->update($id,$data);
			$message='Update Success';
			$this->syslog_model->add($id,"gudang","edit");

			$this->browse();
		} else {
			$message='Error Update';
         		$this->view($id,$message);		
		}	  	
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80030'))return false;   
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->shipping_locations_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
                 $data['message']=$message;
                 $this->template->display_form_input('inventory/gudang',$data,'');

	
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
	function browse($offset=0,$limit=10,$order_column='item_number',$order_type='asc')
	{
            $caption="DAFTAR GUDANG";
            $data['_content']=browse($this->sql,$caption,'gudang',$offset,$limit,'kode',500,300);
            $url='';
            $this->session->set_userdata('_right_menu', $url);
            $this->template->display_browse2($data);
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        $sql=$this->sql." where location_number like '".$nama."%'";
        $query=$this->db->query($sql);
        $i=0; 
        foreach($query->result_array() as $row){
            $rows[$i++]=$row;
        };
        $data['total']=$i;
        $data['rows']=$rows;
       
        echo json_encode($data);
       
    }
 
	function delete($id){
		if(!allow_mod2('_80033'))return false;   
		$id=urldecode($id);
	 	$this->shipping_locations_model->delete($id);
		$this->syslog_model->add($id,"gudang","delete");

	 	$this->browse();
	}
	
}
