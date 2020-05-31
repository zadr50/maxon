<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
	$category = $CI->input->post('text2');
	$sistim = $CI->input->post('text3');
	$gudang = $CI->input->post('text4');
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2>PURCHASE ORDER DETAIL</h2></td>     	
     </tr>
    <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>
     		Gudang: <?=$gudang?>, Sistim: <?=$sistim?>
     	</td>
     </tr>
      
	 <tr>
		<table  class='titem'  cellspacing="0" cellpadding="1" border="0" width="100%">
			<thead><tr><th>PO Number</th><th>Po Date</th><th>Supplier</th><th>Jumlah</th>
				<th>Termin</th><th>Recvd</th>
			</tr></thead>
			<?php 
				$potype=getvar("PoType","O");

			$sql="select p.*,s.supplier_name from purchase_order p 
				left join suppliers s  on p.supplier_number=s.supplier_number 
				where potype='$potype' and p.po_date between '$date1' and '$date2'";
				
			if($supplier!="")$sql.=" and p.supplier_number='$supplier'"; 
			
			if($gudang!="")$sql.=" and p.warehouse_code='$gudang' ";
			
			if($sistim!="")$sql.=" and p.type_of_invoice='$sistim' ";
				
				$sql.=" order by po_date";
			if($q=$CI->db->query($sql)){
				foreach($q->result() as $r){
					echo "<thead><tr><th>$r->purchase_order_number</th>
						<th>$r->po_date</th><th>$r->supplier_name</th>
			            <th align='right'>".number_format($r->amount)."</th>
						<th>$r->terms</th><th>received</th>					
					</tr></thead>";
					
					echo "<tr><td colspan=6><table class='titem' width='100%'>";
					echo "
						<tr>
							<td>Kode</td><td>Nama Barang</td><td>Qty</td>
							<td>Price</td><td>Total</td><td>Qty Rcv</td> 
						</tr>";
						$sql="select i.item_number,i.description,
						i.quantity,i.price,i.total_price,i.qty_recvd
						from purchase_order_lineitems i 
						where i.purchase_order_number='$r->purchase_order_number'";
						if($qLine=$CI->db->query($sql)){
							foreach($qLine->result() as $rLine){
								echo "<tr><td>$rLine->item_number</td>
								<td>$rLine->description</td>
								<td align='right'>".number_format($rLine->quantity)."</td>
								<td align='right'>".number_format($rLine->price)."</td>
								<td align='right'>".number_format($rLine->total_price)."</td>
								<td align='right'>".number_format($rLine->qty_recvd)."</td>
								</tr>";
							}
						}
						
					echo "<tr><td colspan=6></td></tr></table></td></tr>";
				}
				
			}	
			?>
		</table>
	 </tr>
</table>



