<!-- DIALOG FOR LOOKUP [<?=$dlgId?>]-->
<?php
    if(!isset($show_date_range))$show_date_range=false;
    if(!isset($show_checkbox))$show_checkbox=false;
    if(!isset($url_submit))$url_submit="";
    if(!isset($extra_fields))$extra_fields="";
    if(!isset($before_submit))$before_submit="function before_submit_$dlgId(){return false;}";
    if(!isset($dlgTitle))$dlgTitle="Information";    
    if($show_checkbox=="")$show_checkbox=false;
    $before_lookup="";if(isset($dlgBeforeLookup))$before_lookup=$dlgBeforeLookup;
?>
<div id='dlg<?=$dlgId?>' class="easyui-dialog"  background='black'
    style="width:<?=$dlgWidth?>px;height:<?=$dlgHeight?>px;padding:5px 5px;"
    closed="true"  toolbar="#<?=$dlgTool?>"
>
<?php 
    if($show_checkbox)echo form_open($url_submit,"id='frmLovItem_$dlgId'"); 
    echo $extra_fields;
?>
	<table id="dg<?=$dlgId?>" class="easyui-datagrid"  
	data-options="toolbar: '', singleSelect: true, fitColumns: true,
		pagination:true, url: ''">
		<thead>
			<tr>
			<?php 
			if($show_checkbox){
		        echo "<th data-options=\"field:'ck',width:'70'\">Pilih</th>";
			}
			foreach($dlgCols as $col) { 
				$fieldname=$col["fieldname"];
				if(!isset($col["width"]))$col['width']="80px";
				$width=$col["width"];
				if(!isset($col["caption"]))$col["caption"]=ucfirst($fieldname);
				$caption=$col["caption"];
			?> 
				<th data-options="field:'<?=$fieldname?>',
				width:'<?=$width?>'"><?=$caption?></th>
			<?php } ?>
			</tr>
		</thead>
	</table>
<?php if($show_checkbox)echo form_close(); ?>

</div>
<div id="<?=$dlgTool?>" class='box-gradient'>
    <?php 
        if($show_checkbox){
            echo " Select All <input type='checkbox' style='width:50px' id='select_all_$dlgId'> ";
        }
        if($show_date_range){
            echo "Date:";
            echo form_input($dlgId.'_date_from',date("Y-m-1"),'id='.$dlgId.'_date_from  
                class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                ');
            echo form_input($dlgId.'_date_to',date("Y-m-d 23:59:59"),'id='.$dlgId.'_date_to  
                class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                ');
        }
            
    ?>
	Find: <input  id="dlg<?=$dlgId?>_search_id" style='width:180' 
	name="dlg<?=$dlgId?>_search_id"  onchange='dlg<?=$dlgId?>_search();return false;'>
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  
		onclick="dlg<?=$dlgId?>_search();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"   
		onclick="dlg<?=$dlgId?>_select();return false;">Select</a>
		
	<div style="float:right">
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel"   
        onclick="dlg<?=$dlgId?>_close();return false;">Close</a>	    
	</div>	
</div>

<script type="text/javascript">
	var idd_<?=$dlgId?>='';
	var fnc_after_select_<?=$dlgId?>="";
	var show_checkbox_<?=$dlgId?>='<?=$show_checkbox?>';
	
    $().ready(function (){
        $('#select_all_<?=$dlgId?>').change(function() { 
            var checkboxes = $('#dlg<?=$dlgId?>').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        }); 
        $('#dg<?=$dlgId?>').datagrid({
            onDblClickRow:function(){
                var row = $('#dg<?=$dlgId?>').datagrid('getSelected');
                if (row){
                    <?=$dlgRetFunc?>
                    $('#dlg<?=$dlgId?>').dialog('close');
                }       
            }
        });        
        
        <?php if($show_checkbox){ ?>
            filterItemIsc();
        <?php } ?>
    });
    
	<?=$before_submit?>
	
	function dlg<?=$dlgId?>_show(subEvent) {
	    //Firefox tidak punya window.event jadi di offkan dulu
	    //fnc_after_select=subEvent;
        //var mainEvent = subEvent ? subEvent : window.event;
        //var w=<?=$dlgWidth?>;
        //var x=screen.width*0.5-w*0.5;
        //var y=mainEvent.screenY/2;    
        
		idd_<?=$dlgId?>="<?=$dlgBindId?>";
        $("#dlg<?=$dlgId?>_search_id").focus();
		
        $('#dlg<?=$dlgId?>').window({left:100,top:50});  
		$('#dlg<?=$dlgId?>').dialog('open').dialog('setTitle','<?=$dlgTitle?>');
		search_id=$('#dlg<?=$dlgId?>_search_id').val();

		from="";
		to="";
		
		<?php if($show_date_range) { ?>
		  from=$("#<?=$dlgId?>_date_from").datetimebox('getValue'); 
            to=$("#<?=$dlgId?>_date_to").datetimebox('getValue'); 
        <?php } ?>
        
		var vUrl='<?=$dlgUrlQuery?>/'+search_id+"?from="+from+"&to="+to;
		<?php if($before_lookup!=""){
		    echo $before_lookup;
        } 
        ?>
		$('#dg<?=$dlgId?>').datagrid({url:vUrl});
		
	}
	function submit_selected_<?=$dlgId?>(){
	       before_submit_<?=$dlgId?>();
            $('#frmLovItem_<?=$dlgId?>').form('submit',{
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $('#dg<?=$dlgId?>').datagrid('reload');
                    $.messager.show({title: 'Success',msg: 'Success'});
                    $('#dlg<?=$dlgId?>').dialog('close');
                    <?=$dlgRetFunc?>
                } else {
                    $.messager.show({title: 'Error', msg: result.msg});
                }
            }
        });

	}
	function dlg<?=$dlgId?>_select() {
	    if (show_checkbox_<?=$dlgId?>){
	        submit_selected_<?=$dlgId?>();
	    } else {
    		var row = $('#dg<?=$dlgId?>').datagrid('getSelected');
    		if (row){
    			<?=$dlgRetFunc?>
    			$('#dlg<?=$dlgId?>').dialog('close');
    		}		
		}	
	}
	function dlg<?=$dlgId?>_search(){
		search_id=$('#dlg<?=$dlgId?>_search_id').val();
        from="";
        to="";
        
        <?php if($show_date_range) { ?>
          from=$("#<?=$dlgId?>_date_from").datetimebox('getValue'); 
            to=$("#<?=$dlgId?>_date_to").datetimebox('getValue'); 
        <?php } ?>

        var vUrl='<?=$dlgUrlQuery?>/'+search_id+"?from="+from+"&to="+to;
        console.log(vUrl);
		$('#dg<?=$dlgId?>').datagrid({url:vUrl});
	}
    function dlg<?=$dlgId?>_list(){
        var url='<?=base_url()?>index.php/lookup';
        add_tab_parent('Lookup',url);
    }    
    function dlg<?=$dlgId?>_close(){
        $('#dlg<?=$dlgId?>').dialog('close');        
    }
	
</script>
<!-- END DIALOG -->