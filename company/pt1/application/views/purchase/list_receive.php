<div>
    <?=$list_receive?>
</div>
<div id="cmdButtons">
    <a href="#" class="easyui-linkbutton" 
    data-options="iconCls:'icon-edit'"
    onclick='view()'>View</a>
    <a href="#" class="easyui-linkbutton" 
    data-options="iconCls:'icon-remove'"
    onclick='del_row()'>Delete</a>    
</div>
<div id="divRecvItems"></div>
<script type="text/javascript">
    function view()
    {
        row = $('#dgItem').datagrid('getSelected');
        if (row){
            $('#divRecvItems').fadeIn('slow'); 
            get_this(CI_ROOT+'receive_po/view/'+row['shipment_id']
               ,'','divRecvItems');
        }
    }
    function del_row()
    {
        row = $('#dgItem').datagrid('getSelected');
        if(row){
            url=CI_ROOT+'receive_po/delete_receive/'+row['shipment_id'];
            get_this(url,'','divRecvItems');
            url=CI_ROOT+'purchase_order/view_receive/<?=$purchase_order_number?>';
            console.log(url);
            window.open(url,'_self');
            
        }
        
    }
</script>    