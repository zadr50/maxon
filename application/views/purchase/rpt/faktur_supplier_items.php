<?
//var_dump($_POST);
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2>FAKTUR PEMBELIAN SUPPLIERS ITEMS</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr>
 				<td>Nama Supplier</td><td>Kode</td><td>Nomor Po</td>
 				<td>Tanggal</td><td>Jumlah</td><td>Type</td>
				<td>Nama Barang</td><td>Kode Barang</td><td>Qty</td>
				<td>Price</td><td>Total</td>
 			</tr>
 		</thead>
 		<tbody>
     	<?
     	$sql="select s.supplier_name,p.supplier_number,p.purchase_order_number,
		p.po_date,p.amount,potype,i.item_number,i.description,i.quantity,i.price,
		i.total_price
		from purchase_order p 
		left join suppliers s on s.supplier_number=p.supplier_number
		left join purchase_order_lineitems i on i.purchase_order_number=p.purchase_order_number
		where p.potype='I' and  p.po_date between '$date1' and '$date2' and potype='I'	
		order by s.supplier_name";
        $q=$CI->db->query($sql);
		$tbl="";
		foreach($q->result() as $r){
            $tbl.="<tr>";
            $tbl.="<td>".$r->supplier_name."</td>";
            $tbl.="<td>".$r->supplier_number."</td>";
            $tbl.="<td>".$r->purchase_order_number."</td>";
            $tbl.="<td>".$r->po_date."</td>";
            $tbl.="<td align='right'>".number_format($r->amount)."</td>";
            $tbl.="<td>".$r->potype."</td>";
            $tbl.="<td>".$r->item_number."</td>";
            $tbl.="<td>".$r->description."</td>";
            $tbl.="<td align='right'>".number_format($r->quantity)."</td>";
            $tbl.="<td align='right'>".number_format($r->price)."</td>";
           $tbl.="<td align='right'>".number_format($r->total_price)."</td>";
             $tbl.="</tr>";
		}
  	    
  	    echo $tbl;
		?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>



