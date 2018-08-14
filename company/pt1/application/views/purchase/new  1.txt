<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head><title>MaxOn ERP Online Demo</title>
	<?
	echo $library_src;
	echo $script_head;
	?>
</head>

<body>
<script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>
<?php

date_default_timezone_set("Asia/Jakarta");
if(!isset($visible_right))$visible_right="True";
if(!isset($_left_menu))$_left_menu="";
if(!isset($_right_menu))$_right_menu="";

if(!isset($visible_right))$visible_right=TRUE;
if(isset($sidebar_show))$visible_right=$sidebar_show;
if(!isset($_left_menu))$_left_menu="";
if(!isset($_right_menu))$_right_menu="";

$sidebar_pos="left";
$sidebar_show=true;

if(!isset($header_show))$header_show=true;
if(!isset($footer_show))$footer_show=true;

if(!isset($_left_menu_caption))$_left_menu_caption='Left Menu';
if(!isset($message))$message="";

echo "<div class='bodyx'>
	<div class='container'>";
	if(!$ajaxed) {
		if($header_show){
			echo "<div class='row'>
				<div class='clearfix'></div>
				$_header
				<div id='msg-box-wrap'></div>
			</div>";
		}
		echo "<div class='row'>";
			if($sidebar_pos=="left"){
				if($sidebar_show) { 
				    echo "<div class='col-md-3'>";
					include_once "sidebar.php";
					echo "</div>";
					echo "<div class='col-md-9'> $_content </div>";
				} else { 
					echo "<div class='col-md-12'> $_content </div>";			
				    echo "<div class='col-md-3'>";
					include_once "sidebar.php";
					echo "</div>";
				}
			} else {
				if($sidebar_show) { 
					include_once "sidebar.php";
					echo "<div class='col-md-9'> $_content </div>";
				} else { 
					echo "<div class='col-md-12'> $_content </div>";			
				}
			}
		echo "</div>";
		if($footer_show){
			echo "<div class='row-fluid footer'>$_footer</div>";
		}
	} else { 		 
		echo $_content;  
	}
echo "</div>
</div>	
</body>";
?>

<script type="text/javascript">
$(document).ready(function(){

	$('.datepicker').datepicker();
	
	$(".info_link").click(function(event){
		event.preventDefault(); 
		var url = $(this).attr('href');
		var n = url.lastIndexOf("/");
		var j=url.lastIndexOf("#");
		if(j>0){
			var title=url.substr(j+1);
		} else {
			var title=url.substr(n+1);
		}
		if(title=='reports'){
			title=url.substr(n-10);
			title=title.substr(title.indexOf("/"));
		}
		if(url.indexOf("/menu")>5){
			window.open(url,"_self");
		} else {
			add_tab(title,url);
		}
	});
});
</script>
