<?php
	$url=base_url()."/index.php/".$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3);
///		add_log_run($url);
?>
<div style="float:none;clear:both;"></div>
<div id='footer' name='footer' class="col-md-12 col-lg-12">
	<div class='col-lg-5'>
		<img src='<?=base_url()?>images/logo_maxon.png' style='float:left;margin:5px'>
		<p>Copyright &copy;2000-2013 Talagasoft Indonesia - Developed & Design by www.talagasoft.com</p>
		<p><?=$url?></p>
        <p><a href='#'  onclick='dlgSession_Show();return false'>Session</a></p>
	</div>
	<div class='col-md-4'>
		<li><a href='http://help.maxonerp.com'  target='_new'>Online Tutoial MaxOn ERP</a></li>
		<li><a href='http://www.facebook.com/maxon51'  target='_new'>Facebook MaxOn ERP</a></li>
		<li><a href='http://www.twitter.com/talagasoft'  target='_new'>Twitter MaxOn ERP</a></li>
		<li><a href='http://forum.maxonerp.com/' target='_new'>Forum MaxOn ERP</a></li>
		<li><a href='http://www.talagasoft.com/' >Talagasoft Indonesia</a></li>
		<div>
			<a href="http://www.facebook.com/maxon51" target="_new" title="Follow Facebook">
					<img src="<?=base_url()?>images/fb.png" style='width:50px;height:50px'></a>
			<a href="http://www.twitter.com/talagasoft" target="_new" title="Follow Twitter">
				<img src="<?=base_url()?>images/twitter.png"  style='width:50px;height:50px'>
			</a>
		</div>
	</div>
	<div class='col-md-3'>
		<?php echo load_view('google_ads');	?>	
	</div>	 
	<?php 
		if($this->config->item('tawk_visible')==true) {
			echo load_view("template/widget_tawk");     
		}
	?>
</div>
<?php
include_once "statusbar.php";
include_once "widget_session.php";
if($this->session->userdata('chatbox_visible')){
	echo load_view("maxon_chat/chatbox"); 
}
if($this->config->item('chatbox_visible')==true) {
    echo load_view("maxon_chat/chatbox");     
}
?>
