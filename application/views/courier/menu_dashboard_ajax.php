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


<script type="text/javascript">
    $(document).ready(function(){
        $(".info_link").click(function(event){
            event.preventDefault(); 
            var url = $(this).attr('href');
            console.log(url);
            var n = url.lastIndexOf("/");
            var j=url.lastIndexOf("#");
            if(j>0){
                var title=url.substr(j+1);
            } else {
                var title=url.substr(n+1);
            }
            if(title=='reports'){
                title=url.substr(n-10);
                title=title.substr(title.indexOf("/"));
            }
            if(url.indexOf("/menu")>5){
                window.open(url,"_self");
            } else {
                add_tab_ajax(title,url);
            }
        });
    });

</script>
