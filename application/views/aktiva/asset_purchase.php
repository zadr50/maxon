<div class="thumbnail box-gradient">

	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/aktiva/aktiva_purchase/add');		
	echo link_button('Search','','search','false',base_url().'index.php/aktiva/aktiva_purchase');		
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


<form id="myform" role="form" method="post" 
	action="<?=base_url()?>index.php/aktiva/aktiva_purchase/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table">
		<tr><td>Nomor Bukti</td>
		<td>
			<input type="text" class="form-control" id="journal_id" name="journal_id" value="<?=$journal_id?>">
		</td>		
		</tr>
		<tr><td>Kode Aktiva</td>
		<td><input type="text" class="form-control-horizontal" id="asset_id" name="asset_id" 
		value="<?=$asset_id?>" placeholder="asset_id" style='width:200px'>
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
						onclick="lookup_asset();return false"></a>
		<span id='asset_name'><?=$asset_name?></span>
		</td>
		</tr>
		<tr><td>Tanggal Jual</td>
		<td>
			<input type="text" class="form-control easyui-datetimebox" id="trans_date"
			name="trans_date" 
			data-options="formatter:format_date,parser:parse_date"
			value="<?=$trans_date?>" placeholder="trans_date" style="width:150px">
		</td></tr>
		<tr><td>Jumlah</td>
		<td>
			<input type="text" class="form-control" id="trans_value" name="trans_value" value="<?=$trans_value?>">
		</td>
		</tr>
		<tr><td>Supplier</td>
		<td>
			<input type="text" class=" " id="vendor_id" 
			style='width:200px' name="vendor_id" value="<?=$vendor_id?>">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
						onclick="dlgsuppliers_show();return false"></a>	
			<span id='supplier_name'><?=$supplier_name?></span>
		</td></tr>
		<tr><td>Rekening</td>
		<td>
			<input type="text" class="" id="cash_bank_ap" 
			style='width:200px' name="cash_bank_ap" value="<?=$cash_bank_ap?>" >
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
						onclick="lookup_bank();return false"></a>			
			<span id='bank_name'><?=$bank_name?></span>
		</td></tr>
		
		<tr><td>Catatan</td>
		<td>
			<input type="text" class="form-control" id="notes" name="notes" value="<?=$notes?>">
		</td></tr>
		
		
	</table>

	</form>
</div>

<?=load_view('gl/select_coa')?>   	
<?=$lookup_suppliers?>   	
<?=load_view('purchase/supplier_select')?>   	
<?=load_view('bank/select_bank')?>   	
       
<script type="text/javascript">
    function save_this(){
        if($('#asset_id').val()===''){alert('Isi dulu kode aktiva !');return false;};
        $('#myform').submit();
    }
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/asset_purchase");
	}
	function selected_supplier(){
		var row = $('#dgSelectSupp').datagrid('getSelected');
		if (row){
			$('#vendor_id').val(row.supplier_number);
			$('#supplier_name').html(row.supplier_name);
			$('#dlgSelectSupp').dialog('close');
		} else {
			alert("Pilih salah satu nomor customer !");
		}
	}		
	function select_bank() {
		var row = $('#dgBank').datagrid('getSelected');
		if (row){
			$('#cash_bank_ap').val(row.bank_account_number);
			$('#bank_name').html(row.bank_name);
			$("#dlgBank").dialog("close");
		} else {
			alert("Pilih salah satu nomor !");
		}
	}

</script>
 