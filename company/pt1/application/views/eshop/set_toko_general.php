<form class="form" id='frmMain' method='post'>
	<input type='hidden' id='mode' name='mode' value='<?=isset($mode)?$mode:"add";?>'>
	<?php 
	echo my_input("Nama Toko",'nama_toko',$nama_toko);
	echo my_input("Slogan",'slogan',$slogan);
	echo my_input("Deskripsi",'description',$description);
	echo my_input("Status Toko",'status_toko',$status_toko);
	echo my_input("Sampul",'foto_sampul',$foto_sampul);
	echo my_input("ID",'id',$id);
	?>
	<input type='submit' name='submit_general' id='submit_general' value='Submit' class='btn btn-primary'>
</form>
<div id='message'></div>

