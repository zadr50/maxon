 <?php
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 

	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="rowx">
			<div class="col-xs-11 thumbnail">
				<?php
				add_button_menu("Member","customer","ico_payroll.png",
						"Pendaftar nama member atau customer terdaftar");
				add_button_menu("Ticket Sales","ticketing/sales","ico_sales.png",
						"Penjualan ticketing.");					
				?>
			</div>
			
		</div>
		<div class="rowx">
			<div class="col-xs-11 thumbnail">
				<legend>Reports</legend>
				<?php include "menu_reports.php" ?>
			</div>
			
		</div>
	</div>
</div>
