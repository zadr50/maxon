<?php 
$url=base_url()."index.php/".$controller;
$var_ctrl=str_replace("/","_",$controller);
if(!isset($title))$title=$class_name;
?>
<div class="easyui-panel themes" data-options="iconCls:'icon-more',
	closable:true,collapsible:true,minimizable:true,maximizable:true" 
	title='Data'>

<table id="dg<?=$var_ctrl?>" class="easyui-datagrid "  title="<?=$title?>"
	data-options="iconCls: 'icon-edit',pagination:true,pageSize:10,
		singleSelect: true, fitColumns: true,  
		url: '<?=$url?>/browse_data/<?=$class_name?>',toolbar:'#tb<?=$var_ctrl?>'
	">
	<thead>
		<tr>
		<?php 
			for($i=0;$i<count($fields);$i++) { 
			$field=$fields[$i];			
			if(is_object($field)){
				$type=$field->Type;
				$fieldname=$field->Field;
			} else {
				$type="String";
				$fieldname=$field;
			}
			$width=90;
			$header=ucfirst($fieldname);
		?>
			<th data-options="field:'<?=$fieldname?>',width:<?=$width?>"><?=$header?></th>
		<?php } ?>
		</tr>
	</thead>
</table>
</div>

<div id="tb<?=$var_ctrl?>">
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" 
		onclick="new_<?=$var_ctrl?>();return false;">New</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" 
		onclick="delete_<?=$var_ctrl?>();return false;">Delete</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" 
		onclick="edit_<?=$var_ctrl?>();return false;">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-filter"  
		onclick="filter_<?=$var_ctrl?>();return false;">Filter</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-print"  
		onclick="print_<?=$var_ctrl?>();return false;">Print</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-reload"  
		onclick="reload_<?=$var_ctrl?>();return false;">Reload</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-no"  
		onclick="exit_<?=$var_ctrl?>();return false;">Close</a>
		
</div>

<script language="javascript">
function new_<?=$var_ctrl?>(){
	<?php 
	for($i=0;$i<count($fields);$i++) { 
		$field=$fields[$i];
		if(is_object($field)){
			$fieldname=$field->Name;
		} else {
			$fieldname=$field;
		}
		echo "$('#".$fieldname."').val('');";
		echo "";
	}
	?>
	$('#dlg<?=$var_ctrl?>').dialog('open');	
}
function delete_<?=$var_ctrl?>(){
	var row = $('#dg<?=$var_ctrl?>').datagrid('getSelected');
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r)
		{
			if(!r)return false;
			xurl='<?=base_url()?>index.php/crud/delete/<?=$class_name?>/'+row.id;                        
			$.ajax({
				type: "GET",	url: xurl,
				success: function(result){
				try {
						var result = eval('('+result+')');
						if(result.success){
							$.messager.show({
								title:'Success',msg:result.msg
							});
							$('#dg<?=$var_ctrl?>').datagrid('reload');	 
						} else {
							$.messager.show({
								title:'Error',msg:result.msg
							});
							log_err(result.msg);
						};
					} catch (exception) {		
						$('#dg<?=$var_ctrl?>').datagrid('reload');	 
					}
				},
				error: function(msg){$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
			});         
		});
	}
}
function edit_<?=$var_ctrl?>(){
	var row = $('#dg<?=$var_ctrl?>').datagrid('getSelected');
	if(row){
		<?=$fnc_edit?>
	}
	$('#dlg<?=$var_ctrl?>').dialog('open');	
}
function filter_<?=$var_ctrl?>(){
	$('#dg<?=$var_ctrl?>').datagrid('reload');
}
function print_<?=$var_ctrl?>(){
	
}
function reload_<?=$var_ctrl?>(){
	$('#dg<?=$var_ctrl?>').datagrid('reload');
	
}
function save_<?=$var_ctrl?>(){
	$('#frm<?=$var_ctrl?>').form('submit',{
		url: '<?=base_url()."index.php/".$var_ctrl?>/save/<?=$class_name?>',
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				$("#mode").val("add");
				$('#dlg<?=$var_ctrl?>').dialog('close');
				log_msg('Data sudah tersimpan. Silahkan direload untuk melihat data terbaru.');
			} else {
				log_err(result.msg);
			}
		},
		error: function(result) {
			log_err(result);			
		}
	});	
}
</script>
<!-- DIALOG SHOW -->
<div id='dlg<?=$var_ctrl?>' class="easyui-dialog"
	style="width:600px;height:400px;padding:10px 20px;top:100px;left:100px;top:20px" title="<?=ucfirst($controller)?>"
	closed="true" modal="true" buttons="#tbDlg<?=$var_ctrl?>">
	<table class='table2' width="100%">
		<tr>
		<? 
			echo form_open('',array("action"=>$url."/save","name"=>"frm".$var_ctrl,
				"id"=>"frm".$var_ctrl));
			for($i=0;$i<count($fields);$i++) { 
				$field=$fields[$i];
				if(is_object($field)){
					$fieldname=$field->Name;
				} else {
					$fieldname=$field;
				}
				$field_caption=ucfirst($fieldname);
				echo "<tr><td align='right'><strong>$field_caption</strong></td><td>";
				if(strpos($type,"date")!==false){
					echo "<input type='text' class='easyui-datetimebox'
						name='$fieldname' value='".date("Y-m-d H:i:s")."'
						id='$fieldname' style='80%'> 
						data-options='formatter:format_date,parser:parse_date'
						";
				} else {
					if($fieldname=="id"){
						echo "<input type='text' readonly style='width:100%' 
						name='$fieldname' value='' id='$fieldname'>";						
					} else {
						echo "<input type='text' style='width:100%' 
						name='$fieldname' value='' id='$fieldname'>";
					}
				}				
			}
			echo "<tr><td></td><td><input type='hidden' id='mode' name='mode' value=''></td></tr>";		
			echo form_close();
		?>
		</tr>
	</table>
