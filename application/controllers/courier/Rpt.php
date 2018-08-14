<?php
 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Rpt extends CI_Controller {
                

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
        function index(){}
	
function load($id){
     $this->load->helper('mylib');
     $data['message']='';
     $data['date_from']=date('Y-m-d');
     $data['date_to']=date('Y-m-d');
     $data['select_date']=true;
     $data['header']= $data['header']=company_header();
     $data['rpt_controller']="courier/rpt/load/$id";
     
    switch ($id) {
    case 'booking_dom':
        $data['caption']='LAPORAN BOOKING DOMESTIK';
        if(!isset($_POST['cmdPrint'])){
             $data['criteria1']=false;
             $data['label1']='';
             $data['text1']='';            
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $sql="select * from booking_dom where bk_date between '"
            .$this->input->post('txtDateFrom')
            ."' and '".$this->input->post('txtDateTo')."'";
            $data['content']=browse_select(
                    array('sql'=>$sql,
                    'action_button'=>''));
            $this->load->view('simple_print.php',$data);    
        }
        break;
    case 'manifest2':
    case 'manifest':
        $data['caption']='LAPORAN MANIFEST';
        if(!isset($_POST['cmdPrint'])){
             $data['criteria1']=false;
             $data['label1']='';
             $data['text1']='';            
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $sql="select * from manifest where date_mf between '"
            .$this->input->post('txtDateFrom')
            ."' and '".$this->input->post('txtDateTo')."' order by penerima";
            $data['content']=browse_select(
                    array('sql'=>$sql,
                    'action_button'=>''));
            $this->load->view('simple_print.php',$data);    
        }
        break;
        
    case 'invoice':
        $data['caption']='LAPORAN INVOICE';
        if(!isset($_POST['cmdPrint'])){
             $data['criteria1']=false;
             $data['label1']='';
             $data['text1']='';            
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $sql="select * from invoice where invoice_type='I' and invoice_date between '"
            .$this->input->post('txtDateFrom')
            ."' and '".$this->input->post('txtDateTo')."'";
            $data['content']=browse_select(
                    array('sql'=>$sql,
                    'action_button'=>''));
            $this->load->view('simple_print.php',$data);    
        }
        break;
        
    default:
        break;
    }

}


}
?>
