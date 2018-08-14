<?php
$CI =& get_instance();
$CI->load->model('supplier_model');
$sup=$CI->supplier_model->get_by_id($supplier)->row();

?>
<table> 
<tr><td colspan='5' align='center'><h1>PURCHASE ORDER</h1></td><td></td></tr>
<tr><td>Nomor: </td><td><h3><?=$po_number?></h3></td><td></td></tr>      	
<tr><td>Tanggal </td><td><?=$tanggal?></td><td></td></tr>
<tr><td>Termin <?=$terms?></td><td></td></tr> 
<tr><td></td><td></td></tr>
<tr><td><h2>Kepada Yth,</h2></td><td></td></tr>
 <tr><td><?=$sup->supplier_name.' ('.$sup->supplier_number.')'?></td><td></td></tr> 
<tr><td><?=$sup->street?></td><td></td></tr> 
<tr><td><?=$sup->suite.' - '.$sup->city?></td><td></td></tr> 
<tr><td><?='Phone: '.$sup->phone.' - Fax: '.$sup->fax?></td><td></td></tr> 
<tr><td><?='Up: '.$sup->first_name?></td><td></td></tr> 
<tr><td></td><td></td></tr>
</table> 
<table cellspacing="0" cellpadding="1" border="1" >
	 
		<tr><th>Kode Barang</th><th width="200">Nama Barang</th>
		<th width="30">Qty</th><th width="30">Unit</th><th>Harga</th>
			<th width="30">Disc%2</th><th width="30">Disc%3</th><th width="30">Disc%</th><th>Jumlah</th>
		</tr>
 
		<?
	   $sql="select item_number,description,quantity,unit,discount,
			price,total_price,disc_2,disc_3 
				from purchase_order_lineitems i
				where purchase_order_number='".$po_number."'";
		$query=$CI->db->query($sql);

		$tbl="";
		 foreach($query->result() as $row){
			$tbl.="<tr>";
			$tbl.="<td>".$row->item_number."</td>";
			$tbl.="<td width=\"200\">".$row->description."</td>";
			$tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
			$tbl.="<td width=\"30\">".$row->unit."</td>";
			$tbl.="<td align=\"right\">".number_format($row->price)."</td>";
			$tbl.="<td width=\"30\" align=\"right\">".($row->discount)."</td>";
			$tbl.="<td width=\"30\" align=\"right\">".($row->disc_2)."</td>";
			$tbl.="<td width=\"30\" align=\"right\">".($row->disc_3)."</td>";
			$tbl.="<td align=\"right\">".number_format($row->total_price)."</td>";
			$tbl.="</tr>";
	   };
	   echo $tbl;
		?>
	 
</table> 

<table width="100%">
     <tr><td>Catatan : </td><td><?=$comments?></td></tr>
	 <tr><td>Sub Total </td><td align="right"><?=number_format($sub_total)?></td></tr>
     <tr><td>Discount [<?=$discount?>]</td><td align="right"><?=number_format($disc_amount)?></td></tr>
     <tr><td>Pajak <?=$tax?> </td><td  align="right"><?=number_format($tax_amount)?></td></tr>
     <tr><td>Ongkos </td><td  align="right"><?=number_format($freight)?></td></tr>
     <tr><td>Lain-lain </td><td  align="right"><?=number_format($others)?></td></tr>
     <tr><td><strong>Jumlah </strong></td><td  align="right"><strong><?=number_format($amount)?></strong></td></tr>

</table> 