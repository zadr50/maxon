
	   <h2>Workorder Picking</h2>
	   <h3>Formulir ini dipakai memilih nomor bukti workorder untuk dipersiapkan
	   	pada proses selanjutnya yaitu pengecekan stock dan packing</h3>
		<?php echo $message;?>
	   <?php echo validation_errors(); ?>
	   <?php echo form_open('picking/next_step_2');?>
	   <?php 
		$this->db->select('wo_number,wo_date,so_number,customer');
		$this->db->where('picking','0');
		$this->db->or_where('picking is null',NULL,FALSE);
		$record=$this->db->get('workorder')->result();
		echo '<table  id="hor-minimalist-b" border="0" cellpadding="4" cellspacing="0">';
		echo '<thead><tr>';
		echo '<th>WO Number</th><th>Date</th><th>SO Number</th><th>Customer</th><th>&nbsp</th>';
		echo '</tr></thead>';
		echo '<tbody>';
		$i=0;
		foreach ($record as $row)
		{
			$i++;
			echo '<tr>';
			echo "<td><input type='checkbox' name='id_".$i."' value='".$row->wo_number."'/>".$row->wo_number."</td>";
			echo "<td>".$row->wo_date.'</td><td>'.$row->so_number.'<td>'.$row->customer.'</td><td>&nbsp</td>';		
			echo '</tr>';
			
		}
		echo '</tbody>';
		echo '</table>';
		echo "<input type='hidden'  name='row_count' value='".$i."'/>";
	   ?>
  	   <br/><input type="submit" value="Next Step"/>
	   <?php echo form_close();?>
 
