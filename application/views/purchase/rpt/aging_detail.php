<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $supplier=$CI->input->post("text1");
	$saldo_nol=$CI->input->post("text2");
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
        <td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>LAPORAN UMUR HUTANG</h2></td>       
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
            Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Supplier: <?=$supplier?>
        </td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
                <table class='titem'>
                <thead>
                    <tr><td>Tanggal</td><td>Nomor Faktur</td><td>Kode</td><td>Nama</td>
                         <td>Termin</td><td>Jatuh Tempo</td><td>Hari JTP</td>
                        <td>Jumlah</td><td>Saldo</td>
                        <td><1Hari</td><td>1-7Hari</td><td>7-14Hari</td>
                        <td>14-30Hari</td><td>30-60Hari</td><td> >60 Hari</td>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql="select p.supplier_number,s.supplier_name  
                 from purchase_order p 
                 left join suppliers s on s.supplier_number=p.supplier_number 
                 where p.potype='I' and p.po_date between '$date1' and '$date2'  ";
                if($supplier!="")$sql.=" and p.supplier_number='$supplier'";
				$sql.=" group by s.supplier_name ";

                $tbl="";
                $z_amount=0;        $z_payment=0;
                $z_retur=0;         $z_cr_amount=0;
                $z_db_amount=0;     $z_saldo=0;
                $a0_tot=0;			$a7_tot=0;
                $a14_tot=0;			$a30_tot=0;	                
                $a60_tot=0;			$aover_tot=0;
	                
				$rst_supp_tran=$CI->db->query($sql);
				foreach($rst_supp_tran->result() as $supp_list){
						
					$supplier=$supp_list->supplier_number;	
					
	                $z_amount_sup=0;        $z_payment_sup=0;
	                $z_retur_sup=0;         $z_cr_amount_sup=0;
	                $z_db_amount_sup=0;     $z_saldo_sup=0;
	                $a0_tot_sup=0;			$a7_tot_sup=0;	                
	                $a14_tot_sup=0;			$a30_tot_sup=0;	                
	                $a60_tot_sup=0;			$aover_tot_sup=0;
					
	               $tbl.="<tr><td colspan=9><b>$supp_list->supplier_name</b></td><td></td><td></td><td></td><td></td> 
                        <td></td><td></td>";

	                $sql="select p.po_date,p.purchase_order_number,p.supplier_number,
	                 s.supplier_name,p.terms,p.due_date,p.amount,pay.payment,
	                 retur
	                 from purchase_order p 
	                 left join (
	                 	select purchase_order_number,sum(amount_paid) as payment
	                 	from payables_payments 
	                 	group by purchase_order_number
	                 	) as pay on pay.purchase_order_number=p.purchase_order_number
	                 left join suppliers s on s.supplier_number=p.supplier_number 
	                 left join (select po_ref,sum(amount) as retur 
	                 	from purchase_order where potype='R' 
	                 	 and po_date between '$date1' and '$date2' 
	                 	group by purchase_order_number) as r 
	                 	on r.po_ref = p.purchase_order_number
	                 where p.potype='I' and p.po_date between '$date1' and '$date2'  ";
	                
	                if($supplier!="")$sql.=" and p.supplier_number='$supplier'";
	                
	                //echo $sql;
	                
	                $rst_so=$CI->db->query($sql);
					
	
	                foreach($rst_so->result() as $row){
	                    $payment=$row->payment;
	                    $db_memo=0;
	                    $cr_memo=0;
	                    $retur=$row->retur;
	                    $saldo=$row->amount-$payment-$cr_memo+$db_memo-$retur;
	                    $hari=round((strtotime($row->due_date)-strtotime(date('Y-m-d')))/3600/24);
		                $a0=0;$a7=0;$a14=0;$a30=0;$a60=0;$aover=0;
	                    	                    
	                    if($saldo!=0 || $saldo_nol=="1"){
		                    $tbl.="<tr>";
		                    $tbl.="<td>".$row->po_date."</td>";
		                    $tbl.="<td>".$row->purchase_order_number."</td>";
		                    $tbl.="<td>".($row->supplier_number)."</td>";
		                    $tbl.="<td>".$row->supplier_name."</td>";
		                     
		                    $tbl.="<td>".$row->terms."</td>";
		                    $tbl.="<td>".$row->due_date."</td>";
		                    $tbl.="<td>".$hari."</td>";
		
		                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";
		                    $tbl.="<td align='right'>".number_format($saldo)."</td>";
		                    
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
		                    $tbl.="<td align='right'>".number_format($a0)."</td>";
		                    $tbl.="<td align='right'>".number_format($a7)."</td>";
		                    $tbl.="<td align='right'>".number_format($a14)."</td>";
		                    $tbl.="<td align='right'>".number_format($a30)."</td>";
		                    $tbl.="<td align='right'>".number_format($a60)."</td>";
		                    $tbl.="<td align='right'>".number_format($aover)."</td>";
		                    
		                    $tbl.="</tr>";	                    	

		                    $z_amount=$z_amount+$row->amount;
		                    $z_payment=$z_payment+$payment;
		                    $z_retur=$z_retur+$retur;
		                    $z_cr_amount=$z_cr_amount+$cr_memo;
		                    $z_db_amount=$z_db_amount+$db_memo;
		                    $z_saldo=$z_saldo+$saldo;
		                    
		                    $a0_tot=$a0_tot+$a0;
		                    $a7_tot=$a7_tot+$a7;
		                    $a14_tot=$a14_tot+$a14;
		                    $a30_tot=$a30_tot+$a30;
		                    $a60_tot=$a60_tot+$a60;
		                    $aover_tot=$aover_tot+$aover;
		                    
			                $z_amount_sup+=$row->amount;        $z_payment_sup+=$payment;
			                $z_retur_sup+=$retur;         $z_cr_amount_sup+=$cr_memo;
			                $z_db_amount_sup+=$db_memo;     $z_saldo_sup+=$saldo;
			                $a0_tot_sup+=$a0;			$a7_tot_sup+=$a7;	                
			                $a14_tot_sup+=$a14;			$a30_tot_sup+=$a30;	                
			                $a60_tot_sup+=$a60;			$aover_tot_sup+=$aover;
							
	                    }	                    

						
	               };
	               
	               $tbl.="<tr><td colspan=4><b>SUB TOTAL [$supp_list->supplier_name]</b></td><td></td> 
	                        <td></td><td></td>
	                        <td align='right'><b>".number_format($z_amount_sup)."</b></td>
	                        <td align='right'><b>".number_format($z_saldo_sup)."</b></td>";
	                        
	                $tbl.="<td align='right'><b>".number_format($a0_tot_sup)."</b></td>";
	                $tbl.="<td align='right'><b>".number_format($a7_tot_sup)."</b></td>";
	                $tbl.="<td align='right'><b>".number_format($a14_tot_sup)."</b></td>";
	                $tbl.="<td align='right'><b>".number_format($a30_tot_sup)."</b></td>";
	                $tbl.="<td align='right'><b>".number_format($a60_tot_sup)."</b></td>";
	                $tbl.="<td align='right'><b>".number_format($aover_tot_sup)."</b></td>";
	                $tbl.="</tr>";  
		                              
				}
                              
               $tbl.="<tr><td colspan=2><b>TOTAL</b></td><td></td><td></td><td></td> 
                        <td></td><td></td>
                        <td align='right'><b>".number_format($z_amount)."</b></td>
                        <td align='right'><b>".number_format($z_saldo)."</b></td>";
                        
                $tbl.="<td align='right'><b>".number_format($a0_tot)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($a7_tot)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($a14_tot)."</b></td>";
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
