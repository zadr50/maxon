<?php
class Cards_sum extends CI_Controller {
	private	$rpt='purchase/rpt/cards_sum';
	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());        
         
        $this->load->helper(array('url'));
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
		 $data['label1']='Tampil saldo nol? (0=Tidak,1=Ya)';
		 $data['text1']='0';				 
		 
		$data['rpt_controller']=$this->rpt;
		$this->template->display_form_input('criteria',$data,'');	
	
	}
	function action(){
		if(!$this->input->post('cmdPrint')){
			$this->load->view($this->rpt);
		}
	}
}
?>
