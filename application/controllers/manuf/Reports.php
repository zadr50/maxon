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
    function index(){	
		$this->template->display("manuf/reports");
	}
	function wo($id){
		$this->load->helper('mylib');
		$data['message']='';
		$data['date_from']=date('Y-m-d');
		$data['date_to']=date('Y-m-d');
		$data['select_date']=true;
		$data['criteria1']=false;
		$data['label1']='Customer ';
		$data['text1']='';
		$data['criteria2']=false;
		$data['label2']='Status';
		$data['text2']='';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="manuf/reports/wo/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['caption']='DAFTAR WORK ORDER';
			$data['criteria1']=true;
			$data['criteria2']=true;
			if(isset($_POST['cmdPrint'])){
				$sql="select w.*,c.company  
					from work_order w
					left join customers c on c.customer_number=w.customer_number
					where 1=1";
				$sql.=" and w.start_date between '".$d1."' and '".$d2."'";
				$cust=$this->input->post("text1");
				if($cust != "")$sql.=" and w.customer_number='".$cust."'";
				$status=$this->input->post("text2");
				if($status!="")$sql.=" and w.wo_status='".$status."'";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false));
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['caption']='DAFTAR WORK ORDER DETAIL';
			$data['criteria1']=true;
			$data['criteria2']=true;
			if(isset($_POST['cmdPrint'])){
				$sql="select w.*,c.company,wi.* 
					from work_order w
					left join work_order_detail wi on wi.work_order_no=w.work_order_no
					left join customers c on c.customer_number=w.customer_number
					where 1=1";
				$sql.=" and w.start_date between '".$d1."' and '".$d2."'";
				$cust=$this->input->post("text1");
				if($cust !="")$sql.=" and w.customer_number='".$cust."'";
				$status=$this->input->post("text2");
				if($status!="")$sql.=" and w.status='".$status."'";
				$sql.=" group by w.work_order_no";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("total"),
				'group_by'=>array("work_order_no")
				
				));
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '003':
			$data['caption']='DAFTAR TAGIHAN';
			$data['criteria1']=true;
			if(isset($_POST['cmdPrint'])){
				$sql="select h.invoice_number,h.invoice_date,h.loan_id, h.idx_month, h.amount,
					h.paid,c.cust_name ,l.dealer_name, h.date_paid,h.payment_method,
					h.amount_paid,
					l.dealer_id,h.cust_deal_id,h.hari_telat,h.denda,h.pokok_paid,h.bunga_paid
					from ls_invoice_header h 
					left join ls_loan_master l on l.loan_id=h.loan_id
					left join ls_cust_master c on c.cust_id=l.cust_id
					where 1=1";
				$sql.=" and h.invoice_date between '".$d1."' and '".$d2."'";
				$counter_id=$this->input->post("text1");
				if($counter_id!="")$sql.=" and dealer_id='".$counter_id."'";
				$sql.=" order by h.loan_id,h.invoice_date";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("amount","amount_paid",
				"ar_bal_amount_sum"),"group_by"=>array("loan_id")
				));	
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '004':
			$data['caption']='LAPORAN CASH LOAN';
			$data['criteria1']=false;
			if(isset($_POST['cmdPrint'])){
				$sql="select * from qry_loan_by_counter
					where 1=1";
//				$sql.=" and h.invoice_date between '".$d1."' and '".$d2."'";
//				$counter_id=$this->input->post("text1");
//				if($counter_id!="")$sql.=" and dealer_id='".$counter_id."'";
//				$sql.=" order by h.loan_id,h.invoice_date";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("z_loan","z_balance",
				"z_payment","z_noa") 
				));	
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '005':
			$data['caption']='LAPORAN KOLEKTIBILITAS';
			$data['criteria1']=false;
			if(isset($_POST['cmdPrint'])){
				$sql="select * from qry_loan_by_counter
					where 1=1";
//				$sql.=" and h.invoice_date between '".$d1."' and '".$d2."'";
//				$counter_id=$this->input->post("text1");
//				if($counter_id!="")$sql.=" and dealer_id='".$counter_id."'";
//				$sql.=" order by h.loan_id,h.invoice_date";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("z_loan","z_balance",
				"z_payment","z_noa") 
				));	
				$this->load->view('simple_print.php',$data);    
			}
			break;
		default:
			break;
		}
		if(!isset($_POST['cmdPrint'])){
			$this->template->display_form_input('criteria',$data,'');
		}		

	}
	function mr($id){
		$this->load->helper('mylib');
		$data['message']='';
		$data['date_from']=date('Y-m-d');
		$data['date_to']=date('Y-m-d');
		$data['select_date']=true;
		$data['criteria1']=false;
		$data['label1']='Counter ';
		$data['text1']='';
		$data['criteria2']=false;
		$data['label2']='Status';
		$data['text2']='0';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="manuf/reports/mr/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['label1']='Gudang ';
			$data['text1']='';
			$data['criteria1']=true;
			$data['caption']='DAFTAR MATERIAL RELEASE';
			if(isset($_POST['cmdPrint'])){
				$sql="select p.*,d.* 
					from mat_release_header p
					left join mat_release_detail d on d.mat_rel_no=p.mat_rel_no
					left join inventory i on i.item_number=d.item_number
					where ";
				$sql.=" p.date_rel between '".$d1."' and '".$d2."'";
				$text1=$this->input->post("text1");
				if($text1 !="")$sql.=" and p.warehouse='".$text1."'";
				$sql.=" order by p.mat_rel_no";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"group_by"=>array("mat_rel_no"),
				'fields_sum'=>array("amount"))
				);
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['select_date']=false;
			$data['criteria1']=false;
			$data['caption']='DAFTAR DEBITUR SUMMARY';
			if(isset($_POST['cmdPrint'])){
				$sql="select *
					from ls_cust_master c
					where 1=1";
				$city=$this->input->post("text1");
				if($city!="")$sql.=" and c.city like '%".$city."%'";
				$sql.=" order by c.city";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false));
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '003':
		default:
			break;
		}
		if(!isset($_POST['cmdPrint'])){
			$this->template->display_form_input('criteria',$data,'');
		}		
	}
