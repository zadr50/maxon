<?
         $CI =& get_instance();
         $CI->load->model('customer_model');
         $cst=$CI->customer_model->get_by_id($sold_to_customer)->row();

?>
<h1>SURAT JALAN</h1>
<h2>Nomor: <?=$invoice_number?></h2>
<table cellspacing="0" cellpadding="1" border="0" > 
     <tr>
     	<td>Tanggal</td><td><?=$invoice_date?></td>
     	<td colspan="2"><?=$sold_to_customer.' ('.$cst->company.')'?></td>
     </tr>
     <tr>
     	<td>Ref SO #</td><td><?=$sales_order_number?></td>
     	<td colspan="2"><?=$cst->street?></td>
     </tr>
     <tr>
     	<td>Tanggal Kirim</td><td><?=$due_date?></td>
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
     			<tr><td>Kode Barang</td><td width="200">Nama Barang</td>
				<td width="30">Qty</td><td width="30">Unit</td>
     			</tr>
     		</thead>
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
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td></td><td></td><td></td><td></td></tr>
     <tr><td>Catatan: <?=$comments?></td><td></td><td></td><td></td></tr>
     <tr><td></td><td></td><td></td><td></td></tr>
     <tr><td></td><td></td><td></td><td></td></tr>
     <tr><td>PENERIMA</td><td>MENGETAHUI</td><td>PENGIRIM</td><td></td></tr>
	 
</table>