<?php 
     $CI =& get_instance();
    $data['caption']='SALDO STOCK';
    if(!$CI->input->post('cmdPrint')){
    	
        $data['criteria1']=true;
        $data['label1']='Kelompok Barang';
        $data['text1']='';
         $data['output1']="text1";
         $data['key1']="kode";
         $data['fields1'][]=array("kode","80","Kode");
         $data['fields1'][]=array("category","180","Kelompok");
         $data['ctr1']='category/select';
		
		
        $data['criteria2']=true;
        $data['label2']='Kode Barang';
        $data['text2']='';
         $data['output2']="text2";
         $data['key2']="item_number";
         $data['fields2'][]=array("item_number","80","Kode");
         $data['fields2'][]=array("description","180","Nama Barang");
         $data['ctr2']='inventory/select';

        $data['criteria3']=true;
        $data['label3']='Cetak Qty 0 ? 1=YA, 0=TIDAK';
        $data['text3']='0';
		
		$data['criteria4']=true;
		$data['label4']='Gudang';
		$data['text4']='';
         $data['key4']="location_number";
         $data['fields4'][]=array("location_number","80","Gudang");
         $data['ctr4']='gudang/select';
		
		
        $data['rpt_controller']="inventory/rpt/$id";
        $CI->template->display_form_input('criteria',$data,'');
    } else {
    	
        $sql="select w.item_number,i.description,i.unit_of_measure,
			concat(ic.category,' (',i.category,')') as category,        
	        i.supplier_number,
            w.warehouse_code,w.quantity,i.cost,i.cost*w.quantity as amount,
			ip.qty_last as m_qty,ip.customer_pricing_code as m_unit		
            from inventory_warehouse w 
            inner join inventory i  on w.item_number=i.item_number 
            join inventory_categories ic on ic.kode=i.category
            left join inventory_prices ip on ip.item_number=i.item_number
                        
            where 1=1 ";

        $sql2="select i.item_number,i.description,
        i.quantity_in_stock as quantity,i.unit_of_measure,
        i.cost,i.cost*i.quantity_in_stock as amount,
        concat(ic.category,' (',i.category,')') as category,        
        i.supplier_number
        from inventory i
            left join inventory_categories ic on ic.kode=i.category
        where 1=1 ";
        
        $kel=$CI->input->post("text1");
        if($kel!="")$sql.=" and i.category='".$kel."'";
		
        $item=$CI->input->post('text2');
        if($item!="")$sql.=" and i.item_number='$item'";
		$cetak_nol=$CI->input->post("text3");
        if($cetak_nol=="0"){
            $sql.=" and coalesce(i.quantity_in_stock,0)<>0";
        }
        if($gudang=$CI->input->post("text4")){
        	$sql.=" and w.warehouse_code='$gudang' ";
        }
	//	$sql.=" order by i.item_number,w.warehouse_code";		

?>    	
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='2'><td><h2>SALDO STOCK</h2></td>     	
     </tr>
     <tr>
     	<td colspan=4>Criteria: Category: <?=$kel?>, Outlet: <?=$gudang?></td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
 		<table class='titem' width='100%'	>
 		<thead>
 			<tr><td>Kode</td><td>Nama Barang</td><td align='right'>Qty</td> <td>Unit</td>
 				<td>M Qty</td><td>M Unit</td>
 				<td align='right'>Cost</td><td align='right'>Amount</td><td>Category</td>
				<td>Supplier</td>
 			</tr>
 		</thead>
 		<tbody>
			<?php 
				$amt_tot=0;
				if($q=$CI->db->query($sql)){
					foreach($q->result() as $r){
						$tbl="<tr><td>$r->item_number</td><td>$r->description</td>
						<td align='right'>".number_format($r->quantity,2)."</td>
						<td>$r->unit_of_measure</td>
						<td>$r->m_qty</td><td>$r->m_unit</td>
						<td align='right'>".number_format($r->cost)."</td>
						<td align='right'>".number_format($r->amount,2)."</td>
						<td>$r->category</td><td>$r->supplier_number</td>
						</tr>";		
							
						echo $tbl;
						$amt_tot+=$r->amount;
					}			
							
				}
				$tbl="<tr><td><b>TOTAL</b></td><td></td>
				<td align='right'></td><td></td><td></td><td></td>
				<td align='right'></td>
				<td align='right'><b>".number_format($amt_tot,2)."</b></td>
				<td></td><td></td>
				</tr>";		
					
				echo $tbl;
							
			?>	
		</tbody>
</table>


<? } ?>