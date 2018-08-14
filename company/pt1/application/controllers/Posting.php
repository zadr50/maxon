<?php

 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Posting extends CI_Controller {
                
    private $postcode="";
    private $posting_all=false;
	
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
        $this->load->helper(array('url','form','browse_select'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
	}

    function index(){}
    

    function sales_invoice(){
         $data['date_from']=date('Y-m-d 00:00:00');
         $data['date_to']=date('Y-m-d 23:59:59');
         $data['rpt_controller']='posting/sales_invoice';
         $data['select_date']=true;
         $data['target_window']=false;
         $data['module']='posting';
         
         $postcode=$this->input->post('cmdPosting');
         
         if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
         if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
             exit;
        } else {
            $this->load->model('invoice_model');
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
            if($this->posting_all)$this->invoice_model->show_finish_message=false;
            
            if($postcode=="Posting"){
                $message=$this->invoice_model->posting_range_date($date1,$date2);
            } else {
                $message=$this->invoice_model->un_posting_range_date($date1,$date2);                
            }
            $data['message']=$message;
            $this->template->display('',$data);
            
        }
    }
    function sales_retur(){
         $data['date_from']=date('Y-m-d 00:00:00');
         $data['date_to']=date('Y-m-d 23:59:59');
         $data['rpt_controller']='posting/sales_retur';
         $data['select_date']=true;
         $data['target_window']=false;
         $data['module']='posting';
         $postcode=$this->input->post('cmdPosting');
         if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        $date1=$this->input->post('txtDateFrom');
        $date2=$this->input->post('txtDateTo');
         
         if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $this->load->model('invoice_model');
            if($this->posting_all)$this->invoice_model->show_finish_message=false;
            
            if($postcode=="Posting"){
                $message=$this->invoice_model->posting_retur_range_date($date1,$date2);
            } else {
                $message=$this->invoice_model->un_posting_retur_range_date($date1,$date2);              
            }
            $data['message']=$message;
            $this->template->display('',$data);
        }
    }
    function sales_memo() {
        $data['date_from']=date('Y-m-d 00:00:00');
        $data['date_to']=date('Y-m-d 23:59:59');
        $data['rpt_controller']='posting/sales_memo';
        $data['select_date']=true;
        $data['target_window']=false;
        $data['module']='posting';
        $postcode=$this->input->post('cmdPosting');
        if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $this->load->model('crdb_model');
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
            
            if($this->posting_all)$this->crdb_model->show_finish_message=false;
            
            if($postcode=="Posting"){
                $message=$this->crdb_model->posting_range_date($date1,$date2);
            } else {
                $message=$this->crdb_model->unposting_range_date($date1,$date2);                
            }
            $data['message']=$message;
            $this->template->display('',$data);
        }
    }
    function purchase_invoice() {
        $data['date_from']=date('Y-m-d 00:00:00');
        $data['date_to']=date('Y-m-d 23:59:59');
        $data['rpt_controller']='posting/purchase_invoice';
        $data['select_date']=true;
        $data['target_window']=false;
        $data['module']='posting';
        $postcode=$this->input->post('cmdPosting');
        if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
        
            $this->load->model('purchase_invoice_model');
            if($this->posting_all)$this->purchase_invoice_model->show_finish_message=false;
            
            if($postcode=="Posting"){
                $message=$this->purchase_invoice_model->posting_range_date($date1,$date2);
            } else {
                $message=$this->purchase_invoice_model->unposting_range_date($date1,$date2);                
            }
            $data['message']=$message;
            $this->template->display('',$data);
        }       
    }
    function purchase_retur() {
        $data['date_from']=date('Y-m-d 00:00:00');
        $data['date_to']=date('Y-m-d 23:59:59');
        $data['rpt_controller']='posting/purchase_retur';
        $data['select_date']=true;
        $data['target_window']=false;
        $data['module']='posting';
        $postcode=$this->input->post('cmdPosting');
        if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');

            $this->load->model('purchase_retur_model');
            
            if($this->posting_all)$this->purchase_retur_model->show_finish_message=false;
            
            
            if($postcode=="Posting"){
                $message=$this->purchase_retur_model->posting_range_date($date1,$date2);
            } else {
                $message=$this->purchase_retur_model->unposting_range_date($date1,$date2);              
            }
            $data['message']=$message;
            $this->template->display('',$data);
        }
    }
    function purchase_memo() {
        $data['date_from']=date('Y-m-d 00:00:00');
        $data['date_to']=date('Y-m-d 23:59:59');
        $data['rpt_controller']='posting/purchase_memo';
        $data['select_date']=true;
        $data['target_window']=false;
        $data['module']='posting';
        $postcode=$this->input->post('cmdPosting');
        if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
        
            $this->load->model('crdb_model');

            if($this->posting_all)$this->crdb_model->show_finish_message=false;

            if($postcode=="Posting"){
                $message=$this->crdb_model->posting_range_date($date1,$date2,1);
            } else {
                $message=$this->crdb_model->unposting_range_date($date1,$date2,1);              
            }
            $data['message']=$message;
            $this->template->display('',$data);
        }
    }
    function cash() {
        $data['date_from']=date('Y-m-d 00:00:00');
        $data['date_to']=date('Y-m-d 23:59:59');
        $data['rpt_controller']='posting/cash';
        $data['select_date']=true;
        $data['target_window']=false;
        $data['module']='posting';
        $postcode=$this->input->post('cmdPosting');
        if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
        
            $this->load->model('check_writer_model');
            
            if($this->posting_all)$this->check_writer_model->show_finish_message=false;
            
            if($postcode=="Posting"){
                $message=$this->check_writer_model->posting_range_date($date1,$date2);
            } else {
                $message=$this->check_writer_model->unposting_range_date($date1,$date2);                
            }
            $data['message']=$message;
            $this->template->display('',$data);
        }
    }
    function all(){
        $data['date_from']=date('Y-m-d 00:00:00');
        $data['date_to']=date('Y-m-d 23:59:59');
        $data['rpt_controller']='posting/all';
        $data['select_date']=true;
        $data['target_window']=false;
        $data['module']='posting';
        $postcode=$this->input->post('cmdPosting');
        if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
        
            $postcode=$this->input->post("cmdPosting");
            if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            $this->posting_all=true;    
            $this->postcode=$postcode=="Posting"?true:false;
            $this->purchase_invoice();
            $this->sales_invoice();
            $this->purchase_memo();
            $this->purchase_retur();
            $this->sales_memo();
            $this->posting_all=false;    
            $this->sales_retur();
            $message="Finish";
            $data['message']=$message;
            $this->template->display('',$data);
        } 
    }

}

?>