<!-- item description -->
<table class='table'>
	<tr><td>Kode </td><td><?=$item->item_number?></td></tr>
	<tr><td>Nama Barang</td><td><b><?=$item->description?></b></td></tr>
	<tr><td>Harga </td><td>
		<span style='font-size:20px'> Rp. <?=number_format($item->retail)?></span></td>
	</tr>
	<tr><td>Quantity</td>
		<td>
			<button onclick="min_qty();return false;" class="btn btn-warning" value="-">-</button>
			<input type='text' id='txtQty' name='txtQty' id='txtQty' style='font-size:14px;width:50px' value='1'>
			<button onclick="add_qty();return false;" class="btn btn-warning" value="+">+</button>
		</td>
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
<script language="JavaScript">
	function min_qty(){
		var qty=$("#txtQty").val();
		qty--;
		if(qty<2)qty=1;
		$("#txtQty").val(qty);
	}
	function add_qty(){
		var qty=$("#txtQty").val();
		qty++;
		$("#txtQty").val(qty);
	}
</script>
