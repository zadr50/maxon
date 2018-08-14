<div id='dlgJob' class="easyui-dialog"  style="width:600px;height:380px;
padding:5px 5px;left:100px;top:20px"
closed="true"  toolbar="#tbJob"
>
		<table id="dgJobSel" class="easyui-datagrid"  
		data-options="toolbar: '', singleSelect: true,
			url: '<?=base_url()?>index.php/jobs/select'">
			<thead>
				<tr>
					<th data-options="field:'user_group_id',width:80">Kode Group</th>
					<th data-options="field:'user_group_name',width:250">Keterangan</th>
				</tr>
			</thead>
		</table>
</div>
<div id="tbJob" style="height:auto">
	Enter Text: <input  id="search_job" style='width:180' name="search_job">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
	onclick="search_job()"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="select_job()">Select</a>
</div>

<script type="text/javascript">
	var idd='';
	function lookup_job() {
		idd='txtJob';
		$('#dlgJob').dialog('open').dialog('setTitle','Cari kode job');
		job=$('#search_job').val();
		$('#dgJobSel').datagrid({url:'<?=base_url()?>index.php/jobs/select/'+job});
		$('#dgJobSel').datagrid('reload');
	}
	function select_job() {
		var row = $('#dgJobSel').datagrid('getSelected');
		if (row){
			$('#'+idd).val(row.user_group_id);
			$('#dlgJob').dialog('close');
		}			
	}
	function search_job(){
		job=$('#search_job').val();
		$('#dgJobSel').datagrid({url:'<?=base_url()?>index.php/jobs/select/'+job});
		$('#dgJobSel').datagrid('reload');		
	}
</script>
