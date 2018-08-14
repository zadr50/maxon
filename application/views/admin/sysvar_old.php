<legend>SYSTEM VARIABLES</legend>
<div class='alert'><?=$message?></div>
	<div class="box-gradient">
		<form id="frmNew" method="POST">
			<table width="100%" class='table'>
				<tr>	
					<td>VarValue</td><td><?=form_input('varvalue')?></td>
					<td>Description</td><td><?=form_input('keterangan')?></td>
					<td><?=link_button("Tambah","add_sysvar()","save")?></td>
					<td></td><td><?=form_hidden('varname',$varname)?></td>
					<td></td><td><?=form_hidden('id')?></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="thumbnail" >
			<table class="table" width="100%">
				<thead><tr><th>VarName</th><th>Keterangan</th><th>Action</th></tr></thead>
				<tbody>
					<?     			
					foreach($recordset->result() as $row_item){
						echo "
						<tr>
						
						<td>".$row_item->varvalue."</td>
						<td>".$row_item->keterangan."</td>
						<td>".link_button('Hapus',"del_sysvar('".$row_item->id."')","remove")."</td></tr>
						";
					}
					?>
					<tr></tr>
				</tbody>
			</table>
	</div>

<script language="JavaScript">
	function add_sysvar(){
		url='<?=base_url()?>index.php/sysvar_data/save';
			$('#frmNew').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
			            window.open(CI_ROOT+'sysvar_data/view_list/<?=$varname?>','_self');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
 	}
 	function del_sysvar(kode){
        xurl=CI_ROOT+'sysvar_data/delete/'+kode;                             
        $.ajax({
            type: "GET",
            url: xurl,
            success: function(msg){
	            window.open(CI_ROOT+'sysvar_data/view_list/<?=$varname?>','_self');
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });         
 	}	
</script>