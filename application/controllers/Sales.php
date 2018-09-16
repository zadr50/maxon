<?php
 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Sales extends CI_Controller {
                

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
	     $has_criteria=false;	//apabila criteria dalam file view
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;		 
    	 switch ($id) {
		 	 case 'sls_cat_wil':
				 $has_criteria=true;
                 $data['criteria4']=true;
                 $data['label4']='Category Item';
                 $data['text4']='';
                 $data['output4']="text4";
                 $data['key4']="kode";
                 $data['fields4'][]=array("category","180","Category");
                 $data['fields4'][]=array("kode","80","Kode");
                 $data['ctr4']='category/select';

                 $data['criteria5']=true;
                 $data['label5']='Wilayah';
                 $data['text5']='';
                 $data['output5']="text5";
                 $data['key5']="region_id";
                 $data['fields5'][]=array("region_name","180","Nama");
                 $data['fields5'][]=array("region_id","80","Kode");
                 $data['ctr5']='region/select';

					
             case 'sls_cat':
             case 'faktur_cust':
             case 'age_dtl':
			 case 'age_sum':
             case 'pay_type':
             case 'faktur_slsman':
             case 'pay_list':
			 case 'retur_item':
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

                 break;          

			 case 'so_otstand_item':
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

				 $data['criteria2']=true;
				 $data['label2']='Kode Salesman';
				 $data['text2']='';
				 $data['output2']="text2";
				 $data['key2']="salesman";
				 $data['fields2'][]=array("salesman","180","Salesman");
				 $data['ctr2']='salesman/select';

				 $data['criteria3']=true;
				 $data['label3']='Kode Category';
				 $data['text3']='';
				 $data['output3']="text3";
				 $data['key3']="kode";
				 $data['fields3'][]=array("kode","180","Kode");
				 $data['fields3'][]=array("category","180","Kategori");
				 $data['ctr3']='category/select';
				 
				 $data['criteria4']=true;
				 $data['label4']='Nomor SO#';
				 $data['text4']='';
				 $data['output4']="text4";
 

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
				 break;			 
			 case 'age_dtlx':
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

				 break;			 
             case 'sls_rl_item':
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

                 break;          
			case 'slsman_list':
                 break;
			case 'cust_list':
				$data['select_date']=false;	
				break;
             case 'sls_item':
				 $has_criteria=true;
                 $data['criteria1']=true;
                 $data['label1']='Category';
                 $data['text1']='';
                 $data['output1']="text1";
                 $data['key1']="kode";
                 $data['fields1'][]=array("kode","180","Kode");
                 $data['fields1'][]=array("category","180","Nams");
                 $data['ctr1']='category/select';

                 $data['criteria2']=true;
                 $data['label2']='Outlet';
                 $data['text2']='';
                 $data['output2']="text2";
                 $data['key2']="location_number";
                 $data['fields2'][]=array("location_number","180","Kode");
                 $data['fields2'][]=array("attention_name","180","Nama");
                 $data['ctr2']='shipping_locations/select';

                 break;          


			 default:
				 break;
		 }
		 $rpt_view='sales/rpt/'.$id;
		 $data['rpt_controller']=$rpt_view;
		 
		if(!$this->input->post('cmdPrint') && $has_criteria){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view($rpt_view,array("id"=>$id));
		}
   }
	function reports(){
		$this->template->display('sales/menu_reports');
	}
}
?>
