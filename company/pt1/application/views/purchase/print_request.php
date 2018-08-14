<?
         $CI =& get_instance();
?>
<h1>PURCHASE REQUEST</h1>
<h2>Nomor: <?=$po_number?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal Permintaan</td><td><?=$tanggal?></td>
     	<td>Kantor Cabang</td><td><?=$branch_code?></td>
     </tr>
     <tr>
     	<td>Tanggal Diiinginkan</td><td><?=$due_date?></td>
     	<td>Departement</td><td><?=$dept_code?></td>
     </tr>
     <tr>
     	<td>Nama Pegawai yang mengajukan</td><td><?=$ordered_by?></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td height="20">Kode Barang</td><td width="150">Nama Barang</td>
				<td width="30">Qty</td><td width="30">Unit</td><td>Type</td>
     				<td>Status</td><td>Alasan</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select item_number,description,quantity,unit,line_type,
			   		line_status,comment 
		                from purchase_order_lineitems i
		                where purchase_order_number='".$po_number."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td width=\"150\">".$row->description."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
                    $tbl.="<td width=\"30\">".$row->unit."</td>";
                    $tbl.="<td>$row->line_type</td>";
                    $tbl.="<td>$row->line_status</td>";
                    $tbl.="<td>$row->comment</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
</table>
