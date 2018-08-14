<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>LAPORAN UMUR PIUTANG</h2></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->street?></td><td></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->suite?></td>     	
     </tr>
     <tr>
     	<td>
     		<?=$model->city_state_zip_code?> - Phone: <?=$model->phone_number?>
     	</td>
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode Pelanggan</td><td>Nama Pelanggan</td>
	     				 <td>Jumlah</td><td>Saldo</td>
						<td> < 1 Hari<td>1-7Hari</td><td>7-14Hari</td>
						<td>14-30Hari</td><td>30-60Hari</td><td> >60 Hari</td>
						
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select * from qry_invoice where invoice_date between '$date1' and '$date2'
					order by sold_to_customer";
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$z_amount=0;		$z_payment=0;
				$z_retur=0;			$z_cr_amount=0;
				$z_db_amount=0;		$z_saldo=0;

				$a0_tot=0;				$a7_tot=0;
				$a14_tot=0;				$a30_tot=0;
				$a60_tot=0;				$aover_tot=0;
				
				$rows=$rst_so->result();
				$old_cust="";
				for($i=0;$i<count($rows);$i++){
					$row=$rows[$i];
					$old_cust=$row->sold_to_customer;
					$z_amount=$z_amount+$row->amount;
					$z_payment=$z_payment+$row->payment;
					$z_retur=$z_retur+$row->retur;
					$z_cr_amount=$z_cr_amount+$row->cr_amount;
					$z_db_amount=$z_db_amount+$row->db_amount;
					$saldo=$row->amount-$row->payment-$row->cr_amount+$row->db_amount-$row->retur;
					$z_saldo=$z_saldo+$saldo;
					$hari=round((strtotime($row->due_date)-strtotime(date('Y-m-d')))/3600/24);

					$a0=0;$a7=0;$a14=0;$a30=0;$a60=0;$aover=0;

					if($hari>60){
						$aover=$saldo;
					} else if ($hari>30) {
						$a60=$saldo;
					} else if ($hari>14) {
						$a30=$saldo;
					} else if ($hari>7) {
						$a14=$saldo;
					} else if ($hari>1) {
						$a7=$saldo;
					} else {
						$a0=$saldo;
					}
					$a0_tot=$a0_tot+$a0;
					$a7_tot=$a7_tot+$a7;
					$a14_tot=$a14_tot+$a14;
					$a30_tot=$a30_tot+$a30;
					$a60_tot=$a60_tot+$a60;
					$aover_tot=$aover_tot+$aover;
					
					 
					if($i<count($rows)-1){

						if($old_cust!=$rows[$i+1]->sold_to_customer){
							$tbl.="<tr>";
							$tbl.="<td>".($row->sold_to_customer)."</td>";
							$tbl.="<td>".$row->company."</td>";
							  
							$tbl.="<td align='right'>".number_format($z_amount)."</td>";
							$tbl.="<td align='right'>".number_format($z_saldo)."</td>";
							
							$tbl.="<td align='right'>".number_format($a0_tot)."</td>";
							$tbl.="<td align='right'>".number_format($a7_tot)."</td>";
							$tbl.="<td align='right'>".number_format($a14_tot)."</td>";
							$tbl.="<td align='right'>".number_format($a30_tot)."</td>";
							$tbl.="<td align='right'>".number_format($a60_tot)."</td>";
							$tbl.="<td align='right'>".number_format($aover_tot)."</td>";
							
							$tbl.="</tr>";
					
							$a0_tot=0;				$a7_tot=0;
							$a14_tot=0;				$a30_tot=0;
							$a60_tot=0;				$aover_tot=0;
							$z_amount=0; 			$z_saldo=0;
							
							 
						}
					}

               };
			   
			   $tbl.="<tr><td></td><td></td>  
	     				 
						<td align='right'>".number_format($z_amount)."</td>
						<td align='right'>".number_format($z_saldo)."</td>";
						
				$tbl.="<td align='right'>".number_format($a0_tot)."</td>";
				$tbl.="<td align='right'>".number_format($a7_tot)."</td>";
				$tbl.="<td align='right'>".number_format($a14_tot)."</td>";
				$tbl.="<td align='right'>".number_format($a30_tot)."</td>";
				$tbl.="<td align='right'>".number_format($a60_tot)."</td>";
				$tbl.="<td align='right'>".number_format($aover_tot)."</td>";
				$tbl.="</tr>";	
					
						
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
