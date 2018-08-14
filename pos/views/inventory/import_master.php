<legend>Import Data Barang from TXT file</legend>
<p>Isi seting kolom dibawah ini sesuai dengan kolom di excel, 
sesuaikan kolomnya dengan file TXT yang dipilih.</p>
<p>File TXT yang diinput dari XLS harap di SAVE AS tab delimited</p>
<p>Periksa inputan jangan ada tanda koma atau kutip dua</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file TXT kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>
<p>Contoh file template pembayaran file TXT silahkan download disini 
 <?=anchor(base_url()."import/master_barang.rar","master_barang.rar")?> </p>
<div style='color:red'><?=validation_errors()?></div>

<?php 
	echo form_open_multipart(base_url()."index.php/inventory/import_excel","id='frmImport'");
?>
<table class='table' width='100%'>
<tr><td colspan='4'><h4>SETING KOLOM</h4></td></tr>
<tr><td>Kode Barang</td><td><?=form_input('kode',"A"," style='width:50px'")?></td>
	<td>Nama Barang</td><td><input type='text' name='nama' id='nama' value='B' style="width:50px"></td></tr>
<tr><td>Harga Jual Standard</td><td><input type='text' name='jual' value='C' style="width:50px"></td>
	<td>Harga Beli</td><td><input type='text' name='beli' value='D' style="width:50px"></td></tr>
<tr><td>Satuan</td><td><input type='text' name='satuan' value='E' style="width:50px"></td>
	<td>Kode Supplier</td><td><?=form_input('supplier',"F"," style='width:50px' ")?></td></tr>
<tr><td>Item Class</td><td><input type='text' name='item_class' value='N' style="width:50px"></td>
	<td>Kode Kategori 1</td><td><?=form_input('categori1',"G"," style='width:50px' ")?></td></tr>
<tr><td>Kode Kategori 2</td><td><input type='text' name='categori2' value='H' style="width:50px"></td>
	<td>Kode Kategori 3</td><td><?=form_input('categori3',"I"," style='width:50px' ")?></td></tr>
<tr><td>Cost</td><td><input type='text' name='cost' value='J' style="width:50px"></td>
	<td>Harga Jual 1</td><td><input type='text' name='jual1' value='K' style="width:50px"></td>
	</tr>
<tr><td>Harga Jual 2</td><td><input type='text' name='jual2' value='L' style="width:50px"></td>
	<td>Harga Jual 3</td><td><input type='text' name='jual3' value='M' style="width:50px"></td>
	</tr>
<tr><td>Kode Divisi</td><td><input type='text' name='division' value='N' style="width:50px"></td>
	<td></td><td></td>
	</tr>
	
<tr><td colspan=3><input type="file" name="file_excel" id="file_excel"/></td>
<td><input type='submit' value='Submit' name='submit' class='btn btn-primary'></td></tr>
</table>
