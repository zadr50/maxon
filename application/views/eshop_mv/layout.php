<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 <script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>
<head><title>MaxOn ERP Online Demo</title></head>
<body>
	<?php
	date_default_timezone_set("Asia/Jakarta");
	echo $library_src;
	echo $script_head;
	?>
	<div class="container-fluid bg-all">
		<div class='row  bg-head bg-banner' >
		<div id='section-header'>
			<?php include_once "header.php" ?>
			<?php include_once 'box_crumb.php' ?>
		</div>
		</div>
		<div class='row' >
		<div id='section-content' >
			<div class='col-md-3 col-sm-3 col-lg-3 visible-lg' >
				<?php 
					$cust_id=$this->session->userdata("cust_id");
					if($cust_id<>"") { 
				?>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h3 class="panel-title"><span class='glyphicon glyphicon-circle-arrow-right'></span> Dashboard</h3>
					  </div>
					  <div class="panel-body">
						<?php echo load_view('eshop/widget_menu'); ?>
					  </div>
					</div>				
				<?php } 	?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-circle-arrow-right'></span> Category</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/widget_category'); ?>
				  </div>
				</div>				
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon  glyphicon-circle-arrow-right'></span> Brand</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/widget_brand');?>

				  </div>
				</div>				
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon  glyphicon-circle-arrow-right'></span> Google</h3>
				  </div>
				  <div class="panel-body">
					<?php $this->load->view('google_ads');?>
				  </div>
				</div>				
				  
			</div>
			<div class='col-md-6 col-lg-6 col-sm-6' style='margin-left:20px;margin-right:20px'>
				<?php	$this->load->view($file_content);?>
			</div>
			
			<div class='col-md-2 col-lg-2 col-sm-2' >
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-shopping-cart'></span> Shopping Cart</h3>
				  </div>
				  <div class="panel-body">
						<?php echo load_view('eshop/widget_cart');?>
				  </div>
				</div>				
			
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-pencil'></span> Articles</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/widget_articles');?>
				  </div>
				</div>		
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-pencil'></span> Range Harga</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/range_price');?>
				  </div>
				</div>				
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-pencil'></span> Jenis Harga</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/jenis_harga');?>
				  </div>
				</div>				
			</div>
		</div>
		</div>
		<div class='row bg-head-foot' style="margin-top:-1px">
		<div id='section-footer' >
			<?php include_once "footer.php" ?>
		</div>
		</div>
	 
	</div>
</body>


<script languange="javascript">

	if(top != self) top.location.replace(location);	//detect if run iframe

    function login(){
    	$("#lblMessage").html("Please wait...");
		url='<?=base_url()?>index.php/login/verify';
			$('#frmLogin').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						window.open(CI_ROOT,"_self");
					} else {
						$("#lblMessage").show();
						$("#lblMessage").html(result.msg);
					}
				}
			});
    }
</script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	  $('.flexslider').flexslider({
	    animation: "slide"
	  });
});
//]]>
</script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '379010302273216',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

