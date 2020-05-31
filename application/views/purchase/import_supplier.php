<legend>Import Data Master Supplier</legend>
<div class='alert alert-info'>
    <p>Isi seting kolom dibawah ini sesuai dengan kolom di excel, 
        sesuaikan kolomnya dengan file TXT yang dipilih.
        File TXT yang diinput dari XLS harap di SAVE AS tab delimited.
        Periksa inputan jangan ada tanda koma atau kutip dua.
        Tekan tombol <strong>Choose File</strong> untuk memilih file TXT kemudian tekan tombol 
        <strong>Submit</strong> untuk mulai di proses.
        Contoh file template file TXT silahkan download disini 
         <?=anchor(base_url()."import/master_supplier.rar","master_supplier.rar")?> 
     </p>
</div>
<div style='color:red'><?=validation_errors()?></div>

<?php 
	echo form_open_multipart(base_url()."index.php/supplier/import_supplier","id='frmImport'");
?>
<table class='table2' width='90%'>
<tr><td colspan='4'><h4>SETING KOLOM</h4></td></tr>
<tr><td>Kode Supplier</td><td><?=form_input('kode',"A"," style='width:50px'")?></td>
	<td>Nama Supplier</td><td><input type='text' name='nama' id='nama' value='B' style="width:50px"></td>
    <td>Email</td><td><input type='text' name='email' value='O' style="width:50px"></td>	
</tr>
<tr><td>Alamat 1</td><td><input type='text' name='alamat1' value='C' style="width:50px"></td>
	<td>Alamat 2</td><td><input type='text' name='alamat2' value='D' style="width:50px"></td>
    <td>Tanggal tagih</td><td><input type='text' name='tgl_tagih' value='' style="width:50px"></td>
</tr>
<tr><td>Kota</td><td><input type='text' name='kota' value='E' style="width:50px"></td>
	<td>Wilayah</td><td><?=form_input('wilayah',"F"," style='width:50px' ")?></td>
    <td>Termin</td><td><input type='text' name='payment_terms' value='' style="width:50px"></td>
</tr>
<tr><td>Provinsi</td><td><input type='text' name='provinsi' value='N' style="width:50px"></td>
	<td>Negara</td><td><?=form_input('negara',"G"," style='width:50px' ")?></td>
    <td>Batas Kredit</td><td><input type='text' name='credit_limit' value='' style="width:50px"></td>
</tr>
<tr>
    <td>Telpon</td><td><input type='text' name='telpon' value='H' style="width:50px"></td>
    <td>Telpon 2</td><td><input type='text' name='no_telp2' value='' style="width:50px"></td>
	<td>Fax</td><td><?=form_input('fax',"I"," style='width:50px' ")?></td>
</tr>
<tr><td>Handphone</td><td><input type='text' name='hp' value='J' style="width:50px"></td>
	<td>Kode Salesman</td><td><input type='text' name='salesman' value='K' style="width:50px"></td>

</tr>
<tr><td>Kode Kelompok</td><td><input type='text' name='kelompok' value='L' style="width:50px"></td>
	<td>Kontrak Person</td><td><input type='first_name' name='first_name' value='N' style="width:50px"></td>
</tr>
<tr><td>Saldo Awal Hutang</td><td colspan="7">
        <input type='text' name='saldo' value='' style="width:50px">
        <i style='font-size:11px'>*apabila saldo_awal diisi proses import  akan otomatis 
           membuat nomor bukti baru faktur pembelian kredit sebagai saldo awal,
           dan total hutang akan mengupdate saldo awal perkiraan.   
        </i></td>
</tr>
<tr><td colspan=8> <input type='checkbox' name='chkUpdateCoaHutang' style="width:30px"/> 
Update master akun chart_of_acccount untuk saldo awal hutang.
<br/><i style='font-size:11px'>&nbsp &nbsp &nbsp *Pastikan kode akun perkiraan 
    sudah di setting sebelum anda klik proses </i>
    </td>
</tr>
<tr><td>&nbsp;</td></tr>    
	
<tr><td colspan=3><input type="file" name="file_excel" id="file_excel"  style="width:300px"/></td>
<td><input type='submit' value='Submit' name='submit' class='btn btn-primary'></td></tr>
</table>
