<?php
    $CI =& get_instance();
	$d1=$CI->input->post('txtDateFrom');
	$d2=$CI->input->post('txtDateTo');
	$d1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$d2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");
	$jenis="";
	if($jenis2=$CI->input->post("text4")){
		$jenis=$jenis2;
	}
    
	$sql="select p.invoice_number,p.date_paid,p.how_paid,p.amount_paid,
	p.no_bukti,i.payment_terms as terms,i.sold_to_customer as cst,c.company,i.salesman,i.warehouse_code,
	p.credit_card_type as Ref1,p.credit_card_number as Ref2
	from payments p inner join invoice i on i.invoice_number=p.invoice_number 
	inner join customers c on c.customer_number=i.sold_to_customer
		where p.date_paid between '$d1' and '$d2'";
	
    if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
    
    if($salesman!=""){
        $sql.=" and i.salesman='$salesman'";
    }
    if($customer!=""){
        $sql.=" and i.sold_to_customer='$customer'";
    }
	if($jenis!=""){
		$sql.=" and p.how_paid='$jenis'";
	}

    $sql.=" order by p.how_paid";
    
	$data['content']=browse_select(	array('sql'=>$sql,
	   'show_action'=>false,"group_by"=>array("how_paid"),
       'fields_sum'=>array("amount_paid"))
       );
	$data['caption']='DAFTAR PEMBAYARAN';
    $data['criteria']=" Criteria: Dari Tanggal: $d1 s/d : $d2
            Salesman: $salesman, Customer: $customer, 
            Outlet: $outlet";
	echo load_view('simple_print.php',$data);    
	
?>
