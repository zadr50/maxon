<div id='dlgFindCounter'class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px" closed="true" 
	buttons="#tbFindCounter">
	<table id="dgFindCounter" class="easyui-datagrid"  data-options="toolbar: '',
			singleSelect: true,	url: '' ">
		<thead>
			<tr>
				<th data-options="field:'counter_name',width:150">Nama Counter</th>
				<th data-options="field:'counter_id',width:80">Kode Counter</th>
				<th data-options="field:'area',width:80">Area</th>
				<th data-options="field:'area_name',width:80">Area Name</th>
			</tr>
		</thead>
	</table>
</div>	   
<div id='tbFindCounter'>
	<?="Search: ".form_input("counter_search",'',"id='counter_search'")?>
	<?=link_button('Filter', 'dlgFindCounter_Filter()','search');?>
	<?=link_button('Select', 'dlgFindCounter_Ok()','ok');?>
	<?=link_button('Close', 'dlgFindCounter_Close()','no');?>
</div>
<script language="JavaScript">
	function dlgFindCounter_Show(){
		$('#dlgFindCounter').dialog('open').dialog('setTitle','Cari nama counter');
		xurl='<?=base_url()?>index.php/leasing/counter/filter';
		$('#dgFindCounter').datagrid({url:xurl});
		$('#dgFindCounter').datagrid('reload');
	}
	function dlgFindCounter_Close(){
		$('#dlgFindCounter').dialog('close');	
	}
	function dlgFindCounter_Ok(){
		var row = $('#dgFindCounter').datagrid('getSelected');
		if (row){
			$('#counter_id').val(row.counter_id);
			$('#counter_name').val(row.counter_name);
			$('#dlgFindCounter').dialog('close');	
		}
	}
	function dlgFindCounter_Filter(){
		xurl='<?=base_url()?>index.php/leasing/counter/filter/'+$('#counter_search').val();
		$('#dgFindCounter').datagrid({url:xurl});
		$('#dgFindCounter').datagrid('reload');
			
	}
</script>