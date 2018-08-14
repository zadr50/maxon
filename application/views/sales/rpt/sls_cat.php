<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");
   
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>PENJUALAN PER KELOMPOK BARANG</h2></td>     	
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
            Salesman: <?=$salesman?>, Customer: <?=$customer?>, 
            Outlet: <?=$outlet?>        
     		
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Kode Kelompok</td><td>Category</td>
	     				<td>Sub Category</td><td>Sub Cat Name</td><td>Qty</td><td>Jumlah</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select stk.category as kode,cat.category,
     			stk.sub_category,cat2.category as sub_cat_name,
     			sum(il.amount) as z_amount,
     			sum(il.quantity) as z_qty
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
     			 left join inventory stk on stk.item_number=il.item_number
     			 left join inventory_categories cat on cat.kode=stk.category
     			 left join inventory_categories_sub cat2 on cat2.parent_id=cat.kode  and cat2.kode=stk.sub_category
     			 
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  ";
				if($salesman!="")$sql.=" and i.salesman='".$salesman."'";
                if($customer!="")$sql.=" and i.sold_to_customer='".$customer."'";
                if($outlet!="")$sql.=" and i.warehouse_code='".$outlet."'";
                //if($kode_kelompok_barang!="")$sql.=" and stk.category='".$kode_kelompok_barang."'";
                
                
    			$sql.=" group by stk.category,cat.category,stk.sub_category";
				
                 
                
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->kode."</td>";
                    $tbl.="<td>".$row->category."</td>";
                    $tbl.="<td>".$row->sub_category."</td>";
                    $tbl.="<td>".$row->sub_cat_name."</td>";
                    $tbl.="<td align='right'>".number_format($row->z_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($row->z_amount,2)."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
