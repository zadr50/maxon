<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier=$CI->input->post("text1");
	
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>DAFTAR MEMO CREDIT/DEBIT</h2></td>     	
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
	     			<tr><td>Tanggal</td><td>Nomor</td><td>Kode </td><td>Nama Supplier</td>
	     				<td>Nomor Faktur</td><td>Jumlah</td><td>Keterangan</td><td>Type</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select i.tanggal,i.kodecrdb,inv.supplier_number,
     			 c.supplier_name,i.docnumber,i.amount,i.keterangan,i.amount,i.transtype
     			 from crdb_memo i 
				 left join purchase_order inv on inv.purchase_order_number=i.docnumber
				 left join suppliers c on c.supplier_number=inv.supplier_number
	            where i.transtype in ('PO-CREDIT MEMO','PO-DEBIT MEMO') 
	            and i.tanggal between '$date1' and '$date2'  ";
				if($supplier!="")$sql.=" and inv.supplier_number='$supplier' ";
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->tanggal."</td>";
                    $tbl.="<td>".$row->kodecrdb."</td>";
                    $tbl.="<td>".($row->customer_customer)."</td>";
                    $tbl.="<td>".$row->company."</td>";
                    $tbl.="<td>".$row->docnumber."</td>";
                    $tbl.="<td>".$row->amount."</td>";
                    $tbl.="<td>".$row->keterangan."</td>";
                    $tbl.="<td>".$row->transtype."</td>";
                    $tbl.="</tr>";
               };
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
