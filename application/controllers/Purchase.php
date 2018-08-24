<?php
 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Purchase extends CI_Controller {
                

	function __construct()
	{
		parent::__construct();        
         
        
		if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url','form','browse_select'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('syslog_model');
	}
    function index(){	
	}
    function rpt($id){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;		 
		$id=urldecode($id);
    	 switch ($id) {
		 	 case "cards_detail":
             case "aging_detail":
                 $data['criteria1']=true;
                 $data['label1']='Supplier';
                 $data['text1']='';
                 $data['output1']="text1";
                 $data['key1']="supplier_number";
                 $data['fields1'][]=array("supplier_number","100","Kode");
                 $data['fields1'][]=array("supplier_name","180","Nama");
                 $data['ctr1']='supplier/select';
                 
                 break;
			 case 'po_list':
			 case "faktur_items":
				 break;
			 case "cards_sum":
				 $data['criteria1']=true;
				 $data['label1']='Tampil saldo nol? (0=Tidak,1=Ya)';
				 $data['text1']='0';				 
				 
				 
			 default:
				 
				 break;
		 }
		 $rpt='purchase/rpt/'.$id;
		 $data['rpt_controller']=$rpt;
		 
		if(!$this->input->post('cmdPrint')){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view($rpt);
		}
   }
	function reports(){
		$this->template->display('purchase/menu_reports');
	}
	
}
?>
