<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
	$salesman=$this->input->post("text1");
	$customer=$this->input->post("text2");
	$outlet=$this->input->post("text3");
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>RETUR PENJUALAN PER ITEM</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Salesman: <?=$salesman?>,
     		Customer: <?=$customer?>, Outlet: <?=$outlet?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
	     				<td>Jumlah</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select il.item_number,il.description,sum(il.quantity) as z_qty,
     			 il.unit,sum(il.amount) as z_amt 
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
	            where i.invoice_type='R' and i.invoice_date between '$date1' and '$date2' ";
				if($salesman!="")$sql.=" and i.salesman='$salesman'";
				if($customer!="")$sql.=" and i.sold_to_customer='$customer'";
				if($outlet!="")$sql.=" and il.warehouse_code='$outlet'";
				
				$sql.=" group by il.item_number,il.description,il.unit ";
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->item_number."</td>";
                    $tbl.="<td>".$row->description."</td>";
                    $tbl.="<td align='right'>".number_format($row->z_qty)."</td>";
                    $tbl.="<td>".$row->unit."</td>";
                    $tbl.="<td align='right'>".number_format($row->z_amt)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
