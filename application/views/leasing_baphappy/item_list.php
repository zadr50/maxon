<div id='dlgFindItem'class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px" closed="true" 
	buttons="#tbFindItem">
	<table id="dgItemSearch" class="easyui-datagrid"  data-options="toolbar: '',
			singleSelect: true,	url: '' ">
		<thead>
			<tr>
				<th data-options="field:'description',width:150"  sortable="true">Nama Barang</th>
				<th data-options="field:'item_number',width:80"  sortable="true">Kode Barang</th>
				<th data-options="field:'retail',width:80">Harga</th>
				<th data-options="field:'unit_of_measure',width:80">Unit</th>
			</tr>
		</thead>
	</table>
</div>	   
<div id='tbFindItem'>
	<?="Search: ".form_input("item_search",'',"id='item_search'")?>
	<?=link_button('Filter', 'dlgFindItem_Filter()','search');?>
	<?=link_button('Select', 'dlgFindItem_Ok()','ok');?>
	<?=link_button('Close', 'dlgFindItem_Close()','no');?>
</div>
<script language="JavaScript">
	function dlgFindItem_Show(){
		$('#dlgFindItem').dialog('open').dialog('setTitle','Cari nama barang');
		xurl='<?=base_url()?>index.php/inventory/filter';
		$('#dgItemSearch').datagrid({url:xurl});
		$('#dgItemSearch').datagrid('reload');
	}
	function dlgFindItem_Close(){
		$('#dlgFindItem').dialog('close');	
	}
	function dlgFindItem_Ok(){
		var row = $('#dgItemSearch').datagrid('getSelected');
		if (row){
			$('#item_no').val(row.item_number);
			$('#desc').val(row.description);
			$('#qty').val(1);
			$('#price').val(row.retail);
			$('#dlgFindItem').dialog('close');	
		}
	}
	function dlgFindItem_Filter(){
		xurl='<?=base_url()?>index.php/inventory/filter/'+$('#item_search').val();
		$('#dgItemSearch').datagrid({url:xurl});
		$('#dgItemSearch').datagrid('reload');
			
	}
</script>