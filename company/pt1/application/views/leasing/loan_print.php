<h4>INFORMASI KONTRAK KREDIT</h4>  
<table style='width:100%' class='table'>
	<tr><td>Nomor Kredit</td><td><?=$loan_id?></td>
		<td>Tanggal</td><td><?=$loan_date?></td></tr>
	<tr><td>Nomor Permohonan </td>
		<td ><?=$app_id?></td>
		<td>Tanggal Penagihan</td>
		<td><?=$loan_date_aggr?>
		</td></tr>
	</tr> 
	<tr><td>Kode Pelanggan </td><td><?=$cust_id?></td>
		<td>Nama Pelanggan </td><td><?=$cust_name?></td>
			</tr> 
	<tr><td>Jumlah Pinjaman</td><td><?=number_format($loan_amount)?></td>
		<td>Tenor</td><td><?=$max_month?> bulan</td>
		</tr> 
	<tr><td>Angsuran Per Bulan</td><td><?=number_format($inst_amount)?></td>
		<td>Status</td>
			<td><?=$status?>
		</td>
		</tr> 
	<tr><td>Nama Sales Agent (SA) </td><td><?=$sales_name?></td>
		<td>Kode Sales Agent </td><td><?=$sales_id?></td></tr> 
	<tr><td>Kode Counter </td><td><?=$dealer_id?></td>
		<td>Nama Counter </td><td><?=$dealer_name?></td></tr> 
</table>
<H4>DATA BARANG </H4>
<table class='table'>
<thead>
	<tr><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th><th>Unit</th><th>Harga</th><th>Jumlah</th></tr>
</thead>
<tbody>
	<? foreach($items->result() as $row) 
	{ 
		echo "<tr><td>$row->obj_item_id</td><td>$row->obj_desc</td>
		<td>$row->qty</td><td>$row->unit</td><td>$row->price</td>
		<td>$row->amount</td>
		</tr>";
	}
	?>
</tbody>
</table>

<h4>DATA TAGIHAN </h4>
<table class='table'>
<thead>
	<tr><th>Bulan Ke</th><th>Tanggal</th><th>Faktur#</th>
	<th>Pokok</th><th>Bunga</th><th>Jumlah</th>
	<th>Telat</th><th>Denda</th><th>LUnas</th>
	<th>Tgl Bayar</th><th>Jumlah Bayar</th><th>Bunga Bayar</th>
	<th>Denda Bayar</th><th>Saldo</th>
	</tr>
</thead>
<tbody>
	<? foreach($invoice->result() as $row) 
	{ 
		echo "<tr><td>$row->idx_month</td><td>".Date("y-m-d",strtotime($row->invoice_date))."</td>
		<td>$row->invoice_number</td>
		<td>$row->pokok</td><td>$row->bunga</td><td>$row->amount</td>
		<td>$row->hari_telat</td><td>$row->denda_tagih</td><td>$row->paid</td>
		<td>".Date("y-m-d",strtotime($row->date_paid))."</td><td>$row->amount_paid</td><td>$row->bunga_paid</td>
		<td>$row->denda</td><td>$row->saldo</td>
		</tr>";
	}
	?>
</tbody>
</table>

<script language="javascript">
</script>