<?php
     $CI =& get_instance();
     $CI->load->model('customer_model');
     $cst=$CI->customer_model->get_by_id($customer)->row();
?>
<h1>WORK SERVICE ORDER</h2><h2>Nomor: <?=$no_bukti?></h2>
<table cellspacing="0" cellpadding="1" > 
     <tr>
     	<td><b>Tanggal</b></td><td><?=$tanggal?></td>
     	<td colspan="2"><b>Customer</b></td>
     </tr>
     <tr>
     	<td><b>Jenis</b></td><td><?=$jenis_masalah?></td>
     	<td colspan="2"><?=$customer.' ('.$cst->company.')'?></td>
     </tr>
     <tr>
     	<td><b>Teknisi<b></td><td><?=$serv_rep?></td>
     	<td colspan="2"><?=$cst->street?></td>
     </tr>
     <tr>
     	<td><b>Mesin</b></td><td><?=$serial?></td>
     	<td colspan="2"><?=$cst->suite.' - '.$cst->city?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$cst->phone.' - Fax: '.$cst->fax?></td>
     </tr>
     <tr>
     	<td colspan="6">
     		<table width=100% border=1>
     			<thead>
	     			<th>Start</th><th>Finish</th><th>Keluhan</th><th>Hasil Diagnosa</th> 				
     			</thead>
     			<tbody>
     			<tr>
     				<td></td><td></td><td><?=$masalah?></td><td></td>
     			</tr>
     			<?php
     			for($i=0;$i<10;$i++){
     				echo "
     			<tr>
     				<td>&nbsp</td><td></td><td></td><td></td>
     			</tr>
     				";
					
     			}
     			?>
     			
     				
     			</tbody>
     		</table>
     	</td>
     </tr>
     <tr>
     	<td><b>Catatan</b></td><td></td></td>
     </tr>
     <tr style='border:1px solid black'>
     	<td height=130 colspan=6><?=$comments?></td>
     </tr>
     
     <tr>
     	<td><b>Hormat Kami</b></td><td><b>Teknisi</b></td><td><b>Konsumen</b></td>
     </tr>
</table>
