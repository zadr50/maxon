<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span>Inventory</span>
			<ul>
				<li>
					<span>Operation</span>
					<ul>
<li><?=anchor('receive_po','Terima Barang PO','class="info_link"');?></li>
<li><?=anchor('receive','Terima Barang Non PO','class="info_link"');?></li>
<li><?=anchor('delivery','Pengeluaran Barang Lainnya','class="info_link"');?></li>
<li><?=anchor('delivery_gudang','Kirim barang ke toko','class="info_link"');?></li>
<li><?=anchor('retur_toko','Retur barang dari toko','class="info_link"');?></li>
<li><?=anchor('stock_mutasi','Mutasi Stock','class="info_link"');?></li>
<li><?=anchor('stock_adjust','Adjustment Stock','class="info_link"');?></li>
<li><?=anchor('inventory/closing','Closing Stock','class="info_link"');?></li>
					</ul>
				</li>
				<li data-options="state:'closed'">
					<span>Report</span>
					<ul>
                        <?php include_once "menu_reports.php" ?>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('inventory','Master Barang','class="info_link"')?></li>
<li><?=anchor('category','Kategori Barang','class="info_link"')?></li>
<li><?=anchor('inventory_class','Kelas Barang','class="info_link"')?></li>
<li><?=anchor('shipping_locations','Master Gudang','class="info_link"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
