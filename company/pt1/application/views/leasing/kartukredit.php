<table id="dgCards" class="easyui-datagrid"  
	style="width:auto;min-height:200px"
	data-options="
		iconCls: 'icon-edit',
		singleSelect: true,
		toolbar: '#tbCrCard',
		url: '<?=base_url()?>index.php/leasing/cust_master/kartukredit/<?=$cust_id?>'
	">
	<thead>
		<tr>
			<th data-options="field:'card_no'">Nomor</th>
			<th data-options="field:'card_bank',width:200">Nama Bank</th>
			<th data-options="field:'card_expire',align:'left',editor:'text'">Expire</th>
			<th data-options="field:'card_type',width:200">Card Type</th>
			<th data-options="field:'card_limit',width:200">Card Limit</th>
			<th data-options="field:'id',align:'right'">id</th>
		</tr>
	</thead>
</table>
<div id='tbCrCard'>
<?=$mode=="view"?"":link_button('Add', 'dgCards_Add()','add');?>
<?=$mode=="view"?"":link_button('Edit', 'dgCards_Edit()','edit');?>
<?=$mode=="view"?"":link_button('Delete', 'dgCards_Delete()','remove');?>
<?=$mode=="view"?"":link_button('Refresh', 'dgCards_Refresh()','reload');?>
</div>

<script language="JavaScript">
	function dgCards_Add(){
		$('#dlgAddCrCard').dialog('open').dialog('setTitle','Tambah Jenis Kartu Kredit');
	}
	function dgCards_Edit(){
		row = $('#dgCards').datagrid('getSelected');
		if (row){
			$("#frmAddCrCard_id").val(row.id);		
			url=CI_ROOT+'leasing/cust_master/kartukredit/view/'+row.id;
			$.ajax({type: "GET",url: url,
				success: function(result){		
					var result = eval('('+result+')');
					if (result.success){
						dgCards_Fill(result);
						$('#dlgAddCrCard').dialog('open').dialog('setTitle','Edit Jenis Kartu Kredit');					
					}
				},
				error: function(result){$.messager.alert('Info',result);}
			});         
			
		}
	}
	function dgCards_Delete(){
		row = $('#dgCards').datagrid('getSelected');
		if (row){
			xurl=CI_ROOT+'leasing/cust_master/kartukredit/delete/'+row.id;                             
			console.log(xurl);
			xparam='';
			$.ajax({
				type: "GET",
				url: xurl,
				param: xparam,
				success: function(msg){
					$('#dgCards').datagrid('reload');
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});         
		}
	}
	function dgCards_Refresh(){
		$('#dgCards').datagrid('reload');
	}
	function dgCards_Fill(result){
		$("#card_no").val(result.card_no);
		$("#card_bank").val(result.card_bank);
		$("#card_expire").val(result.card_expire);
		$("#card_type").val(result.card_type);
		$("#card_limit").val(result.card_limit);
		$("#frmAddCrCard_id").val(result.id);
	}	
	
	
</script>
