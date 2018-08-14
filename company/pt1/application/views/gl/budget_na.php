<?php 
echo "<strong>$coa_group - $jenis_akun </strong></br>";
?>
	<table id="dgItems" class="easyui-datagrid" width="100%"  		
		data-options="
			iconCls: 'icon-edit',fitColumns:true,
			singleSelect: true,
			toolbar: '#tb',
			url: '<?=base_url()?>index.php/budget/load_data_an/<?=$coa_group?>'
		">
		<thead>
			<tr>
				<th data-options="field:'keterangan',width:180">Nama Akun</th>
				<th data-options="field:'jan',width:60,align:'right'">Jan</th>
				<th data-options="field:'feb',width:60,align:'right'">Feb</th>
				<th data-options="field:'mar',width:60,align:'right'">Mar</th>
				<th data-options="field:'apr',width:60,align:'right'">Apr</th>
				<th data-options="field:'may',width:60,align:'right'">May</th>
				<th data-options="field:'jun',width:60,align:'right'">Jun</th>
				<th data-options="field:'jul',width:60,align:'right'">Jul</th>
				<th data-options="field:'aug',width:60,align:'right'">Aug</th>
				<th data-options="field:'sep',width:60,align:'right'">Sep</th>
				<th data-options="field:'oct',width:60,align:'right'">Oct</th>
				<th data-options="field:'nov',width:60,align:'right'">Nov</th>
				<th data-options="field:'dec',width:60,align:'right'">Dec</th>
				<th data-options="field:'total',width:60,align:'right'">Total</th>
				<th data-options="field:'f1',width:60,align:'right'">F1</th>
				<th data-options="field:'f2',width:60,align:'right'">F2</th>
				<th data-options="field:'f3',width:60,align:'right'">F3</th>
				<th data-options="field:'f4',width:60,align:'right'">F4</th>
				<th data-options="field:'f5',width:60,align:'right'">F5</th>
				<th data-options="field:'id',width:30,align:'right'">Line</th>
				<th data-options="field:'location',width:50">Lokasi</th>
			</tr>
		</thead>
	</table>
	<div id="tb" style="height:auto">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add"  onclick="addItem()">Add</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="editItem()">Edit</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove"  onclick="deleteItem()">Delete</a>	
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="viewItem()">View</a>	
	</div>
	
	<div id='dlgItem' class="easyui-dialog" style="width:600px;height:380px;left:100px;top:20px;padding:5px 5px"
		closed="true" buttons="#tbItem" >
		<form id="frmItem" method='post' >
		<table class='table' width="100%">
			<tr><td>Keterangan</td><td colspan=3>
				<input id="keterangan" name="keterangan" style="width:300px"></td></tr>
			<tr><td>Januari</td><td><input id="jan"  name="jan"></td>
				<td>Feburari</td><td><input id="feb"  name="feb"></td></tr>
			<tr><td>Maret</td><td><input id="mar"  name="mar"></td>
				<td>April</td><td><input id="apr"  name="apr"></td></tr>
			<tr><td>Mei</td><td><input id="may"  name="may"></td>
				<td>Juni</td><td><input id="jun"  name="jun"></td></tr>
			<tr><td>Juli</td><td><input id="jul"  name="jul"></td>
				<td>Agustus</td><td><input id="aug"  name="aug"></td></tr>
			<tr><td>September</td><td><input id="sep"  name="sep"></td>
				<td>Oktober</td><td><input id="oct"  name="oct"></td></tr>
			<tr><td>November</td><td><input id="nov"  name="nov"></td>
				<td>Desember</td><td><input id="dec"  name="dec"></td></tr>

			<tr><td>Total</td><td><input id="total"  name="total"></td>
				<td>&nbsp </td></tr>

			<tr><td>F1</td><td><input id="f1"  name="f1"></td>
				<td>F2</td><td><input id="f2"  name="f2"></td></tr>
			<tr><td>F3</td><td><input id="f3"  name="f3"></td>
				<td>F4</td><td><input id="f4"  name="f4"></td></tr>
			<tr><td>F5</td><td><input id="f5"  name="f5"></td>
				<td>Lokasi</td><td><input id="location" name="location"></td></tr>
		</table>
		<input type='hidden' id='id' name='id'>
		<input type='hidden' id='fiscal_year' name='fiscal_year'>
		<input type='hidden' id='parent_id' name='parent_id'>
		</form>
					
			
	</div>
	
		<div id="tbItem">
			<?=link_button('CLOSE','closeItem()','cancel');?>
			<?=link_button('SUBMIT','saveItem()','save');?>
		</div>
 
<script type="text/javascript">
	var url;
	function closeItem(){
		$('#dlgItem').dialog('close');		
	}
	function addItem(){
		$('#dlgItem').dialog('open').dialog('setTitle','Tambah Keterangan');
		$('#frmItem').form('clear');
		$('#fiscal_year').val("<?=$fiscal_year?>");
		$('#parent_id').val("<?=$coa_group?>");
	}
	function editItem(){
		var row = $('#dgItems').datagrid('getSelected');
		if (row){
			$('#dlgItem').dialog('open').dialog('setTitle','Edit Item');
			$('#frmItem').form('load',row);
			$('#fiscal_year').val("<?=$fiscal_year?>");
			$('#parent_id').val("<?=$coa_group?>");
		}
	}
	function saveItem(){
		url = '<?=base_url()?>index.php/budget/save_an';
		 
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#dlgItem').dialog('close');		// close the dialog
					$('#dgItems').datagrid('reload');	// reload the user data
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	function deleteItem(){
		var row = $('#dgItems').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/budget/delete_an/'+row.id;
					console.log(url);
					console.log(row.id);
					$.post(url,{id:row.id},function(result){
						if (result.success){
							$('#dgItems').datagrid('reload');	// reload the user data
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
	function viewItem(){
		var row = $('#dgItems').datagrid('getSelected');
		if (row){
			var url="<?=base_url()?>index.php/budget/load_data_1/<?=$fiscal_year?>/<?=$coa_type?>/"+row.id;
			add_tab_parent("Line: "+row.id,url);
		}
	}

	
</script>