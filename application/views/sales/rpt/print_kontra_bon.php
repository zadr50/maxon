<?php
     $CI =& get_instance();
     $CI->load->model('company_model');     
     $CI->load->model('customer_model');
     $CI->load->model('invoice_model');
     $cust=$CI->customer_model->get_by_id($customer_number)->row();
     if(!$cust){
         echo "<h1>Customer [$customer_number] not found !";
         exit;
     }
    $com=$CI->company_model->get_by_id($CI->access->cid)->row();
	$company="";			$phone="";
	$street="";
	$city="";
	if($com){
		$company=$com->company_name;				$phone=$com->phone_number;
		$street=$com->street;
		$city=$com->city_state_zip_code;
	}

     
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
    <t>
        <td><b>Nomor : <?=$bill_id?></b></td><td><b><?=$cust->company?> - (<?=$cust->customer_number?>)</b></td>        
    </tr>
    <t>
        <td><b>Tanggal : <?=$bill_date?></b></td><td><b><?=$cust->street?></b></td>        
    </tr>
    <tr>
        <td><b>Keterangan &nbsp : <?=$comments?></b></td><td><?=$cust->suite.' - '.$cust->city?></td>
    </tr>
    <tr>
        <td></td><td><?='Phone: '.$cust->phone.' - Fax: '.$cust->fax?></td>
   </tr>
     <tr>
        <td></td><td><?='Up: '.$cust->first_name?></td>
     </tr>
	 
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>Faktur</td><td>Tanggal</td><td>Jenis</td>
				<td>Jumlah</td><td>Termin</td><td>Salesman</td><td>Keterangan</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?php
		       $sql="select b.*,i.invoice_type,i.salesman,i.payment_terms,i.comments  
		       		from bill_detail b left join invoice i on i.invoice_number=b.invoice_number 
		          	where b.bill_id='$bill_id'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                $z_saldo=0;
                 foreach($query->result() as $row){
                    	
                    $jenis=ucfirst($row->row_type);
					  
                    $CI->invoice_model->recalc($row->invoice_number); 

                    $saldo=$CI->invoice_model->saldo;
					
                    $jumlah=$row->amount; 
                    $invoice_number=$row->invoice_number;
					$tanggal=$row->tanggal;
					$salesman=$row->salesman;
					$termin=$row->payment_terms;
					$keterangan=$row->keterangan;
					if($keterangan==""){
						$keterangan=$row->comments;
					}
                    if($row->invoice_type=="R"){
                        $jenis="Retur";
                    } else {
                    	$jenis="Faktur";
                    }
                    $tbl.="<tr>";
                    $tbl.="<td>".$invoice_number."</td>";
                    $tbl.="<td>".date("Y-m-d",strtotime($tanggal))."</td>";
                    $tbl.="<td>$jenis</td>";
                    $tbl.="<td align=\"right\">".number_format( $jumlah )."</td>";
                    $tbl.="<td>$termin</td>";
                    $tbl.="<td>$salesman</td>";
                    $tbl.="<td>$keterangan</td>";
                    
                    $tbl.="</tr>";
                    $z_saldo+=$jumlah;
                    
               };
			   echo $tbl;
               
               
               $s="update bill_header set amount='$z_saldo' where bill_id='$bill_id'";
               $this->db->query($s);
               
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td></td><td></td><td></td><td align="right"></td></tr>
     <tr><td>Catatan: <?=$comments?></td><td></td><td></td></td><td><b>Total</b></td>
         <td align="right"><b><?=number_format($z_saldo)?></b></td>
     </tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>Yang Menerima</b></td><td></td><td><b>Yang Menyerahkan</b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>________________</b></td><td></td><td><b>________________</b></td></tr>
</table>
