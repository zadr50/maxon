<!-- DIALOG FOR LOOKUP -->
<?php

    if(!isset($show_date_range))$show_date_range=false;


?>
<div id='dlg<?=$dlgId?>' class="easyui-dialog"  background='black'
style="width:<?=$dlgWidth?>;height:<?=$dlgHeight?>;padding:5px 5px;
"
closed="true"  toolbar="#<?=$dlgTool?>"
>
	<table id="dg<?=$dlgId?>" class="easyui-datagrid"  
	data-options="toolbar: '', singleSelect: true, fitColumns: true,
		url: ''">
		<thead>
			<tr>
			<?php foreach($dlgCols as $col) { 
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
</div>
<div id="<?=$dlgTool?>" class='box-gradient'>
    <?php 
        if(isset($show_date_range)){
            if($show_date_range){
                echo "Date:";
                echo form_input($dlgId.'_date_from',date("Y-m-d"),'id='.$dlgId.'_date_from  
                    class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                    ');
                echo form_input($dlgId.'_date_to',date("Y-m-d"),'id='.$dlgId.'_date_to  
                    class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                    ');
            }
        }    
            
    ?>
	Find: <input  id="dlg<?=$dlgId?>_search_id" style='width:180' 
	name="dlg<?=$dlgId?>_search_id">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  
		onclick="dlg<?=$dlgId?>_search();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"   
		onclick="dlg<?=$dlgId?>_select();return false;">Select</a>
</div>

<script type="text/javascript">
	var idd='';
	var fnc_after_select="";
	function dlg<?=$dlgId?>_show(subEvent) {
	    //fnc_after_select=subEvent;
        //var mainEvent = subEvent ? subEvent : window.event;
        //var x=mainEvent.screenX;
        //var y=mainEvent.screenY;    
        
		idd="<?=$dlgBindId?>";
		
        //$('#dlg<?=$dlgId?>').window({left:10,top:window.event.clientY});  
		$('#dlg<?=$dlgId?>').dialog('open').dialog('setTitle','<?=$dlgTitle?>');
		search_id=$('#dlg<?=$dlgId?>_search_id').val();

		from="";
		to="";
		
		<?php if($show_date_range) { ?>
		  from=$("#<?=$dlgId?>_date_from").datetimebox('getValue'); 
            to=$("#<?=$dlgId?>_date_to").datetimebox('getValue'); 
        <?php } ?>
        
		var vUrl='<?=$dlgUrlQuery?>/'+search_id+"?from="+from+"&to="+to;
		$('#dg<?=$dlgId?>').datagrid({url:vUrl});
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
	
</script>
<!-- END DIALOG -->