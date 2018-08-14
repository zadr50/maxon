<form class="form" id='frmMain' method='post'>
	<input type='hidden' id='mode' name='mode' value='<?=isset($mode)?$mode:"add";?>'>
	<?php 
	echo my_input("Provinsi",'provinsi',$provinsi);
	echo my_input("Kabupaten",'kabupaten',$kabupaten);
	echo my_input("Kota/Kecamatan",'kota',$kota);
	echo my_checkbox("Agen Pengiriman",'jasa_kirim',$jasa_kirim,$jasa_kirim_list);
	echo my_input("ID",'id',$id);
	?>
	<input type='submit' name='submit_delivery' id='submit_delivery' value='Submit' class='btn btn-primary'>
</form>
<div id='message'></div>

