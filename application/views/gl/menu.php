<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span>Accounting Modules</span>
			<ul>
				<li>
					<span>Operation</span>
					<ul>
			<li><?=anchor('jurnal','Jurnal Umum','class="info_link"');?></li>
            <li><?=anchor('jurnal/validate','Validasi Jurnal','class="info_link"');?></li>
            <li><?=anchor('jurnal/error_coa','Jurnal Error Coa','class="info_link"');?></li>
            <li><?=anchor('jurnal/unbalance','Jurnal Not Balance','class="info_link"');?></li>
                    </ul>
                </li>
                <li   data-options="state:'closed'">
                    <span>Posting</span>
                    <ul>
			<li><?=anchor('posting/sales_invoice','Faktur Penjualan','class="info_link"');?></li>
			<li><?=anchor('posting/sales_retur','Retur Penjualan','class="info_link"');?></li>
			<li><?=anchor('posting/sales_memo','Kredit Memo Penjualan','class="info_link"');?></li>
			<li><?=anchor('posting/purchase_invoice','Faktur Pembelian','class="info_link"');?></li>
			<li><?=anchor('posting/purchase_retur','Retur Pembelian','class="info_link"');?></li>
			<li><?=anchor('posting/purchase_memo','Kredit Memo Pembelian','class="info_link"');?></li>
			<li><?=anchor('posting/cash','Kas Masuk/Keluar','class="info_link"');?></li>
			<li><?=anchor('posting/inventory','Persediaan','class="info_link"');?></li>
			<li><?=anchor('posting/asset','Aktiva Tetap','class="info_link"');?></li>
			<li><?=anchor('posting','Semua Transaksi','class="info_link"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
			<li><?=anchor('gl/rpt/cards','Laporan Kartu GL','class="info_link"')?></li>
			<li><?=anchor('gl/rpt/jurnal','Laporan Jurnal Transaksi','class="info_link"')?></li>
			<li><?=anchor('gl/rpt/neraca','Laporan Neraca','class="info_link"')?></li>
			<li><?=anchor('gl/rpt/laba_rugi','Laporan Rugi Laba','class="info_link"')?></li>
			<li><?=anchor('gl/rpt/neraca_saldo','Laporan Neraca Saldo','class="info_link"')?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
			<li><?=anchor('coa','Kode Perkiraan','class="info_link"')?></li>
			<li><?=anchor('coa_group','Kelompok Perkiraan','class="info_link"')?></li>
			<li><?=anchor('periode','Periode Akuntansi','class="info_link"')?></li>
			<li><?=anchor('budget','Budgeting Module','class="info_link"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
