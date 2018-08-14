<div class="thumbnail box-gradient">
	<?
	if($posted=="")$posted=0;
	if($closed=="")$closed=0;	
	echo link_button('Print', 'print_pay()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/payables_payments/add');		
	echo link_button('Search','','search','false',base_url().'index.php/payables_payments');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/payables_payments/view/'.$voucher);		
	
	echo link_button('Delete','','cut','false',base_url().'index.php/payables_payments/delete_no_bukti/'.$voucher);		

	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/payables_payments/unposting/'.$voucher);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/payables_payments/posting/'.$voucher);		
	}
    echo link_button('Close','remove_tab_parent()','cancel');      
	?>
	<div style='float:right'>
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('payables_payments')">Help</div>
		<div onclick="show_syslog('payables_payments','<?=$voucher?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
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

<form id="myform" method="POST" action="<?=base_url()?>index.php/payment/save">
<table class='table2' width="100%">
	<tr>
		<td>Nomor Bukti: </td><td><?=$voucher?></td>
		<td rowspan='6'><div class='thumbnail' style='width:300px;height:100px'><?=$supplier_info?></div></td>
		
	</tr>
	<tr>
		<td>Supplier: </td><td><?=$supplier_number?></td>
	</tr>
	<tr>
		<td>Tanggal Bayar: </td><td><?=$date_paid?></td>
	</tr>
	<tr>
		<td>Rekening: </td><td><?=$account_number?></td>
	</tr>
	<tr>
		<td>Jenis Bayar: </td><td><?=$trans_type?></td>
	</tr>
	<tr>
		<td>Jumlah Bayar: </td><td><?=$amount_paid;?></td>
	</tr>
	<tr>
		<td>Nomor Giro </td><td><?=$credit_card_number?></td>
	</tr>
	<tr>
		<td>Tanggal Giro </td><td><?=$expiration_date?></td>
	</tr>
	<tr>
		<td>Giro Bank </td><td><?=$from_bank?></td>
	</tr>
	 
</table>

<div class="easyui-tabs" >
	<div title="Nomor Faktur" style="padding:10px">
		<table id="dgItems" class="easyui-datagrid" width="100%" 
			data-options="
				toolbar: '#tbItems',singleSelect: true, fitColumns:true,
				url: '<?=base_url()?>index.php/payables_payments/load_nomor/<?=$voucher?>'
			"  >
			<thead>
				<tr>
					<th data-options="field:'purchase_order_number'">Nomor Faktur</th>
					<th data-options="field:'po_date'">Tanggal Faktur</th>
					<th data-options="field:'date_paid'">Tanggal Bayar</th>
					<th data-options="field:'amount', align:'right',editor:'numberbox',
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');
					}">Jumlah Faktur</th>
					<th data-options="field:'amount_paid', align:'right',editor:'numberbox',
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');
					}">Jumlah Bayar</th>
				</tr>
			</thead>
		</table>
	</div>
<!-- JURNAL -->
	<DIV title="Jurnal" style="padding:10px">
		<div id='divJurnal' class='thumbnail'>
		<table id="dgCrdb" class="easyui-datagrid"  width="100%"
			data-options="
				iconCls: 'icon-edit',fitColumns: true,
				singleSelect: true,toolbar:'#tbCrdb',
				url: '<?=base_url()?>index.php/jurnal/items/<?=$voucher?>'
			">
			<thead>
				<tr>
					<th data-options="field:'account',width:80">Akun</th>
					<th data-options="field:'account_description',width:150">Nama Akun</th>
					<th data-options="field:'debit',width:80,align:'right'">Debit</th>
					<th data-options="field:'credit',width:80,align:'right'">Credit</th>
					<th data-options="field:'custsuppbank',width:50">Ref</th>
					<th data-options="field:'operation',width:50">Operasi</th>
					<th data-options="field:'source',width:50">Keterangan</th>
					<th data-options="field:'transaction_id',width:50">Id</th>
				</tr>
			</thead>
		</table>
		</div>
			
	</DIV>

	
</div>	
</form>

</div>
<script language='javascript'>

</script>
 	