<?
    $CI =& get_instance();
	$kelompok=$CI->input->post('text1');
	$sql="select * from customers";
	$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false));
	$data['caption']='DAFTAR PELANGGAN';
	echo load_view('simple_print.php',$data);    
	
?>
