<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
	<div title="Pendapatan" id="tabPendapatan" style="padding:10px">
		<table id="dgPendapatan" class="easyui-datagrid"   width='100%'
				style="min-height:300px"
				data-options="iconCls: 'icon-edit', singleSelect: true,
					toolbar: '#tbPendapatan',fitColumns:true,
					url: '<?=base_url()?>index.php/payroll/group/income/<?=$kode_group?>'
				">
				<thead>
					<tr>
						<th data-options="field:'no_urut'">No Urut</th>
						<th data-options="field:'salary_com_code'">Kode</th>
						<th data-options="field:'salary_com_name'">Nama Komponen</th>
						<th data-options="field:'formula_string'">Rumus</th>
						<th data-options="field:'id',align:'right'">Line</th>
					</tr>
				</thead>
		</table>
	</div>
	<div title="Potongan" id="tabPotongan" style="padding:10px">
		<table id="dgPotongan" class="easyui-datagrid"   width='100%'
				style="min-height:300px;"
				data-options="iconCls: 'icon-edit', singleSelect: true,
					toolbar: '#tbPotongan',fitColumns:true,
					url: '<?=base_url()?>index.php/payroll/group/deduct/<?=$kode_group?>'
				">
				<thead>
					<tr>
						<th data-options="field:'no_urut'">No Urut</th>
						<th data-options="field:'salary_com_code'">Kode</th>
						<th data-options="field:'salary_com_name'">Nama Komponen</th>
						<th data-options="field:'formula_string'">Rumus</th>
						<th data-options="field:'id',align:'right'">Line</th>
					</tr>
				</thead>
		</table>
	</div>
</div>	
<div id="tbPendapatan">
	<div class="box-gradient">
		<?=link_button('Add Item','dlgFrmIncome_Show()','add')?>
		<?=link_button('Edit','dlgFrmIncome_Edit()','edit')?>
		<?=link_button('Remove','dlgFrmIncome_Delete()','remove')?>
	</div>
</div>
<div id="tbPotongan">
	<div class="box-gradient">
		<?=link_button('Add Item','dlgFrmDeduct_Show()','add')?>
		<?=link_button('Edit','dlgFrmDeduct_Edit()','edit')?>
		<?=link_button('Remove','dlgFrmDeduct_Delete()','remove')?>
	</div>
</div>


<div id='dlgFrmIncome' class="easyui-dialog" style="width:500px;height:300px;;left:100px;top:20px"
    closed="true" buttons="#dlgFrmIncomeButtons">
    <form id="frmIncome" method='post' >
			<table class='table'>
				<tr><td>Komponen</td>
					<td><?=form_dropdown('salary_com_code',$jenis_tunjangan,
						$salary_com_code,"id='salary_com_code' style='width:300px'")?></td>
				</tr>
				<tr><td>Rumus</td>
					<td><?=form_input('formula_string',$formula_string,"style='width:350px' id='formula_string'")?></td>
				</tr>
				<tr><td>No Urut</td>
					<td><?=form_input('no_urut',$no_urut,"style='width:50px'  id='no_urut'")?></td>
				</tr>
				<tr>
					<td><?=form_hidden('level_code',$kode_group,"style='width:50px'  ")?></td>
					<td><?=form_input('id',""," id='id' style='width:50px;display:none'  ")?></td>
				</tr>
			</table>		
    </form>
</div>
<div id='dlgFrmIncomeButtons'>
	<?=link_button('Save','dlgFrmIncome_Save()','save')?>
</div>


