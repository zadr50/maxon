<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('purchase_order_model');
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
            Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
        </td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
                <table class='titem'>
                <thead>
                    <tr><td>Kode</td><td>Nama Supplier</td>
                         <td>Jumlah</td><td>Saldo</td>
                         <td><1Hari</td><td>1-7Hari</td><td>7-14Hari</td>
                        <td>14-30Hari</td><td>30-60Hari</td><td> >60 Hari</td>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql="select p.supplier_number,s.supplier_name,
                p.amount,p.due_date,s.supplier_name,pay.payment,retur
                 from purchase_order p 
                 
	                 left join (
	                 	select purchase_order_number,sum(amount_paid) as payment
	                 	from payables_payments 
	                 	group by purchase_order_number
	                 	) as pay on pay.purchase_order_number=p.purchase_order_number
	                 
	                 left join (select po_ref,sum(amount) as retur 
	                 	from purchase_order where potype='R' 
	                 	where po_date between '$date1' and '$date2' 
	                 	group by purchase_order_number) as r 
	                 	on r.po_ref = p.purchase_order_number
	                 	                                  
                 left join suppliers s on s.supplier_number=p.supplier_number
                  where p.potype='I' and p.po_date between '$date1' and '$date2'
                  order by p.supplier_number,s.supplier_name";
                  
                  
                $rst_so=$CI->db->query($sql);
                
                $tbl="";
                $z_amount=0;        $z_payment=0;
                $z_retur=0;         $z_cr_amount=0;
                $z_db_amount=0;     $z_saldo=0;

                $a0_tot=0;              $a7_tot=0;
                $a14_tot=0;             $a30_tot=0;
                $a60_tot=0;             $aover_tot=0;
                
                $z_amount_totg=0;		 $z_saldo_totg=0;
                $a0_totg=0;              $a7_totg=0;
                $a14_totg=0;             $a30_totg=0;
                $a60_totg=0;             $aover_totg=0;
                                
                $rows=$rst_so->result();
                $old_cust="";
                for($i=0;$i<count($rows);$i++){
                    $row=$rows[$i];
                    $payment=$row->payment;
                    $cr_amount=0;
                    $db_amount=0;
                    $retur=$row->retur;
                    $old_cust=$row->supplier_number;
                    $z_amount=$z_amount+$row->amount;
                    $z_payment=$z_payment+$payment;
                    $z_retur=$z_retur+$retur;
                    $z_cr_amount=$z_cr_amount+$cr_amount;
                    $z_db_amount=$z_db_amount+$db_amount;
                    $saldo=$row->amount-$payment-$cr_amount+$db_amount-$retur;
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
					
                    $z_amount_totg+=$z_amount;
					$z_saldo_totg+=$z_saldo;
                    $a0_totg+=$a0;
					$a7_totg+=$a7;
					$a14_totg+=$a14;
					$a30_totg+=$a30;
					$a60_totg+=$a60;
					$aover_totg+=$aover;
					 
                    if($i<count($rows)-1){

                        if($old_cust!=$rows[$i+1]->supplier_number || $i==0){
                        	if($z_saldo!=0 || $saldo_nol=="1"){
	                            $tbl.="<tr>";
	                            $tbl.="<td>".($row->supplier_number)."</td>";
	                            $tbl.="<td>".substr($row->supplier_name,0,30)."</td>";
	                              
	                            $tbl.="<td align='right'>".number_format($z_amount)."</td>";
	                            $tbl.="<td align='right'>".number_format($z_saldo)."</td>";
	                            
	                            $tbl.="<td align='right'>".number_format($a0_tot)."</td>";
	                            $tbl.="<td align='right'>".number_format($a7_tot)."</td>";
	                            $tbl.="<td align='right'>".number_format($a14_tot)."</td>";
	                            $tbl.="<td align='right'>".number_format($a30_tot)."</td>";
	                            $tbl.="<td align='right'>".number_format($a60_tot)."</td>";
	                            $tbl.="<td align='right'>".number_format($aover_tot)."</td>";
	                            
	                            $tbl.="</tr>";
                        		
                        	}
                    
                            $a0_tot=0;              $a7_tot=0;
                            $a14_tot=0;             $a30_tot=0;
                            $a60_tot=0;             $aover_tot=0;
                            $z_amount=0;            $z_saldo=0;
                            
                             
                        }
                    }

               };
               
               $tbl.="<tr><td></td><td><b>GRAND TOTAL</b></td>  
                         
                        <td align='right'><b>".number_format($z_amount_totg)."</b></td>
                        <td align='right'><b>".number_format($z_saldo_totg)."</b></td>";
                        
                $tbl.="<td align='right'><b>".number_format($a0_totg)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($a7_totg)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($a14_totg)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($a30_totg)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($a60_totg)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($aover_totg)."</b></td>";
                $tbl.="</tr>";  
                    
                        
               echo $tbl;
                                                   
            ?>  
                </tbody>
            </table>
        
        </td>
     </tr>
</table>
