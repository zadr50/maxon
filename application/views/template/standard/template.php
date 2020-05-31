<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head>
<title>MaxOn ERP Online</title>
<!-- </head> --></head>
<script type="text/javascript">
    CI_ROOT = "<?=base_url()?>index.php/";
    CI_BASE = "<?=base_url()?>"; 		
</script>

<BODY class='body-maxon' >	 

<?php 
    
	date_default_timezone_set("Asia/Jakarta");

    if(isset($library_src)){
        echo $library_src;
        echo $script_head;     
    }
	
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
    $mini_sidebar=false;
    if($ms=$this->session->userdata("mini_sidebar")){
    	$mini_sidebar=$ms;
    }
	$sidebar_show=!$mini_sidebar;

	if(!isset($_left_menu_caption))$_left_menu_caption='Left Menu';
	if(!isset($message))$message="";
	$tiki_show=false;
	if(!isset($tiki_show))$tiki_show=false;
	if(!isset($body_class))$body_class="";
	
	//echo "<div class='container-fluid '>";
	 
	
	if(!$ajaxed) {
		if($header_show) echo $_header;
		echo "<div class='row-fluid'>";
			if($sidebar_pos=="left"){
				if($sidebar_show) { 
				    echo "<div class='col-xs-12 col-sm-3  sidebar-maxon'  style='min-height:500px;'>";
						include_once "sidebar.php";
						if($tiki_show) {
							include_once __DIR__."/../../tiki.php";
						}
					echo "</div>";
					echo "<div class='col-xs-12 col-sm-9'>  $_content ";
					echo "</div>";
				} else { 
					echo "<div class='col-xs-12'> $_content </div>";			
				}
			} else {	//sidebar=right
				
				if($sidebar_show) { 
					echo "<div class='col-xs-12 col-sm-9 '> $_content ";					
						$this->load->view('google_ads');
					echo "</div>";
				    echo "<div class='col-xs-12 col-sm-3 sidebar-maxon' style='min-height:400px;padding:5px'>";
						include_once "sidebar.php";
					echo "</div>";
				} else { 
                    echo "<div id='divSidebar' style='position:absolute;z-index:1;width:300px;
                        height:500px;margin-left:90%;background-color:white;border:1px solid lightblue'>";
                        echo '<div style="left:0px">';
                        echo link_button("","toggle_divSidebar();return false;","back",'false','','',"'btnNav' style='float:left'");
                        echo '</div>';
                        echo "<div id='divSideBar3'>";
                        include "sidebar.php";
                        echo "</div>";
                    echo "</div>";
					echo "<div class='col-xs-12 '> $_content </div>";			
				}
			}
			
		echo "</div>";
		if($footer_show){			
			echo "
			<div>
				<div class='row'>
					<div class='row-fluid'>$_footer</div>
				</div>	
			</div>";
		}
	} else { 		 
		echo "<div class='col-xs-12 '> $_content </div>";			
		//$this->load->view('google_ads');					
	}
	
	 
	//echo "</div>";
 

?>
<div id='dlgSysLog'class="easyui-dialog" closed="true" style="width:600px;height:380px;left:100px;top:20px;padding:10px 20px">
	<div id='divSysLog'></div>
</div>
<div id='dialog_print'class="easyui-dialog" closed="true"  toolbar="#dialog_print_toolbar" 
    data-options="iconCls:'icon-print' " modal="true"
    style="width:800px;height:500px;padding:10px 20px">
    <div id='dialog_print_content'>
         <p>Please wait...</p>
    </div>
</div>
<div id='dialog_print_toolbar'>
    <?=link_button("Print", "cmdOK_Click();return false","print")?>
