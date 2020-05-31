<table id="dgSalary" class="easyui-datagrid" width='100%'
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns: true, toolbar: '#tbSalary',
	url: '<?=base_url()?>index.php/payroll/salary/employee/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'pay_no', width:'80'">Pay No#</th>
			<th data-options="field:'pay_period', width:'80'">Period</th>
			<th data-options="field:'salary',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Salary</th>
			<th data-options="field:'total_pendapatan',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Pendapatan</th>
			<th data-options="field:'total_potongan',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Potongan</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbSalary">
	<?=link_button("Tambah","add_salary()","add")?>
	<?=link_button("Edit","edit_salary()","edit")?>
	<?=link_button("Refresh","load_salary()","reload")?>
</div>	


<script language="JavaScript">
	function add_salary() {
		nip=$('#nip').val();
		add_tab_parent("add_salary",CI_ROOT+"payroll/salary/add/"+nip);
	}
	function edit_salary()	{
		var row = $('#dgSalary').datagrid('getSelected');
		if (row){
			var pay_no=row.pay_no;
			add_tab_parent("edit_salary_"+pay_no,CI_ROOT+"payroll/salary/view/"+pay_no);
		}
	}
	function load_salary()	{
		nip=$('#nip').val();
		xurl=CI_ROOT+'payroll/salary/employee/'+nip;
		$('#dgSalary').datagrid({url:xurl});
	}
</script>