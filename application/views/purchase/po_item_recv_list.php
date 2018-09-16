<table id="dgRcv" class="easyui-datagrid table"  
    style="min-height:300px"
    data-options="
        iconCls: 'icon-edit',fitColumns: true, 
        singleSelect: true, toolbar: '#tbRcv',
        url: ''
    ">
    <thead>
        <tr>
            <th data-options="field:'shipment_id',width:100">Nomor</th>
            <th data-options="field:'date_received',width:100">Tanggal</th>
            <th data-options="field:'warehouse_code',width:100">Gudang</th>
            <th data-options="field:'item_number',width:100">Item Number</th>
            <th data-options="field:'description',width:100">Description</th>
            <th data-options="field:'quantity_received',width:100">Quantity</th>
            <th data-options="field:'receipt_by',width:100">Petugas</th>
            <th data-options="field:'selected',width:100">Invoiced</th>
        </tr>
    </thead>
</table>

<div id="tbRcv" class="box-gradient ">
    <?=link_button('Add','add_receive()','add');    ?>  
    <?=link_button('Refresh','load_receive()','reload');    ?>  
    <?=link_button('View','view_receive()','edit'); ?>  
</div>

<script language="JavaScript">
	
    $().ready(function (){
		load_receive();
    });	
    
	function load_receive()
	{
	    var no=$("#purchase_order_number").val();
		var url='<?=base_url()?>index.php/receive_po/list_by_po/'+no;
		$('#dgRcv').datagrid({url:url});
		//$('#dgRcv').datagrid('reload');
	}
	function view_receive()
	{
        row = $('#dgRcv').datagrid('getSelected');
        if (row){
			shipment_id=row['shipment_id'];
			url="<?=base_url()?>index.php/receive_po/view/"+shipment_id;
			add_tab_parent('view_receive_'+shipment_id,url);
		}
	
	}
	function add_receive() {
	    var no=$("#purchase_order_number").val();
		if(no=="AUTO"){
			log_err("Simpan dulu !");return false;
		}
		var url='<?=base_url()?>index.php/receive_po/add/'+no;		
		add_tab_parent('add_receive_'+no,url);
	}

    
	
</script>