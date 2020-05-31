<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$supplier= $CI->input->post('text1');
	$sistim_filter=$CI->input->post("text2");
	
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
 				<td>Jumlah</td><td>Saldo</td><td>Ref1</td><td>Nama</td>
 				<td>Sistim</td>
 			</tr>
 		</thead>
 		<tbody>
     	<?php
     	$sql="select q.*,s.supplier_name from qry_kartu_hutang q 
     	left join suppliers s on s.supplier_number=q.Supplier_Number 
     	where 1=1";
		if($supplier!=""){
			$sql.=" and q.supplier_number='$supplier'";
		}
		$sql.=" order by q.tanggal";
        $qcard=$CI->db->query($sql);
		$tbl="";
		$saldo=0;
		foreach($qcard->result() as $rcard){
			$sistim="";
			if($q=$this->db->query("select type_of_invoice from purchase_order where purchase_order_number='$rcard->NoBukti'")){
				if($r=$q->row()){
					$sistim=$r->type_of_invoice;
				}
			}
			$nobukti=$rcard->NoBukti;
			if($nobukti==""){
				$nobukti=$rcard->ref2;
			}
			if($rcard->Jenis=="Bayar"){
				$nobukti=$rcard->Ref1;
				if($nobukti!=""){
					if($q=$this->db->query("select p.purchase_order_number,po.type_of_invoice,pp.no_bukti 
						from payables_payments pp 
						join payables p on p.bill_id=pp.bill_id 
						left join purchase_order po on po.purchase_order_number=p.purchase_order_number
						where pp.bill_id='$nobukti' 
						")){
						if($r=$q->row()){
							$nobukti=$r->purchase_order_number."->".$r->no_bukti;
							$sistim=$r->type_of_invoice;
						}
					}
				}
			}
			if($rcard->Jenis=="Debit Memo" || $rcard->Jenis=="Credit Memo"){
				if($q=$this->db->query("select d.docnumber,p.type_of_invoice  
				from crdb_memo d left join purchase_order p on p.purchase_order_number=d.docnumber
				where kodecrdb='$nobukti'")){
					if($r=$q->row()){
						$nobukti=$r->docnumber."->".$nobukti;
						$sistim=$r->type_of_invoice;
					}
					
				}
			}
			if($rcard->Jenis=="Retur"){
				if($q=$this->db->query("select po_ref from purchase_order 
					where purchase_order_number='$nobukti' ")){
						if($r=$q->row()){
							$nobukti=$r->po_ref."->".$nobukti;
						}
					}
			}
			$ok=true;
			if($sistim_filter!=""){
				if($sistim_filter!=$sistim)$ok=false;
			}
			if($ok){
				$saldo+=$rcard->amount;
	            $tbl.="<tr>";
	            $tbl.="<td>".$rcard->Tanggal."</td>";
	            $tbl.="<td>$nobukti</td>";
	            $tbl.="<td>".$rcard->Jenis."</td>";
	            $tbl.="<td align='right'>".number_format($rcard->amount)."</td>";
	            $tbl.="<td align='right'>".number_format($saldo)."</td>";
	            $tbl.="<td>".$rcard->Supplier_Number."</td>";
	            $tbl.="<td>".$rcard->supplier_name."</td>";
				$tbl.="<td>$sistim</td>";
	            $tbl.="</tr>";
			}
		}
  	    
  	    echo $tbl;
		?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>



