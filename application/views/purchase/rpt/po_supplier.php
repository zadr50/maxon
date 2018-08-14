<?
//var_dump($_POST);
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><h2>PURCHASE ORDER SUPPLIERS</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr>
 				<td>Nama Supplier</td><td>Kode</td><td>Nomor Po</td>
 				<td>Tanggal</td><td>Jumlah</td><td>Type</td><td>Recvd</td>
				<td>Termin</td>
 			</tr>
 		</thead>
 		<tbody>
     	<?
     	$sql="select s.supplier_name,p.supplier_number,p.purchase_order_number,
		p.po_date,p.amount,potype,p.received,p.terms
		from purchase_order p 
		left join suppliers s on s.supplier_number=p.supplier_number
		where p.po_date between '$date1' and '$date2' and potype='O'	
		order by s.supplier_name";
        $q=$CI->db->query($sql);
		$tbl="";
		foreach($q->result() as $r){
            $tbl.="<tr>";
            $tbl.="<td>".$r->supplier_name."</td>";
            $tbl.="<td>".$r->supplier_number."</td>";
            $tbl.="<td>".$r->purchase_order_number."</td>";
            $tbl.="<td>".$r->po_date."</td>";
            $tbl.="<td align='right'>".number_format($r->amount)."</td>";
            $tbl.="<td>".$r->potype."</td>";
            $tbl.="<td>".$r->received."</td>";
            $tbl.="<td>".$r->terms."</td>";
            $tbl.="</tr>";
		}
  	    
  	    echo $tbl;
		?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>



