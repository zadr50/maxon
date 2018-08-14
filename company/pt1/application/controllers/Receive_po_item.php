<?php if(!defined('BASEPATH'))
	exit('No direct script access allowd');
 
class Receive_item extends CI_Controller {
private $limit=10;
	function __construct()
	{
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('receive_item_model');
		$this->load->model('syslog_model');
	}
	function index()
	{
		$data=$this->set_defaults();
		$this->template->display_form_input('receive_item',$data,'receive_item_left_menu');
	}
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		if($record==NULL){
			$data['shipment_id']='';
			$data['item_number']='';
			$data['description']='';
			$data['quantity']='';
			$data['unit']='';
			$data['id']='';
		} else {
			$data['shipment_id']=$record->shipment_id;
			$data['item_number']=$record->item_number;
			$data['description']=$record->description;
			$data['quantity']=$record->quantity;
			$data['unit']=$record->unit;
			$data['id']=$record->id;
		}
		$data['item_list']=$this->receive_item_model->item_list();
		return $data;
	}	
	function get_posts(){
		$data['shipment_id']=$this->input->post('shipment_id');
		$data['item_number']=$this->input->post('item_number');
		$data['quantity_received']=$this->input->post('quantity');
		$data['unit']=$this->input->post('unit');
		$data['id']=$this->input->post('id');
		return $data;
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('shipment_id','Receive Number', 'required|trim');
		 $this->form_validation->set_rules('item_number','Item Number',	 'required');
		 $this->form_validation->set_rules('unit','Unit',	 'required');
		 $this->form_validation->set_rules('quantity','Quantity',	 'required');
	}

	function add($recv_id)
	{
		$recv_id=urldecode($recv_id);
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->receive_item_model->save($data);
		    $data['message']='update success';
			$this->syslog_model->add($id,"receive_po","edit");

			redirect('receive/view_item/'.$recv_id);			
		} else {
			$data['mode']='add';
			$data['message']='';
			$data['shipment_id']=$this->input->post('shipment_id');
			$this->template->display_form_input('receive',$data,'receive_left_menu');			
		}
	}	

}
