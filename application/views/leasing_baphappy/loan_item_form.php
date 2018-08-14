
<div id='dlgAddItem' class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px" closed="true" 
	buttons="#tbAddItem">
	<legend>Input data barang diinginkan</legend>
	<form method='post' id='frmAddItem'>
	<?
		echo my_input("Kode Barang",'item_no','','col-sm-5','col-sm-5'); echo link_button("Cari","dlgFindItem_Show()","search");
		echo my_input("Nama Barang",'desc','','col-sm-5');
		echo my_input("Quantity",'qty','','col-sm-5','col-sm-5');
		echo my_input("Harga Jual",'price','','col-sm-5','col-sm-5');
	?>
	</form>
</div>	   
<div id='tbAddItem'>
	<?=link_button('Save', 'dlgAddItem_Save()','ok');?>
	<?=link_button('Close', 'dlgAddItem_Close()','no');?>
</div>
<div id='dlgFindItem'class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px" closed="true" 
	buttons="#tbFindItem">
	<table id="dgItemSearch" class="easyui-datagrid"  data-options="toolbar: '',
			singleSelect: true,	url: '' ">
		<thead>
			<tr>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
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
	function dgItem_Add(){
		$('#dlgAddItem').dialog('open').dialog('setTitle','Tambah Barang');
	}
	function dgItem_Edit(){
		alert('edit');
	}
	function dgItem_Delete(){
		alert("delete");
	}
	function dlgAddItem_Save(){
		alert("save");
		dlgAddItem_Close();
	}
	function dlgAddItem_Close(){
		$('#dlgAddItem').dialog('close');
		$('#item_no').val("");
		$('#desc').val("");
		$('#qty').val("1");
		$('#price').val("0");
	}
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