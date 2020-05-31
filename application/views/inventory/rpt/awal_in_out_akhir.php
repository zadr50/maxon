<?php
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){
		
	$data['date_from']=date('Y-m-d 00:00:00');
	$data['date_to']=date('Y-m-d 23:59:59');
	$data['select_date']=true;
	 
	$data['criteria1']=true;
	$data['label1']='Kelompok Barang';
	$data['text1']='';
    $data['key1']="kode";
    $data['fields1'][]=array("kode","80","Kode");
    $data['fields1'][]=array("category","180","Kelompok");
    $data['ctr1']='category/select';
	
	$data['criteria2']=true;
	$data['label2']='Gudang';
	$data['text2']='';
    $data['key2']="location_number";
    $data['fields2'][]=array("location_number","80","Gudang");
    $data['ctr2']='gudang/select';
	
	$data['caption']='STOCK SUMMARY (AWAL,IN,OUT,AKHIR)';
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
	
} else {	
	$CI->load->model('company_model');
	$model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$kel=$CI->input->post("text1");
	$gudang=$CI->input->post("text2");
	$kode=$CI->input->post("text3");
	if($kel==""){
		//msgbox("Pilih category barang !");
		//exit;
	}
	$kelompok="";
	if($qkel=$CI->db->query("select category from inventory_categories where kode='$kel'")){
		if($r=$qkel->row()){
			$kelompok=$r->category;
		}
	}
	$sql_gudang="";
	if($gudang=$CI->input->post("text2")){
		$sql_gudang=" and gudang='$gudang' ";
	}
	$title="STOCK SUMMARY (AWAL,IN,OUT,AKHIR)";
	
?>
<head><title><?=$title?></title></head>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td><h2><?=$title?></h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     		Kelompok: <?=$kel."-".$kelompok?>, Outlet: <?=$gudang?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr>
 				<td rowspan="2">Kode Barang</td><td rowspan="2">Nama Barang</td><td rowspan="2">Unit</td>
 				<td colspan="4" align='center'>Quantity</td>
 				<td colspan="4" align='center'>Amount</td>
 				<td rowspan="2">M Qty</td> 
 				
 			</tr>
 			<tr>
 				<td align='right'>Awal</td><td align='right'>Masuk</td><td align='right'>Keluar</td><td align='right'>Akhir</td>
 				<td align='right'>Awal</td><td align='right'>Masuk</td><td align='right'>Keluar</td><td align='right'>Akhir</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?php
     			$sql="select i.item_number, i.description, i.category,qa.qty_awal,qa.amount_awal, 
     			q.qty_in,qty_out,q.amt_in,q.amt_out,i.unit_of_measure,
				(coalesce(qa.m_qty_awal,0)+coalesce(q.m_qty,0)) as m_qty,
				(coalesce(qa.m_amt_awal,0)+coalesce(q.m_amt,0)) as m_amt 		
				from inventory i 
				left join (select k.item_number,sum(k.qty_masuk)-sum(k.qty_keluar) as qty_awal,
		 		        sum(k.amount_masuk)-sum(k.amount_keluar) as amount_awal,
		 		        sum(k.mu_qty) as m_qty_awal,sum(k.mu_qty*k.mu_harga) as m_amt_awal   
		                from qry_kartustock_union k
		                where  k.tanggal<'$date1' $sql_gudang
						group by k.item_number) qa on qa.item_number=i.item_number
						
				left join (select k.item_number, sum(k.qty_masuk) as qty_in, 
						sum(k.qty_keluar) as qty_out,
		 		        sum(k.amount_masuk) as amt_in,sum(k.amount_keluar) as amt_out,		 		        
		 		        sum(k.mu_qty) as m_qty,sum(k.mu_qty*k.mu_harga) as m_amt		 		           
		                from qry_kartustock_union k
		                where  k.tanggal between '$date1' and '$date2' $sql_gudang
		                group by k.item_number) q on q.item_number=i.item_number
            	
		                		                
				where 1=1";
				if($kel!="")$sql.=" and i.category='$kel'";
				$sql.=" order by i.item_number";
				
				
				$rst_item=$CI->db->query($sql);
				
			 
				
				$amt_awal_tot=0;
				$amt_in_tot=0;
				$amt_out_tot=0;
				$amt_akhir_tot=0;
				foreach($rst_item->result() as $row){
	     			$tbl="";
					$qty_awal=0;				$qty_in=0;
					$qty_out=0;					$qty_akhir=0;
					$amt_awal=0;				$amt_in=0;
					$amt_out=0;					$amt_akhir=0;	

                 	$qty_awal=$row->qty_awal;
					$amt_awal=$row->amount_awal;
		            
                 	$qty_in=$row->qty_in;
                 	$qty_out=$row->qty_out;
					$amt_in=$row->amt_in;
					$amt_out=$row->amt_out;
							
	                 	$qty_akhir=$qty_awal+$qty_in-$qty_out;
					    $amt_akhir=$amt_awal+$amt_in-$amt_out;
					    
					   if($qty_akhir!=0){
		                    $tbl="<tr>";
		                    $tbl.="<td>".$row->item_number."</td>";
		                    $tbl.="<td>".$row->description."</td>";
		                    $tbl.="<td>$row->unit_of_measure</td>";
		                    $tbl.="<td align='right'>".number_format($qty_awal,2)."</td>";
		                    $tbl.="<td align='right'>".number_format($qty_in,2)."</td>";
		                    $tbl.="<td align='right'>".number_format($qty_out,2)."</td>";
		                    $tbl.="<td align='right'>".number_format($qty_akhir,2)."</td>";
		                    $tbl.="<td align='right'>".number_format($amt_awal)."</td>";
		                    $tbl.="<td align='right'>".number_format($amt_in)."</td>";
		                    $tbl.="<td align='right'>".number_format($amt_out)."</td>";
		                    $tbl.="<td align='right'>".number_format($amt_akhir)."</td>";
							$tbl.="<td>".number_format($row->m_qty)."</td>";
							
		                    $tbl.="</tr>";
							echo $tbl;
						}
			 		$amt_awal_tot+=$amt_awal;
					$amt_in_tot+=$amt_in;
					$amt_out_tot+=$amt_out;
					$amt_akhir_tot+=$amt_akhir;
				}	// rst_item
				
                $tbl="<tr>";
                $tbl.="<td colspan='7'><b>TOTAL</b></td>";
                $tbl.="<td align='right'><b>".number_format($amt_awal_tot)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($amt_in_tot)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($amt_out_tot)."</b></td>";
                $tbl.="<td align='right'><b>".number_format($amt_akhir_tot)."</b></td>";
                $tbl.="<td></td><td></td></tr>";
				echo $tbl;
					
    			?>
   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
	<?php } ?>