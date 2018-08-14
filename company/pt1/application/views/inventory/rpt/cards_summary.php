<?
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){
	 $data['date_from']=date('Y-m-d 00:00:00');
	 $data['date_to']=date('Y-m-d 23:59:59');
	 $data['select_date']=true;
	$data['criteria1']=true;
	$data['label1']='Kelompok Barang';
	$data['text1']='';
	
	$data['criteria2']=true;
	$data['label2']='Gudang';
	$data['text2']='';

	$data['criteria3']=true;
	$data['label3']='Kode Barang';
	$data['text3']='';
	
	$data['caption']='DAFTAR KARTU STOCK SUMMARY';
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
} else {	
	$CI->load->model('company_model');
	$model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$kel=$CI->input->post("text1");
	$gudang=$CI->input->post("text2");
	$kode=$CI->input->post("text3");
	
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
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td>Kode Barang</td><td>Nama Barang</td><td>Kelompok</td><td>Gudang</td>
 				<td>Qty Awal</td><td>Qty Masuk</td><td>Qty Keluar</td><td>Qty Akhir</td><td>Amount</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?
     			$sql="select item_number,description,category 
				from inventory where 1=1";
				if($kel!="")$sql.=" and category='$kel'";
				if($kode!="")$sql.=" and item_number='$kode'";
				$sql.=" order by description";
				$rst_item=$CI->db->query($sql);
				foreach($rst_item->result() as $row_item){
	     			$tbl="";
					$qty_awal=0;
					$qty_in=0;
					$qty_out=0;
					$qty_akhir=0;
					$amount=0;	

					$sql="select location_number from shipping_locations where 1=1";					
					if($gudang!="")$sql.=" and location_number='$gudang'";
					$sql.=" order by location_number";
					$rst_gdg=$CI->db->query($sql);
					foreach ($rst_gdg->result() as $row_gdg) {

		 		       $sql="select sum(k.qty_masuk)-sum(k.qty_keluar) as sisa_qty,
		 		        sum(k.amount_masuk)-sum(k.amount_keluar) as amount   
		                from qry_kartustock_union k
		                where k.gudang='".$row_gdg->location_number."' 
		                and  k.tanggal<'$date1' and item_number='".$row_item->item_number."'";
						
						
				        $row=$CI->db->query($sql)->row();
						if($row){
		                 	$qty_awal=$row->sisa_qty;
		               };

		 		       $sql="select sum(k.qty_masuk) as qty_in, sum(k.qty_keluar) as qty_out,
		 		        sum(k.amount_masuk)-sum(k.amount_keluar) as amount   
		                from qry_kartustock_union k
		                where k.gudang='".$row_gdg->location_number."' 
		                and  k.tanggal between '$date1' and '$date2' and item_number='".$row_item->item_number."'";
				        $row=$CI->db->query($sql)->row();
						if($row){
		                 	$qty_in=$row->qty_in;
		                 	$qty_out=$row->qty_out;
		               };

		 		       $sql="select sum(k.qty_masuk)-sum(k.qty_keluar) as sisa_qty,
		 		        sum(k.amount_masuk)-sum(k.amount_keluar) as amount   
		                from qry_kartustock_union k
		                where k.gudang='".$row_gdg->location_number."' 
		                and  k.tanggal<='$date2' and item_number='".$row_item->item_number."'";
				        $row=$CI->db->query($sql)->row();
						if($row){
		                 	$qty_akhir=$row->sisa_qty;
						    $amount=$row->amount;
		               };
					   if($qty_akhir!=0){
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row_item->item_number."</td>";
	                    $tbl.="<td>".$row_item->description."</td>";
	                    $tbl.="<td>".($row_item->category)."</td>";
	                    $tbl.="<td>".($row_gdg->location_number)."</td>";
	                    $tbl.="<td align='right'>".number_format($qty_awal)."</td>";
	                    $tbl.="<td align='right'>".number_format($qty_in)."</td>";
	                    $tbl.="<td align='right'>".number_format($qty_out)."</td>";
	                    $tbl.="<td align='right'>".number_format($qty_akhir)."</td>";
	                    $tbl.="<td align='right'>".number_format($amount)."</td>";
	                    $tbl.="</tr>";
						}
					}	//rst_gudang
                   /*  $tbl.="<tr>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td align='right'></td>";
                    $tbl.="<td align='right'></td>";
                    $tbl.="<td align='right'></td>";
                    $tbl.="<td align='right'></td>";
                    $tbl.="<td align='right'></td>";
                    $tbl.="</tr>"; */

				   echo $tbl;
				}	// rst_item
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
	<?php } ?>