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
		$this->load->model('syslog_model');
	}
    function index(){	
	}
    function rpt($id){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;		 
    	 switch ($id) {
			 case 'so_otstand_item':
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
			 case 'faktur_slsman':
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

				 break;			 
			 case 'faktur_cust':
			 case 'age_dtl':
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
			case 'cust_list':
				$data['select_date']=false;	
				break;

			 default:
				 break;
		 }
		 $rpt='sales/rpt/'.$id;
		 $data['rpt_controller']=$rpt;
		 
		if(!$this->input->post('cmdPrint')){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view($rpt);
		}
   }
	function reports(){
		$this->template->display('sales/menu_reports');
	}
}
?>
