<!-- DIALOG FOR LOOKUP -->
<?php
    
    if(!isset($show_date_range))$show_date_range=false;
    if(!isset($show_checkbox))$show_checkbox=false;
    if(!isset($url_submit))$url_submit="";
    if(!isset($extra_fields))$extra_fields="";
    if(!isset($before_submit))$before_submit="function before_submit(){return false;}";
?>
<div id='dlg<?=$dlgId?>' class="easyui-dialog"  background='black'
style="width:<?=$dlgWidth?>;height:<?=$dlgHeight?>;padding:5px 5px;
"
closed="true"  toolbar="#<?=$dlgTool?>"
>
<?php if($show_checkbox)echo form_open($url_submit,"id='frmLovItem'"); 
echo $extra_fields;

?>
	<table id="dg<?=$dlgId?>" class="easyui-datagrid"  
	data-options="toolbar: '', singleSelect: true, fitColumns: true,
		url: '<?=$dlgUrlQuery?>'">
		<thead>
			<tr>
	      <?php 
            if($show_checkbox){
                echo "<th data-options=\"field:'ck',width:'70'\">Pilih</th>";
            }
			    foreach($dlgCols as $col) { 
				$fieldname=$col["fieldname"];
				$width=$col["width"];
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
            echo " Select All <input type='checkbox' style='width:50px' id='select_all'> ";
        }
        if($show_date_range){
            echo "Date:";
            echo form_input($dlgId.'_date_from',date("Y-m-1"),'id=\''.$dlgId.'_date_from\'  
                class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                ');
            echo form_input($dlgId.'_date_to',date("Y-m-d 23:59:59"),'id=\''.$dlgId.'_date_to\'  
                class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                ');
        }
            
    ?>
    
	Find: <input  id="dlg<?=$dlgId?>_search_id" style='width:180' 
	name="dlg<?=$dlgId?>_search_id" onchange='dlg<?=$dlgId?>_search();return false;'>
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  
		onclick="dlg<?=$dlgId?>_search();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"   
		onclick="dlg<?=$dlgId?>_select();return false;">Select</a>
</div>

<script type="text/javascript">
	var idd='';
	var show_checkbox="<?=$show_checkbox?>";
	var show_date_range="<?=$show_date_range?>";
	
	function dlg<?=$dlgId?>_show(subEvent) {
         var mainEvent = subEvent ? subEvent : window.event;
        var x=mainEvent.screenX;
        var y=mainEvent.screenY;    
		idd="<?=$dlgBindId?>";
        $('#dlg<?=$dlgId?>').window({left:10,top:window.event.clientY});  
		$('#dlg<?=$dlgId?>').dialog('open').dialog('setTitle','<?=$dlgTitle?>');
		//dialog('option', 'position', [x,y]);
		search_id=$('#dlg<?=$dlgId?>_search_id').val();
		$('#dg<?=$dlgId?>').datagrid({url:'<?=$dlgUrlQuery?>'+search_id});
		//$('#dg<?=$dlgId?>').datagrid('reload');
		
		$('#dg<?=$dlgId?>').datagrid({
            onDblClickRow:function(){
                var row = $('#dg<?=$dlgId?>').datagrid('getSelected');
                if (row){
                    <?=$dlgRetFunc?>
                    $('#dlg<?=$dlgId?>').dialog('close');
                }       
            }
        });       
        
        
	}
	function dlg<?=$dlgId?>_select() {
		var row = $('#dg<?=$dlgId?>').datagrid('getSelected');
		if (row){
			<?=$dlgRetFunc?>
			$('#dlg<?=$dlgId?>').dialog('close');
		}			
	}
	function dlg<?=$dlgId?>_search(){
		search_id=$('#dlg<?=$dlgId?>_search_id').val();
		if(show_date_range){
             date_from=$('#<?=$dlgId?>_date_from').datetimebox('getValue'); 
            date_to=$('#<?=$dlgId?>_date_to').datetimebox('getValue'); 
		    search_id=search_id+'?from='+date_from+'&to='+date_to;
		}
		$('#dg<?=$dlgId?>').datagrid({url:'<?=$dlgUrlQuery?>/'+search_id});
	}
</script>
<!-- END DIALOG -->