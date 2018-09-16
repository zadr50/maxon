<?php
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){

    $data['caption']='LAPORAN AKUMULASI STOCK TOKO';
	$data['date_from']=date('Y-m-d 00:00:00');
	$data['date_to']=date('Y-m-d 23:59:59');
	$data['select_date']=false;

    $data['criteria1']=true;
    $data['label1']='Tahun';
    $data['text1']=date("Y");

    $data['criteria2']=true;
    $data['label2']='Bulan';
    $data['text2']=date('m');

     
	$data['criteria3']=true;
	$data['label3']='Sistim';
	$data['text3']='3';
    
    $data['criteria4']=true;
    $data['label4']='Supplier';
    $data['text4']='';
    $data['key4']='supplier_number';
    $data['output4']="text4";
    $data['fields4'][]=array("supplier_number","80","Kode");
    $data['fields4'][]=array("supplier_name","180","Supplier");
    $data['ctr4']='lookup/query/suppliers';
    
    $data['criteria5']=true;
    $data['label5']='Outlet';
    $data['text5']=current_gudang();
    $data['key5']='location_number';
    $data['output5']="text5";
    $data['fields5'][]=array("location_number","80","Kode");
    $data['fields5'][]=array("attention_nme","180","Gudang");
    $data['ctr5']='lookup/query/warehouse';
    
	$data['rpt_controller']="inventory/rpt/$id";
	$CI->template->display_form_input('criteria',$data,'');
} else {	
	$CI->load->model('company_model');
	$model=$CI->company_model->get_by_id($CI->access->cid)->row();
	//$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	//$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	
    $tahun = $CI->input->post('text1');
    $bulan = $CI->input->post('text2');
	$sistim = $CI->input->post('text3');
    $supplier = $CI->input->post('text4');
    $outlet = $CI->input->post('text5');
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
        <td colspan='2'><h2><?=$model->company_name?></h2></td>
         
     </tr>
     <tr>
     	<td>
     		Criteria: Tahun: <?=$tahun?>, Bulan: <?=$bulan?> Kelompok <?=$category?>
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
     			$sql="select b.*, i.item_number,i.description,i.category,i.supplier_number,
     			i.retail as retail_stock,i.cost_from_mfg,i.margin,i.cost as cost_stock,
     			i.type_of_invoice as sistim
     			from inventory_beg_bal_gudang b left join inventory i on i.item_number=b.item_number
     			 where year(b.tanggal)='$tahun' and month(b.tanggal)='$bulan' ";
                    
                if($sistim!="")$sql.=" and i.type_of_invoice='$sistim'";    
                if($supplier!="")$sql.=" and i.supplier_number='$supplier'";
                if($outlet!="")$sql.=" and b.gudang='$outlet'";

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
                    $cost=$row->cost;
                    if($cost==0)$cost=$row->cost_stock;
                    if($cost==0)$cost=$row->cost_from_mfg;
                    $margin_prc=$row->margin;
                    $sld_qty=$row->qty_awal;
                    $beli=$row->qty_recv_po;
                    $rm=$row->qty_roling_masuk;
                    $ret=$row->qty_retur_beli;  
                    $jual_qty=$row->qty_jual;   
                    $stock=$row->qty_adjust; 
                    $rk=$row->qty_roling_keluar; 
                    
                    $d2 = time();
                    $mins = ($d1 - $d2) / 60;
                    //echo ", duration: $mins minutes";
                    
                    $jsaw_qty=$sld_qty; //+$stock+$rm-$ret+$rk;
                    $jsak_qty=$jsaw_qty-$jual_qty;
                    
                    $jual_amt=$jual_qty*$cost;
                    $jsaw_amt=$jsaw_qty*$cost;
                    $jsak_qty=$jsaw_qty+$beli+$jual_qty+$rm+$stock;
                    $jsak_amt=$jsak_qty*$cost;
                    
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
					$tbl.="<td align='right'>".number_format($cost)."</td>";
					$tbl.="<td align='right'>".number_format($sld_qty)."</td>";
					$tbl.="<td align='right'>".number_format($stock)."</td>";
					$tbl.="<td align='right'>".number_format($beli)."</td>";
					$tbl.="<td align='right'>".number_format($rm)."</td>";
					$tbl.="<td align='right'>".number_format($ret)."</td>";
                    $tbl.="<td align='right'>".number_format($rk)."</td>";
                    $tbl.="<td align='right'>".number_format($jsaw_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jsaw_amt)."</td>";
                    $tbl.="<td align='right'>".number_format(-1*$jual_qty)."</td>";
                    $tbl.="<td align='right'>".number_format(-1*$jual_amt)."</td>";
                    $tbl.="<td align='right'>".number_format($jsak_qty)."</td>";
                    $tbl.="<td align='right'>".number_format($jsak_amt)."</td>";
                    $tbl.="<td align='right'>".($row->sistim)."</td>";
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
                <td align=right>".number_format(-1*$jual_qty_ttl)."</td>
                <td align=right>".number_format(-1*$jual_amt_ttl)."</td>
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