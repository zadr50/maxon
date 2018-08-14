<div class="row">
  <div class="col-sm-5 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3>Urutan Install</h3>
        <li>1. Perjanjian Lisensi</li>
        <li><strong>2. Persiapan Install</strong></li>
        <li>3. Setup Database</li>
        <li>4. Setup Web Server</li>
        <li>5. Setup Data Master</li>
        <li>6. Selesai</li>
      </div>
    </div>
  </div>
  <div class="col-sm-7 col-md-8 ">
	<div class='thumbnail'>
	   <div class='row'>
		   <div class='col-md-10'>
				<h1>Persiapan Install</h1>
			   <p>Sebelum melakukan proses install silahkan periksa system webserver terlebih dahulu 
			   agar sesuai dengan kebutuhan menjalankan MaxOn dengan maksimal.
			   </p>
			   <p>Apabila ada salah satu bagian yang tidak terpenuhi atau error silahkan perbaiki 
			   terlebih dahulu sebelum menekan tombol teruskan.</p>
		   </div>
	   </div>
	   <div class='row'>
	   <?
		$ok="<img src='".base_url()."images/ok.png'>";
		$no="<img src='".base_url()."images/error.png'>";
	   ?>
			<div class='col-sm-4 col-md-4 '>
				<h4>PHP Setting</h4>
				<p><?php $safe_mode=(int)ini_get('safe_mode'); echo $safe_mode==0?$ok:$no?> safe_mode</p>
				<p><?php $register_global=(int)ini_get('register_global'); echo $register_global==0?$ok:$no?> register_global</p>
				<p><?php $magic_quotes=(int)ini_get('magic_quotes'); echo $magic_quotes==0?$ok:$no?> magic_quotes</p>
				<p><?php $file_uploads=(int)ini_get('file_uploads'); echo $file_uploads==1?$ok:$no?> file_uploads</p>
				<p><?php $auto_start=(int)ini_get('session.auto_start'); echo $auto_start==0?$ok:$no?> session.auto_start=</p>
				<p><?php $use_trans_sid=(int)ini_get('session.use_trans_sid'); echo $use_trans_sid==0?$ok:$no?> session.use_trans_sid</p>


				<h4>PHP Extensions </h4>
				<p><?php echo (extension_loaded('mysql') ?$ok:$no);?> MySql Server Database</p>
				<p><?php echo (extension_loaded('gd') ? $ok:$no);?> GD Library</p>
				<p><?php echo (extension_loaded('curl') ? $ok:$no);?> cURL Parser</p>
				<p><?php echo (extension_loaded('openssl') ? $ok:$no);?> OpenSSL Secure </p>

			</div>
			<div class='col-sm-4 col-md-6 '>
				<h4><?php $phpver=phpversion(); echo $phpver >= '5.1.6' ? $ok:$no;?> PHP Version <?=$phpver?></h4>
				<p>&nbsp</p>
				<h4>File Permision </h4>
				<?php $path = realpath('')."/"; ?>
				<p>&nbsp</p>
				<p><?php $file="application/config/config.php"; echo (is_writable($path.$file) ? $ok : $no); echo " " . $file; ?></p>
				<p><?php $file="application/config/maxon_installed.php"; echo (is_writable($path.$file) ? $ok : $no); echo " " . $file; ?></p>
				<p>&nbsp</p>
				<h4>Directory Permision </h4>
				<p><?php $file="tmp"; echo (is_writable($path.$file) ? $ok : $no); echo " " . $file; ?></p>
				<p><?php $file="images"; echo (is_writable($path.$file) ? $ok : $no); echo " " . $file; ?></li>
			</div>
		</div>	
		<div class='row'>
			<div class='col-md-10'>
			<p align='right'><a href="<?=base_url()?>index.php/setup/welcome/check_dir" 
			class="btn btn-info" role="button">Ulangi</a>
			<a href="<?=base_url()?>index.php/setup/welcome/cancel_install" 
			class="btn btn-warning" role="button">Batal</a>
			<a href="<?=base_url()?>index.php/setup/welcome/set_db" 
			class="btn btn-primary" role="button">Teruskan</a></p>
			</div>
		</div>	   
    </div> 
  </div>

  
</div>
