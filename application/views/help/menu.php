 
   <ul class="easyui-tree">
 	<li><span><strong>Penjualan</strong></span>
 		<ul>
			<li><?=anchor('jurnal/add','Tambah Jurnal Umum');?></li>
			<li><?=anchor('jurnal','Cari Jurnal Umum');?></li>
 		</ul>
 	</li>
 	<li><span><strong>Pembelian</strong></span>
 		<ul>
 					<li><?=anchor('coa/add','Tambah Perkiraan')?></li>
 					<li><?=anchor('coa','Cari Perkiraan')?></li>
		</ul>
 	</li>
 	
 	<li><span><strong>Inventory</strong></span><ul>
		<li><?=anchor('gl/rpt/cards','Laporan Kartu GL')?></li>
		<li><?=anchor('gl/rpt/jurnal','Laporan Jurnal Transaksi')?></li>
		<li><?=anchor('gl/rpt/neraca','Laporan Neraca')?></li>
		<li><?=anchor('gl/rpt/rugi_laba','Laporan Rugi Laba')?></li>
		<li><?=anchor('gl/rpt/neraca_saldo','Laporan Neraca Saldo')?></li>
 	</ul></li>
