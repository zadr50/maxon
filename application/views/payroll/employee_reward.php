<table id="dgRwd" class="easyui-datagrid" width='100%'
	data-options="iconCls: 'icon-edit',singleSelect: true, fitColumns: true, toolbar: '#tbRwd',
	url: '<?=base_url()?>index.php/payroll/employee/reward/load/<?=$nip?>'">
	<thead>
		<tr>
			<th data-options="field:'daterp', width:'80'">Tanggal</th>
			<th data-options="field:'description', width:'80'">Keterangan</th>
			<th data-options="field:'rankinglevel', width:'80'">Level</th>
			<th data-options="field:'typerp', width:'80'">Jenis</th>
			<th data-options="field:'employeeid', width:'80'">NIP</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbRwd">
	<?=link_button("Tambah","add_rwd()","add")?>
	<?=link_button("Edit","edit_rwd()","edit")?>
	<?=link_button("Hapus","del_rwd()","remove")?>
	<?=link_button("Refresh","load_rwd()","reload")?>
</div>	


<div id='dlgRwd'class="easyui-dialog" icon='icon-edit' style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgRwd">
	<form method="post" id="frmRwd">
		<table style='width:100%'>
			<tr>
				<td>Tanggal</td><td><?=form_input("daterp")?></td>
			</tr>
			<tr>
				<td>Keterangan</td><td><?=form_input("description")?></td>
			</tr>
			<tr>
				<td>Ranking</td><td><?=form_input("rankinglevel")?></td>
			</tr>
			<tr>
				<td>Jenis (Reward/Punish)</td><td><?=form_input("typerp")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_rwd' name='id'>
		<input type='hidden' id='nip_rwd' name='employeeid' value='<?=$nip?>'>
	</form>
</div>
<div id="tbDlgRwd">
	<?=link_button("Save","save_rwd()","save")?>
</div>	

<script language="JavaScript">
	function add_rwd() {
		$('#dlgRwd').dialog('open').dialog('setTitle','Reward/Punish');
	}
	function save_rwd() {
        if($('#description').val()===''){alert('Isi dulu nama keterangan !');return false;};

		url='<?=base_url()?>index.php/payroll/employee/reward/save';
		$('#frmRwd').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					load_rwd();
					$('#dlgRwd').dialog('close');				
					$('#frmRwd').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_rwd()	{
		var row = $('#dgRwd').datagrid('getSelected');
		if (row){
			$('#id_rwd').val(row.id);
			$('#frmRwd input[name=daterp]').val(row.daterp);
			$('#frmRwd input[name=description]').val(row.description);
			$('#frmRwd input[name=rankinglevel]').val(row.rankinglevel);
			$('#frmRwd input[name=typerp]').val(row.typerp);
			$('[name=endposition]').val(row.endposition);
			$('[name=employeeid]').val(row.employeeid);
			
			$('#dlgRwd').dialog('open').dialog('setTitle','Reward/Punish');
		}
	}
	function load_rwd()	{
		nip=$('#nip').val();
		xurl='<?=base_url()?>index.php/payroll/employee/reward/load/'+nip;
		$('#dgRwd').datagrid({url:xurl});
	}
	function del_rwd()	{
		var row = $('#dgRwd').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/employee/reward/delete/'+row.id;
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