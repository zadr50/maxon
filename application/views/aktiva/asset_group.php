<div class="thumbnail box-gradient">

	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help()','help');			
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div onclick="show_syslog('asset_group','<?=$id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
		<?=link_button("Close", "remove_tab_parent();return false", "cancel")?>
	</div>
</div>
 

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

<div class="thumbnail"> 

<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/aktiva/aktiva_group/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class='table2'>
		<tr><td>Kode</td><td><input type="text" id="id" name="id" value="<?=$id?>" placeholder="id"></td></tr>
		<tr><td>Nama Kelompok Aktiva</td><td><input type="text"   style='width:400px'  id="name" name="name" value="<?=$name?>" placeholder="name">
		</td></tr>
		<tr><td>Metode Penyusutan</td><td>
			<input type="radio" name="depn_method" id="depn_method0" value="0" <?=$depn_method=='0'?'checked':'';?> style="width:20px">
							0 - Straight Line
			<input type="radio" name="depn_method" id="depn_method1" value="1" <?=$depn_method=='1'?'checked':'';?> style="width:20px">
							1 - Declining Balance
			<input type="radio" name="depn_method" id="depn_method2" value="2" <?=$depn_method=='2'?'checked':'';?> style="width:20px">
							2 - Sum of Year
		</td></tr>
		<tr><td>Disusutkan (n Bulan)</td><td><input type="text"  id="useful_lives" name="useful_lives" value="<?=$useful_lives?>" placeholder="useful_lives">
		</td></tr>
		<tr><td>Nilai Residu</td><td><input type="text" id="salvage_value" name="salvage_value" value="<?=$salvage_value?>" placeholder="salvage_value">
		</td></tr>
		<tr><td>Akun Akumulasi Penyusutan</td><td>
							<input type="text" style='width:400px'  id="accum_depn" name="accum_depn" value="<?=$accum_depn?>" placeholder="accum_depn">
							<?=link_button('','lookup_coa(\'accum_depn\')','search');?>
		</td></tr>
		<tr><td>Akun Biaya Penyusutan</td><td>
							<input type="text" style='width:400px' id="expenses_depn" name="expenses_depn" value="<?=$expenses_depn?>" placeholder="expenses_depn">
							<?=link_button('','lookup_coa(\'expenses_depn\')','search');?>
		</td></tr>
		<tr><td>Akun Laba Penjualan</td><td>
							<input type="text" style='width:400px'  id="profit_on_sale" name="profit_on_sale" value="<?=$profit_on_sale?>" placeholder="profit_on_sale">
							<?=link_button('','lookup_coa(\'profit_on_sale\')','search');?>
		</td></tr>
		<tr><td>Akun Rugi Penjualan</td><td>
							<input type="text" style='width:400px'  id="loss_on_sale" name="loss_on_sale" value="<?=$loss_on_sale?>" placeholder="loss_on_sale">
							<?=link_button('','lookup_coa(\'loss_on_sale\')','search');?>
		</td></tr>
		<tr><td>Akun Rekening Kas/Ban</td><td>
							<input type="text" style='width:400px'  id="cash_bank" name="cash_bank" value="<?=$cash_bank?>" placeholder="cash_bank">
							<?=link_button('','lookup_coa(\'cash_bank\')','search');?>
		</td></tr>
		<tr><td>Akun Pembelian</td><td>
							<input type="text"  style='width:400px'  id="at_cost" name="at_cost" 
							value="<?=$at_cost?>" placeholder="at_cost">
							<?=link_button('','lookup_coa(\'at_cost\')','search');?>
		</td></tr>
		</table>
	</form>
 
</div> 
 
<?=load_view('gl/select_coa_link')?>   	

<script type="text/javascript">
    function save_this(){
        if($('#id').val()===''){alert('Isi dulu kode group !');return false;};
        if($('#description').val()===''){alert('Isi dulu nama group !');return false;};
        $('#myform').submit();
    }
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/aset_group");
	}
</script>
	

 