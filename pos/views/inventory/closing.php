<legend><?=$caption?></legend>
<?php 

if(!isset($table)) { 

?>
<div class='alert alert-warning'>
<p>Proses ini akan melakukan closing proses bulanan stock, 
menghitung saldo stock akhir peride tersebut yang terpilih</p>
<p>Pastikan tidak ada penambahan ataupun koreksi data transaksi yang 
berhubungan dengan stock pada periode tersebut setelah closing 
karena akan mengacaukan stock akhir barang tersebut.</p>
<p>Silahkan pilih periode yang akan diclosing dibawah ini</p>
</div>
<?php 
$tahun=date("Y");
$bulan=date("m");
$bulan--;
if($bulan==0){
	$bulan=12;
	$tahun--;
}

?>
<div class='col-md-3'>
<form action='' method='post'>
<p>Pilih Periode YYYY: <input id='tahun' name='tahun' value='<?=$tahun?>' type='input'>
Bulan MM: <input id='bulan' name='bulan' value='<?=$bulan?>' type='input'>
<input type='submit' value='Submit' class='btn btn-primary'>
</form>
<?php 
	if($message!="")echo "<div class='alert alert-danger'>$message</div>";
?>
</div>


<div class='col-md-3 thumbnail'>
<p>Dibawah ini adalah periode yang sudah diclosing</p>
<table class='table'><thead><th>Tahun</th><th>Bulan</th></thead>
<tbody>
<?php 
foreach($periode->result() as $row){
	echo "<tr><td>$row->tahun</td><td>$row->bulan</td>
		<td><input onclick='view_arsip($row->tahun,$row->bulan);return false' type='button' class='btn btn-primary' value='View'>
		<input onclick='delete_arsip($row->tahun,$row->bulan);return false'type='button' class='btn btn-warning' value='delete'></td>
		</tr>";
}
?>
</tbody>
</table>
</div>

<?php  } ?>

<div class="col-md-12">
<?php 
if(isset($table))echo $table;
?>
</div>
<script language='JavaScript'>
function view_arsip(tahun,bulan){
	add_tab_parent("view_"+tahun+bulan,CI_ROOT+"inventory/closing_view/"+tahun+"/"+bulan);	
}
function delete_arsip(tahun,bulan){
	window.open(CI_ROOT+"inventory/closing_delete/"+tahun+"/"+bulan,"_self");
}
</script>