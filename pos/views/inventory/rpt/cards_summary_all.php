<?
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){
	 $data['date_from']=date('Y-m-d 00:00:00');
	 $data['date_to']=date('Y-m-d 23:59:59');
	 $data['select_date']=true;
	$data['criteria1']=true;
	$data['label1']='Kelompok Barang';
	$data['text1']='';
	$data['caption']='KARTU STOCK DETAIL';
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
} else {	
	$CI->load->model('company_model');
	$model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$kelompok= $CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>LAPORAN KARTU STOCK SUMMARY</h2></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->street?></td><td></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->suite?></td>     	
     </tr>
     <tr>
     	<td>
     		<?=$model->city_state_zip_code?> - Phone: <?=$model->phone_number?>
     	</td>
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Kelompok <?=$kelompok?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td>Kode Barang</td><td>Nama Barang</td><td>Kelompok</td> 
 				<td>Qty Awal</td><td>Qty Masuk</td><td>Qty Keluar</td><td>Qty Akhir</td>
				<td>Amt Awal</td><td>Amt Masuk</td><td>Amt Keluar</td><td>Amt Akhir</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?
     			$sql="select i.item_number,description,category,z_qty_awal,z_qty_masuk,z_qty_keluar,
				z_amt_awal,z_amt_masuk,z_amt_keluar
				from inventory i 
				left join (select item_number,sum(qty_masuk)-sum(qty_keluar) as z_qty_awal,
					sum(amount_keluar)-sum(amount_keluar) as z_amt_awal					from qry_kartustock_union
					where tanggal<'$date1'
					group by item_number)
					qawal on qawal.item_number=i.item_number 
				left join (select item_number,sum(qty_masuk) as z_qty_masuk,
					sum(qty_keluar) as z_qty_keluar,
					sum(amount_masuk) as z_amt_masuk,
					sum(amount_keluar) as z_amt_keluar
					from qry_kartustock_union
					where tanggal between '$date1' and '$date2'
					group by item_number)
					qtran on qtran.item_number=i.item_number 
					
				order by i.description";
				$rst_item=$CI->db->query($sql);
     			$tbl="";
				foreach($rst_item->result() as $row){
					$tbl.="<tr>";
					$tbl.="<td>".$row->item_number."</td>";
					$tbl.="<td>".$row->description."</td>";
					$tbl.="<td>".($row->category)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_qty_awal)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_qty_masuk)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_qty_keluar)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_qty_awal+$row->z_qty_masuk-$row->z_qty_keluar)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_amt_awal)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_amt_masuk)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_amt_keluar)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_amt_awal+$row->z_amt_masuk-$row->z_amt_keluar)."</td>";
					$tbl.="</tr>";
				}
 			    echo $tbl;
				 
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
	<?php } ?>