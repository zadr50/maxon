<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
	$salesman=$CI->input->post("text1");
	$customer=$CI->input->post("text2");
	$outlet=$CI->input->post("text3");
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>SALES ORDER BY CUSTOMER</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Salesman: <?=$salesman?>, 
     		Customer: <?=$customer?>, Outlet: <?=$outlet?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Nomor SO#</td><td>Kode Cust</td>
					<td>Nama Customer</td><td>Tanggal</td><td>Req.Date</td>
					<td>Termin</td><td>Salesman</td>
					<td>Jumlah</td><td>Delivered?</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select s.sales_date,s.sales_order_number,s.sold_to_customer,
     			c.company,s.due_date,s.payment_terms,s.salesman,s.amount,s.delivered
     			 from sales_order s left join customers c on c.customer_number=s.sold_to_customer
	            where   s.sales_date between '$date1' and '$date2'  ";
				$logged_in=$this->session->userdata('logged_in');
				if($logged_in['flag1']!=''){
					$sql.=" and s.salesman='".$logged_in['username']."'";
				}
				if($salesman!="")$sql.=" and s.salesman='$salesman'";
				if($customer!="")$sql.=" and s.sold_to_customer='$customer'";
				if($outlet!="")$sql.=" and s.warehouse_code='$outlet'";
				
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$total=0;
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->sales_order_number."</td>";
                    $tbl.="<td>".($row->sold_to_customer)."</td>";
                    $tbl.="<td>".$row->company."</td>";
                    $tbl.="<td>".$row->sales_date."</td>";
                    $tbl.="<td>".$row->due_date."</td>";
                    $tbl.="<td>".$row->payment_terms."</td>";
                    $tbl.="<td>".$row->salesman."</td>"; 
                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";
                    $tbl.="<td>".$row->delivered."</td>";
                    $tbl.="</tr>";
					$total+=$row->amount;
               };
                $tbl.="<tr>";
                $tbl.="<td><b>TOTAL</b></td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>";
                $tbl.="<td></td>"; 
                $tbl.="<td align='right'><b>".number_format($total)."</b></td>";
                $tbl.="<td></td>";
                $tbl.="</tr>";
			   
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
