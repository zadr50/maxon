<table id="dgInvoice" class="easyui-datagrid"  
	style="width:auto;min-height:200px"
	data-options="
		iconCls: 'icon-edit',
		singleSelect: true,
		toolbar: '#tbInvoice',
		url: '<?=base_url()?>index.php/leasing/loan/invoice/<?=$loan_id?>'
	">
	<thead>
		<tr>
			<th data-options="field:'invoice_number'">Nomor Faktur</th>
			<th data-options="field:'invoice_date',width:100">Tanggal Tagih</th>
			<th data-options="field:'idx_month',align:'left',editor:'text'">Bulan Ke</th>

			<th data-options="field:'amount2',width:80,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Jumlah+Sld</th>
			<th data-options="field:'amount',width:80,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Jumlah</th>
			<th data-options="field:'pokok',width:80,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Pokok</th>
			<th data-options="field:'bunga',width:80,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Bunga</th>
			<th data-options="field:'hari_telat'">Telat</th>
			<th data-options="field:'denda_tagih'">Denda</th>

			<th data-options="field:'paid'">Lunas</th>
			<th data-options="field:'date_paid'">Tanggal Bayar</th>

			<th data-options="field:'amount_paid',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Amount Paid</th>
			<th data-options="field:'pokok_paid',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Pokok Paid</th>
			<th data-options="field:'bunga_paid',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Bunga Paid</th>
			<th data-options="field:'denda',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Denda Paid</th>
			<th data-options="field:'saldo',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Saldo</th>
			<th data-options="field:'saldo_titip',width:60,align:'right',editor:'numberbox',
				formatter: function(value,row,index){
					return number_format(value,2,'.',',');}">Saldo Titip</th>
			
			<th data-options="field:'voucher'">Nomor Kas Masuk</th>
			<th data-options="field:'payment_method'">Payment Method</th>
		</tr>
	</thead>
</table>

<div id='tbInvoice'>
<?=link_button('Add', 'dgInvoice_Add()','add');?>
<?=link_button('Edit', 'dgInvoice_Edit()','edit');?>
<?=link_button('Delete', 'dgInvoice_Delete()','remove');?>
</div>