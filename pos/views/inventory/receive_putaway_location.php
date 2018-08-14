
<form action="<?=base_url()?>index.php/receive_putaway/next_step_3" method="POST">

<?php
 	 
	
		$this->db->select('shipment_id,date_received');
		$record=$this->db->get('inventory_card_header')->result();
	    $i=0;
		foreach ($record as $row){	
			$cek=$this->input->post($row->shipment_id);
			$sno='';
			if($row->shipment_id==$cek){
				$sno=$sno."'".$row->shipment_id."'";
			}
			if($sno!='')
			{
				$query=$this->db->query('select p.item_number,i.description,i.location,i.bin,p.quantity_received,p.id
				from inventory_products p left join inventory i on i.item_number=p.item_number
				where shipment_id in ('.$sno.')');
				if($query)
				{
					echo '<p>This view for receive number : <b>'.$sno.'</b></p>';
					echo '<table  id="hor-minimalist-b" border="0" cellpadding="4" cellspacing="0">';
					echo '<thead>';
					echo '<td>Location</td><td>Bin</td><td>Quantity</td><td>Item Number</td><td>Description</td>';
					echo '</thead>';
					echo '<tbody>';
					foreach($query->result() as $row)
					{
						$i++;
						echo '<tr>';
						
						echo '<td>
						<input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$row->id.'"/>
						<input style="width:50px" id="loc_'.$i.'" name="loc_'.$i.'" 
						value="'.$row->location.'"/>
						</td>
						<td><input type="text" style="width:50px" id="bin_'.$i.'" name="bin_'.$i.'" 
						value="'.$row->bin.'"/>
						</td>
						<td>'.$row->quantity_received.'</td>
						<td>'.$row->item_number.'</td><td>'.$row->description.'</td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
				}
		
			}
		}
	echo '<input type="submit" id="submit" name="submit" value="Finish"/>';
	echo '<input type="hidden" id="loc_max" name="loc_max" value="'.$i.'" />';
	echo '<input type="hidden" id="bin_max" name="bin_max" value="'.$i.'"  />';
			 
?>
</form>
