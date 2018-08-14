
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Tracking Inventory Items</title>
 
 </head>
 <body>
 <div id='container'>
   <h2>Tracking Inventory Items</h2>
   <h3>Silahkan masukan pencarian barang berdasarkan nomor lokasi atau rak</h3>
   <?php 
   echo $message;
   echo form_open('tracking/browse');
   ?>
   <form action="<?=base_url();?>index.php/tracking/browse" >
   	<table>
   		<tr>
   			<td>Location Number</td><td><input name='location'/></td>
   			<td>Bin</td><td><input name='bin'/></td>
   			<td><input type='submit' name='submit' value='Search'/></td>
   		</tr>
   		
   	</table>
   
   </form>
   <?=$table?>
   </div>
 </body>
</html>

