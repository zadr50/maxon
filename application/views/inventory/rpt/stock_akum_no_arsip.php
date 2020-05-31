<?php
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){

    $data['caption']='LAPORAN AKUMULASI STOCK TOKO';
	$data['date_from']=date('Y-m-d 00:00:00');
	$data['date_to']=date('Y-m-d 23:59:59');
	$data['select_date']=true;
     
	$data['criteria1']=true;
	$data['label1']='Sistim';
	$data['text1']='3';
    
    $data['criteria2']=true;
    $data['label2']='Supplier';
    $data['text2']='';
    $data['key2']='supplier_number';
    $data['output2']="text2";
    $data['fields2'][]=array("supplier_number","80","Kode");
    $data['fields2'][]=array("supplier_name","180","Supplier");
    $data['ctr2']='lookup/query/suppliers';
    
    $data['criteria3']=true;
    $data['label3']='Outlet';
    $data['text3']='';
    $data['key3']='location_number';
    $data['output3']="text3";
    $data['fields3'][]=array("location_number","80","Kode");
    $data['fields3'][]=array("attention_nme","180","Gudang");
    $data['ctr3']='lookup/query/warehouse';

	$data['criteria4']=true;
	$data['label4']='Item No';
	$data['text4']='';
    
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
} else {	
	$CI->load->model('company_model');
	$model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$sistim = $CI->input->post('text1');
    $supplier = $CI->input->post('text2');
    $outlet = $CI->input->post('text3');
	$item_no=$CI->input->post("text4");
	
    $category="";
    
     $outlet_name="";
     if($outlet!=""){         
         if($q=$CI->db->where("location_number",$outlet)->get("shipping_locations")){
             if($r=$q->row()){
                 $outlet_name=$r->attention_name;
             }
         }
     }
     if(($sistim=="" || $supplier == "" ) && $item_no=="" ){
     	echo "Pilih kriteria sistim, supplier atau outlet untuk mempercepat laporan.";
     	exit;
     }
	 
	 $supplier_name="";
	 $supplier_alamat="";
	 $supplier_city="";
	 $supplier_phone="";
	 
	 if($q=$this->db->query("select * from suppliers where supplier_number='$supplier' ")){
	 	if($r=$q->row()){
	 		$supplier_name=$r->supplier_name;
	 		$supplier_alamat=$r->street." - ".$r->suite;
	 		$supplier_city=$r->city;
	 		$supplier_phone=$r->phone;
	 		
	 	}
	 }
	 
?>

<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">

<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2>LAPORAN AKUMULASI STOCK TOKO</h2></td>     	
     </tr>
     <tr>
     	<td colspan='2'><h2>Outlet: <?=$outlet_name." - ".$outlet?></h2></td>
     </tr>
     <tr>
     	<td></td>
     </tr>
     <tr>
     	<td coslpan='2'><h2>Supplier: <?=$supplier_name." - ".$supplier?></h2></td>
     </tr>
     <tr>
     	<td coslpan='2'><?=$supplier_alamat?></td>
     </tr>
     <tr>
     	<td coslpan='2'><?=$supplier_city?></td>
     </tr>
     <tr>
     	<td coslpan='2'><?=$supplier_phone?></td>
     </tr>
     
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Kelompok <?=$category?>,
            Sistim: <?=$sistim?>, Outlet: <?=$outlet.'-'.$outlet_name?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td></td><td></td>
 				<td></td><td></td><td></td>
				<td></td><td></td><td></td><td></td>
				<td colspan=2 align='center'>JML SLD Awal</td>
				<td colspan=2 align='center'>JUAL</td>
				<td colspan=2 align='center'>JML Saldo Akhir </td>
 			</tr>
 			<tr>
 			    <td>Kode Barang</td><td>Nama Barang</td> 
 			    <td>Hrg Jual</td> 
                <td>Mgn%</td><td>Hrg Beli</td><td>SLD</td>
                <td>BELI</td><td>RET</td><td>Adj</td>
                <td>JML</td><td>HRG Beli</td>
                <td>JML</td><td>HRG Beli</td>
                <td>JML</td><td>HRG Beli</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?php
     			
					
					/*
					 * 
	     		left join (
	     			select pi.item_number,sum(pi.quantity) as qty_po 
	     			from purchase_order p left join purchase_order_lineitems pi  
	     				on pi.purchase_order_number=p.purchase_order_number  
	     			join inventory i on i.item_number=pi.item_number
	     			where p.potype='I' and p.po_date between '$date1' and '$date2' ";
					if($supplier!=""){
						$sql.=" and i.supplier_number='$supplier' ";
					}
					if($outlet!=""){
						$sql.=" and pi.warehouse_code='$outlet' ";
					}
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
										$sql.="					
	     			group by pi.item_number
	     			) qpo on qpo.item_number=i.item_number	
					 * 					 * 					 * 
					 * 
					 * 
					 * 					 * 
					 */
     			     			
     			$sql="select i.item_number,i.kode_lama,i.description,i.category,i.type_of_invoice,i.supplier_number,
     			i.retail,i.cost_from_mfg,i.margin,qawal.qty_awal,qty_stock,
     			qpo.qty_po,qjual.qty_jual,qretbeli.qty_ret_beli,
     			qretbeli_supp.qty_ret_beli_supp, qadj.adj_min,qadjp.adj_plus
     			
     			from inventory i 
     			
	     		left join (select q.item_number,sum(q.qty_masuk)-sum(q.qty_keluar) as qty_awal 
	     			from qry_kartustock_union q
	     			join inventory i on i.item_number=q.item_number
	     			where q.tanggal<'$date1'";
					if($supplier!=""){
						$sql.=" and i.supplier_number='$supplier'";	
					}
					if($outlet!=""){
						$sql.=" and q.gudang='$outlet' ";
					}
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
					$sql.="	group by item_number) qawal on qawal.item_number=i.item_number	
					
				left join (
					select im.item_number,sum(im.to_qty) as qty_stock
					from inventory_moving im 
					join inventory i on i.item_number=im.item_number
					where im.from_location=im.to_location 
					and im.date_trans between '$date1' and '$date2' 
					and im.doc_type='1' ";
					if($supplier!="")$sql.=" and i.supplier_number='$supplier' ";
					if($outlet!="")$sql.=" and im.from_location='$outlet' ";
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
										
					$sql.=" group by im.item_number ) qstock on qstock.item_number=i.item_number	
					
				left join (
					select ip.item_number,sum(ip.quantity_received) as qty_po
					from inventory_products ip 
					join inventory i on i.item_number=ip.item_number
					where ip.receipt_type='PO'
						and ip.date_received between '$date1' and '$date2' ";
					if($supplier!=""){
						$sql.=" and i.supplier_number='$supplier' ";
					}
					if($outlet!=""){
						$sql.=" and ip.warehouse_code='$outlet' ";
					}
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
					$sql.=" group by ip.item_number
				) qpo on qpo.item_number=i.item_number						

				left join (
					select ip.item_number,sum(ip.quantity_received) as qty_ret_beli
					from inventory_products ip 
					join inventory i on i.item_number=ip.item_number
					where (ip.receipt_type='ETC_OUT' and ip.doc_type='2') 
						and ip.date_received between '$date1' and '$date2' ";
					if($supplier!=""){
						$sql.=" and i.supplier_number='$supplier' ";
					}
					if($outlet!=""){
						$sql.=" and ip.warehouse_code='$outlet' ";
					}
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
					$sql.=" group by ip.item_number
				) qretbeli on qretbeli.item_number=i.item_number						
				
	     		left join (
	     			select pi.item_number,sum(pi.quantity) as qty_ret_beli_supp 
	     			from purchase_order p left join purchase_order_lineitems pi  
	     				on pi.purchase_order_number=p.purchase_order_number  
	     			join inventory i on i.item_number=pi.item_number
	     			where p.potype='R' and p.po_date between '$date1' and '$date2' ";
					if($supplier!=""){
						$sql.=" and i.supplier_number='$supplier' ";
					}
					if($outlet!=""){
						$sql.=" and p.branch_code='$outlet' ";
					}
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
										
					$sql.="					
	     			group by pi.item_number
	     			) qretbeli_supp on qretbeli_supp.item_number=i.item_number	
	     			
	     		left join (
			       select il.item_number,sum(il.quantity) as qty_jual 
			       from invoice_lineitems il
			       join invoice inv on inv.invoice_number=il.invoice_number
			       join inventory i on i.item_number=il.item_number
			       where inv.invoice_type='I' and inv.invoice_date between '$date1' and '$date2' ";
			       if($supplier!=""){
			       		$sql.=" and i.supplier_number='$supplier' ";			
			       }
					if($outlet!=""){
						$sql.=" and il.warehouse_code='$outlet' ";
					}
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
								       			       	
			       $sql.=" group by il.item_number  
	     			) qjual on qjual.item_number=i.item_number
	     			
				left join (
					select im.item_number,sum(im.to_qty) as adj_min
					from inventory_moving im 
					join inventory i on i.item_number=im.item_number
					where im.from_location=im.to_location 
					and im.date_trans between '$date1' and '$date2' 
					and im.to_qty<0 and im.doc_type<>'1' ";
					if($supplier!="")$sql.=" and i.supplier_number='$supplier' ";
					if($outlet!="")$sql.=" and im.from_location='$outlet' ";
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
										
					$sql.=" group by im.item_number ) qadj on qadj.item_number=i.item_number	
					
				left join (
					select im.item_number,sum(im.to_qty) as adj_plus
					from inventory_moving im 
					join inventory i on i.item_number=im.item_number
					where im.from_location=im.to_location 
					and im.date_trans between '$date1' and '$date2' 
					and im.to_qty>0  and im.doc_type<>'1' ";
					if($supplier!="")$sql.=" and i.supplier_number='$supplier' ";
					if($outlet!="")$sql.=" and im.from_location='$outlet' ";
					if($sistim!=""){
						$sql.=" and i.type_of_invoice='$sistim' ";
					}
										
					$sql.=" group by im.item_number ) qadjp on qadjp.item_number=i.item_number	
					
					
	     		";
                $sql.=" where 1=1 ";    
                if($sistim!="")$sql.=" and i.type_of_invoice='$sistim'";    
                if($supplier!="")$sql.=" and i.supplier_number='$supplier'";
                if($item_no!="")$sql.=" and i.item_number='$item_no' ";

                $sql.="order by i.item_number";
               // $sql.=" limit 10";
               // -- doc_type=2 retur_toko
                               
              ///echo $sql; exit;
                                
				$rst_item=$CI->db->query($sql);
     			$tbl="";	
                $sld_qty_ttl=0;         $beli_ttl=0;
                $rm_ttl=0;             $ret_ttl=0;
                $jual_qty_ttl=0;        $stock_ttl=0;
                $rk_ttl=0;              $jsaw_qty_ttl=0;
                $jsak_qty_ttl=0;        $jsaw_amt_ttl=0;
                $jsak_amt_ttl=0;        $jual_amt_ttl=0;
                $adj=0;					$adj_ttl=0;
                $adj_min=0;				$adj_min_ttl=0;
                $adj_plus=0;			$adj_plus_ttl=0;
				$adj_min_amt=0;			$adj_min_amt_ttl=0;
				$tgh_qty=0;				$tgh_qty_ttl=0;
				$tgh_amt=0;				$tgh_amt_ttl=0;
				
				foreach($rst_item->result() as $row){
				    //echo "<br>Calculate: $row->item_number - $row->description";
	                $print_this_row=true;
                    $d1 = time();
                    $margin_prc=$row->margin*100;
//					if($margin_prc=1-$margin_prc;
					//if($margin_prc<1)$margin_prc=round($margin_prc*100,2);
					
                    $sld_qty=$row->qty_awal;	//$CI->inventory_model->qty_awal($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $beli=$row->qty_po;	///$CI->inventory_model->qty_po($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $rm=0;	//$CI->inventory_model->qty_rolling_masuk($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $ret=$row->qty_ret_beli;	//$CI->inventory_model->qty_retur_toko($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    
                    $ret=$row->qty_ret_beli_supp;	//yg dipakai retur ke supplier
                    
                    $jual_qty=$row->qty_jual;	//$CI->inventory_model->qty_jual($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $stock=$row->qty_stock;	//$CI->inventory_model->qty_adjust($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $rk=$CI->inventory_model->qty_rolling_keluar($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $adj_min=-1*$row->adj_min;
					$adj_min_amt=$adj_min*$row->cost_from_mfg;
					
					$adj_plus=$row->adj_plus;
					
					$adj=$adj_plus-$adj_min;
					
                    $d2 = time();
                    $mins = ($d1 - $d2) / 60;
                    //echo ", duration: $mins minutes";
					 
					 
                    
                                        
                    $jsaw_qty=$sld_qty+$stock-$ret+$beli+$adj; //+$stock+$rm-$ret+$rk;
                    $jsak_qty=$jsaw_qty-$jual_qty;
                    
					
					if ($sld_qty==0 && $beli==0 && $ret==0 && $adj==0 && $jsaw_qty==0 
					   && $jual_qty==0 && $jsak_qty==0){
		                $print_this_row=false;						
					}
                    //$print_this_row=true;
                    
                    $jual_amt=($jual_qty+$adj_min-$adj_plus)*$row->cost_from_mfg;
                    $jsaw_amt=$jsaw_qty*$row->cost_from_mfg;
					
                    $jsak_qty=$jsaw_qty-$jual_qty;
                    $jsak_amt=$jsak_qty*$row->cost_from_mfg;
					
					//barang hilang masuk ke jual??
					$jual_qty+=$adj_min-$adj_plus;
                    if($jual_qty!=0){
                       //echo $adj;
                    }

                    
                    $sld_qty_ttl+=$sld_qty;
                    $beli_ttl+=$beli;
                    $rm_ttl+=$rm;
                    $ret_ttl+=$ret;
                    $jual_qty_ttl+=$jual_qty;
                    $stock_ttl+=$stock;
                    $rk_ttl+=$rk;
					$adj_min_ttl+=$adj_min;
					$adj_min_amt_ttl+=$adj_min_amt;
					
					$adj_plus_ttl+=$adj_plus;
					$adj_ttl+=$adj;
					
                    $jsaw_qty_ttl+=$jsaw_qty;
                    $jsaw_amt_ttl+=$jsaw_amt;
					
                    $jsak_qty_ttl+=$jsak_qty;
                    $jsak_amt_ttl+=$jsak_amt;
					
                    $jual_amt_ttl+=$jual_amt;
                    
					$tgh_qty=($adj_min)+$jual_qty;
                    $tgh_amt=$tgh_qty*$row->cost_from_mfg;
					
					$tgh_qty_ttl+=$tgh_qty;
					$tgh_amt_ttl+=$tgh_amt;

                    
					
					$tbl="<tr>";
					$tbl.="<td>".$row->item_number."</br>$row->kode_lama</td>";
					$tbl.="<td>".$row->description."</td>";
//					$tbl.="<td>".($row->category)."</td>";
//					$tbl.="<td>".($row->type_of_invoice)."</td>";
 //                   $tbl.="<td>".($row->supplier_number)."</td>";
					$tbl.="<td align='right'>".number_format($row->retail)."</td>";
					$tbl.="<td align='right'>".number_format($margin_prc,2)."</td>";
					$tbl.="<td align='right'>".number_format($row->cost_from_mfg)."</td>";
					$tbl.="<td align='right'>".number_format($sld_qty)."</td>";
//					$tbl.="<td align='right'>".number_format($stock)."</td>";
					$tbl.="<td align='right'>".number_format($beli)."</td>";
//					$tbl.="<td align='right'>".number_format($rm)."</td>";
					$tbl.="<td align='right'>".number_format($ret)."</td>";
					$tbl.="<td align='right'>".number_format($adj)."</td>";
//					$tbl.="<td align='right'>".number_format($adj_min_amt)."</td>";
//					$tbl.="<td align='right'>".number_format($adj_plus)."</td>";
					//                    $tbl.="<td align='right'>".number_format($rk)."</td>";
                    $tbl.="<td align='right'>".number_format($jsaw_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jsaw_amt)."</td>";
                    $tbl.="<td align='right'>".number_format($jual_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jual_amt)."</td>";
                    $tbl.="<td align='right'>".number_format($jsak_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jsak_amt)."</td>";
					$tbl.="</tr>";
                    
					if ($print_this_row ){
						echo $tbl;
						
					}
                    
				}
            $tbl="
            <tr><td><strong>TOTAL</strong></td><td></td>
                <td></td><td></td><td></td>";
                $tbl.="<td align=right><b>".number_format($sld_qty_ttl)."</b></td>";
                $tbl.="<td align=right><b>".number_format($beli_ttl)."<b></td>";
                $tbl.="<td align=right><b>".number_format($ret_ttl)."<b></td>";
                $tbl.="<td align=right><b>".number_format($adj_ttl)."<b></td>";
                $tbl.=" <td align=right><b>".number_format($jsaw_qty_ttl)."<b></td>";
                $tbl.="<td align=right><b>".number_format($jsaw_amt_ttl)."<b></td>";
                $tbl.="<td align=right><b>".number_format($jual_qty_ttl)."<b></td>";
                $tbl.="<td align=right><b>".number_format($jual_amt_ttl)."<b></td>";
	            $tbl.="<td align=right><b>".number_format($jsak_qty_ttl)."<b></td>";
                $tbl.="<td align=right><b>".number_format($jsak_amt_ttl)."<b></td>";
            $tbl.="</tr>";

 			    echo $tbl;
				 
				 
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
	<?php } ?>