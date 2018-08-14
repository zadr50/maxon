<table id="dgFam" class="easyui-datagrid" width="100%"
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns: true, toolbar: '#tbFam',
	url: '<?=base_url()?>index.php/payroll/employee/family/load/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'familyname', width:'80'">Nama Family</th>
			<th data-options="field:'relationship', width:'80'">Hubungan</th>
			<th data-options="field:'age', width:'80'">Umur</th>
			<th data-options="field:'job', width:'80'">Pekerjaan</th>
			<th data-options="field:'education', width:'80'">Pendidikan</th>
			<th data-options="field:'mariagestatus', width:'80'">Status Kawin</th>
			<th data-options="field:'employeeid', width:'80'">NIP</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbFam">
	<?=link_button("Tambah","add_fam()","add")?>
	<?=link_button("Edit","edit_fam()","edit")?>
	<?=link_button("Hapus","del_fam()","remove")?>
	<?=link_button("Refresh","load_fam()","reload")?>
</div>	


<div id='dlgFam'class="easyui-dialog" icon='icon-edit' style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgFam">
	<form method="post" id="frmFam">
		<table style='width:100%'>
			<tr>
				<td>Nama Family</td><td><?=form_input("familyname")?></td>
			</tr>
			<tr>
				<td>Hubungan</td><td><?=form_input("relationship")?></td>
			</tr>
			<tr>
				<td>Umur</td><td><?=form_input("age")?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td><td><?=form_input("job")?></td>
			</tr>
			<tr>
				<td>Pendidikan</td><td><?=form_input("education")?></td>
			</tr>
			<tr>
				<td>Status Pernikahan</td><td><?=form_input("mariagestatus")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_fam' name='id'>
		<input type='hidden' id='nip_fam' name='employeeid' value='<?=$nip?>'>
	</form>
</div>
<div id="tbDlgFam">
	<?=link_button("Save","save_fam()","save")?>
</div>	

<script language="JavaScript">
	function add_fam() {
		$('#dlgFam').dialog('open').dialog('setTitle','Saudara');
	}
	function save_fam() {
        if($('#familyname').val()===''){alert('Isi dulu nama saudara !');return false;};

		url='<?=base_url()?>index.php/payroll/employee/family/save';
		$('#frmFam').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					load_fam();
					$('#dlgFam').dialog('close');				
					$('#frmFam').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_fam()	{
		var row = $('#dgFam').datagrid('getSelected');
		if (row){
			$('#id_fam').val(row.id);
			$('[name=familyname').val(row.familyname);
			$('[name=relationship]').val(row.relationship);
			$('[name=age]').val(row.age);
			$('[name=job]').val(row.job);
			$('[name=education]').val(row.education);
			$('[name=mariagestatus]').val(row.mariagestatus);
			$('[name=employeeid]').val(row.employeeid);
			
			$('#dlgFam').dialog('open').dialog('setTitle','Saudara');
		}
	}
	function load_fam()	{
		nip=$('#nip').val();
		xurl='<?=base_url()?>index.php/payroll/employee/family/load/'+nip;
		$('#dgFam').datagrid({url:xurl});
	}
	function del_fam()	{
		var row = $('#dgEdu').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/employee/family/'+row.id;
			$.ajax({
				type: "GET", url: url,
				success: function(msg){
					load_fam();
				},
				error: function(msg){alert(msg);}
			});
		}
	}
</script>