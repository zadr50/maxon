<?php 
$img=base_url("images/ico_purchase.png");
if(isset($message)) echo "<div class='alert alert'>
<img src='$img' style='margin:10px'><strong>$message</strong></div>";
if(isset($content)) echo "<div class='thumbnail'>$content</div>";
?>