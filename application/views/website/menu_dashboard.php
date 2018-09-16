 <?
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="col-md-12 thumbnail">
			<?php 
				$keterangan="Daftar Artikel.";
				$img=base_url("images/rocket.png");
				echo info_link_box("website/articles", "Articles", $img, $keterangan);

				$keterangan="Daftar Kelompok.";
				$img=base_url("images/tor-icon.png");
				echo info_link_box("website/category", "Kelompok", $img, $keterangan);

			?>
		</div>
	</div>
</div>



<script  language="javascript">
$().ready(function(){
	//void get_this(CI_ROOT+'purchase_invoice/daftar_kartu_gl','','divGL');
});
	
	
</script>

