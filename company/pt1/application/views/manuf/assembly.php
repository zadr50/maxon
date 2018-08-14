<div><div class="thumbnail">
<legend>PROSES ASSEMBLY</legend>

	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/assembly/add');		
	echo link_button('Search','','search','true',base_url().'index.php/assembly');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('assembly')">Help</div>
		<div onclick="show_syslog('assembly','<?=$shipment_id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/assembly");
		}
	</script>
	
</div> 
<div class="thumbnail">	

<?php if (validation_errors()) { ?>
	<div class="">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<h4>Terjadi Kesalahan!</h4> 
	<?php echo validation_errors(); ?>
	</div>
<?php } ?>
 <?php if($message!="") { ?>
<div class="alert alert-success"><? echo $message;?></div>
<? } ?>


<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/assembly/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<div class="form-group">
	<label for="shipment_id" class="col-sm-3 control-label">Kode Assembly</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="shipment_id" name="shipment_id" value="<?=$shipment_id?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="date_received" class="col-sm-3 control-label">Tanggal</label>
		<div class="col-sm-8">
			<input type="text" class="form-control easyui-datetimebox" id="date_received"
			style="width:150px" name="date_received" value="<?=$date_received?>" 
			data-options="formatter:format_date,parser:parse_date"
			placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="warehouse_code" class="col-sm-3 control-label">Gudang</label>
		<div class="col-sm-8">
			<?=form_dropdown('warehouse_code',$warehouse_list,$warehouse_code,"class='form_control'")?>
		</div>
	</div>

	<div class="form-group">
	<label for="item_number" class="col-sm-3 control-label">Barang Jadi</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="item_number" name="item_number" value="<?=$item_number?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="quantity_received" class="col-sm-3 control-label">Qty di produksi</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="quantity_received" name="quantity_received" value="<?=$quantity_received?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="comments" class="col-sm-3 control-label">Keterangan</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="comments" name="comments" value="<?=$comments?>" placeholder="">
		</div>
	</div>

<!-- ITEM DETIAL MATERIAL -->

	</form>
</div>

<script type="text/javascript">
    function save_this(){
        if($('#shipment_id').val()===''){alert('Isi dulu kode !');return false;};
        $('#myform').submit();
    }
</script>  

 