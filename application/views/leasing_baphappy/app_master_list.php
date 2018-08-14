<div id='dlgAppMaster'class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px" closed="true" 
	buttons="#tbFindAppMaster">
	<table  style='width:100%' id="dgFindAppMaster" class="easyui-datagrid "  data-options="toolbar: '',
			singleSelect: true,	url: '',height: 300 ">
		<thead>
			<tr>
				<th data-options="field:'app_id',width:100">Nomor SPK</th>
				<th data-options="field:'app_date',width:100">Tanggal</th>
				<th data-options="field:'cust_name',width:100">Nama Debitur</th>
				<th data-options="field:'status',width:50">Status</th>
				<th data-options="field:'area',width:50">Area</th>
				<th data-options="field:'counter_id',width:50">Counter</th>
				<th data-options="field:'counter_name',width:50">Nama Counter</th>
				<th data-options="field:'cust_id',width:50">Kode Debitur</th>
				<th data-options="field:'kec',width:80">Kecamatan</th>
				<th data-options="field:'kel',width:80">Kelurahan</th>
				<th data-options="field:'loan_amount',width:80">Jumlah</th>
				<th data-options="field:'inst_month',width:80">Tenor</th>
				<th data-options="field:'sales_name'">Sales Agen</th>
				<th data-options="field:'sales_id'">Sales Id</th>
			</tr>
		</thead>
	</table>
</div>	   
<div id='tbFindAppMaster'>
	<?="Search: ".form_input("dlgAppMaster_search",'',"id='dlgAppMaster_search'")?>
	<?=link_button('Filter', 'dlgAppMaster_Filter()','search');?>
	<?=link_button('Select', 'dlgAppMaster_Ok()','ok');?>
	<?=link_button('Close', 'dlgAppMaster_Close()','no');?>
</div>
<script language="JavaScript">
	function dlgAppMaster_Show(){
		$('#dlgAppMaster').dialog('open').dialog('setTitle','Cari nomor SPK');
		xurl='<?=base_url()?>index.php/leasing/app_master/filter';
		$('#dgFindAppMaster').datagrid({url:xurl});
		$('#dgFindAppMaster').datagrid('reload');
	}
	function dlgAppMaster_Close(){
		$('#dlgAppMaster').dialog('close');	
	}
	function dlgAppMaster_Filter(){
		xurl='<?=base_url()?>index.php/leasing/app_master/filter/'+$('#dlgAppMaster_search').val();
		$('#dgFindAppMaster').datagrid({url:xurl});
		$('#dgFindAppMaster').datagrid('reload');
	}

</script>