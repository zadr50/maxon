<div id='dgItemForm' class="easyui-dialog" 
    style="width:500px;height:400px;padding:5px 5px"
    closed="true" buttons="#tbItemForm" >
    <form id="frmItem" method='post' >
            <table class='table' style='width:250px;float:left'>
             <tr><td >Kode Barang</td><td colspan='3'><input onblur='find()' id="item_number" style='width:180px' 
                name="item_number"   class="easyui-validatebox" required="true">
                <a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
                onclick="searchItem();return false;"></a>
             </td>
             
             </tr>
             <tr><td>Nama Barang</td><td colspan='3'><input id="description" name="description" style='width:300px'></td></tr>
             <tr><td>Qty</td><td><input id="quantity"  style='width:60px'  name="quantity" onblur="hitung()">
             Unit <input id="unit" name="unit"  style='width:60px' >
            <a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
                onclick="searchUnit();return false;" 
                style='display:none' id='cmdLovUnit'></a> 
             </td></tr>
             <tr><td>Id</td><td><input id="id"  style='width:60px'  name="id"></tr>
            </table>
    </form>
</div>
<div id="tbItemForm">
    <a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
        onclick='close_item();return false;' title='Close'>Cancel</a>
    <a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
        onclick='save_item();return false;' title='Save Item'>Submit</a>
</div>
