<div class='row col-md-10 well'>
<h2><?=$caption?></h2>
<p>Preference berisi pengaturan dan content layout dari toko online anda, 
silahkan isi pada informasi yang diinginkan dibawah ini.</p>
<p>Pengaturan meliputi nama toko, thema, article lain yang akan ditampilkan sebagai 
tampilan antar muka toko online anda.</p>
</div> 
<div class='row col-md-10'>
<?
$form[]=array("input_type"=>"text","data"=>array("caption"=>"File gambar slider 1",
		"field_name"=>"slidder1","value"=>"images/slider1.jpg",
		"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"File gambar slider 2",
		"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"field_name"=>"slidder2","value"=>"images/slider2.jpg",
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"File gambar slider 3",
			"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"field_name"=>"slidder3","value"=>"images/slider3.jpg",
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));
$form[]=array("input_type"=>"text","data"=>array("caption"=>"File gambar slider 4",
		"caption_class"=>"col-md-4","text_class"=>"col-md-5","align"=>"right",
		"field_name"=>"slidder4","value"=>"images/slider4.jpg",
		"sub_caption"=>"Silahkan pilih nama file gambar untuk slider halaman utama."));

$data['category']='';
echo form_close();
echo "</div>";

foreach($form as $frm)
{
	$data=array_merge($frm['data']);
	switch($frm['input_type'])
	{
		case "dropdown":
			break;
		case "datetime":
			break;
		case "textarea":
			my_textarea($data);
		default:
			my_input($data);
	}
}
echo "<div class='row col-md-10'>";
include_once "articles_eshop.php";
echo "</div>";

echo "<div class='row col-md-10'>";
include_once "themas.php";
echo "</div>";


?>

