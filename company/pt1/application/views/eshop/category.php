<?php
$cat_name='';
if(isset($cat)){
	$cat_name=$cat->category;
	$cat_id=$cat->kode;
	echo "<img  class='thumbnail col-md-12 col-sm-12' height='200px' 
	src='".load_picture($cat->item_picture)."'>
	<h5>$cat->description</h5>";
}
if(!isset($cat_items)){
	$cat_items=$this->db->limit(10)->get('inventory');
}
?>
 
<div class='div-item'>
	<?
	foreach($cat_items->result() as $item){
		echo "<div style='color:black' onclick='view_item(\"$item->item_number\");return false;' 
		class='box_item  col-lg-4 col-xs-7 '>";
	?>
		<div class='foto thumbnail'>
			<img  src='<?=load_picture($item->item_picture)?>'>
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
