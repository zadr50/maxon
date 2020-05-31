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
                 
             case 'jurnal':
             case 'neraca_saldo':
                 break;
			case 'faktur_cust':
			case 'print_faktur':
			case 'print_faktur_tabel':
				 $data['criteria1']=true;
				 $data['label1']='Kode Pelanggan';
				 $data['text1']='';
				 $data['output1']="text1";
				 $data['key1']="customer_number";
				 $data['fields1'][]=array("company","180","Nama");
				 $data['fields1'][]=array("customer_number","80","Kode");
				 $data['fields1'][]=array("street","180","Alamat");
				 $data['ctr1']='customer/select';
				 
                 $data['criteria2']=true;
                 $data['label2']='Outlet';
                 $data['text2']=current_gudang();
				 
    			 break;
             case 'sls_rl_item':
             case 'sls_item_supplier':
			 case 'sls_rl_cat':
				 $has_criteria=true;
                 $data['criteria1']=true;
                 $data['label1']='Kode Supplier';
                 $data['text1']='';
                 $data['output1']="text1";
                 $data['key1']="supplier_number";
                 $data['fields1'][]=array("supplier_name","180","Nama");
                 $data['fields1'][]=array("supplier_number","80","Kode");
                 $data['fields1'][]=array("street","180","Alamat");
                 $data['ctr1']='supplier/select';
				 
                 $data['criteria2']=true;
                 $data['label2']='Kode Category';
                 $data['text2']='';
                 $data['output2']="text2";
                 $data['key2']="kode";
                 $data['fields2'][]=array("kode","180","Kode");
                 $data['fields2'][]=array("category","180","Kategori");
                 $data['ctr2']='category/select';

				 $data['criteria3']=true;
				 $data['label3']='Sistim';
				 $data['text3']='';

                 break;          
			 case 'sls_rl_customer':
			case 'sls_rl_supplier':
			 case 'sls_rl_invoice':
			 case 'sls_termin':
			case 'do_customer':
			case 'do_salesman':
			 case 'so_customer':
			 case 'so_salesman':
			 case 'so_otstand_cust':
             case 'sls_cat':
             case 'faktur_cust':
             case 'age_dtl':
			 case 'age_sum':
			 case 'age_dtl_item':
			 case 'age_dtl_due':
			 case 'age_dtl_due_item':
			 case 'age_sum_due':
             case 'pay_type':
             case 'faktur_slsman':
             case 'pay_list':
			 case 'retur_item':
			 case 'retur_list':
             case 'faktur_sum':
				 $has_criteria=true;
                 $data['criteria1']=true;
                 $data['label1']='Kode Salesman';
                 $data['text1']='';
                 $data['output1']="text1";
                 $data['key1']="salesman";
                 $data['fields1'][]=array("salesman","180","Salesman");
                 $data['ctr1']='salesman/select';

                 $data['criteria2']=true;
                 $data['label2']='Kode Pelanggan';
                 $data['text2']='';
                 $data['output2']="text2";
                 $data['key2']="customer_number";
                 $data['fields2'][]=array("company","180","Nama");
                 $data['fields2'][]=array("customer_number","80","Kode");
                 $data['fields2'][]=array("street","180","Alamat");
                 $data['ctr2']='customer/select';

                 $data['criteria3']=true;
                 $data['label3']='Outlet';
                 $data['text3']='';
                 $data['output3']="text3";
                 $data['key3']="location_number";
                 $data['fields3'][]=array("location_number","180","Kode");
                 $data['fields3'][]=array("attention_name","180","Nama");
                 $data['ctr3']='shipping_locations/select';
                 
                 if($id=="pay_type"){
	                 $data['criteria4']=true;
	                 $data['label4']='Jenis Bayar (isi CASH,CREDITCARD,VOUCHER)';
	                 $data['text4']='';
                 	
                 }
                 
                 if($id=="sls_termin"){
	                 $data['criteria4']=true;
	                 $data['label4']='Termin';
	                 $data['text4']='';
                 	
                 }

                 break;      
			 case 'ar_dtl':
				 $has_criteria=true;
				 $data['criteria1']=true;
				 $data['label1']='Kode Pelanggan';
				 $data['text1']='';
				 $data['output1']="text1";
				 $data['key1']="customer_number";
				 $data['fields1'][]=array("company","180","Nama");
				 $data['fields1'][]=array("customer_number","80","Kode");
				 $data['fields1'][]=array("street","180","Alamat");
				 $data['ctr1']='customer/select';
				 $data['required1']="true";
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
