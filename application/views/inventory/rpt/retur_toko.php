<?php 
	$CI =& get_instance();
	$data['caption']='DAFTAR RETUR TOKO';
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
         $data['key1']="kode";
         $data['fields1'][]=array("kode","80","Kode");
         $data['fields1'][]=array("category","180","Kelompok");
         $data['ctr1']='category/select';


		$data['criteria1']=true;
		$data['label1']='Outlet';
		$data['text1']='';
         $data['key1']="location_number";
         $data['fields1'][]=array("location_number","80","Gudang");
         $data['ctr1']='gudang/select';

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



		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
		$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
		$gudang = $CI->input->post('text1');
		$supp=$CI->input->post("text2");
		
		$sql="select ip.date_received as tanggal, 
		ip.item_number,i.description,
		concat(s.supplier_name,' (',ip.supplier_number,')') as supplier,		
		ip.quantity_received as qty,
		ip.unit,ip.cost,ip.total_amount,ip.shipment_id,ip.doc_type
		 from inventory_products ip
			join inventory i on i.item_number=ip.item_number
			left join suppliers s on s.supplier_number=i.supplier_number
		where ip.receipt_type='ETC_OUT' and ip.doc_type='2' and ip.date_received between '$date1' and '$date2' 
		
		";
		
				
		if($supp!=""){
			$sql.=" and ip.supplier_number='$supp'";
		}
		if($gudang!="")$sql.=" and ip.warehouse_code='$gudang'";
		
		//$sql.="order by concat(g.keterangan,' (',ip.ref2,')') ";
		$data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
			"fields_sum"=>array("total_amount")
			)
		);
		
		 $data['header']=company_header();
		 $data['criteria']="Periode: $date1 s/d $date2, Outlet: $gudang, Supplier: $supp" ;
		 
		$this->load->view('simple_print.php',$data);    		
		
	}

?>