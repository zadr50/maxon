<div class='container'>
<legend>PROSES PENGHAPUSAN DATABASE</legend>
<div class='row alert alert-warning'>
	<p>Proses ini akan menhapus semua data yang dipilih, 
	silahkan contreng data apa yang akan dihapus.
	Sebelum melakukan hapus data ini sebaiknya anda membuat file backup 
	database terlebih dahulu, karena proses ini tidak bisa dibatalkan 
	kalau sudah berjalan.
	</p>
	<p>
	Yang berhak menghapus database hanyalah administrator !!!
	</p>
</div>
<form name='frmMain' id='frmMain' method='post'
	action='<?=base_url()?>index.php/clear_db'>
<div class='row'>
<?php 
	echo "<div class='col-xs-5'>";
	echo form_checkbox("prdel[]",'ms_coa',0)." Master Kode Perkiraan </br>";
	echo form_checkbox("prdel[]",'ms_bank',0)." Master Rekening </br>";
	echo form_checkbox("prdel[]",'ms_customer',0)." Master Customer </br>";
	echo form_checkbox("prdel[]",'ms_supplier',0)." Master Supplier </br>";
	echo form_checkbox("prdel[]",'ms_iventory',0)." Master Barang dan Jasa </br>";
	echo form_checkbox("prdel[]",'ms_payroll',0)." Master Data Payroll </br>";
	echo form_checkbox("prdel[]",'ms_leasing',0)." Master Data Leasing </br>";
	echo form_checkbox("prdel[]",'ms_pabrik',0)." Master Data Pabrikasi </br>";
	echo form_checkbox("prdel[]",'ms_travel',0)." Master Data Tour Travel </br>";
	echo "</div>";
	echo "<div class='col-xs-5'>";
	echo form_checkbox("prdel[]",'tr_jual',1)." Transaksi Penjualan </br>";
	echo form_checkbox("prdel[]",'tr_beli',1)." Transaksi Pembelian </br>";
	echo form_checkbox("prdel[]",'tr_bank',1)." Transaksi Cash & Bank </br>";
	echo form_checkbox("prdel[]",'tr_jurnal',1)." Transaksi Jurnal,Budget,Posting GL </br>";
	echo form_checkbox("prdel[]",'tr_inventory',1)." Transaksi Inventory </br>";
	echo form_checkbox("prdel[]",'tr_customer',1)." Transaksi Customers </br>";
	echo form_checkbox("prdel[]",'tr_supplier',1)." Transaksi Suppliers </br>";
	echo form_checkbox("prdel[]",'tr_pos',1)." Transaksi Point Of Sales </br>";
	echo form_checkbox("prdel[]",'tr_pabrik',1)." Transaksi Pabrikasi </br>";
	echo form_checkbox("prdel[]",'tr_leasing',1)." Transaksi Leasing </br>";
	echo form_checkbox("prdel[]",'tr_payroll',1)." Transaksi Payroll </br>";
	echo "</div>";
?>
</div>
<div class='row'>
	<input value='START' type='submit' onclick='start_delete();return false' class='btn btn-primary'>
</div>
</form>
</div>