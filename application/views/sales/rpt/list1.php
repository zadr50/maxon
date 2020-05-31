<?php
    $CI =& get_instance();
	$kelompok=$CI->input->post('text1');
	$sql="update customers set credit_balance=coalesce(credit_limit,0)-coalesce(current_balance,0)";
	$CI->db->query($sql);
	
	$sql="select customer_number,company,phone,salesman,
	payment_terms,credit_balance,credit_limit,current_balance,tgl_tagih,
	region,city,street from customers";
	$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false,
    "fields_sum"=>array("credit_balance","credit_limit")));
	$data['caption']='DAFTAR PELANGGAN';
	echo load_view('simple_print.php',$data);    
	
?>
