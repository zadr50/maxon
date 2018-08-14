<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/aktiva/aktiva/add');		
	echo link_button('Search','','search','false',base_url().'index.php/aktiva/aktiva');		
	echo "<div style='float:right'>";
		echo link_button('Help', 'load_help()','help');		
	
	?>
		<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help()">Help</div>
			<div onclick="show_syslog('asset','<?=$id?>')">Log Aktifitas</div>

			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
	</div>
</div>

<div class="col-md-5">	

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


<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/aktiva/aktiva/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table">
		<tr><td>Kode Aktiva</td>
		<td><input type="text" class="form-control" id="id" name="id" value="<?=$id?>" placeholder="id"></td>
		<td>Kelompok</td>
		<td>
			<?=form_dropdown('group_id',$group_list,$group_id,"style='width:300px;height:30px'")?>
		</td>	
		
		</tr>
		<tr><td>Nama Aktiva Tetap</td>
		<td colspan=3>
			<input type="text" class="form-control" id="description" name="description" value="<?=$description?>" placeholder="description">
		</td></tr>
		<tr>
		<tr><td>Tanggal Beli</td>
		<td>
			<input type="text" class="form-control easyui-datetimebox" id="acquisition_date"
			name="acquisition_date" 
			data-options="formatter:format_date,parser:parse_date"
			value="<?=$acquisition_date?>" placeholder="acquisition_date" style="width:150px">
		</td>
		<td>Disusutkan (n Bulan)</td>
		<td>
			<input type="text" class="form-control" id="useful_lives" name="useful_lives" value="<?=$useful_lives?>" placeholder="useful_lives">
		</td>
		</tr>


		<tr><td>Metode Penyusutan</td>
		<td colspan=4>
							<input type="radio" name="depn_method" id="depn_method0" value="0" <?=$depn_method=='0'?'checked':'';?>>
							0 - Straight Line (Garis Lurus)
							
							<input type="radio" name="depn_method" id="depn_method1" value="1" <?=$depn_method=='1'?'checked':'';?>>
							1 - Declining Balance

							<input type="radio" name="depn_method" id="depn_method2" value="2" <?=$depn_method=='2'?'checked':'';?>>
							2 - Sum of Year
		</td>					
		</tr>
		 
		<tr><td>Nilai Residu Aktiva</td>
		<td>
			<input type="text" class="form-control" id="salvage_value" name="salvage_value" value="<?=$salvage_value?>" placeholder="salvage_value">
		</td>
		<td>Nilai Perolehan</td>
		<td>
			<input type="text" class="form-control" id="acquisition_cost" name="acquisition_cost" value="<?=$acquisition_cost?>" placeholder="acquisition_cost">
		</td>
		
		</tr>
		
		<tr><td>Tanggal Garansi Akhir</td>
		<td>
			<input type="input" class="form-control easyui-datetimebox" id="warranty_date"
			data-options="formatter:format_date,parser:parse_date"
			style="width:150px" name="warranty_date" value="<?=$warranty_date?>" placeholder="warranty_date">
		</td>
		<td>Lokasi</td>
		<td>
			<input type="text" class="form-control" id="location_id" name="location_id" value="<?=$location_id?>" placeholder="location_id">
		</td></tr>
		
		<tr><td>Cost Center</td>
		<td>
			<input type="text" class="form-control" id="cost_centre_id" name="cost_centre_id" value="<?=$cost_centre_id?>" placeholder="cost_centre_id">
		</td><td>Lembaga</td>
		<td>
			<input type="text" class="form-control" id="custodian_id" name="custodian_id" value="<?=$custodian_id?>" placeholder="custodian_id">
		</td></tr>
		
		<tr><td>Vendor</td>
		<td>
			<input type="text" class="form-control" id="vendor_id" name="vendor_id" value="<?=$vendor_id?>" placeholder="vendor_id">
		</td><td>Serial Number</td>
		<td>
			<input type="text" class="form-control" id="sn" name="sn" value="<?=$sn?>" placeholder="sn">
		</td></tr>
		
	</table>

	</form>
</div>

<script type="text/javascript">
    function save_this(){
        if($('#id').val()===''){alert('Isi dulu kode aktiva !');return false;};
        if($('#description').val()===''){alert('Isi dulu nama aktiva !');return false;};
        $('#myform').submit();
    }
	
</script>  

	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/aset");
		}
	</script>
 