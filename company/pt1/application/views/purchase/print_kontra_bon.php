<?
         $CI =& get_instance();
         $CI->load->model('supplier_model');
         $sup=$CI->supplier_model->get_by_id($supplier_number)->row();

?>
<h1>KONTRA BON</h1>
<h2>Nomor: <?=$nomor?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal</td><td><?=$tanggal?></td>
     	<td colspan="2"><strong><?=$sup->supplier_name.' ('.$sup->supplier_number.')'?></strong></td>
     </tr>
     <tr>
     	<td>Termin</td><td><?=$termin?></td>
     	<td colspan="2"><?=$sup->street?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?=$sup->suite.' - '.$sup->city?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$sup->phone.' - Fax: '.$sup->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Up: '.$sup->first_name?></td>
     </tr>
     <tr>
     	<td>Jumlah</td><td><?=number_format($amount)?></td>
     	<td colspan="2"></td>
     </tr>
	 
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>Faktur</td><td>Tanggal</td>
				<td>Jumlah</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select *  from payables_bill_detail i
		                where nomor='".$nomor."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->faktur."</td>";
                    $tbl.="<td>".$row->tanggal."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->jumlah)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    			?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td></td><td></td><td></td><td align="right"></td></tr>
     <tr><td>Catatan: <?=$catatan?></td><td></td><td>Total</td><td align="right"><?=number_format($amount)?></td></tr>
</table>
