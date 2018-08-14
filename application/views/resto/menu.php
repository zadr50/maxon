<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span>Travel Agent Modules</span>
			<ul>
				<li>
					<span>Operation</span>
					<ul>
						<li><?=anchor('tour','Paket Tour','class="info_link"');?></li>
						<li><?=anchor('pesawat','Tiket Pesawat','class="info_link"');?></li>
						<li><?=anchor('kereta','Tiket Kereta','class="info_link"');?></li>
						<li><?=anchor('bus','Tiket Bus','class="info_link"');?></li>
						<li><?=anchor('hotel','Pemesanan Hotel','class="info_link"');?></li>
						<li><?=anchor('rental','Rental Kendaraan','class="info_link"');?></li>
						<li><?=anchor('jadwal','Jadwal Penerbangan','class="info_link"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
						<li><?=anchor('travel/rpt/card','Laporan Penjualan','class="info_link"')?></li>
						<li><?=anchor('travel/rpt/payment','Laporan Penerimaan Kas','class="info_link"')?></li>
						<li><?=anchor('travel/rpt/tagihan','Faktur Kredit','class="info_link"')?></li>
						<li><?=anchor('travel/rpt/laba_rugi','Rugi Laba Penjualan','class="info_link"')?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
						<li><?=anchor('maskapai','Maskapai Penerbangan','class="info_link"')?></li>
						<li><?=anchor('rekanan','Rekanan Travel Agent','class="info_link"')?></li>
						<li><?=anchor('cabang','Cabang Travel Agent','class="info_link"')?></li>
						<li><?=anchor('tour_master','Seting Paket Tour','class="info_link"')?></li>
						<li><?=anchor('rute_master','Seting Rute Penerbangan','class="info_link"')?></li>
						<li><?=anchor('tiket_price_master','Seting Kelas Tiket Pesawat','class="info_link"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
