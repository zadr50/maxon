<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">

<?php

     $CI =& get_instance();
     $CI->load->model('customer_model');
//     $cst=$CI->customer_model->get_by_id($sold_to_customer)->row();
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $salesman = $CI->input->post('text1');
    $pelanggan = $CI->input->post('text2');
    $outlet = $CI->input->post('text3');
	 
	$s="select i.invoice_number, i.invoice_date,i.sold_to_customer,c.company, 
	i.due_date,c.street,c.suite,c.city,c.phone,c.fax,c.first_name,
	i.comments,i.amount as sub_total,i.discount,i.disc_amount,i.freight,i.other,
	i.tax,i.amount,i.sales_order_number,i.sales_tax_percent 
	from invoice i left join customers c on c.customer_number=i.sold_to_customer 
	where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2' ";
	
	if($outlet!="")$s.=" and i.warehouse_code='$outlet' ";
	if($pelanggan!="")$s.=" and i.sold_to_customer='$pelanggan' ";
	if($salesman!="")$s.=" and i.salesman='$salesman' ";
	
	$s.=" order by i.invoice_date";
	
	
	if($qinv=$CI->db->query($s)){
		if(!$qinv->num_rows()){
			echo "<p>No data found !</p>";
		}
		foreach($qinv->result() as $rinv){
			
?>

<h1>FAKTUR PENJUALAN</h2><h2>Nomor: <?=$rinv->invoice_number?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal</td><td><?=$rinv->invoice_date?></td>
     	<td colspan="2"><?=$rinv->sold_to_customer.' ('.$rinv->company.')'?></td>
     </tr>
     <tr>
     	<td>Ref#</td><td><?=$rinv->sales_order_number?></td>
     	<td colspan="2"><?=$rinv->street?></td>
     </tr>
     <tr>
     	<td>Jatuh Tempo</td><td><?=$rinv->due_date?></td>
     	<td colspan="2"><?=$rinv->suite.' - '.$rinv->city?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$rinv->phone.' - Fax: '.$rinv->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Up: '.$rinv->first_name?></td>
     </tr>
     <tr>
     	<td colspan="8">
     	<table border="1" cellpadding="3">
     		<thead>
     			<tr>
     				<td>Kode Barang</td><td width="200">Nama Barang</td>
					<td width="30">Qty</td><td width="30">Unit</td>
     				<td>Harga</td><td width="30">Disc1</td><td width="30">Disc2</td><td width="30">Disc3</td><td>Jumlah</td>
     			</tr>
     		</theadx>
     		<tbody>
     		   <?php
		       $sql="select item_number,description,quantity,unit,discount,
					price,amount,disc_2,disc_3 
		                from invoice_lineitems i
		                where invoice_number='".$rinv->invoice_number."'";
		        $query=$CI->db->query($sql);

     			$tbl="";
                 foreach($query->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td width=\"200\">".$row->description."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
                    $tbl.="<td width=\"30\">".$row->unit."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->price)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->discount,2)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->disc_2,2)."</td>";
                    $tbl.="<td width=\"30\" align=\"right\">".number_format($row->disc_3,2)."</td>";
                    $tbl.="<td align=\"right\">".number_format($row->amount)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
    		   ?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td>Catatan: <?=$rinv->comments?></td><td></td><td>Sub Total</td><td align="right"><?=number_format($rinv->sub_total)?></td></tr>
     <tr><td></td><td></td><td>Discount <?=$rinv->discount?></td><td align="right"><?=number_format($rinv->disc_amount)?></td></tr>
     <tr><td></td><td></td><td>Pajak <?=$rinv->sales_tax_percent?></td><td align="right"><?=number_format($rinv->tax)?></td></tr>
     <tr><td></td><td></td><td>Ongkos</td><td align="right"><?=number_format($rinv->freight)?></td></tr>
     <tr><td></td><td></td><td>Lain-lain</td><td align="right"><?=number_format($rinv->other)?></td></tr>
     <tr><td></td><td></td><td>Jumlah</td><td align="right"><?=number_format($rinv->amount)?></td></tr>
</table>



<?php			
			
		}
	} 
?>

