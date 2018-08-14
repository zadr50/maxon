<legend>Import Payment from CSV file</legend>
<?=form_open_multipart(base_url()."index.php/leasing/payment/import_csv_bca");?>
<p>Isi seting kolom dibawah ini dengan angka (123456789), 
sesuaikan kolomnya dengan file SCV atau XLS yang dipilih.</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file CSV kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>
<p>Contoh file template pembayaran file CSV silahkan download disini 
 <?=anchor(base_url()."import/payment_bca.csv","payment_bca.csv")?> </p>
<div style='color:red'><?=validation_errors()?></div>
<table class='table2' width='100%'>
<tr><td colspan='4'><h4>SETING KOLOM</h4></td></tr>
<tr><td>Kode Perusahaan</td><td><?=form_input('kode_per',1," style='width:50px'")?></td>
	<td>Kode Sub Perusahaan</td><td><input type='text' name='kode_sub' id='kode_sub' value='2' style="width:50px"></td></tr>
<tr><td>Nomor Pelanggan</td><td><input type='text' name='cust_id' value='3' style="width:50px"></td>
	<td>Nama Pelanggan</td><td><input type='text' name='cust_name' value='4' style="width:50px"></td></tr>
<tr><td>Mata Uang</td><td><input type='text' name='curr_code' value='5' style="width:50px"></td>
	<td>Jumlah Bayar</td><td><?=form_input('jumlah',6," style='width:50px' ")?></td></tr>
<tr><td>Tanggal</td><td><input type='text' name='tanggal' value='7' style="width:50px"></td>
	<td>Waktu</td><td><?=form_input('waktu',8," style='width:50px' ")?></td></tr>
<tr><td>Lokasi</td><td><input type='text' name='lokasi' value='9' style="width:50px"></td>
	<td>Berita 1</td><td><?=form_input('berita1',10," style='width:50px' ")?></td></tr>
<tr><td>Berita 2</td><td><input type='text' name='berita2' value='11' style="width:50px"></td>
	</tr>
	
<tr><td colspan=3><input type="file" name="file_excel" id="file_excel"/></td>
<td><input type='submit' value='Submit' name='submit'></td></tr>
</table>
</form>
