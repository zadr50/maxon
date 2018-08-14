<legend>Import Data Master from TXT file</legend>
<p>Isi seting kolom dibawah ini sesuai dengan kolom di excel, 
sesuaikan kolomnya dengan file TXT yang dipilih.</p>
<p>File TXT yang diinput dari XLS harap di SAVE AS tab delimited</p>
<p>Periksa inputan jangan ada tanda koma atau kutip dua</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file TXT kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>
<p>Contoh file template file TXT silahkan download disini 
 <?=anchor(base_url()."import/coa.rar","coa.rar")?> </p>
<div style='color:red'><?=validation_errors()?></div>

<?php 
	echo form_open_multipart(base_url()."index.php/coa/import_excel","id='frmImport'");
?>
<table class='table' width='100%'>
<tr><td colspan='4'><h4>SETING KOLOM</h4></td></tr>
<tr><td>Kode Perkiraan</td><td><?=form_input('account',"A"," style='width:50px'")?></td>
	<td>Nama Perkiraan</td><td><input type='text' name='account_description' id='account_description' value='B' style="width:50px"></td>
</tr>
<tr><td>Kode Jenis (T: Type, H: Header, D: Detail)</td><td><input type='text' name='jenis' value='C' style="width:50px"></td>
	<td>Type Account</td><td><input type='text' name='account_type' value='D' style="width:50px"></td>
</tr>
<tr><td>Group</td><td><input type='text' name='group_type' value='E' style="width:50px"M></td>
	<td>Posisi (0: Debit, 1: Credit)</td><td><?=form_input('dbcr',"F"," style='width:50px' ")?></td>
</tr>
<tr><td>Saldo AWal</td><td><input type='text' name='saldo' value='G' style="width:50px"M></td>
</tr>
<tr><td colspan=3><input type='checkbox' name='hapus_dulu' value='1' checked style="width:50px">Hapus dulu akun yang ada</td></tr>
<tr><td colspan=3><input type='checkbox' name='auto_create_type' value='1'  checked style="width:50px">Buat otomatis type akun</td></tr>
<tr><td colspan=3><input type='checkbox' name='auto_create_group' value='1'  checked style="width:50px">Buat otomatis group akun</td></tr>
<tr><td colspan=3><input type="file" name="file_excel" id="file_excel" style="width:400px"/></td>
<td><input type='submit' value='Submit' name='submit' class='btn btn-primary'></td></tr>
</table>
