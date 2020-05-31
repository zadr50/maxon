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
   $supplier="";
   if($qsupp=$CI->db->query("select supplier_name,street,suite,city from suppliers 
   		where supplier_number='$items->supplier_number'")){
   		if($rsupp=$qsupp->row()){
   			$supplier=$rsupp->supplier_name. "($items->supplier_number)";
   		}
   }      
?> 
<h1>BUKTI PENERIMAAN  BARANG</h1>
<h2>Nomor: <?=$shipment_id?></h2>
<table cellspacing="0" cellpadding="1" border="0"  > 
 
     <tr>
     	<td>Tanggal Terima</td><td colspan="2"><?=$date_received?></td>
     </tr>
     <tr>
     	<td>Nomor Purchase Order</td><td colspan="2"><?=$purchase_order_number?></td>
     </tr>
     <tr>
     	<td>Supplier</td><td colspan="2"><?=$supplier?></td>
     </tr>
     <tr>
     	<td>Gudang Penyimpanan</td><td colspan="2"><?=$warehouse_code.'-'.$source_name?></td>
     </tr>
     <tr>
     	<td>Catatan</td><td colspan="2"><?=$comments?></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>No</td><td height="30" width="100">Kode Barang</td>
				<td width="200">Nama Barang</td>
				<td width="50" align="right">Qty</td>
				<td width="50">Unit</td>
     			</tr>
     		</thead>
     		<tbody >
     			<?php
		       $sql="select i.no_urut,i.item_number,s.description,i.quantity_received,i.unit 
		                from inventory_products i left join inventory s on s.item_number=i.item_number
		                where i.shipment_id='".$shipment_id."' order by i.no_urut";
		        $query=$CI->db->query($sql);

     			$tbl="";
				$i=0;
                 foreach($query->result() as $row){
                 	$i++;
                    $tbl.="<tr>";
                    $tbl.="<td height=\"20\" width=\"20\">".$i."</td>";
                    $tbl.="<td height=\"20\" width=\"100\">".$row->item_number."</td>";
                    $tbl.="<td width=\"200\">".$row->description."</td>";
                    $tbl.="<td  width=\"50\" align=\"right\">".number_format($row->quantity_received,2)."</td>";
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
