<form class="form" id='frmMain' method='post'>
	<input type='hidden' id='mode' name='mode' value='<?=isset($mode)?$mode:"add";?>'>
	<?php 
	echo my_checkbox("Pilih Jenis Pembayaran",'jenis_bayar',$jenis_bayar,$jenis_bayar_list);
	echo my_input("ID",'id',$id);
	?>
	<input type='submit' name='submit_payment' id='submit_payment' value='Submit' class='btn btn-primary'>
</form>
<div id='message'></div>

