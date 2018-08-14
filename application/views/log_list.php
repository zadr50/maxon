<div class='alert alert-info'>
	<form method='post'>
		<label>Nomor Bukti: <input value='<?=$nomor?>' type='text' name='nomor' style='width:140px'></label>
		<label>User: <input  value='<?=$user?>' type='text' name='user' style='width:100px'></label>
		<label>Jenis: <input  value='<?=$jenis?>' type='text' name='jenis' style='width:100px'></label>
		<input type='submit' value='Filter'>
	</form>
</div>
<?php
		echo "<table class='table' width='100%'>
		<thead><th>TglJam</th><th>UserId</th><th>Jenis</th><th>Run</th>
		<th>Nomor Bukti</th></thead><tbody>";
		if($syslog){
			echo "<tr>";
			foreach($syslog->result() as $row){
				echo "<td>$row->tgljam</td><td>$row->userid</td>
				<td>$row->jenis</td><td>$row->jenis_cmd</td>
				<td>$row->no_bukti</td></tr>";
			}
			echo "</tr>";
		}		
		echo "</tbody></table>";


?>