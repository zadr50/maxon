 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <htmlxmlns="http://www.w3.org/1999/xhtml">
 <head>
 <metahttp-equiv="Content-Type"content="text/html; charset=iso-8859-1"/>
 <title>Daftar Supplier</title>
 <linkhref="<?php echo base_url();?>public/style.css"
 rel="stylesheet"type="text/css"/>
 </head>
 <body>

 <div id="wrap">
	 <div id="header">
		 <!-- Area Header-->
		 <?php echo $_header;?>
                 
	 </div>	 
	
	 <div id="contentwrap">
	 	<div id='contenttop'><?php echo $_content_top;?></div>
		 <div id="content">
		 <!--Area content-->
			<?php echo $_content;?>		 

		</div>
        </div>
        <? echo $_footer; ?>
 </div>  

</body>
</html>