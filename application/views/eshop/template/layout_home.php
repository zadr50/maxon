<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php 
if(isset($picture)) {
	echo "<meta property='og:image' content='".$picture."'>";
	echo "<meta property='og:title' content='".$title."'>";
	$description=strip_tags($description);
	echo "<meta property='og:description' content='".$description."'>";
}
?>
<script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>

<?php 
	date_default_timezone_set("Asia/Jakarta");
	echo $library_src;
	echo $script_head;
?>
<head><title>MaxOn ERP Online Demo</title></head>
<BODY>
	<div class="container-fluid">
		<div class='bg-head bg-banner col-md-12' >
			<div id='section-header'>
				<?php include_once "header.php"; ?>
			</div>
		</div>
		<div class='col-md-12' >
			<div id='section-content' >
				<div class='col-md-2 cat-list'>
					<?php include_once "list_category.php"; ?>						
				</div>
				<div class='col-md-8 hidden-xs'>
				   	<?=load_view("slider",array("folter"=>"images/"))?>						
				</div>
				<div class='col-md-2  hidden-xs'>
					<div class='card' style='text-align:center'>
						<img src="<?=base_url('images/ico_purchase.png')?>" width='50px' height='50px'/>
					<h5>Welcome <?=user_id()?></h5>
					<a href='<?=base_url('index.php/eshop/member/add')?>' class='btn btn-sm btn-primary'>Sign Up</a>
					<a href='<?=base_url('index.php/eshop/login/start')?>' class='btn btn-sm btn-warning'>Login</a>
						<div class='msg1' style='background-color: #fdcf8e;margin: 5px;padding: 5px;height:250px'>
							<p>Silahkan klik tombol signup apabila anda ingin bergabung dengan toko online kami.</p>
							<p>Apabila anda sudah terdaftar silahkan klik tombol logn</p>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12 cat-box hidden-xs'>
					<?php include_once "list_category_icon.php"; ?>
				</div>
			</div>
			<div class='row'>
				<div class='col-lg-12'>
				    <?=load_view("eshop/items/item_promo");?>
				</div>				
			</div>
			<div class='row'>
			    <div class='col-lg-12'>
			        <?=load_view("eshop/items/item_category")?>
			    </div>
			</div>
		</div>
		<div class='col-lg-12'>
			<?php include_once "footer.php"; ?>				
		</div>
	</div>
</BODY>


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
