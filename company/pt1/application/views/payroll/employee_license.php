<table id="dgLic" class="easyui-datagrid" width='100%'
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns: true, toolbar: '#tbLic',
	url: '<?=base_url()?>index.php/payroll/employee/license/load/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'licensenumber', width:'80'">Nomor</th>
			<th data-options="field:'licensetype', width:'80'">Jenis</th>
			<th data-options="field:'startdate', width:'80'">Tanggal Awal</th>
			<th data-options="field:'finishdate', width:'80'">Tanggal Akhir</th>
			<th data-options="field:'employeeid', width:'80'">NIP</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbLic">
	<?=link_button("Tambah","add_lic()","add")?>
	<?=link_button("Edit","edit_lic()","edit")?>
	<?=link_button("Hapus","del_lic()","remove")?>
	<?=link_button("Refresh","load_lic()","reload")?>
</div>	


<div id='dlgLic'class="easyui-dialog" icon='icon-edit' style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgLic">
	<form method="post" id="frmLic">
		<table style='width:100%'>
			<tr>
				<td>Nomor </td><td><?=form_input("licensenumber")?></td>
			</tr>
			<tr>
				<td>Jenis (KTP/SIM)</td><td><?=form_input("licensetype")?></td>
			</tr>
			<tr>
				<td>Tanggal Awal</td><td><?=form_input("startdate")?></td>
			</tr>
			<tr>
				<td>Tanggal Akhir</td><td><?=form_input("finishdate")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_lic' name='id'>
		<input type='hidden' id='nip_lic' name='employeeid' value='<?=$nip?>'>
	</form>
</div>
<div id="tbDlgLic">
	<?=link_button("Save","save_lic()","save")?>
</div>	

<script language="JavaScript">
	function add_lic() {
		$('#dlgLic').dialog('open').dialog('setTitle','Lisensi');
	}
	function save_lic() {
        if($('#licensenumber').val()===''){alert('Isi dulu nomor kartu !');return false;};

		url='<?=base_url()?>index.php/payroll/employee/license/save';
		$('#frmLic').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					load_lic();
					$('#dlgLic').dialog('close');				
					$('#frmLic').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_lic()	{
		var row = $('#dgLic').datagrid('getSelected');
		if (row){
			$('#id_lic').val(row.id);
			$('#frmLic input[name=licensenumber]').val(row.licensenumber);
			$('#frmLic input[name=licensetype]').val(row.licensetype);
			$('#frmLic input[name=startdate]').val(row.startdate);
			$('#frmLic input[name=finishdate]').val(row.finishdate);
			$('#dlgLic').dialog('open').dialog('setTitle','License');
		}
	}
	function load_lic()	{
		nip=$('#nip').val();
		xurl='<?=base_url()?>index.php/payroll/employee/license/load/'+nip;
		$('#dgLic').datagrid({url:xurl});
	}
	function del_lic()	{
		var row = $('#dgLic').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/employee/license/delete/'+row.id;
			$.ajax({
				type: "GET", url: url,
				success: function(msg){
					load_edu();
				},
				error: function(msg){alert(msg);}
			});
		}
	}
</script>