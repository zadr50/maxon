 <?
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 

	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="col-md-12 thumbnail">
			<?
				add_button_menu("Registrasi","hotel/registrasi","rocket.png",
					"Registrasi kunjungan tamu dan pencarian member");
				add_button_menu("Reservasi","hotel/reservasi","rocket.png",
					"Reservasi pemesanan kamar hotel");
				add_button_menu("Tamu","hotel/tamu","rocket.png",
					"Registrasi dan pendaftaran tamu");
				add_button_menu("Reservasi Kamar","hotel/resvr_kamar","rocket.png",
					"Reservasi  dan penggunaan kamar");
				add_button_menu("Pembayaran","hotel/payment","rocket.png",
					"Proses tagihan dan pembayaran");
				add_button_menu("Karyawan","hotel/karyawan","rocket.png",
					"Data master karyawan");
				add_button_menu("Kamar","hotel/kamar","rocket.png",
					"Data master kamar");
				add_button_menu("Fasilitas","hotel/fasilitas","rocket.png",
					"Data master fasilitas dan setting");
				add_button_menu("Pelayanan","hotel/pelayanan","rocket.png",
					"Transaksi pelayanan hotel");
				add_button_menu("Barang","hotel/barang","rocket.png",
					"Data master barang dan jasa");
			?>
		</div>
	</div>
</div>
