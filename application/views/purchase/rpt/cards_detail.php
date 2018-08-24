	
<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>KARTU HUTANG DETAIL</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Supplier: <?=$supplier?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr>
 				<td>Tanggal</td><td>Nomor Bukti</td><td>Jenis</td>
 				<td>Jumlah</td><td>Saldo</td><td>Ref1</td>
 			</tr>
 		</thead>
 		<tbody>
     	<?
     	$sql="select * from qry_kartu_hutang where 1=1";
		if($supplier!=""){
			$sql.=" and supplier_number='$supplier'";
		}
		$sql.=" order by tanggal";
        $qcard=$CI->db->query($sql);
		$tbl="";
		$saldo=0;
		foreach($qcard->result() as $rcard){
			$saldo+=$rcard->amount;
            $tbl.="<tr>";
            $tbl.="<td>".$rcard->Tanggal."</td>";
            $tbl.="<td>".$rcard->NoBukti."</td>";
            $tbl.="<td>".$rcard->Jenis."</td>";
            $tbl.="<td align='right'>".number_format($rcard->amount)."</td>";
            $tbl.="<td align='right'>".number_format($saldo)."</td>";
            $tbl.="<td>".$rcard->Supplier_Number."</td>";
            $tbl.="</tr>";
		}
  	    
  	    echo $tbl;
		?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>



