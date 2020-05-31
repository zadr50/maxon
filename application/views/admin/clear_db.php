 
<legend>PROSES PENGHAPUSAN DATABASE</legend>
<div class='row alert alert-danger'>
	<p>Proses ini akan menghapus semua data yang dipilih, 
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
	echo form_checkbox("prdel[]",'ms_coa',0,"style='width:30px'")." Master Kode Perkiraan </br>";
	echo form_checkbox("prdel[]",'ms_bank',0,"style='width:30px'")." Master Rekening </br>";
	echo form_checkbox("prdel[]",'ms_customer',0,"style='width:30px'")." Master Customer </br>";
	echo form_checkbox("prdel[]",'ms_supplier',0,"style='width:30px'")." Master Supplier </br>";
	echo form_checkbox("prdel[]",'ms_iventory',0,"style='width:30px'")." Master Barang dan Jasa </br>";
	echo form_checkbox("prdel[]",'ms_payroll',0,"style='width:30px'")." Master Data Payroll </br>";
	echo form_checkbox("prdel[]",'ms_leasing',0,"style='width:30px'")." Master Data Leasing </br>";
	echo form_checkbox("prdel[]",'ms_pabrik',0,"style='width:30px'")." Master Data Pabrikasi </br>";
	echo form_checkbox("prdel[]",'ms_travel',0,"style='width:30px'")." Master Data Tour Travel </br>";
	echo "</div>";
	echo "<div class='col-xs-5'>";
	echo form_checkbox("prdel[]",'tr_jual',1,"style='width:30px'")." Transaksi Penjualan </br>";
	echo form_checkbox("prdel[]",'tr_beli',1,"style='width:30px'")." Transaksi Pembelian </br>";
	echo form_checkbox("prdel[]",'tr_bank',1,"style='width:30px'")." Transaksi Cash & Bank </br>";
	echo form_checkbox("prdel[]",'tr_jurnal',1,"style='width:30px'")." Transaksi Jurnal,Budget,Posting GL </br>";
	echo form_checkbox("prdel[]",'tr_inventory',1,"style='width:30px'")." Transaksi Inventory </br>";
	echo form_checkbox("prdel[]",'tr_customer',1,"style='width:30px'")." Transaksi Customers </br>";
	echo form_checkbox("prdel[]",'tr_supplier',1,"style='width:30px'")." Transaksi Suppliers </br>";
	echo form_checkbox("prdel[]",'tr_pos',1,"style='width:30px'")." Transaksi Point Of Sales </br>";
	echo form_checkbox("prdel[]",'tr_pabrik',1,"style='width:30px'")." Transaksi Pabrikasi </br>";
	echo form_checkbox("prdel[]",'tr_leasing',1,"style='width:30px'")." Transaksi Leasing </br>";
	echo form_checkbox("prdel[]",'tr_payroll',1,"style='width:30px'")." Transaksi Payroll </br>";
	echo "</div>";
?>
</div>
<div class='row'>
    <div class='thumbnail box-gradient'>
        <input value='START' type='submit' onclick='start_delete();return false' class='btn btn-primary'>
        
    </div>
</div>
</form>
 