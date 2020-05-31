<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>DAFTAR HUTANG KOMISI ITEM</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode</td><td>Nama Barang</td><td>Amount</td><td>Komisi</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select il.item_number,il.description,sum(il.amount) as z_amount,
     			 sum(il.coa1amt) as z_komisi 
     			 from invoice i 
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2' ";
				
				$sql.=" group by il.item_number,il.description 
				having sum(il.coa1amt)>0";
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$amount_tot=0;
				$komisi_tot=0;
                 foreach($rst_so->result() as $row){                 	
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td align='right'>".number_format($row->z_amount)."</td>";
                    $tbl.="<td align='right'>".number_format($row->z_komisi)."</td>";
                    $tbl.="</tr>";
					
					$amount_tot+=$row->z_amount;
					$komisi_tot+=$row->z_komisi;
               };
                $tbl.="<tr>";
                $tbl.="<td><b>TOTAL</b></td>";
                $tbl.="<td></td>";
                $tbl.="<td align='right'><b>".number_format($amount_tot)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($komisi_tot)."</b></td>";
                $tbl.="</tr>";
			   
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
