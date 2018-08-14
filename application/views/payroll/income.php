<div class='col-md-12'><legend>JENIS TUNJANGAN</legend>
	<form id="frmNew" method="POST">
		<table class='table' width="100%">
			<tr>	
				<td>Kode</td><td><?=form_input('kode',$kode)?></td>
			</tr>
			<tr>
				<td>Keterangan</td><td colspan='4'><?=form_input('keterangan',$keterangan,"style='width:400px;'")?></td>
			</tr><tr>	
				<td>Sifat</td><td><?=form_input('sifat',$sifat)?></td>
			</tr>
			<tr>
				<td>Rumus?</td><td><?=form_input('is_variable',$is_variable,"style='width:100px;'")?></td>
			</tr>
			<tr>
				<td>Ref Kolom PPh</td><td><?=form_input('ref_column',$ref_column)?></td>
			</tr>
			<tr>
				<td><?=link_button("Simpan","simpan()","save")?></td>
			</tr>
		</table>
		<?=form_hidden("mode",$mode,"id='mode'")?>
	</form>
</div>
<script language="JavaScript">
	function simpan(){
		$('#frmNew').form('submit',{
			url: CI_ROOT+"payroll/income/save",
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$("#mode").val("edit");
					log_msg("Record berhasil disimpan.");
					remove_tab_parent();
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
 	}	
</script>