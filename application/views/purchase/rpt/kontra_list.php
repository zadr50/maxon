<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
	$category = $CI->input->post('text2');
	$sistim = $CI->input->post('text3');
	$gudang = $CI->input->post('text4');
	
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2>KONTRA BON SUMMARY</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>,
     		Gudang: <?=$gudang?>, Sistim: <?=$sistim?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td>Nomor</td><td>Tanggal</td><td>Termin</td>
 				<td>Kode Supplier</td><td>Nama Supplier</td>
 				<td>Faktur</td><td>Tgl Faktur</td><td>Jenis</td>
 				<td>Termin</td><td>Jumlah</td><td>Catatan</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?php
	 		       $sql="select h.*,d.*,s.supplier_name,d.tanggal as tanggal_faktur,d.jumlah as amount_faktur
					from payables_bill_header h
	                left join suppliers s on s.supplier_number=h.supplier_number
	                left join payables_bill_detail d on d.nomor=h.nomor
	                where h.tanggal between '$date1' and '$date2'";
					
					if($supplier!="")$sql.=" and h.supplier_number='$supplier'"; 
					
	                $sql.=" order by h.nomor";
	                
					
			        $query=$CI->db->query($sql);
	
	     			$tbl="";
					$total=0;
	                 foreach($query->result() as $row){
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row->nomor."</td>";
	                    $tbl.="<td>".$row->tanggal."</td>";
	                    $tbl.="<td>".$row->termin."</td>";
	                    $tbl.="<td>".$row->supplier_number."</td>";
	                    $tbl.="<td>".$row->supplier_name."</td>";
	                    $tbl.="<td>".$row->faktur."</td>";
	                    $tbl.="<td>".$row->tanggal_faktur."</td>";
	                    $tbl.="<td>".$row->row_type."</td>";
	                    $tbl.="<td>".$row->termin."</td>";
	                    $tbl.="<td align='right'>".number_format($row->amount_faktur,2)."</td>";
	                    $tbl.="<td>".$row->catatan."</td>";											
	                    $tbl.="</tr>";
						$total+=$row->amount_faktur;
	               };
                    $tbl.="<tr>";
                    $tbl.="<td><b>TOTAL</b></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td align='right'><b>".number_format($total,2)."</b></td>";
					$tbl.="<td></td>";
					$tbl.="<td></td>";
										
                    $tbl.="</tr>";
               	               
				   echo $tbl;
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
