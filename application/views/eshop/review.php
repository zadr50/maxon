<?php 
	$active_tab=1;
?>
<h1><?=$title?></h1>
<p>Halaman ini berisi diskusi produk yang anda jual atau yang anda beli dari toko lain.</p>
<p>Tampilkan: 
<a href='<?=base_url()?>index.php/eshop/diskusi/all'> Semua</a> | 
<a href='<?=base_url()?>index.php/eshop/diskusi/unread'> Belum Dibaca</a>
<div role="tabpanel">
	<ul class="nav nav-tabs" role='tablist'>
	  <li role="presentation" class='active'>
		<a href='#tab1'  role="tab" data-toggle="tab" class=' glyphicon glyphicon-inbox'> Semua</a></li>
	  <li role="presentation" >
		<a href='#tab2'  role="tab" data-toggle="tab" class='glyphicon glyphicon-transfer'> Produk Saya</a></li>
	  <li role="presentation">
		<a href='#tab3' role="tab" data-toggle="tab"  class='glyphicon glyphicon-briefcase'> Mengikuti</a></li>
	</ul>
 
	<div class='tab-content'>
		<div id='tab1'  role="tabpanel" class="tab-pane fade in active" >
		<?php 
			if(isset($comments)){
			foreach($comments->result() as $row) {
			?>
			<div class="box-comments-wrapper">
			<div class="box-comments">
				<div class="bc-header">
					<span class="bc-user"><?=$row->cm_username?></span>
					<span class="bc-date"><?=$row->cm_date?></span>
				</div>	
				<div class="bc-content">
					<?=$row->comments?>
				</div>
				<div class="bc-rating">
					Kualitas <span class="rating-<?=$row->rate_quality?>"></span>
					Akurasi <span class="rating-<?=$row->rate_accurate?>"></span>
					Kecepatan <span class="rating-<?=$row->rate_speed?>"></span>			
					Pelayanan <span class="rating-<?=$row->rate_service?>"></span>			
				</div>			
			</div>
			</div>
			<?php }
		} else {
			echo "Belum ada review atau komentar.";
		}
		?>
		
		</div>
		<div id='tab2' role="tabpanel" class="tab-pane fade">Tidak ada data </div>
		<div id='tab3' role="tabpanel" class="tab-pane fade">Tidak ada data </div>
	</div>			
</div>
<p>&nbsp</p>
<div class='alert alert-info'>
<li><small>Ulasan hanya bisa diberikan oleh pembeli yang transaksinya sudah berhasil.</small></li>
<li><small>Berikanlah ulasan dengan sejujur-jujurnya, karena komunitas akan menilai sendiri nantinya 
seberapa jujur setiap pembeli dan penjual yang ada di komunitas.</small></li>
<li><small>Ulasan <strong>Kualitas Produk</strong> menandakan kualitas dari barang 
yang telah diterima oleh pembeli.</small></li>
<li><small>Ulasan <strong>Kecepatan Pengiriman</strong> menandakan seberapa cepat 
barang dikirimkan oleh penjual. 
Perlu diperhatikan kecepatan barang sampai tergantung juga oleh lokasi penjual, 
lokasi pembeli, dan berbenturan dengan hari libur atau tidak.</small></li>
<li><small>Ulasan <strong>Akurasi Produk</strong> menandakan seberapa tepat barang 
yang dikirimkan oleh penjual dengan yang dijanjikan di etalase.</small></li>
<li><small>Ulasan <strong>Pelayanan Toko</strong> menandakan seberapa ramah dan baik 
pelayanan dari penjual dalam menanggapi setiap pertanyaan yang ada.</small></li>

</div>


		