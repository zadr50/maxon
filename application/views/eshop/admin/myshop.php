<div class='row col-md-10 well'>
<h2>Informasi Toko</h2>
<p>Silahkan isi informasi nama toko dan alamat atau telpon toko online anda dibawah ini, 
kemudian klik submit apabila sudah selesai.</p>
<p>	<?=$message?></p>
</div> 
<?
$form[]=array("input_type"=>"text","data"=>array("caption"=>"Nama Toko online anda",
		"field_name"=>"company_name","value"=>$company_name,
		"caption_class"=>"col-md-4","text_class"=>"col-md-6","align"=>"right",
		"sub_caption"=>"Silahkan isi nama toko online anda"));
$form[]=array("input_type"=>"textarea","data"=>array("caption"=>"Alamat toko offline",
		"field_name"=>"street","value"=>$street, 
		"sub_caption"=>"Isi alamat lengkap toko offline atau kantor"));
$form[]=array("input_type"=>"textarea","data"=>array("caption"=>"Nama Gedung ",
		"field_name"=>"suite","value"=>$suite,
		"sub_caption"=>"Isi nama gedung atau lokasi atau blok"));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"Negara",
		"field_name"=>"country","value"=>$country,
		"sub_caption"=>""));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"Telpon",
		"field_name"=>"phone_number","value"=>$phone_number,
		"sub_caption"=>""));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"Fax",
		"field_name"=>"fax_number","value"=>$fax_number,
		"sub_caption"=>""));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"Handphone/BBM",
		"field_name"=>"handphone","value"=>$handphone,
		"sub_caption"=>"Isi dengan nomor handphone,bbm,whatsapp"));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"Email",
		"field_name"=>"email","value"=>$email,
		"sub_caption"=>"Isi dengan alamat email"));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"File Logo toko",
		"field_name"=>"file_logo","value"=>$file_logo,
		"sub_caption"=>"Silahkan pilih nama file format PNG untuk logo bagian header"));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"Kode Perusahaan",
		"field_name"=>"company_code","value"=>$company_code,
		"sub_caption"=>"Silahkan isi dengan kode perusahaan atau dikosongkan apabila 
		perusahaan baru.","param"=>"readonly"));

echo "<div class='col-md-10'>";
echo form_open('','class="form-horizontal"');
echo render_form($form);
echo "</div>";
echo "<div class='col-md-10 well'>";
echo "<button style='float:right' class='btn btn-primary' name='submit' type='submit'>Save Changes</button>";		
echo "</div>";
echo form_close();

