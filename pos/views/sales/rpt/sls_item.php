<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $CI->load->model("shipping_locations_model");
     $CI->load->model("invoice_model");
     
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    
    $outlet=$CI->input->post('text1');    
    $outlet_name=$CI->shipping_locations_model->outlet($outlet);
    $kode_barang=$CI->input->post('text2');
    $outlet_name="";
    $company_name="";
    if($outlet!=""){
        if($qgdg=$CI->shipping_locations_model->get_by_id($outlet)){
            if($gdg=$qgdg->row()){
                $outlet_name=$gdg->attention_name;
                $company_code=$gdg->company_name;
                if($company_code!=""){
                    if($qcom=$CI->db->query("select company_name from preferences 
                        where company_code='$company_code' ")){
                            if($rcom=$qcom->row()){
                                $company_name=$rcom->company_name;
                            }
                        }
                }
                
            }
        }
        if($outlet_name==""){
            $outlet_name=$CI->shipping_locations_model->outlet($outlet);            
        }
    }
    
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>PENJUALAN PER BARANG</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     		, Outlet: <?=$outlet?>, Perusahaan: <?=$company_name?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Kode Barang</td><td>Nama Barang</td><td>Qty</td>
	     				<td>Disc</td><td>Amount</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select il.item_number,il.description,
     			sum(il.quantity) as quantity,
     			sum(il.discount_amount) as disc_amt,sum(il.amount) as amt
     			 from invoice i 
     			 join invoice_lineitems il on il.invoice_number=i.invoice_number
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  
				and il.quantity<>0";
                if($outlet!="")$sql.=" and il.warehouse_code='$outlet' ";
				if($kode_barang!="")$sql.=" and il.item_number='".$kode_barang."'";
				$sql.=" group by il.item_number,il.description";
				
     			$rst_so=$CI->db->query($sql)->result();
     			$tbl="";
				$item_new="";	$item_old="";
				$i=0;
				$z_qty=0;
				$z_disc=0;
				$z_amt=0;
				
                while($i<count($rst_so)){
					$row=$rst_so[$i];
						$tbl="<tr>";
						$tbl.="<td>".$row->item_number."</td>";
						$tbl.="<td>".$row->description."</td>";
						$tbl.="<td align='right'>".number_format($row->quantity)."</td>";
						$tbl.="<td align='right'>".number_format($row->disc_amt)."</td>";
						$tbl.="<td align='right'>".number_format($row->amt)."</td>";
												
						$tbl.="</tr>";
						$z_qty=$z_qty+$row->quantity;
						$z_disc+=$row->disc_amt;
						$z_amt+=$row->amt;
						
						$i++;
	                   echo $tbl;
					}
					
					$tbl="
					<thead>
					<tr>
	     				<td>Sub Total</td><td></td><td align='right'>$z_qty</td>
	     				<td align='right'><b>".number_format($z_disc)."</b></td>
	     				<td align='right'><b>".number_format($z_amt)."</b></td>
	     			</tr>
					</thead>
					";
					
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
