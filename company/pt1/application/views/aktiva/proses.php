<?php date_default_timezone_set("Asia/Jakarta"); ?>

<div id="lstPeriode" class="col-md5 thumbnail" >
	<strong>Pilih Periode: </strong>
	<input id='periode' name='periode' type='text' class="input-small" value='<?=date('Y-m')?>'>
	<?=link_button('Cari','lookup_periode();return false;','search')?> 
	<?=link_button('Reload','load_asset();return false;','reload')?> 
</div>
<div id="divAktiva" class="col-md-6 thumbnail">
		<table id="dgAktiva" class="easyui-datagrid"  
			style="width:800px;min-height:600px"
			data-options="iconCls: 'icon-edit',
				singleSelect: true,	toolbar: '',url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'id',width:80">Nomor Aktiva</th>
					<th data-options="field:'description',width:380">Nama Aktiva</th>
					<th data-options="field:'depr_amount',width:90,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Penyusutan</th>
					<th data-options="field:'book_amount',width:90,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Nilai Buku</th>
				</tr>
			</thead>
		</table>

</div>

<?=load_view("gl/select_periode");?>

<script  language="javascript">
	function load_asset() {
		var periode=$("#periode").val();
		
		$('#dgAktiva').datagrid({url:'<?=base_url()?>index.php/aktiva/aktiva_proses/load/'+periode});
		$('#dgAktiva').datagrid('reload');		
	}
	 
	
</script>

