<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
if(!$CI->input->post('cmdPrint')){
	$data['criteria1']=true;
	$data['label1']='Kelompok Barang';
	$data['text1']='';
	$data['caption']='DAFTAR OVER STOCK';
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
} else {	

     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'>
		<h2>DAFTAR OVERSTOCK</h2></td>     	
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
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td>Kode Barang</td><td>Nama Barang</td><td>Kelompok</td>
 				<td>Qty Akhir</td><td>Qty OnPO</td><td>Qty OnSO</td><td>Qty Min</td><td>Qty Max</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?php
     			$sql="select * from inventory order by description";
				$rst_item=$CI->db->query($sql);
				foreach($rst_item->result() as $row_item){
				?>	
					<tr>
						<td><?=$row_item->item_number?></td>
						<td><?=$row_item->description?></td>
						<td><?=$row_item->category?></td>
						<td><?=$row_item->quantity_in_stock?></td>
						<td><?=$row_item->quantity_on_order?></td>
						<td><?=$row_item->picking_order?></td>
						<td><?=$row_item->reorder_quantity?></td>
						<td><?=$row_item->quantity_on_back_order?></td>
						
					</tr>
				
				<?php } ?>
   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>

	<?php } ?>