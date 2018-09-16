        <table id="dgInvoice" class="easyui-datagrid table"  
            style="min-height:300px"
            data-options="
                iconCls: 'icon-edit',fitColumns: true, 
                singleSelect: true, toolbar: '#tbInvoice',
                url: ''
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

<script language="JavaScript">
	
    $().ready(function (){
		load_invoice();
    });	
	function load_invoice(){
		var po=$('#purchase_order_number').val();
        if(po=="AUTO")return false;
		var xurl='<?=base_url()?>index.php/purchase_invoice/list_by_po/'+po;
		$('#dgInvoice').datagrid({url: xurl});
	}
	function view_invoice()
	{
        row = $('#dgInvoice').datagrid('getSelected');
        if (row){
			invoice_number=row['purchase_order_number'];
			url="<?=base_url()?>index.php/purchase_invoice/view/"+invoice_number;
			add_tab_parent('view_invoice_'+invoice_number,url);
		}
	
	}
	function add_invoice() {
		var po=$('#purchase_order_number').val();
		if(po=="AUTO"){
			log_err("Simpan dulu !");return false;
		}
		var url='<?=base_url()?>index.php/purchase_invoice/add/'+po;		
		add_tab_parent('add_invoice_'+po,url);
	}		

	
	
</script>