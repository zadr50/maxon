<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Accounting Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor('jurnal','Jurnal Umum','class="info_link link2"');?></li>
<li><?=anchor('jurnal/validate','Validasi Jurnal','class="info_link link2"');?></li>
<li><?=anchor('gl/rpt/jurnal_not_balance','Jurnal tidak balance','class="info_link link2"')?></li>
<li><?=anchor('gl/rpt/jurnal_miss_account','Jurnal hilang kode akun','class="info_link link2"')?></li>
                    </ul>
                </li>
                <li   data-options="state:'closed'">
                    <span>Posting</span>
                    <ul>
<!--                    	
<li><?=anchor('posting/sales_invoice_filter','Faktur Penjualan','class="info_link link2"');?></li>
<li><?=anchor('posting/sales_retur_filter','Retur Penjualan','class="info_link link2"');?></li>
<li><?=anchor('posting/sales_memo_filter','Kredit Memo Penjualan','class="info_link link2"');?></li>
<li><?=anchor('posting/purchase_invoice_filter','Faktur Pembelian','class="info_link link2"');?></li>
<li><?=anchor('posting/purchase_retur_filter','Retur Pembelian','class="info_link link2"');?></li>
<li><?=anchor('posting/purchase_memo_filter','Kredit Memo Pembelian','class="info_link link2"');?></li>
<li><?=anchor('posting/cash_filter','Kas Masuk/Keluar','class="info_link link2"');?></li>
<li><?=anchor('posting/inventory_filter','Persediaan','class="info_link link2"');?></li>
<li><?=anchor('posting/asset_filter','Aktiva Tetap','class="info_link link2"');?></li>
			
		-->
			
			<li><?=anchor('posting','Semua Transaksi','class="info_link link2"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
<li><?=anchor('gl/rpt/cards','Laporan Kartu GL','class="info_link link2"')?></li>
<li><?=anchor('gl/rpt/jurnal','Laporan Jurnal Transaksi','class="info_link link2"')?></li>
<li><?=anchor('gl/rpt/neraca','Laporan Neraca','class="info_link link2"')?></li>
<li><?=anchor('gl/rpt/laba_rugi','Laporan Rugi Laba','class="info_link link2"')?></li>
<li><?=anchor('gl/rpt/neraca_saldo','Laporan Neraca Saldo','class="info_link link2"')?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('coa','Kode Perkiraan','class="info_link link2"')?></li>
<li><?=anchor('coa_group','Kelompok Perkiraan','class="info_link link2"')?></li>
<li><?=anchor('periode','Periode Akuntansi','class="info_link link2"')?></li>
<li><?=anchor('budget','Budgeting Module','class="info_link link2"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
