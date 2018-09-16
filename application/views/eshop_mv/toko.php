<div class='sampul'><img src='<?=base_url()?>tmp/<?=$toko->foto_sampul?>'></div>
<div class='alert alert-info'>
<h1><?=$toko->nama_toko?></h1>
<h2><?=$toko->slogan?></h2>
<h3><?=$toko->description?></h3>
</div>
<p>Provinsi : <?=$toko->provinsi?>, Kabupaten : <?=$toko->kabupaten?>, Kota : <?=$toko->kota?> </p>
<div class='alert alert-warning'>
<a href='#' onclick='kirim_pesan();return false' class='btn btn-default'>Kirim Pesan</a>
Dibawah ini adalah barang-barang yang dijual oleh toko tersebut:
</div>
<div class='div-item '>
	<?php
			foreach($items->result() as $item){
				echo "<div style='color:black' onclick='view_item(\"$item->item_number\");return false;' 
				class='box_item col-sm-3 col-md-3 col-lg-3 '>";
	?>
				<div class='foto'>
					<img  src='<?=base_url()."tmp/".$item->item_picture?>'>
				</div>
				<div class='content'><?=$item->description?></div>
				<div class='item-footer'>
					<div class='item_no'>Kode: <?=$item->item_number?></div>
					<div class='price'>Rp. <?=number_format($item->retail)?></div>
				</div>
	<?php
				echo "</div>";
			}
	?>
</div>
<?php 
echo load_view('eshop/pesan_form');
?>
<script language="javascript">
function view_item(id){
	var url="<?=base_url()?>index.php/eshop/item/view/"+id;
	window.open(url,"_self");
}
</script>	
 