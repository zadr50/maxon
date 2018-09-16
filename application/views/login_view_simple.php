<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head><title>MaxOn ERP Online</title>
</head>
<script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>
<BODY style='background-image:url("<?=base_url()?>images/back2.jpg")'> 
<div class="container " >
	<div class="row ">		 
			<div class="panel panel-primary"  style="margin:5px;border:0px solid white">
				<div class="panel-heading">
					<h3 class="panel-title   glyphicon glyphicon-bookmark"  style="padding:10px;color:white"> USER LOGIN</h3>
				</div>
				<div class="panel-body">
					<div class="col-sm-4">
						<img src="<?=base_url("images/login_logo.png")?>" class="thumbnail" width=80 height=80>
						Silahkan isi userid dan password yang benar.
					</div>
					<div class="col-sm-6">
						
						<form name="frmLogin" id="frmLogin" method="post" role="form"  >
							<div class="form-group glyphicon glyphicon-user">
								<label for="username">Username:</label>
								<input  class="form-control" type="text" id="user_id" name="user_id" placeholder="Username">
							</div>
							<div class="form-group glyphicon glyphicon-qrcode">
								<label for="password">Password:</label>								 
								<input class="form-control" type="password" id="password" name="password" placeholder="Password"/>
								 
							</div>
							<?php
							 $multi_company=false; 
							 if($multi_company){
							     echo "<div class='form-group glyphicon glyphicon-phone-alt'>";
                                 
							     echo "&nbsp<label for='company'>Pilih Gudang/Outlet : </label>";
                                 
                                 echo "<select class='form-control' id='warehouse_code' name='warehouse_code'>";
                                 if($q=$this->db->select("location_number,attention_name")
                                    ->order_by("location_number")
                                    ->get("shipping_locations")
                                    ){
                                     foreach($q->result() as $row){
                                         echo "<option value='$row->location_number'>$row->location_number - $row->attention_name</option>";
                                     }
                                 }
                                 echo "</select>";
 							     echo "</div>";
							 }
							
							?>
							<div class="form-group">
                                <input class="btn btn-primary" type="button" value="Login"  
                                onclick="login();return false" name='submit' style="height:30px">
							</div>
						</form>      	
					</div>
					<div class="col-sm-12">
	                    <?=anchor("login/change_password","Change Password")?>
	                    | <?=anchor("login/create_user","Create User")?>
					</div>
                    <div class="col-sm-12">
                        <i  class="small">Untuk mencoba gunakan login user : <strong>admin</strong>, 
                        		password: <strong>admin</strong></i>
                    </div>                                
					<?php if (validation_errors()) { ?>
						<div class="col-sm-12 alert alert-danger">
							<?=validation_errors()?>
						</div>
					<?php }; ?>
							
                    <div class="col-sm-12" style="display:none;margin-top:20px" id="divMessage">
                        <p><span id="lblMessage" class="alert alert-danger col-sm-12"></span></p>		                    	
                    </div>
					
					
				</div>	 
			</div>
		 
    </div>
    <?php 
    if($this->config->item("show_footer")) { ?>
	<div class="row">
		<div class="panel panel-primary"  style="margin:5px;border:0px solid white">
		<div class='panel-body'>
		<img src="<?=base_url()?>images/logo_maxon.png" style="float:left">
		<div class="copyright" style='font-size:12px'>Copyright � 2000-2020 <br>MaxOn Enterprise Resource Application. 
		<br>All Rights Reserved.<br>http://www.talagasoft.com</div>                        
		</div>
		</div>
	</div>	
	<?php } ?>
</div>   
   
		
</BODY>
<style>
.container {
	max-width: 500px;
	margin: auto auto;
	padding-top:50px;
}
</style> 

<script type="text/javascript" charset="utf-8" src="<?=base_url()?>/assets/jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>/assets/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/bootstrap-3.3.5/css/bootstrap.min.css">

<script languange="javascript">

	if(top != self) top.location.replace(location);	//detect if run iframe

    function login(){
    	$("#divMessage").show();
    	$("#lblMessage").html('<?=lang("wait")?>');
		url='<?=base_url()?>index.php/login/verify_json';			
		$.ajax({
				url: url, type: "POST", data: {user_id:$("#user_id").val(),password:$("#password").val()},
				error: function (xhr, ajaxOptions, thrownError) {
			    	$("#lblMessage").html(xhr.responseText);
				},
				success: function(result)
				{
					var result = eval('('+result+')');
					if (result.success)
					{
				    	$("#lblMessage").html(result.message);
				    	open_index();
					} else {
				    	$("#lblMessage").html(result.message);
					}
				}
		});									
    }
    function open_index(){
		var t=setTimeout(function(){
			window.open("<?=base_url()?>","_self");
		},3000);    	
    }


</script>