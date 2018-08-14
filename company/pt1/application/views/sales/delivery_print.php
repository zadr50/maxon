<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>     
    <link href="<?php echo base_url();?>/public/style_print.css" rel="stylesheet">
   <title>Surat Jalan</title>
 </head>
 
 <body>
 <div id='container'>
   <div class='box6'>
    <?=$header?> 
   <h1> style="text-align: center"SURAT JALAN</h1>
<table>     
    <tr><td>Nomor</td>
        <td><?='<h2>'.$invoice_number.'</h2>';?></td>        
    </tr>
     <tr><td>Tanggal</td><td><?=$invoice_date;?>
         </td></tr>
     <tr><td>Customer</td><td><?=$cust_info;?></td></tr>
  
     <tr><td colspan='4'>
             <div id='divItems'>
             <?php echo $lineitems;?>
             </div>
         
         </td></tr>
     <tr><td colspan="4"><h1>Total Rp. <?=number_format($amount)?></h1></td></tr>
</table>	
	  
    </div>
      
   </div>
     
 </body>
</html>

