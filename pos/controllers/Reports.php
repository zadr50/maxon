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
	    $this->template->display_single('reports');	
	}
    function criteria($id){
         $data['date_from']=date('Y-m-d 00:00:00');
         $data['date_to']=date('Y-m-d 23:59:59');
         $data['select_date']=true;
                  
         switch ($id) {
             case 'faktur_slsman';
                 $data['criteria2']=true;
                 $data['label2']='Kasir';
                 $data['text2']="";
             case 'sls_cat':
                 $data['criteria1']=true;
                 $data['label1']='Outlet';
                 $data['text1']=current_gudang();
                 $data['criteria2']=true;
                 $data['label2']='Category';
                 $data['text2']='';
                 $data['criteria3']=true;
                 $data['label3']='Sistim';
                 $data['text3']='';
                 
                 break;
                 
             case 'sls_sistim':
             case 'sls_item':
             case 'rangkum':
             case 'print_sistim':
             case 'faktur_sum':
                 $data['criteria1']=true;
                 $data['label1']='Outlet';
                 $data['text1']=current_gudang();
                 
                 break;

             case 'pay_list':
                 $data['criteria1']=true;
                 $data['label1']='Outlet';
                 $data['text1']=current_gudang();
                 
                 $data['criteria2']=true;
                 $data['label2']='Rekening';                 
                 $data['text2']='';
                                  
                 break;
             
             case 'cards':
                 $data['criteria1']=true;
                 $data['label1']='Dari Kode Perkiraan';
                 $data['text1']='';
                 $data['criteria2']=true;
                 $data['label2']='Sampai Kode Perkiraan';
                 $data['text2']='';
                 break;
                 
             case 'jurnal' or 'neraca_saldo':
                 break;
                 
                 
             default:
                 break;
         }
         $rpt='reports/print_rpt/'.$id;
         $data['rpt_controller']=$rpt;
         
        if(!$this->input->post('cmdPrint')){
            $this->template->display_single('criteria',$data,'');
        } else {
            $this->load->view($rpt);
        }
   }
   function print_rpt($id){
       $this->load->view("sales/rpt/$id");
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
