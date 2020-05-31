<legend>Import Data Absensi</legend>
<p>Isi seting kolom dibawah ini sesuai dengan kolom di excel, 
sesuaikan kolomnya dengan file TXT yang dipilih.</p>
<p>File TXT yang diinput dari XLS harap di SAVE AS dengan format <strong>(TEXT TAB DELIMITED)</strong></p>
<p>Periksa inputan jangan ada tanda koma atau kutip dua</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file TXT kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>
<p>Contoh file template file TXT silahkan download disini 
 <?=anchor(base_url()."import/absensi.xls","absensi.xls")?> </p>
<div style='color:red'><?=validation_errors()?></div>

<?php 
    $cols=array("nip","tanggal","time in","time out","ot in","ot out","status");

	echo form_open_multipart(base_url()."index.php/payroll/absensi/import_excel","id='frmImport'");
    echo "<div class='col-sm-12 thumbnail'>";
    for($i=0;$i<count($cols);$i++){
        $c=chr(65+$i);
        $name=str_replace(" ","_",$cols[$i]);
        echo "<div class='col-sm-3'>"
        .form_input($name,$c,"style='width:30px'").ucfirst($cols[$i])."</div>";
    }
	echo "<div class='col-sm-8'>".form_input("nip_cari")." Import hanya satu NIP *optional</div>";
    echo "</div>";
?>

<div class='thumbnail col-sm-12'><strong>Pilih nama file: </strong><input type="file" 
    name="file_excel" id="file_excel" style="width:500px"/>
    <input type='submit' value='Submit' name='submit' class='btn btn-primary'>
    
</div>
</form>
