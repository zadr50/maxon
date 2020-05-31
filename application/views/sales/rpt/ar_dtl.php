<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$kode=$CI->input->post('text1');
	if($kode==""){
		msgbox("Kode pelanggan harus dipilih !");
		exit;
	}
    $CI->load->model('sales_order_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>KARTU PIUTANG PELANGGAN</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Customer: <?=$kode?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
     			<?php
     			$sql="select distinct i.customer_number 
     			 from qry_kartu_piutang i where i.tanggal<='$date2' and (i.customer_number <>'')"; 
				if($kode!="")$sql.=" and i.customer_number='$kode'";
				$sql.=" order by i.customer_number";
				
				$rst_cst=$CI->db->query($sql);
				
				$tbl="";
                $cst_name="";
				foreach($rst_cst->result() as $row_cst){
					if($cst_name_q=$CI->db->query("select company from customers where customer_number='".$row_cst->customer_number."'")){
					    if($cst_name_r=$cst_name_q->row()){
					        $cst_name_q=$cst_name_r->company;
					    }
                    }
					$tbl.="	<h3>".$row_cst->customer_number." - ".$cst_name."</h3> 		
						<table class='titem'>
						<thead>
							<tr><td>Tanggal</td><td>Jenis</td>
								<td>No Bukti</td><td>Ref</td><td>Debit</td><td>Credit</td>
								<td>Saldo</td><td>J Bayar</td>
							</tr>
						</thead>
						<tbody>
					";
				 
					$sql="select sum(amount) as z_jumlah from qry_kartu_piutang i where i.tanggal<'$date1'"; 
					$sql.=" and i.customer_number='".$row_cst->customer_number."'";
					
					$rst_cst_awal=$CI->db->query($sql)->row();
					 
					$z_jumlah=$rst_cst_awal->z_jumlah;
						
					$tbl.="<tr>";
					$tbl.="<td>SALDO AWAL</td>";
					$tbl.="<td></td>";
					$tbl.="<td></td>";
					$tbl.="<td></td>";
					$tbl.="<td align='right'>".number_format(0)."</td>";
					$tbl.="<td align='right'>".number_format(0)."</td>";
					$tbl.="<td align='right'>".number_format($z_jumlah)."</td>";
					$tbl.="</tr>";
					
					$sql="select i.customer_number,i.tanggal,i.jenis,i.ref,amount,i.no_bukti 
					 from qry_kartu_piutang i where i.tanggal between '$date1' and '$date2'"; 
					$sql.=" and i.customer_number='".$row_cst->customer_number."'";
					$sql.=" order by i.customer_number,i.tanggal";
					
					$rst_so=$CI->db->query($sql);
					$z_db=0;$z_cr=0;
					 foreach($rst_so->result() as $row){
						$db=0;$cr=0;
						if($row->amount>0){
							$db=$row->amount;$cr=0;
						} else {
							$db=0;$cr=abs($row->amount);
						}
						$z_jumlah=$z_jumlah+$row->amount;
						$z_db=$z_db+$db;
						$z_cr=$z_cr+$cr;
						
						$jbayar="";
						if($row->jenis=="P"){
							$sql="select how_paid from payments where no_bukti='$row->no_bukti'";
							if($q=$this->db->query($sql)){
								if($r=$q->row()){
									$jbayar=$r->how_paid;
								}
							}
						}

						$tbl.="<tr>";
						$tbl.="<td>".$row->tanggal."</td>";
						$tbl.="<td>".$row->jenis."</td>";
						$tbl.="<td>".$row->no_bukti."</td>";
						$tbl.="<td>".$row->ref."</td>";
						$tbl.="<td align='right'>".number_format($db)."</td>";
						$tbl.="<td align='right'>".number_format($cr)."</td>";
						$tbl.="<td align='right'>".number_format($z_jumlah)."</td>";
						$tbl.="<td>".$jbayar."</td>";
						$tbl.="</tr>";
				   };

					$tbl.="<tr>";
					$tbl.="<td><h4>SALDO</h4></td>";
					$tbl.="<td></td>";
					$tbl.="<td></td>";
					$tbl.="<td></td>";
					$tbl.="<td align='right'><h4>".number_format($z_db)."</h4></td>";
					$tbl.="<td align='right'><h4>".number_format($z_cr)."</h4></td>";
					$tbl.="<td align='right'><h4>".number_format($z_jumlah)."</h4></td>";
					$tbl.="</tr>";

					$tbl.="		</tbody>
						</table>";
					
				}	
			   echo $tbl;
				   				   				   
			?>	
     	
     	</td>
     </tr>
</table>
