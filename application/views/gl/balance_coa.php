<table id='dgSaldo' name='dgSaldo' class="easyui-datagrid"  width=1000
	data-options="
		iconCls: 'icon-edit', fitColumns: true,
		singleSelect: true,  
		url: '<?=base_url()?>index.php/periode/saldo_awal/<?=$period?>',
		toolbar:'#tbSaldo' ">
	<thead>
		<tr>
			<th data-options="field:'account',width:80">Account</th>
			<th data-options="field:'account_description',width:180">Account Description</th>
			<th data-options="<?=col_number("beginning_balance",2)?>">Awal</th>
            <th data-options="<?=col_number("debit_base",2)?>">Debit</th>
            <th data-options="<?=col_number("credit_base",2)?>">Credit</th>
            <th data-options="<?=col_number("ending_balance",2)?>">Akhir</th>                
			<th data-options="field:'company_code',width:180,align:'left'">Keterangan</th>
		</tr>
	</thead>
</table>
