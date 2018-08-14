<table id="dgItems" class="easyui-datagrid"
	style="width:auto;min-height:200px"
	data-options="
		iconCls: 'icon-edit',
		singleSelect: true,
		toolbar: '#tbItems',fitColumns: true, 
		url: '<?=base_url()?>index.php/leasing/app_master/items/<?=$app_id?>'
	">
	<thead>
		<tr>
			<th data-options="field:'obj_id'">Kode Barang</th>
			<th data-options="field:'description',width:200">Nama Barang</th>
			<th data-options="field:'qty',align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
			<th data-options="field:'unit',align:'left',editor:'text'">Satuan</th>
			<th data-options="field:'price',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Harga</th>

			<th data-options="field:'discount',editor:'numberbox'">Disc%</th>
			<th data-options="field:'amount',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Jumlah</th>
			<th data-options="field:'id',align:'right'">id</th>
		</tr>
	</thead>
</table>

<div id='tbItems'>
<?
if($show) {
	if($readonly==""){
		echo link_button('Add', 'dgItem_Add()','add');
		echo link_button('Edit', 'dgItem_Edit()','edit');
		echo link_button('Delete', 'dgItem_Delete()','remove');
	}
	echo link_button('Refresh', 'dgItem_Refresh()','reload');
}
?>
</div>
<script language="JavaScript">
	function dgItem_Add(){
		$("#frmAddItem_Id").val('');
		$('#dlgAddItem').dialog('open').dialog('setTitle','Tambah Barang');
	}
	function dgItem_Edit(){
		row = $('#dgItems').datagrid('getSelected');
		if (row){
			$("#frmAddItem_Id").val(row.id);		
			url=CI_ROOT+'leasing/app_master/items/view/'+row.id;
			$.ajax({type: "GET",url: url,
				success: function(result){		
					var result = eval('('+result+')');
					if (result.success){
						$("#item_no").val(result.obj_id);
						$("#desc").val(result.description);
						$("#qty").val(result.qty);
						$("#price").val(result.price);
						$("#frmAddItem_Id").val(result.id);
						$("#frmAddItem_AppId").val(result.app_id);
						$('#dlgAddItem').dialog('open').dialog('setTitle','Edit Items');					
					}
				},
				error: function(result){$.messager.alert('Info',result);}
			});         
			
		}
	}
	function dgItem_Delete(){
		row = $('#dgItems').datagrid('getSelected');
		if (row){
			xurl=CI_ROOT+'leasing/app_master/items/delete/'+row.id;                             
			console.log(xurl);
			xparam='';
			$.ajax({
				type: "GET",
				url: xurl,
				param: xparam,
				success: function(msg){
					$('#dgItems').datagrid('reload');
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});         
		}
	}
	function dgItem_Refresh(){
		xurl='<?=base_url()?>index.php/leasing/app_master/items/<?=$app_id?>';
		$('#dgItems').datagrid({url:xurl});
		$('#dgItems').datagrid('reload');
	}
</script>