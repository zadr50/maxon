<table id="dgAlamat" class="easyui-datagrid"  
	style="width:auto;min-height:200px"
	data-options="
		iconCls: 'icon-edit',
		singleSelect: true,
		toolbar: '#tbAlamat',
		url: '<?=base_url()?>index.php/leasing/cust_master/alamat/<?=$cust_id?>'
	">
	<thead>
		<tr>
			<th data-options="field:'ship_to_type'">Jenis Alamat</th>
			<th data-options="field:'first_name'">Contact</th>
			<th data-options="field:'phone'">Telpon</th>
			<th data-options="field:'city'">Kota</th>
			<th data-options="field:'kec'">Kecamatan</th>
			<th data-options="field:'kel'">Kelurahaan</th>
			<th data-options="field:'zip_pos'">Kode Pos</th>
			<th data-options="field:'rt'">RT</th>
			<th data-options="field:'rw'">RW</th>
			<th data-options="field:'street'">Alamat</th>
			<th data-options="field:'fax'">Fax</th>
			<th data-options="field:'email'">Telpon</th>
			<th data-options="field:'hp'">Telpon</th>
			<th data-options="field:'id',align:'right'">id</th>
		</tr>
	</thead>
</table>

<div id='tbAlamat'>
<?=$mode=="view"?"":link_button('Add', 'dgAlamat_Add()','add');?>
<?=$mode=="view"?"":link_button('Edit', 'dgAlamat_Edit()','edit');?>
<?=$mode=="view"?"":link_button('Delete', 'dgAlamat_Delete()','remove');?>
<?=$mode=="view"?"":link_button('Refresh', 'dgAlamat_Refresh()','reload');?>
</div>

<script language="JavaScript">

	function dgAlamat_Edit(){
		fill_form_blank();
		row = $('#dgAlamat').datagrid('getSelected');
		if (row){
			$("#frmAddAlamat_id").val(row.id);		
			url=CI_ROOT+'leasing/cust_master/alamat/view/'+row.id;
			$.ajax({type: "GET",url: url,
				success: function(result){		
					var result = eval('('+result+')');
					if (result.success){
						fill_form(result);
						$('#dlgAddAlamat').dialog('open').dialog('setTitle','Edit Alamat');					
					}
				},
				error: function(result){$.messager.alert('Info',result);}
			});         
			
		}
	}
	function dgAlamat_Refresh(){
		$('#dgAlamat').datagrid('reload');
	}
	function dgAlamat_Delete(){
		row = $('#dgAlamat').datagrid('getSelected');
		if (row){
			xurl=CI_ROOT+'leasing/cust_master/alamat/delete/'+row.id;                             
			console.log(xurl);
			xparam='';
			$.ajax({
				type: "GET",
				url: xurl,
				param: xparam,
				success: function(msg){
					$('#dgAlamat').datagrid('reload');
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});         
		}
	
	}
	function dgAlamat_Add(){
		fill_form_blank();
		$('#dlgAddAlamat').dialog('open').dialog('setTitle','Tambah Jenis Alamat');
	}

</script>