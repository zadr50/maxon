<?php
//var_dump($_POST);
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
	$category= $CI->input->post('text2');
	$sistim= $CI->input->post('text3');
	$gudang= $CI->input->post('text4');
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2>PO OUTSTANDING WITH ITEMS</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>
     		Outlet: <?=$gudang?>, Sistim: <?=$sistim?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr>
 				<td>Kode</td><td>Nama Barang</td><td>Qty</td><td>Qty Rcv</td>
 				<td>Price</td><td>Total</td><td>Tanggal</td><td>Type</td>
				<td>Bukti#</td><td>Supplier</td><td>Outlet</td><td>Sistim</td>
 			</tr> 	
 		</thead>
 		<tbody>
     	<?php
				    $potype=getvar("PoType","O");

     	$sql="select i.purchase_order_number,i.item_number,i.description,
		i.quantity,i.price,i.total_price,p.po_date,p.potype,p.supplier_number,
		i.qty_recvd,s.supplier_name,p.type_of_invoice,p.warehouse_code
		from purchase_order p 
		left join purchase_order_lineitems i on i.purchase_order_number=p.purchase_order_number 
		left join suppliers s on s.supplier_number=p.supplier_number
		where  p.received=0 and potype='$potype'	and  p.po_date between '$date1' and '$date2'";
		
		if($supplier!="")$sql.=" and p.supplier_number='$supplier'"; 
		
		if($gudang!="")$sql.=" and p.warehouse_code='$gudang' ";
		
		if($sistim!="")$sql.=" and p.type_of_invoice='$sistim' ";
		
		$sql.=" order by i.item_number,p.po_date";
        $q=$CI->db->query($sql);
		$tbl="";
		$total=0;
		foreach($q->result() as $r){
            $tbl.="<tr>";
            $tbl.="<td>".$r->item_number."</td>";
            $tbl.="<td>".$r->description."</td>";
            $tbl.="<td align='right'>".number_format($r->quantity)."</td>";
            $tbl.="<td align='right'>".number_format($r->qty_recvd)."</td>";
			
            $tbl.="<td align='right'>".number_format($r->price)."</td>";
            $tbl.="<td align='right'>".number_format($r->total_price)."</td>";
            $tbl.="<td>".$r->po_date."</td>";
            $tbl.="<td>".$r->potype."</td>";
            $tbl.="<td>".$r->purchase_order_number."</td>";
            $tbl.="<td>".$r->supplier_name."</td>";
            $tbl.="<td>$r->warehouse_code</td>";
            $tbl.="<td>$r->type_of_invoice</td>";
            $tbl.="</tr>";
            $total+=$r->total_price;
		}
        $tbl.="<tr>";
        $tbl.="<td>TOTAL</td>";
        $tbl.="<td></td>";
        $tbl.="<td align='right'></td>";
        $tbl.="<td align='right'></td>";
		
        $tbl.="<td align='right'></td>";
        $tbl.="<td align='right'>".number_format($total,2)."</td>";
        $tbl.="<td></td>";
        $tbl.="<td></td>";
        $tbl.="<td></td>";
        $tbl.="<td></td>";
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



