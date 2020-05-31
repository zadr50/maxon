<?php
         $CI =& get_instance();
         $CI->load->model('inventory_model');
?>
<h1>BUKTI STOCK OPNAME</h1>
<h2>Nomor: <?=$transfer_id?></h2>
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td>Tanggal</td><td><?=$date_trans?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td>Gudang</td><td><?=$from_location?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td>Catatan</td><td><?=$comments?></td>
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
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>Kode Barang</td><td>Nama Barang</td><td>Qty Fisik</td>
     			    <td>Unit</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select i.item_number,s.description,i.to_qty,i.unit 
		                from inventory_moving i left join inventory s on s.item_number=i.item_number
		                where i.transfer_id='".$transfer_id."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td align=right>".number_format($row->to_qty)."</td>";
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td><h2>Tanda Tangan</h2></td><td></td><td></td><td align="right"></td></tr>
</table>
