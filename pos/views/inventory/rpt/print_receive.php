<?
         $CI =& get_instance();
         $CI->load->model('inventory_model');
?> 
<h1>BUKTI PENERIMAAN  BARANG</h1>
<h2>Nomor: <?=$shipment_id?></h2>
<table cellspacing="0" cellpadding="1" border="0"  > 
 
     <tr>
     	<td>Tanggal Terima</td><td><?=$date_received?></td>
     	<td colspan='2'></td>
     </tr>
     <tr>
     	<td>Nomor Purchase Order</td><td><?=$purchase_order_number?></td>
     	<td colspan='2'></td>
     </tr>
     <tr>
     	<td>Gudang Penyimpanan</td><td><?=$warehouse_code?></td>
     	<td colspan='2'></td>
     </tr>
     <tr>
     	<td>Catatan</td><td><?=$comments?></td>
     	<td colspan='2'></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan='2'></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan='2'></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td height="30" width="100">Kode Barang</td>
				<td width="200">Nama Barang</td>
				<td width="50">Qty</td>
				<td width="50">Unit</td>
     			</tr>
     		</thead>
     		<tbody >
     			<?
		       $sql="select i.item_number,s.description,i.quantity_received,i.unit 
		                from inventory_products i left join inventory s on s.item_number=i.item_number
		                where i.shipment_id='".$shipment_id."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td height=\"20\" width=\"100\">".$row->item_number."</td>";
                    $tbl.="<td width=\"200\">".$row->description."</td>";
                    $tbl.="<td  width=\"50\" align=\"right\">".number_format($row->quantity_received)."</td>";
                    $tbl.="<td  width=\"50\">".$row->unit."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
	 
	 <tr><td><h3>Penerima</h3></td><td><h3>Pengirim</h3></td></tr>
</table>
