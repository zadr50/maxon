<?php 
         $CI =& get_instance();
		 $CI->load->model('inventory_model');
         $source_name="";
         $target_name="";
         if($q=$CI->db->where("location_number",$warehouse_code)->get("shipping_locations")){
             if($r=$q->row()){
                 $source_name=$r->attention_name;
             }
         }
         if($q=$CI->db->where("location_number",$supplier_number)->get("shipping_locations")){
             if($r=$q->row()){
                 $target_name=$r->attention_name;
             }
         }
         
         
?>
<h1>SURAT JALAN</h1>
<h3><?=$shipment_id?></h3>
<table cellspacing="0" cellpadding="1" border="0" width='100%' > 
     <tr>
     	<td>Tanggal Keluar</td><td><?=$date_received?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td>Asal</td><td><?=$warehouse_code.'-'.$source_name?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td>Tujuan</td><td><?=$supplier_number.'-'.$target_name?></td>
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
     			<tr><th>No</th><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th>
     			    <th>Unit</td><th>Harga Jual</th><th>Total</th><th>No.PMB</th>
     			</tr>
     		</thead>
     		<tbody>
     			<?php
		       $sql="select i.item_number,s.description,i.quantity_received,i.unit,
		          ref1,s.retail,i.description as nama_barang 
		                from inventory_products i left join inventory s on s.item_number=i.item_number
		                where i.shipment_id='".$shipment_id."'";
		        $query=$CI->db->query($sql);

     			$tbl="";    $qty=0;     $amt=0;
				$no=0;
                 foreach($query->result() as $row){
                 	$no++;	
                 	$barang=$row->description;					 
					if($barang=="")$barang=$row->nama_barang;
                    $tbl.="<tr><td>$no</td>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>$barang</td>";
                    $tbl.="<td align='right'>".number_format($row->quantity_received)."</td>";
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="<td align='right'>".number_format($row->retail)."</td>";
                    $tbl.="<td align='right'>".number_format($row->retail*$row->quantity_received)."</td>";
                    $tbl.="<td>".$row->ref1."</td>";
                    $tbl.="</tr>";
                    $qty+=$row->quantity_received;
                    $amt+=$row->retail*$row->quantity_received;
                };
                $tbl.="<tr><td></td><td><strong>Total</strong></td><td></td>
                    <td align='right'><strong>".number_format($qty)."</strong></td>
                    <td></td><td></td><td align='right'><strong>".number_format($amt)."</strong></td>
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