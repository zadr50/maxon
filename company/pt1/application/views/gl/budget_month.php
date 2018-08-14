<?php 
echo "<strong><a href='".base_url()."index.php/budget/'>Back</a> | 
	$coa_type - $jenis_akun </strong></br>";
if(!isset($coa_group))$coa_group="";

?>
	<table id="dgItems" class="easyui-datagrid" width="100%"  		
		data-options="
			iconCls: 'icon-edit',fitColumns:true,
			singleSelect: true,
			toolbar: '#tb',
			url: '<?=base_url()?>index.php/budget/load_data/<?=$coa_type?>'
		">
		<thead>
			<tr>
				<th data-options="field:'keterangan',width:180">Nama Akun</th>
				<th data-options="field:'january',width:60,align:'right'">Jan</th>
				<th data-options="field:'february',width:60,align:'right'">Feb</th>
				<th data-options="field:'march',width:60,align:'right'">Mar</th>
				<th data-options="field:'april',width:60,align:'right'">Apr</th>
				<th data-options="field:'may',width:60,align:'right'">May</th>
				<th data-options="field:'june',width:60,align:'right'">Jun</th>
				<th data-options="field:'july',width:60,align:'right'">Jul</th>
				<th data-options="field:'august',width:60,align:'right'">Aug</th>
				<th data-options="field:'september',width:60,align:'right'">Sep</th>
				<th data-options="field:'october',width:60,align:'right'">Oct</th>
				<th data-options="field:'november',width:60,align:'right'">Nov</th>
				<th data-options="field:'december',width:60,align:'right'">Dec</th>
				<th data-options="field:'total',width:60,align:'right'">Total</th>
				<th data-options="field:'bonus',width:60,align:'right'">Bonus</th>
				<th data-options="field:'rkap',width:60,align:'right'">Rkap</th>
				<th data-options="field:'actual',width:60,align:'right'">Actual</th>
				<th data-options="field:'decin',width:60,align:'right'">De/In</th>
				<th data-options="field:'prc',width:60,align:'right'">Percent</th>
				<th data-options="field:'id',width:30,align:'right'">Line</th>
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
			<tr><td>Nama Perkiraan</td><td colspan=3>
				<input id="keterangan" name="keterangan" style="width:300px"></td></tr>
			<tr><td>Januari</td><td><input id="january"  name="january"></td>
				<td>Feburari</td><td><input id="february"  name="february"></td></tr>
			<tr><td>Maret</td><td><input id="march"  name="march"></td>
				<td>April</td><td><input id="april"  name="april"></td></tr>
			<tr><td>Mei</td><td><input id="may"  name="may"></td>
				<td>Juni</td><td><input id="june"  name="june"></td></tr>
			<tr><td>Juli</td><td><input id="july"  name="july"></td>
				<td>Agustus</td><td><input id="august"  name="august"></td></tr>
			<tr><td>September</td><td><input id="september"  name="september"></td>
				<td>Oktober</td><td><input id="october"  name="october"></td></tr>
			<tr><td>November</td><td><input id="november"  name="november"></td>
				<td>Desember</td><td><input id="december"  name="december"></td></tr>

			<tr><td>Total</td><td><input id="total"  name="total"></td>
				<td>&nbsp </td></tr>

			<tr><td>Bonus</td><td><input id="bonus"  name="bonus"></td>
				<td>Rkap</td><td><input id="rkap"  name="rkap"></td></tr>
			<tr><td>Actual</td><td><input id="actual"  name="actual"></td>
				<td>Dec/In</td><td><input id="decin"  name="decin"></td></tr>
			<tr><td>Persen</td><td><input id="prc"  name="prc"></td>
				<td>&nbsp </td></tr>
		</table>
		<input type='hidden' id='coa_type' name='coa_type'>
		<input type='hidden' id='id' name='id'>
		<input type='hidden' id='budget_year' name='budget_year'>
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
		$('#coa_type').val("<?=$coa_type?>");
		$('#fiscal_year').val("<?=$fiscal_year?>");
	}
	function editItem(){		 
		var row = $('#dgItems').datagrid('getSelected');
		if (row){
			$('#dlgItem').dialog('open').dialog('setTitle','Edit Item');
			$('#frmItem').form('load',row);
			$('#coa_type').val("<?=$coa_type?>");
			$('#fiscal_year').val("<?=$fiscal_year?>");
		}
	}
	function saveItem(){
		url = '<?=base_url()?>index.php/budget/save';
		 
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
					url='<?=base_url()?>index.php/budget/delete/'+row.id;
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