<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
	$category= $CI->input->post('text2');
	$sistim= $CI->input->post('text3');
	$outlet= $CI->input->post('text4');
	$doc_type=$CI->input->post("text5");
	$outlet_source=$CI->input->post("text6");

	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2>RETUR PEMBELIAN BY ITEMS</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>
     		Category: <?=$category?> Sistim: <?=$sistim?>, Outlet: <?=$outlet?>, DocType: <?=$doc_type?>,
     		Outlet Source: <?=$outlet_source?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr>
 				<td>Kode</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
 				<td>Price</td><td>Total</td><td>Tanggal</td>
				<td>Bukti#</td><td>Supplier</td><td>Category</td><td>Sistim</td>
 			</tr> 	
 		</thead>
 		<tbody>
     	<?php
     	$sql="select i.purchase_order_number,i.item_number,i.description,
		i.quantity,i.unit,i.price,i.total_price,p.po_date,p.potype,p.supplier_number,
		i.qty_recvd,s.supplier_name,stk.type_of_invoice,stk.category
		from purchase_order p 
		left join purchase_order_lineitems i on i.purchase_order_number=p.purchase_order_number 
		left join suppliers s on s.supplier_number=p.supplier_number
		left join inventory stk on stk.item_number=i.item_number
		where p.potype='R' and p.po_date between '$date1' and '$date2' and i.item_number<>'' ";
		if($supplier!=""){
			$sql.=" and p.supplier_number='$supplier' ";
		}
		if($category!=""){
			$sql.=" and stk.category='$category' ";
		}
		if($sistim!=""){
			$sql.=" and stk.type_of_invoice='$sistim' ";
		}
		if($outlet!="")$sql.=" and p.warehouse_code='$outlet' ";
		if($doc_type!="")$sql.=" and p.doc_type='$doc_type' ";
        if($outlet_source!="")$sql.="  and p.branch_code='$outlet_source' ";
		

		$sql.="	order by i.description";
        $q=$CI->db->query($sql);
		$tbl="";
		$total=0;
		$tqty=0;
		foreach($q->result() as $r){
            $tbl.="<tr>";
            $tbl.="<td>".$r->item_number."</td>";
            $tbl.="<td>".$r->description."</td>";
            $tbl.="<td>".$r->unit."</td>";
            $tbl.="<td align='right'>".number_format($r->quantity,2)."</td>";		
            $tbl.="<td align='right'>".number_format($r->price,2)."</td>";
            $tbl.="<td align='right'>".number_format($r->total_price,2)."</td>";
            $tbl.="<td>".$r->po_date."</td>";
            $tbl.="<td>".$r->purchase_order_number."</td>";
            $tbl.="<td>".$r->supplier_name."</td>";
            $tbl.="<td>".$r->category."</td>";
	        $tbl.="<td>".$r->type_of_invoice."</td>";
            $tbl.="</tr>";
			$total+=$r->total_price;
			$tqty+=$r->quantity;
		}
        $tbl.="<tr>";
        $tbl.="<td><b>TOTAL</b></td>";
        $tbl.="<td></td>";
        $tbl.="<td></td>";
        $tbl.="<td><b>".number_format($tqty,2)."</b></td>";
        $tbl.="<td></td>";
        $tbl.="<td align='right'><b>".number_format($total,2)."</b></td>";
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



