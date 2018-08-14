<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $CI->load->model("shipping_locations_model");
     $CI->load->model("invoice_model");
     
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $outlet=$CI->input->post('text1');    
	$kode_kelompok_barang=$CI->input->post('text2');
    $outlet_name=$CI->shipping_locations_model->outlet($outlet);
    $sistim=$CI->input->post("text3");
    $outlet_name="";
    $company_name="";
    if($outlet!=""){
        if($qgdg=$CI->shipping_locations_model->get_by_id($outlet)){
            if($gdg=$qgdg->row()){
                $outlet_name=$gdg->attention_name;
                $company_code=$gdg->company_name;
                if($company_code!=""){
                    if($qcom=$CI->db->query("select company_name from preferences 
                        where company_code='$company_code' ")){
                            if($rcom=$qcom->row()){
                                $company_name=$rcom->company_name;
                            }
                        }
                }
                
            }
        }
        if($outlet_name==""){
            $outlet_name=$CI->shipping_locations_model->outlet($outlet);            
        }
    }
    
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>PENJUALAN PER KELOMPOK BARANG</h2></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?="Outlet: $outlet -  $outlet_name"?></td><td></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>, Cat: <?=$kode_kelompok_barang?>
     		,Outlet: <?=$outlet?>, Sistim: <?=$sistim?>, Perusahaan: <?=$company_name?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Kode Kelompok</td><td>Nama Kelompok Barang</td><td align=right>Qty</td><td align=right>Amount</td> 
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select stk.category as kode,cat.category,sum(il.amount) as z_amount,
     			sum(il.quantity) as z_qty
     			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
     			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
     			 left join inventory stk on stk.item_number=il.item_number
     			 left join inventory_categories cat on cat.kode=stk.category
	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'";
                if($outlet!="")$sql.=" and il.warehouse_code='$outlet'  ";
				if($kode_kelompok_barang!="")$sql.=" and stk.category='".$kode_kelompok_barang."'";
                if($sistim!="")$sql.=" and stk.type_of_invoice='$sistim'";
				$sql.=" group by stk.category,cat.category";
				
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td colspan=2><strong>$row->kode - $row->category</strong></td>";
                    $tbl.="<td align='right'></td>";
                    $tbl.="<td align='right'></td>";
                    $tbl.="</tr>";

                    $sql="select il.item_number,il.description,sum(il.amount) as z_amount,
                    sum(il.quantity) as z_qty
                     from invoice i left join customers c on c.customer_number=i.sold_to_customer
                     left join invoice_lineitems il on il.invoice_number=i.invoice_number
                     left join inventory stk on stk.item_number=il.item_number
                     left join inventory_categories cat on cat.kode=stk.category
                    where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'";
                    if($outlet!="")$sql.=" and il.warehouse_code='$outlet'  ";
                    $sql.=" and stk.category='$row->kode'";
                    $sql.=" group by il.item_number,il.description";
                                        
                    $z_qty=0;
                    $z_amt=0;
                    if($qitem=$CI->db->query($sql)){
                    foreach($qitem->result() as $ritem){
                        $tbl.="<tr>";
                        $tbl.="<td>$ritem->item_number</td>";
                        $tbl.="<td>$ritem->description</td>";
                        $tbl.="<td align='right'>".number_format($ritem->z_qty)."</td>";
                        $tbl.="<td align='right'>".number_format($ritem->z_amount)."</td>";
                        $tbl.="</tr>";
                        $z_qty+=$ritem->z_qty;
                        $z_amt+=$ritem->z_amount;
                    }    
                    }
                    
                    $tbl.="<tr>";
                    $tbl.="<td colspan=2><strong>Sub Total: $row->kode - $row->category</strong></td>";
                    $tbl.="<td align='right'><strong>".number_format($z_qty)."</strong></td>";
                    $tbl.="<td align='right'><strong>".number_format($z_amt)."</strong></td>";
                    $tbl.="</tr>";
                                        
               };
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
