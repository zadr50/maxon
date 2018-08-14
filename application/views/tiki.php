<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>JNE Tracking Number Script</title>
</head>
<div class="panel panel-primary " style="margin-bottom:10px">
	<div class="panel-heading"> 
		<h3 class="panel-title   glyphicon glyphicon-log-in "  style="padding:10px;color:white"> USER LOGIN</h3>
		 
	</div>
	<div class="panel-body"   style="padding:10px;">
		<body>
		<?
		if(isset($_POST['kode'])){
			$kode = $_POST["kode"];
			if ($kode!="") {
				header("Location: http://www.jne.co.id/index.php?mib=tracking.detail&awb=$kode&awb_list=$kode,");
			}
		} else {
		?>
			<b>CEK STATUS PENGIRIMAN TIKI JNE</b>
			<br />
			<form method="POST" action="" target="jne">
			Kode Tracking: <input type="text" size="12" name="kode"> 
			<input type="submit" value="Cek Status" name="submit"><br />
			</form>
		<? } ?>
		<iframe name="jne" width="1000" height="500"/>
	</div>	
</div>


</body>
</html>


