<div id="tb_employee" style="height:auto">
	Enter Text: <input  id="search_emp" style='width:180' name="search_emp">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
	onclick="lookup_employee();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="false" onclick="select_employee();return false;">Select</a>
</div>

<div id='dlg_employee'class="easyui-dialog" style="width:600px;height:680px;padding:10px 20px;left:100px;top:20px"
        closed="true" toolbar="#tb_employee">
     <div id='div_employee_result'> 
		<table id="dg_employee" class="easyui-datagrid"  
			data-options="
				toolbar: '',
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'nama',width:250">Nama Pegawai</th>
					<th data-options="field:'nip',width:80">NIP</th>
					<th data-options="field:'dept',width:80">Dept</th>
					<th data-options="field:'divisi',width:80">Divisi</th>
					<th data-options="field:'emptype',width:80">Group</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>	   

<script language="JavaScript">
	function select_employee()	{
			var row = $('#dg_employee').datagrid('getSelected');
			if (row){
				$('#nip').val(row.nip);
				$('#nama').val(row.nama);
				$('#nip_id').val(row.nip_id);
				$('#employee_id').val(row.nip);
				$('#dept').val(row.dept);
				$('#divisi').val(row.divisi);
				$('#emptype').val(row.emptype);
				$("#emp_level").val(row.emptype);
				$('#dlg_employee').dialog('close');
			}
	}
	function lookup_employee()	{
		$('#dlg_employee').dialog('open').dialog('setTitle','Cari nama pegawai');
		nama=$('#search_emp').val();
		xurl='<?=base_url()?>index.php/payroll/employee/find2/'+nama;
		$('#dg_employee').datagrid({url:xurl});
		$('#dg_employee').datagrid('reload');
	}
</script>