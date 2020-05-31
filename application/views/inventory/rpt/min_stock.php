<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
if(!$CI->input->post('cmdPrint')){
	$data['criteria1']=true;
	$data['label1']='Kelompok Barang';
	$data['text1']='';
         $data['key1']="kode";
         $data['fields1'][]=array("kode","80","Kode");
         $data['fields1'][]=array("category","180","Kelompok");
         $data['ctr1']='category/select';
	$data['caption']='DAFTAR UNDER STOCK';
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
} else {	

     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$category = $CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'>
		<h2>DAFTAR STOCK MINIMUM</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Category: <?=$category?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td>Kode Barang</td><td>Nama Barang</td><td>Qty Sales M3</td>
 				<td>Qty Akhir</td>

 				<td>Qty MinM3</td>
				<td>Qty MinM1</td>
				<td>Qty MinW7</td>
 				
 				<td>Qty SafM3</td>
				<td>Qty SafM1</td>
				<td>Qty SafW7</td>
 				
 			</tr>
 		</thead>
 		<tbody>
     			<?php
     			$dayYmd=date("Y-m-d");
     			$tanggal_tiga_bulan=date("Y-m-d",strtotime($dayYmd . " -2 month"));
				
     			$sql="select i.item_number,i.description,i.category,i.quantity_in_stock
     			,i.quantity_on_order,i.picking_order,i.reorder_quantity,i.quantity_on_back_order
     			,q.qty_sale
     			
     			 from inventory i 
     			 left join (
				 	select il.item_number, sum(il.quantity) as qty_sale 
				 	from invoice_lineitems il join invoice i on i.invoice_number=il.invoice_number 
				 	where i.invoice_type='I' and i.invoice_date>'$tanggal_tiga_bulan' 
				 	group by il.item_number
				 ) q on q.item_number=i.item_number";
				 
				 
				 if($category!="")$sql.=" where i.category='$category' ";


				 //$sql.=" and i.item_number='CMN-BL-A-0001'";

				 $sql.=" order by i.description";
				 
			 	//echo $sql;
				
				
				$qty_min_m1=0;
				$qty_min_w1=0;
				$rst_item=$CI->db->query($sql);
				foreach($rst_item->result() as $row_item){
					$qty_min=c_($row_item->qty_sale);
					if($qty_min>0){
						$qty_min=round($qty_min/90);
						$qty_min_m1=round($qty_min*30);
						$qty_min_w1=round($qty_min*7);
											}
//					$qty_min=$qty_min*7;
					$qty_safety=$row_item->quantity_in_stock-$qty_min;
					$qty_safety_m1=$row_item->quantity_in_stock-$qty_min_m1;
					$qty_safety_w1=$row_item->quantity_in_stock-$qty_min_w1;
					$red_css="";
					if($qty_safety<0)$red_css=" style='color:red'";
					$red_css_m1="";
					if($qty_safety_m1<0)$red_css_m1=" style='color:red'";
					$red_css_w1="";
					if($qty_safety_w1<0)$red_css_w1=" style='color:red'";
															
				?>	
					<tr>
						<td <?=$red_css?> > <?=$row_item->item_number?></td>
						<td <?=$red_css?> ><?=$row_item->description?></td>
						<td><?=c_($row_item->qty_sale)?></td>
						<td><?=$row_item->quantity_in_stock?></td>

						<td><?=$qty_min?></td>
						<td><?=$qty_min_m1?></td>
						<td><?=$qty_min_w1?></td>

						<td <?=$red_css?>><?=$qty_safety?></td>
						<td <?=$red_css_m1?>><?=$qty_safety_m1?></td>
						<td <?=$red_css_w1?>><?=$qty_safety_w1?></td>
						
						
					</tr>
				
				<?php } ?>
   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>

	<?php } ?>