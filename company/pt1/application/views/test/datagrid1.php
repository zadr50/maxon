<div class="thumbnail box-gradient">
	<?php
    $url=base_url("index.php/payroll");
		
	echo link_button('Print', 'print_this()','print');		
	echo link_button('Add','','add','false',$url.'/add');		
//    echo link_button('Delete','','remove','false',$url.'/delete/'.$tcid);       
	
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'employee\')','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	
	</div>
	
</div>
<?php 
    $msg=validation_errors();
    if($msg!=""){
        echo "<div class='alert alert-warning'>$msg</div>";
    }
?> 
    <table id="dgItem" height='400px'   width="100%"  class='easyui-datagrid'
          data-options="iconCls: 'icon-edit',rownumbers:true,pagination:true,method:'get',
            singleSelect: true,toolbar: '#tbItem',fitColumns: false" >
        <thead>
            <tr>
               <th data-options="field:'nip',width:'80'">NIP</th>
               <th data-options="field:'nama',width:'150', editor:'text'">Nama</th>
               <th data-options="field:'alamat',width:'150', editor:'text'">Alamat</th>
            </tr>
        </thead>
</table>    
<script type="text/javascript">
    
    var _url="<?=$url?>";
    
    $(document).ready(function(){
         load_items();
        $("#dgItem").datagrid('clientPaging');
    })
    


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
                
    
    
    function load_items(){        
        $('#dgItem').edatagrid({
            url: _url+'/employee/browse_data',
            saveUrl: _url+'/employee/save',
            updateUrl:_url+'/employee/update',
            destroyUrl:_url+'/employee/delete'
        });        
        
    }    

            function pagerFilter(data){
                if ($.isArray(data)){   // is array
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

            

</script>  

 
 