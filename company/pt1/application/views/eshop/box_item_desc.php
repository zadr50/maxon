<!-- item description -->
 <h2><?=$item->description?></h2>
<table class='table'>
	<tr><td>Kode </td><td><?=$item->item_number?></td></tr>
	<tr><td>Harga </td><td>
		<span style='font-size:20px'> Rp. <?=number_format($item->retail)?></span></td>
	</tr>
	<tr><td>Quantity</td>
		<td><input type='text' name='txtQty' id='txtQty' style='width:50px' value='1'></td>
	</tr>
	<tr><td></td><td>
		<input style='width:100%;margin-top:20px' type='button' class='btn btn-primary' onclick='beli()' value='BELI'>
	</td>
	</tr>
</table> 
<div class=''>
	<?php
	$content=$item->special_features;
	$content=strip_tags($content,"<b><i><strong><p><h1><br><h2><h3><li>");
	echo $content;
	?>
</div>
