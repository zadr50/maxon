<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span>Banks Modules</span>
			<ul>
				<li>
					<span>Operation</span>
					<ul>
			<li><?=anchor('cash_in','Kas/Bank Masuk','class="info_link"');?></li>
			<li><?=anchor('cash_out','Kas/Bank Keluar','class="info_link"');?></li>
			<li><?=anchor('cash_mutasi','Mutasi Rekening','class="info_link"');?></li>
            <li><?=anchor('payables_payments','Bayar Hutang','class="info_link"');?></li>
            <li><?=anchor('payment','Terima Piutang','class="info_link"  ');?></li>
            <li><?=anchor(base_url().'index.php/sales_retur','Retur Penjualan','class="info_link"  ');?></li>
            <li><?=anchor(base_url().'index.php/sales_crmemo','Kredit Memo Piutang','class="info_link"');?></li>
            <li><?=anchor(base_url().'index.php/sales_dbmemo','Debit Memo Piutang','class="info_link"');?></li>
            <li><?=anchor('purchase_retur','Retur Pembelian','class="info_link"');?></li>
            <li><?=anchor('purchase_dbmemo','Debit Memo Hutang','class="info_link"');?></li>
            <li><?=anchor('purchase_crmemo','Credit Memo Hutang','class="info_link"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
			<li><?=anchor('banks/rpt/mutasi','Mutasi Transaksi Rekening','class="info_link"')?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
			<li><?=anchor('banks','Nomor RekeNing Kas/Bank','class="info_link"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
