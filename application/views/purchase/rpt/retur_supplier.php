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
     	<td colspan='2'><h2>RETUR PEMBELIAN PER SUPPLIERS</h2></td>     	
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
 				<td>Nama Supplier</td><td>Kode</td><td>Nomor Po</td>
 				<td>Tanggal</td><td>Jumlah</td><td>Type</td><td>Recvd</td>
				<td>Termin</td>
 			</tr>
 		</thead>
 		<tbody>
     	<?php
     	$sql="select s.supplier_name,p.supplier_number,p.purchase_order_number,
		p.po_date,p.amount,potype,p.received,p.terms
		from purchase_order p 
		left join suppliers s on s.supplier_number=p.supplier_number
		where p.potype='R' and p.po_date between '$date1' and '$date2' ";
		
		if($supplier!="")$sql.=" and p.supplier_number='$supplier' ";
		if($outlet!="")$sql.=" and p.warehouse_code='$outlet' ";
		if($sistim!="")$sql.=" and p.type_of_invoice='$sistim' ";
		if($doc_type!="")$sql.=" and p.doc_type='$doc_type' ";
        if($outlet_source!="")$sql.="  and p.branch_code='$outlet_source' ";

		$sql.=" order by s.supplier_name";
        $q=$CI->db->query($sql);
		$tbl="";
		$total=0;
		foreach($q->result() as $r){
            $tbl.="<tr>";
            $tbl.="<td>".$r->supplier_name."</td>";
            $tbl.="<td>".$r->supplier_number."</td>";
            $tbl.="<td>".$r->purchase_order_number."</td>";
            $tbl.="<td>".$r->po_date."</td>";
            $tbl.="<td align='right'>".number_format($r->amount)."</td>";
            $tbl.="<td>".$r->potype."</td>";
            $tbl.="<td>".$r->received."</td>";
            $tbl.="<td>".$r->terms."</td>";
            $tbl.="</tr>";
            $total+=$r->amount;
		}
        $tbl.="<tr>";
        $tbl.="<td><b>TOTAL</b></td>";
        $tbl.="<td></td>";
        $tbl.="<td></td>";
        $tbl.="<td></td>";
        $tbl.="<td align='right'>".number_format($total)."</td>";
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



