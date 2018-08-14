<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<?
 $CI =& get_instance();
 $CI->load->model('customer_model');
    $d1=$CI->input->post('txtDateFrom');
    $d2=$CI->input->post('txtDateTo');
    $d1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $d2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $sql="select i.* from invoice i 
        where i.invoice_date between '$d1' and '$d2' and invoice_type='i' 
        order by invoice_number";
    $qry=$this->db->query($sql);
    if(!$qry){
        echo "<legend>Error SQL: $sql</legend>";
        exit;
    }     
    echo '<h1>FAKTUR PENJUALAN</h2><h2>';
    foreach($qry->result() as $row){
        $sold_to_customer=$row->sold_to_customer;;
        $invoice_number=$row->invoice_number;
        $sales_order_number=$row->sales_order_number;
        $due_date=$row->due_date;
        $comments=$row->comments;
        $discount=$row->discount;
        $tax=$row->sales_tax_percent;
        $freight=$row->freight;
        $others=$row->other;
        $amount=$row->amount;
        $sub_total=0;
        $disc_amount=$row->disc_amount;
        $tax_amount=$row->tax;
        $invoice_date=$row->invoice_date;
                
         $cst=$CI->customer_model->get_by_id($sold_to_customer)->row();

?>

<table cellspacing="0" cellpadding="1" border="0"> 
    <tr>
        <td>Nomor</td><td><?=$invoice_number?></td>
    </tr>
     <tr>
     	<td>Tanggal</td><td><?=$invoice_date?></td>
     	<td colspan="2"><?=$sold_to_customer.' ('.$cst->company.')'?></td>
     </tr>
     <tr>
     	<td>Ref#</td><td><?=$sales_order_number?></td>
     	<td colspan="2"><?=$cst->street?></td>
     </tr>
     <tr>
     	<td>Jatuh Tempo</td><td><?=$due_date?></td>
     	<td colspan="2"><?=$cst->suite.' - '.$cst->city?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$cst->phone.' - Fax: '.$cst->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Up: '.$cst->first_name?></td>
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
     		   <?
		       $sql="select item_number,description,quantity,unit,discount,
					price,amount,disc_2,disc_3 
		                from invoice_lineitems i
		                where invoice_number='".$invoice_number."'";
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
                    $sub_total+=$row->amount;
               };
			   echo $tbl;
    		   ?>
     		</tbody>
     	</table>
     	
     	
     	</td>
     </tr>
     <tr><td>Catatan: <?=$comments?></td><td></td><td>Sub Total</td><td align="right"><?=number_format($sub_total)?></td></tr>
     <tr><td>Ongkos</td><td><?=number_format($freight)?></td><td>Discount <?=$discount?></td><td align="right"><?=number_format($disc_amount)?></td></tr>
     <tr><td>Lain-lain</td><td><?=number_format($others)?></td><td>Pajak <?=$tax?></td><td align="right"><?=number_format($tax_amount)?></td></tr>
     <tr><td></td><td></td><td>Jumlah</td><td align="right"><?=number_format($amount)?></td></tr>
</table>
<legend>.</legend>
<?php } ?>