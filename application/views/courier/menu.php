<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Courier Module</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor("courier/booking_dom","Booking Domestik",'class="info_link link2"')?></li>
<li><?=anchor("courier/manifest","Manifest Pengiriman",'class="info_link link2"')?></li>
<li><?=anchor("courier/invoice","Tagihan / Faktur",'class="info_link link2"')?></li>
<li><?=anchor("cash_in","Penerimaan Kas/Bank",'class="info_link link2"')?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
<li><?=anchor("courier/rpt/load/booking_dom","Laporan Booking Domestik",'class="info_link link2"')?></li>
<li><?=anchor("courier/rpt/load/manifest","Daftar Manifest Pengiriman",'class="info_link link2"')?></li>
<li><?=anchor("courier/rpt/load/manifest2","Daftar Pendapatan",'class="info_link link2"')?></li>
<li><?=anchor("courier/rpt/load/invoice","Daftar Tagihan",'class="info_link link2"')?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor("courier/tarif","Tarif Zona",'class="info_link link2"')?></li>
<li><?=anchor("city","Master Kota",'class="info_link link2"')?></li>
<li><?=anchor("country","Master Negara",'class="info_link link2"')?></li>
<li><?=anchor("kecamatan","Master Kecamatan",'class="info_link link2"')?></li>
<li><?=anchor("courier/customer","Master Pelanggan",'class="info_link link2"')?></li>
<li><?=anchor("sysvar_data/view_list/lookup.service","Master Service",'class="info_link link2"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
