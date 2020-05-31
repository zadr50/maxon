<div style="margin:10px 0;"></div>
<ul class="easyui-tree">
    <li >
        <span><strong>Purchase Modules</strong></span>
        <ul >
            <li data-options="state:'closed'"  class='treeview'>
            	<span>Operation</span>
            	<ul class="sidebar-menu" data-widget="tree">
<li><?=anchor('purchase_request','Purchase Requisition','class="info_link link2"');?></li>
<li><?=anchor('purchase_order','Purchase Order','class="info_link link2"');?></li>
<li><?=anchor('purchase_invoice','Faktur Pembelian','class="info_link link2"');?></li>
<li><?=anchor('payables_payments','Pembayaran','class="info_link link2"');?></li>
<li><?=anchor('purchase_retur','Retur Pembelian','class="info_link link2"');?></li>
<li><?=anchor('purchase_dbmemo','Debit Memo','class="info_link link2"');?></li>
<li><?=anchor('purchase_crmemo','Credit Memo','class="info_link link2"');?></li>
<li><?=anchor('po/kontra_bon','Kontra Bon','class="info_link link2"');?></li>
<li><?=anchor('po/umur_barang','Umur Barang',"class='info_link link2'")?></li>
<li><?=anchor('po/tracking_harga','Tracking Harga Beli',"class='info_link link2'")?></li>
<li><?=anchor('po/profit_sharing','Profit Sharing Konsinyasi','class="info_link link2"');?></li>
<li><?=anchor('po/konsinyasi/create','Create Invoice Konsinyasi','class="info_link link2"');?></li>
				</ul>
			</li>
            <li data-options="state:'closed'">
            	<span>Reports</span><ul>
				<li data-options="state:'closed'">
					<span>Purchase Order</span>            	
					<ul>
<li><?=anchor('po/rpt/po_list','Purchase Order Summary',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/po_items_sum','P.O Summary Items',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_items','P.O Items Detail',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_category','P.O Summary Items Category',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_supplier','P.O Summary Suppliers',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_supplier_item','P.O Summary Suppliers Items',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_detail','P.O Detail',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_recv','P.O dan Penerimaan',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/po_recv_list','P.O dan Penerimaan List',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_open','P.O Open',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_open_item','P.O Open By Items',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_open_supplier','P.O Open By Supplier',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/po_faktur','P.O dan Faktur',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/hist_harga_beli','History Harga Beli',"class='info_link' link2")?></li>
<li><?=anchor('purchase/rpt/item_need_order','Barang Harus dibeli',"class='info_link link2'")?></li>
					</ul>
				
				</li>

				<li>
				    <span>Faktur Pembelian</span>
				    <ul>
<li><?=anchor('purchase/rpt/faktur_list','Faktur Pembelian Summary',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/faktur_items_sum','Faktur Summary Items',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/faktur_items','Faktur Items Detail',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/faktur_category','Faktur Summary Item Category',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/faktur_supplier','Faktur Summary Supplier',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/faktur_supplier_items','Faktur Summary Supplier Items',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/faktur_detail','Faktur Detial',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/retur_list','Retur Pembelian Summary',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/retur_items','Retur Summary Items',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/retur_supplier','Retur Summary Suppliers',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/retur_supplier_item','Retur Summary Suppliers Items',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/retur_detail','Retur Pembelian Detail',"class='info_link link2'")?></li>
				    </ul>
				</li>
				
				<li data-options="state:'closed'">
				    <span>Payables</span>
				    <ul>
<li><?=anchor('po/rpt/suppliers','Daftar Supplier',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/payment','Daftar Pembayaran Hutang',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/payment_sum','Daftar Pembayaran Summary',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/faktur_not_paid','Faktur Belum Lunas',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/faktur_payment','Faktur dan Pembayaran',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/faktur_payment_type','Faktur Jenis Pembayaran',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/cards_sum','Kartu Hutang Supplier Summary',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/cards_detail','Kartu Hutang Supplier Detail',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/aging_sum','Umur Hutang Summary',"class='info_link link2'")?></li>
<li><?=anchor('po/rpt/aging_detail','Umur Hutang Detail',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/memo_list','Debit/credit Memo Pembelian',"class='info_link link2'")?></li>
<li><?=anchor('purchase/rpt/kontra_list','Kontra Bon List',"class='info_link link2'")?></li>
					</ul>
				</li>
				

                
            </ul></li>
            <li data-options="state:'closed'"><span>Master</span><ul>
<li><?=anchor('supplier/add','Tambah Kode Supplier','class="info_link link2"')?></li>
<li><?=anchor('supplier','Cari Master Supplier','class="info_link link2"')?></li>
<li><?=anchor('project/project','Daftar Proyek','class="info_link link2"')?></li>
            </ul></li>
            
        </ul>
    </li>
</ul>
