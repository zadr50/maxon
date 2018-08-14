<?php 
	 $CI =& get_instance();
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
		$data['caption']='DAFTAR BARANG PRICE LIST';
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->load->view('criteria',$data,'');
	} else {
		$data['caption']="DAFTAR MASTER BARANG WITH COST";
		$sql="select item_number,description,retail as harga_jual,
			cost_from_mfg as harga_beli,cost,quantity_in_stock as quantity, 
			
			unit_of_measure as unit,supplier_number,category
			FROM inventory where 1=1";
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		if($kel!="")$sql.=" and category='".$kel."'";
		$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false)
		);
		 $data['header']=company_header();
		$this->load->view('simple_print.php',$data);    		
		
	}

?>