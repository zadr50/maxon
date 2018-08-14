<div><div class="thumbnail">
<legend>Master Data Mesin</legend>
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/machine/add');		
	echo link_button('Search','','search','true',base_url().'index.php/machine');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('machine')">Help</div>
		<div onclick="show_syslog('machinie','<?=$mac_id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/machine");
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


<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/machine/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<div class="form-group">
	<label for="mac_id" class="col-sm-3 control-label">Kode Mesin</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="mac_id" name="mac_id" value="<?=$mac_id?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="mac_name" class="col-sm-3 control-label">Nama Mesin</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="mac_name" name="mac_name" value="<?=$mac_name?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="mac_group" class="col-sm-3 control-label">Kelompok</label>
		<div class="col-sm-8">
			<?=form_dropdown('mac_group',$group_list,$mac_group,"class='form_control'")?>
		</div>
	</div>

	<div class="form-group">
	<label for="capacity" class="col-sm-3 control-label">Kapasitas</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="capacity" name="capacity" value="<?=$capacity?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="location" class="col-sm-3 control-label">Location</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="location" name="location" value="<?=$location?>" placeholder="location">
		</div>
	</div>


	</form>
</div>

<script type="text/javascript">
    function save_this(){
        if($('#mac_id').val()===''){alert('Isi dulu kode mesin !');return false;};
        $('#myform').submit();
    }
</script>  

 