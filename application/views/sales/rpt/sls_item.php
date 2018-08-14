<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$category=$CI->input->post('text1');
    $outlet=$CI->input->post("text2");
   
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>PENJUALAN PER BARANG</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     		Category: <?=$category?>, Outlet: <?=$outlet?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
	     				<td>Harga</td><td>Jumlah</td><td>Category</td><td>Sub Category</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select il.item_number,il.description,stk.retail, 
     			sum(il.quantity) as z_qty, stk.unit_of_measure,
     			sum(il.amount) as z_amount,stk.category,stk.sub_category
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
     			 left join inventory stk on stk.item_number=il.item_number
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  
				";
				if($category!="")$sql.=" and stk.category='$category'";
                if($outlet!="")$sql.=" and il.warehouse_code='$outlet'";
                
                
				$sql.=" group by il.item_number,il.description,stk.retail,
				    stk.unit_of_measure,stk.category,stk.sub_category";
				
     			$q_so=$CI->db->query($sql);
                
                $z_qty=0;
                $z_amt=0;
                $tbl="";
                $item_new="";   $item_old="";
                $i=0;
                $total=0;
                
                
                foreach($q_so->result() as $row){
					$tbl.="<tr>";
					$tbl.="<td>".$row->item_number."</td>";
					$tbl.="<td>".$row->description."</td>";
					$tbl.="<td align='right'>".number_format($row->z_qty)."</td>";
					$tbl.="<td>".$row->unit_of_measure."</td>";
                    $tbl.="<td align='right'>".number_format($row->retail)."</td>";
					$tbl.="<td align='right'>".number_format($row->z_amount,2)."</td>";
                    $tbl.="<td>".$row->category."</td>";
                    $tbl.="<td>".$row->sub_category."</td>";
					$tbl.="</tr>";
					
					$z_qty=$z_qty+$row->z_qty;
					$z_amt=$z_amt+$row->z_amount;
                    $total+=$row->z_amount;
                }
			    echo $tbl;
               
                $tbl="<tr>";
                $tbl.="<td>TOTAL</td>";
                $tbl.="<td></td>";
                $tbl.="<td align='right'></td>";
                $tbl.="<td></td>";
                $tbl.="<td align='right'></td>";
                $tbl.="<td align='right'>".number_format($total,2)."</td>";
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
