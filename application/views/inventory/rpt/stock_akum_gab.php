<?php
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){

    $data['caption']='LAPORAN AKUMULASI STOCK GABUNGAN';
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
    $data['text3']=current_gudang();
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
        <td colspan='2'><h2>LAPORAN AKUMULASI STOCK GABUNGAN</h2></td>      
     </tr>
     <tr>
     	<td colspan='2'><h2>Outlet: <?=$outlet_name." - ".$outlet?></h2></td>
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
            <tr>
                <td>Kode Supplier</td><td>Nama Supplier</td><td>Qty Jual</td>
                <td align=right>Total Beli</td><td align=right>Total Jual</td>
                <td align=right>Margin%</td>
            </tr>
        </thead>
        <tbody>
                <?php
                //
                $sql="select i.supplier_number,s.supplier_name,
                sum(q.qty_masuk)-sum(q.qty_keluar) as z_qty,
                (sum(q.qty_masuk)-sum(q.qty_keluar))*i.cost as z_beli,
                (sum(q.qty_masuk)-sum(q.qty_keluar))*i.retail as z_jual
                from inventory i left join suppliers s on s.supplier_number=i.supplier_number 
                left join qry_kartustock_union  q on q.item_number=i.item_number
                where q.tanggal<='$date2' ";
                
				$sql="select stk.supplier_number,s.supplier_name,il.warehouse_code as gudang,
				sum(il.quantity) as z_qty, 
				sum(il.quantity*stk.cost_from_mfg) as z_beli, 
				sum(il.quantity*stk.retail) as z_jual
				from invoice_lineitems il left join invoice i on i.invoice_number=il.invoice_number 
				left join inventory stk on stk.item_number=il.item_number 
				left join suppliers s on s.supplier_number=stk.supplier_number
				where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2' ";
				    
                if($sistim!="")$sql.=" and stk.type_of_invoice='$sistim'";    
                if($supplier!="")$sql.=" and stk.supplier_number='$supplier'";
                if($outlet!="")$sql.=" and il.warehouse_code='$outlet' ";
                $sql.=" group by stk.supplier_number,s.supplier_name ";
                                
            
                
                $rst_item=$CI->db->query($sql);
                $tbl="";

                $beli_amt_ttl=0;         $jual_amt_ttl=0;
                $qty_akhir_ttl=0;
                $grp_old="";			$grp_new="";
                $qty_akhir_sub=0;		$beli_amt_sub=0;		$jual_amt_sub=0;	$margin_sub=0;
                
                $tbl_row=null;
                
                foreach($rst_item->result() as $row){
                	$grp_old=$grp_new;
                    $item_number="";
                    $qty_akhir=$row->z_qty;
                    $beli_amt=$row->z_beli;
                    $jual_amt=$row->z_jual;
                    
                    //$adj_min_plus=$row->z_qty_adj;//$row->z_adj_min_plus;
                                    
                    $supplier1=$row->supplier_number;
                                    
                    $sql="select sum(im.to_qty) as z_adj_min_plus
                    from inventory_moving im
                    left join inventory i on i.item_number=im.item_number 
                    where im.from_location=im.to_location 
                    and im.date_trans between '$date1' and '$date2' 
                    and im.doc_type<>'1' ";
                    if($supplier!="")$sql.=" and i.supplier_number='$supplier' ";
                    if($outlet!="")$sql.=" and im.from_location='$outlet' ";
                    if($sistim!="")$sql.=" and i.type_of_invoice='$sistim' ";
                    //if($q2=$this->db->query($sql)){
                    //    if($r2=$q2->row()){
                            //echo $sql;
                    //        $adj_min_plus=$r2->z_adj_min_plus;
                            //echo $adj_min_plus;exit;
                    //    }
                    //}
                	
                 
                    
                    
                    $margin=0;
                    if($beli_amt!=0)$margin=(($jual_amt-$beli_amt)/$beli_amt)*100;                    
                        
                    $qty_akhir_ttl+=$qty_akhir;
                    $beli_amt_ttl+=$beli_amt;
                    $jual_amt_ttl+=$jual_amt;
                    

					if($grp_old!=$row->supplier_number){
						$grp_new=$row->supplier_number;
	                    //$tbl.="<tr>";
	                    //$tbl.="<td><b>SUB TOTAL</b></td>";
	                    //$tbl.="<td></td>";
	                    //$tbl.="<td></td>";
	                    //$tbl.="<td align='right'><b>".number_format($qty_akhir_sub)."</b></td>";
	                    //$tbl.="<td align='right'><b>".number_format($beli_amt_sub)."</b></td>";
	                    //$tbl.="<td align='right'><b>".number_format($jual_amt_sub)."</b></td>";
	                    //$tbl.="<td align='right'><b>".number_format($margin_sub)."</b></td>";
                		//$tbl.="<td></td>";
	                    //$tbl.="</tr>";
						$qty_akhir_sub=0;
						$beli_amt_sub=0;
						$jual_amt_sub=0;
						$margin_sub=0;
					}
                    $qty_akhir_sub+=$qty_akhir;
                    $beli_amt_sub+=$beli_amt;
					$jual_amt_sub+=$jual_amt;
					    
					
					$tbl_row[$row->supplier_number]=array("supplier_number"=>$row->supplier_number,
					"supplier_name"=>$row->supplier_name,
					"qty_akhir"=>$qty_akhir,"beli_amt"=>$beli_amt,
					"jual_amt"=>$jual_amt,"margin"=>$margin);
					
					
                }
			//var_dump($tbl_row);
			//tambah baris data dari adjustment
			    $sql="
					select stk2.supplier_number,s.supplier_name,sum(im.to_qty) as qty_adj,
					sum(im.to_qty*stk2.retail) as amt_adj,sum(im.to_qty*stk2.cost) as amt_beli
					from inventory_moving im 
					left join inventory stk2 on stk2.item_number=im.item_number
					left join suppliers s on s.supplier_number=stk2.supplier_number
					where im.from_location=im.to_location 
						and im.doc_type<>'1' and im.date_trans between '$date1' and '$date2' ";
                    if($supplier!="")$sql.=" and stk2.supplier_number='$supplier' ";
                    if($outlet!="")$sql.=" and im.from_location='$outlet' ";
                    if($sistim!="")$sql.=" and stk2.type_of_invoice='$sistim' ";										
					$sql.=" group by stk2.supplier_number,s.supplier_name";
				
				//echo $sql;
				
				if($q=$this->db->query($sql)){
					foreach($q->result() as $row){
						if(isset($tbl_row[$row->supplier_number])){
							$tbl_row[$row->supplier_number]["qty_akhir"]=$row->qty_adj+$tbl_row[$row->supplier_number]["qty_akhir"];
							$tbl_row[$row->supplier_number]["jual_amt"]=$row->amt_adj+$tbl_row[$row->supplier_number]["jual_amt"];
							$tbl_row[$row->supplier_number]["beli_amt"]=$row->amt_beli+$tbl_row[$row->supplier_number]["beli_amt"];
														
						} else {
							$tbl_row[$row->supplier_number]=array("supplier_number"=>$row->supplier_number,
							"supplier_name"=>$row->supplier_name,
							"qty_akhir"=>-1*$row->qty_adj,"beli_amt"=>-1*$row->amt_beli,
							"jual_amt"=>-1*$row->amt_adj,"margin"=>0);
					
					
						}
					}
				}
			//var_dump($tbl_row['0262']);
			foreach ( $tbl_row as $key => $value ) {
					$row=$value;
					if($row['margin']==0){
						$row['margin']=abs(1-$row['beli_amt']/$row['jual_amt']*100);
					}
                    $tbl.="<tr>";
                    $tbl.="<td>".$row['supplier_number']."</td>";
                    $tbl.="<td>".$row['supplier_name']."</td>";
                    $tbl.="<td align='right'>".number_format($row['qty_akhir'])."</td>";
                    $tbl.="<td align='right'>".number_format($row['beli_amt'])."</td>";
                    $tbl.="<td align='right'>".number_format($row['jual_amt'])."</td>";
                    $tbl.="<td align='right'>".number_format($row['margin'],2)."</td>";
                    $tbl.="</tr>";
					
					$qty_akhir_ttl+=$row['qty_akhir'];
					$beli_amt_ttl+=$row['beli_amt'];
					$jual_amt_ttl+=$row['jual_amt'];
			}

            $tbl.="
            <tr><td><strong>TOTAL</strong></td><td></td>
                <td align=right><b>".number_format($qty_akhir_ttl)."</b></td>
                <td align=right><b>".number_format($beli_amt_ttl)."</b></td>
                <td align=right><b>".number_format($jual_amt_ttl)."</b></td>
            </tr>";

                echo $tbl;
                 
                ?>
        

        </tbody>
        </table>
        
        </td>
     </tr>
</table>
    <?php } ?>
    
<script language="JavaScript">
	function click_detail(supplier){
		var CI_ROOT="<?=base_url()?>";
		var date_from="<?=$date1?>";
		var date_to="<?=$date2?>";
		var supplier="<?=$supplier?>";
		var sistim="<?=$sistim?>";
		var url=CI_ROOT+"index.php/sales/rpt/sls_item_supplier?date_from="+date_from + 
			"&date_to="+date_to+"&text1="+supplier+"&sistim="+sistim;
		window.open(url,"_blank");
	}
</script>