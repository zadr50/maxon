<?
		$url=base_url()."/index.php/".$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3);
///		add_log_run($url);
?>
<div style="float:none;clear:both;"></div>
<div id='footer' name='footer' class="col-md-12 col-lg-12">
	<div class='col-lg-5'>
		<img src='<?=base_url()?>images/logo_maxon.png' style='float:left;margin:5px'>
		<p>Copyright &copy;2000-2013 Talagasoft Indonesia - Developed & Design by www.talagasoft.com - <?=$url?></p>
	 
		
	</div>
	<div class='col-md-5'>
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
	 
        <?php if(!strpos($url,"localhost")) {  ?>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/56b677765d8a6c387d76c0be/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
	</script>
	<!--End of Tawk.to Script-->
        <?php } ?>
</div>
<?
include_once "statusbar.php";
if($this->session->userdata('chatbox_visible')){
	echo load_view("maxon_chat/chatbox"); 
}

?>
