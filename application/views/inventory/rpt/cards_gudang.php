

<?php 
	 $CI =& get_instance();
	$data['caption']='KARTU STOCK SUMMARY GROUP BY GUDANG';
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

		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$kelompok= $CI->input->post('text1');
		$gudang=$CI->input->post("text2");
		
		$sql="select q.gudang,i.item_number,i.description,
			concat(ic.category,' (',i.category,')') as category,
			q.qty_akhir,q.amount_akhir
			from inventory i 
			left join (
				select item_number,gudang,sum(qty_masuk)-sum(qty_keluar) as qty_akhir,
				sum(amount_masuk)-sum(amount_keluar) as amount_akhir 
				from qry_kartustock_union 
				group by item_number,gudang
				) q on q.item_number=i.item_number 
			left join inventory_categories ic on ic.kode=i.category
			where q.qty_akhir<>0 ";
		if($kelompok!="")$sql.=" and i.category='$kelompok'";
		if($gudang!="")$sql.=" and q.gudang='$gudang'";
		$data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
		'group_by'=>array('item_number'))
		);
		 $data['header']=company_header();
		 $data['criteria']="Kelompok: $kelompok, Gudang: $gudang";
		 
		$this->load->view('simple_print.php',$data);    		
		
	}

?>