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
    	$has_criteria=false;	//apabila criteria dalam file view
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;		 
		$id=urldecode($id);
        
    	 switch ($id) {
		 	case "item_need_order":
				$data["select_date"]=false;
				break;
			case 'memo_list':
			case 'payment':
			case 'payment_sum':
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
                 

                 $has_criteria=true;
				 
                 break;
				 
			 case 'po_list':
				 break;
			 case "cards_sum":
				 $data['criteria1']=true;
				 $data['label1']='Tampil saldo nol? (0=Tidak,1=Ya)';
				 $data['text1']='0';				 
                 $has_criteria=true;
				 break;
			case 'retur_detail':
			case 'retur_supplier_item':
			case 'retur_supplier':
			case 'retur_list':
			case 'retur_items':	 
			     $data['criteria6']=true;
			     $data['label6']='Outlet';
			     $data['text6']='';
			     $data['output6']="text6";
			     $data['key6']="location_number";
			     $data['fields6'][]=array("location_number","180","Kode");
			     $data['fields6'][]=array("address_type","180","Nams");
			     $data['ctr6']='gudang/select';
				

		 	case 'kontra_list':
			case 'po_open_item':
			case 'po_recv_list':
			case 'po_items':	 
			case 'po_items_sum':	 
			case 'faktur_items_sum':
			case 'faktur_items':
			case 'faktur_list':
			
			     $data['criteria1']=true;
			     $data['label1']='Supplier';
			     $data['text1']='';
			     $data['output1']="text1";
			     $data['key1']="supplier_number";
			     $data['fields1'][]=array("supplier_number","100","Kode");
			     $data['fields1'][]=array("supplier_name","180","Nama");
			     $data['ctr1']='supplier/select';
			
			     $data['criteria2']=true;
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
			     $data['label4']='Gudang /Outlet /Lokasi';
			     $data['text4']='';
			     $data['output4']="text4";
			     $data['key4']="location_number";
			     $data['fields4'][]=array("location_number","180","Kode");
			     $data['fields4'][]=array("address_type","180","Nams");
			     $data['ctr4']='gudang/select';

			     $data['criteria5']=true;
			     $data['label5']='Doc Type';
			     $data['text5']='';
	 			
				 break;
				 
			 default:
				 
				 break;
		 }
		 $rpt_view='purchase/rpt/'.$id;
		 $data['rpt_controller']=$rpt_view;
		 
		if(!$this->input->post('cmdPrint') ){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view($rpt_view,array("id"=>$id));
		}
   }
	function reports(){
		$this->template->display('purchase/menu_reports');
	}
	
}
?>
