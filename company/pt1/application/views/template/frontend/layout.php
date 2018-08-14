<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
<head><title>MaxOn ERP Business Software</title></head>
<style>

.com_box {
    border: 1px solid $fff;
    margin: 10px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #B7B4B4;
}

</style>
<BODY>

<script>var CI_BASE='<?=base_url()?>';</script>
<?php echo $script_head; ?>       
 
<div class="container">
	<div class='row'>
		<?php
			require_once "header.php";
		?>
	</div>
	<div class="row">
		<div class='col-lg-12'>
			<div class="col-lg-2"  style='margin:20px'>
				<div class='row'>
					<a href='<?=base_url()?>index.php'>
					<img class='thumbnail' src="<?=base_url()?>images/logo_maxon.png" style="float:left"></a>
				</div>
				<div class='row'
					<p>Cloud computing service, handle your daily activities for sales, purchase,
						Receivable, Payables, Cash Book, Accounting, Payroll etc.
					</p>
				</div>
				<div class='row'>
				<legend>Create your company: </legend>
				<p><strong>http://www.maxonerp.com/</strong>
					<div class='form-group'>
					<input name='company' id='company' type='text' class='form-control'>
					<p></p>
					</div>
					<a href='#' onclick='new_company();return false' 
						class='btn btn-primary'>Submit</a>
				</p>
				</div>
			</div>
			<div class='col-lg-8'>
				<div id='content'>
					<div id='content_process'></div>
					<h1>Registered Company List</h1>
					<div id='com_list'>
					<legend>Registered Company</legend>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>   
  
		
</BODY>
 
<?php echo $library_src; ?>
<script src="<?=base_url()?>assets/bootbox/bootbox.min.js"></script>
<script src="<?=base_url()?>assets/frontend/frontend.js"></script>
<script>
$( document ).ready(function() {
    console.log( "ready!" );
	company_list();
});
</script>
