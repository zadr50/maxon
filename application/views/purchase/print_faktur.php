<?
         $CI =& get_instance();
         $CI->load->model('supplier_model');
         $sup=$CI->supplier_model->get_by_id($supplier)->row();

?>
<h1>FAKTUR  PEMBELIAN</h1>
<h2>Nomor: <?=$po_number?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal</td><td><?=$tanggal?></td>
     	<td colspan="2"><strong><?=$sup->supplier_name.' ('.$sup->supplier_number.')'?></strong></td>
     </tr>
     <tr>
     	<td>Termin</td><td><?=$terms?></td>
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
     	<td></td><td></td>
     	<td colspan="2"></td>
     </tr>
	 
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td height="20">Kode Barang</td><td width="150">Nama Barang</td>
				<td width="30">Qty</td><td width="30">Unit</td><td>Harga</td>
     				<td width="30">Disc%1</td>	<td width="30">Disc%2</td>	<td width="30">Disc%3</td><td>Jumlah</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select item_number,description,quantity,unit,discount,
			   price,total_price,disc_2,disc_3 
		                from purchase_order_lineitems i
		                where purchase_order_number='".$po_number."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td width=\"150\">".$row->description."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
                    $tbl.="<td width=\"30\">".$row->unit."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->price)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->discount,2)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->disc_2,2)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->disc_3,2)."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->total_price)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td></td><td></td><td></td><td align="right"></td></tr>
     <tr><td>Catatan: <?=$comments?></td><td></td><td>Sub Total</td><td align="right"><?=number_format($sub_total)?></td></tr>
     <tr><td></td><td></td><td>Discount <?=$discount?></td><td align="right"><?=number_format($disc_amount)?></td></tr>
     <tr><td></td><td></td><td>Pajak <?=$tax?></td><td align="right"><?=number_format($tax_amount)?></td></tr>
     <tr><td></td><td></td><td>Ongkos</td><td align="right"><?=number_format($freight)?></td></tr>
     <tr><td></td><td></td><td>Lain-lain</td><td align="right"><?=number_format($others)?></td></tr>
     <tr><td></td><td></td><td>Jumlah</td><td align="right"><?=number_format($amount)?></td></tr>
</table>
 <?php 
 
 echo "<table border=1 cellpadding=3> ";
 echo "<tr><td colspan=3><h1>Payment Document</h1></td></tr>";
 echo "<tr><td>Bukti#</td><td>Tanggal</td><td align=right>Jumlah</td></tr>";         
 $total=0;    
 if($q=$this->purchase_invoice_model->payment_list($po_number)){
     foreach($q->result() as $row){
         $amount=number_format($row->amount_paid);
         echo "<tr><td>$row->no_bukti</td>
             <td>$row->date_paid</td>
             <td align=right>$amount</td>
             </tr>";
         $total+=$amount;
     }
 }
 $total=number_format($total);
 echo "<tr><td>Total</td><td></td><td align=right>$total</td></tr>";             
 echo "</table>";
  
 
 echo "<table border=1 cellpadding=3> ";
 echo "<tr><td colspan=3><h1>Retur Document</h1></td></tr>";
 echo "<tr><td>Retur#</td><td>Tanggal</td><td align=right>Jumlah</td></tr>";         
 $total_retur=0;    
 if($q=$this->purchase_invoice_model->retur_list($po_number)){
     foreach($q->result() as $retur){
         $amount=number_format($retur->amount);
         echo "<tr><td>$retur->purchase_order_number</td>
             <td>$retur->po_date</td>
             <td align=right>$amount</td>
             </tr>";
         $total_retur+=$retur->amount;
     }
 }
 $total_retur=number_format($total_retur);
 echo "<tr><td>Total</td><td></td><td align=right>$total_retur</td></tr>";             
 echo "</table>";
 
 echo "<table border=1 cellpadding=3> ";
 echo "<tr><td colspan=4><h1>Credit/Debit Document</h1></td></tr>";
 echo "<tr><td>CrDb#</td><td>Tanggal</td><td align=right>Jumlah</td><td>Type</td></tr>";         
 $total_crdb=0;    
 if($q=$this->purchase_invoice_model->crdb_memo_list($po_number)){
     foreach($q->result() as $row){
         $amount=number_format($row->amount);
         echo "<tr><td>$row->docnumber</td>
             <td>$row->tanggal</td>
             <td align=right>$amount</td>
             <td>$row->transtype</td>
             </tr>";
         $total_crdb+=$row->amount;
     }
 }
 $total_crdb=number_format($total_crdb);
 echo "<tr><td>Total</td><td></td><td align=right>$total_crdb</td><td></td></tr>";             
 echo "</table>";
 
 
 
 ?>
