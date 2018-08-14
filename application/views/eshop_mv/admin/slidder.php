<div class='row col-md-10 well'>
<h2>Seting Slidder</h2>
<p>Preference berisi pengaturan dan content layout dari toko online anda, 
silahkan isi pada informasi yang diinginkan dibawah ini.</p>
<p>Pengaturan meliputi nama toko, thema, article lain yang akan ditampilkan sebagai 
tampilan antar muka toko online anda.</p>
</div> 
<div class='row col-md-10'>
<?
$form[]=array("input_type"=>"file","data"=>array("caption"=>"File gambar slider 1",
		"field_name"=>"slider1","value"=>$slider1,"show_images"=>true,
		"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));
$form[]=array("input_type"=>"file","data"=>array("caption"=>"File gambar slider 2",
		"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"field_name"=>"slider2","value"=>$slider2,"show_images"=>true,
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));
$form[]=array("input_type"=>"file","data"=>array("caption"=>"File gambar slider 3",
			"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"field_name"=>"slider3","value"=>$slider3,"show_images"=>true,
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));
$form[]=array("input_type"=>"file","data"=>array("caption"=>"File gambar slider 4",
		"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"field_name"=>"slider4","value"=>$slider4,"show_images"=>true,
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));

echo "<div class='col-md-10'>";
echo form_open('','class="form-horizontal" id="frmMain" ');
echo render_form($form);
echo form_close();
echo "</div>";
echo "<div class='col-md-10 well'>";
echo "<button style='float:right' class='btn btn-primary' name='cmdSave' 
		onclick='frmMain_Save();return false'>Save Changes</button>";		
echo "</div>";

?>
		<script language='javascript'>
		function frmMain_Save(){
			var url="<?=base_url()?>index.php/eshop_admin/slidder/save";
			var next_url='<?=base_url()?>index.php/eshop_admin/dashboard';
			$('#frmMain').ajax_post(url,'',next_url); 
		};
		</script>

