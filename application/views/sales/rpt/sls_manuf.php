<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");
    $merk=$CI->input->post("text5");
   
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>PENJUALAN PER MERK BARANG</h2></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->street?></td><td></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->suite?></td>     	
     </tr>
     <tr>
     	<td>
     		<?=$model->city_state_zip_code?> - Phone: <?=$model->phone_number?>
     	</td>
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
            Salesman: <?=$salesman?>, Customer: <?=$customer?>, Merk: <?=$merk?>
            Outlet: <?=$outlet?>        
     		
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Item Number</td><td>Description</td><td>Invoice</td><td>Date</td>
                         <td>Category</td>
                         <td>Supplier</td><td>Qty</td><td>Amount Sale</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select stk.manufacturer, sum(il.amount) as z_amount,
     			sum(il.quantity) as z_qty
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
     			 left join inventory stk on stk.item_number=il.item_number
     			 left join inventory_categories cat on cat.kode=stk.category     			 
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  ";
				if($salesman!="")$sql.=" and i.salesman='".$salesman."'";
                if($customer!="")$sql.=" and i.sold_to_customer='".$customer."'";
                if($outlet!="")$sql.=" and i.warehouse_code='".$outlet."'";
                if($merk!="")$sql.=" and stk.manufacturer='".$merk."'";
    			$sql.=" group by stk.manufacturer";

                $rst_so=$CI->db->query($sql);
     			$tbl="";
     			$qty_tot=0;
     			$amt_tot=0;
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td><h3>".$row->manufacturer."</h3></td><td></td><td></td><td></td><td></td><td></td>";
                    $tbl.="<td align='right'><b></b></td>";
                    $tbl.="<td align='right'><b></b></td>";
                    $tbl.="</tr>";

                    $sql="select il.item_number,stk.description,stk.category, stk.supplier_number, 
                            i.invoice_number,i.invoice_date,
                            sum(il.amount) as z_amount, sum(il.quantity) as z_qty
                            from invoice i left join customers c on c.customer_number=i.sold_to_customer
                            left join invoice_lineitems il on il.invoice_number=i.invoice_number
                            left join inventory stk on stk.item_number=il.item_number
                            left join inventory_categories cat on cat.kode=stk.category     			 
                        where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  ";
                        if($salesman!="")$sql.=" and i.salesman='".$salesman."'";
                        if($customer!="")$sql.=" and i.sold_to_customer='".$customer."'";
                        if($outlet!="")$sql.=" and i.warehouse_code='".$outlet."'";
                        $sql.=" and stk.manufacturer='".$row->manufacturer."'";
                        $sql.=" group by il.item_number,stk.description,stk.category,stk.supplier_number, 
                        i.invoice_number,i.invoice_date";
                    $tbl.= "<tr><td colspan='4'>";
                    if($q2=$this->db->query($sql)){
                        foreach($q2->result() as $r2){
                            $tbl.="<tr><td>$r2->item_number</td>
                            <td>$r2->description</td><td>$r2->invoice_number</td>
                            <td>".substr($r2->invoice_date,0,10)."</td>
                            <td>$r2->category</td><td>$r2->supplier_number</td>
                            <td align='right'>".number_format($r2->z_qty)."</td>
                            <td align='right'>".number_format($r2->z_amount)."</td></tr>";
                        }
                    }
                    $tbl.= "</td></tr>";

                    $tbl.="<tr>";
                    $tbl.="<td></td><td><b>Sub Total: ".$row->manufacturer."</b></td><td></td><td></td><td></td><td></td>";
                    $tbl.="<td align='right'><b>".number_format($row->z_qty)."</b></td>";
                    $tbl.="<td align='right'><b>".number_format($row->z_amount)."</b></td>";
                    $tbl.="</tr>";
                    $qty_tot+=$row->z_qty;
                    $amt_tot+=$row->z_amount;

                 }
                $tbl.="<tr>";
                $tbl.="<td><strong>TOTAL</strong></td><td></td><td></td><td></td><td></td><td></td>";
                $tbl.="<td align='right'><strong><b>".number_format($qty_tot)."</b></strong></td>";
                $tbl.="<td align='right'><strong><b>".number_format($amt_tot)."</b></strong></td>";
                $tbl.="</tr>";
            
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