<div id='dlgFrmDeduct' class="easyui-dialog" style="width:500px;height:300px;;left:100px;top:20px"
    closed="true" buttons="#dlgFrmDeductButtons">
    <form id="frmDeduct" method='post' >
			<table class='table'>
				<tr><td>Komponen</td>
				<td><?=form_dropdown('salary_com_code2',$jenis_potongan,
						$salary_com_code2,"id='salary_com_code2'")?></td>
				</tr>
				<tr><td>Rumus</td>
					<td><?=form_input('formula_string2',$formula_string2,"style='width:350px' id='formula_string2'")?></td>
				</tr>
				<tr><td>No Urut</td>
					<td><?=form_input('no_urut2',$no_urut2,"style='width:50px'  id='no_urut2'")?></td>
				</tr>
				<tr>
					<td><?=form_hidden('level_code2',$kode_group,"style='width:50px'  ")?></td>
					<td><?=form_input('id2',""," id='id2' style='width:50px;display:none'  ")?></td>
				</tr>
			</table>		
    </form>
</div>
<div id='dlgFrmDeductButtons'>
	<?=link_button('Save','dlgFrmDeduct_Save()','save')?>
</div>

<script language="JavaScript">
	function dlgFrmIncome_Show(){
		$("#formula_string").val("");
		$("#no_urut").val("");		
		$('#dlgFrmIncome').dialog('open').dialog('setTitle','Pilihan komponen');
	}
	
	function dlgFrmIncome_Save(){
		url='<?=base_url()?>index.php/payroll/group/save_component/<?=$kode_group?>';
	 
			$('#frmIncome').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#id").val('');
						$("#dlgFrmIncome").dialog("close");
						$('#dgPendapatan').datagrid({url:'<?=base_url()?>index.php/payroll/group/income/<?=$kode_group?>'});
						//$('#dgPendapatan').datagrid('reload');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
 	}
 	function dlgFrmIncome_Delete(){
		var row = $('#dgPendapatan').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/payroll/group/delete_component/'+row.id;
					$.post(url,{line_number:row.id},function(result){
						if (result.success){
							$('#dgPendapatan').datagrid({url:'<?=base_url()?>index.php/payroll/group/income/<?=$kode_group?>'});
							//$('#dgPendapatan').datagrid('reload');
						} else {
							$.messager.show({	// show error message
								title: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
 	function dlgFrmIncome_Edit(){
		var row = $('#dgPendapatan').datagrid('getSelected');
		if (row){
			$("#salary_com_code").val(row.salary_com_code);
			$("#formula_string").val(row.formula_string);
			$("#no_urut").val(row.no_urut);
			$("#id").val(row.id);
			$('#dlgFrmIncome').dialog('open').dialog('setTitle','Pilihan komponen');
		}
 	}
	
</script>

<script language="JavaScript">
	function dlgFrmDeduct_Show(){
		$('#dlgFrmDeduct').dialog('open').dialog('setTitle','Pilihan komponen');
	}
	
	function dlgFrmDeduct_Save(){
		url='<?=base_url()?>index.php/payroll/group/save_component/<?=$kode_group?>';
	 
			$('#frmDeduct').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#id2").val('');
						$("#dlgFrmDeduct").dialog("close");
						$('#dgPotongan').datagrid({url:'<?=base_url()?>index.php/payroll/group/deduct/<?=$kode_group?>'});
						//$('#dgPotongan').datagrid('reload');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
 	}
 	function dlgFrmDeduct_Delete(){
		var row = $('#dgPotongan').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/payroll/group/delete_component/'+row.id;
					$.post(url,{line_number:row.id},function(result){
						if (result.success){
							$('#dgPotongan').datagrid({url:'<?=base_url()?>index.php/payroll/group/deduct/<?=$kode_group?>'});
							//$('#dgPotongan').datagrid('reload');
						} else {
							$.messager.show({	// show error message
								title: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
 	function dlgFrmDeduct_Edit(){
		var row = $('#dgPotongan').datagrid('getSelected');
		if (row){
			$("#salary_com_code2").val(row.salary_com_code);
			$("#formula_string2").val(row.formula_string);
			$("#no_urut2").val(row.no_urut);
			$("#id2").val(row.id);
			$('#dlgFrmDeduct').dialog('open').dialog('setTitle','Pilihan komponen');
		}
 	}
	
</script>