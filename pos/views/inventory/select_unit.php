<div id="tb_search_unit" style="height:auto" class="box-gradient">
    <div style="float:left">
    Enter Text: <input  id="search_unit" style='width:100px' name="search_item">
    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
    onclick="searchUnit();return false;">Search</a>        
    </div>
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selectSearchUnit();return false;">Select</a>
</div>

<div id='dlgSearchUnit' class="easyui-dialog" style="width:500px;height:380px;;left:100px;top:20px"
        closed="true" toolbar="#tb_search_unit">
     
        <table id="dgItemSearchUnit" class="easyui-datagrid"  width="100%"
            data-options="
                toolbar: '',fitColumns:true,
                singleSelect: true,
                url: ''
            ">
            <thead>
                <tr>
                    <th data-options="field:'customer_pricing_code',width:150">Unit</th>
                    <th data-options="field:'cost',width:80">Price</th> 
                    <th data-options="field:'quantity_high',width:80">Qty Conv</th> 
                    
                </tr>
            </thead>
        </table>
     
</div>


<script type="text/javascript">
    
    
    $().ready(function (){
        $('#dgItemSearchUnit').datagrid({
            onDblClickRow:function(){
                var row = $('#dgItemSearchUnit').datagrid('getSelected');
                if (row){
                    selectSearchUnit();
                }       
            }
        });        
    });


        function selectSearchUnit()
        {
            var row = $('#dgItemSearchUnit').datagrid('getSelected');
            if (row){
                qty_conv=row.quantity_high;
                if(qty_conv=="")qty_conv=1;
                qty=$("#qty").val();
                if(qty=="")qty=0;
                if(qty_conv==0)qty_conv=1;
                qty=qty*qty_conv;
                $("#m_unit").val($("#unit").val());
                $("#m_harga").val($("#item_price").val());
                $("#m_qty").val(qty);
                $('#unit').val(row.customer_pricing_code);
                $('#item_price').val(row.retail);
                $('#dlgSearchUnit').dialog('close');
            }
            
        }
        function calc_qty_unit(){
            if(qty_conv=="")qty_conv=1;
            if(qty_conv=="0")qty_conv=1;
            qty=$("#qty").val();
            qty=qty*qty_conv;
            $("#m_qty").val(qty);
        }
        function searchUnit()
        {
            //$('#dlgSearchUnit').window({left:100,top:window.event.clientY+20});
            $('#dlgSearchUnit').dialog('open')
                .dialog('setTitle','Cari satuan');
            nama=$('#search_unit').val();
            item=$('#barcode').val();
            $('#dgItemSearchUnit').datagrid({url:'<?=base_url()?>index.php/inventory_prices/filter/'+item+'/'+nama});
            $('#dgItemSearchUnit').datagrid('reload');

        }
        function dlgSearchUnit_Close(){
            $("#dlgSearchUnit").dialog("close");
        }       
</script>