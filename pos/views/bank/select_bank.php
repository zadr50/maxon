<!-- DIALOG KODE REKENING -->
<div id='dlgBank' class="easyui-dialog"  
style="width:600px;height:380px;padding:5px 5px"
closed="true" toolbar="#tbBank">
		<table id="dgBank" class="easyui-datagrid"  width='100%'
		data-options="toolbar: '', singleSelect: true, fitColumns: true, 
			url: '' ">
			<thead>
				<tr>
					<th data-options="field:'bank_account_number',width:80">Rekening</th>
					<th data-options="field:'bank_name',width:230">Bank Name</th>
				</tr>
			</thead>
		</table>
</div>
<div id="tbBank" class='box-gradient'>
	Enter Text: <input  id="search_bank" style='width:180' name="search_bank">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  
	onclick="lookup_bank();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" 
	onclick="select_bank();return false;">Select</a>
</div>
<script type="text/javascript">
	function lookup_bank() {
		$('#dlgBank').window({left:100,top:window.event.clientY+20});
		$('#dlgBank').dialog('open').dialog('setTitle','Cari rekening bank');
		kode=$('#search_bank').val();
		$('#dgBank').datagrid({url:'<?=base_url()?>index.php/banks/select/'+kode});
		$('#dgBank').datagrid('reload');
	}
	function select_bank() {
		var row = $('#dgBank').datagrid('getSelected');
		if (row){
			$('#bank_account_number').val(row.bank_account_number);
			$('#bank_name').html(row.bank_name);
			$("#dlgBank").dialog("close");
		}			
	}
</script>
<!-- END DIALOG KODE REKENING -->
