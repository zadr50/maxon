<form class="form" id='frmMain' method='post'>
	<input type='hidden' id='mode' name='mode' value='<?=isset($mode)?$mode:"add";?>'>
	<div class="form-group">
	  <label>Nama Anda</label>
	  <input value='<?=$company?>' name='company' id='company' type="text" class="form-control" placeholder="Isi nama anda">
	</div>
	<div class="form-group">
	  <label>Username</label>
	  <input value='<?=$customer_number?>' <?=$customer_number!=""?"readonly":""?>  
		name='customer_number' id='customer_number' 
		type="text" class="form-control" placeholder="Isi username anda">
	  <i>username akan dipakai sebagai login kedalam toko kami</i>
	</div>
	<div class="form-group">
	  <label>Password</label>
	  <input value='<?=$password?>'  name='password' id='password' type="password" class="form-control" placeholder="Isi password anda">
	</div>
	<div class="form-group">
	  <label>Alamat Pengiriman</label>
	  <textarea name='street' id='street' type="text" 
		class="form-control" placeholder="Isi alamat untuk pengiriman"><?=$street?></textarea>
	</div>
	<div class="form-group">
	  <label>Email</label>
	  <input value='<?=$email?>'  name='email' id='email' type="text" class="form-control" >
	</div>
	<div class="form-group">
	  <label>Telpon/Handphone</label>
	  <input  value='<?=$phone?>' name='phone' id='phone' type="text" class="form-control" >
	</div>
	<div class="form-group">
	  <label>Kota</label>
	  <input  value='<?=$city?>' name='city' id='city' type="text" class="form-control" >
	</div>
	<div class="form-group">
	  <label>Kode Pos</label>
	  <input  value='<?=$zip_postal_code?>' name='zip_postal_code' id='zip_postal_code' type="text" class="form-control" >
	</div>
</form>
<div id='message'></div>

