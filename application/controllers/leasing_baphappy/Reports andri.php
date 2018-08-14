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
		$this->template->display("leasing/reports");
	}
	function loan($id){
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
		$data['text2']='1';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="leasing/reports/loan/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['caption']='DAFTAR KONTRAK KREDIT';
			$data['criteria1']=true;
			$data['criteria2']=true;
			if(isset($_POST['cmdPrint'])){
				$sql="select distinct lc.area,lc.area_name,l.loan_id,l.loan_date,l.cust_id,c.cust_name,l.dp_amount,l.loan_amount,
					l.inst_amount,ih.pokok,ih.bunga,l.max_month,
					l.app_id,l.dealer_id,lc.counter_name,am.create_by,u.username,
					l.status,
					l.last_idx_month,l.last_date_paid,l.total_amount_paid,l.ar_bal_amount,
					loi.obj_item_id,loi.price,s.description, am.promo_code, am.item_del_by, am.item_del_date
					from ls_loan_master l
					left join ls_cust_master c on c.cust_id=l.cust_id
					left join ls_app_master am on am.app_id=l.app_id 
					left join user u on u.user_id=am.create_by
					left join ls_loan_obj_items loi on loi.loan_id=l.loan_id
					left join inventory s on s.item_number=loi.obj_item_id
					left join ls_counter lc on lc.counter_id=l.dealer_id
					left join (select loan_id,amount,pokok,bunga from ls_invoice_header 
						) ih on ih.loan_id=l.loan_id
					where 1=1";
				$sql.=" and l.loan_date between '".$d1."' and '".$d2."'";
				$counter_id=$this->input->post("text1");
				if($counter_id!="")$sql.=" and l.dealer_id='".$counter_id."'";
				$status=$this->input->post("text2");
				if($status=="" or $status=="0"){
					$sql.=" and (l.status='0' or l.status is null)";
				} else {
					$sql.=" and l.status='".$status."'";
				}
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("loan_amount","total_amount_paid",
				"ar_bal_amount")
				));
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['caption']='DAFTAR KONTRAK KREDIT SUMMARY';
			$data['criteria1']=true;
			$data['criteria2']=true;
		 
			if(isset($_POST['cmdPrint'])){
				$sql="select lc.area_name,lc.area, lc.counter_id,lc.counter_name,count(1) as count_debitur,sum(l.loan_amount) as loan_amount_sum,
					sum(l.total_amount_paid) as total_amount_paid_sum,
					sum(l.ar_bal_amount) as ar_bal_amount_sum
					from ls_loan_master l
					left join ls_cust_master c on c.cust_id=l.cust_id
					left join ls_counter lc on lc.counter_id=l.dealer_id
					where 1=1";
				$sql.=" and l.loan_date between '".$d1."' and '".$d2."'";
				$counter_id=$this->input->post("text1");
				if($counter_id!="")$sql.=" and l.dealer_id='".$counter_id."'";
				$status=$this->input->post("text2");
				if($status!="")$sql.=" and l.status='".$status."'";
				$sql.=" group by lc.area_name,lc.area, lc.counter_id,lc.counter_name";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("loan_amount_sum","total_amount_paid_sum",
				"ar_bal_amount_sum")
				));
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '003':
			$data['caption']='DAFTAR TAGIHAN';
			$data['criteria1']=true;
			if(isset($_POST['cmdPrint'])){
				 
				$sql="select h.invoice_number,h.invoice_date,h.idx_month, 
					h.amount,h.amount_paid,h.amount-h.amount_paid as amount_saldo,
					h.pokok,h.bunga,h.denda_tagih,
					h.pokok_paid,h.bunga_paid,h.denda as denda_paid,
					h.pokok-h.pokok_paid as pokok_saldo,
					h.bunga-h.bunga_paid as bunga_saldo,
					h.paid,c.cust_name ,l.dealer_name, h.date_paid,h.payment_method,
					h.loan_id, 
					l.dealer_id,h.cust_deal_id,h.hari_telat,
					lam.create_by,u.username,lc.area_name,lc.area,lc.counter_id,lc.counter_name
					 
					from ls_invoice_header h 
					left join ls_loan_master l on l.loan_id=h.loan_id
					left join ls_cust_master c on c.cust_id=l.cust_id
					left join ls_app_master lam on lam.app_id=l.app_id
					left join ls_counter lc on lc.counter_id=lam.counter_id
					left join `user` u on u.user_id=lam.create_by
					where 1=1 and h.paid=false";
				$sql.=" and h.invoice_date between '".$d1."' and '".$d2."'";
				$counter_id=$this->input->post("text1");
				if($counter_id!="")$sql.=" and l.dealer_id='".$counter_id."'";
				$sql.=" order by h.loan_id,h.invoice_date";
				
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("amount","amount_paid",
				"ar_bal_amount_sum","denda_paid","amount_paid","pokok","bunga",
				"pokok_paid","bunga_paid","pokok_saldo","bunga_saldo"),
				"group_by"=>array("loan_id")
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
		case '006':
			$data['caption']='LAPORAN PERTIRING';
			$data['select_date']=false;
			$data['criteria1']=false;
			if(isset($_POST['cmdPrint'])){
				$sql="select l.tahun,l.bulan,l.area,l.area_name,l.counter_id,l.counter_name,
				sum(if(z_loan<=1500000,z_price,0)) as price_1,
				sum(if(z_loan<=1500000,z_loan,0)) as tiring_1,
				sum(if(z_loan<=1500000,z_noa,0)) as noa_1,
				sum(if(z_loan>1500000 and z_loan<=3000000,z_price,0)) as price_2,
				sum(if(z_loan>1500000 and z_loan<=3000000,z_loan,0)) as tiring_2,
				sum(if(z_loan>1500000 and z_loan<=3000000,z_noa,0)) as noa_2,
				sum(if(z_loan>3000000,z_price,0)) as price_3,
				sum(if(z_loan>3000000,z_loan,0)) as tiring_3,
				sum(if(z_loan>3000000,z_noa,0)) as noa_3,
				sum(z_price) as total_price, sum(z_loan) as total_loan,
				sum(z_noa) as total_noa
				from qry_loan_by_counter l
				group by l.tahun,l.bulan,l.area,l.area_name,l.counter_id,l.counter_name

				";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"fields_sum"=>array("price_1","tiring_1",
				"price_2","tiring_2",
				"price_3","tiring_3","total_price","total_loan"),
				"order_by"=>array("tahun","bulan","area_name"),"group_by"=>array("area_name") 
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
	function cust_master($id){
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
		$data['text2']='1';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="leasing/reports/cust_master/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['select_date']=false;
			$data['label1']='Kode Area ';
			$data['text1']='';
			$data['criteria1']=true;
			$data['caption']='DAFTAR DEBITUR / CUSTOMER';
			if(isset($_POST['cmdPrint'])){
				$sql="select c.cust_id,c.cust_name,c.street,c.city,c.hp,c.phone,c.email,
					c.call_name,c.id_card_no,c.kel,c.kec,c.rt,c.rw,c.lama_thn,
					c.create_by,u.username,c.create_date,lc.area,lc.area_name,
					concat(lc.counter_id,' - ',lc.counter_name) as counter
					from ls_cust_master c
					left join `user` u on u.user_id=c.create_by
					left join ls_counter lc on lc.counter_id=u.cid
					where 1=1";
				$counter=$this->input->post("text1");
				if($counter!="")$sql.=" and lc.area='".$counter."'";
				$sql.=" order by lc.area_name,lc.counter_id";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"group_by"=>array("area_name"))
				);
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['select_date']=false;
			$data['label1']='Kode Area ';
			$data['criteria1']=true;
			$data['caption']='DAFTAR DEBITUR SUMMARY';
			if(isset($_POST['cmdPrint'])){
				$sql="select c.cust_id,c.cust_name,c.street,c.city,c.hp,c.phone,c.email,
					c.call_name,c.id_card_no,c.kel,c.kec,c.rt,c.rw,c.lama_thn,
					c.create_by,u.username,c.create_date,lc.area,lc.area_name,
					concat(lc.counter_id,' - ',lc.counter_name) as counter
					from ls_cust_master c
					left join `user` u on u.user_id=c.create_by
					left join ls_counter lc on lc.counter_id=u.cid
					where 1=1";
				$counter=$this->input->post("text1");
				if($counter!="")$sql.=" and lc.area='".$counter."'";
				$sql.=" order by lc.area_name,lc.counter_id";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"group_by"=>array("area_name"))
				);
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
function app_master($id){
		$this->load->helper('mylib');
		$data['message']='';
		$data['date_from']=date('Y-m-d');
		$data['date_to']=date('Y-m-d');
		$data['select_date']=true;
		$data['criteria1']=false;
		$data['label1']='Counter ';
		$data['text1']='';
		$data['criteria2']=true;
		$data['label2']='Status';
		$data['text2']='';
		$q=$this->db->query("select distinct status 
			from ls_app_master where status is not null");
		$list_status_app['']='';
		foreach($q->result() as $row) {
			$list_status_app[$row->status]=$row->status;
		}
		$data['ctr2']=$list_status_app;
		
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="leasing/reports/app_master/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['caption']='DAFTAR APLIKASI KREDIT';
			if(isset($_POST['cmdPrint'])){
				$sql="select lam.app_id,lam.app_date,lam.cust_id,cm.cust_name,
					lc.area,lc.area_name,lam.counter_id,lc.counter_name,lam.status,lam.dp_amount,lam.admin_amount, 
					lam.inst_amount,lam.inst_month,lam.loan_amount, 
					lam.verified,lam.scored, lam.score_value, 
					lam.confirmed,lam.surveyed, lam.approved, lam.risk_approved,
					lam.create_by,u.username,
					loi.obj_id,loi.price,s.description, lam.promo_code, lam.item_del_by, lam.item_del_date
					from ls_app_master lam
					left join ls_app_object_items loi on loi.app_id=lam.app_id
					left join inventory s on s.item_number=loi.obj_id
					left join ls_cust_master cm on cm.cust_id=lam.cust_id 
					left join ls_counter lc on lc.counter_id=lam.counter_id
					left join user u on u.user_id=lam.create_by
					where 1=1";
				$sql.=" and lam.app_date between '".$d1."' and '".$d2."'";
				if($this->input->post('text2')){
					$sql.=" and lam.status='".$this->input->post('text2')."'";
				}
				$sql.=" order by lc.area_name,lc.counter_id";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"group_by"=>array("area_name"))
				);
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['caption']='DAFTAR APLIKASI SUMMARY';
			break;
		case '003':
		default:
			break;
		}
		if(!isset($_POST['cmdPrint'])){
			$this->template->display_form_input('criteria',$data,'');
		}		
	}	 
	function survey($id){
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
		$data['text2']='1';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="leasing/reports/survey/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['select_date']=true;
			$data['label1']='Surveyor ';
			$data['text1']='';
			$data['criteria1']=true;
			$data['caption']='DAFTAR SURVEY';
			if(isset($_POST['cmdPrint'])){
				$sql="select c.app_id,lam.app_date, 
					lc.area,lc.area_name,lc.counter_id,lc.counter_name, 
					lam.cust_id,cm.cust_name,survey_date,concat(c.survey_by,'-',u.username) as surveyor,
					c.status,lam.create_by,
					u.username,comments
					from ls_app_survey c
					left join ls_app_master lam on lam.app_id=c.app_id 
					left join ls_cust_master cm on cm.cust_id=lam.cust_id 
					left join user u on u.user_id=c.survey_by 
					left join ls_counter lc on lc.counter_id=u.cid 
					where 1=1";
				$sql.=" and c.survey_date between '".$d1."' and '".$d2."'";
				$city=$this->input->post("text1");
				if($city!="")$sql.=" and c.survey_by like '%".$city."%'";
				$sql.=" order by survey_by,lc.area,lc.counter_id,cm.cust_name";
				$data['sql']=$sql;
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"group_by"=>array("surveyor")
				)
				);
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['caption']='DAFTAR DEBITUR SUMMARY';
			break;
		case '003':
		default:
			break;
		}
		if(!isset($_POST['cmdPrint'])){
			$this->template->display_form_input('criteria',$data,'');
		}		
	}
	function invoice($id){
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
		$data['text2']='1';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="leasing/reports/invoice/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['select_date']=true;
			$data['label1']='Debitur: ';
			$data['text1']='';
			$data['criteria1']=true;
			$data['caption']='DAFTAR ANGSURAN';
			if(isset($_POST['cmdPrint'])){
				$sql="select h.loan_id,h.app_id,h.invoice_date,h.idx_month,
				h.invoice_number,h.amount,h.paid,h.date_paid,h.amount_paid,
				h.cust_deal_id,c.cust_name,h.pokok,h.bunga,h.hari_telat,h.pokok_paid,
				h.bunga_paid,h.denda,h.bunga_finalty,
				lc.area,lc.area_name,lc.counter_id,lc.counter_name,
				u.user_id,u.username
					from ls_invoice_header h
					left join ls_loan_master lm on lm.loan_id=h.loan_id
					left join ls_cust_master c on c.cust_id=h.cust_deal_id
					left join ls_app_master lam on lam.app_id=lm.app_id
					left join `user` u on u.user_id=lam.create_by
					left join ls_counter lc on lc.counter_id=lam.counter_id
					where 1=1";
				$sql.=" and h.invoice_date between '".$d1."' and '".$d2."'";
				$par1=$this->input->post("text1");
				if($par1!="")$sql.=" and c.cust_name like '%".$par1."%'";
				$sql.=" order by c.cust_name,h.loan_id,h.idx_month";
				$data['content']=browse_select(	array('sql'=>$sql,
				'show_action'=>false,"group_by"=>array("cust_name"),
				"fields_sum"=>array("amount","amount_paid","pokok","bunga",
				"pokok_paid","bunga_paid","bunga_finalty","denda"))
				);
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['caption']='DAFTAR DEBITUR SUMMARY';
			break;
		case '003':
		default:
			break;
		}
		if(!isset($_POST['cmdPrint'])){
			$this->template->display_form_input('criteria',$data,'');
		}		
	}
	function cash($id){
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
		$data['text2']='1';
		$data['criteria3']=false;
		$data['label3']='';
		$data['text3']='';
		$data['header']= $data['header']=company_header();
		$data['rpt_controller']="leasing/reports/cash/".$id;
		 
		if(isset($_POST['cmdPrint'])){
			$d1=$this->input->post('txtDateFrom');
			$d1=date("Y-m-d",strtotime($d1));
			$d2=$this->input->post('txtDateTo');
			$d2=date("Y-m-d H:n:s",strtotime($d2));
		}
		switch ($id) {
		case '001':
			$data['select_date']=true;
			$data['label1']='Debitur: ';
			$data['text1']='';
			$data['criteria1']=true;
			$data['caption']='DAFTAR PENERIMAAN CASH';
			if(isset($_POST['cmdPrint'])){
				$sql="select * from qry_ls_cash_receive ";
				$sql.=" where tanggal between '".$d1."' and '".$d2."'";
				$par1=$this->input->post("text1");
				if($par1!="")$sql.=" and cust_name like '%".$par1."%'";
				$sql.=" order by tanggal";
				$data['content']=browse_select(array('sql'=>$sql,
				'show_action'=>false, 
				"fields_sum"=>array("amount_recv","pokok","pokok_paid","bunga","bunga_paid","z_dp_amount","z_admin_amount"))
				);
				$this->load->view('simple_print.php',$data);    
			}
			break;
		case '002':
			$data['caption']='DAFTAR DEBITUR SUMMARY';
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
