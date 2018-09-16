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
	   <?php
		$ok="<img src='".base_url()."images/ok.png'>";
		$no="<img src='".base_url()."images/error.png'>";
	   ?>
			<div class='col-sm-4 col-md-4 '>
				<h4>PHP Setting</h4>
				<li>safe_mode=<?=$safe_mode=(int)ini_get('safe_mode')?> - <?=$safe_mode==0?$ok:$no?></li>
				<li>register_global=<?=$register_global=(int)ini_get('register_global')?> - <?=$register_global==0?$ok:$no?></li>
				<li>magic_quotes=<?=$magic_quotes=(int)ini_get('magic_quotes')?> - <?=$magic_quotes==0?$ok:$no?></li>
				<li>file_uploads=<?=$file_uploads=(int)ini_get('file_uploads')?> - <?=$file_uploads==1?$ok:$no?></li>
				<li>session.auto_start=<?=$auto_start=(int)ini_get('session.auto_start')?> - <?=$auto_start==0?$ok:$no?></li>
				<li>session.use_trans_sid=<?=$use_trans_sid=(int)ini_get('session.use_trans_sid')?> - <?=$use_trans_sid==0?$ok:$no?></li>

				<h4>PHP Version <?=$phpver=phpversion()?> - <?=(($phpver >= '5.1.6') ? $ok:$no);?> </h4>

				<h4>PHP Extensions </h4>
				<li>MySql - <?=(extension_loaded('mysqli') ?$ok:$no);?> </li>
				<li>GD - <?=(extension_loaded('gd') ? $ok:$no);?></li>
				<li>cURL - <?=(extension_loaded('curl') ? $ok:$no);?></li>
				<li>OpenSSL - <?=(extension_loaded('openssl') ? $ok:$no);?></li>

			</div>
			<div class='col-sm-4 col-md-6 '>
				<h4>File Permision </h4>
				<?php $path = realpath('').'../../'; ?>
				<li><?=$file="application/config/config.php"?> <?=(is_writable($path.$file) ? $ok : $no);?></li>
				<li><?=$file="application/config/maxon_installed.php"?> <?=(is_writable($path.$file) ? $ok : $no);?></li>
				<h4>Directory Permision </h4>
				<li><?=$file="tmp"?> <?=(is_writable($path.$file) ? $ok : $no);?></li>
				<li><?=$file="images"?> <?=(is_writable($path.$file) ? $ok : $no);?></li>
			</div>
		</div>	
		<div class='row'>
			<div class='col-md-10'>
			<p align='right'><a href="<?=base_url()?>index.php/welcome/check_dir" 
			class="btn btn-info" role="button">Ulangi</a>
			<a href="<?=base_url()?>index.php/welcome/cancel_install" 
			class="btn btn-warning" role="button">Batal</a>
			<a href="<?=base_url()?>index.php/welcome/set_db" 
			class="btn btn-primary" role="button">Teruskan</a></p>
			</div>
		</div>	   
    </div> 
  </div>

  
</div>
