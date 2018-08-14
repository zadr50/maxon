<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head><title>MaxOn ERP Online Demo</title></head>
<script type="text/javascript">
    CI_ROOT = "<?=base_url()?>index.php/";
    CI_BASE = "<?=base_url()?>"; 		
</script>

<BODY class='<?=$body_class?>' >	 

<?php 
	echo $library_src;
	echo $script_head;

	date_default_timezone_set("Asia/Jakarta");
	//include_once __DIR__."/../../analyticstracking.php";

	$visible_right=FALSE;
	$_left_menu="";
	$_right_menu="";

	$sidebar_show=FALSE;
	$visible_right=$sidebar_show;
	$sidebar_pos="";

	$header_show=FALSE;
	$footer_show=FALSE;

	$_left_menu_caption='';
	if(!isset($message))$message="";
	$tiki_show=false;
	$body_class="";
	
	echo "<div class='container-min '>";
	 
	if($header_show) echo $_header;
    
	echo "<div class='row'>";
		if($sidebar_pos=="left"){
			if($sidebar_show) { 
			    echo "<div class='col-md-3  sidebar'  style='min-height:1000px;'>";
				include_once "sidebar.php";
				if($tiki_show) {
					include_once __DIR__."/../../tiki.php";
				}
				echo "</div>";
				echo "<div class='col-md-9'>  $_content ";
				echo "</div>";
			} else { 
				echo "<div class='col-md-12'> $_content </div>";			
			}
		} else {	//sidebar=right
			
			if($sidebar_show) { 
				echo "<div class='col-md-9 panel-body-min'> $_content </div>";
			    echo "<div class='col-md-3 sidebar' style='min-height:1000px;'>";
					include_once "sidebar.php";
				echo "</div>";
			} else { 
				echo "<div class='col-md-12 '> $_content </div>";			
			}
		}
		
	echo "</div>";
	if($footer_show){
		echo "<div class='row-fluid footer'>$_footer</div>";
	}
	 
	echo "</div>";
 

?>
<div id='dlgSysLog'class="easyui-dialog" closed="true" style="width:600px;height:380px;left:100px;top:20px;padding:10px 20px">
	<div id='divSysLog'></div>
</div>
</BODY>

<script type="text/javascript">
$(document).ready(function(){
	var chatbox_visible='<?=$this->session->userdata('chatbox_visible')?>';
	$('.datepicker').datepicker();
	
	$(".info_link").click(function(event){
		event.preventDefault(); 
		var url = $(this).attr('href');
		console.log(url);
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
	
	timer1();
	
	function timer1(){
		var currentdate = new Date();
		var tgl=currentdate.getDay() + "/"+currentdate.getMonth() 
		+ "/" + currentdate.getFullYear();
		tgl='<?=date('Y-m-d')?>';
		$("#panel3").html("<?=user_id()?>");
		$("#panel4").html(tgl);
		$("#panel5").html(currentdate.getHours() + ":" 
		+ currentdate.getMinutes());
		if ( chatbox_visible !="" ) {
			$.ajax({
				type: "GET",url: "<?=base_url()?>index.php/maxon_inbox/notify",
				data: {'user_id':'<?=user_id()?>'},
				success: function(msg){$('#panel2-msg').html(msg);}
				,error: function(msg){}
			});			
		}
		_timer1=setTimeout(function(){timer1()}, 260000);	
	}
});
	
	 function load_menu(path){
	     xurl='<?=base_url()?>index.php/menu/load/'+path;
	     window.open(xurl,'_self');
	     return false;
	 }	
 
</script>

