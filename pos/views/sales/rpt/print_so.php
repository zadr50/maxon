<?
         $CI =& get_instance();
         $CI->load->model('customer_model');
         $cst=$CI->customer_model->get_by_id($sold_to_customer)->row();

?>
<h1>SALES ORDER</H1><H3>Nomor: <?=$sales_order_number?></h3>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal</td><td><?=$sales_date?></td>
     	<td colspan="2"><b><?=$sold_to_customer.' ('.$cst->company.')'?></b></td>
     </tr>
     <tr>
     	<td>Termin</td><td><b><?=$payment_terms?></b></td>
     	<td colspan="2"><?=$cst->street?></td>
     </tr>
     <tr>
     	<td>Salesman</td><td><?=$salesman?></td>
     	<td colspan="2"><?=$cst->suite.' - '.$cst->city?></td>
     </tr>
     <tr>
     	<td>Tanggal Kirim</td><td><?=$due_date?></td>
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
     			<tr><td>Kode Barang</td><td width="200">Nama Barang</td><td width="30">Qty</td><td width="30">Unit</td><td>Harga</td>
     				<td width="30">Disc%1</td><td width="30">Disc%2</td>
					<td width="30">Disc%3</td><td>Jumlah</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select item_number,description,quantity,unit,discount,
						price,amount,disc_2,disc_3
		                from sales_order_lineitems i
		                where sales_order_number='".$sales_order_number."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td width=\"200\">".$row->description."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
                    $tbl.="<td width=\"30\">".$row->unit."</td>";
                    $tbl.="<td  align=\"right\">".number_format($row->price)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".($row->discount)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".($row->disc_2)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".($row->disc_3)."</td>";
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
	 
     <tr><td></td><td></td><td></td><td></td></tr>
     <tr><td></td><td></td><td></td><td></td></tr>
     <tr><td></td><td></td><td></td><td></td></tr>
     <tr><td>MENGETAHUI</td><td></td><td>DIBUAT OLEH</td><td></td></tr>
	 
</table>
