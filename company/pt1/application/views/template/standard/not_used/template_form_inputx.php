<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <htmlxmlns="http://www.w3.org/1999/xhtml"xml:lang="en"lang="en">
 <head>
<meta http-equiv="content-type" content="text/html; charset=utf-"/>
<link rel="stylesheet" type="text/css" href="../../themes/standard/style.css">
<link rel="stylesheet" type="text/css" href="../../themes/standard/nav_menu.css">
<link rel="stylesheet" type="text/css" href="../../js/jquery-ui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../js/jquery-ui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../../js/jquery-ui/themes/demo.css">

<script type="text/javascript">
        CI_ROOT = "<?=base_url();?>index.php/";
</script>	 

<?
    if(!$this->access->is_login())redirect(base_url());
?>

<title>MaxOn POS (Point Of Sales)</title>
 </head>

<body>
 
 <div id="wrap">
	 <div id="header">
		 <!-- Area Header-->
		 <?php echo $_header;?>
	 </div>	 
        <div id="message"><?=$message?></div>
	 <div id="contentwrap">
            <div id="content">
               <?php echo $_contentx;?>
           </div>
             <div id="contentright"><?php echo $_right_menu?></div>
	 </div>
     
 
 </div>

</body>

</html>
