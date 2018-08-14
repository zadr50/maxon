<?
         $CI =& get_instance();
         $CI->load->model('supplier_model');
         $sup=$CI->supplier_model->get_by_id($supplier_number)->row();
    $CI->load->model('purchase_invoice_model');
?>
<h1>KONTRA BON</h1>
<h2>Nomor: <?=$nomor?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
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
     	<td>Jumlah</td><td><?=number_format($amount)?></td>
     	<td colspan="2"></td>
     </tr>
	 
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>Faktur</td><td>Tanggal</td><td>Jenis</td>
				<td>Faktur</td><td>Payment</td><td>Retur</td><td>Db Memo</td>
				<td>Cr Memo</td><td>Biaya</td><td>Saldo</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select *  from payables_bill_detail i
		                where nomor='".$nomor."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                $z_saldo=0;
                 foreach($query->result() as $row){
                     
                    $CI->purchase_invoice_model->recalc($row->faktur); 
                    $jumlah=$row->jumlah; 
                    $saldo=$CI->purchase_invoice_model->saldo;
                    $jenis="Faktur";
                    
                    if($CI->purchase_invoice_model->potype=="R"){
                        $jumlah=0;
                        $saldo=0;
                        $jenis="Retur";
                    }
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->faktur."</td>";
                    $tbl.="<td>".$row->tanggal."</td>";
                    $tbl.="<td>$jenis</td>";
                    $tbl.="<td align=\"right\">".number_format( $CI->purchase_invoice_model->amount)."</td>";
                    $tbl.="<td align=\"right\">".number_format( $CI->purchase_invoice_model->_payment)."</td>";
                    $tbl.="<td align=\"right\">".number_format( $CI->purchase_invoice_model->_retur)."</td>";
                    $tbl.="<td align=\"right\">".number_format( $CI->purchase_invoice_model->_db_memo)."</td>";
                    $tbl.="<td align=\"right\">".number_format( $CI->purchase_invoice_model->_cr_memo)."</td>";
                    $tbl.="<td align=\"right\">".number_format( $CI->purchase_invoice_model->other)."</td>";
                    $tbl.="<td align=\"right\">".number_format( $saldo)."</td>";
                    
                    
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
                    
                    $amt=$CI->purchase_invoice_model->amount;
                    $s="update payables_bill_detail set jumlah='$saldo',saldo='$amt' where id='$row->id'";
                    $this->db->query($s);
                    
                    $z_saldo+=$saldo;
                    
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
     <tr><td>Catatan: <?=$catatan?></td><td></td><td>Total</td><td align="right"><?=number_format($z_saldo)?></td>
         <td>&nbsp</td>
         
     </tr>
</table>
