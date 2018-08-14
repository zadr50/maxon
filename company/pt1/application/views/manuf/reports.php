<legend>Laporan Work Order</legend>
<ul>
	<li><a href='#' onclick="on_print('work_order/001');return false">001. Daftar Work Order</a></li>
	<li><a href="#" onclick="on_print('work_order/002');return false">002. Daftar Work Order Detail</a></li>
</ul>

<legend>Laporan Work Execute</legend>
<ul>
	<li><a href='#' onclick="on_print('work_exec/001');return false">001. Daftar Work Execute</a></li>
	<li><a href="#" onclick="on_print('work_exec/002');return false">002. Daftar Work Execute Detail</a></li>
</ul>

<legend>Laporan Material Release</legend>
<ul>
	<li><a href='#' onclick="on_print('mat_release/001');return false">001. Daftar Material Release</a></li>
	<li><a href='#' onclick="on_print('mat_release/002');return false">002. Daftar Material Release Detail</a></li>
</ul>
<legend>Laporan Produksi</legend>
<ul>
	<li><a href='#' onclick="on_print('prod/001');return false">001. Daftar Hasil Produksi</a></li>
	<li><a href="#" onclick="on_print('prod/002');return false">002. Daftar Hasil Produksi Detail</a></li>
	<li><a href="#" onclick="on_print('prod/003');return false">003. Daftar Hasil Produksi By Department</a></li>
	<li><a href="#" onclick="on_print('prod/004');return false">004. Daftar Hasil Produksi By Mesin</a></li>
</ul>

<legend>Laporan Pembatalan Produksi</legend>
<ul>
	<li><a href='#' onclick="on_print('prod_cancel/001');return false">001. Daftar Pembatalan Produksi</a></li>
</ul>

<script language="javascript">
	function on_print(id){
		var url='<?=base_url()?>index.php/manuf/reports/'+id;
		add_tab_parent("Print_"+id,url);
	}	
</script>