<?php 
	 $CI =& get_instance();
	$data['caption']='DAFTAR BARANG TIDAK BERGERAK';
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$sql="select i.item_number,i.description,i.category,
			(
				select tanggal  
				from qry_kartustock_union
				where item_number=i.item_number
				order by tanggal desc limit 1
			
			) as tanggal_akhir
			from inventory i 
			where 1=1 ";
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		if($kel!="")$sql.=" and i.category='".$kel."'";
		$sql.=" order by tanggal_akhir";
		$data['content']=browse_select(array('sql'=>$sql,'show_action'=>false)
		);
		 $data['header']=company_header();
		$this->load->view('simple_print.php',$data);    		
		
	}

?>