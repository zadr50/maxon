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
    $category="";
    
     $outlet_name="";
     if($outlet!=""){         
         if($q=$CI->db->where("location_number",$outlet)->get("shipping_locations")){
             if($r=$q->row()){
                 $outlet_name=$r->attention_name;
             }
         }
     }
    
?>

<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">

<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2>LAPORAN AKUMULASI STOCK TOKO</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Kelompok <?=$category?>
            ,Supplier: <?=$supplier?>, Sistim: <?=$sistim?>, Outlet: <?=$outlet.'-'.$outlet_name?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td></td><td></td><td></td><td></td><td></td> 
 				<td></td><td></td><td></td><td></td>
				<td></td><td></td><td></td><td></td>
				<td colspan=2>JML SLD Awal</td>
				<td colspan=2>JUAL</td>
				<td colspan=2>JML Saldo Akhir </td>
 			</tr>
 			<tr>
 			    <td>Kode Barang</td><td>Nama Barang</td><td>Cat</td><td>Supp</td>
 			    <td>Hrg Jual</td> 
                <td>Disc</td><td>Hrg Beli</td><td>SLD</td><td>STOK</td>
                <td>BELI</td><td>RM</td><td>RET</td><td>RK</td>
                <td>JML</td><td>HRG Beli</td>
                <td>JML</td><td>HRG Beli</td>
                <td>JML</td><td>HRG Beli</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?php
     			$sql="select i.item_number,i.description,i.category,i.supplier_number,
     			i.retail,i.cost_from_mfg,i.margin
     			from inventory i where 1=1 ";
                    
                if($sistim!="")$sql.=" and i.type_of_invoice='$sistim'";    
                if($supplier!="")$sql.=" and i.supplier_number='$supplier'";

                $sql.="order by i.item_number";
               // $sql.=" limit 10";
                                
				$rst_item=$CI->db->query($sql);
     			$tbl="";
                $sld_qty_ttl=0;         $beli_ttl=0;
                $rm_ttl=0;             $ret_ttl=0;
                $jual_qty_ttl=0;        $stock_ttl=0;
                $rk_ttl=0;              $jsaw_qty_ttl=0;
                $jsak_qty_ttl=0;        $jsaw_amt_ttl=0;
                $jsak_amt_ttl=0;        $jual_amt_ttl=0;
                
				foreach($rst_item->result() as $row){
				    //echo "<br>Calculate: $row->item_number - $row->description";
                    $d1 = time();
                    $margin_prc=$row->margin;
                    $sld_qty=$CI->inventory_model->qty_awal($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $beli=$CI->inventory_model->qty_po($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $rm=$CI->inventory_model->qty_rolling_masuk($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $ret=$CI->inventory_model->qty_retur_toko($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $jual_qty=$CI->inventory_model->qty_jual($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $stock=$CI->inventory_model->qty_adjust($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $rk=$CI->inventory_model->qty_rolling_keluar($row->item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    
                    $d2 = time();
                    $mins = ($d1 - $d2) / 60;
                    //echo ", duration: $mins minutes";
                    
                    $jsaw_qty=$sld_qty; //+$stock+$rm-$ret+$rk;
                    $jsak_qty=$jsaw_qty-$jual_qty;
                    
                    $jual_amt=$jual_qty*$row->cost_from_mfg;
                    $jsaw_amt=$jsaw_qty*$row->cost_from_mfg;
                    $jsak_qty=$jsaw_qty-$jual_qty;
                    $jsak_amt=$jsak_qty*$row->cost_from_mfg;
                    
                    $sld_qty_ttl+=$sld_qty;
                    $beli_ttl+=$beli;
                    $rm_ttl+=$rm;
                    $ret_ttl+=$ret;
                    $jual_qty_ttl+=$jual_qty;
                    $stock_ttl+=$stock;
                    $rk_ttl+=$rk;
                    $jsaw_qty_ttl+=$jsaw_qty;
                    $jsaw_amt_ttl+=$jsaw_amt;
                    $jsak_qty_ttl+=$jsak_qty;
                    $jsak_amt_ttl+=$jsak_amt;
                    $jual_amt_ttl+=$jual_amt;
                    
                    
					$tbl="<tr>";
					$tbl.="<td>".$row->item_number."</td>";
					$tbl.="<td>".$row->description."</td>";
					$tbl.="<td>".($row->category)."</td>";
                    $tbl.="<td>".($row->supplier_number)."</td>";
					$tbl.="<td align='right'>".number_format($row->retail)."</td>";
					$tbl.="<td align='right'>".number_format($margin_prc,4)."</td>";
					$tbl.="<td align='right'>".number_format($row->cost_from_mfg)."</td>";
					$tbl.="<td align='right'>".number_format($sld_qty)."</td>";
					$tbl.="<td align='right'>".number_format($stock)."</td>";
					$tbl.="<td align='right'>".number_format($beli)."</td>";
					$tbl.="<td align='right'>".number_format($rm)."</td>";
					$tbl.="<td align='right'>".number_format($ret)."</td>";
                    $tbl.="<td align='right'>".number_format($rk)."</td>";
                    $tbl.="<td align='right'>".number_format($jsaw_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jsaw_amt)."</td>";
                    $tbl.="<td align='right'>".number_format($jual_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jual_amt)."</td>";
                    $tbl.="<td align='right'>".number_format($jsak_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jsak_amt)."</td>";
					$tbl.="</tr>";
                    
                    echo $tbl;
                    
				}
            $tbl="
            <tr><td><strong>TOTAL</strong></td><td></td><td></td><td></td> 
                <td></td><td></td><td></td>
                <td align=right>".number_format($sld_qty_ttl)."</td>
                <td align=right>".number_format($stock_ttl)."</td>
                <td align=right>".number_format($beli_ttl)."</td>
                <td align=right>".number_format($rm_ttl)."</td>
                <td align=right>".number_format($ret_ttl)."</td>
                <td align=right>".number_format($rk_ttl)."</td>
                <td align=right>".number_format($jsaw_qty_ttl)."</td>
                <td align=right>".number_format($jsaw_amt_ttl)."</td>
                <td align=right>".number_format($jual_qty_ttl)."</td>
                <td align=right>".number_format($jual_amt_ttl)."</td>
                <td align=right>".number_format($jsak_qty_ttl)."</td>
                <td align=right>".number_format($jsak_amt_ttl)."</td>
            </tr>";

 			    echo $tbl;
				 
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
	<?php } ?>