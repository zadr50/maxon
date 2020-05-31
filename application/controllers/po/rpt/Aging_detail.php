<?php
class Aging_detail extends CI_Controller {
	private	$rpt='purchase/rpt/aging_detail';
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
        $data['rpt_controller']=$this->rpt;
        
         $data['select_date']=true;
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
         
         $data['criteria1']=true;
         $data['label1']='Supplier';
         $data['text1']='';
         $data['output1']="text1";
         $data['key1']="supplier_number";
         $data['fields1'][]=array("supplier_name","180","Supplier");
         $data['ctr1']='supplier/select';
		 
         $data['criteria2']=true;                 
         $data['label2']='Tampil Saldo 0 (1-Yes, 0-No)';
         $data['text2']='0';
         $data['output2']="text2";                 
 
         
        
        
		$this->template->display_form_input('criteria',$data,'');	
	
	}
	function action(){
		if(!$this->input->post('cmdPrint')){
			$this->load->view($this->rpt);
		}
	}
}
?>
