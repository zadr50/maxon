<!-- DIALOG FOR LOOKUP [<?=$dlgId?>]-->
<?php
	if(!isset($show_check1))$show_check1=false;
    if(!isset($show_date_range))$show_date_range=false;
    if(!isset($show_checkbox))$show_checkbox=false;
    if(!isset($url_submit))$url_submit="";
    if(!isset($extra_fields))$extra_fields="";
    if(!isset($before_submit)){
    	$before_submit="function before_submit_$dlgId(){return false;}";
	}
    if(!isset($dlgTitle)){
    	$dlgTitle="Information";    
	}
	if(!isset($show_check1)){
		$show_check1=false;
		$check1_title="";
		$check1_field="";
	}
    if($show_checkbox=="")$show_checkbox=false;
    $before_lookup="";
    if(isset($dlgBeforeLookup)){
    	$before_lookup=$dlgBeforeLookup;
	}
    $fields['']='';
?>
<div id='dlg<?=$dlgId?>' class="easyui-dialog"  background='black'
    style="width:<?=$dlgWidth?>px;height:<?=$dlgHeight?>px;padding:5px 5px;"
    closed="true"  toolbar="#<?=$dlgTool?>" data-options="iconCls:'icon-search'"
>
<?php 
    if($show_checkbox)echo form_open($url_submit,"id='frmLovItem_$dlgId'"); 
    echo $extra_fields;
