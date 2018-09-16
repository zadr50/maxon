<?php
$item=$this->db->select('item_number,description,item_picture,retail,category')
	->where('item_number',$item_id)->get('inventory')->row();
$cat=$this->db->where("kode",$item->category)
	->get("inventory_categories")->row();
$cat_sub=$this->db->select("parent_id")->where("parent_id",$item->category)
	->get("inventory_categories");
?>
<div class="row-fluid" >
	<div class="col-sm-3  box-left  thumbnail">
		<ol class="breadcrumb">
		  <li><a  class='glyphicon glyphicon-home'
		  href="<?=base_url()?>index.php/eshop/home"> Home</a></li>
		  <li class="active"><?=$item->description?></li>
		</ol>
		<?php include_once 'box_sub_cat.php' ?>
		<?php include_once 'box_item.php' ?>
	</div>
	<div class="col-sm-9">
		<div class='item-detail'>
			<div class='foto-wrap col-md-5'>
				<div class='foto'>
					<img width='150px' height='200px' src='<?=base_url()."tmp/".$item->item_picture?>'>
				</div>
				<div class='foto-thumb'>
					<img src=''>
					<img src=''>
					<img src=''>
					<img src=''>
				</div>
			</div>
			<div class='content-wrap col-md-5'>
				<div class="panel panel-primary">
				  <div class='panel-heading'><h3 class="panel-title"><?=$item->description?><h3></div>	
				  <div class="panel-body">
					<div class='content'><span class='caption'>Nama Barang </span><?=$item->description?></div>
					<div class='item-no'><span class='caption'>Kode </span><?=$item->item_number?></div>
					<div class='price'><span class='caption'>Harga </span>
						<span style='font-size:20px'> Rp. <?=number_format($item->retail)?></span>
					</div>
					<div class='div-beli'>
						<span class='caption'>Quantity</span>
						<input type='text' name='txtQty' id='txtQty' style='width:50px' value='1'>
						<input type='button' class='btn btn-primary' onclick='beli()' value='BELI'>
					</div>
				  </div>
				</div>
			</div>
		</div>
		<div class='clear'></div>
		<ul class="nav nav-tabs">
		  <li role="presentation" >
				<a href='#' onclick='comments();return false;'>Komentar</a></li>
		  <li role="presentation">
				<a href='#' onclick='discuss();return false;'>Diskusi</a></li>
		  <li role="presentation">
				<a href='#' onclick='sejenis();return false;'>Barang Sejenis</a></li>
		</ul>
		
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

<script language="javascript">
function view_item(id){
	var url="<?=base_url()?>index.php/eshop/item/view/"+id;
	window.open(url,"_self");
}
function beli(){
	var item_number='<?=$item_id?>';
	var qty=$("#txtQty").val();
	var url="<?=base_url()?>index.php/eshop/item/beli/"+item_number+"/"+qty;
	window.open(url,"_self");
}
</script>

