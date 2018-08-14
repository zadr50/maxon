 
	<h3>Invoice Information</h3>
	<table class='table'>
	<tr><td>Nomor Order </td><td><h4><?=$so->sales_order_number?></h4></td></tr>
	<tr><td>Tanggal </td><td><?=$so->sales_date?></td></tr>
	<tr><td>Status Pesanan </td><td><?=$status_order[$so->status]?></td></tr>
	<tr><td>Status Pembayaran </td><td><?=$status_payment[$so->paid]?></td></tr>
	<tr><td>Nama Pelanggan</td><td><?=$cust->company?></td></tr>
	<tr><td>Alamat </td><td><?=$cust->street?></td></tr>
	<tr><td>Kota / Kode Pos </td><td><?=$cust->city." / ".$cust->zip_postal_code ?></td></tr>
	<tr><td>Email / Phone </td><td><?=$cust->email." / ".$cust->phone?></td></tr>
	</table>
 

