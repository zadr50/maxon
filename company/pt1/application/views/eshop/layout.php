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
	<?
	$slider=isset($slider)?load_view('slider',array('folder'=>'images/')):'';
	$promo=isset($promo)?"<h1>Promo Items</h1>":'';
	$widget_brand=isset($widget_brand)?'eshop/widget_brand':'';
	$google_ads='';
	if ($this->config->item('google_ads_visible')) $google_ads='google_ads'; 
	$sidebar=isset($sidebar)?load_view('eshop/sidebar',
		array('category_list'=>$sidebar,
		'widget_brand'=>$widget_brand,
		'google_ads'=>$google_ads)):'';
	$category_menus=isset($category_menus)?load_view($category_menus):'';
	$menu=isset($menu)?load_view('eshop/widget_menu'):'';
	$footer=isset($footer)?load_view('eshop/footer'):'';
	$crumb=isset($crumb)?load_view('eshop/box_crumb'):'';
	$header='';
	$header=isset($header)?load_view('eshop/header'):'';
	$article_view=isset($article_view)?load_view('eshop/article_view'):'';
	$content=isset($content)?load_view($file_content):'';
	?>
	<div class="container-fluid bg-all">
		<div class='row bg-head bg-banner' >
			<div id='section-header'>
				<?php echo $header ?>
				<?php echo $crumb ?>
			</div>
		</div>
		<div class='row' >
			<div id='section-content' >
				<div class='col-md-9 col-sm-9'>
					<?php echo $slider ?>
					<?php echo $promo ?>
					<?php echo $article_view?>
					<?php echo $content ?>
				</div>
				<div class='col-md-3 col-sm-3'>
					<?php echo $sidebar ?>				
				</div>
			</div>
		</div>
		<?php echo $footer ?>
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

