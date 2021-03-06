<?php 
	 $CI =& get_instance();
	 $caption="DAFTAR STOCK ADJUSTMENT";
	$data['caption']=$caption;
	 
	if(!$CI->input->post('cmdPrint')){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;

		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
	    $data['key1']='kode';
	    $data['output1']="text1";
	    $data['fields1'][]=array("kode","80","Kode");
	    $data['fields1'][]=array("Category","180","Category");
	    $data['ctr1']='lookup/query/inventory_categories';

	    $data['criteria2']=true;
	    $data['label2']='Supplier';
	    $data['text2']='';
	    $data['key2']='supplier_number';
	    $data['output2']="text2";
	    $data['fields2'][]=array("supplier_number","80","Kode");
	    $data['fields2'][]=array("supplier_name","180","Supplier");
	    $data['ctr2']='lookup/query/suppliers';
		
        $data['criteria4']=true;
        $data['label4']='Outlet /Gudang';
        $data['text4']='';
         $data['key4']="location_number";
         $data['fields4'][]=array("location_number","80","Gudang");
         $data['ctr4']='gudang/select';
		
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
		
	} else {
		$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
		$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
        $outlet=$CI->input->post("text4");
		$supplier=$CI->input->post("text2");

 		
 		$sql="select ip.date_trans, ip.item_number,s.description,ip.to_qty as qty_adj,
 		ip.unit,ip.from_location as outlet,ip.comments
        from inventory_moving ip
        left join inventory s on s.item_number=ip.item_number
        where ip.trans_type='ADJ' and ip.date_trans between '$date1' and '$date2'
                ";
		if($kel!="")$sql.=" and s.category='".$kel."'";
        if($outlet!="")$sql.=" and ip.from_location='$outlet' ";
		if($supplier!="")$sql.=" and s.supplier_number='$supplier' ";
		
		$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false));
		 $data['header']=company_header();
		 $data['criteria']="Tangga: $date1 s/d $date2, Outlet: $outlet, Kelompok: $kel, Supplier: $supplier";
		$this->load->view('simple_print.php',$data);    		
		
	}

?>