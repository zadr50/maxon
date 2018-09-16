<?php  
$cat_list=array_data_table("inventory_categories","kode","category"); 
if(!isset($readonly))$readonly='';
$form_class="form";
if(!isset($controller))$controller=base_url().'index.php/eshop_admin/items';
?>
<form  enctype="multipart/form-data" class="<?=$form_class?>" id='frmBarang' 
	method='post' action='<?=base_url()?>index.php/eshop_admin/items/save' >
	<input type='hidden' name='mode' id='mode' value='<?=$mode?>'>
 
	<div role="tabpanel">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#tab1" aria-controls="home" role="tab" 
					data-toggle="tab">
					General
				</a>
			</li>
			<li role="presentation">
				<a href="#tab2" aria-controls="profile" role="tab" 
					data-toggle="tab">
					Harga dan Fitur
				</a>
			</li>
			<li role="presentation">
				<a href="#tab3" aria-controls="profile" role="tab" 
					data-toggle="tab">
					Images
				</a>
			</li>
		</ul>

		<div class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="tab1">
				<?=my_input("Kode Barang","item_number",$item_number,'','',$readonly)?>
				<?=my_input("Nama Barang","description",$description,'','')?>
				<? 
					$fld['caption']="Deskripsi Barang atau Keterangan (max:250)";
					$fld['field_name']="special_features";
					$fld['value']=$special_features;
					$fld['text_class_field']='ckeditor';
					echo my_textarea($fld)
				?>
				<?=my_input("Merk","manufacturer",$manufacturer,'','',$readonly)?>
				<?=my_dropdown("Category","category",$category,$cat_list,'','')?>
				<?=my_dropdown("Sub Category","sub_category",$sub_category,$cat_list,'','')?>
		  </div>
		  <div role="tabpanel" class="tab-pane fade  " id="tab2">
				<?=my_input("Satuan","unit_of_measure",$category,'','')?>
				<?=my_input("Harga Jual","retail",$retail,'','')?>
				<?=my_input("Harga Beli","cost",$cost,'','')?>
				<?=my_input("Berat Kg","weight",$weight,'','')?>
				<?=my_input("Kondisi","condition",$cost,'','')?>
				<?=my_input("Asuransi","insr_name",$insr_name,'','')?>
				<?=my_input("Sales Minimum","sales_min",$sales_min,'','')?>
				<?=my_input("Jasa Pengiriman ","delivery_by",$delivery_by,'','')?>
		  </div>
		  <div role="tabpanel" class="tab-pane fade  " id="tab3">
				<?=my_input("Item Picture 1","item_picture",$item_picture,'','')?>				
				<?php echo "<img src=".base_url()."tmp/$item_picture>"; ?>
				<?=my_input_file("","item_picture_img",'','','')?>				
				<?=my_input("Item Picture 2","item_picture2",$item_picture2,'','')?>				
				<?php echo "<img src=".base_url()."tmp/$item_picture2>"; ?>
				<?=my_input_file("","item_picture2_img",'','','')?>				
				<?=my_input("Item Picture 3","item_picture3",$item_picture3,'','')?>				
				<?php echo "<img src=".base_url()."tmp/$item_picture3>"; ?>
				<?=my_input_file("","item_picture3_img",'','','')?>				
				<?=my_input("Item Picture 4","item_picture4",$item_picture4,'','')?>				
				<?php echo "<img src=".base_url()."tmp/$item_picture4>"; ?>
				<?=my_input_file("","item_picture4_img",'','','')?>				
		  </div>
		</div>
	</div>
	<div  class='row'>
		<div class='col-md-10'>
			<input type="submit" class="btn btn-primary" value='Save changes'>
		</div>
	</div>
	
</form>
 		<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
