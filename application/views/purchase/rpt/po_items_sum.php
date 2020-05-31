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
     	<td colspan='2'><h2>PURCHASE ORDER BY ITEMS</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>,
     		Outlet: <?=$gudang?>, Sistim: <?=$sistim?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr>
 				<td>Kode</td><td>Nama Barang</td><td align='right'>Qty</td><td>Unit</td>
 				<td align='right'>Price</td><td align='right'>Total</td><td>Cat</td>
 				<td>Outlet</td><td>Sistim</td>
 			</tr> 	
 		</thead>
 		<tbody>
     	<?php
				    $potype=getvar("PoType","O");

     	$sql="select i.item_number,s.description,s.cost_from_mfg as price,s.category,
     		p.warehouse_code,p.type_of_invoice,
		sum(i.quantity) as z_qty,i.unit,
		sum(i.total_price) as z_amount		
		from purchase_order p 
		left join purchase_order_lineitems i on i.purchase_order_number=p.purchase_order_number 
		left join inventory s on s.item_number=i.item_number
		where p.po_date between '$date1' and '$date2' and potype='$potype'	";

					if($supplier!="")$sql.=" and p.supplier_number='$supplier'"; 
					
					if($gudang!="")$sql.=" and p.warehouse_code='$gudang' ";
					
					if($sistim!="")$sql.=" and p.type_of_invoice='$sistim' ";
		
		$sql.=" group by i.item_number,s.description,i.unit,s.cost_from_mfg,s.category,
			p.warehouse_code,p.type_of_invoice";
        $q=$CI->db->query($sql);
		$tbl="";
		$amt=0;
		foreach($q->result() as $r){
            $tbl.="<tr>";
            $tbl.="<td>".$r->item_number."</td>";
            $tbl.="<td>".$r->description."</td>";
            $tbl.="<td align='right'>".number_format($r->z_qty)."</td>";		
            $tbl.="<td>".$r->unit."</td>";
            $tbl.="<td align='right'>".number_format($r->price)."</td>";
            $tbl.="<td align='right'>".number_format($r->z_amount)."</td>";
            $tbl.="<td>".$r->category."</td>";
            $tbl.="<td>$r->warehouse_code</td>";
            $tbl.="<td>$r->type_of_invoice</td>";
            $tbl.="</tr>";
            $amt+=$r->z_amount;
		}
		$tbl.="<tr><td colspan=5><b>TOTAL</b></td><td align='right'><b>".number_format($amt)."</b></td></tr>";
  	    
  	    echo $tbl;
		?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>



