	<div class="col-sm-12 col-md-12 col-lg-12">
		<h1><?=$caption?></h1>
		<p>Selamat datang dan selamat bergabung di toko online kami</p>
		<p>Silahkan isi informasi pendaftaran dibawah ini, sebelum anda 
		membuat transaksi pembelian dan pemesanan barang.</p>
		<?=load_view("eshop/member_form");?>		
		<p><a href="#" onclick='frmMain_Save();return false;' class='btn btn-primary'>Submit</a></p>
		<hr>
		<div class="alert alert-info">
			<h4 class="red ta-center mb-10">Informasi Keamanan</h4>
				<div class=" mt-40 ml-10 mr-15 mb-50">
					<i class="icon-locked fs-50"></i>
				</div>
						<div class=" fs-12 lh-18">
							<ul><li class="">
								<i class="icon-checked pull-left mt-5"></i>
								<p class=" span6 ml-0 mr-10 mb-5 span10">
								Harap tidak menginformasikan <b>username dan password</b> 
								Anda kepada siapapun, termasuk pihak yang mengatasnamakan 
								Tokokami.</p>
								</li>
								<li class=""><i class="icon-checked  pull-left mt-5"></i>
								<p class=" span6 ml-0 mr-10 mb-5 span10">
								Semua proses jual beli berlangsung <b>otomatis</b> 
								melalui sistem.</p></li>
								<li class="">
								<i class="icon-checked pull-left mt-5"></i>
								<p class="span6 ml-0 mr-10 mb-5 span10">
								Pastikan pembayaran hanya dilakukan ke <b>
								rekening resmi milik kami.</b>.
								</p>
								</li>
								<li class="">
								<i class="icon-checked pull-left  mt-5">
								</i>
								<p class=" span6 ml-0 mr-10 mb-5 span10">
								Untuk setiap link yang anda dapatkan, <b>pastikan alamat browser berada di http://tokodemo.maxonerp.com</b>.</p>
								</li>	
								<li class="clearfix"></li>
								</ul>
								<a class="pull-right mt-5 mb-5" 
									href="http://tokodemo.maxonerp.com/panduan/beli" 
									target="_blank">
									<u>Baca selengkapnya</u></a>
						</div>
		</div>
		
	</div>
<script language='javascript'>
function frmMain_Save(){
  		if($('#customer_number').val()==''){alert('Isi username !');return false;}
  		if($('#company').val()==''){alert('Isi nama anda !');return false;}
		var cust_id=$('#customer_number').val();
		url='<?=base_url()?>index.php/eshop/member/save';
		next_url="<?=base_url()?>index.php/eshop/login";
		$('#frmMain').ajax_post(url,'',next_url);		
}
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
