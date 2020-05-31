<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Banks Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor('cash_in','Kas/Bank Masuk','class="info_link link2"');?></li>
<li><?=anchor('cash_out','Kas/Bank Keluar','class="info_link link2"');?></li>
<li><?=anchor('cash_mutasi','Mutasi Rekening','class="info_link link2"');?></li>
<li><?=anchor('payables_payments','Bayar Hutang','class="info_link link2"');?></li>
<li><?=anchor('payment','Terima Piutang','class="info_link link2"');?></li>
<li><?=anchor(base_url("index.php/banks/giro/masuk_not_cleared"),'Daftar Giro Masuk - Gantung','class="info_link link2"  ');?></li>
<li><?=anchor(base_url("index.php/banks/giro/keluar_not_cleared"),'Daftar Giro Keluar - Gantung','class="info_link link2"  ');?></li>            
<li><?=anchor(base_url().'index.php/sales_retur','Retur Penjualan','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/sales_crmemo','Kredit Memo Piutang','class="info_link link2"');?></li>
<li><?=anchor(base_url().'index.php/sales_dbmemo','Debit Memo Piutang','class="info_link link2"');?></li>
<li><?=anchor('purchase_retur','Retur Pembelian','class="info_link link2"');?></li>
<li><?=anchor('purchase_dbmemo','Debit Memo Hutang','class="info_link link2"');?></li>
<li><?=anchor('purchase_crmemo','Credit Memo Hutang','class="info_link link2"');?></li>
<li><?=anchor('banks/rekon','Rekonsiliasi','class="info_link link2"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
					    <?php include("menu_reports.php");?>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('banks/banks','Nomor RekeNing Kas/Bank','class="info_link link2"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
