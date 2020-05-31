<?php
    $CI =& get_instance();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$ticket_type=$CI->input->post('text1');	
	$user_id=$CI->input->post("text2");
	
	$sql="select id,ticket_type,tanggal,qty_ticket,price,disc_prc,disc_amt,netto,how_paid,cust_no,
	edc,keterangan,user_id 
	from ticket_sales where tanggal between '$date1' and '$date2' ";
	if ($ticket_type!=""){
		$sql.=" and ticket_type='$ticket_type' ";
	}
	if($user_id!="")$sql.=" and user_id='$user_id' ";
	
	$sql.=" order by edc,ticket_type,tanggal";
	
	$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false,
    "fields_sum"=>array("qty_ticket","netto"), 
	"group_by"=>array("edc")
	));
	$data['caption']='DAFTAR PENJUALAN TICKET BY EDC REKENING';
	echo load_view('simple_print.php',$data);    
	
?>
