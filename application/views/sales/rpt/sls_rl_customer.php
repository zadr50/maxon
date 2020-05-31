<?php 
	$CI =& get_instance();
	$data['caption']='RUGI LABA PENJUALAN PER CUSTOMER';
	if(!$CI->input->post('cmdPrint')){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;		 
		
		$data['criteria1']=true;
		$data['label1']='Customer';
		$data['text1']='';
         $data['key1']="customer_number";
         $data['fields1'][]=array("customer_number","80","Kode");
         $data['fields1'][]=array("company","180","Nama Customer");
         $data['ctr1']='lookup/query/customers';
		$data['rpt_controller']="sales/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$date_from=$CI->input->post("txtDateFrom");
		$date_to=$CI->input->post("txtDateTo");
		$salesman=$CI->input->post("text1");
		$customer=$CI->input->post("text2");
		$outlet=$CI->input->post("text3");
		$supplier=$CI->input->post("text4");
		$category=$CI->input->post('text5');
		
		$sql="select i.sold_to_customer as kode,c.company,
        sum(il.amount) as amount_sale,sum(il.cost*il.quantity) as amount_cost,
        sum(il.amount-(il.cost*il.quantity)) as profit,
        (sum(il.amount-(il.cost*il.quantity))/sum(il.amount))*100 as profit_prc
		from invoice i  
		left join invoice_lineitems il on il.invoice_number=i.invoice_number
		left join customers c on c.customer_number=i.sold_to_customer
		left join inventory s on s.item_number=il.item_number
		where i.invoice_type='I' and i.invoice_date between '$date_from' and '$date_to'  
		";
		if($category!="")$sql.=" and s.category='$category'";
		if($supplier!="")$sql.=" and s.supplier_number='$supplier'";
		if($salesman!="")$sql.=" and i.salesman='$salesman'";
		if($customer!="")$sql.=" and i.sold_to_customer='$customer'";
		if($outlet!="")$sql.=" and il.warehouse_code='$outlet'";
				
		$sql.=" group by i.sold_to_customer,c.company";
		
		$data['content']=browse_select( array('sql'=>$sql,'show_action'=>false,
		    "fields_sum"=>array("amount_sale","amount_cost",
		    "profit")));    
		    
		echo load_view('simple_print.php',$data);    
	}
?>
		
		
		
		
		
		
		