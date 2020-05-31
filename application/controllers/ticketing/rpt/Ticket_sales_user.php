<?php
class Ticket_sales_user extends CI_Controller {
	private	$rpt='ticketing/rpt/ticket_sales_user';
	function __construct()
	{
		parent::__construct();        
        $this->load->helper(array('url','browse_select_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');

	}
	function index(){
		$data['date_from']=date('Y-m-d 00:00:00');
		$data['date_to']=date('Y-m-d 23:59:59');
		$data['select_date']=true;
		
	     $data['criteria1']=true;
	     $data['label1']='Jenis Ticket';
	     $data['text1']='';
		 
		 $data['criteria2']=true;
		 $data['label2']="User Id";
		 $data['text2']=user_id();
		 
		$data['rpt_controller']=$this->rpt;
		if(!$this->input->post()){
			$this->template->display_form_input('criteria',$data,'');	
			
		} else {
			$this->load->view($this->rpt);
		}
	
	}
	function action(){
		if(!$this->input->post('cmdPrint')){
			$this->load->view($this->rpt);
		}
	}
}
?>
