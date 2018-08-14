<?php 
	 $CI =& get_instance();
	$data['caption']='HISTORY TRANSAKSI BARANG';
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
		$data['criteria2']=true;
		$data['label2']='Kode Barang';
		$data['text2']='';
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
		$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
		$sql="select i.item_number,i.description,i.category,
			q.tanggal,q.jenis,q.no_sumber,q.qty_masuk,q.qty_keluar,
			q.amount_masuk,q.amount_keluar,q.cost,q.comments
			from inventory i 
			left join qry_kartustock_union q 
			on q.item_number=i.item_number 
			where q.tanggal between '$date1' and '$date2'
			order by i.item_number
			";
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		if($kel!="")$sql.=" and i.category='".$kel."'";
		$item=""; if($CI->input->post('text2'))$item=$CI->input->post('text2');
		if($item!="")$sql.=" and i.item_number='$item'";
		$data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
		'group_by'=>array('item_number'),'order_by'=>array('item_number'))
		);
		 $data['header']=company_header();
		$this->load->view('simple_print.php',$data);    		
		
	}

?>