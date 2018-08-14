<?php 
	$active_tab=1;
?>
<h1><?=$title?></h1>
<p>Halaman ini berisi daftar complaint penjualan ataupun pembelian.</p>
<div class='alert alert-warning'>
	<p><strong>Komplain hanya bisa dilakukan terhadap transaksi pembelian</strong>
	Lihat daftar transaksi Anda di halaman Status Pemesanan dan Daftar Transaksi Pembelian.
	</p>	
</div>
<ul class="nav nav-tabs" style='background-color:white'>
  <li role="presentation" class=" <?=$active_tab==1?"active":""?> ">
		<a  data-toggle="collapse"	href='#my-com'> 
		<span class='glyphicon glyphicon-inbox'></span> Komplain Saya</a>
		</li>
  <li role="presentation" class="<?=$active_tab==2?"active":""?>">
		<a data-toggle="collapse"	href='#cst-com'> 
		<span class='glyphicon glyphicon-transfer'></span> Komplain Pembeli</a>
		</li>
	<div class='col=lg-12'>
		<div id='my-com'>
			<?=form_dropdown('complaint',array('0'=>'Dalam Proses','1'=>'Sudah Selesai',
			'2'=>'Semua'),'0');?>
			<?=form_dropdown('status-com',array(''=>'Semua','1'=>'Sudah Dibaca',
			'2'=>'Belum Dibaca'),'');?>
			<button class='btn btn-primary'>Refresh</button>
			<?=form_input('waktu',array(''=>'Semua','1'=>'Belum Dibaca','2'=>'Sudah Dibaca'),'')?>
			<span class='pull-right'><?=form_input('waktu'
			,array('1'=>'Waktu dibuat','2'=>'Perubahan Terbaru'),'1')?></span>
		</div>
	</div>			
</ul>
		