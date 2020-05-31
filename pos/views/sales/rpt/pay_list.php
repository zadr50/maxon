<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $CI->load->model('invoice_model');
     $CI->load->model('shipping_locations_model');
     
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));    
    $outlet=$CI->input->post('text1');    
    $outlet_name=$CI->shipping_locations_model->outlet($outlet);
    $rekening=$CI->input->post("text2");
    $outlet_name="";
    $company_name="";
    if($outlet!=""){
        if($qgdg=$CI->shipping_locations_model->get_by_id($outlet)){
            if($gdg=$qgdg->row()){
                $outlet_name=$gdg->attention_name;
                $company_code=$gdg->company_name;
                if($company_code!=""){
                    if($qcom=$CI->db->query("select company_name from preferences 
                        where company_code='$company_code' ")){
                            if($rcom=$qcom->row()){
                                $company_name=$rcom->company_name;
                            }
                        }
                }
                
            }
        }
        if($outlet_name==""){
            $outlet_name=$CI->shipping_locations_model->outlet($outlet);            
        }
    }
    
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>DAFTAR PEMBAYARAN</h2></td>     	
     </tr>
     <tr><td>Outlet: <?=$outlet.'-'.$outlet_name?></td></tr>
     <tr><td>Perusahaan: <?=$company_name?></td></tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Rekening: <?=$rekening?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Nomor Bukti#</td><td>Tanggal</td>
					<td align='right'>Jumlah Bayar</td> 
					<td>Faktur#</td> 
					<td>Salesman</td><td>Rekening</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			
     			$total=0;
                
     			$sql="select p.how_paid 
     			from payments p
                where p.date_paid between '$date1' and '$date2'  ";
                $sql.=" group by p.how_paid	";
                $qpay=$CI->db->query($sql);
                $tbl="";
                foreach($qpay->result() as $rpay){

                    $tbl.= "<tr><td colspan=6><strong>Jenis: $rpay->how_paid</strong></td></tr>";
                    
                    $sql="select p.no_bukti,p.date_paid,p.amount_paid,
                    p.invoice_number,i.salesman,p.account_number
                    from payments p left join invoice i on i.invoice_number=p.invoice_number
                    
                    where p.date_paid between '$date1' and '$date2'  
                    and p.how_paid='$rpay->how_paid'";
                    
                    if($outlet!="")$sql.=" and i.warehouse_code='$outlet' ";
                    
                    if($rekening!=""){
                        $sql.=" and p.account_number='$rekening'";
                    }
					if ($rpay->how_paid=='CARD'){                                        
	                    $sql.=" order by p.account_number";
					} else {
	                    $sql.=" order by i.invoice_number";						
					}
                    //echo "<br>$sql";
                    
                    $rst_so=$CI->db->query($sql);
                    
                    
                    
                    $sub_total=0;
                    $acc_old="";
					$acc_new="";
					$acc_subttl=0;
					$acc_no="";
                     foreach($rst_so->result() as $row){
                        	
                        $acc_old=$acc_new;	
                        $warehouse_code=$CI->invoice_model->warehouse($row->invoice_number);
                        $account_number=$row->account_number;
                         
                        $rek="";
						$acc_no="";
                        if($account_number==""){
                            //kalau gak ada di payment cari di kas masuk
                            $s="select cw.account_number,b.bank_name,coa.account_description 
                            from check_writer cw 
                            left join chart_of_accounts coa on coa.id=cw.account_number
                            left join bank_accounts b on b.bank_account_number=cw.account_number 
                            where cw.voucher='$row->no_bukti' ";
                            if($qcw=$CI->db->query($s)){
                                if($rcw=$qcw->row()){
                                    $account_number=$rcw->account_number.'-'.$rcw->bank_name;
									$acc_no=$rcw->account_number;
                                }
                            }
                        } else {
                            $s="select bank_name from bank_accounts 
                            where bank_account_number='$account_number' ";
                            if($qbank=$CI->db->query($s)){
                                if($rbank=$qbank->row()){
                                    $account_number.=" - $rbank->bank_name";
                                }
                            }
                            $acc_no=$account_number;
                        }
                        if($outlet==$warehouse_code || $outlet==''){
                        	
                     
                            $tbl.="<tr>";
                            $tbl.="<td>".$row->no_bukti."</td>";
                            $tbl.="<td>".($row->date_paid)."</td>";
                            $tbl.="<td align='right'>".number_format($row->amount_paid)."</td>";
                            $tbl.="<td>".$row->invoice_number."</td>";
                            $tbl.="<td>".($row->salesman)."</td>";
                            $tbl.="<td>$account_number</td>";
                            $tbl.="</tr>";
                            
                            $sub_total+=$row->amount_paid;
                            $total+=$row->amount_paid;

							if($rpay->how_paid=="CARD"){
		   						$acc_subttl+=$row->amount_paid;
		 						if($acc_old!=$acc_no ){
		 							$acc_new=$acc_no;
		                            $tbl.="<tr>";
		                            $tbl.="<td></td>";
		                            $tbl.="<td><b>Sub Total [$acc_no]</b></td>";
		                            $tbl.="<td align='right'><b>".number_format($acc_subttl)."</b></td>";
		                            $tbl.="<td></td>";
		                            $tbl.="<td></td>";
		                            $tbl.="<td></td>";
		                            $tbl.="</tr>";
		 							$acc_subttl=0; 							
		 						}
								
							}
                        
                        }
                   };
                   $how_paid=$rpay->how_paid;
                   
							if($rpay->how_paid=="CARD"){
		                            $tbl.="<tr>";
		                            $tbl.="<td></td>";
		                            $tbl.="<td><b>Sub Total [$acc_no]</b></td>";
		                            $tbl.="<td align='right'><b>".number_format($acc_subttl)."</b></td>";
		                            $tbl.="<td></td>";
		                            $tbl.="<td></td>";
		                            $tbl.="<td></td>";
		                            $tbl.="</tr>";
		 							$acc_subttl=0; 							
								
							}
                   
                   $tbl.= "<tr><td><strong>Sub Total $how_paid</strong></td>
                   <td></td>
                   <td align='right'><strong>".number_format($sub_total)."</strong></td>
                   <td></td><td></td><td></td>
                   </tr>";
                                                              
                    
                }
                
               $tbl.= "<tr><td><strong>Total</strong></td>
               <td></td>
               <td align=right><strong>".number_format($total)."</strong></td>
               <td></td><td></td><td></td>
               </tr>";
     			
            echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
