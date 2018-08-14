 <?php
  
  $CI =& get_instance();
  if(!isset($default_home))$default_home="";
  if($default_home=="") {
 ?>
 
<div class="easyui-tabs" id="tt">	 

	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	
<?php } ?>	
	
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="col-md-12 thumbnail">
			<?php
			add_button_menu("Booking Domestik","courier/booking_dom","ico_akun.png",
					"Proses register nomor booking titipan pengiriman barang darat,laut dan udara");
		    add_button_menu("Customer/ Pengirim","courier/customer","ico_purchase.png",
					"Pencatatan data pelanggan pengirim dan penerima.");
			add_button_menu("Tarif Zone","courier/tarif","ico_setting.png",
					"Setingn tarif pengiriman kota, service, darat, laut dan udara");					
            add_button_menu("Manifest","courier/manifest","office.png",
                    "Proses manifest pengiriman nomor booking.");
            add_button_menu("Invoice","invoice","frames.png",
                    "Daftar faktur dan tagihan.");
			?>
		</div>
	</div>
	
<?php if($default_home=="") { ?>	
</div>
<?php } ?>
