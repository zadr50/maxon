<legend>Import Data Absensi</legend>
<p>Isi seting kolom dibawah ini sesuai dengan kolom di text file tab (contoh: output.txt), 
sesuaikan kolomnya dengan file TXT yang dipilih.</p>
<p>Untuk generate file output.txt dari database absensi silahkan download tool berikut ini 
    <?=anchor("http://f.maxonerp.com/tools/Export%20Absensi%20Mdb%20Csv/ExAbsen.exe","ExAbsen.exe")?>
    </p>
<p>Periksa file output.txt</p>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file TXT kemudian tekan tombol 
<strong>Submit</strong> untuk mulai di proses</p>
<p>Contoh file template file TXT silahkan download disini 
 <?=anchor(base_url()."import/output1.txt","output1.txt")?> </p>
<div style='color:red'><?=validation_errors()?></div>

<?php 
    $cols=array("USERID","CHECKTIME","CHECKTYPE","VERIFYCODE","SENSORID","LOGID","WorkCode","sn","UserExtFmt");

	echo form_open_multipart(base_url()."index.php/payroll/absensi/import_text_tab","id='frmImport'");
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
