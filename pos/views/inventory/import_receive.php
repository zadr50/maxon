<legend>Import Transaksi Penerimaan Barang</legend>
<p>Isi seting kolom dibawah ini sesuai dengan kolom di excel, 
sesuaikan kolomnya dengan file TXT yang dipilih.</p>
<p>File TXT yang diinput dari XLS harap di SAVE AS tab delimited</p>
<p>Periksa inputan jangan ada tanda koma atau kutip dua</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file TXT kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>
<p>Contoh file template file TXT silahkan download disini 
 <?=anchor(base_url()."import/receive.rar","receive.rar")?> </p>
<div style='color:red'><?=validation_errors()?></div>

<?php 
	echo form_open_multipart(base_url()."index.php/receive/import_receive","id='frmImport'");
?>
<table class='table' width='100%'>
<tr><td colspan='4'><h4>SETING KOLOM</h4></td></tr>
<tr><td>Gudang</td><td><?=form_input('gudang',"A"," style='width:50px'")?></td>
	<td>Tanggal</td><td><input type='text' name='tanggal' id='tanggal' value='B' style="width:50px"></td></tr>
<tr><td>Terima Oleh</td><td><input type='text' name='person' value='C' style="width:50px"></td>
	<td>Item Number</td><td><input type='text' name='item_no' value='D' style="width:50px"></td></tr>
<tr><td>Quantity</td><td><input type='text' name='qty' value='E' style="width:50px"></td>
	<td>Unit</td><td><?=form_input('unit',"F"," style='width:50px' ")?></td></tr>
<tr><td>Cost</td><td><input type='text' name='cost' value='G' style="width:50px"></td>
	<td>&nbsp</td><td>&nbsp</td></tr>
<tr><td colspan=3><input type="file" name="file_excel" id="file_excel"/></td>
<td><input type='submit' value='Submit' name='submit' class='btn btn-primary'></td></tr>
</table>