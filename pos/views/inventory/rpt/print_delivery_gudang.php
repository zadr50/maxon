<?
         $CI =& get_instance();
		 $CI->load->model('inventory_model');
?>
<h1>SURAT JALAN</h1>
<h3><?=$shipment_id?></h3>
<table cellspacing="0" cellpadding="1" border="0" width='100%' > 
     <tr>
     	<td>Tanggal Keluar</td><td><?=$date_received?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td>Asal</td><td><?=$warehouse_code?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td>Tujuan</td><td><?=$supplier_number?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table cellpadding="3" border="1" width='100%'>
     		<thead>
     			<tr><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th>
     			    <th>Unit</td><th>Harga Jual</th><th>No.PMB</th>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select i.item_number,s.description,i.quantity_received,i.unit,
		          ref1,s.retail 
		                from inventory_products i left join inventory s on s.item_number=i.item_number
		                where i.shipment_id='".$shipment_id."'";
		        $query=$CI->db->query($sql);

     			$tbl="";    $qty=0;     $amt=0;
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td align='right'>".number_format($row->quantity_received)."</td>";
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="<td align='right'>".number_format($row->retail)."</td>";
                    $tbl.="<td>".$row->ref1."</td>";
                    $tbl.="</tr>";
                    $qty+=$row->quantity_received;
                    $amt+=$row->retail*$row->quantity_received;
                };
                $tbl.="<tr><td><strong>Total</strong></td><td></td>
                    <td align='right'><strong>".number_format($qty)."</strong></td>
                    <td></td><td align='right'><strong>".number_format($amt)."</strong></td>
                    <td></td></tr>";
			    echo $tbl;
    			
    			
    			?>
     		</tbody>
     	</table>
     	</td>
     </tr>
     <tr>
     	<td><strong>Keterangan : </strong><?=$comments?></td>
     	<td><strong>Tanggal Cetak : </strong><?=date('Y-m-d')?></td>
     </tr>
     <tr>
     	<td><strong>Admin</strong></td><td><strong>Checker</strong></td>
     	<td><strong>Manager</strong></td><td></td>
     	<td><strong>Toko</strong></td><td><strong>Kepala Toko</strong></td>
     </tr>
</table>