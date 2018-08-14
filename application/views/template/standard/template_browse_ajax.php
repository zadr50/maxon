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
		
    function addnew(){
        xurl=CI_ROOT+CI_CONTROL+'/add';
        window.open(xurl,'_self');
    };
    function edit(modal){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+CI_CONTROL+'/view/'+row[FIELD_KEY];
            console.log(xurl);
            //alert(not_dialog==='undefined');
            if(modal){
                //$('#dlg').html(''); //clear dulu biar tidak nambah terus
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
                window.open(xurl,'_self');
            }
        } else {
            $.messager.alert('Info','Pilih satu baris dulu !');
        }
    }
    function del_row(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
	                xurl=CI_ROOT+CI_CONTROL+'/delete/'+row[FIELD_KEY];                             
	//                            console.log(xurl);
	                xparam='';
	                $.ajax({
	                        type: "GET",
	                        url: xurl,
	                        param: xparam,
	                        success: function(msg){
								$('#dg').datagrid('reload');	// reload the user data
	                        },
	                        error: function(msg){$.messager.alert('Info',msg);}
	                });         
				});
			}    	
	}
    function cari(){
        $('#dlg').remove();
        search=$('#search').val();
        xurl=CI_ROOT+CI_CONTROL+'/browse/?search='+search;
        window.open(xurl,'_self');
    }
    
</script>
<div id="dlg" style="padding:5px;height:auto">
    
</div>


 <div id="tb" style="padding:5px;height:auto">
		<div >
			
			<a href="#" onclick="addnew(false);return false;" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>
			<a href="#" onclick="edit(false);return false;" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
			<a href="#" onclick="del_row();return false;"  class="easyui-linkbutton" iconCls="icon-remove" plain="true">Remove</a>
			
		</div>
		<div>
			Search : <input value="<?=$search?>" id="search" class="easyui-input" style="width:80px">
			<a href="#" onclick="cari();return false;" class="easyui-linkbutton" iconCls="icon-search"  plain="true" >Search</a>
		</div>
</div>   
<?php echo $_content;?>	

