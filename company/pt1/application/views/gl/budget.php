<?php 
echo "<strong>Tahun :".form_input('fiscal_year',$fiscal_year,"style=width:50px");
echo form_button("submit","Refresh")."</strong></br>";
echo "<table border=1 class='table'><thead><th>Keterangan</th><th>RKAP</th><th>Aktual</th><th>Variance</th>
	<th>Aktual Last Year</th><th>Inc (Dec)</th><th>%</th></thead>";
echo "<tbody>";
echo "<tr><td><a href='".base_url()."index.php/budget/load/4'>REVENUE</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td><a href='".base_url()."index.php/budget/load/5'>COGS</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td>GROSS PROFIT</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td><a href='".base_url()."index.php/budget/load/6'>OPEX</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td><a href='".base_url()."index.php/budget/load/8'>OPERATING INCOME</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td>NET INCOME (LOSS)</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td>GROSS PROFIT</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td><a href='".base_url()."index.php/budget/load/9'>EBITDA</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "<tr><td><a href='".base_url()."index.php/budget/load/10'>PRODUKSI</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
echo "</tbody>";
echo "</table>";


?>