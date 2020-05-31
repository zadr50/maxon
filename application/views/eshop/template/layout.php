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
	<?php
	$slider=isset($slider)?load_view('slider',array('folder'=>'images/')):'';
	$promo=isset($promo)?load_view("$promo"):'';
	$widget_brand=isset($widget_brand)?'eshop/widget_brand':'';
	$google_ads='';
	if ($this->config->item('google_ads_visible')) $google_ads='google_ads'; 
	$sidebar=isset($sidebar)?load_view('eshop/template/sidebar',
		array('category_list'=>$sidebar,
		'widget_brand'=>$widget_brand,
		'google_ads'=>$google_ads)):'';
	$category_menus=isset($category_menus)?load_view($category_menus):'';
	$menu=isset($menu)?load_view('eshop/suppliers/widget_menu'):'';
	$article_view=isset($article_view)?load_view('eshop/article_view'):'';
	$content="";
	if(isset($file_content)){
		$content=isset($content)?load_view($file_content):'';
		
	}
	
	?>
	<div class="bg-all container">
		<div class='row bg-head bg-banner' >
			<div id='section-header'>
                <?=load_view('eshop/template/header')?>
			</div>
		</div>
		<div class='row' >
			<div id='section-content container' >
				<div class='row'>
					<div class='col-lg-12'>
							<?php
								if($category_menus!=""){
									echo "<div class='col-md-3 well well-sm'>";									
									echo $category_menus;
									echo "</div>";
									
								}
							?>
						
						   <?php
						   	if($slider!=""){
								echo "<div class='col-lg-9 hidden-xs'>";
						   		echo $slider;						
								echo "</div>";
						   								   		
						   	} 
							?>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-lg-12 ' style='padding:10px'>
				    <div class='container'>
                        <?php if($promo!="") echo "<div class='col-lg-12' style='padding:15px'>$promo</div>"?>
                        <?php echo "<div class='col-lg-12'>$content</div>"; ?>             
                        <?php echo $article_view?>
				    </div>
					
				</div>
				
			</div>
		</div>
		<div class='row'>
			<div class='col-lg-12'>
			</div>
		</div>
		<div class='row'>
			<div class='col-lg-12'>
                <?=load_view('eshop/template/footer')?>
			</div>
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

