<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><?php include_once __DIR__."/../home.php";?></div>
	
	<div title="DASHBOARD" style="padding:10px">
		<div title="Koperasi Dashboard" style="padding:10px">
			<div class="row">
				<?php
				add_button_menu("Pinjaman","koperasi/pinjaman","ico_sales.png",
						"Daftar pinjaman anggota");
				add_button_menu("Setoran","koperasi/simpanan_setor","office.png",
						"Input setoran simpanan tabungan anggota");
				add_button_menu("Cicilan","koperasi/angsuran_setor","scribus.png",
						"Input angsuran pinjaman");
				add_button_menu("Anggota","koperasi/anggota","ico_purchase.png",
						"Daftar anggota koperasi");
				add_button_menu("Kelompok Anggota","koperasi/kelompok","ico_payroll.png",
						"Daftar kelompok anggota");
				add_button_menu("Petugas","koperasi/petugas","profle.png",
						"Daftar petugas koperasi");
				add_button_menu("Jenis Simpanan","koperasi/jenis_simpanan","ico_setting.png",
						"Setting jenis simpanan");
				add_button_menu("Jenis Pinjaman","koperasi/jenis_pinjaman","ico_setting.png",
						"Setting jenis pinjaman");
				add_button_menu("Rekening Simpanan","koperasi/rekening","ico_rekening.png",
						"Daftar rkekening simpanan tabungan anggota");
										
				?>		
			</div>
			<div class='row'>
                    <?php include_once "menu_reports.php" ?>
			</div>
		</div>
	</div>
</div>

<script  language="javascript">
	$().ready(function(){
		$("#tt").tabs("select","DASHBOARD");
	 
	});
</script>

