<?php $cat_list=array_data_table("inventory_categories","kode","category"); 
if(!isset($readonly))$readonly='';
?>
<form  enctype="multipart/form-data" class="form-horizontal" id='frmBarang' method='post' >
	<?=my_input("Kode Barang","item_number",'','col-sm-4','col-sm-5','$readonly')?>
	<?=my_input("Nama Barang","description",'','col-sm-4','col-md-7')?>
	<?=my_textarea("Deskripsi Barang (max:250)","special_features",'','col-sm-4','col-md-7')?>
	<?=my_dropdown("Category","category",'',$cat_list)?>
	<?=my_dropdown("Sub Category","sub_category",'',$cat_list)?>
	<?=my_input("Satuan","unit_of_measure")?>
	<?=my_input("Harga Jual","retail")?>
	<?=my_input("Harga Beli","cost")?>
	<?=my_input("Item Picture 1","item_picture")?>				
	<?=my_input_file("","item_picture_img")?>				
	<?=my_input("Item Picture 2","item_picture2")?>				
	<?=my_input_file("","item_picture2_img")?>				
	<?=my_input("Item Picture 3","item_picture3")?>				
	<?=my_input_file("","item_picture3_img")?>				
	<?=my_input("Item Picture 4","item_picture4")?>				
	<?=my_input_file("","item_picture4_img")?>				
</form>