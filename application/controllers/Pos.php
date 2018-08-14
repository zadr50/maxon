<?php
 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Pos extends CI_Controller {
                

	function __construct()
	{
		parent::__construct();        
      
		if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url','form','browse_select'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
	}
    function index(){
		$data['visible_right']=false;
		
		$this->template->display_form_input('pos/main',$data);			
	}
	function main() {
	
	}
	function new_session() {
		$this->session->set_userdata('pos',rand(100,900));
		$data['pos_session']=$this->session->userdata('pos');
		$this->template->display_form_input('pos/menu_dashboard',array());
	}
    function rpt($id){
    	 switch ($id) {
			 case 'cards':
				 $data['date_from']=date('Y-m-d 00:00:00');
				 $data['date_to']=date('Y-m-d 23:59:59');
				 $data['select_date']=true;
				 $data['criteria1']=true;
				 $data['label1']='Dari Kode Perkiraan';
				 $data['text1']='';
				 $data['criteria2']=true;
				 $data['label2']='Sampai Kode Perkiraan';
				 $data['text2']='';
				 break;
			 case 'jurnal' or 'neraca_saldo':
				 $data['date_from']=date('Y-m-d 00:00:00');
				 $data['date_to']=date('Y-m-d 23:59:59');
				 $data['select_date']=true;
				 break;
			 
			 default:
				 
				 break;
		 }
		 $rpt='gl/rpt/'.$id;
		 $data['rpt_controller']=$rpt;
		 
		if(!$this->input->post('cmdPrint')){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view($rpt);
		}
   }
	
}
?>
