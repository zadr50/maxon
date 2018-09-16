        <table id="dg" class="easyui-datagrid"   style="width:1000px;min-height:340px;"
             
            data-options="
                iconCls: 'icon-edit',
                singleSelect: true,
                toolbar: '#tb',fitColumns: false, 
                url: ''
            ">
            <thead>
                <tr>
                    <th data-options="field:'item_number',width:80">Kode Barang</th>
                    <th data-options="field:'description',width:150">Nama Barang</th>
                    <th data-options="<?=col_number('quantity',2)?>">Qty</th>
                    <th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
                    <th data-options="<?=col_number('price',2)?>">Harga</th>
                    <th data-options="field:'discount',width:50,editor:'numberbox'">Disc%1</th>
                    <th data-options="field:'disc_2',width:50,editor:'numberbox'">Disc%2</th>
                    <th data-options="field:'disc_3',width:50,editor:'numberbox'">Disc%3</th>
                    <th data-options="<?=col_number('total_price',2)?>">Jumlah</th>
                    <th data-options="field:'qty_recvd',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty Recvd</th>
                    <th data-options="<?=col_number('retail',2)?>">Jual</th>
                    <th data-options="field:'margin',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Margin</th>
                    <th data-options="<?=col_number('mu_qty',2)?>">M_Qty</th>
                    <th data-options="field:'multi_unit',width:50,align:'left',editor:'text'">M_Unit</th>
                    <th data-options="<?=col_number('mu_harga',2)?>">M_Price</th>
                    <th data-options="field:'line_number',width:30,align:'right'">Line</th>
                </tr>
            </thead>
        </table>