function woe($id){
		$this->load->helper('mylib');
		$data['message']='';
		$data['date_from']=date('Y-m-d');
		$data['date_to']=date('Y-m-d');
		$data['select_date']=true;
		$data['criteria1']=false;
		$data['label1']='Counter ';
		$data['text1']='';
		$data['criteria2']=false;
		$data['label2']='Status';
		$data['text2']='';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="manuf/reports/woe/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['caption']='DAFTAR WORK EXECUTE';
			if(isset($_POST['cmdPrint'])){
				$sql="select w.*,wi.*
					from work_exec w 
					left join work_exec_detail wi on w.work_exec_no=wi.work_exec_no
					where ";
				$sql.=" w.start_date between '".$d1."' and '".$d2."'";
				$sql.=" order by w.start_date";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false)
				);
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['caption']='DAFTAR WORK EXECUTE DETAIL';
			if(isset($_POST['cmdPrint'])){
				$sql="select w.work_exec_no,w.wo_number,w.start_date,
					w.expected_date,w.dept_code,w.person_in_charge,
					w.status,
					wi.item_number as item_prod,wi.description as item_prod_name,
					wi.quantity,
					m.*
					from work_exec w 
					left join work_exec_detail wi on w.work_exec_no=wi.work_exec_no
					left join mat_release_detail m on m.line_exec_no=wi.id
					where ";
				$sql.=" w.start_date between '".$d1."' and '".$d2."'";
				$sql.=" order by w.start_date";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,'group_by'=>array('work_exec_no')
				));
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '003':
		default:
			break;
		}
		if(!isset($_POST['cmdPrint'])){
			$this->template->display_form_input('criteria',$data,'');
		}		
	}	 
 
		
}
?>
