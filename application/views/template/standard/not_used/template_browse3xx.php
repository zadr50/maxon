<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head><title>MaxOn ERP Online Demo</title>
<?
echo $library_src;
echo $script_head;
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

<?
    if(!$this->access->is_login())redirect(base_url());
     
?>

<script type="text/javascript">
    function pagerFilter(data){
            if (typeof data.length == 'number' && typeof data.splice == 'function'){	// is array
                    data = {
                            total: data.length,
                            rows: data
                    }
            }
            var dg = $(this);
            var opts = dg.datagrid('options');
            var pager = dg.datagrid('getPager');
            pager.pagination({
                    onSelectPage:function(pageNum, pageSize){
                            opts.pageNumber = pageNum;
                            opts.pageSize = pageSize;
                            pager.pagination('refresh',{
                                    pageNumber:pageNum,
                                    pageSize:pageSize
                            });
                            dg.datagrid('loadData',data);
                    }
            });
            if (!data.originalRows){
                    data.originalRows = (data.rows);
            }
            var start = (opts.pageNumber-1)*parseInt(opts.pageSize);
            var end = start + parseInt(opts.pageSize);
            data.rows = (data.originalRows.slice(start, end));
            return data;
    }

		

    $(function(){		 
       $('#dg').datagrid({loadFilter:pagerFilter}).datagrid();        		
    })
    function addnew(){
        xurl=CI_ROOT+'<?=$table_name?>/add';
        xparam='';
        console.log(xurl);
        $('#dlg').dialog({  
            title: CI_CAPTION,  
            width: CI_WIDTH,  
            height: CI_HEIGHT,  
            closed: false,  
            cache: false,  
            href: xurl,  
            modal: true  
        });  
 
    };
    function edit(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'<?=$table_name?>/view/'+row[FIELD_KEY];
            console.log(xurl);
            $('#dlg').dialog({  
            title: CI_CAPTION,  
            width: CI_WIDTH,  
            height: CI_HEIGHT,  
            closed: false,  
            cache: false,  
            href: xurl,  
            modal: true  
        });      
        } else {
            $.messager.alert('Info','Pilih satu baris dulu !');
        }
    }
    function del_row(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
                            xurl=CI_ROOT+'<?=$table_name?>/delete/'+row[FIELD_KEY];                             
                            console.log(xurl);
                            xparam='';
                            $.ajax({
                                    type: "GET",
                                    url: xurl,
                                    param: xparam,
                                    success: function(msg){
                                        $('#main_content').html(msg);
                                    },
                                    error: function(msg){$.messager.alert('Info',msg);}
                            });         
			}
		}
    function cari(){
        search=$('#search').val();
        xurl=CI_ROOT+'run/table/<?=$table_name?>/<?=$field_key?>/'+search;
        console.log(xurl);
        xparam='search='+search;
        $.ajax({
                type: "GET",
                url: xurl,
                param: xparam,
                success: function(msg){
                    $('#main_content').html(msg);
                },
                error: function(msg){$.messager.alert('Info',msg);}
        });         
    }
    
</script>

<div id="dlg" style="padding:5px;height:auto">
    
</div>


 <div id="tb" style="padding:5px;height:auto">
		<div >
			<a href="#" onclick="addnew();return false;" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>
			<a href="#" onclick="edit();return false;" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
			<a href="#" onclick="del_row();return false;"  class="easyui-linkbutton" iconCls="icon-remove" plain="true">Remove</a>
		</div>
		<div>
			Search : <input id="search" class="easyui-input" style="width:80px">
			<a href="#" onclick="cari();return false;" class="easyui-linkbutton" iconCls="icon-search">Search</a>
		</div>
</div>   
<?php echo $_content;?>	