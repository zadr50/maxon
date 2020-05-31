<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Ticketing Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
						<?php echo info_link("ticketing/sales","Penjualan Ticket");?>
					</ul>
				</li>
				<li   data-options="state:'closed'">					
					<span>Report</span>
					<?php include "menu_reports.php" ?>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul><?=info_link("customer","Member atau Pelanggan");?></ul>
					<ul><?=info_link("ticketing/ticket_type","Setting Harga Ticket");?></ul>
				</li>
			</ul>
		</li>
	</ul>
