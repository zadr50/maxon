<table id="dgMed" class="easyui-datagrid" width='100%'
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns:true, toolbar: '#tbMed',
	url: '<?=base_url()?>index.php/payroll/employee/medical/load/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'medicaldate', width:'80'">Medical Date</th>
			<th data-options="field:'description', width:'280'">Keterangan</th>
			<th data-options="field:'employeeid', width:'80'">NIP</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbMed">
	<?=link_button("Tambah","add_med()","add")?>
	<?=link_button("Edit","edit_med()","edit")?>
	<?=link_button("Hapus","del_med()","remove")?>
	<?=link_button("Refresh","load_med()","reload")?>
</div>	


<div id='dlgMed'class="easyui-dialog" icon='icon-edit' style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgMed">
	<form method="post" id="frmMed">
		<table style='width:100%'>
			<tr>
				<td>Tanggal Medical</td><td><?=form_input("medicaldate")?></td>
			</tr>
			<tr>
				<td>Keterangan Medical</td><td><?=form_input("description")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_edu' name='id'>
		<input type='hidden' id='nip_edu' name='employeeid' value='<?=$nip?>'>
	</form>
</div>
<div id="tbDlgMed">
	<?=link_button("Save","save_med()","save")?>
</div>	

<script language="JavaScript">
	function add_med() {
		$('#dlgMed').dialog('open').dialog('setTitle','Medical');
	}
	function save_med() {
        if($('#description').val()===''){alert('Isi dulu keterangan medical !');return false;};

		url='<?=base_url()?>index.php/payroll/employee/medical/save';
		$('#frmMed').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					load_med();
					$('#dlgMed').dialog('close');				
					$('#frmMed').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_med()	{
		var row = $('#dgMed').datagrid('getSelected');
		if (row){
			$('#id_med').val(row.id);
			$('#frmMed input[name=medicaldate]').val(row.medicaldate);
			$('#frmMed input[name=description]').val(row.description);
			
			$('#dlgMed').dialog('open').dialog('setTitle','Medical');
		}
	}
	function load_med()	{
		nip=$('#nip').val();
		xurl='<?=base_url()?>index.php/payroll/employee/medical/load/'+nip;
		$('#dgMed').datagrid({url:xurl});
	}
	function del_med()	{
		var row = $('#dgMed').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/employee/medical/delete/'+row.id;
			$.ajax({
				type: "GET", url: url,
				success: function(msg){
					load_med();
				},
				error: function(msg){alert(msg);}
			});
		}
	}
</script>