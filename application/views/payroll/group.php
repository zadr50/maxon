<legend>EMPLOYEE GROUP</legend>
<div class="col-md-12">
	<form id="frmNew" method="POST">
		<table width="100%" class='table'>
			<tr>	
				<td>Kode</td><td><?=form_input('kode',$kode)?></td>
			</tr>
			<tr>
				<td>Keterangan</td><td><?=form_input('keterangan',$keterangan,"style='width:300px'")?></td>
				<td><?=link_button("Simpan","add_group()","save")?></td>
			</tr>
		</table>	
		<?=form_hidden("mode",$mode,"id='mode'");?>
	</form>
</div>
<div class='col-md-12'>
<?php if($mode=="view"){
	$data['kode_group']=$kode;
	echo load_view("payroll/komponen",$data);
}
?>
</div> 
 
<script language="JavaScript">
	function add_group(){
		url='<?=base_url()?>index.php/payroll/group/save';
			$('#frmNew').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
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