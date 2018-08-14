<div class="panel panel-primary" >
	<div class="panel-heading">
		<h3 class="panel-title"  style="padding:1px;color:white">USER LOGIN</h3>
	</div>
	<div class="panel-body"   style="padding:10px;">
		<p>Untuk mulai menggunakan software ini anda diharuskan login terlebih dahulu, 
		silahkan isi userid dan password yang benar dibawah ini :</p>
		<form name="frmLogin" id="frmLogin" method="post" role="form"
		action="<?=base_url()?>index.php/login/verify">
			<div class="form-group">
				<label for="username">Username:</label>
				<input  class="form-control" type="text" size="20" id="user_id" name="user_id" placeholder="Enter Username">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input class="form-control" type="password" size="20" id="passowrd" name="password" placeholder="Enter Password"/>
				
				<i>Untuk mencoba gunakan login user : admin, password: admin</i>
			</div>
			<div class="form-group">
				<input class="btn btn-primary" type="submit" value="Login" style="height:30px">
				<?php if ($message!="") { ?>
				<div id="lblMessage" class="alert alert-danger" style="margin-top:10px">
					<?php echo $message; ?>
				</div>
				<?php }; ?>
			</div>
		</form>
	</div>	 
</div>	