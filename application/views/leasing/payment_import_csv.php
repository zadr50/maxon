<legend>Import Payment from CSV file</legend>
<?=form_open_multipart(base_url()."index.php/leasing/payment/import_csv");?>
<p>Isi seting kolom dibawah ini dengan angka (123456789), 
sesuaikan kolomnya dengan file SCV atau XLS yang dipilih.</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file CSV kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>
<p>Contoh file template pembayaran file CSV silahkan download disini 
 <?=anchor(base_url()."import/payment.csv","payment.csv")?> </p>
<div style='color:red'><?=validation_errors()?></div>
<table class='table2' width='100%'>
<tr><td colspan='4'><h4>SETING KOLOM</h4></td></tr>
<tr><td>Nomor Tagihan</td><td><?=form_input('nomor',1," style='width:50px'")?></td>
	<td>Jenis Bayar</td><td><input type='text' name='jenis' id='jenis' value='2' style="width:50px"></td></tr>
<tr><td>Tanggal Bayar</td><td><input type='text' name='tanggal' value='3' style="width:50px"></td>
	<td>Jumlah Bayar</td><td><input type='text' name='jumlah' value='4' style="width:50px"></td></tr>
<tr><td>Keterangan</td><td><input type='text' name='keterangan' value='5' style="width:50px"></td><td></td><td></td></tr>
<tr><td colspan=3><input type="file" name="file_excel" id="file_excel"/></td>
<td><input type='submit' value='Submit' name='submit'></td></tr>
</table>
</form>
