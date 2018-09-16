<table id="dgItemCoa" class="easyui-datagrid"  width='100%'
    data-options="
        iconCls: 'icon-edit', fitColumns: true,
        singleSelect: true,
        toolbar: '#tb',  
        url: '<?=$url_data?>'
    ">
    <thead>
        <tr>
            <th data-options="field:'account',editor:'text',width:'80'">Kode Akun</th>
            <th data-options="field:'description',editor:'text',width:'200'">Nama Perkiraan</th>
            <th data-options="field:'amount',width:'80',editor:'text',align:'right'">Amount</th>
            <th data-options="field:'invoice_number',width:'80',editor:'text'">Invoice</th>
            <th data-options="field:'org_id',width:'80',editor:'text'">Dept</th>
            <th data-options="field:'comments',width:'100',editor:'text'">Comments</th>
            <th data-options="field:'line_number',width:'30'">Line</th>
        </tr>
    </thead>
</table>
<div id="tb" style="height:auto">
    <div id="tbItem" class='box-gradient'>
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem();return false;">Add</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem();return false;">Edit</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem(); return false;">Delete</a>  
        <?=link_button("Refresh", "load_item();return false","reload")?>
    </div>    
</div>

<div id='dlgItem' class="easyui-dialog"  background='black'
    style="width:600px;height:400px;padding:5px 5px;top:10px"
    closed="true" buttons='#btnItem'>
    <form method='post' id='frmItem'>
    <input type='hidden' id='line_number' name='line_number'>
    <input type='hidden' id='voucher_item' name='voucher_item'>
    <table class='table2' width='100%'>
        <tr>
            <td>Kode</td><td><input type='text' id='account' name='account' style='width:80px'>
                <?=link_button('','lookup_coa()','search')?></td>
        </tr>
        <tr>
            <td>Nama Perkiraan</td><td><input type='text' id='description' name='description' style='width:300px'></td>
        </tr>
        <tr>
            <td>Jumlah</td><td><input type='text' id='amount' name='amount' ></td>
        </tr>
        <tr>
            <td>Department</td><td><input type='text' id='org_id_item' name='org_id_item' style='width:80px'>
                <?=link_button('','dlgdepartments_show()','search')?></td>
        </tr>
        <tr>
            <td>Invoice</td><td><input type='text' id='invoice_number' name='invoice_number' ></td>
        </tr>
        <tr>        
            <td>Catatan</td><td><input type='text' id='comments' name='comments' style='width:300px'></td>
        </tr>
    </table>
    </form>    
</div>    
<div id='btnItem'>
     <?=link_button('Submit','save_item()','save')?>    
     <?=link_button('Cancel','cancel_item()','cancel')?>    
</div>
<script>
    $().ready(function (){
        $('#dgItemCoa').datagrid({
            onDblClickRow:function(){
            	editItem();
            }
        });        
        load_item();
    });
	
</script>