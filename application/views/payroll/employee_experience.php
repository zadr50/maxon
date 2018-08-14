<table id="dgExp" class="easyui-datagrid" width='100%'
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns: true, 
	toolbar: '#tbExp',
	url: '<?=base_url()?>index.php/payroll/employee/experience/load/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'company', width:'80'">Perusahaan</th>
			<th data-options="field:'startdate', width:'80'">Tgl Mulai</th>
			<th data-options="field:'finishdate', width:'80'">Tgl Berhenti</th>
			<th data-options="field:'firstposition', width:'80'">Awal Pos</th>
			<th data-options="field:'endposition', width:'80'">Akhir Pos</th>
			<th data-options="field:'place', width:'80'">Tempat</th>
			<th data-options="field:'lastsalary', width:'80'">Gaji Akhir</th>
			<th data-options="field:'supervisor', width:'80'">Supervisor</th>
			<th data-options="field:'referencename', width:'80'">Ref Name</th>
			<th data-options="field:'referencephone', width:'80'">Ref Phone</th>
			<th data-options="field:'reasontoleave', width:'80'">Reason Leave</th>
			<th data-options="field:'employeeid', width:'80'">NIP</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbExp">
	<?=link_button("Tambah","add_exp()","add")?>
	<?=link_button("Edit","edit_exp()","edit")?>
	<?=link_button("Hapus","del_exp()","remove")?>
	<?=link_button("Refresh","load_exp()","reload")?>
</div>	


<div id='dlgExp'class="easyui-dialog" icon='icon-edit' 
	style="width:500px;height:380px;padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgExp">
	<form method="post" id="frmExp">
		<table class='table2' style='width:100%'>
			<tr>
				<td>Perusahaan</td><td><?=form_input("company")?></td>
			</tr>
			<tr>
				<td>Tgl Mulai</td><td><?=form_input("startdate",date("Y-m-d"),
                                        "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px'")?></td>
			</tr>
			<tr>
				<td>Tgl Berhenti</td><td><?=form_input("finishdate",date("Y-m-d"),
                                        "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px'")?></td>
			</tr>
			<tr>
				<td>Posisi Awal</td><td><?=form_input("firstposition")?></td>
			</tr>
			<tr>
				<td>Posisi Akhir</td><td><?=form_input("endposition")?></td>
			</tr>
			<tr>
				<td>Tempat</td><td><?=form_input("place")?></td>
			</tr>
			<tr>
				<td>Gaji Akhir</td><td><?=form_input("lastsalary")?></td>
			</tr>
			<tr>
				<td>Supervisor</td><td><?=form_input("supervisor")?></td>
			</tr>
			<tr>
				<td>Ref Name</td><td><?=form_input("referencename")?></td>
			</tr>
			<tr>
				<td>Ref Phone</td><td><?=form_input("referencephone")?></td>
			</tr>
			<tr>
				<td>Reason Leave</td><td><?=form_input("reasontoleave")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_exp' name='id'>
		<input type='hidden' id='nip_exp' name='employeeid' value='<?=$nip?>'>
	</form>
</div>
<div id="tbDlgExp">
	<?=link_button("Save","save_exp()","save")?>
</div>	

<script language="JavaScript">
	function add_exp() {
		if($("#mode").val()=="add"){alert("Simpan dulu record ini !");return false}
		$('#dlgExp').dialog('open').dialog('setTitle','Pengalaman Kerja');
	}
	function save_exp() {
        if($('#company').val()===''){alert('Isi dulu nama perusahaan !');return false;};

		url='<?=base_url()?>index.php/payroll/employee/experience/save';
		$('#frmExp').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					load_exp();
					$('#dlgExp').dialog('close');				
					$('#frmExp').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_exp()	{
		var row = $('#dgExp').datagrid('getSelected');
		if (row){
			console.log(row);
			$('#id_exp').val(row.id);
			$('#frmExp input[name=company]').val(row.company);
			$('#frmExp input[name=startdate]').val(row.startdate);
			$('#frmExp input[name=finishdate]').val(row.finishdate);
			$('#frmExp input[name=firstposition]').val(row.firstposition);
			$('#frmExp input[name=endposition]').val(row.endposition);
			$('#frmExp input[name=place]').val(row.place);
			$('#frmExp input[name=lastsalary]').val(row.lastsalary);
			$('#frmExp input[name=supervisor]').val(row.supervisor);
			$('#frmExp input[name=referencename]').val(row.referencename);
			$('#frmExp input[name=referencephone]').val(row.referencephone);
			$('#frmExp input[name=reasontoleave]').val(row.reasontoleave);
			$('#frmExp input[name=employeeid]').val(row.employeeid);
			
			$('#dlgExp').dialog('open').dialog('setTitle','Pengalaman Kerja');
		}
	}
	function load_exp()	{
		nip=$('#nip').val();
		xurl='<?=base_url()?>index.php/payroll/employee/experience/load/'+nip;
		$('#dgExp').datagrid({url:xurl});
	}
	function del_exp()	{
		var row = $('#dgExp').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/employee/experience/delete/'+row.id;
			$.ajax({
				type: "GET", url: url,
				success: function(msg){
					load_exp();
				},
				error: function(msg){alert(msg);}
			});
		}
	}
</script>