<?php
$cat_name='';
if(isset($cat)){
	$cat_name=$cat->category;
	$cat_id=$cat->kode;
	echo "<div class='thumbnail'><img src='".base_url()."tmp/$cat->item_picture'>
	<p>$cat->description</p></div>";
	echo "<h3>Category ".$cat->category."</h3>";
}
?>

<p>Silahkan pilih item yang ada dikelompok ini sesuai yang anda keinginan,
pilihlah dengan bantuan range harga atau jenis barang bila diperlukan.</p> 
 
			<div class='div-item '>
				<?
					 
						foreach($cat_items->result() as $item){
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
				<?
							echo "</div>";
						}
					 
				?>
			
			
			</div>
<script language="javascript">
function view_item(id){
	var url="<?=base_url()?>index.php/eshop/item/view/"+id;
	window.open(url,"_self");
}
</script>	
