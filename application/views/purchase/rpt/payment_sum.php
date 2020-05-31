<?php 
	$CI =& get_instance();
	$data['caption']='DAFTAR PEMBAYARAN SUMMARY';
	if(!$CI->input->post('cmdPrint')){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;		 
		
		$data['criteria1']=true;
		$data['label1']='Supplier';
		$data['text1']='';
         $data['key1']="supplier_number";
         $data['fields1'][]=array("supplier_number","80","Kode");
         $data['fields1'][]=array("supplier_name","180","Nama Supplier");
         $data['ctr1']='lookup/query/suppliers';
		$data['rpt_controller']="purchase/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$date_from=$CI->input->post("txtDateFrom");
		$date_to=$CI->input->post("txtDateTo");
		$supplier=$CI->input->post("text1");
		
		$sql="select 
		i.supplier_number,s.supplier_name,
		sum(p.amount_paid) as amount_paid, sum(i.amount) as amount_invoice,
		sum(i.amount)-sum(p.amount_paid) as balance		
		from payables_payments p 
		left join purchase_order i on i.purchase_order_number=p.purchase_order_number
		left join suppliers s on s.supplier_number=i.supplier_number
		left join chart_of_accounts c on c.id=p.how_paid_account_id
		where p.date_paid between '$date_from' and '$date_to' ";
		
		if($supplier!="")$sql.=" and i.supplier_number='$supplier'";
		
		$sql.=" group by i.supplier_number,s.supplier_name";
		
		
		$data['content']=browse_select(	
			array('sql'=>$sql,'show_action'=>false,
				"fields_sum"=>array("amount_paid","amount_invoice","balance")
			)
		);
		 $data['header']=company_header();
		 $data['criteria']="Date From: $date_from - $date_to, Supplier: $supplier";
		$this->load->view('simple_print.php',$data);    		
		
	}

?>