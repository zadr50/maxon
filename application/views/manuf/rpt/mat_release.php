<?php
         $CI =& get_instance();
         $CI->load->model('mat_release_model');
?>
<h1>MATERIAL RELEASE</h1>
<h2>Nomor: <?=$mat_rel_no?></h2>
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td>Date Release</td><td><?=$date_rel?></td>
     	<td></td>
     </tr>
     <tr>
     	<td>Work Exec No#</td><td><?=$exec_number?></td>
     	<td></td>
     </tr>
     <tr>
     	<td>Work Order No#</td><td><?=$wo_number?></td>
     	<td></td>
     </tr>
     <tr>
     	<td>Comments</td><td><?=$comments?></td>
     	<td colspan="2"></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr><td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
     			</tr>
     		</thead>
     		<tbody>
     			<?
		       $sql="select *
		                from mat_release_detail i left join inventory s on s.item_number=i.item_number
		                where i.mat_rel_no='$mat_rel_no'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td width=20px>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td align=right>".number_format($row->quantity)."</td>";
                    $tbl.="<td align=right>".$row->unit."</td>";
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
