<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head><title>MaxOn ERP Online Demo</title>
<?
echo $library_src;
echo $script_head;
if(!isset($visible_right))$visible_right="True";
if(!isset($_left_menu))$_left_menu="";
if(!isset($_right_menu))$_right_menu="";
 
?>
	
<?
	if(!isset($_left_menu_caption))$_left_menu_caption='Left Menu';
	if(!isset($message))$message="";
?> 
<script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>
</head>
<body>
<div class="container" >
	 
	<div class="row" style="background-repeat:no-repeat; background-image:url('<?=base_url()?>images/header2.jpg')">
		<img src="<?=base_url()?>images/logo_maxon.png">
		<?=$_header?>
	</div>
	
	<div class="row-fluid">
		<div class="col-md-15" style="margin-top:10px"> 
			<table id="dg<?=$table_name?>" title="<?=$table_name?>" 
		-		class="easyui-datagrid table" style="width:auto;height:450px"
			        url="<?=base_url()?>index.php/run/data/<?=$table_name?>"
			        toolbar="#tb<?=$table_name?>"
			        rownumbers="true" fitColumns="true" singleSelect="true">
			    <thead>
			    	<?=$fields?>
			    </thead>
			</table>
			<div id="tb<?=$table_name?>">
			    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="new<?=$table_name?>()">New</a>
			    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="edit<?=$table_name?>()">Edit</a>
			    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="destroy<?=$table_name?>()">Remove</a>
			</div>

		</div> 
		<? if($visible_right!=""){?>
    	<div id="__section_right" class="col-md-3"  style="margin-top:10px">
			<div class="thumbnail">
				<?
				echo $this->access->print_info();
				echo "</br>".date('l jS \of F Y h:i:s A');
				?>
			</div>
			<div class="thumbnail">
				<?=$_right_menu?>
			</div>
			<div class="thumbnail">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="3B2BALTFG7KWQ">
				<input type="image" src="<?=base_url()?>images/donation.png" style="width:165px!important;" width="165px" height="auto" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			</div>
			<div class="thumbnail"><div class="easyui-calendar" ></div></div>
		</div>	
		<? } ?>
	</div>
	<div class="row-fluid"><div class="thumbnail"><?=$_footer?></div></div>

</div>  

<div id="dlg<?=$table_name?>" class="easyui-dialog" style="width:600px;height:450px;left:100px;top:20px;padding:5px 5px"
        closed="true" buttons="#dlg-buttons-<?=$table_name?>">
    <div class="ftitle"><?=$table_name?></div>
    <form id="fm<?=$table_name?>" method="post">
    	<input type="hidden" name="field_key_name" id="field_key_name" value="<?=$field_key_name?>">
    	<input type="hidden" name="field_key" id="field_key" value="<?=$field_key?>">
    	<input type="hidden" name="mode" id="mode">
    	<?=$fields_input?>
    </form>
</div>
<div id="dlg-buttons-<?=$table_name?>">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="save<?=$table_name?>()">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$table_name?>').dialog('close')">Cancel</a>
</div>

<script>
	var url='<?=base_url()?>index.php/run/table/<?=$table_name?>';
	function new<?=$table_name?>(){
	    $('#dlg<?=$table_name?>').dialog('open').dialog('setTitle','New <?=$table_name?>');
	    $('#fm<?=$table_name?>').form('clear');
	    $('#mode').val('add');
	    $('#field_key_name').val('<?=$field_key_name?>');
	    url = '<?=base_url()?>index.php/run/save/<?=$table_name?>';
	}
	function edit<?=$table_name?>(){
	    $('#mode').val('view');
		var row = $('#dg<?=$table_name?>').datagrid('getSelected');
		if (row){
		    $('#dlg<?=$table_name?>').dialog('open').dialog('setTitle','Edit User');
		    $('#fm<?=$table_name?>').form('load',row);
		    $('#field_key_name').val('<?=$field_key_name?>');
		    $('#field_key').val('<?=$field_key_name?>');
		}
	    url = '<?=base_url()?>index.php/run/save/<?=$table_name?>';
	}
	function save<?=$table_name?>(){
	    $('#fm<?=$table_name?>').form('submit',{
	        url: url,
	        onSubmit: function(){
	            return $(this).form('validate');
	        },
	        success: function(result){
	            var result = eval('('+result+')');
	            if (result.errorMsg){
	                $.messager.show({
	                    title: 'Error',
	                    msg: result.errorMsg
	                });
	            } else {
				    $('#mode').val('view');
	                $('#dlg<?=$table_name?>').dialog('close');        // close the dialog
	                $('#dg<?=$table_name?>').datagrid('reload');    // reload the user data
	            }
	        }
	    });
	}	
	function destroy<?=$table_name?>(){
	    var row = $('#dg<?=$table_name?>').datagrid('getSelected');
	    if (row){
	        $.messager.confirm('Confirm','Are you sure you want to destroy this row?',function(r){
	            if (r){
	            	url = '<?=base_url()?>index.php/run/delete/<?=$table_name?>';
	                $.post(url,{id:row.<?=$field_key_name?>,field_key_name:'<?=$field_key_name?>'},function(result){
	                    if (result.success){
	                        $('#dg<?=$table_name?>').datagrid('reload');    // reload the user data
	                    } else {
	                        $.messager.show({    // show error message
	                            title: 'Error',
	                            msg: result.errorMsg
	                        });
	                    }
	                },'json');
	            }
	        });
	    }
	}

</script>
</body>
