<?php 
	$active_tab=1;
?>
<h1><?=$title?></h1>
<p>Halaman ini berisi review pembeli atau ulasan atas produk yang anda jual.</p>
<p>Tampilkan: 
<a href='<?=base_url()?>index.php/eshop/review/all'> Semua</a> | 
<a href='<?=base_url()?>index.php/eshop/review/unread'> Belum Dibaca</a>
<div role="tabpanel">
	<ul class="nav nav-tabs" role='tablist'>
	  <li role="presentation" class='active'>
		<a href='#tab1'  role="tab" data-toggle="tab" class=' glyphicon glyphicon-inbox'> Semua</a></li>
	  <li role="presentation" >
		<a href='#tab2'  role="tab" data-toggle="tab" class='glyphicon glyphicon-transfer'> Produk Saya</a></li>
	  <li role="presentation">
		<a href='#tab3' role="tab" data-toggle="tab"  class='glyphicon glyphicon-briefcase'> Review Saya</a></li>
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
				</div>
				</div>
				<?php }
			} else {
				echo "Belum ada diskusi untuk produk anda.";
			}
			?>
		</div>
		<div id='tab2' role="tabpanel" class="tab-pane fade">Tidak ada data </div>
		<div id='tab3' role="tabpanel" class="tab-pane fade">Tidak ada data </div>
	</div>
</div>
