<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>     
   <link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
   <title><?php  echo $caption; ?></title>
 </head>
 
 <body>
 	<div id='hd' >
	   	<div id='hd_left'  >
	    	<?php 
			if( !isset($header)) $header="";
				echo $header;
			?> 
	    </div>
	    <div id='hd_right' >
	   		<h1><?php echo $caption?></H1>
	   	</div>
   	</div>
        <?php 
        if(isset($criteria)){
            echo "<div>$criteria</div>";
        }
        
        ?>
   	
   	<div  >
   		<?php 
		if(isset($before_print))echo load_view($before_print);
		echo $content;		
		?>		  
    </div>      
	<div class='sql clearfix'>
		<? if(isset($sql)) //echo $sql; ?>
	</div>
 </body>
</html>

