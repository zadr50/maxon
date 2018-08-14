 <div class="thumbnail box-gradient">
	<?
	echo link_button('Add','','add','false',base_url().'index.php/receive_po/add');		
	echo link_button('Print', 'print_receive()','print');		
	if(!$has_invoice) echo link_button('Delete', 'delete_receive()','remove');	
	echo link_button('Search','','search','false',base_url().'index.php/receive_po');		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/receive_po/view/'.$shipment_id);		
	echo "<div style='float:right'>";
	echo link_button('Help', "load_help('receipt_po')",'help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('receipt_po')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">	
   <table class='table' width="100%">
       <tr>
           <td>Receipt No:</td><td><strong><?=$shipment_id?></strong>                        
           </td>
           <td>Nomor PO:</td><td><strong><a href="#" onclick="view_po('<?=$purchase_order_number?>');return false;"><?=$purchase_order_number?></a></strong></td>
           <td>Receipt By:</td><td><?=$receipt_by?></td>
       </tr>
       <tr>
            <td>Tanggal:</td><td><?=$date_received?></td>
            <td>Gudang:</td><td><?=$warehouse_code?></td>
			<td>No SJ#</td><td><?=$ref1?></td>
       </tr>
       <tr>
            <td>Supplier:</td><td colspan='4'><?=$supplier_info?></td>            
			<td></td>
       </tr>
       <tr>
            <td>Keterangan</td>
            <td colspan="4"><?=$comments?>
            </td>
			<td></td>
       </tr>

   </table>
	<table id="dgItems" class="easyui-datagrid table"  
		data-options="
			toolbar: '#toolbar-search-faktur',
			singleSelect: true,fitColumns: true,
			url: '<?=base_url()?>index.php/receive_po/receive_items/<?=$shipment_id?>'
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Item</th>
				<th data-options="field:'description',width:180">Description</th>
				<th data-options="field:'quantity_received',width:80">Qty</th>
				<th data-options="field:'unit',width:50">Unit</th>
				<th data-options="field:'cost',width:50">Cost</th>
				<th data-options="field:'total_amount',width:50">Total</th>
				<th data-options="field:'id',width:50">Id</th>
			</tr>
		</thead>
	</table>
</div>		
<script language='javascript'>
	function view_po(nomor){
		var url="<?=base_url()?>index.php/purchase_order/view/<?=$purchase_order_number?>";
		add_tab_parent("view_po_<?=$purchase_order_number?>",url);
	}
	function print_receive(){
		url="<?=base_url()?>index.php/receive_po/print_bukti/<?=$shipment_id?>";
		window.open(url,'_blank');
	}
	function delete_receive()
	{
		if (confirm("Yakin mau dihapus ?") == true) {
			$.ajax({
					type: "GET",
					url: "<?=base_url()?>/index.php/receive_po/delete/<?=$shipment_id?>",
					data: "",
					success: function(result){
						var result = eval('('+result+')');
						if(result.success){
							$.messager.show({
								title:'Success',msg:result.msg
							});	
							window.open('<?=base_url()?>index.php/receive_po','_self');
						} else {
							$.messager.show({
								title:'Error',msg:result.msg
							});							
						};
					},
					error: function(msg){alert(msg);}
			}); 				
		
		}
	}
		
</script>		
