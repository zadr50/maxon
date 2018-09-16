<div title="Delivery" style="padding:10px">
	<table id="dgDo" class="easyui-datagrid"  
	style="width:700px;min-height:200px"
	data-options="
			iconCls: 'icon-edit',fitColumns: true, 
			singleSelect: true,  
			url: '<?=base_url();?>index.php/sales_order/delivery/<?=$sales_order_number;?>'
		">
		<thead>
			<tr>
				<th data-options="field:'invoice_number',width:100">Nomor</th>
				<th data-options="field:'invoice_date',width:80">Tanggal</th>
				<th data-options="field:'warehouse_code',width:80">Gudang</th>
				<th data-options="field:'item_number',width:80">Item</th>
				<th data-options="field:'description',width:180">Description</th>
				<th data-options="field:'quantity',width:80">Quantity</th>
				<th data-options="field:'unit',width:80">Unit</th>
				<th data-options="field:'mu_qty',width:80">M Qty</th>
				<th data-options="field:'multi_unit',width:80">M Unit</th>

			</tr>
		</thead>
	</table>
</div>