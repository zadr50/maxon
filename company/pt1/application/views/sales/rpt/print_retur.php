<?
         $CI =& get_instance();
         $CI->load->model('customer_model');
         $cst=$CI->customer_model->get_by_id($sold_to_customer)->row();

?>
<h1>RETUR PENJUALAN</h2><h2>Nomor: <?=$invoice_number?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal</td><td><?=$invoice_date?></td>
     	<td colspan="2"><?=$sold_to_customer.' ('.$cst->company.')'?></td>
     </tr>
     <tr>
     	<td>Ref#</td><td><?=$sales_order_number?></td>
     	<td colspan="2"><?=$cst->street?></td>
     </tr>
     <tr>
     	<td>Jatuh Tempo</td><td><?=$due_date?></td>
     	<td colspan="2"><?=$cst->suite.' - '.$cst->city?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$cst->phone.' - Fax: '.$cst->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Up: '.$cst->first_name?></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr>
     				<td>Kode Barang</td><td width="200">Nama Barang</td>
					<td width="30">Qty</td><td width="30">Unit</td>
     				<td>Harga</td><td width="30">Discount</td><td>Jumlah</td>
     			</tr>
     		</theadx>
     		<tbody>
     		   <?
		       $sql="select item_number,description,quantity,unit,discount,price,amount 
		                from invoice_lineitems i
		                where invoice_number='".$invoice_number."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td width=\"200\">".$row->description."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
                    $tbl.="<td width=\"30\">".$row->unit."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->price)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->discount,2)."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->amount)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    		   ?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td>Catatan: <?=$comments?></td><td></td><td>Sub Total</td><td align="right"><?=number_format($sub_total)?></td></tr>
     <tr><td></td><td></td><td>Discount <?=$discount?></td><td align="right"><?=number_format($disc_amount)?></td></tr>
     <tr><td></td><td></td><td>Pajak <?=$tax?></td><td align="right"><?=number_format($tax_amount)?></td></tr>
     <tr><td></td><td></td><td>Ongkos</td><td align="right"><?=number_format($freight)?></td></tr>
     <tr><td></td><td></td><td>Lain-lain</td><td align="right"><?=number_format($others)?></td></tr>
     <tr><td></td><td></td><td>Jumlah</td><td align="right"><?=number_format($amount)?></td></tr>
</table>
