<?php 
$year=date("Y");

?>


<!-- Main row -->

<div class="row">
	<div class="row">
       		<?php include_once "badge_top.php" ?>
  	</div>
  	<div class='row'>
      		<div class="col-md-5">
      			<?php include_once "nota_header.php" ?>
      		</div>
      		<div class='col-md-7'>
	      		<?php include_once "button_nota.php"; ?>      			
      		</div>
    </div>
	<div class="col-md-7">
		<?php include_once "categories.php"; ?>
		<?php include_once "items.php"; ?>
	</div><!-- /.col -->
	
	<div class="col-md-5">
		<?php include_once "nota_output.php"; ?>
	</div><!-- /.row -->

	<div class="row">
	    <div class="col-md-12">
	    	<?php include_once "sales_chart.php"; ?>
	    </div>
	    <!-- /.col -->
	</div>
	<div class='row'>
	  	<div class='col-md-12'>
		  	<div class="col-md-6">
		  		<?php include_once "product_list.php"; ?>
		    </div><!-- /.col -->			  
			<div class="col-md-6">
		    	<?php include_once "goal.php"; ?>
		    </div>
		</div>    
	</div>			  
</div>
