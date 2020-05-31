<legend>Import Data Absensi</legend>
<p>Isi seting kolom dibawah ini sesuai dengan kolom di text file tab (contoh: output.dat), 
sesuaikan kolomnya dengan file DAT yang dipilih.</p>
<p>Untuk file  absensi (AEWD181860320_attlog.dat) bisa didownload dari mesin absensi kemudian 
	lakukan download dan simpan ke flasdisk.	
	</p>
<p>Periksa file output.txt</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file DAT kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>

<div style='color:red'><?=validation_errors()?></div>

<?php 
    $cols=array("USERID","CHECKTIME","CHECKTYPE","VERIFYCODE","SENSORID","LOGID","WorkCode","sn","UserExtFmt");

	echo form_open_multipart(base_url()."index.php/payroll/absensi/import_dat","id='frmImport'");
    echo "<div class='col-sm-12 thumbnail'>";
    for($i=0;$i<count($cols);$i++){
        $c=chr(65+$i);
        $name=str_replace(" ","_",$cols[$i]);
        echo "<div class='col-sm-5'>"
        .form_input($name,$c,"style='width:30px'").ucfirst($cols[$i])."</div>";
    }
    echo "</div>";
?>

<div class='thumbnail col-sm-12'><strong>Pilih nama file: </strong><input type="file" 
    name="file_txt" id="file_txt" style="width:500px"/>
    <input type='submit' value='Submit' name='submit' class='btn btn-primary'>
    
</div>
</form>
