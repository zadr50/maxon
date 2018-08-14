<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head><title>MaxOn ERP Online Demo</title>
	<?php
date_default_timezone_set("Asia/Jakarta");
//date("Y-m-d H:i:s", mktime(date("H")-1, date("i"), date("s"), date("m"), date("d"), date("Y")));
//echo gmdate("Y-m-d H:i:s", time()+60*60*7);
?>
<?
echo $library_src;
echo $script_head;
if(!isset($visible_right))$visible_right="True";
if(!isset($_left_menu))$_left_menu="";
if(!isset($_right_menu))$_right_menu="";
?>
	
<?

	if(!isset($_left_menu_caption))$_left_menu_caption='Left Menu';
	if(!isset($message))$message="";
?> 
<script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>
</head>
<body>
<div class='bodyx'>
<div class="container">
	<? if(!$ajaxed) { ?> 
		<div class="row">
			<?=$_header?>
		</div>
		<div class="row" >
			<div class="col-md-9">
				<?php echo $_content;?>
			</div>
			
			<? 
			$visible_right=true;
			if($visible_right!=""){?>
				<div id="__section_right" class="col-md-3" >
					<div class="panel panel-primary " style="margin-bottom:10px">
						<div class="panel-heading">
							<h3 class="panel-title   glyphicon glyphicon-log-in "  style="padding:10px;color:white"> USER LOGIN</h3>
						</div>
						<div class="panel-body"   style="padding:10px;">
							<?
							echo $this->access->print_info();
							echo "</br>".date('l jS \of F Y h:i:s A');
							?>
						</div>	
					</div>
					<div class="panel panel-primary "  style="margin-bottom:10px" >
						<div class="panel-heading">
							<h3 class="panel-title glyphicon glyphicon-th"  style="padding:10px;color:white"> MAIN MENU</h3>
						</div>
						<div class="panel-body"   style="padding:10px;">
							<?=$_left_menu?>
						</div>
					</div>

					<div class="panel panel-primary "  style="margin-bottom:10px">
						<div class="panel-heading">
							<h3 class="panel-title glyphicon glyphicon-question-sign"  style="padding:10px;color:white"> HELP BOX</h3>
						</div>
						<div class="panel-body"   style="padding:10px;">
							<div id="help"></div>
						</div>	
					</div>
					<div class="panel panel-primary "  style="margin-bottom:10px">
						<div class="panel-heading">
							<h3 class="panel-title glyphicon glyphicon-facetime-video"  style="padding:10px;color:white"> LAST RUNING</h3>
						</div>
						<div class="panel-body"   style="padding:10px;">
							<?=$sys_log_run?>
						</div>
					</div>
					
					<div class="panel panel-primary "  style="margin-bottom:10px">
						<div class="panel-heading">
							<h3 class="panel-title glyphicon glyphicon-euro"  style="padding:10px;color:white"> DONATE</h3>
						</div>
						<div class="panel-body"   style="padding:10px;">
							 <h4>DONASI</h4>
							 <li><strong>BANK BCA</strong></li>
								<I>ANDRI ANDIANA - 2400 0920 98</I>						 
							 <li><strong>PAYPAL</strong><i>Click Cofee ;)</i></li>	
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="3B2BALTFG7KWQ">
								<input type="image" src="<?=base_url()?>images/donation.png" style="width:165px!important;" width="165px" 
								height="auto" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="10" height="10">
							</form>
						</div>	
					</div>
				</div>	
			<? } ?>
			
		</div>
		<div class="row-fluid footer"><div style="margin:10px 10px;"><?=$_footer?></div></div>
	<? } else { ?>
		 
		<?php echo $_content;?>  
		 
	<? } ?>
</div>  
</div>

</body>

