<?php
         $CI =& get_instance();
         $CI->load->model('customer_model');
         $cst=$CI->customer_model->get_by_id($sold_to_customer)->row();
?>
<h1>SALES ORDER</H1><H3>Nomor: <?=$sales_order_number?></h3>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td colwidth=80>Tanggal</td><td>: <?=date("Y-m-d",strtotime($sales_date))?></td><td></td>
     	<td colspan="2"><b><?=$sold_to_customer.' ('.$cst->company.')'?></b></td>
     </tr>
     <tr>
     	<td>Termin</td><td>: <b><?=$payment_terms?></b></td></td><td></td>
     	<td colspan="2"><?=$cst->street?></td>
     </tr>
     <tr>
     	<td>Salesman</td><td>: <?=$salesman?></td></td><td></td>
     	<td colspan="2"><?=$cst->suite.' - '.$cst->city?></td>
     </tr>
     <tr>
     	<td>Tanggal Kirim</td><td>: <?=date("Y-m-d",strtotime($due_date))?></td></td><td></td>
     	<td colspan="2"><?='Phone: '.$cst->phone.' - Fax: '.$cst->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td></td><td></td>
     	<td colspan="2"><?='Up: '.$cst->first_name?></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
                    <tr><td>Kode Barang</td><td>Nama Barang</td><td width="30">Qty</td>
                         <td width="30">Unit</td><td width=60>Harga</td>
     				<td width="30">Disc%1</td><td width="30">Disc%2</td>
					<td width=60>Jumlah</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?php
		       $sql="select item_number,description,quantity,unit,discount,
						price,amount,disc_2,disc_3
		                from sales_order_lineitems i
		                where sales_order_number='".$sales_order_number."'";
		        $query=$CI->db->query($sql);
                   $tbl="";
                   $tqty=0;
                 foreach($query->result() as $row){
                      $disc1prc=100*$row->discount;                      
                      $disc2prc=100*$row->disc_2;
                    $tbl.="<tr>";
                    $tbl.="<td width=100>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
                    $tbl.="<td width=\"30\">".$row->unit."</td>";
                    $tbl.="<td  align=\"right\" width=60>".number_format($row->price)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".round($disc1prc,2)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".round($disc2prc,2)."</td>";
 //                   $tbl.="<td width=\"30\" align=\"right\">".($row->disc_3)."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->amount)."</td>";
                    $tbl.="</tr>";
                    $tqty+=$row->quantity;
               };
               
               $tbl.="
               <tr><td colspan=2><b>Catatan: </b></td><td align=right><b>".number_format($tqty)."</b></td><td></td>
                    <td colspan=3><b>Sub Total</b></td>
                    <td align=right><b>".number_format($sub_total)."</b></td></tr>
               <tr><td colspan=4 rowspan=4>$comments</td><td colspan=3><b>Discount $discount</b></td><td align=right><b>".number_format($disc_amount)."</b></td></tr>
               <tr><td colspan=3><b>Pajak $tax</b></td><td align=right><b>".number_format($tax_amount)."</b></td></tr>
               <tr><td colspan=3><b>Ongkos</b></td><td align=right><b>".number_format($freight)."</b></td></tr>
               <tr><td colspan=3><b>Lain-lain</b></td><td align=right><b>".number_format($others)."</b></td></tr>
               <tr><td colspan=4></td><td colspan=3><b>Jumlah</b></td><td align=right><b>".number_format($amount)."</b></td></tr>
               ";


			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td>&nbsp;</td><td></td><td></td><td></td></tr>
     <tr><td><b>MENGETAHUI</b></td><td></td><td></td><td><b>DIBUAT OLEH</b></td><td></td></tr>
     <tr><td>&nbsp;</td><td></td><td></td><td></td></tr>
     <tr><td>&nbsp;</td><td></td><td></td><td></td></tr>
     <tr><td>&nbsp;</td><td></td><td></td><td></td></tr>
     <tr><td>&nbsp;</td><td></td><td></td><td></td></tr>
     <tr><td colspan=3><b>ALEXANDER BAGUS</b></td><td><b></b></td><td></td></tr>

     
	 
</table>
