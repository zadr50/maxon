 <?
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="col-md-12 thumbnail">
			<?php 
				$keterangan="Pengelolaan data master siswa atau mahasiswa.";
				$img=base_url("images/rocket.png");
				echo info_link_box("sekolah/siswa", "Master siswa", $img, $keterangan);
			?>

			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/guru">
				<div class='photo'><img src='<?=base_url()?>images/rocket.png'/></div>
				<div class='detail'>
					<h4>Master Guru</h4>
				</br>Pengelolaan data master guru
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/jurusan">
				<div class='photo'><img src='<?=base_url()?>images/tor-icon.png'/></div>
				<div class='detail'>
					<h4>Master Jurusan</h4>
				</br>Mengelola data master jurusan
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/kelas">
				<div class='photo'><img src='<?=base_url()?>images/desktop.png'/></div>
				<div class='detail'>
					<h4>Master Kelas</h4>
				</br>Mengelola data master kelas
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/mata_kuliah">
				<div class='photo'><img src='<?=base_url()?>images/scribus.png'/></div>
				<div class='detail'>
					<h4>Mata Kuliah</h4>
				</br>Mengelola data master mata kuliah
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/jadwal_belajar">
				<div class='photo'><img src='<?=base_url()?>images/rocket.png'/></div>
				<div class='detail'>
					<h4>Jadwal Belajar</h4>
				</br>Mengelola data jadwal belajar
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/setting">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Setting</h4>
				</br>Data setting dan pengaturan sekolah
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/krs">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Data Master KRS</h4>
				</br>Mengelola data master KRS
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/khs">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Data Master KHS</h4>
				</br>Mengelola Data master KHS
				</div>
			</div>
			<div class='info thumbnail info_link' href="<?=base_url()?>index.php/sekolah/laporan">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Daftar Laporan</h4>
				</br>Daftar Laporan
				</div>
			</div>
			
			
		</div>
	</div>
</div>



<script  language="javascript">
$().ready(function(){
	//void get_this(CI_ROOT+'purchase_invoice/daftar_kartu_gl','','divGL');
});
	
	
</script>

