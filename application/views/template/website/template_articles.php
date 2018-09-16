<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>

<head><title>MaxOn ERP Online Demo</title></head>
<BODY>
<?php
date_default_timezone_set("Asia/Jakarta");
echo $library_src;
echo $script_head;
?>

<div class="container-fluid">
	<?php include_once "header.php"; ?> 
	<div class="row col-md-9" style="padding-left:10px;padding-right:10px">
		<? 
			if(isset($file_content)){
				$this->load->view($file_content);
				if(!isset($id))$id=0;
				if(!isset($hide_comments))$hide_comments=false;
				if(!$hide_comments){
					echo '<p>&nbsp;</p><p>&nbsp;</p>
					<div style="background-color:#FFFFFF;width:480px">
						<div class="fb-comments"
						data-href="'.base_url().'index.php/website/articles/view_article/'.$id.'"
						 data-width="470" data-num-posts="10">
						 </div>
					</div>';
				}
			} else {
				$this->load->view("website/articles"); 
			}
			
		?>		   
	</div>
	<div class="col-md-3 thumbnail" style="margin-left:10px">
		<? 
			//$this->load->view("login_panel");
			$this->load->view("website/article_cats");
			$this->load->view('google_ads');
		?>
	</div>
		   
	 
</div>   
  
<div class='clear'></div>
<div class="wrap box-gradient">
	<?php include_once "footer.php"; ?> 
</div>
		
</BODY>
<style>
.footer {
	
}
body {
	background-color: white;
}
</style>	

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


