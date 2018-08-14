<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Tracking extends CI_Controller {
private $limit=10;

	function __construct()
	{
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
		$this->load->model('tracking_model');
		 
	}
	 
	function index()
	{
		$data['message']='';	
		$data['table']='';
		$this->template->display('tracking',$data);
	}
	 
	function browse($offset=0,$order_column='location',$order_type='asc')
	{
		if(empty($offset))$offset=0;
		if(empty($order_column))$order_column='location';
		if(empty($order_type))$order_type='asc';
		$loc=$this->input->post('location');
		$bin=$this->input->post('bin');
		$where=' where 1=1';
		if($loc<>'')$where=$where." and location like '%".$loc."%'";
		if($bin<>'')$where=$where." and bin like '%".$bin."%'";
		
		$models=$this->tracking_model->get_paged_list($this->limit,$offset,
			$order_column,$order_type,$where)->result();
	 
		$this->load->library('pagination');
		$config['base_url']=site_url('tracking/browse');
		$config['total_rows']=$this->tracking_model->count_all();
		$config['per_page']=$this->limit;
		$config['uri_segment']=3;
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
		
		//generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$new_order=($order_type=='asc'?'desc':'asc');
		$this->table->set_heading('No','Item Number',
		'Recv No','Qty Recv','Date Recv',
		
		anchor('tracking/browse/'.$offset.'/location/'.$new_order,'Location'),
		anchor('tracking/browse/'.$offset.'/bin/'.$new_order,'Bin')
		);
		$i=0+$offset;
		foreach($models as $model){
			$this->table->add_row(++$i,$model->item_number,$model->shipment_id,
			$model->quantity_received,$model->date_received,
			$model->location,$model->bin
			);
		}
		$tmpl=$this->template->template_table();
		$this->table->set_template($tmpl);

		$data['table']=$this->table->generate();
		if($this->uri->segment(3)=='delete_success')
			$data['message']='Data berhasil dihapus';
		else if ($this->uri->segment(3)=='add_success')
			$data['message']='Data berhasil ditambah';
		else
			$data['message']='';
		//load view
	 
		$this->template->display('tracking',$data);

	}
	 
	
}
