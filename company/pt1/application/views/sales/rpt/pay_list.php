<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>DAFTAR PEMBAYARAN</h2></td>     	
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
	     			<tr><td>Nomor Bukti#</td><td>Tanggal</td>
					<td>Customer</td><td>Jumlah Bayar</td><td>Jenis Bayar</td>
					<td>Faktur#</td><td>Termin</td>
					<td>Salesman</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select p.no_bukti,p.date_paid,c.company,p.amount_paid,
				p.how_paid,p.invoice_number,i.payment_terms,i.salesman
     			from payments p left join invoice i on i.invoice_number=p.invoice_number 
				left join customers c on c.customer_number=i.sold_to_customer
	            where   p.date_paid between '$date1' and '$date2'  ";
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->no_bukti."</td>";
                    $tbl.="<td>".($row->date_paid)."</td>";
                    $tbl.="<td>".$row->company."</td>";
                    $tbl.="<td align='right'>".number_format($row->amount_paid)."</td>";
                    $tbl.="<td>".$row->how_paid."</td>";
                    $tbl.="<td>".$row->invoice_number."</td>";
                    $tbl.="<td>".$row->payment_terms."</td>"; 
                    $tbl.="<td>".($row->salesman)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
