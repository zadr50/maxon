<table id="dgTrg" class="easyui-datagrid" width='100%'
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns:true, toolbar: '#tbTrg', 
	url: '<?=base_url()?>index.php/payroll/employee/training/load/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'trainingname', width:'80'">Nama Training</th>
			<th data-options="field:'trainingdate', width:'80'">Tanggal</th>
			<th data-options="field:'place', width:'80'">Tempat</th>
			<th data-options="field:'topic', width:'80'">Topik</th>
			<th data-options="field:'certificate', width:'80'">Sertifikat</th>
			<th data-options="field:'employeeid', width:'80'">NIP</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbTrg">
	<?=link_button("Tambah","add_trg()","add")?>
	<?=link_button("Edit","edit_trg()","edit")?>
	<?=link_button("Hapus","del_trg()","remove")?>
	<?=link_button("Refresh","load_trg()","reload")?>
</div>	


<div id='dlgTrg'class="easyui-dialog" icon='icon-edit' style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgTrg">
	<form method="post" id="frmTrg">
		<table style='width:100%'>
			<tr>
				<td>Nama Training</td><td><?=form_input("trainingname")?></td>
			</tr>
			<tr>
				<td>Tanggal</td><td><?=form_input("trainingdate")?></td>
			</tr>
			<tr>
				<td>Tempat</td><td><?=form_input("place")?></td>
			</tr>
			<tr>
				<td>Tingkat</td><td><?=form_input("place")?></td>
			</tr>
			<tr>
				<td>Topik</td><td><?=form_input("topic")?></td>
			</tr>
			<tr>
				<td>Sertifikat</td><td><?=form_input("certificate")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_trg' name='id'>
		<input type='hidden' id='nip_trg' name='employeeid' value='<?=$nip?>'>
	</form>
</div>
<div id="tbDlgTrg">
	<?=link_button("Save","save_trg()","save")?>
</div>	

<script language="JavaScript">
	function add_trg() {
		$('#dlgTrg').dialog('open').dialog('setTitle','Pendidikan');
	}
	function save_trg() {
        if($('#trainingname').val()===''){alert('Isi dulu nama training!');return false;};

		url='<?=base_url()?>index.php/payroll/employee/training/save';
		$('#frmTrg').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					load_exp();
					$('#dlgTrg').dialog('close');				
					$('#frmTrg').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_trg()	{
		var row = $('#dgTrg').datagrid('getSelected');
		if (row){
			$('#id_trg').val(row.id);
			$('#frmTrg input[name=trainingname]').val(row.trainingname);
			$('#frmTrg input[name=trainingdate]').val(row.trainingdate);
			$('#frmTrg input[name=place]').val(row.place);
			$('#frmTrg input[name=topic]').val(row.topic);
			$('#frmTrg input[name=certificate]').val(row.certificate);
			$('[name=employeeid]').val(row.employeeid);
			
			$('#dlgTrg').dialog('open').dialog('setTitle','Training');
		}
	}
	function load_trg()	{
		nip=$('#nip').val();
		xurl='<?=base_url()?>index.php/payroll/employee/training/load/'+nip;
		$('#dgTrg').datagrid({url:xurl});
	}
	function del_trg()	{
		var row = $('#dgTrg').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/employee/training/delete/'+row.id;
			$.ajax({
				type: "GET", url: url,
				success: function(msg){
					load_trg();
				},
				error: function(msg){alert(msg);}
			});
		}
	}
</script>