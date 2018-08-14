<div class='alert alert-info'>Dibawah ini adalah data purchase request yang belum direalisasikan untuk 
dibuatkan nomor purchase order baru. Silahkan contreng pada tabel dibawah ini kemudian tekan tombol 
SUBMIT untuk membuatkan nomor purchase order yang akan dipesan kepada supplier atas item barang yang bersangkutan.
</div>
<?
if ($message<>'') {
	echo "<div class='alert alert-warning'>$message</div>";
}
?>
<form method='post' action='<?=base_url()?>index.php/purchase_request/create_multi_po'>
<?
echo "<table class='table2'><thead><tr><th>Nomor POR#</th><th>Tanggal</th><th>Proyek</th>
<th>Cabang</th><th>Department</th><th>Nama Pegawai</th><th>Tanggal RQ</th><th>Status</th>
<th>Kode Barang</th><th>Nama Barang</th><th>Qty</th><th>Unit</th>
<th>Supplier</th><th>Pilih</th></thead>
<tbody>";
foreach($recordset->result() as $row) {
	echo "<tr><td>$row->purchase_order_number</td><td>$row->po_date</td><td>$row->project_code</td>
	<td>$row->branch_code<td>$row->dept_code</td><td>$row->ordered_by</td><td>$row->due_date</td><td>$row->doc_status</td>
	<td>$row->item_number</td><td>$row->description</td><td>$row->quantity</td><td>$row->unit</td>
	<td>$row->supplier</td>
	<td><input type='checkbox' name='row_id[]' value='$row->line_number'></td>
	</tr>";
}
echo "</tbody></table>";
?>
<p></p>
<button type='submit' value='Submit' class='btn btn-primary'>SUBMIT</button>
</form>
<?
if(isset($retval)){
	var_dump($retval);
}
?>