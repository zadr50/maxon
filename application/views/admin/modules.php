<div id='dlgEditBox_modules' class="easyui-dialog"  style="width:700px;height:400px;
padding:5px 5px;top:10px;left:10px" title="Module"
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
	<?=link_button('Close','close_mod();return false;','cancel')?>
    <?=link_button('Save','save_mod();return false;','save')?>
</div>

<script language="javascript">
    function close_mod(){
        $("#dlgEditBox_modules").dialog("close");
    }
	function save_mod() {
  		if($('#module_id').val()==''){alert('Isi module id !');return false;}
		url='<?=base_url()?>index.php/modules/save';
		loading();
			$('#frmMod').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlgEditBox_modules').dialog('close');
						$('#mode').val('view');
						log_msg('Data sudah tersimpan. Tekan refresh bila diperlukan.');
					} else {
						log_err(result.msg);
					}
					loading_close();
				}
			});		
	}
	function edit_modules(){
	    var row = $('#dg_modules').datagrid('getSelected');
        if (row){
            $("#module_id").val(row.id);
            $("#mode").val('view');
            $('#dlgEditBox_modules').window({left:10,top:10});
            $('#dlgEditBox_modules').dialog('open').dialog('setTitle','Add / Edit Module Name');        
            xurl=CI_ROOT+'modules/find/'+$('#module_id').val();
            loading();
            $.ajax({
                        type: "GET",
                        url: xurl,
                        data:'',
                        success: function(msg){
                            var obj=jQuery.parseJSON(msg);
                            $('#module_name').val(obj.module_name);
                            $('#description').val(obj.description);
                            $('#type').val(obj.type);
                            $('#form_name').val(obj.form_name);
                            $('#parentid').val(obj.parentid);
                            $('#sequnce').val(obj.sequence);
                            loading_close();
                        },
                        error: function(msg){
                            log_err(msg);loading_close();
                        }
            });     
               
        }
        


        
	}
</script>