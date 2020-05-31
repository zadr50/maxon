<?php
    $CI =& get_instance();

    $CI->load->model('company_model');
    $com=$CI->company_model->get_by_id($CI->access->cid)->row();
	$company="";		$phone="";
	$street="";
	$city="";
	if($com){
		$company=$com->company_name;
		$street=$com->street;
		$city=$com->city_state_zip_code;			$phone=$com->phone_number;
	}

    $CI->load->model('supplier_model');
    $sup=$CI->supplier_model->get_by_id($supplier_number)->row();
    $CI->load->model('purchase_invoice_model');
	
	
?>
<table cellspacing="0" cellpadding="1" border="0"> 
	<tr>
		<td colspan="6" align="center"><b><?=$company?></b></td>
	</tr>
	<tr>
		<td colspan="6" align="center"><b><?="$street"?></b></td>
	</tr>
	<tr>
		<td colspan="6" align="center" style="border-bottom: 2px solid lightgray"><b><?="$city, Phone: $phone"?></b></td>
	</tr>
	<tr>
		<td colspan="6" align="center"><b><span style="font-size: 24px">KONTRA BON</span></b></td>
	</tr>
	<tr>
		<td colspan="6" align="center"><b>Nomor: <?=$nomor?></b></td>
	</tr>
     <tr>
     	<td>Tanggal</td><td><?=$tanggal?></td>
     	<td colspan="2"><strong><?=$sup->supplier_name.' ('.$sup->supplier_number.')'?></strong></td>
     </tr>
     <tr>
     	<td>Termin</td><td><?=$termin?></td>
     	<td colspan="2"><?=$sup->street?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?=$sup->suite.' - '.$sup->city?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$sup->phone.' - Fax: '.$sup->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Up: '.$sup->first_name?></td>
     </tr>
	 
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>Faktur</td><td>Tanggal</td><td>Jenis</td><td>Jumlah</td> 
     				<td>Termin</td><td>Catatan</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?php
     			
		       $sql="select *  from payables_bill_detail i   where nomor='$nomor'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                $z_saldo=0;
                 foreach($query->result() as $row){
                     
                    $jenis=ucfirst($row->row_type);
					$amount=0;			$termin="";
					$payment=0;			$catatan="";
					$retur=0;
					$db_memo=0;
					$cr_memo=0;
					$other=0;
					if($jenis=="Memo"){
						$jumlah=$row->jumlah;
						$saldo=$jumlah;
						if($qmemo=$this->db->where("kodecrdb",$row->faktur)->get("crdb_memo")){
							if($rmemo=$qmemo->row()){
								$catatan=$rmemo->keterangan;
								if($rmemo->transtype=="PO-DEBIT MEMO"){
									$jumlah=$jumlah*-1;
								}
							}
						}
					} else {
						if($qfaktur=$this->db->where("purchase_order_number",$row->faktur)
							->get("purchase_order")){
								if($rfaktur=$qfaktur->row()){
									$termin=$rfaktur->terms;
									$catatan=$rfaktur->comments;
								}
							}
	                    $CI->purchase_invoice_model->recalc($row->faktur); 
						
	                    $jumlah=$row->jumlah; 
	                    $saldo=$CI->purchase_invoice_model->saldo;
	                    
						$amount=$CI->purchase_invoice_model->amount;						
						$payment=$CI->purchase_invoice_model->_payment;
						$retur=$CI->purchase_invoice_model->_retur;
						$db_memo=$CI->purchase_invoice_model->_db_memo;
						$cr_memo = $CI->purchase_invoice_model->_cr_memo;
						$other = $CI->purchase_invoice_model->other;
						
						$jumlah=$amount;
	                    if($CI->purchase_invoice_model->potype=="R"){
	                    	$jumlah=-1*$jumlah;
	                    }
												
					}
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->faktur."</td>";
                    $tbl.="<td>".$row->tanggal."</td>";
                    $tbl.="<td>$jenis</td>";
                    $tbl.="<td align=\"right\">".number_format( $jumlah,2)."</td>";
                    $tbl.="<td>$termin</td>";
                    $tbl.="<td>$catatan</td>";
                    
                    $z_saldo+=$jumlah;
                    
                    $tbl.="</tr>";
                    $exp="";
                    if($qexp=$CI->purchase_invoice_model->expenses($row->faktur)){
                        foreach($qexp->result() as $rexp){
                            $exp.="$rexp->item_no: $rexp->amount, ";
                        }
                    }
                    if($exp!=""){
                        $tbl.="<tr><td>&nbsp</td><td colspan=9>$exp</td></tr>";
                        
                    }
					$s="select kodecrdb,tanggal,keterangan,amount,transtype from crdb_memo 
						where docnumber='$row->faktur'";
                    if($qcrdb=$this->db->query($s)){
                    	foreach($qcrdb->result() as $crdb){
                    		$crdb_amount=$crdb->amount*-1;
							if($crdb->transtype=="PO-CREDITMEMO"){
								$crdb_amount=$crdb->amount;
							}
		                    $tbl.="<tr>";
		                    $tbl.="<td>".$crdb->kodecrdb."</td>";
		                    $tbl.="<td>".$row->tanggal."</td>";
		                    $tbl.="<td>Memo</td>";
		                    $tbl.="<td align=\"right\">".number_format( $crdb_amount,2)."</td>";
		                    $tbl.="<td></td>";
		                    $tbl.="<td>$crdb->keterangan</td>";
		                    $z_saldo+=$crdb_amount;
                    		
                    	}
                    }
                    //$amt=$CI->purchase_invoice_model->amount;
                    //$s="update payables_bill_detail set jumlah='$saldo',saldo='$amt' where id='$row->id'";
                    //$this->db->query($s);
                    
                    
               };
			   echo $tbl;
               
               
               $s="update payables_bill_header set amount='$z_saldo' where nomor='$nomor'";
               $this->db->query($s);
               
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td></td><td></td><td></td><td align="right"></td></tr>
     <tr><td>Catatan: <?=$catatan?></td><td><b>Total</b></td>
     	<td align="left"><b><?=number_format($z_saldo,2)?></b></td>
         <td>&nbsp</td>
     </tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>Yang Menerima</b></td><td></td><td><b>Yang Menyerahkan</b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>________________</b></td><td></td><td><b>________________</b></td></tr>
     
</table>
