<legend>Proses tanda terima barang</legend>
<div class='alert alert-info'>
	<p>Proses ini dipakai untuk mencatat tanda terima penyerahan barang 
	di tempat debitur, kemudian mencatat penerimaan DP, Angsuran 1 
	dan Administrasi</p>
	<p>Isilah informasi dibawah ini dengan benar</p>
</div>
<?php 
$nomor_do="";
$tanggal="";

echo "<div class='alert alert-warning'>";
echo my_input("Nomor Surat Jalan","nomor_do");
echo "<input type='button' value='Cari' class='btn btn-primary'>";
echo " <input type='button' value='Print Kwitansi' class='btn btn-primary'>";
echo " <input type='button' value='Print T.Terima' class='btn btn-primary'>";
echo "</div>";
echo "<div id='divInfo' class='alert alert-default'>Info debitur</div>";
echo form_open(base_url()."index.php/leasing/delivery/save");
echo "<table class='table'>";
echo "<tr><td>";
echo my_input_date("Tanggal terima","tanggal",date("Y-m-d H:i:s"));
echo "</td></tr>";
echo "<tr><td>";
echo my_input("Jumlah DP Rp.","dp");
echo "</td></tr>";
echo "<tr><td>";
echo my_input("Jumlah Admin Rp.","admin");
echo "</td></tr>";
echo "<tr><td>";
echo my_input("Jumlah Angsur 1 Rp.","angsur");
echo "</td></tr>";
echo "<tr><td>";
echo my_input("Total Rp.","total");
echo "</td></tr>";
echo "<tr><td>";
echo my_input("Catatan","catatan");
echo "</td></tr>";
echo "</table>";	
echo form_close();
?>
