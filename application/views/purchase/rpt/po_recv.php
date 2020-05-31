<?
//var_dump($_POST);
?>
<?
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
     	<td colspan='2'><h2>PO VS RECEIVE</h2></td>     	
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
 			<tr><th>Nomor PO</th><th>Tanggal</th><th>Termin</th><th>Due</th>
 				<th>Kode Supplier</th><th>Nama Supplier</th><th>Kota</th>
 				<th>Phone</th><td>Jumlah</th><th>Received?</th>
 			</tr>
 		</thead>
 		<tbody>
     			<?php 
						    $potype=getvar("PoType","O");

	 		       $sql="select p.purchase_order_number,p.po_date,p.terms,p.supplier_number,
	 		        s.supplier_name,p.amount,p.received,s.city,s.phone,p.due_date   
	                from purchase_order p
	                left join suppliers s on s.supplier_number=p.supplier_number
	                where p.potype='$potype' and p.po_date between '$date1' and '$date2'";
					if($supplier!="")$sql.=" and p.supplier_number='$supplier'"; 
	                $sql.=" order by p.purchase_order_number";
			        $query=$CI->db->query($sql);
	
	     			$tbl="";
	                 foreach($query->result() as $row){
	                    $tbl="<tr>";
	                    $tbl.="<td>".$row->purchase_order_number."</td>";
	                    $tbl.="<td>".$row->po_date."</td>";
	                    $tbl.="<td>".($row->terms)."</td>";
	                    $tbl.="<td>".($row->due_date)."</td>";
	                    $tbl.="<td>".$row->supplier_number."</td>";
	                    $tbl.="<td>".$row->supplier_name."</td>";
	                    $tbl.="<td>".$row->city."</td>";
	                    $tbl.="<td>".$row->phone."</td>";
	                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";
	                    $tbl.="<td>".$row->received."</td>";
	                    $tbl.="</tr>";
						echo $tbl;
						
						echo "
						<tr><td>&nbsp</td><td colspan=10>
							<table class='titem'>
								<thead>
									<tr><th>Kode Barang</th>
									<th>Nama Barang</th><th>Qty Pesan</th></tr>
								</thead>
								<tbody>";
									
										$sql="select p.*,s.description from purchase_order_lineitems p 
										left join inventory s on s.item_number=p.item_number							
										where purchase_order_number='$row->purchase_order_number' 
										 ";
										if($item=$CI->db->query($sql)){
											foreach($item->result() as $it){
												echo "<tr>
												<td>$it->item_number</td>
												<td>$it->description</td>
												<td>$it->quantity</td>
												</tr>";
											}
										}
								echo "
								</tbody>
							</table>
						</td></tr>
						
						<tr><td>&nbsp</td><td colspan=10>
							<table class='titem'>
								<thead>
									<tr><th>Receive#</th><th>Tanggal</th><th>Kode Barang</th>
									<th>Nama Barang</th><th>Qty Recvd</th><th>Gudang</th></tr>
								</thead>
								<tbody>";
									
										$sql="select p.*,s.description from inventory_products p 
										left join inventory s on s.item_number=p.item_number							
										where purchase_order_number='$row->purchase_order_number' 
										
										order by p.shipment_id";
										if($item=$CI->db->query($sql)){
											foreach($item->result() as $it){
												echo "<tr>
												<td>$it->shipment_id</td>
												<td>$it->date_received</td>
												<td>$it->item_number</td>
												<td>$it->description</td>
												<td>$it->quantity_received</td>
												<td>$it->warehouse_code</td>
												</tr>";
											}
										}
								echo "
								</tbody>
							</table>
						</td></tr>
						
						<tr><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
						<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
						<td>&nbsp</td></tr>
						
						";

               };
		?>

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
