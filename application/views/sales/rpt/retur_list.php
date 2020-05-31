<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
	$salesman=$this->input->post("text1");
	$customer=$this->input->post("text2");
	$outlet=$this->input->post("text3");
	
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>DAFTAR RETUR PENJUALAN</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Customer: <?=$customer?>,
     		Salesman: <?=$salesman?>, Outlet: <?=$salesman?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Tanggal</td><td>Nomor Retur</td><td>Kode Pelanggan</td><td>Nama Pelanggan</td>
	     				<td>Nomor Faktur</td><td>Termin</td><td>Salesman</td><td>Jumlah</td>
	     				<td>Outlet</td>
	     				<td>Item</td><td>Item name</td><td>Qty</td><td>Price</td><td>Amount</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select i.invoice_date,i.invoice_number,i.sold_to_customer,
     			c.company,i.due_date,i.payment_terms,i.salesman,i.amount,i.sales_order_number,
     			i.warehouse_code,i.your_order__,
     			il.item_number,il.description,il.quantity,il.price,il.amount as amount_item
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
	            where i.invoice_type='R' and i.invoice_date between '$date1' and '$date2'  ";
				
				if ($customer!="")$sql.=" and i.sold_to_customer='$customer' ";
				if ($salesman!="")$sql.=" and i.salesman='$salesman' ";
				if ($outlet!="")$sql.=" and i.warehouse_code='$outlet' ";
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$total=0;
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->invoice_date."</td>";
                    $tbl.="<td>".$row->invoice_number."</td>";
                    $tbl.="<td>".($row->sold_to_customer)."</td>";
                    $tbl.="<td>".$row->company."</td>";
                    $tbl.="<td>".$row->your_order__."</td>";
                    $tbl.="<td>".$row->payment_terms."</td>";
                    $tbl.="<td>".$row->salesman."</td>";
                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";
                    $tbl.="<td>$row->warehouse_code</td>";
                    $tbl.="<td align='left'>".($row->item_number)."</td>";
                    $tbl.="<td align='left'>".($row->description)."</td>";
                    $tbl.="<td align='right'>".number_format($row->quantity)."</td>";
                    $tbl.="<td align='right'>".number_format($row->price)."</td>";
                    $tbl.="<td align='right'>".number_format($row->amount_item)."</td>";
                    $tbl.="</tr>";
					$total+=$row->amount_item;
               };
			   $tbl.="<tr><td><b>Total</b></td><td></td><td></td><td></td><td></td><td></td><td></td>
			   <td></td><td></td><td></td><td></td><td></td><td></td><td>".number_format($total)."</td></tr>";
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
