

<?php 
	 $CI =& get_instance();
	$data['caption']='PENGELUARAN BARANG LAINNYA - BY TYPE';
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
		 
		 
		$data['criteria3']=true;
		$data['label3']='Supplier';
		$data['text3']='';
         $data['key3']="supplier_number";
         $data['fields3'][]=array("supplier_number","80","Kode");
         $data['fields3'][]=array("supplier_name","180","Supplier");
         $data['ctr3']='supplier/select';

		$data['criteria4']=true;
		$data['label4']='Proyek';
		$data['text4']='';
         $data['key4']="kode";
         $data['fields4'][]=array("kode","80","Kode");
         $data['fields4'][]=array("keterangan","180","Proyek");
         $data['ctr4']='project/project/select';


		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
		$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
		$kelompok= $CI->input->post('text1');
		$gudang=$CI->input->post("text2");
		$supp=$CI->input->post("text3");
		$proj=$CI->input->post("text4");
		
		$sql="select ip.date_received as tanggal, 
		concat(g.keterangan,' (',ip.ref2,')') as proyek,
		ip.item_number,i.description,
		concat(s.supplier_name,' (',ip.supplier_number,')') as supplier,		
		ip.quantity_received as qty,
		ip.unit,ip.cost,ip.total_amount,ip.shipment_id,ip.doc_type
		 from inventory_products ip
			left join inventory i on i.item_number=ip.item_number
			left join suppliers s on s.supplier_number=i.supplier_number
			left join gl_projects g on g.kode=ip.ref2
		where ip.receipt_type='ETC_OUT' and ip.date_received between '$date1' and '$date2'  ";
		
		
		if($supp!=""){
			$sql.=" and ip.supplier_number='$supp'";
		}
		if($proj!=""){
			$sql.=" and ip.ref2='$proj'";
		}
		
		if($kelompok!="")$sql.=" and i.category='$kelompok'";
		if($gudang!="")$sql.=" and ip.warehouse_code='$gudang'";
		$data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
			'group_by'=>array('doc_type'))
		);
		 $data['header']=company_header();
		 $data['criteria']="Periode: $date1 s/d $date2, Kelompok: $kelompok, Gudang: $gudang, 
		 	Supplier: $supp, Proyek: $proj" ;
		 
		$this->load->view('simple_print.php',$data);    		
		
	}

?>