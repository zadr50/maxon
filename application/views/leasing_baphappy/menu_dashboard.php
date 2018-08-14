 <?
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 

	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="col-md-12 thumbnail">
			<?
			if (allow_mod('_18000.001'))	add_button_menu("Debitur","leasing/cust_master","ico_payroll.png",
					"Pendaftar nama debitur atau data master pelanggan leasing");
			if (allow_mod('_18000.003'))	add_button_menu("Pengajuan","leasing/app_master","ico_sales.png",
					"Pencatatan formulir pengajuan kredit pelanggan.");
			if (allow_mod('_18000.004'))	add_button_menu("Phone Verify","leasing/verify","ico_koperasi.png",
					"Pencatatan formulir phone verification pelanggan.");
			if (allow_mod('_18000.005'))	add_button_menu("Scoring","leasing/scoring","ico_manuf.png",
					"Proses pembuatan score aplikasi kredit dan verificator.");
			if (allow_mod('_18000.015'))	add_button_menu("Recomend To Survey","leasing/scoring/recomend","rocket.png",
					"Proses rekomendasi untuk dilakukan proses survey.");
			if (allow_mod('_18000.006'))	add_button_menu("Survey","leasing/survey","rocket.png",
					"Pencatatan data kunjungan survey aplikasi kredit.");
			if (allow_mod('_18000.007'))	add_button_menu("Proses Risk","leasing/risk","gear.png",
					"Proses analysa risk/resiko pengajuaan aplikasi.");
			if (allow_mod('_18000.014'))	add_button_menu("Proses Approval","leasing/approve","rocket.png",
					"Proses approval pengajuaan aplikasi.");
			if (allow_mod('_18000.008'))	add_button_menu("Kontrak Kredit","leasing/loan","frames.png",
					"Pencatatan formulir kredit pelanggan dan schedule cicilan kredit dan agunan.");
			if (allow_mod('_18000.009'))	add_button_menu("Billing","leasing/billing","rocket.png",
					"Proses billing penagihan.");
			if (allow_mod('_18000.010'))	add_button_menu("Bayar Cicilan","leasing/payment","gazpacho.png",
					"Pembayaran cicilan kredit oleh pelanggan");
			if (allow_mod('_18000.011'))	add_button_menu("Kolektor","leasing/kolektor","rocket.png",
					"Pencatatan jadwal kolektor penagihan.");
			if (allow_mod('_18000.012'))	add_button_menu("Penutupan","leasing/loan_close","rocket.png",
					"Proses penutupan cicilan kredit pelanggan");
			if (allow_mod('_18000.002'))	add_button_menu("Items Code","leasing/item_master","rocket.png",
					"Data master kode barang atau object kredit");
			if (allow_mod('_18000.013'))	add_button_menu("Counter","leasing/counter","rocket.png",
					"Data master kode counter dan cabang");
			if (allow_mod('_18000.100'))	add_button_menu("Pengaturan","leasing/setting","rocket.png",
					"Pengaturan Modul Leasing");
			if (allow_mod('_18000.020'))	add_button_menu("Export Absensi","payroll/absensi/convert_login_absen","rocket.png",
					"Export Data Absensi");
			if (allow_mod('_18000.021'))	
			add_button_menu("Jadwal Kontrak","leasing/loan_create_schedule","ico_sales.png",
					"Jadwal Kontrak Untuk SA");
			if (allow_mod('_18000.022'))	
			add_button_menu("Jadwal Kontrak Admin","leasing/loan_create_schedule/admin","ico_sales.png",
					"Jadwal Kontrak Untuk Admin");
					
			if (allow_mod('_18001.000'))	
			add_button_menu("Proses Harian","leasing/loan/daily_process","rocket.png",
			"Proses Harian untuk menghitung saldo piutang, hari telat, denda dan lainnya");
		
			add_button_menu("Laporan","leasing/reports","ico_akun.png",
					"Daftar laporan modul leasing");
			if (allow_mod('_18000.900'))	add_button_menu("Clear Data Transaksi","leasing/clear_data/trans","ico_setting.png",
					"Clear All Data Transaksi");
			if (allow_mod('_18000.901'))	add_button_menu("Clear Data Master","leasing/clear_data/master","ico_setting.png",
					"Clear All Data Master");
					
			?>
		</div>
		
		<?
			include_once "survey_widget.php";
			include_once "kolektor_widget.php";
		?>
	</div>
</div>
