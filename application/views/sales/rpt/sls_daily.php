<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");
    $category=$CI->input->post("text4");
    $region=$CI->input->post("text5");
   
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'>
     		<h2>DAILY SALES REPORT</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
            Wilayah: <?=$region?>, Category: <?=$category?>        
     		
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Category</td>
	     				<td align='right'>Actual</td><td align='right'>Target</td>
	     				<td align='right'>Variance</td>
	     				<td align='right'>MTD Actual</td><td align='right'>MTD Target</td>
	     				<td align='right'>MTD Variance</td>	     				
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select cat.category,sum(il.amount) as z_sales,sum(il.cost*il.quantity) as z_cost
     			 from invoice i 
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
     			 left join inventory stk on stk.item_number=il.item_number
     			 left join inventory_categories cat on cat.kode=stk.category
	            where i.invoice_type='I' and  i.invoice_date between '$date1' and '$date2'  ";
				if($salesman!="")$sql.=" and i.salesman='$salesman'";
                if($customer!="")$sql.=" and i.sold_to_customer='$customer'";
                if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
                if($category!="")$sql.=" and stk.category='$category'";
                
                
    			$sql.=" group by cat.category";
								 
                
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$sales_total=0;			$cost_total=0;		$variance_total=0;
				
				$tbl_revenue="<tr><td colspan=4><b>SALES BY CATEGORY</b></td></tr>";
				$tbl_cost="<tr><td colspan=4><b>COGS</b></td></tr>";
                 foreach($rst_so->result() as $row){
	             	$sales_target=0;							$cost_target=0;
	             	
	             	if($qcat=$this->db->query("select sales_target from inventory_categories where category='$row->category'")){
	             		if($rcat=$qcat->row()){
	             			$sales_target=$rcat->sales_target;
	             		}
	             	}
	             	
                 	$sales=$row->z_sales;						$cost=$row->z_cost;
                 	$sales_variance=$sales_target-$sales;		$cost_variance=$cost_target-$cost;
                 	
					$sales_total+=$sales;
					$cost_total+=$cost;
                 	                 	
					if(!($sales==0 && $sales_target==0)){
	                    $tbl_revenue.="<tr>";
	                    $tbl_revenue.="<td>".$row->category."</td>";
	                    $tbl_revenue.="<td align='right'>".number_format($sales,2)."</td>";
	                    $tbl_revenue.="<td align='right'>".number_format($sales_target,2)."</td>";					
	                    $tbl_revenue.="<td align='right'>".number_format($sales_variance,2)."</td>";
		                $tbl_revenue.="</tr>";						
					}
                    
					if(!($cost==0 && $cost_target==0)){
	                    $tbl_cost.="<tr>";
	                    $tbl_cost.="<td>".$row->category."</td>";
	                    $tbl_cost.="<td align='right'>".number_format($cost,2)."</td>";
	                    $tbl_cost.="<td align='right'>".number_format($cost_target,2)."</td>";					
	                    $tbl_cost.="<td align='right'>".number_format($cost_variance,2)."</td>";
		                $tbl_cost.="</tr>";
					}

					
               };
			   echo $tbl_revenue;
			   echo "<tr><td><b>TOTAL SALES</b></td><td align='right'><b>".number_format($sales_total,2)."</b></td></tr>";
			   echo $tbl_cost;
			   echo "<tr><td><b>TOTAL COGS</b></td><td align='right'><b>".number_format($cost_total,2)."</b></td></tr>";
			   //sakes by ternin
				
			   	$sql=" 
					select i.payment_terms,sum(i.amount) as amount
					from invoice i 
					where i.invoice_date between '$date1' and '$date2'
					and i.invoice_type='I'
					group by i.payment_terms
			   	";		  
				$term_cash=0;
				$term_credit=0;
				if($q=$CI->db->query($sql)){
					foreach($q->result() as $r){
						if(strtoupper($r->payment_terms)=="CASH" || $r->payment_terms==""){
							$term_cash+=$r->amount;							
						} else {
							$term_credit+=$r->amount;
						}
					}
				}
				$tbl_pay="<tr><td colspan=4><b>SALES REVENUE</b></td></tr>";
                $tbl_pay.="<tr>";
                $tbl_pay.="<td>Revenue Cash</td>";
                $tbl_pay.="<td align='right'>".number_format($term_cash,2)."</td>";
                $tbl_pay.="</tr>";
                $tbl_pay.="<tr>";
                $tbl_pay.="<td>Revenue Credit</td>";
                $tbl_pay.="<td align='right'>".number_format($term_credit,2)."</td>";
                $tbl_pay.="</tr>";
                $tbl_pay.="<tr>";
                $tbl_pay.="<td><b>Revenue Total</b></td>";
                $tbl_pay.="<td align='right'><b>".number_format($term_cash+$term_credit,2)."</b></td>";
                $tbl_pay.="</tr>";
                			   	
				echo $tbl_pay;
						   	
			   //payment
				$tbl_pay="<tr><td colspan=4><b>PAYMENT</b></td></tr>";
			   	$sql=" 
					select sum(p.amount_paid) as amount
					from  payments p left join invoice i on i.invoice_number=p.invoice_number
					where p.date_paid between '$date1' and '$date2'
					and  i.invoice_type='I' and i.payment_terms!='CASH'
			   	";		  
				$ttl_pay=0;
				if($q=$CI->db->query($sql)){
					foreach($q->result() as $r){
		                $tbl_pay.="<tr>";
		                $tbl_pay.="<td>A/R Payment</td>";
		                $tbl_pay.="<td align='right'>".number_format($r->amount,2)."</td>";
		                $tbl_pay.="</tr>";
						$ttl_pay+=$r->amount;
					}
					
				}
                $tbl_pay.="<tr>";
                $tbl_pay.="<td><b>Payment Total</a></td>";
                $tbl_pay.="<td align='right'><b>".number_format($ttl_pay,2)."</b></td>";
                $tbl_pay.="</tr>";
				echo $tbl_pay;
				
				$stock_total=0;

				$tbl_stk="<tr><td colspan=4><b>INVENTORY</b></td></tr>";
				$sql="select c.category,sum((i.qty_masuk-i.qty_keluar)*s.cost) as item_amount
				from qry_kartustock_union i 
				inner join inventory s on s.item_number=i.item_number
				inner join inventory_categories c on c.kode=s.category 
				where i.tanggal<='$date2'
				group by c.category";
				if($q=$CI->db->query($sql)){
					foreach($q->result() as $r){
						$stock_total+=$r->item_amount;
		                $tbl_stk.="<tr>";
		                $tbl_stk.="<td>$r->category</td>";
		                $tbl_stk.="<td align='right'>".number_format($r->item_amount,2)."</td>";
		                $tbl_stk.="</tr>";
					}
					
				}
                $tbl_stk.="<tr>";
                $tbl_stk.="<td><b>TOTAL INVENTORY</b></td>";
                $tbl_stk.="<td align='right'><b>".number_format($stock_total,2)."</b></td>";
                $tbl_stk.="</tr>";

				echo $tbl_stk;
								
								 
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
