<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>SALES ORDER BY ITEM NUMBER</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Item Number</td><td>Description</td>
					<td>Quantity</td><td>Unit</td><td>Price</td>
					<td>Disc%</td><td>Amount</td>
					<td>Ship Qty</td><td>Pend Qty</td>
					<td>Tanggal</td><td>Nomor Sales Order</td><td>Kode Pelanggan</td><td>Nama Pelanggan</td>
	     			<td>Salesman</td> 
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select si.item_number,si.description,si.quantity,si.unit,
				si.price,si.discount,si.amount,si.ship_qty,
				s.sales_date,s.sales_order_number,s.sold_to_customer,
     			c.company,s.due_date,s.payment_terms,s.salesman,s.amount
     			 from sales_order s left join customers c on c.customer_number=s.sold_to_customer
				 left join sales_order_lineitems si on si.sales_order_number=s.sales_order_number
	            where s.sales_date between '$date1' and '$date2'  ";
				$logged_in=$this->session->userdata('logged_in');
				if($logged_in['flag1']!=''){
					$sql.=" and s.salesman='".$logged_in['username']."'";
				}
				
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td>".$row->quantity."</td>";
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="<td>".$row->price."</td>";
                    $tbl.="<td>".$row->discount."</td>";
                    $tbl.="<td>".$row->amount."</td>";
                    $tbl.="<td>".$row->ship_qty."</td>";
                    $tbl.="<td>".($row->quantity-$row->ship_qty)."</td>";
                    $tbl.="<td>".$row->sales_date."</td>";
                    $tbl.="<td>".$row->sales_order_number."</td>";
                    $tbl.="<td>".($row->sold_to_customer)."</td>";
                    $tbl.="<td>".$row->company."</td>";
                    $tbl.="<td>".$row->salesman."</td>"; 
                    $tbl.="</tr>";
               };
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
