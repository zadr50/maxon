<div id='divItem' title="Items"  >
	<table id="dg" class="easyui-datagrid"  width='1200' height="300"
		data-options="
			iconCls: 'icon-edit',fitColumns: true, 
			singleSelect: true,
			toolbar: '#tbItem',
			url: ''
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Unit</th>
				<th data-options="field:'price',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}},
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');}">Harga</th>
				<th data-options="field:'discount',width:50,editor:'numberbox'">Disc1%</th>
				<th data-options="field:'disc_2',width:50,editor:'numberbox'">Disc2%</th>
				<th data-options="field:'disc_3',width:50,editor:'numberbox'">Disc3%</th>
				<th data-options="field:'amount',width:60,align:'right',editor:'numberbox',
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');}">Jumlah</th>
				<th data-options="field:'ship_qty',width:50">Ship Qty</th>
				<th data-options="field:'ship_date',width:50">Ship Date</th>
				<th data-options="field:'mu_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">M Qty</th>
				<th data-options="field:'multi_unit',width:50,align:'left',editor:'text'">M Unit</th>
				<th data-options="field:'no_urut',width:30,align:'right'">NoUrut</th>
				<th data-options="field:'warehouse_code',width:30,align:'right'">Gudang</th>
				<th data-options="field:'from_line_doc',width:30,align:'right'">Ref</th>
				<th data-options="field:'from_line_type',width:30,align:'right'">RefType</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
</div>
	
	