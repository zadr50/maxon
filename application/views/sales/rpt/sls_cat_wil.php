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
     		<h2>PENJUALAN PER SALESMAN, WILAYAH, KATEGORI</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
            Salesman: <?=$salesman?>, Customer: <?=$customer?>, 
            Outlet: <?=$outlet?>, Category: <?=$category?>, Wilayah: <?=$region?>        
     		
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
						<td>Cat Name</td>
	     				<td>Wilayah</td>
	     				<td align=right>Target</td>
						<td align='right'>Omset</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select stk.category as cat_code,cat.category,r.region_name,i.salesman,
     			sum(il.amount) as z_omset
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
     			 left join inventory stk on stk.item_number=il.item_number
     			 left join inventory_categories cat on cat.kode=stk.category
     			 left join region r on r.region_id=c.region     			 
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  ";
				if($salesman!="")$sql.=" and i.salesman='$salesman'";
                if($customer!="")$sql.=" and i.sold_to_customer='$customer'";
                if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
                if($category!="")$sql.=" and stk.category='$category'";
                if($region!="")$sql.=" and c.region='$region'";
                
                
    			$sql.=" group by stk.category,c.region,i.salesman";
				
                 
                
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$total=0;
                 foreach($rst_so->result() as $row){
                 	$target=0;
                 	$omset_prc=0;
                 	if($target>0)$omset_prc=$row->z_omset/$target*100;
                    $tbl.="<tr>";
                    //$tbl.="<td>".$row->cat_code."</td>";
                    $tbl.="<td>".$row->category."</td>";
                    $tbl.="<td>".$row->region_name."</td>";
                    //$tbl.="<td>".$row->salesman."</td>";
                    $tbl.="<td align='right'>".number_format($target)."</td>";
                    $tbl.="<td align='right'>".number_format($row->z_omset,2)."</td>";
                    //$tbl.="<td align='right'>".number_format($omset_prc,2)."</td>";
					$total+=$row->z_omset;
                $tbl.="</tr>";
               };
			   $tbl.="<tr><td>TOTAL</td><td>.</td><td>.</td>
			   <td align=right>".number_format($total,2)."</td></tr>";
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