</div>
<div id="tbDlg<?=$var_ctrl?>">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="save_<?=$var_ctrl?>()">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$var_ctrl?>').dialog('close')">Cancel</a>
</div>
<!-- END DIALOG -->
<script language="javascript">
	(function($){
			function pagerFilter(data){
				if ($.isArray(data)){	// is array
					data = {
						total: data.length,
						rows: data
					}
				}
				var dg = $(this);
				var state = dg.data('datagrid');
				var opts = dg.datagrid('options');
				if (!state.allRows){
					state.allRows = (data.rows);
				}
				var start = (opts.pageNumber-1)*parseInt(opts.pageSize);
				var end = start + parseInt(opts.pageSize);
				data.rows = $.extend(true,[],state.allRows.slice(start, end));
				return data;
			}

			var loadDataMethod = $.fn.datagrid.methods.loadData;
			$.extend($.fn.datagrid.methods, {
				clientPaging: function(jq){
					return jq.each(function(){
						var dg = $(this);
                        var state = dg.data('datagrid');
                        var opts = state.options;
                        opts.loadFilter = pagerFilter;
                        var onBeforeLoad = opts.onBeforeLoad;
                        opts.onBeforeLoad = function(param){
                            state.allRows = null;
                            return onBeforeLoad.call(this, param);
                        }
						dg.datagrid('getPager').pagination({
							onSelectPage:function(pageNum, pageSize){
								opts.pageNumber = pageNum;
								opts.pageSize = pageSize;
								$(this).pagination('refresh',{
									pageNumber:pageNum,
									pageSize:pageSize
								});
								dg.datagrid('loadData',state.allRows);
							}
						});
                        $(this).datagrid('loadData', state.data);
                        if (opts.url){
                        	$(this).datagrid('reload');
                        }
					});
				},
                loadData: function(jq, data){
                    jq.each(function(){
                        $(this).data('datagrid').allRows = null;
                    });
                    return loadDataMethod.call($.fn.datagrid.methods, jq, data);
                },
                getAllRows: function(jq){
                	return jq.data('datagrid').allRows;
                }
			})
		})(jQuery); 	 
		
		$(function(){
			$('#dg<?=$var_ctrl?>').datagrid('clientPaging');
		});
</script>