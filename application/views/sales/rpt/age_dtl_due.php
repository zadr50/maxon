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
     	    <h2>LAPORAN UMUR PIUTANG - BY DUE DATE</h2></td>     	
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
	     				<td>Nomor Faktur</td><td>Tanggal</td>
	     				<td>Customer</td>      				
	     				 <td>Termin</td><td>Jatuh Tempo</td><td>Hari</td>
						<td>Salesman</td><td align="right">Jumlah</td>
						<td align="right">Saldo</td>
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
     			$sql="select c.company,i.sold_to_customer from invoice i
     				left join customers c on c.customer_number=i.sold_to_customer 
     				where invoice_type='I' and invoice_date between '$date1' and '$date2' ";
				if($cust!="")$sql.=" and i.sold_to_customer='$cust'";
				if($salesman!="")$sql.=" and i.salesman='$salesman'";
				if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
				$sql.=" group by c.company,i.sold_to_customer";
				
				if($qcst=$CI->db->query($sql)){
					
					foreach($qcst->result() as $rcst){
		                $a0_subtot=0;        $z_amount_sub=0;  
		                $a7_subtot=0;        $z_saldo_sub=0;  
		                $a14_subtot=0;       $a30_subtot=0;         
		                $a60_subtot=0;       $a90_subtot=0;         
		                $aover_subtot=0;     $tbl_sub="";
						$is_header=false;
						
						$cust=$rcst->company;
						
		     			$sql="select * from qry_invoice i where invoice_date between '$date1' and '$date2'  ";				
						if($cust!="")$sql.=" and i.sold_to_customer='$rcst->sold_to_customer'";
						if($salesman!="")$sql.=" and i.salesman='$salesman'";
						if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
		                $sql.=" order by i.invoice_date";
		                
		     			$rst_so=$CI->db->query($sql);
						
						echo "<tr><td colspan=5><b>$rcst->company ($rcst->sold_to_customer)</b></tr>";
						
		                foreach($rst_so->result() as $row){
								
							$saldo=$row->amount-$row->payment
								+$row->cr_amount+$row->db_amount-$row->retur;
							$tgl_faktur=strtotime($row->invoice_date);
							
							$due_date=due_date($row->due_date, $row->payment_terms);
							$hari=round((strtotime($due_date)-strtotime(date('Y-m-d H:i')))/3600/24);
			
							$a0=0;		$a7=0;		$a14=0;
							$a30=0;		$a60=0;		$a90=0;		$aover=0;
						
							if($hari>90){
								$aover=$saldo;
							} else if ($hari>60) {
								$a60=$saldo;
							} else if ($hari>30) {
								$a30=$saldo;
							} else if ($hari>0) {
								$a0=$saldo;
							} else {
								$aover=$saldo;
							}
							
							if ($saldo!=0) {
								
			                    $tbl="<tr>";
			                    $tbl.="<td>".$row->invoice_number."</td>";
			                    $tbl.="<td>".date('Y-m-d',strtotime($row->invoice_date))."</td>";
			                    $tbl.="<td>".($row->sold_to_customer)."</td>";
			                   // $tbl.="<td>".$row->company."</td>";			                     
			                    $tbl.="<td>".$row->payment_terms."</td>";
			                    $tbl.="<td>".date('Y-m-d',strtotime($due_date))."</td>";
			                    $tbl.="<td>".$hari."</td>";			
			                    $tbl.="<td>".$row->salesman."</td>";
			                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";								
			                    $tbl.="<td align='right'>".number_format($saldo)."</td>";
			                    $tbl.="<td align='right'>".number_format($a0)."</td>";
			                    $tbl.="<td align='right'>".number_format($a30)."</td>";
			                    $tbl.="<td align='right'>".number_format($a60)."</td>";
			                    $tbl.="<td align='right'>".number_format($aover)."</td>";															
			                    $tbl.="</tr>";
								
								echo $tbl;
								
							
								$z_amount+=$row->amount;		$z_payment+=$row->payment;
								$z_retur+=$row->retur;			$z_cr_amount+=$row->cr_amount;
								$z_db_amount+=$row->db_amount;	$z_saldo+=$saldo;
								
								$a0_tot+=$a0;					$a7_tot+=$a7;
								$a14_tot+=$a14;					$a30_tot+=$a30;
								$a60_tot+=$a60;					$aover_tot+=$aover;
		                        
		                        $z_amount_sub+=$row->amount;
		                        $z_saldo_sub+=$saldo;	//$row->amount+$row->payment+$row->retur+$row->cr_amount+$row->db_amount;
		                        $a0_subtot+=$a0;			    $a7_subtot+=$a7;
		                        $a14_subtot+=$a14;
		                        $a30_subtot+=$a30;              $a60_subtot+=$a60;
		                        $aover_subtot+=$aover;
		                            
							}
		               }
                       $tbl="<tr><td colspan=7><b>SUB TOTAL [$row->company - $row->sold_to_customer]</b></td>
                                <td align='right'><b>".number_format($z_amount_sub)."</b></td>
                                <td align='right'><b>".number_format($z_saldo_sub)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format($a0_subtot)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format($a30_subtot)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format($a60_subtot)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format($aover_subtot)."</b></td>";
                        $tbl.="</tr>";  
                                                    
						echo $tbl;
														

					}					
				}
			   $tbl="<tr><td colspan=2><b>TOTAL</b></td><td></td><td></td> 
	     				<td></td><td></td><td></td>
						<td align='right'><b>".number_format($z_amount)."</b></td>
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
