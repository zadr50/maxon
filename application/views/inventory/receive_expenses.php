<table id="dgExpenses" class="easyui-datagrid table"  
	data-options="toolbar: '#tool-exp',	singleSelect: true,fitColumns: true,
		url: '<?=base_url()?>index.php/receive_po/expenses/<?=$shipment_id?>'
	">
	<thead>
		<tr>
			<th data-options="field:'item_desc',width:180">Item</th>
			<th data-options="field:'description',width:180">Description</th>
			<th data-options="field:'qty',width:80">Qty</th>
			<th data-options="<?=col_number('price',2)?>">Price</th>
			<th data-options="<?=col_number('amount',2)?>">Amount</th>
			<th data-options="field:'id',width:50">Id</th>
		</tr>
	</thead>
</table>
<div id='tool-exp' class="box-gradient">
	<?=link_button("Addnew Expense", "add_expense()","addnew")?>
	<?=link_button("Delete", "del_expense()","remove")?>
	<?=link_button("Refresh", "refresh_expense()","addnew")?>
</div>