<div style="margin:10px 0;"></div>
<ul class="easyui-tree">
    <li>
        <span><strong>Purchase Modules</strong></span>
        <ul>
            <li><span><strong>Operation</strong></span><ul>
                <li><?=anchor('purchase_request','Purchase Requisition','class="info_link"');?></li>
                <li><?=anchor('purchase_order','Purchase Order','class="info_link"');?></li>
                <li><?=anchor('purchase_invoice','Faktur Pembelian','class="info_link"');?></li>
                <li><?=anchor('payables_payments','Pembayaran','class="info_link"');?></li>
                <li><?=anchor('purchase_retur','Retur Pembelian','class="info_link"');?></li>
                <li><?=anchor('purchase_dbmemo','Debit Memo','class="info_link"');?></li>
                <li><?=anchor('purchase_crmemo','Credit Memo','class="info_link"');?></li>
                <li><?=anchor('po/kontra_bon','Kontra Bon','class="info_link"');?></li>
                <li><?=anchor('po/profit_sharing','Profit Sharing Konsinyasi','class="info_link"');?></li>
                <li><?=anchor('po/konsinyasi/create','Create Invoice Konsinyasi','class="info_link"');?></li>
            </ul></li>
            <li><span><strong>Report & Query</strong></span><ul>
                <li><?=anchor('po/rpt/po_list','Purchase Order Summary','class="info_link"')?></li>
                <li><?=anchor('po/rpt/cards_sum','Kartu Hutang Summary','class="info_link"')?></li>
                <li><?=anchor('po/rpt/cards_detail','Kartu Hutang Detail','class="info_link"')?></li>
                <li><?=anchor('po/rpt/aging_sum','Umur Hutang Summary','class="info_link"')?></li>
                <li><?=anchor('po/rpt/aging_detail','Umur Hutang Detail','class="info_link"')?></li>
                <li><?=anchor('po/tracking_harga','Tracking Harga Beli','class="info_link"');?></li>
                <li><?=anchor('po/umur_barang','Umur Barang','class="info_link"');?></li>
                <li><?=anchor('po/item_jual','Data Penjualan per Barang','class="info_link"');?></li>
            </ul></li>
            <li><span><strong>Master</strong></span><ul>
                <li><?=anchor('supplier/add','Tambah Kode Supplier','class="info_link"')?></li>
                <li><?=anchor('supplier','Cari Master Supplier','class="info_link"')?></li>
                <li><?=anchor('sysvar_data/view_list/lookup.status_po_request','Status Purchase Request','class="info_link"')?></li>
                <li><?=anchor('project/project','Daftar Proyek','class="info_link"')?></li>
                <li><?=anchor('sysvar_data/view_list/lookup.status_project','Status Proyek','class="info_link"')?></li>
                <li><?=anchor('sysvar_data/view_list/lookup.group_project','Kelompok Proyek','class="info_link"')?></li>
            </ul></li>
        </ul>
    </li>
</ul>
