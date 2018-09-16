 
	<div class="row" >
		<?php
		echo "<h3>List Order Number</h3>
		<table class='table'><thead><th>Order#</th><th>Tanggal</th><th>Jumlah</th><th>Lunas</th></thead>
		<tbody>";
		foreach($so_list->result() as $so_row)
		{
			echo "<tr><td>
			<a href='".base_url()."index.php/eshop/sales/view/"
			.$so_row->sales_order_number."'>$so_row->sales_order_number</a></td>
			<td>$so_row->sales_date</td>
			<td align='right'>".number_format($so_row->amount)."</td><td>$so_row->paid</td></tr>";
		}		
		echo "</tbody></table>";
		?>
	</div>
	<div class="row ">
		<?php include_once "sales_form.php"; ?>

	</div>
 
<script language='javascript'>
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
