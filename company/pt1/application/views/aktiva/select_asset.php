<!-- DIALOG KODE ASSET -->
<div id='dlgAsset' class="easyui-dialog"  
style="width:600px;height:380px;padding:5px 5px"
closed="true" toolbar="#tbAsset">
		<table id="dgAsset" class="easyui-datagrid"  width='100%'
		data-options="toolbar: '', singleSelect: true, fitColumns: true, 
			url: '' ">
			<thead>
				<tr>
					<th data-options="field:'description',width:280">Asset</th>
					<th data-options="field:'id',width:30">ID</th>
				</tr>
			</thead>
		</table>
</div>
<div id="tbAsset" class='box-gradient'>
	Enter Text: <input  id="search_asset" style='width:180' name="search_asset">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  
	onclick="lookup_asset();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="select_asset();return false;">Select</a>
</div>
<script type="text/javascript">
	function lookup_asset() {
		//$('#dlgAsset').window({left:100,top:window.event.clientY+20});
		$('#dlgAsset').dialog('open').dialog('setTitle','Cari kode aktiva');
		asset=$('#search_asset').val();
		$('#dgAsset').datagrid({url:'<?=base_url()?>index.php/aktiva/aktiva/select/'+asset});
		$('#dgAsset').datagrid('reload');
	}
	function select_asset() {
		var row = $('#dgAsset').datagrid('getSelected');
		if (row){
			$('#asset_id').val(row.id);
			$('#asset_name').html(row.description);
			$('#dlgAsset').dialog('close');
		}			
	}
</script>
<!-- END DIALOG KODE ASSET -->
