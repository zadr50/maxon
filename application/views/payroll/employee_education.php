<table id="dgEdu" class="easyui-datagrid" width='100%'
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns: true, toolbar: '#tbEdu',
	url: '<?=base_url()?>index.php/payroll/employee/education/load/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'educationlevel', width:'80'">Level</th>
			<th data-options="field:'school', width:'80'">Sekolah</th>
			<th data-options="field:'place', width:'80'">Kota</th>
			<th data-options="field:'major', width:'80'">Tingkat</th>
			<th data-options="field:'enteryear', width:'80'">Tahun Masuk</th>
			<th data-options="field:'graduationyear', width:'80'">Tahun Lulus</th>
			<th data-options="field:'yearofattend', width:'80'">Lamanya</th>
			<th data-options="field:'graduate', width:'80'">Lulus</th>
			<th data-options="field:'employeeid', width:'80'">NIP</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbEdu">
	<?=link_button("Tambah","add_edu()","add")?>
	<?=link_button("Edit","edit_edu()","edit")?>
	<?=link_button("Hapus","del_edu()","remove")?>
	<?=link_button("Refresh","load_edu()","reload")?>
</div>	


<div id='dlgEdu'class="easyui-dialog" icon='icon-edit' style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgEdu">
	<form method="post" id="frmEdu">
		<table style='width:100%'>
			<tr>
				<td>Level</td><td><?=form_input("educationlevel")?></td>
			</tr>
			<tr>
				<td>Sekolah</td><td><?=form_input("school")?></td>
			</tr>
			<tr>
				<td>Kota</td><td><?=form_input("place")?></td>
			</tr>
			<tr>
				<td>Tingkat</td><td><?=form_input("place")?></td>
			</tr>
			<tr>
				<td>Tahun Masuk</td><td><?=form_input("enteryear")?></td>
			</tr>
			<tr>
				<td>Tahun Lulus</td><td><?=form_input("graduationyear")?></td>
			</tr>
			<tr>
				<td>Lamanya</td><td><?=form_input("yearofattend")?></td>
			</tr>
			<tr>
				<td>Lulus</td><td><?=form_input("graduate")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_edu' name='id'>
		<input type='hidden' id='nip_edu' name='employeeid' value='<?=$nip?>'>
	</form>
</div>
<div id="tbDlgEdu">
	<?=link_button("Save","save_edu()","save")?>
</div>	

<script language="JavaScript">
	function add_edu() {
		$('#dlgEdu').dialog('open').dialog('setTitle','Pendidikan');
	}
	function save_edu() {
        if($('#company').val()===''){alert('Isi dulu nama perusahaan !');return false;};

		url='<?=base_url()?>index.php/payroll/employee/education/save';
		$('#frmEdu').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					load_edu();
					$('#dlgEdu').dialog('close');				
					$('#frmEdu').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_edu()	{
		var row = $('#dgEdu').datagrid('getSelected');
		if (row){
			$('#id_edu').val(row.id);
			$('#frmEdu input[name=company]').val(row.company);
			$('#frmEdu input[name=startdate]').val(row.startdate);
			$('#frmEdu input[name=finishdate]').val(row.finishdate);
			$('#frmEdu input[name=firstposition]').val(row.firstposition);
			$('#frmEdu input[name=endposition]').val(row.endposition);
			$('#frmEdu input[name=place]').val(row.place);
			$('#frmEdu input[name=lastsalary]').val(row.lastsalary);
			$('#frmEdu input[name=supervisor]').val(row.supervisor);
			$('#frmEdu input[name=referencename]').val(row.referencename);
			$('#frmEdu input[name=referencephone]').val(row.referencephone);
			$('#frmEdu input[name=reasontoleave]').val(row.reasontoleave);
			$('#frmEdu input[name=employeeid]').val(row.employeeid);
			
			$('#dlgEdu').dialog('open').dialog('setTitle','Pendidikan');
		}
	}
	function load_edu()	{
		nip=$('#nip').val();
		xurl='<?=base_url()?>index.php/payroll/employee/education/load/'+nip;
		$('#dgEdu').datagrid({url:xurl});
	}
	function del_edu()	{
		var row = $('#dgEdu').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/employee/education/delete/'+row.id;
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