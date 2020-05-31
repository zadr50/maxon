<table id="dgCicil" class="easyui-datagrid" style="width:auto;"
	data-options="iconCls: 'icon-edit',singleSelect: true,toolbar: '#tbCicil',
	url: '<?=base_url()?>index.php/payroll/pinjaman/cicilan/list/<?=$loan_number?>'">
	<thead>
		<tr>
			<th data-options="field:'tanggal_jth_tempo', width:'80'">Tanggal</th>
			<th data-options="<?=col_number('awal',2)?>">Awal</th>			
			<th data-options="<?=col_number('pokok',2)?>">Pokok</th>
			<th data-options="<?=col_number('bunga',2)?>">Bunga</th>
			<th data-options="<?=col_number('angsuran',2)?>">Angsuran</th>
			<th data-options="<?=col_number('akhir',2)?>">Akhir</th>
			<th data-options="<?=col_number('payment_no',2)?>">Nomor Bayar</th>
			<th data-options="<?=col_number('comments',2)?>">Catatan</th>
			<th data-options="field:'loan_number',width:'80'">Nomor Pinjaman</th>
			<th data-options="field:'id', width:'80'">Id</th>
		</tr>
	</thead>
</table>
	
<div id="tbCicil">
	<?=link_button("Tambah","add_cicil()","add")?>
	<?=link_button("Edit","edit_cicil()","edit")?>
	<?=link_button("Hapus","del_cicil()","remove")?>
	<?=link_button("Refresh","load_cicil()","reload")?>
</div>	


<div id='dlgCicil'class="easyui-dialog" icon='icon-edit' style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"  
	closed="true" buttons="#tbDlgCicil">
	<form method="post" id="frmCicil">
		<table style='width:100%'>
			<tr>
				<td>Tanggal Jth Tempo</td><td><?=form_input("tanggal_jth_tempo")?></td>
			</tr>
			<tr>
				<td>Saldo Awal</td><td><?=form_input("awal")?></td>
			</tr>
			<tr>
				<td>Pokok</td><td><?=form_input("pokok")?></td>
			</tr>
			<tr>
				<td>Bunga</td><td><?=form_input("bunga")?></td>
			</tr>
			<tr>
				<td>Angsuran</td><td><?=form_input("angsuran")?></td>
			</tr>
			<tr>
				<td>Saldo Akhir</td><td><?=form_input("akhir")?></td>
			</tr>
			<tr>
				<td>Nomor Bayar</td><td><?=form_input("payment_no")?></td>
			</tr>
			<tr>
				<td>Catatan</td><td><?=form_input("comments")?></td>
			</tr>
			<tr>
				<td>Nomor Pinjaman</td><td><?=form_input("loan_number")?></td>
			</tr>
		</table>		
		<input type='hidden' id='id_cicil' name='id'>
		<input type='hidden' id='loan_number_cicil' name='loan_number' value='<?=$loan_number?>'>
	</form>
</div>
<div id="tbDlgCicil">
	<?=link_button("Save","save_cicil()","save")?>
</div>	

<script language="JavaScript">
	function add_cicil() {
		$('#dlgCicil').dialog('open').dialog('setTitle','Pendidikan');
	}
	function save_cicil() {
        if($('#loan_number').val()===''){alert('Isi dulu nomor pinjaman !');return false;};
        loading();
		url='<?=base_url()?>index.php/payroll/pinjaman/save';
		$('#frmCicil').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
				    loading_close();
					load_cicil();
					$('#dlgCicil').dialog('close');				
					$('#frmCicil').each(function(){ this.reset(); });
					log_msg('Data sudah tersimpan.');
				} else {
				    loading_close();
					log_err(result.msg);
				}
			}
		});	
	}
	function edit_cicil()	{
		var row = $('#dgCicil').datagrid('getSelected');
		if (row){
			$('#id_cicil').val(row.id);
			$('[name=company]').val(row.company);
			$('[name=startdate]').val(row.startdate);
			$('[name=finishdate]').val(row.finishdate);
			$('[name=firstposition]').val(row.firstposition);
			$('[name=endposition]').val(row.endposition);
			$('[name=place]').val(row.place);
			$('[name=lastsalary]').val(row.lastsalary);
			$('[name=supervisor]').val(row.supervisor);
			$('[name=referencename]').val(row.referencename);
			$('[name=referencephone]').val(row.referencephone);
			$('[name=reasontoleave]').val(row.reasontoleave);
			$('[name=employeeid]').val(row.employeeid);
			
			$('#dlgEdu').dialog('open').dialog('setTitle','Pendidikan');
		}
	}
	function load_cicil()	{
		loan_number='<?=$loan_number?>';
		xurl='<?=base_url()?>index.php/payroll/pinjaman/cicilan/list/'+loan_number;
		$('#dgCicil').datagrid({url:xurl});
	}
	function del_cicil()	{
		var row = $('#dgCicil').datagrid('getSelected');
	 
		if (row){
			url='<?=base_url()?>index.php/payroll/pinjaman/delete_by_id/'+row.id;
			$.ajax({
				type: "GET", url: url,
				success: function(msg){
					load_cicil();
				},
				error: function(msg){log_err(msg);}
			});
		}
	}
</script>