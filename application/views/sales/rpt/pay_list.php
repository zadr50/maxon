<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
    $CI->load->model('shipping_locations_model');
     
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");

?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>DAFTAR PEMBAYARAN</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
            Salesman: <?=$salesman?>, Customer: <?=$customer?>, 
            Outlet: <?=$outlet?>
     		
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Nomor Bukti#</td><td>Tanggal</td>
					<td>Customer</td><td>Jumlah Bayar</td><td>Jenis Bayar</td>
					<td>Faktur#</td><td>Termin</td>
					<td>Salesman</td><td>Outlet</td>
					<td>Rek Bank</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select how_paid from payments 
     			    where date_paid between '$date1' and '$date2'";
                $sql.=" group by how_paid";
                $total=0;
                    
     			if($qHowPaid=$CI->db->query($sql)){
     			    foreach($qHowPaid->result() as $rHowPaid){
     			        
                        
                        $tbl="<tr>";
                        $tbl.="<td><strong>$rHowPaid->how_paid</strong></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>"; 
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="</tr>";
                        echo $tbl;
                        
     			       $sub_total=0;
                
                        $sql="select p.no_bukti,p.date_paid,c.company,p.amount_paid,
                        p.how_paid,p.invoice_number,i.payment_terms,i.salesman,
                        b.bank_account_number,b.bank_name,p.how_paid_acct_id
                        from payments p left join invoice i on i.invoice_number=p.invoice_number 
                        left join customers c on c.customer_number=i.sold_to_customer
                        left join bank_accounts b on b.account_id=p.how_paid_acct_id
                        where  i.invoice_type='i' and p.date_paid between '$date1' and '$date2'  
                        and p.how_paid='$rHowPaid->how_paid'";
                        
                        if($salesman!=""){
                            $sql.=" and i.salesman='$salesman'";
                        }
                        if($customer!=""){
                            $sql.=" and i.sold_to_customer='$customer'";
                        }
                        if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
                        //$sql.=" order by p.no_bukti";
                        $sql.=" order by b.bank_name";
                       
                        
                        
                        $rst_so=$CI->db->query($sql);
                        $tbl="";
                        $bank_name_old="";
                        $bank_name_new="";
                        $sub_total_bank=0;
                        $irow=0;
                        
                         foreach($rst_so->result() as $row){
                         	
                         	$bank_name_old=$row->bank_name;                         		
                         	if($bank_name_new!=$bank_name_old && $irow>0){
                         		$tbl.= "<tr><td></td><td></td><td><b>Sub Jumlah Rek:</b></td><td align='right'><b>".number_format($sub_total_bank)."</b></td></tr>";
                         		$sub_total_bank=0;
								$bank_name_new=$row->bank_name;
                         	} 
							$irow++;
							$sub_total_bank+=$row->amount_paid;
							 
                         						
                            $warehouse_code=""; 
                            if($q=$CI->db->select("warehouse_code")->where("invoice_number",$row->invoice_number)
                                ->where("warehouse_code<>''")->limit(1)->get("invoice_lineitems")){
                                    if($r=$q->row()){
                                        $warehouse_code=$r->warehouse_code;
                                    }
                                } 
								$show=true;
								if($rHowPaid->how_paid=="GIRO"){
									$cair=false;
									if($qcw=$this->db->query("select cleared from check_writer where voucher='$row->no_bukti'")){
										if($rcw=$qcw->row()){
											$cair=$rcw->cleared;
										}
									}
									$show=$cair;
								}
					
                             
                                if($show){
                                	
                                                     
	                                $tbl.="<tr>";
	                                $tbl.="<td>".$row->no_bukti."</td>";
	                                $tbl.="<td>".date('Y-m-d',strtotime($row->date_paid))."</td>";
	                                $tbl.="<td>".$row->company."</td>";
	                                $tbl.="<td align='right'>".number_format($row->amount_paid)."</td>";
	                                $tbl.="<td>".$row->how_paid."</td>";
	                                $tbl.="<td>".$row->invoice_number."</td>";
	                                $tbl.="<td>".$row->payment_terms."</td>"; 
	                                $tbl.="<td>".($row->salesman)."</td>";
	                                $tbl.="<td>$warehouse_code</td>";
									$tbl.="<td>".substr($row->bank_name,1,10)." </td>";
	                                $tbl.="</tr>";
	                                
	                                $sub_total+=$row->amount_paid;
	                                $total+=$row->amount_paid;
								
								}
								
                            
                       };
                       echo $tbl;


                        $tbl="<tr>";
                        $tbl.="<td>SUB TOTAL $rHowPaid->how_paid</td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td align='right'><strong>".number_format($sub_total)."</strong></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>"; 
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="</tr>";

                        echo $tbl;
    
     			        
     			    }   //next

     			}
                $tbl="<tr>";
                $tbl.="<td>TOTAL</td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>";
                $tbl.="<td align='right'><strong>".number_format($total)."</strong></td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>"; 
                $tbl.="<td></td>";
                $tbl.="<td></td>";
                $tbl.="</tr>";
                echo $tbl;

				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
