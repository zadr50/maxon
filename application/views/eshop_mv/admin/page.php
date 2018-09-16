<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, 
maximum-scale=1.0, user-scalable=no">
 <script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>
<head><title>MaxOn ERP Online Demo</title></head>
<body style='background-color: rgb(92, 92, 92);'>
<?php
date_default_timezone_set("Asia/Jakarta");
echo $library_src;
echo $script_head;
?>

<div class="container">
	<div class='row col-md-12 col-sm-12 col-lg-12'><? include_once "header.php" ?></div>
	<div class='row col-md-12 col-sm-12 col-lg-12'>
		<div class='container'>
		
		<div class="col-md-8">
			<?	$this->load->view($file_content); ?>
		</div> 
		</div>
	</div>
	<div class='row col-md-12 col-sm-12 col-lg-12'>
		<div class='container'>
		<div class='col-md-10 col-sm-10 col-lg-10'>
			<?php include_once "footer.php" ?>
		</div>
		</div>
	</div>
</div>
</body>
<style>
body {
	--background-color: white;
}
</style>	
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">