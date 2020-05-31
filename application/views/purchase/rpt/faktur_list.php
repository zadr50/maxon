<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
	$supplier= $CI->input->post('text1');
	$category = $CI->input->post('text2');
	$sistim = $CI->input->post('text3');
	$gudang = $CI->input->post('text4');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2>FAKTUR PEMBELIAN SUMMARY</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>
     		Gudang: <?=$gudang?>, Sistim: <?=$sistim?>, Category: <?=$category?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td>Nomor PO</td><td>Tanggal</td><td>Termin</td><td>Due</td>
 				<td>Kode Supplier</td><td>Nama Supplier</td><td>Kota</td>
 				<td>Phone</td><td>Jumlah</td><td>Outlet</td><td>Sistim</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?php
	 		       $sql="select p.purchase_order_number,p.po_date,p.terms,p.supplier_number,
	 		        s.supplier_name,p.amount,p.received,s.city,s.phone,p.due_date,
	 		        p.warehouse_code,p.type_of_invoice   
	                from purchase_order p
	                left join suppliers s on s.supplier_number=p.supplier_number
	                where p.potype='I' and p.po_date between '$date1' and '$date2'";
					if($supplier!="")$sql.=" and p.supplier_number='$supplier'"; 
					if($gudang!="")$sql.=" and p.warehouse_code='$gudang' ";
					
					if($sistim!="")$sql.=" and p.type_of_invoice='$sistim' ";
					
	                $sql.=" order by p.purchase_order_number";
			        $query=$CI->db->query($sql);
	
	     			$tbl="";
                    $total=0;
	                 foreach($query->result() as $row){
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row->purchase_order_number."</td>";
	                    $tbl.="<td>".$row->po_date."</td>";
	                    $tbl.="<td>".($row->terms)."</td>";
	                    $tbl.="<td>".($row->due_date)."</td>";
	                    $tbl.="<td>".$row->supplier_number."</td>";
	                    $tbl.="<td>".$row->supplier_name."</td>";
	                    $tbl.="<td>".$row->city."</td>";
	                    $tbl.="<td>".$row->phone."</td>";
	                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";
	                    $tbl.="<td>".$row->warehouse_code."</td>";
	                    $tbl.="<td>".$row->type_of_invoice."</td>";
	                    $tbl.="</tr>";
	                    $total+=$row->amount;
	               };
                    $tbl.="<tr>";
                    $tbl.="<td><strong>TOTAL</strong></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td align='right'><strong>".number_format($total)."</strong></td>";
                    $tbl.="</tr>";
	               
				   echo $tbl;
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
