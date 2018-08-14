<?
         $CI =& get_instance();
		 $CI->load->model('inventory_model');
?>
<h1>BUKTI BARANG KELUAR</h1>
<h3>Nomor: <?=$shipment_id?></h3>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal Keluar</td><td><?=$date_received?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td>Gudang Penyimpanan</td><td><?=$warehouse_code?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table cellpadding="3" border="1">
     		<thead>
     			<tr><td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select i.item_number,s.description,i.quantity_received,i.unit 
		                from inventory_products i left join inventory s on s.item_number=i.item_number
		                where i.shipment_id='".$shipment_id."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td align='right'>".number_format($row->quantity_received)."</td>";
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	</td>
     </tr>
     <tr>
     	<td>Catatan</td><td colspan="3"><?=$comments?></td>
     </tr>
     <tr>
     	<td><h3>Tanda Tangan</h3></td><td></td>
     	<td colspan="2"></td>
     </tr>
</table>