<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<head><title>MaxOn ERP Online</title></head>
<script type="text/javascript">
    CI_ROOT = "<?=base_url()?>index.php/";
    CI_BASE = "<?=base_url()?>"; 		
</script>

<BODY class='<?=$body_class?>' >	 

<?php 
    
	date_default_timezone_set("Asia/Jakarta");
	//include_once __DIR__."/../../analyticstracking.php";
    echo $library_src;
    echo $script_head; 
	
	if(!isset($visible_right))$visible_right="True";
	if(!isset($_left_menu))$_left_menu="";
	if(!isset($_right_menu))$_right_menu="";

	if(!isset($visible_right))$visible_right=TRUE;
	if(!isset($sidebar_show))$sidebar_show=true;
	$visible_right=$sidebar_show;
	if(!isset($_left_menu))$_left_menu="";
	if(!isset($_right_menu))$_right_menu="";

	$sidebar_pos=$this->session->userdata('sidebar_position');

	if(!isset($header_show))$header_show=true;
	if(!isset($footer_show))$footer_show=true;
    
    $config_header_show=$this->config->item("show_header");
    if(isset($config_header_show)){
        $header_show=$config_header_show;
    }

    $config_footer_show=$this->config->item("show_footer");
    if(isset($config_footer_show)){
        $footer_show=$config_footer_show;
    }

    
    if($config_sidebar_show=$this->config->item("show_sidebar")){
        $sidebar_show=$config_sidebar_show;
    }
    if($ssd=$this->session->userdata("sidebar_show")){
        if($ssd=="false")$sidebar_show=False; 
    }
    

	if(!isset($_left_menu_caption))$_left_menu_caption='Left Menu';
	if(!isset($message))$message="";
	$tiki_show=false;
	if(!isset($tiki_show))$tiki_show=false;
	if(!isset($body_class))$body_class="";
	
	echo "<div class='container-min '>";
	 
	
	if(!$ajaxed) {
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
	} else { 		 
		echo "<div class='col-md-12 '> $_content </div>";			
		//if($this->config->item('google_ads_visible')) $this->load->view('google_ads');					
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
	var _detik=0;
	function timer1(){
	    _detik++;
		var currentdate = new Date();
		var tgl=currentdate.getDay() + "/"+currentdate.getMonth() 
		+ "/" + currentdate.getFullYear();
		tgl='<?=date('Y-m-d')?>';
		$("#panel3").html("<?=user_id()?>");
		$("#panel4").html(tgl);
		$("#panel5").html(currentdate.getHours() + ":" 
		+ currentdate.getMinutes());
		if ( chatbox_visible !="" ) check_inbox();
		_timer1=setTimeout(function(){timer1()}, 60000);	//1menit
	}
});
    function check_inbox(){
        $.ajax({
            type: "GET",url: "<?=base_url()?>index.php/maxon_inbox/notify",
            data: {'user_id':'<?=user_id()?>'},
            success: function(msg){$('#panel2-msg').html(msg);}
            ,error: function(msg){}
        });         
    }
	function check_alert(){
        $.ajax({
            type: "GET",url: "<?=base_url()?>index.php/maxon_inbox/alert_count",
            success: function(msg){
                var result = eval('('+msg+')');
                if(result.success){
                   $("#user_log").html(result.count);
                }
                
           }
            ,error: function(msg){}
        });         
	    
	}
	 function load_menu(path){
	     xurl='<?=base_url()?>index.php/menu/load/'+path;
	     if(path=="courierex"){
	       add_tab_ajax(path,xurl);        
	     } else {
             window.open(xurl,'_self');
	         
	     }
	     return false;
	 }	
 
</script>

