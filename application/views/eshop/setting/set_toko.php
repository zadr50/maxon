<?php 
	
?>
<h1>PENGATURAN</h1>
<div class='alert alert-info'>
<p>Halaman ini berisi pengaturan toko anda</p>
</div>

<ul class="nav nav-tabs" style='background-color:white'>
  <li role="presentation" class=" <?=$active_tab==1?"active":""?>">
		<a  href='<?=base_url()?>index.php/eshop/set_toko/tab/1'> 
		<span class='glyphicon glyphicon-inbox'></span> Informasi Umum</a>
		</li>
  <li role="presentation"class="<?=$active_tab==2?"active":""?>">
		<a  href='<?=base_url()?>index.php/eshop/set_toko/tab/2'> 
		<span  class='glyphicon glyphicon-transfer' ></span> Pengiriman</a>
		</li>
  <li role="presentation"class="<?=$active_tab==3?"active":""?>">
		<a  href='<?=base_url()?>index.php/eshop/set_toko/tab/3'> 
		<span class='glyphicon glyphicon-briefcase' ></span> Pembayaran</a>
		
		</li>
  <li role="presentation"class="<?=$active_tab==4?"active":""?>">
		<a  href='<?=base_url()?>index.php/eshop/set_toko/tab/4'> 
		<span class='glyphicon glyphicon-ban-circle' ></span> Etalase</a>
		</li>
  <li role="presentation"class="<?=$active_tab==5?"active":""?>">
		<a  href='<?=base_url()?>index.php/eshop/set_toko/tab/5'> 
		<span class='glyphicon glyphicon-ban-circle' ></span> Catatan</a>
		</li>
  <li role="presentation"class="<?=$active_tab==6?"active":""?>">
		<a  href='<?=base_url()?>index.php/eshop/set_toko/tab/6'> 
		<span class='glyphicon glyphicon-ban-circle' ></span> Lokasi</a>
		</li>
	<div class='col-lg-12 panel'>
		<?php 
			echo '<h2>'.$title.'</h2>';
			if($message<>''){
				echo "<div class='alert alert-warning'>".$message."</div>";
			}
			echo load_view($page);
			
		?>
	</div>	
		
</ul>
		

		