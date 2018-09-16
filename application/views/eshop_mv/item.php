<?php
$item=$this->db->select('item_number,description,item_picture,retail,category,item_picture2,
item_picture3,item_picture4,special_features,view_count,sales_count,
weight,update_date,update_by,sales_min,insr_name,delivery_by,create_by')
	->where('item_number',$item_id)->get('inventory')->row();
$cat=$this->db->where("kode",$item->category)
	->get("inventory_categories")->row();
$cat_sub=$this->db->select("parent_id")->where("parent_id",$item->category)
	->get("inventory_categories");
?>

		<div class='row'>
			<div class='item-detail'>
				<div class='row thumbnail' >
					<div class='foto thumbnail col-md-6 col-lg-6 col-sm-6'>
						<img style="height:280px" src='<?=base_url()."tmp/".$item->item_picture?>'>
					</div>
					<div class='foto-thumb col-md-2 col-lg-2 col-sm-2'>
						<img width='150px' height='150px'  src='<?=base_url()."tmp/".$item->item_picture?>'>
						<img width='150px' height='150px'   src='<?=base_url()."tmp/".$item->item_picture2?>'>
						<img width='150px' height='150px'  src='<?=base_url()."tmp/".$item->item_picture3?>'>
						<img width='150px' height='150px'  src='<?=base_url()."tmp/".$item->item_picture4?>'>
					</div>
 
					<div class='col-md-4'>
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
						
						<div class='alert alert-info'><p><strong>Informasi Penjual</strong></p>
						<p><?php
						if($item->create_by=='') {
							echo "<span style='color:red'>Tidak ada penjual untuk barang ini.</span>";
						} else {
							echo "<a href='".base_url()."index.php/eshop/toko/view/$item->create_by' title='Informasi penjual'>$item->create_by</a>";
						}?></p>
						</div>
						<?php include_once 'box_item_price.php'; ?>

					</div>					
				</div>
				<div class='row'>
					
					<div class='col-md-7'> 
						<div class="panel panel-default">
						  <div class='panel-heading'>
							<h3 class="panel-title"><?=$item->description?></h3>
						  </div>	
						  <div class="panel-body">
							<table class='table'>
								<tr><td>Nama Barang </td><td><?=$item->description?></td></tr>
								<tr><td>Kode </td><td><?=$item->item_number?></td>
								<tr><td>Harga </td><td>
									<span style='font-size:20px'> Rp. <?=number_format($item->retail)?></td>
								</tr>
								<tr><td>Quantity</td>
									<td><input type='text' name='txtQty' id='txtQty' style='width:50px' value='1'></td>
								</tr>
								<tr><td></td><td>
									<input style='width:100%;margin-top:20px' type='button' class='btn btn-primary' onclick='beli()' value='BELI'>
								</td>
								</tr>
							</table>
						  </div>
						</div>
					</div>
					</div>
				</div>
				<div class='row'>
					<div class='content col-md-12'>
						<?php
						
						$content=$item->special_features;
						$content=strip_tags($content,"<b><i><strong><p><h1><br><h2><h3><li>");
						echo $content;
						?>
					</div>
				</div>
		</div>
		<div class='row'>
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
								<?php
								echo load_view("eshop/item_comments"); 
								?>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab2">
								<?php
								echo load_view("eshop/item_discuss"); 
								?>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab3">
								<?php
								echo load_view("eshop/item_similiar"); 
								?>
					  </div>
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
	if(supplier==''){
		alert("Anda tidak dapat membeli barang ini, karena tidak ada penjual untuk barang ini");
		return false;
	}
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