<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Inventory</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor('receive_po','Terima Barang PO','class="info_link link2"');?></li>
<li><?=anchor('receive','Terima Barang Non PO','class="info_link link2"');?></li>
<li><?=anchor('delivery','Pengeluaran Barang Lainnya','class="info_link link2"');?></li>
<li><?=anchor('delivery_gudang','Kirim barang ke toko','class="info_link link2"');?></li>
<li><?=anchor('receive_toko','Terima barang dari gudang/toko','class="info_link link2"');?></li>
<li><?=anchor('retur_toko','Retur barang dari toko','class="info_link link2"');?></li>
<li><?=anchor('stock_mutasi','Mutasi Stock','class="info_link link2"');?></li>
<li><?=anchor('stock_opname','Stock Opname','class="info_link link2"');?></li>
<li><?=anchor('stock_adjust','Adjustment Stock','class="info_link link2"');?></li>
<li><?=anchor('inventory/closing','Closing Stock','class="info_link link2"');?></li>
<li><?=anchor('stock/master/update_qty_all','Update Qty Master','class="info_link link2"');?></li>
<li><?=anchor('purchase_request','Purchase Request','class="info_link link2"');?></li>
					</ul>
				</li>
				<li data-options="state:'closed'">
					<span>Report</span>
					<ul>


<li>
<span>Analisys Reports</span>    
<ul>
<li><?=anchor('inventory/rpt/daftar','Daftar Barang',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/price_list','Price List Harga Jual Barang',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/daftar_cost','Daftar Barang Harga Beli, HPP',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/daftar_supplier','Daftar Barang Per Supplier',"class='info_link link2'")?></li>

<li><?=anchor('inventory/rpt/sales_laku','Barang paling laku dipenjualan',"class='info_link link2'")?></li>
<!--
<li><?=anchor('inventory/rpt/sales_tdk_laku','Barang tidak laku',"class='info_link link2'")?></li>
-->

<li><?=anchor('inventory/rpt/cards_dead','Barang tidak bergerak',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/min_stock','Stock Minimum',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/max_stock','Stock Maximum',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/stock_value','Penilaian Persediaan',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/konsi_sum','Summary Hutang Konsinyasi','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/konsi_detail','Rincian Hutang Konsinyasi','class="info_link link2"')?></li>
</ul>
</li>

<li>
    <span>Stock Reports</span>
	<ul>
<li><?=anchor('inventory/rpt/cards_summary','Kartu Stock Summary',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/awal_in_out_akhir','Kartu Stock In/Out',"class='info_link link2'")?></li>
<!-- matikan dulu terlalu berat cpu !!!
<li><?=anchor('inventory/rpt/cards_summary2','Kartu Stock Summary - No Arsip','class="info_link link2"')?></li>
-->
<li><?=anchor('inventory/rpt/cards_detail','Kartu Stock Detail',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/cards_gudang','Kartu Stock Per Gudang',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/cards_supplier','Kartu Stock Per Supplier',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/cards_category','Kartu Stock Per Kategori',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/cards_tran','History Transaksi Stock',"class='info_link link2'")?></li>
<li><?=anchor('inventory/rpt/min_stock','Laporan Stock Minimum','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/max_stock','Laporan Stock Maximum','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/stock_akum_no_arsip','Laporan Akumulasi Stock Toko','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/stock_akum_gab','Laporan Akumulasi Gabungan','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/adjust_list','Laporan Adjustment Stock','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/opname_list','Laporan Stock Opname','class="info_link link2"')?></li>
<li><?=anchor('purchase/rpt/po_recv_list','Penerimaan barang PO','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/stock_in_etc','Penerimaan barang non PO','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/stock_out_etc','Peng barang lainnya','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/stock_out_etc_type','Peng barang lainnya - by Type','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/stock_out_etc_project','Peng barang lainnya - by Project','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/stock_out_etc_supp','Peng barang lainnya - by Supplier','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/retur_toko','Daftar Retur Toko','class="info_link link2"')?></li>
<li><?=anchor('inventory/rpt/receive_toko','Terima barang dari gudang/toko','class="info_link link2"');?></li>

    </ul>
</li>
                        
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('inventory','Master Barang','class="info_link link2"')?></li>
<li><?=anchor('category','Kategori Barang','class="info_link link2"')?></li>
<li><?=anchor('inventory_class','Kelas Barang','class="info_link link2"')?></li>
<li><?=anchor('shipping_locations','Master Gudang','class="info_link link2"')?></li>
<li><?=anchor('customer_type','Price By CustomerType','class="info_link link2"');?></li>
<li><?=anchor('project/project','Project Code','class="info_link link2"');?></li>
<li>
	<a href="#" onclick="add_tab_parent_test('Inventory','inventory/browse');">Test New Tab</a>
</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
<script language="JavaScript">
	function add_tab_parent_test(title,url){
		if ( window.parent.$('#tt').length ){
			if (window.parent.$('#tt').tabs('exists', title)){ 
				window.parent.$('#tt').tabs('select', title); 
			} else { 			
				index++;
				window.parent.$('#tt').tabs('add',{
					title: title + '-' + index,
					content: "<table id='dg"+index+"' style='width:100%'><tr><td>Loading....</td></table>" + 
					"<div id='dd"+index+"'></div>",
					closable: true
				});
				var param={item_number:"aqua"};
				var divout="tab_id_"+index;
				$('#tab_id_'+index).html("<img src='"+CI_BASE+"images/loading.gif'>");
				event.preventDefault();
				$.ajax({ type: "GET", url: url+'_ajax', data: param,
					success: function(response){
						data=JSON.parse(response);
						afields=data.fields;
						acaption=data.fields_caption;
						col_width=data.col_width;
						renderGrid(index,url,afields,acaption,col_width);						 
						$('#tt').tabs('select', title + '-' + index); 		
						return true;
					},
					error: function(msg){
						console.log(msg);
					}
				}); 



			}				
			 window.top.scrollTo(0,0);
		} 
	}
function renderGrid(index,url,afields,acaption,col_width){

	var fields=[];
	for(i=0;i<afields.length;i++){
		field=afields[i];
		if(col_width[field]){
			_width=col_width[field];
			console.log('field: ' + field + ', width: ' + _width);
		} else {
			_width=100;
		}
		fields.push({field:field,title:acaption[i],width:_width});
	}
	var tool=[];
	tool.push({iconCls: 'icon-add',handler: function(){addnew(index)}},'-');
	tool.push({iconCls: 'icon-edit',handler: function(){alert('edit')}},'-');
	tool.push({iconCls: 'icon-remove',handler: function(){alert('remove')}},'-');
	tool.push({iconCls: 'icon-filter',handler: function(){alert('filter')}},'-');
	tool.push({iconCls: 'icon-reload',handler: function(){alert('reload')}},'-');
	tool.push({iconCls: 'icon-print',handler: function(){alert('print')}},'-');
	tool.push({iconCls: 'icon-csv',handler: function(){alert('csv')}},'-');
	tool.push({iconCls: 'icon-pdf',handler: function(){alert('pdf')}},'-');
	tool.push({iconCls: 'icon-help',handler: function(){alert('help')}},'-');

	$('#dg'+index).datagrid({
		url: url+"_data", singleSelect: true, fitColumns: true,rownumbers:true,pagination:true,
		toolbar: tool,
		columns: [fields]
	});
	function addnew(index){
		$('#dd'+index).dialog({
			title: 'My Dialog', 
			width: 800,
			height: 600,
			closed: false,
			cache: false,
			href: CI_BASE + 'index.php/inventory/add',
			modal: true
		});

	}
}
</script>