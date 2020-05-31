<?php 
$img=base_url("images/ico_purchase.png");
if(isset($message)) {
	echo "<div class='container'>";
	echo "<div class='col-md-6 thumbnail text-center' style='margin-top:50px;'>";
	echo "<div class='alert alert'>
		<img src='$img' width=50 height=50 style='margin:10px'><strong>$message</strong></div>";
	if(isset($content)) echo "<div class='thumbnail'>$content";
	echo "</div>";
	echo "</div>";
	echo "</div>";
}
?>