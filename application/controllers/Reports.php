<?php
 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Reports extends CI_Controller {
                

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
        function index()
	{	
	}
	
        function ar($id){
             $this->load->helper('mylib');
             $data['message']='';
             $data['date_from']=date('Y-m-d');
             $data['date_to']=date('Y-m-d');
             $data['select_date']=true;
             $data['criteria1']=false;
             $data['label1']='';
             $data['text1']='';
             $data['criteria2']=false;
             $data['label2']='';
             $data['text2']='';
             $data['criteria3']=false;
             $data['label3']='';
             $data['text3']='';
             $data['header']= $data['header']=company_header();
                switch ($id) {
                case '1':
                
                    if(!isset($_POST['cmdPrint'])){
                        $data['caption']='LAPORAN PENJUALAN';
                        $this->template->display_form_input('criteria',$data,'');
                    } else {
                        $sql="select invoice_number,invoice_date,amount, 
                            sold_to_customer,c.company,c.city,i.warehouse_code
                            from invoice i
                            left join customers c on c.customer_number=i.sold_to_customer
                            where warehouse_code='".$this->access->cid."'";
                        $sql.=" and invoice_date between '"
                                .$this->input->post('txtDateFrom')
                                ."' and '".$this->input->post('txtDateTo')."'";
                        $data['caption']="DAFTAR FAKTUR PENJUALAN";
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
