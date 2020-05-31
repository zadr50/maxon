<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$salesman=$CI->input->post("text1");
	$cust=$CI->input->post("text2");
	$outlet=$CI->input->post("text3");	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan=2><h2><?=$model->company_name?></h2></td><td width=400>
     	    <h2>LAPORAN UMUR PIUTANG - BY INVOICE DATE, ITEM</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, 
     		Salesman: <?=$salesman?>, Pelanggan: <?=$cust?>, Outlet: <?=$outlet?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td colspan=6>Keterangan</td>
	     				<td align="right">Jumlah</td>
						<td align="right">0-30<td align="right">30-60</td>
						<td align="right">60-90</td><td align="right">Over</td>
						
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$tbl="";
				$z_amount=0;		$z_payment=0;
				$z_retur=0;			$z_cr_amount=0;
				$z_db_amount=0;		$z_saldo=0;
				$a0_tot=0;			$a0=0;
				$a7_tot=0;			$a7=0;
				$a14_tot=0;			$a14=0;
				$a30_tot=0;			$a30=0;
				$a60_tot=0;			$a60=0;
				$a90_tot=0;			$a90=0;
				$aover_tot=0;		$aover=0;
                $old_cust="";
     			$sql="select il.item_number,il.description from invoice i 
     			left join invoice_lineitems il on il.invoice_number=i.invoice_number 
     			where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2' ";
				if($cust!="")$sql.=" and i.sold_to_customer='$cust'";
				if($salesman!="")$sql.=" and i.salesman='$salesman'";
				if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
				$sql.=" group by il.item_number";
				
				
				if($qitem=$CI->db->query($sql)){
					foreach($qitem->result() as $ritem){
						

		                $a0_subtot=0;        $z_amount_sub=0;  
		                $a7_subtot=0;        $z_saldo_sub=0;  
		                $a14_subtot=0;         
		                $a30_subtot=0;         
		                $a60_subtot=0;         
		                $a90_subtot=0;         
		                $aover_subtot=0;       
		                $tbl_sub="";
		     			$sql="select i.invoice_date,il.amount as item_amount,i.payment_terms 
		     			from qry_invoice i 
		     			left join invoice_lineitems il on il.invoice_number=i.invoice_number 
		     			where i.invoice_date between '$date1' and '$date2' and il.item_number='$ritem->item_number'  ";
						if($cust!="")$sql.=" and i.sold_to_customer='$cust'";
						if($salesman!="")$sql.=" and i.salesman='$salesman'";
						if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
		                
		     			$rst_so=$CI->db->query($sql);		                
		                foreach($rst_so->result() as $row){
							$tgl_faktur=strtotime($row->invoice_date);
							$tgl_now=strtotime(date('Y-m-d H:i'));
							$hari=round(($tgl_now-$tgl_faktur)/3600/24);
							
							$due_date=due_date($row->invoice_date, $row->payment_terms);
							$hari=round((strtotime($due_date)-$tgl_faktur)/3600/24);
							
		                    $saldo=$row->item_amount;
 
		
							$a0=0;		$a7=0;		$a14=0;
							$a30=0;		$a60=0;		$a90=0;		$aover=0;
						
							if($hari>90){
								$aover=$saldo;
							} else if ($hari>60) {
								$a60=$saldo;
							} else if ($hari>30) {
								$a30=$saldo;
							} else {
								$a0=$saldo;
							}

							$z_saldo+=$saldo;
							
							$a0_tot=$a0_tot+$a0;					$a7_tot=$a7_tot+$a7;
							$a14_tot=$a14_tot+$a14;					$a30_tot=$a30_tot+$a30;
							$a60_tot=$a60_tot+$a60;					$aover_tot=$aover_tot+$aover;
	                        
	                        $z_saldo_sub+=$saldo;                   $a0_subtot=$a0_subtot+$a0;
	                        $a7_subtot=$a7_subtot+$a7;              $a14_subtot=$a14_subtot+$a14;
	                        $a30_subtot=$a30_subtot+$a30;           $a60_subtot=$a60_subtot+$a60;
	                        $aover_subtot=$aover_subtot+$aover;
		                            
		               }						
                        
                        $tbl="<tr><td colspan=6>$ritem->description ($ritem->item_number)</td>
                                <td align='right'>".number_format($z_saldo_sub)."</td>";
                                
                        $tbl.="<td align='right'>".number_format($a0_subtot)."</td>";
                        $tbl.="<td align='right'>".number_format($a30_subtot)."</td>";
                        $tbl.="<td align='right'>".number_format($a60_subtot)."</td>";
                        $tbl.="<td align='right'>".number_format($aover_subtot)."</td>";
                        $tbl.="</tr>";  
						
						echo $tbl;
					}
				}
			   $tbl="<tr><td colspan=2><b>TOTAL</b></td><td></td> 
	     				<td></td><td></td><td></td>
						<td align='right'><b>".number_format($z_saldo)."</b></td>";
						
				$tbl.="<td align='right'><b>".number_format($a0_tot)."</b></td>";
				$tbl.="<td align='right'><b>".number_format($a30_tot)."</b></td>";
				$tbl.="<td align='right'><b>".number_format($a60_tot)."</b></td>";
				$tbl.="<td align='right'><b>".number_format($aover_tot)."</b></td>";
				$tbl.="</tr>";	
					
						
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
