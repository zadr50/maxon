<?php
class Po_category extends CI_Controller {
	private	$rpt='purchase/rpt/po_category';
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
	     $data['label1']='Supplier';
	     $data['text1']='';
	     $data['output1']="text1";
	     $data['key1']="supplier_number";
	     $data['fields1'][]=array("supplier_number","100","Kode");
	     $data['fields1'][]=array("supplier_name","180","Nama");
	     $data['ctr1']='supplier/select';
	
	     $data['criteria2']=false;
	     $data['label2']='Category';
	     $data['text2']='';
	     $data['output2']="text2";
	     $data['key2']="kode";
	     $data['fields2'][]=array("kode","180","Kode");
	     $data['fields2'][]=array("category","180","Nams");
	     $data['ctr2']='category/select';
		 
	     $data['criteria3']=true;
	     $data['label3']='Sistim';
	     $data['text3']='';
	     $data['output3']="text3";
	     $data['key3']="varvalue";
	     $data['fields3'][]=array("varvalue","180","Kode");
	     $data['fields3'][]=array("keterangan","180","Nams");
	     $data['ctr3']='type_of_purchase/select';

	     $data['criteria4']=true;
	     $data['label4']='Outlet';
	     $data['text4']='';
	     $data['output4']="text4";
	     $data['key4']="location_number";
	     $data['fields4'][]=array("location_number","180","Kode");
	     $data['fields4'][]=array("address_type","180","Nams");
	     $data['ctr4']='gudang/select';
		 
		 		 
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
