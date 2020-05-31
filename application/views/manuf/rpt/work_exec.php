<?php
         $CI =& get_instance();
         $CI->load->model('workorder_model');
?>
<h1>WORK ORDER EXECUTE</h1>
<h2>Nomor: <?=$work_exec_no?></h2>
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
    <tr>
     	<td>Customer</td><td><?=$wo_customer?></td>
     	<td></td>
     </tr>
     <tr>
     	<td>Date Start</td><td><?=$start_date?></td>
     	<td></td>
     </tr>
     <tr>
     	<td>Date Expect</td><td><?=$expected_date?></td>
     	<td></td>
     </tr>
     
     <tr>
     	<td>Work Order No#</td><td><?=$wo_number?></td>
     	<td></td>
     </tr>
     <tr>
     	<td>Status</td><td><?=$status?></td>
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
		                from work_exec_detail i left join inventory s on s.item_number=i.item_number
		                where i.work_exec_no='$work_exec_no'";
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
