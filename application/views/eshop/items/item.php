<?php
$item=$this->db->select('item_number,description,item_picture,retail,category,item_picture2,
item_picture3,item_picture4,special_features,view_count,sales_count,
weight,update_date,update_by,sales_min,insr_name,delivery_by,create_by')
	->where('item_number',$item_id)->get('inventory')->row();
	
$cat=$this->db->where("kode",$item->category)
	->get("inventory_categories")->row();
	
$cat_sub=$this->db->select("parent_id")->where("parent_id",$item->category)
	->get("inventory_categories");
	
$item_picture=load_picture($item->item_picture);
$item_picture2=load_picture($item->item_picture2);
$item_picture3=load_picture($item->item_picture3);
$item_picture4=load_picture($item->item_picture4);

?>

		 
			<div class='item-detail'>
					<!-- item picture -->
					<div class='col-lg-5'>
						<div class='foto thumbnail'>
							<img class='' src='<?=base_url()."tmp/".$item->item_picture?>'>
						</div>
						<div class='col-lg-12 col-xs-12 thumbnail foto-thumb'>
							<img class='col-lg-3 col-xs-3  ' src='<?=$item_picture?>'>
							<img class='col-lg-3 col-xs-3  ' src='<?=$item_picture2?>'>
							<img class='col-lg-3 col-xs-3  ' src='<?=$item_picture3?>'>
							<img class='col-lg-3 col-xs-3  ' src='<?=$item_picture4?>'>
						</div>
					</div> 
					<!-- item features -->
					<div class='col-lg-7'>
						<? include_once "box_item_desc.php" ?>
						<div class='col-md-12'>
							<table class='table'>
								<tr><td>Lihat</td><td><?=$item->view_count?></td>
									<td>Berat</td><td><?=$item->weight?></td>
								</tr>
								<tr><td>Terjual</td><td><?=$item->sales_count?></td>
									<td>Asuransi</td><td><?=$item->insr_name?></td>
								</tr>
								<tr><td>Kondisi</td><td><?='Baru'?></td>
									<td>Pemesanan Min</td><td><?=$item->sales_min?></td>
								</tr>							
							</table>
							<p><strong>Last Update Price:</strong> <?=date("d-F-Y H:i:s",strtotime($item->update_date))?></p>
							<p>Cara Berbelanja</p>
							<p><strong>Dukungan Pengiriman</strong></p>
							<p><?=$item->delivery_by?></p>						
						</div>	
						
					</div> 


			</div>
		
			<div class='row'></div>		 
			 
		 
		 
			<div role="tabpanel">
				<ul class="nav nav-tabs" role='tablist'>
				  <li role="presentation" class='active'>
						<a href='#tab1'  role="tab" data-toggle="tab">Komentar</a></li>
				  <li role="presentation">
						<a href='#tab2'  role="tab" data-toggle="tab">Diskusi</a></li>
				  <li role="presentation">
						<a href='#tab3' role="tab" data-toggle="tab" >Barang Sejenis</a></li>
				</ul>
				<div class="tab-content">
					  <div role="tabpanel" class="tab-pane fade in active" id="tab1">
								<?
								echo load_view("eshop/items/item_comments"); 
								?>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab2">
								<?
								echo load_view("eshop/items/item_discuss"); 
								?>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab3">
								<?
								echo load_view("eshop/items/item_similiar"); 
								?>
					  </div>
				</div>
			</div>
		 
	
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
<script language="javascript">
var id="<?=$item_id?>";
function view_item(id){
	var url="<?=base_url()?>index.php/eshop/item/view/"+id;
	window.open(url,"_self");
}
function beli(){
	var supplier='<?=$item->create_by?>';
	var item_number='<?=$item_id?>';
	var qty=$("#txtQty").val();
	var url="<?=base_url()?>index.php/eshop/item/beli/"+item_number+"/"+qty;
	window.open(url,"_self");
}
$(document).ready(function() {
    $('.item-detail .foto-thumb > img').click(function() {
		var img=$(this).attr("src");
		console.log(img);
		$(".item-detail .foto > img").attr("src",img);
    });
});
</script>