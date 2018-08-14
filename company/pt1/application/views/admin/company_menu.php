<?
$nama='';
if(isset($_GET['nama']))$nama=$_GET['nama'];
?>

<form>
Nama <input type="text" id='nama' name='nama' value='<?=$nama?>'  /> 
<input type='submit' value='Search' class='button'>
<?= anchor("company/add","Add","class=button")?>

</form>
