<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, 
maximum-scale=1.0, user-scalable=no">
<head><title>MaxOn ERP Online Demo</title></head>
<body>
 <script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>"; 		
</script>
<?php
date_default_timezone_set("Asia/Jakarta");
echo $library_src;
echo $script_head;
?>
<div class="container-fluid bg-all" style='padding-top:1px;margin-top:-1px'>
	<div class='row bg-banner' style="border-bottom:10px solid black">
	<?php include_once "header.php" ?>
	<?php include_once 'box_crumb.php' ?>
	</div>
	<div class='row' style='padding:10px'>
		<div class="col-md-3">
			<?php include_once "left_menu.php"; ?>
		</div>
		<div class="col-md-8" style='margin-left:10px'>
		<?php	
		$this->load->view($file_content);
		?>
		</div> 
	</div>
	<div class='row' style="border-top:10px solid black"><?php include_once "footer.php" ?></div>
</div>
</body>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">