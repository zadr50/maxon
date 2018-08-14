<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$kelompok=$CI->input->post('text1');
	$sql="select * from salesman";
	$data['content']=browse_select(	array('sql'=>$sql,
	'show_action'=>false
	));
	$data['caption']='DAFTAR SALESMAN';
	echo load_view('simple_print.php',$data);    
	
?>
