<div class=" col-md-6">
	<div class="well">
		<img align='left' src="<?=base_url()?>images/ico_payroll.png">
		<h2> LOGIN</h2>
		<p>Untuk melihat data transaksi atau status order anda atau pengaturan lainnya 
		yang bisa dilakukan oleh user, silahkan masukkan username dan password yang 
		telah anda buat dikotak sebelah ini dengan benar.</p>
	  <form class="form" id='frmLogin' method='post'>
		<div class="form-group">
		  <label>Username</label>
		  <input name='cust_id' id='cust_id' type="text" class="form-control" placeholder="Enter your username">
		</div>
		<div class="form-group">
		  <label>Password</label>
		  <input name='cust_pass' id='cust_pass' type="password" class="form-control" placeholder="Enter your password">
		</div>

		<button type='submit' class='btn btn-primary pull-center'>Login</button>
		<p>
			Belum punya akun? 
			<a href="<?=base_url()?>index.php/eshop/member/add">Create New</a>
			
		</p>			
	  </form>
	<div id='message'></div>
	</div>
</div>

<script language='javascript'>
$(document).ready(function() {
	$('#frmLogin').submit(function(event){
		event.preventDefault();
		if($('#cust_id').val()==''){alert('Isi username !');return false;}
		if($('#cust_pass').val()==''){alert('Isi password !');return false;}
		url='<?=base_url()?>index.php/eshop/login/verify';
		$.ajax({
		   type: "POST", url: url,
		   data: $("#frmLogin").serialize(), // serializes the form's elements.
		   success: function(data)
		   {
			   if(IsJsonString(data)){
				   result=eval('('+data+')'); // show response from the php script.
				   if(result.success){
					   $("#message").html("<p>"+result.message+"</p>");
						$("#frmLogin").fadeOut("slow");
						if(result.user_admin){
							window.open("<?=base_url()?>index.php/eshop_admin/dashboard","_self");
						} else {
							window.open("<?=base_url()?>index.php/eshop/cart","_self");
						}
				   } else {
						$("#message").html("<p style='color:red'>"+result.message+"</p>");
				   }
			   } else {
					$("#message").html('1. '+data);					   
			   }
		   },
			beforeSend: function()
			{
			   $("#message").fadeIn("Checking...");
			}
		});
	});
});
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
