

<?php 
	 $CI =& get_instance();
	$data['caption']='PENERIMAAN BARANG LAINNYA';
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
         $data['key1']="kode";
         $data['fields1'][]=array("kode","80","Kode");
         $data['fields1'][]=array("category","180","Kelompok");
         $data['ctr1']='category/select';


		$data['criteria2']=true;
		$data['label2']='Gudang';
		$data['text2']='';
         $data['key2']="location_number";
         $data['fields2'][]=array("location_number","80","Gudang");
         $data['ctr2']='gudang/select';

		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;
		 

		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$kelompok= $CI->input->post('text1');
		$gudang=$CI->input->post("text2");
		$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
		$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
		
		$sql="select ip.shipment_id,ip.date_received,ip.item_number,i.description,
		ip.unit,ip.cost,ip.total_amount,ip.doc_type,i.supplier_number,s.supplier_name
		 from inventory_products ip
			left join inventory i on i.item_number=ip.item_number
			left join suppliers s on s.supplier_number=i.supplier_number
			where ip.receipt_type in ('ETC','ETC_IN')  and ip.date_received between '$date1' and '$date2' ";
		if($kelompok!="")$sql.=" and i.category='$kelompok'";
		if($gudang!="")$sql.=" and ip.warehouse_code='$gudang'";
		$data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
		'group_by'=>array('shipment_id'))
		);
		 $data['header']=company_header();
		 $data['criteria']="Kelompok: $kelompok, Gudang: $gudang";
		 
		$this->load->view('simple_print.php',$data);    		
		
	}

?>