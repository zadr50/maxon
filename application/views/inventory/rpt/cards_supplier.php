<?php 
	 $CI =& get_instance();
	$data['caption']='KARTU STOCK SUMMARY GROUP BY SUPPLIER';
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$sql="select i.supplier_number,i.item_number,i.description,i.category,
			q.qty_akhir,q.amount_akhir
			from inventory i 
			left join (
				select item_number,sum(qty_masuk)-sum(qty_keluar) as qty_akhir,
				sum(amount_masuk)-sum(amount_keluar) as amount_akhir 
				from qry_kartustock_union 
				group by item_number
				) q on q.item_number=i.item_number 
			where q.qty_akhir<>0";
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		if($kel!="")$sql.=" and i.category='".$kel."'";
		$data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
		'group_by'=>array('supplier_number'))
		);
		 $data['header']=company_header();
		$this->load->view('simple_print.php',$data);    		
		
	}

?>