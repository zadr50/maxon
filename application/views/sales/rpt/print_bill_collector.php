<?php
     $CI =& get_instance();
     $CI->load->model('company_model');     
     $CI->load->model('customer_model');
     $CI->load->model('invoice_model');
     $company=$CI->company_model->get_by_id($CI->access->cid)->row();
     
?>
<table cellspacing="0" cellpadding="1" border="0"> 
    <tr>
        <td><b><?=$company->company_name?></b></td>
    </tr>
    <tr>
        <td><h2>PENAGIHAN KOLEKTOR</h2></td>
    </tr>
    <tr>
        <td><b>Nomor : </td><td colspan=3><b><?=$bill_id?></b></td>        
        <td><b>Kolektor : </td><td><b><?=($collector)?></b></td>        
    </tr>
    <tr>
        <td><b>Tanggal : </td><td colspan=3><b><?=$bill_date?></b></td>   
        <td><b>Jumlah : </td><td><b><?=number_format($amount)?></b></td>        
    </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>Nomor</td><td>Nama Customer</td><td>Faktur</td><td>Tanggal</td>
     				<td>Jumlah</td><td>N</td><td>T</td>
				<td>T</td><td>K</td><td colspan=4>Hasil Penagihan</td>
     			</tr>
     			<tr>
     				<td></td><td></td><td></td><td></td>
     				<td></td><td></td><td></td>
     				<td></td><td></td><td colspan=2>GIRO</td>
     				<td>CASH</td>
     				<td>TTD Cust/Keterangan</td>
     			</tr>
     			<tr>
     				<td></td><td></td><td></td><td></td>
     				<td></td><td></td><td></td>
     				<td></td><td></td><td>No. Giro</td><td>Jumlah</td>
     				<td></td>
     				<td></td>
     				
     			</tr>
     		</thead>
     		<tbody>
     			<?php
		       $sql="select b.*,i.invoice_type,c.company from bill_detail_collector b 
		       		left join invoice i on i.invoice_number=b.invoice_number
		       		left join customers c on c.customer_number=i.sold_to_customer 
		          	where b.bill_id='$bill_id'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                $z_saldo=0;
				$i=0;
                 foreach($query->result() as $row){
                     
                    $CI->invoice_model->recalc($row->invoice_number); 
                    $jumlah=$row->amount; 
                    $saldo=$CI->invoice_model->saldo;
                    $jenis="Faktur";
                    
                    if($row->invoice_type=="R"){
                        $jumlah=0;
                        $saldo=0;
                        $jenis="Retur";
                    }
					$i++;
                    $tbl.="<tr>";
					$tbl.="<td>$i</td>";
					$tbl.="<td>$row->company</td>";
                    $tbl.="<td>".$row->invoice_number."</td>";
                    $tbl.="<td>".date("Y-m-d",strtotime($row->invoice_date))."</td>";
                    $tbl.="<td align=\"right\">".number_format( $saldo)."</td>";
                    $tbl.="<td></td><td></td><td></td>";
					$tbl.="<td></td><td></td><td></td>";
					$tbl.="<td></td><td></td>";
                    $tbl.="</tr>";
                    $z_saldo+=$saldo;
                    
               };
			   echo $tbl;
               
               
               $s="update bill_header_collector set amount='$z_saldo' where bill_id='$bill_id'";
               $this->db->query($s);
               
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td></td><td></td><td></td><td align="right"></td></tr>
     <tr><td>Catatan: <?=$comments?></td>
         
     </tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>Penyerahan Faktur</b></td><td></td><td></td><td><b>Penyetoran Faktur</b></td>
     	<td></td><td></td><td align=right><b>Jumlah</b></td></tr>
     <tr>
     	<td><b>Yang Menerima</b></td><td><b>Yang Menyerahkan</b></td><td><b>Diperiksa Oleh</b></td>
     	<td><b>Yang Menerima</b></td><td><b>Yang Menyerahkan</b></td><td><b>Diperiksa Oleh</b></td>
     	<td align="right"><b><?=number_format($z_saldo)?></b></td>
     </tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr><td><b>&nbsp</b></td><td></td><td><b></b></td></tr>
     <tr>
     	<td><b>________________</b></td><td><b>________________</b></td>
     	<td><b>________________</b></td><td><b>________________</b></td>
     	<td><b>________________</b></td><td><b>________________</b></td>
     </tr>
</table>
