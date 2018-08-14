        <table id="dgInvoice" class="easyui-datagrid table"  
            style="min-height:300px"
            data-options="
                iconCls: 'icon-edit',fitColumns: true, 
                singleSelect: true, toolbar: '#tbInvoice',
                url: '<?=base_url()?>index.php/purchase_invoice/list_by_po/<?=$purchase_order_number?>'
            ">
            <thead>
                <tr>
                    <th data-options="field:'purchase_order_number',width:100">Nomor</th>
                    <th data-options="field:'po_date',width:100">Tanggal</th>
                    <th data-options="field:'terms',width:100">Terms</th>
                    <th data-options="field:'amount',width:100">Amount</th>
                </tr>
            </thead>
        </table>
    



<div id="tbInvoice" class="box-gradient ">
    <?=link_button('Add','add_invoice()','add');    ?>  
    <?=link_button('Refresh','load_invoice()','reload');    ?>  
    <?=link_button('View','view_invoice()','edit'); ?>  
</div>
