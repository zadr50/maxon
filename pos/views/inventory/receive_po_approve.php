
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Process Approve Receive Items</title>
 
 </head>
 <body>
	<div id='container'>
	   <h2>Process Approve Receive Items</h2>
	   <h3>Formulir ini dipakai untuk memvalidasi penerimaan barang di gudang sebelum masuk stock</h3>
		<?php echo $message;?>
	   <?php echo validation_errors(); ?>
	   <?php echo form_open('receive_approve/process');?>
	   <?php 
		$this->db->select('shipment_id,date_received');
		$this->db->where('approved','0');
		$this->db->or_where('approved is null',NULL,FALSE);
		$record=$this->db->get('inventory_card_header')->result();
	    echo '<h1>';
		foreach ($record as $row)
		{
			echo '</br>';
			echo form_checkbox($row->shipment_id,$row->shipment_id);
			echo $row->shipment_id.' - '.$row->date_received;		
		}
		echo '</h1>';
	   ?>
  	   <br/><input type="submit" value="SAVE"/>
	   <?php echo form_close();?>
   </div>
 </body>
</html>

