<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Manufactur Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor('manuf/workorder','Work Order (WO)','class="info_link link2"');?></li>
<li><?=anchor('manuf/work_exec','Work Execute (WOE/SPK)','class="info_link link2"');?></li>
<li><?=anchor('manuf/mat_release','Material Release (MR)','class="info_link link2"');?></li>
<li><?=anchor('manuf/receive_prod','Receive Products','class="info_link link2"');?></li>
<!--
<li><?=anchor('manuf/cancel_prod','Cancel Production','class="info_link link2"');?></li>
-->
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
<li><?=anchor('manuf/reports/wo/001','Daftar Work Order','class="info_link link2"')?></li>
<li><?=anchor('manuf/reports/wo/002','Daftar Work Order Detail','class="info_link link2"')?></li>
<li><?=anchor('manuf/reports/woe/001','Daftar Work Execute','class="info_link link2"')?></li>
<li><?=anchor('manuf/reports/woe/002','Daftar Work Execute Detail','class="info_link link2"')?></li>
<li><?=anchor('manuf/reports/mr/001','Daftar Material Release','class="info_link link2"')?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('manuf/product','Barang Produksi (Products)','class="info_link link2"')?></li>
<li><?=anchor('manuf/material','Bahan Baku (Materials)','class="info_link link2"')?></li>
<li><?=anchor('manuf/product_cost','Tenaga Kerja','class="info_link link2"')?></li>
<li><?=anchor('manuf/dept_prod','Department Produksi','class="info_link link2"')?></li>
<li><?=anchor('manuf/product_person','Pelaksana','class="info_link link2"')?></li>
<li><?=anchor('manuf/machine','Mesin Produksi','class="info_link link2"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