?>
	<table id="dg<?=$dlgId?>" class="easyui-datagrid"  style="min-height:90%"
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
                $fields[$fieldname]=ucwords($caption);
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
            echo " <b>Select All: </b> <input type='checkbox' style='width:20px' id='select_all_$dlgId'> ";
        }
        if($show_date_range){
            echo "<b>Date: </b>";
            echo form_input($dlgId.'_date_from',date("Y-m-1"),'id='.$dlgId.'_date_from  
                class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                ');
            echo form_input($dlgId.'_date_to',date("Y-m-d 23:59:59"),'id='.$dlgId.'_date_to  
                class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                ');
        }
        if($show_check1){
			echo "<b>$check1_title: </b> <input type='checkbox'  id='".$dlgId."_check1' name='".$dlgId."_check1'  
				title='Filter by related selected $check1_title' style='width:30px'>";
        	
        } 
    ?>
    	
		
		
    <b>Sort:</b> <?=form_dropdown($dlgId."_sort",$fields,"","id='".$dlgId."_sort' onchange='dlg".$dlgId."_sort_by();return false;'")?>
    <?php 
        if($show_checkbox || $show_date_range || $show_check1) echo "</br>";   
    ?>

	<b>Find:</b> <input  id="dlg<?=$dlgId?>_search_id" style='width:180' 
	name="dlg<?=$dlgId?>_search_id"  onchange='<?='dlg'.$dlgId.'_search();return false;'?>'>
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  
		onclick="<?="dlg".$dlgId."_search();return false;"?>">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"   
		onclick="<?='dlg'.$dlgId.'_select();return false;'?>">Select</a>
		
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel"   
        onclick="<?='dlg'.$dlgId.'_close();return false;'?>">Close</a>	    
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
            onClickRow:function(){
                var row = $('#dg<?=$dlgId?>').datagrid('getSelected');
                if (row){
                    <?=$dlgRetFunc?>
                    $('#dlg<?=$dlgId?>').dialog('close');
                    <?='dlg'.$dlgId.'_find();'?>
                }       
            }
        });        
        
        <?php if($show_checkbox){ ?>
            filterItemIsc();
        <?php } ?>
        
        
    });
    
	<?php 
		echo $before_submit;
      	$before_submit=""; //reset blank 
	?>
	function <?='dlg'.$dlgId.'_sort_by()'?>{
	    <?='dlg'.$dlgId.'_search();'?>
	}
	function <?='dlg'.$dlgId.'_show(subEvent)'?> {
	    //Firefox tidak punya window.event jadi di offkan dulu
	    //fnc_after_select=subEvent;
        //var mainEvent = subEvent ? subEvent : window.event;
        //var w=<?=$dlgWidth?>;
        //var x=screen.width*0.5-w*0.5;
        //var y=mainEvent.screenY/2;
        <?php    
			if($before_lookup!=""){
			    echo $before_lookup;
                $before_lookup="";
	        } 
        ?>

		<?='dlg'.$dlgId.'_search();'?>        
		
		idd_<?=$dlgId?>="<?=$dlgBindId?>";
        $("#dlg<?=$dlgId?>_search_id").focus();		
        $('#dlg<?=$dlgId?>').window({left:10,top:10});  
		$('#dlg<?=$dlgId?>').dialog('open').dialog('setTitle','<?=$dlgTitle?>');
	}
	function submit_selected_<?=$dlgId?>(){
        loading();
        before_submit_<?=$dlgId?>();
            $('#frmLovItem_<?=$dlgId?>').form('submit',{
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                loading_close();
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
	function <?='dlg'.$dlgId.'_select()'?> {
	    if (show_checkbox_<?=$dlgId?>){
	        submit_selected_<?=$dlgId?>();
	    } else {
    		var row = $('#dg<?=$dlgId?>').datagrid('getSelected');
    		if (row){
    			<?=$dlgRetFunc?>
    			$('#dlg<?=$dlgId?>').dialog('close');
                <?='dlg'.$dlgId.'_find();'?>
    		}		
		}	
	}
	function <?='dlg'.$dlgId.'_search()'?>{
		var search_id=$('#dlg<?=$dlgId?>_search_id').val();
        var sort=$("#<?=$dlgId?>_sort").val();
		var check1="";
		var check1_value="";
		
        var from="";
        var to="";
        
        var q1="",q2="",q3="";
        
        <?php    
			if($before_lookup!=""){
			    echo $before_lookup;
                $before_lookup="";
	        } 
        ?>
        
        <?php 
        	if($show_date_range) { ?>
        		
    	from=$("#<?=$dlgId?>_date_from").datetimebox('getValue'); 
    	to=$("#<?=$dlgId?>_date_to").datetimebox('getValue'); 
    	
        <?php } ?>
        
        <?php 
        	if($show_check1) {
        		echo "check1=$('#".$dlgId."_check1').is(':checked') ? 1 : 0; ";
				echo "check1_value=$('#".$check1_field."').val(); ";
        	}
		?>

        var vUrl='<?=$dlgUrlQuery?>/?tb_search='+search_id+"&from="+from+"&to="+to+"&sort="+sort+"&check1="+check1+"&check1_value="+check1_value+"&q1="+q1+"&q2="+q2+"&q3="+q3;
        
        console.log(vUrl);
        
		$('#dg<?=$dlgId?>').datagrid({url:vUrl});
	}
    function <?='dlg'.$dlgId.'_list(filter="")'?>{
        var url='<?=base_url()?>index.php/lookup';
        if(filter!='')url=url+'?filter='+filter;
        add_tab_parent('Lookup: '+filter,url);
    }    
    function <?='dlg'.$dlgId.'_list_master()'?>{
        <?php
            if($modules=="")$modules=$dlgId;
        ?>
        var url='<?=base_url('index.php/'.$modules)?>';
        add_tab_parent('List: <?=$dlgId?>',url);
    }    
    function <?='dlg'.$dlgId.'_close()'?>{
        $('#dlg<?=$dlgId?>').dialog('close');        
    }
	
//filter with checkbox
   function filterItemIsc(){
            nama=$('#search_item_isc').val();
            supplier=$("#supplier_number").val();
            only_item_supplier=$("#only_item_supplier_isc").is(':checked')
            param="?only_item_supplier="+only_item_supplier+"&";
            if(supplier!="")param=param+"supplier="+supplier;
            field=$("#tb_field_isc").val();
            if(field!="")param=param+"&field="+field;

            req_no=$("#req_no").val();
            param=param+"&req_no="+req_no;
            
            vUrl='<?=base_url()?>index.php/inventory/filter/'+nama+param;
            $('#dgItemSearchIsc').datagrid({url:vUrl});	           
   }

	function searchItemIsc(){
		$('#dlgSearchItemIsc').dialog('open')
			.dialog('setTitle','Cari data barang');

		}
	function dlgSearchItemIsc_Close(){
			$("#dlgSearchItemIsc").dialog("close");
	}

	
	
</script>
<!-- END DIALOG -->
