<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$kode_barang=$CI->input->post('text1');
    $CI->load->model('sales_order_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>PENJUALAN PER BARANG</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
	     				<td>Harga</td><td>Disc%</td><td>Jumlah</td>
	     				<td>Tanggal</td><td>Nomor Faktur</td><td>Kode Pelanggan</td><td>Nama Pelanggan</td>
	     				<td>Nomor SO</td><td>Termin</td><td>Salesman</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select il.item_number,il.description,il.price,il.discount, 
     			il.amount,il.discount,il.unit,il.quantity,
     			i.invoice_date,i.invoice_number,i.sold_to_customer,
     			c.company,i.due_date,i.payment_terms,i.salesman,i.sales_order_number
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  
				and il.quantity<>0";
				if($kode_barang!="")$sql.=" and il.item_number='".$kode_barang."'";
				$sql.=" order by il.item_number";
				
     			$rst_so=$CI->db->query($sql)->result();
     			$tbl="";
				$item_new="";	$item_old="";
				$i=0;
				
                while($i<count($rst_so)){
					$row=$rst_so[$i];
					$item_new=$row->item_number;	
					$item_old=$item_new;
					$z_qty=0;
					$z_amt=0;
					while ($item_old==$item_new && $i<count($rst_so)) {
						$tbl.="<tr>";
						$tbl.="<td>".$row->item_number."</td>";
						$tbl.="<td>".$row->description."</td>";
						$tbl.="<td align='right'>".number_format($row->quantity)."</td>";
						$tbl.="<td>".$row->unit."</td>";
						$tbl.="<td align='right'>".number_format($row->price)."</td>";
						$tbl.="<td align='right'>".number_format($row->discount,2)."</td>";
						$tbl.="<td align='right'>".number_format($row->amount,2)."</td>";
						
						$tbl.="<td>".$row->invoice_date."</td>";
						$tbl.="<td>".$row->invoice_number."</td>";
						$tbl.="<td>".($row->sold_to_customer)."</td>";
						$tbl.="<td>".$row->company."</td>";
						$tbl.="<td>".$row->sales_order_number."</td>";
						$tbl.="<td>".$row->payment_terms."</td>";
						$tbl.="<td>".$row->salesman."</td>";
						$tbl.="</tr>";
						
						$z_qty=$z_qty+$row->quantity;
						$z_amt=$z_amt+$row->amount;
						$i++;
						if($i<count($rst_so)-1){
							$row=$rst_so[$i];
							$item_new=$row->item_number;	
						}
					}
					
					$tbl.="
					<thead>
					<tr>
	     				<td>Sub Total</td><td>$item_old</td><td>$z_qty</td><td></td>
	     				<td>Jumlah</td><td></td><td align='right'>".number_format($z_amt)."</td>
	     				<td></td><td></td><td></td><td></td>
	     				<td></td><td></td><td></td>
	     			</tr>
					</thead>
					";
					
                };
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
