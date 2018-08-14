 <?
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>
	<div title="DASHBOARD" style="padding:10px">
		<div class="col-md-12">
		<?
			add_button_menu("Perusahaan","company","ico_asset.png",
			"Pengaturan nama dan alamat perusahaan");		
			add_button_menu("User Login","user","ico_customer.png",
			"Pengaturan User ID Login dan password");		
			add_button_menu("Kelompok User","jobs","ico_forum.png",
			"Pengaturan Job Kelompok User  dan batasan modul yang dijalankan");		
			add_button_menu("Periode Akuntansi","periode","ico_purchase.png",
			"Proses tutup buku periode akuntansi");		
			add_button_menu("Link Akun","company/gl_link","ico_setting.png",
			"Setting kode perkiraan penghubung / link untuk default transaksi.");		
			add_button_menu("Penomoran","nomor","ico_inventory.png",
			"Setting nomor bukti semua transaksi standard.");		
			add_button_menu("Lookup","lookup","ico_inventory.png",
			"Daftar pilihan.");		
			add_button_menu("Penjualan","company/sales","ico_sales.png",
			"Setting untuk transaksi penjualan.");		
			add_button_menu("Pembelian","company/purchase","ico_sales.png",
			"Setting untuk transaksi pembelian.");		
			add_button_menu("Inventory","company/inventory","ico_items.png",
			"Setting untuk transaksi inventory.");		
			add_button_menu("Applications","apps","rocket.png",
			"Instal/Uninstall Daftar Modul, Extension dan Aplikasi MaxON.");		
			add_button_menu("Themes","admin/themes","ico_sales.png",
			"Thema dan tampilan layar MaxOn.");		
			add_button_menu("Cabang","company/branch","ico_setting.png",
			"Setting kode cabang perusahaan.");		
			add_button_menu("Departement","company/department","ico_setting.png",
			"Setting kode department");		
			add_button_menu("Division","company/division","ico_setting.png",
			"Setting kode divisi");		
			add_button_menu("Wilayah","company/wilayah","rocket.png",
			"Setting kode wilayah pemasaran untuk salesman");		
			add_button_menu("Hapus Database","clear_db","flame.png",
			"Hapus semua database.");		
					
		?>
		</div>

		<div class="box1">
			<div id="p" class="easyui-panel box2" title="Log Aktifitas"  style='width:700px'
				data-options="iconCls:'icon-help'" >
				<div id='divUserLog' style='height:300px'><img src=""></div>
			</div>
		</div>

		<div class="box1" >
			<div id="p" class="easyui-panel box2" title="Statistik Data"  style='width:700px'
				data-options="iconCls:'icon-help'" >
				<div id='divData' style='height:300px'><img src=""></div>
			</div>
		</div>

	</div>
	
	
</div>
 

<script type="text/javascript" src="<?=base_url()?>assets/flot/excanvas.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.categories.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.pie.js"></script>


<script type="text/javascript">
	var data2 = []; var alreadyFetched2 = {}; var dataurl2=CI_ROOT+'user/statistic';
	$.ajax({url: dataurl2, type: "GET", dataType: "json", success: onDataReceived2});
	function onDataReceived2(series) {
		if (!alreadyFetched2[series.label]) {
			alreadyFetched2[series.label] = true;
			data2.push(series);
		} $.plot("#divData", data2, options2);
	}
	var options2 = {lines: {show: true,	barWidth: 0.6,align: "center"},
		points: {show: true}, xaxis: {mode: "categories",tickLength: 0}
	};			

	var d = []; var dok = {}; var durl=CI_ROOT+'user/stat_log';
	$.ajax({url: durl, type: "GET", dataType: "json", success: onDataLog});
	function onDataLog(series) {
		if (!dok[series.label]) {
			dok[series.label] = true;
			d.push(series);
		} 
		$.plot("#divUserLog", d, opt_bar);
	}
	var opt_bar = {
		bars: {
			show: true,
			barWidth: 0.6,
			align: "center"
		},
		xaxis: {
			mode: "categories",
			tickLength: 0
		}
	};		 		
	
</script>
