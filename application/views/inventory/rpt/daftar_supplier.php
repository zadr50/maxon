<?php 
	 $CI =& get_instance();
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kode Supplier';
		$data['text1']='';
         $data['key1']="kode";
         $data['fields1'][]=array("supplier_number","80","Kode");
         $data['fields1'][]=array("supplier_name","180","Supplier");
         $data['ctr1']='suppliers/select';
		
		
		$data['caption']='DAFTAR BARANG';
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$data['caption']="DAFTAR MASTER BARANG - GROUP BY SUPPLIER";
		$sql="select item_number,description,i.retail as harga_jual,
			i.cost_from_mfg as harga_beli,i.cost,
			category,i.supplier_number,s.supplier_name
			FROM inventory i left join suppliers as s on s.supplier_number=i.supplier_number 
			where 1=1";
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		if($kel!="")$sql.=" and i.supplier_number='".$kel."'";
		$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false,
		"group_by"=>array("supplier_number"))
		);
		 $data['header']=company_header();
		 $data['criteria']="Supplier: $kel";
		$this->load->view('simple_print.php',$data);    		
		
	}

?>