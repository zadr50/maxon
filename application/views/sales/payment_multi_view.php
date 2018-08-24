<div class="thumbnail box-gradient">
	<?
	if($posted=="")$posted=0;
	if($closed=="")$closed=0;	
	echo link_button('Print', 'print_pay()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/payment/add');		
	echo link_button('Search','','search','false',base_url().'index.php/payment');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/payment/view/'.$voucher);		
	
	echo link_button('Delete','','cut','false',base_url().'index.php/payment/delete_no_bukti/'.$voucher);		

	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/payment/unposting/'.$voucher);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/payment/posting/'.$voucher);		
	}
    echo link_button('Kas Masuk',"view_kas('$voucher')",'search','false');       
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'payment\')','help');		
	
	?>
	
		<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('payment')">Help</div>
		<div onclick="show_syslog('payment','<?=$voucher?>')">Log Aktifitas</div>
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
	<table class='table2' width='100%'>
		<tr>
			<td>Nomor Bukti: </td><td><h4><?=$voucher?></h4></td>
			<td>Tanggal Bayar: </td><td><?=$date_paid?></td>
		</tr>
		<tr>
			<td>Pelanggan: </td><td colspan=3><div class='thumbnail'><?=$cust_info?></div></td>
		</tr>
		<tr>
			<td>Rekening: </td><td><?=$account_number?></td>
		</tr>
		<tr>
			<td>Jenis Bayar: </td><td><?=$trans_type?></td>
			<td>Jumlah Bayar: </td><td><h4></h4><?=number_format($amount_paid);?></td>
		</tr>
		<tr>
			<td>Nomor Giro : <?=$credit_card_number?></td>
			<td>Tanggal Giro : <?=$expiration_date?></td>
			<td>Giro Bank : <?=$from_bank?></td>
		</tr>
	</table>
	
	<div class="easyui-tabs">
		<div title="Nomor Faktur" style="padding:10px">
		<table id="dgItems" class="easyui-datagrid" width='100%'
			data-options="
				toolbar: '#tbItems',singleSelect: true, fitColumns: true,
				url: '<?=base_url()?>index.php/payment/load_nomor/<?=$voucher?>'
			"  >
			<thead>
				<tr>
					<th data-options="field:'invoice_number'">Nomor Faktur</th>
					<th data-options="field:'invoice_date'">Tanggal Faktur</th>
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
			<table id="dgCrdb" class="easyui-datagrid"  width='100%'
				data-options="
					iconCls: 'icon-edit', fitColumns: true,
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
<script language="JavaScript">
    function view_kas(voucher){
       var url="<?=base_url().'index.php/cash_in/view'?>/"+voucher;
       add_tab_parent('View_'+voucher,url);
    }
</script>
