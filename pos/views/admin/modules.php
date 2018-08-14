<div id='dlgMod' class="easyui-dialog"  style="width:400px;height:300px;
padding:5px 5px;left:100px;top:20px"
	 closed="true"  buttons="#tbModAdd">
	<?=form_open('',"id='frmMod'");?>
	<table>
		<tr><td>Modul Id</td><td><?=form_input('module_id','',"id='module_id'")?></td></tr>
		<tr><td>Modul Name</td><td><?=form_input('module_name','',"id='module_name'")?></td></tr>
		<tr><td>Description</td><td><?=form_input('description','','id=\'description\' style=\'width:300px\'')?></td></tr>
		<tr><td>Type</td><td><?=form_input('type','',"id='type'")?></td></tr>
		<tr><td>Form Name</td><td><?=form_input('form_name','',"id='form_name'")?></td></tr>
		<tr><td>Parent Modul ID</td><td><?=form_input('parentid','',"id='parentid'")?></td></tr>
		<tr><td>Sequence</td><td><?=form_input('sequence','',"id='sequence'")?></td></tr>
		<input type='hidden' name='mode' id='mode'>
	</table>
	<?=form_close();?>
</div>
<div id='tbModAdd'>
	<?=link_button('Save','save_mod()','save')?>
</div>

<script language="javascript">
	function save_mod() {
  		if($('#module_id').val()==''){alert('Isi module id !');return false;}
		url='<?=base_url()?>index.php/modules/save';
			$('#frmMod').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlgMod').dialog('close');
						$('#mode').val('view');
						log_msg('Data sudah tersimpan. Tekan refresh bila diperlukan.');
					} else {
						log_err(result.msg);
					}
				}
			});		
	}
</script>