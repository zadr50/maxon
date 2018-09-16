<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head><title><?php 
if(!isset($title)){
	echo "Sistim Informasi Sekolah";	
} else {
	echo $title;
}
?></title></head>
<BODY>

<script>var CI_BASE='<?=base_url()?>';</script>
<?php 
echo $script_head; 

?>       
 
<?php include_once "header.php"; ?>
<div class='col-lg-12' style="min-height:500px">
	<?=load_view($file_content)?>
</div>
<?php include_once "footer.php"; ?>
  
		
</BODY>
 
<?php echo $library_src; ?>
<script src="<?=base_url()?>assets/bootbox/bootbox.min.js"></script>
<script src="<?=base_url()?>assets/frontend/frontend.js"></script>
<script>
$( document ).ready(function() {
	
	
});
</script>
