<div class="thumbnail box-gradient">
    <?php
    echo link_button('Save', 'add_group()','save');        
    ?>
    <div style='float:right'>
    <?php echo link_button('Help', 'load_help(\'employee_group\')','help');    ?>  
    <a href="#" class="easyui-splitbutton" 
    data-options="menu:'#mmOptions',iconCls:'icon-tip',plain:false">Options</a>
    <div id="mmOptions" style="width:200px;">
        <div onclick="load_help('employee_group')">Help</div>
        <div>Update</div>
        <div>MaxOn Forum</div>
        <div>About</div>
    </div>
    <?php echo link_button('Close', 'remove_tab_parent()','cancel');        ?>
    </div>
</div> 

<div class="col-md-12">
	<form id="frmNew" method="POST">
		<table width="100%" class='table'>
			<tr>	
				<td>Kode</td><td><?=form_input('kode',$kode)?></td>
			</tr>
			<tr>
				<td>Keterangan</td><td><?=form_input('keterangan',$keterangan,"style='width:300px'")?></td>
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