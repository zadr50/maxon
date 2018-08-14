<?
    $CI =& get_instance();
	$d1=$CI->input->post('txtDateFrom');
	$d2=$CI->input->post('txtDateTo');
	$d1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$d2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$sql="select p.* from payments p where date_paid between '$d1' and '$d2'";
	$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false));
	$data['caption']='DAFTAR PEMBAYARAN';
	echo load_view('simple_print.php',$data);    
	
?>
