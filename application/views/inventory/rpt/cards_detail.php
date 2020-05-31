<?php
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){
	 $data['date_from']=date('Y-m-d 00:00:00');
	 $data['date_to']=date('Y-m-d 23:59:59');
	 $data['select_date']=true;
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

	$data['criteria3']=true;
	$data['label3']='Kode Barang';
	$data['text3']='';
         $data['key3']="item_number";
         $data['fields3'][]=array("item_number","80","Kode");
         $data['fields3'][]=array("description","180","Nama Barang");
         $data['ctr3']='inventory/select';
	
	$data['caption']='KARTU STOCK DETAIL';
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
} else {	
	$CI->load->model('company_model');
	$model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$kelompok= $CI->input->post('text1');
	$gudang=$CI->input->post("text2");
	$kode_barang=$CI->input->post("text3");
	if($kode_barang==""){
		echo "<b>Pilih kode barang !</b>";
		exit;
	}
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td><h2>KARTU STOCK DETAIL</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Kelompok: <?=$kelompok?>
     		Gudang: <?=$gudang?>, Kode Barang: <?=$kode_barang?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem' width='100%'	>
 		<thead>
 			<tr><td>Tanggal</td><td>Jenis</td><td>Nomor</td> 
 				<td>Qty Masuk</td><td>Qty Keluar</td><td>Qty Akhir</td>
				<td>Amt Masuk</td><td>Amt Keluar</td><td>Amt Akhir</td>
				<td>Gudang</td><td>Keterangan</td><td>Ref1</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?php
     			$sql="select i.item_number,description,category,z_qty_awal,z_amt_awal
				from inventory i 
				left join (select item_number,sum(qty_masuk)-sum(qty_keluar) as z_qty_awal,
					sum(amount_keluar)-sum(amount_keluar) as z_amt_awal					from qry_kartustock_union
					where tanggal<'$date1'";
				if($gudang!="")$sql.=" and gudang='$gudang'";
				$sql.="	group by item_number) qawal on qawal.item_number=i.item_number";
				$sql.=" where 1=1";
				if($kelompok!="")$sql.=" and i.category='$kelompok'";
				if($kode_barang!="")$sql.=" and i.item_number='$kode_barang'";
				
				$sql.=" order by i.description";
				$rst_item=$CI->db->query($sql);
				$amt_in_tot=0;
				$amt_out_tot=0;
					$qty_masuk_tot=0;
					$qty_keluar_tot=0;
				foreach($rst_item->result() as $row){
					$tbl=""; $qty_awal=$row->z_qty_awal;$qty_tran=$qty_awal;
					$amt_awal=$row->z_amt_awal;$amt_tran=$amt_awal;
					$tbl.="<tr>";
					$tbl.="<td colspan='11'><h1>".$row->description.' - ['.$row->item_number."]</h1></td>";
					$tbl.="<td></td></tr>";
					
					$sql="select tanggal,jenis,no_sumber,qty_masuk,qty_keluar,cost,
					amount_masuk,amount_keluar,gudang,comments
					from qry_kartustock_union q
					where tanggal between '$date1' and '$date2'
					and item_number='".$row->item_number."'";
					if($gudang!="")$sql.=" and gudang='$gudang'";
					$sql.="	order by tanggal";
					
					//echo $sql;exit;
					
					$rst_card=$CI->db->query($sql);
					$tbl.="<tr><td>SALDO AWAL</td><td>&nbsp</td><td>&nbsp</td>
					<td>&nbsp</td><td>&nbsp</td><td align='right'>".number_format($qty_awal)."</td>
					<td>&nbsp</td><td>&nbsp</td><td align='right'>".number_format($amt_awal)."</td>
					<td>&nbsp</td><td>&nbsp</td><td></td></tr>";
					
					foreach($rst_card->result() as $card) {
						$qty_tran=$qty_tran+($card->qty_masuk-$card->qty_keluar);
						$amt_tran=$amt_tran+($card->amount_masuk-$card->amount_keluar);
						$no_sumber=$card->no_sumber;
						$jenis=$card->jenis;
						$ref1="";
						if($jenis=="PO"){
							$sql="select purchase_order_number from inventory_products 
							where shipment_id='$no_sumber' and purchase_order_number<>'' limit 1";
							if($q=$this->db->query($sql)){
								if($r=$q->row()){
									$ref1=$r->purchase_order_number;
								}
							}
						}
						
						$tbl.="<tr>";
						$tbl.="<td>$card->tanggal</td><td>$jenis</td><td>$no_sumber</td>";
						$tbl.="<td align='right'>".number_format($card->qty_masuk,2)."</td>";
						$tbl.="<td align='right'>".number_format($card->qty_keluar,2)."</td>";
						$tbl.="<td align='right'>".number_format($qty_tran,2)."</td>";
						$tbl.="<td align='right'>".number_format($card->amount_masuk)."</td>";
						$tbl.="<td align='right'>".number_format($card->amount_keluar)."</td>";
						$tbl.="<td align='right'>".number_format($amt_tran)."</td>";
						$tbl.="<td>$card->gudang</td>";
						$tbl.="<td>$card->comments</td>";
						$tbl.="<td>$ref1</td>";
						$tbl.="</tr>";
						
						$amt_in_tot+=$card->amount_masuk;
						$amt_out_tot+=$card->amount_keluar;
						$qty_masuk_tot+=$card->qty_masuk;
						$qty_keluar_tot+=$card->qty_keluar;
												
					}	//rst_card
					$tbl.="<tr>";
					$tbl.="<td><b>TOTAL</b></td><td></td><td></td>";
					$tbl.="<td align='right'><b>".number_format($qty_masuk_tot,2)."</b></td>";
					$tbl.="<td align='right'><b>".number_format($qty_keluar_tot,2)."</b></td>";
					$tbl.="<td align='right'></td>";
					$tbl.="<td align='right'><b>".number_format($amt_in_tot)."</b></td>";
					$tbl.="<td align='right'><b>".number_format($amt_out_tot)."</b></td>";
					$tbl.="<td align='right'></td>";
					$tbl.="<td></td>";
					$tbl.="<td></td>";
					$tbl.="<td></td>";
					$tbl.="</tr>";


					if($rst_card->num_rows()){
						
						echo $tbl;
					
					}
					
					
				}	//rst_item
				 
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
	<?php } ?>