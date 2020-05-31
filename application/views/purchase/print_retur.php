<?php
         $CI =& get_instance();
         $CI->load->model('company_model');
         $model=$CI->company_model->get_by_id($CI->access->cid)->row();
         $CI->load->model('supplier_model');
         $sup=$CI->supplier_model->get_by_id($supplier)->row();

?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>RETUR PEMBELIAN</h2></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->street?></td><td>Nomor: <?=$po_number?></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->suite?></td><td>Outlet: <b><?=$invoice->warehouse_code?></b></td>     	
     </tr>
     <tr>
     	<td colspan=4 style='border-bottom: black solid 1px'><?=$model->city_state_zip_code?> - Phone: <?=$model->phone_number?>
     	</td>     	
     	
     </tr>
     <tr>
     	<td>Tanggal</td><td><?=$tanggal?></td>
     	<td colspan='2'><?=$sup->supplier_name.' ('.$sup->supplier_number.')'?></td>
     </tr>
     <tr>
     	<td>Termin</td><td><?=$terms?></td>
     	<td colspan='2'><?=$sup->street?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan='2'><?=$sup->suite.' - '.$sup->city?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan='2'><?='Phone: '.$sup->phone.' - Fax: '.$sup->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan='2'><?='Up: '.$sup->first_name?></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table class='titem'>
     		<thead>
     			<tr><td width='10'>No</td><td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td><td>Harga</td>
     				<td>Disc%</td><td>Jumlah</td>
     			</tr>
     		</theadx>
     		<tbody>
     			<?php
		       $sql="select item_number,description,quantity,unit,discount,price,total_price 
		                from purchase_order_lineitems i
		                where purchase_order_number='".$po_number."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
				$no=0;
                 foreach($query->result() as $row){
                 	$no++;
                    $tbl.="<tr><td>$no</td>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td align='right'>".number_format($row->quantity)."</td>";
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="<td align='right'>".number_format($row->price)."</td>";
                    $tbl.="<td align='right'>".number_format($row->discount)."</td>";
                    $tbl.="<td align='right'>".number_format($row->total_price)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td>Catatan: <?=$comments?></td><td></td><td>Sub Total</td><td align='right'><?=number_format($sub_total)?></td></tr>
     <tr><td></td><td></td><td>Discount <?=$discount?></td><td align='right'><?=number_format($disc_amount)?></td></tr>
     <tr><td></td><td></td><td>Pajak <?=$tax?></td><td align='right'><?=number_format($tax_amount)?></td></tr>
     <tr><td></td><td></td><td>Ongkos</td><td align='right'><?=number_format($freight)?></td></tr>
     <tr><td></td><td></td><td>Lain-lain</td><td align='right'><?=number_format($others)?></td></tr>
     <tr><td></td><td></td><td>Jumlah</td><td align='right'><?=number_format($amount)?></td></tr>
     <tr><td>Dibuat</td><td>Diperiksa</td><td>Diterima</td><td></td></tr>
</table>