</div>
<?php
if(!isset($stop_background_process))$stop_background_process="false";
$bground_process=$this->sysvar->getvar("bground_process","true");
if(strtolower($bground_process)=="false"){
    $stop_background_process=true;
}
$bground_process_inventory = $this->sysvar->getvar("bground_process_inventory","true");
$bground_process_notify = $this->sysvar->getvar("bground_process_notify","true");
$bground_process_master = $this->sysvar->getvar("bground_process_master","true");
$bground_process_replicate = $this->sysvar->getvar("bground_process_replicate","true");
$bground_process_jurnal = $this->sysvar->getvar("bground_process_jurnal","true");
$bground_process_inbox = $this->sysvar->getvar("bground_process_inbox","true");

?>

<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/offline.js"></script>

<script language="JavaScript">
    var trun=0;
    var stop_background_process=<?=$stop_background_process?>;
    var _request_count=0;

    var _detik=0;
    var chatbox_visible='<?=$this->session->userdata('chatbox_visible')?>';
	var loadingDone =  document.readyState=="complete" && jQuery.active === 0;
    var sidebar_visible=false;
	var _request_count=0;

    $(document).ready(function(){
        $.parser.parse();
        $('.datepicker').datepicker();
        $('.map').maphilight({fade: false});
        timer1();
        //hidupkan apabila dihosting
        if(!stop_background_process){
            var flag=<?=$bground_process_inventory?>;
            if(flag)run_timer_recalc_inventory();
            
            flag=<?=$bground_process_notify?>;
            if(flag)run_timer_notify();
            
            flag=<?=$bground_process_master?>;
            if(flag)run_timer_recalc_master();
            
            flag=<?=$bground_process_replicate?>;
            if(flag)run_timer_replicate();
            
            flag=<?=$bground_process_jurnal?>;
            if(flag)run_timer_jurnal();
            
            flag=<?=$bground_process_inbox?>;
            if(flag)run_timer_inbox();
        }
        
    })    
    function timer1(){
        _detik++;
        var currentdate = new Date();
        var tgl=currentdate.getDay() + "/"+currentdate.getMonth() + "/" + currentdate.getFullYear();
        tgl='<?=date('Y-m-d')?>';        
        $("#panel3").html("<?=user_id()?>");
        $("#panel3a").html("<?=current_database()?>");
        $("#panel4").html(tgl);
        $("#panel5").html(currentdate.getHours() + ":" + currentdate.getMinutes());
    }
    function run_timer_inbox(){
        timer1();
        _timer1=setTimeout(function(){run_timer_inbox()}, 60000);    //1menit
        if ( chatbox_visible !="" ) check_inbox();
        check_alert();

    }
    function check_inbox(){
    	//console.log("loadingDone:"+loadingDone);
        _request_count++;
        if(_request_count>15){
            console.log('_request_count limited = 15 check_inbox()');
            return;
        }
        console.log('_request_count: check_inbox() '+_request_count);
        $.ajax({
            type: "GET",url: "<?=base_url()?>index.php/maxon_inbox/notify",
            data: {'user_id':'<?=user_id()?>'},
            success: function(msg){
                _request_count--;
                $('#panel2-msg').html(msg);
            }
            ,error: function(msg){}
        });         
    }
    function check_alert(){
        _request_count++;
        if(_request_count>15){
            console.log('_request_count limited = 15 check_alert()');
            return;
        }
        console.log('_request_count: check_alert() '+_request_count);
        $.ajax({
            type: "GET",url: "<?=base_url()?>index.php/maxon_inbox/alert_count",
            success: function(msg){
                var result = eval('('+msg+')');
                if(result.success){
                    _request_count--;                
                   $("#user_log").html(result.count);
                   $("#panel2-msg").html("Inbox: "+result.count);
                   $("#panel3a").html(result.current_database);
                }
                
           }
            ,error: function(msg){}
        });         
    }
     function load_menu(path,new_window){
         xurl='<?=base_url()?>index.php/menu/load/'+path;
         if(path=="courierex"){
           add_tab_ajax(path,xurl);        
         } else {
         	if(new_window){
             window.open(xurl,'_blank');         		
         	} else {
             window.open(xurl,'_self');         		
         	}
             
         }
         return false;
     }
     function load_menu_app(path,new_window){
         xurl='<?=base_url()?>index.php/'+path;
         if(path=="courierex"){
           add_tab_ajax(path,xurl);        
         } else {
         	if(new_window){
             window.open(xurl,'_blank');         		
         	} else {
             window.open(xurl,'_self');         		
         	}
             
         }
         return false;
     	
     }  
     function toggle_divSidebar(){
         console.log("sidebar_visible=" + sidebar_visible);
        if(sidebar_visible==false){
            $("#divSidebar").css("margin-left","76%");
            sidebar_visible=true;
        } else {
            $("#divSidebar").css("margin-left","90%");
            sidebar_visible=false;

        }

    }
    function run_timer_jurnal(){
        _request_count++;
        if(_request_count>15){
            console.log('_request_count limited = 15 run_timer_jurnal()');
            return;
        }
        console.log('_request_count: run_timer_jurnal() '+_request_count);
        $('#msg-box-wrap').html("Run: jurnal");     
        trun=setTimeout(function(){run_timer_jurnal()}, 170000);
        $.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/posting/autopost',
                contentType: 'application/json; charset=utf-8',
                success: function(msg){
                    if(msg!=''){
	                    //console.log(msg);
	                    $("#msg-box-wrap").html('run_timer_jurnal()');                    	
                    }
                    _request_count--;
                }
        });
    	
    }
    function run_timer_replicate() {
        _request_count++;
        if(_request_count>15){
            console.log('_request_count limited = 15 run_timer_replicat()');
            return;
        }
        console.log('_request_count: run_timer_replicate() '+_request_count);
        $('#msg-box-wrap').html("Run: replicate");     
        trun=setTimeout(function(){run_timer_replicate()}, 80000);
        $.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/replicate/process',
                contentType: 'application/json; charset=utf-8',
                success: function(msg){
                    if(msg!=''){
	                    //console.log(msg);
                        $("#msg-box-wrap").html('run_timer_replicate()');                    	
                        _request_count--;
                    }
                }
        });
    }
    
    function run_timer_recalc_inventory() {
        _request_count++;
        if(_request_count>15){
            console.log('_request_count limited = 15 run_timer_recalc_inventory()');
            return;
        }
        console.log('_request_count: run_timer_recalc_inventory() '+_request_count);
        $('#msg-box-wrap').html("Run: inventory");     
        trun=setTimeout(function(){run_timer_recalc_inventory()}, 60000);
        $.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/inventory/recalc',
                contentType: 'application/json; charset=utf-8',
                success: function(msg){
                    if(msg!=''){
	                    //console.log(msg);
                        $("#msg-box-wrap").html('run_timer_recalc_inventory()');                    	
                        _request_count--;
                    }
                }
        });
    }
    function run_timer_notify() {
        _request_count++;
        if(_request_count>15){
            console.log('_request_count limited = 15 run_timer_notify()');
            return;
        }
        console.log('_request_count: rum_timer_notify() '+_request_count);
        $('#msg-box-wrap').html("Run: notify");     
        trun=setTimeout(function(){run_timer_notify()}, 100000);
        $.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/notify/process',
                contentType: 'application/json; charset=utf-8',
                success: function(msg){
                    if(msg!=''){
	                    //console.log(msg);
                        $("#msg-box-wrap").html('run_timer_notify()');                    	
                        _request_count--;
                    }
                }
        });
    }
    function run_timer_recalc_master() {
        _request_count++;
        if(_request_count>15){
            console.log('_request_count limited = 15 run_timer_recalc_master()');
            return;
        }
        console.log('_request_count: run_timer_recalc_master() '+_request_count);
        $('#msg-box-wrap').html("Run: recalc_master");     
        trun=setTimeout(function(){run_timer_recalc_master()}, 40000);
        $.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/apps/recalc_master',
                contentType: 'application/json; charset=utf-8',
                success: function(msg){
                    if(msg!=''){
	                    //console.log(msg);
                        $("#msg-box-wrap").html('run_timer_recalc_master()');                    	
                        _request_count--;
                    }
                }
        });
    }
    
    
</script>


<!-- </body></html> --></BODY>
