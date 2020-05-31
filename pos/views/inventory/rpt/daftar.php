<?php 
	 $CI =& get_instance();
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
		$data['caption']='DAFTAR BARANG';
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$data['caption']="DAFTAR MASTER BARANG";
		$sql="select item_number,description,category,i.supplier_number,
			s.supplier_name,i.model,i.manufacturer,i.retail,i.cost_from_mfg,i.cost
			FROM inventory i 
			left join suppliers s on s.supplier_number=i.supplier_number 
			where 1=1";
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		if($kel!="")$sql.=" and category='".$kel."'";
		$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false)
		);
		 $data['header']=company_header();
		$this->load->view('simple_print.php',$data);    		
		
	}

?>