
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Process Penyimpanan Items - Put Away</title>
 
 </head>
 <body>
	<div id='container'>
	   <h2>Process Penyimpanan Items - Put Away</h2>
	   <h3>Formulir ini dipakai untuk menyimpan barang yang diterima berdasarkan 
	   rak dan poisinya barang tersebut</h3>
		<?php echo $message;?>
	   <?php echo validation_errors(); ?>
	   <?php echo form_open('receive_putaway/next_step_2');?>
	   <?php 
		$this->db->select('shipment_id,date_received');
		$this->db->where('putaway','0');
		$this->db->or_where('putaway is null',NULL,FALSE);
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
  	   <br/><input type="submit" value="Next Step"/>
	   <?php echo form_close();?>
   </div>
 </body>
</html>

