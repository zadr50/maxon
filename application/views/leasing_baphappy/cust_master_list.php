<div id='dlgFindCust'class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px" closed="true" 
	buttons="#tbFindCust">
	<table id="dgFindCust" class="easyui-datagrid"  data-options="toolbar: '',
			singleSelect: true,	url: '' ">
		<thead>
			<tr>
				<th data-options="field:'cust_name',width:150">Nama Debitur</th>
				<th data-options="field:'cust_id',width:80">Kode Debitur</th>
				<th data-options="field:'city',width:80">Kota</th>
				<th data-options="field:'kel',width:80">Kelurahan</th>
			</tr>
		</thead>
	</table>
</div>	   
<div id='tbFindCust'>
	<?="Search: ".form_input("cust_search",'',"id='cust_search'")?>
	<?=link_button('Filter', 'dlgFindCust_Filter()','search');?>
	<?=link_button('Select', 'dlgFindCust_Ok()','ok');?>
	<?=link_button('Close', 'dlgFindCust_Close()','no');?>
</div>
<script language="JavaScript">
	function dlgFindCust_Show(){
		$('#dlgFindCust').dialog('open').dialog('setTitle','Cari nama debitur');
		xurl='<?=base_url()?>index.php/leasing/cust_master/filter';
		$('#dgFindCust').datagrid({url:xurl});
		$('#dgFindCust').datagrid('reload');
	}
	function dlgFindCust_Close(){
		$('#dlgFindCust').dialog('close');	
	}
	function dlgFindCust_Ok(){
		var row = $('#dgFindCust').datagrid('getSelected');
		if (row){
			$('#cust_id').val(row.cust_id);
			$('#cust_name').val(row.cust_name);
			$('#dlgFindCust').dialog('close');
		}
	}
	function dlgFindCust_Filter(){
		xurl='<?=base_url()?>index.php/leasing/cust_master/filter/'+$('#cust_search').val();
		$('#dgFindCust').datagrid({url:xurl});
		$('#dgFindCust').datagrid('reload');
			
	}


</script>