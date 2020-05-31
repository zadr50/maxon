 
	<div class="col-lg-4" >
		<?php
		echo "<h3>List Order Number</h3>
		<table class='table'><thead><th>Order#</th><th>Tanggal</th><th>Jumlah</th>
		<th>Lunas</th><th>Kirim</th></thead>
		<tbody>";
		foreach($so_list->result() as $so_row)
		{
			echo "<tr><td>
			<a href='".base_url()."index.php/eshop/sales/view/"
			.$so_row->sales_order_number."'>$so_row->sales_order_number</a></td>
			<td>$so_row->sales_date</td>
			<td align='right'>".number_format($so_row->amount)."</td><td>$so_row->paid</td>
			<td>$so_row->status</td></tr>";
		}		
		echo "</tbody></table>";
		?>
	</div>
	<div class="col-lg-6 ">
		<?php echo load_view("eshop/sales/sales_form",array("cmd"=>$cmd))?>

	</div>
<div class='col-lg-12'>
<?=load_view("eshop/status_info")?>	
</div>	
 
<script language='javascript'>
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
