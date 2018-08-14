<div><div class="thumbnail">
<legend>Bill Of Material (BOM)</legend>

	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/bom/add');		
	echo link_button('Search','','search','true',base_url().'index.php/bom');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('bom')">Help</div>
		<div onclick="show_syslog('bom','<?=$item_number?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/bom");
		}
	</script>
	
</div></H1>
<div class="thumbnail">	

<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<h4>Terjadi Kesalahan!</h4> 
	<?php echo validation_errors(); ?>
	</div>
<?php } ?>
 <?php if($message!="") { ?>
<div class="alert alert-success"><? echo $message;?></div>
<? } ?>


<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/bom/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<div class="form-group">
	<label for="item_number" class="col-sm-3 control-label">Kode Barang Jadi</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="item_number" name="item_number" value="<?=$item_number?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="description" class="col-sm-3 control-label">Nama Barang Jadi</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="description" name="description" value="<?=$description?>" placeholder="description">
		</div>
	</div>

	<div class="form-group">
	<label for="category" class="col-sm-3 control-label">Kelompok</label>
		<div class="col-sm-8">
			<?=form_dropdown('category',$category_list,$category,"class='form_control'")?>
		</div>
	</div>

	<div class="form-group">
	<label for="location_id" class="col-sm-3 control-label">Lokasi</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="location_id" name="location_id" value="<?=$location_id?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="unit_of_measure" class="col-sm-3 control-label">Satuan</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" value="<?=$unit_of_measure?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="active" class="col-sm-3 control-label">Status Aktif</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="active" name="active" value="<?=$active?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="special_features" class="col-sm-3 control-label">Keterangan</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="special_features" name="special_features" value="<?=$special_features?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="cost" class="col-sm-3 control-label">Standard Cost</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="cost" name="cost" value="<?=$cost?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="reorder_quantity" class="col-sm-3 control-label">Minimum Qty</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="reorder_quantity" name="reorder_quantity" value="<?=$reorder_quantity?>" placeholder="">
		</div>
	</div>

<!-- BAHAN BAKU -->
<!-- BAHAN SETENGAH JADI -->
<!-- BIAYA DAN UPAH -->

	</form>
</div>

<script type="text/javascript">
    function save_this(){
        if($('#id').val()===''){alert('Isi dulu kode aktiva !');return false;};
        if($('#description').val()===''){alert('Isi dulu nama aktiva !');return false;};
        $('#myform').submit();
    }
</script>  

 