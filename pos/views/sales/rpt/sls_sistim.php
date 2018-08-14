<?
     $CI =& get_instance();
     $CI->load->model('company_model');
    $CI->load->model('sysvar_model');
    $CI->load->model('shipping_locations_model');
    $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $outlet=$CI->input->post("text1");
//    $outlet=current_gudang();
    $outlet_name="";
    if($outlet!="")$outlet_name=$CI->shipping_locations_model->outlet($outlet);
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
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>PENJUALAN PER SISTIM</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> 
     		,Outlet: <?=$outlet?>, Perusahaan: <?=$company_name?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr>
	     				<td>Kode Barang</td><td>Nama Barang</td><td align=right>Qty</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select s.type_of_invoice from invoice i 
     			left join invoice_lineitems il on il.invoice_number=i.invoice_number
     			left join inventory s on s.item_number=il.item_number
     			where i.invoice_type='i' and i.invoice_date between '$date1' and '$date2'  ";
                if($outlet!="")$sql.=" and i.warehouse_code='$outlet' ";
     			$sql.=" group by s.type_of_invoice ";
                
                $tbl="";
                
                if($q=$CI->db->query($sql)){
                foreach($q->result() as $sistim) {
                    $sistim_name=$CI->sysvar_model->lookup_value("po_type",$sistim->type_of_invoice);
                    $tbl.="<tr>";
                    $tbl.="<td colspan=3><strong>$sistim->type_of_invoice - $sistim_name</strong></td>";
                    $tbl.="</tr>";
                    
                    
         			$sql="select il.item_number,il.description,sum(il.quantity) as quantity
         			 from invoice i left join customers c on c.customer_number=i.sold_to_customer
         			 left join invoice_lineitems il on il.invoice_number=i.invoice_number
         			 left join inventory s on s.item_number=il.item_number
    	            where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  
    				and s.type_of_invoice='$sistim->type_of_invoice' ";
                    if($outlet!="")$sql.=" and il.warehouse_code='$outlet' "; 
                    
    				$sql.=" group by il.item_number,il.description ";
    				
         			$rst_so=$CI->db->query($sql)->result();

    				$item_new="";	$item_old="";
    				$i=0;
                    $z_qty=0;
                    $z_amt=0;
                 				
                    while($i<count($rst_so)){
    					$row=$rst_so[$i];
    					$item_new=$row->item_number;	
    
    					$tbl.="<tr>";
    					$tbl.="<td>".$row->item_number."</td>";
    					$tbl.="<td>".$row->description."</td>";
    					$tbl.="<td align='right'>".number_format($row->quantity)."</td>";
    					$tbl.="</tr>";
    					
    					$z_qty=$z_qty+$row->quantity;
                        $i++;
    					
                    };
                    
                    $tbl.="<tr>";
                    $tbl.="<td><strong>Sub Total $sistim->type_of_invoice</strong></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td align='right'><strong>".number_format($z_qty)."</strong></td>";
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
