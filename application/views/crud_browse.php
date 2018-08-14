<?php 
$url=base_url()."index.php/crud";
if(!isset($field_key))$field_key="id";
?>
<script language="javascript">
</script>
<?php if($show_box) { ?>
<div class="easyui-panel themes" data-options="iconCls:'icon-more',
	closable:true,collapsible:true,minimizable:true,maximizable:true" 
	title='Data Table'>
	
	
<?php } ?>

<table id="dg<?=$hwnd?>" class="easyui-datagrid "  title="<?=$title?>"
	data-options="iconCls: 'icon-edit',pagination:true,pageSize:10,
		singleSelect: true, fitColumns: false,  method: 'get', 
		url: '<?=$url?>/browse_data/<?=$hwnd?>',toolbar:'#tb<?=$hwnd?>'
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
			$width=80;
            
            if(isset($column_width)){
                for($ic=0;$ic<count($column_width);$ic++){
                    if(strtolower($column_width[$ic]['field'])==strtolower($fieldname)){
                        $width=$column_width[$ic]['width'];
                        break;
                    }
                    
                }
            }
            
			$header=ucfirst($fieldname);
            $field_col="field: '$fieldname', width:'$width'";
            if(isset($column_numeric)){
                for($ic=0;$ic<count($column_numeric);$ic++){
                    if(strtolower($column_numeric[$ic])==strtolower($fieldname)){
                        $field_col=col_number($fieldname,2);
                        break;
                    }
                    
                }
            }
            echo "<th data-options=\"$field_col\">$header</th>";
			
		} 
		?>
		</tr>
	</thead>
</table>

<?php if($show_box) echo "</div>" ?>

<div id="tb<?=$hwnd?>">
    <?php 
    echo link_button('Add',"new_$hwnd();return false;",'add');
    echo link_button('Delete',"delete_$hwnd();return false;",'remove');
    echo link_button('Edit',"edit_$hwnd();return false;",'edit');
    echo link_button('Filter',"filter_$hwnd();return false;",'filter');
    echo link_button('Print',"print_$hwnd();return false;",'print');
    echo link_button('Reload',"reload_$hwnd();return false;",'reload');
    echo " Find: <input type='text' id='tb_search_$hwnd'>";
    echo link_button('Find',"find_$hwnd();return false;",'search');
    if(isset($other_buttons)){
        echo $other_buttons;
    }
    echo "<p><i>Silahkan klik tombol diatas [$hwnd]</i></p>";
	?>	
</div>

<script language="javascript">
function new_<?=$hwnd?>(){
    var URL="<?=$url?>";
    var FIELD_KEY="<?=$field_key?>";
    var HWND="<?=$hwnd?>";
	<?php 
    echo "$('#mode').val('add');";
	for($i=0;$i<count($fields);$i++) { 
		$field=$fields[$i];
		if(is_object($field)){
			$fieldname=$field->Name;
		} else {
			$fieldname=$field;
		}
		echo "$('#".$fieldname."').val('');";
	}
	?>
    //$('#dlg'+HWND).window({left:window.event.clientX-10,top:window.event.clientY-10});	
	$('#dlg'+HWND).dialog('open');	
}
function delete_<?=$hwnd?>(){
    var URL="<?=$url?>";
    var FIELD_KEY="<?=$field_key?>";
    var HWND="<?=$hwnd?>";
	var row = $('#dg'+HWND).datagrid('getSelected');
	var data = $('#dg'+HWND).datagrid('getData');
	console.log(data);
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to remove this line ?',function(r)
		{
			if(!r)return false;
			xurl=URL+'/delete/'+HWND+'/'+row.id;                        
			$.ajax({
				type: "GET",	url: xurl,
				success: function(result){
				try {
						var result = eval('('+result+')');
						if(result.success){
							$.messager.show({
								title:'Success',msg:result.msg
							});
							$('#dg'+HWND).datagrid('reload');	 
						} else {
							$.messager.show({
								title:'Error',msg:result.msg
							});
							log_err(result.msg);
						};
					} catch (exception) {		
						$('#dg'+HWND).datagrid('reload');	 
					}
				},
				error: function(msg){$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
			});         
		});
	}
}
function edit_<?=$hwnd?>(){
    var URL="<?=$url?>";
    var FIELD_KEY="<?=$field_key?>";
    var HWND="<?=$hwnd?>";
	var row = $('#dg'+HWND).datagrid('getSelected');
    var data = $('#dg'+HWND).datagrid('getData');
    console.log(data);
	if(row){
		<?=$fnc_edit?>
	}
    //$('#dlg'+HWND).window({left:window.event.clientX-10,top:window.event.clientY-10});  
	$('#dlg'+HWND).dialog('open');	
}
function filter_<?=$hwnd?>(){
    var URL="<?=$url?>";
    var FIELD_KEY="<?=$field_key?>";
    var HWND="<?=$hwnd?>";
	$('#dg'+HWND).datagrid('reload');
}
function print_<?=$hwnd?>(){
	
}
function reload_<?=$hwnd?>(){
    var URL="<?=$url?>";
    var FIELD_KEY="<?=$field_key?>";
    var HWND="<?=$hwnd?>";
	$('#dg'+HWND).datagrid('reload');
	
}
function save_<?=$hwnd?>(){
    var URL="<?=$url?>";
    var FIELD_KEY="<?=$field_key?>";
    var HWND="<?=$hwnd?>";
    var url2=URL+"/save/"+HWND;
    console.log(url2);
	$('#frm'+HWND).form('submit',{
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				$("#mode").val("add");
				$('#dlg'+HWND).dialog('close');
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
    function find_<?=$hwnd?>(){
        var URL="<?=$url?>";
        var FIELD_KEY="<?=$field_key?>";
        var HWND="<?=$hwnd?>";
        xurl=URL+'/browse_data/<?=$hwnd?>?tb_search='+$("#tb_search_"+HWND).val();
        $('#dg'+HWND).datagrid({url:xurl});
    }

</script>

<script language="javascript">
	(function($){
			function pagerFilter<?=$hwnd?>(data){
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
                        opts.loadFilter = pagerFilter<?=$hwnd?>;
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
            var URL="<?=$url?>";
            var FIELD_KEY="<?=$field_key?>";
            var HWND="<?=$hwnd?>";
			$('#dg'+HWND).datagrid('clientPaging<?=$hwnd?>');
		});
</script>



<!-- DIALOG SHOW -->
<div id='dlg<?=$hwnd?>' class="easyui-dialog"
    style="width:600px;height:400px;padding:10px 20px;top:100px;left:100px;top:20px" 
    title="<?=ucfirst($table)?>"
    closed="true" modal="true" buttons="#tbDlg<?=$hwnd?>">
    <?php
            echo form_open($url."/save/".$hwnd,"method='post' name='frm$hwnd' id='frm$hwnd'");
    ?>
    <table class='table2' width="100%">
        <tr>
        <? 
            for($i=0;$i<count($fields);$i++) { 
                $field=$fields[$i];
                if(is_object($field)){
                    $fieldname=$field->Field;
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
        ?>
        </tr>
    </table>
    <?php        echo form_close(); ?>
</div>
<div id="tbDlg<?=$hwnd?>">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="save_<?=$hwnd?>()">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$hwnd?>').dialog('close')">Cancel</a>
</div>
<!-- END DIALOG -->

