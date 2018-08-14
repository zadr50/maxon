<?php
$CI =& get_instance();
$CI->load->model('supplier_model');
$sup=$CI->supplier_model->get_by_id($supplier)->row();
$po=$CI->purchase_order_model->get_by_id($po_number)->row();
?>
<table width='100%'> 
    <tr><td>User: <?=$po->ordered_by?></td>
        <td><strong>PURCHASE ORDER</strong></td><td> Hal: 1</td></tr>
    <tr><td> </td>
        <td><strong><?=$po_number?></strong></td><td> <?=$tanggal?></td></tr>      	
    <tr><td></td><td></td></tr>
    <tr><td colspan=2><strong>Kepada Yth,</strong></td>
        
    </tr>
     <tr><td colspan=2><?=$sup->supplier_name.' ('.$sup->supplier_number.')'?></td></tr> 
    <tr><td colspan=2><?=$sup->street?></td></tr> 
    <tr><td colspan=2><?=$sup->suite.' - '.$sup->city?></td></tr> 
    <tr><td colspan=2><?='Phone: '.$sup->phone.' - Fax: '.$sup->fax?></td></tr> 
    <tr><td colspan=2><?='Up: '.$sup->first_name?></td></tr> 
</table> 
<table cellspacing="0" cellpadding="1" border="1" width='100%'>
	 
		<tr><th>No</th></th><th>Kode Barang</th><th width="200">Nama Barang</th>
		<th width="30">Qty</th><th>Harga</th><th>Jumlah</th>
		</tr>
 
		<?
	   $sql="select item_number,description,quantity,unit,discount,
			price,total_price,disc_2,disc_3 
				from purchase_order_lineitems i
				where purchase_order_number='".$po_number."'";
		$query=$CI->db->query($sql);

		$tbl="";
        $no=0;
		 foreach($query->result() as $row){
		     $no++;
			$tbl.="<tr><td>$no</th>";
			$tbl.="<td>".$row->item_number."</td>";
			$tbl.="<td width=\"200\">".$row->description."</td>";
			$tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
			$tbl.="<td align=\"right\">".number_format($row->price)."</td>";
			$tbl.="<td align=\"right\">".number_format($row->total_price)."</td>";
			$tbl.="</tr>";
	   };
	   echo $tbl;
	   ?>
	 
</table> 

<table width='100%'>
     <tr>
         <td>Pajak <?=$tax?> </td><td  align="right"><?=number_format($tax_amount)?></td>
         <td>Sub Total </td><td align="right"><?=number_format($sub_total)?></td>
     </tr>
     <tr>
         <td>Ongkos </td><td  align="right"><?=number_format($freight)?></td>
         <td>Discount [<?=$discount?>]</td><td align="right"><?=number_format($disc_amount)?></td>
     </tr>
     <tr>
         <td>Lain-lain </td><td  align="right"><?=number_format($others)?></td>
         <td><strong>Jumlah </strong></td><td  align="right"><strong><?=number_format($amount)?></strong></td>
     </tr>
    <tr><td colspan=4></td></tr>
     <tr><td>A. Kredit : </td><td><?=""?></td><td colspan=2>F. Pengiriman Barang yg terlambar, dianggap BATAL</td></tr>
     <tr><td>B. System : </td><td><?=$po->type_of_invoice?></td><td colspan=2>G. Penyerahan Barang HARUS disertai PO, Surat Jalan, dan Faktur</td></tr>
     <tr><td>C. Tgl Pengiriman : </td><td><?=$po->due_date?></td><td colspan=2>H. Jumlah barang yg dikirim HARUS sama dengan PO</td></tr>
     <tr><td>D. Waktu Pengiriman : </td><td>Senin - Jumat <br>Pukul: 09:00 - 16:00</td><td colspan=2>I. Barang Cacat/Rusak akan di RETUR</td></tr>
     <tr><td colspan=2>E. Nota didanggap SAH 1(satu) hari setelah barang diterima.</td><td colspan=2>J. Jumlah yg dibayar adalah jumlah terkecil antara PO dan faktur</td></tr>
     <tr><td>Catatan : </td><td><?=$comments?></td></tr>

</table> 

<table class='table' cellspacing="0" cellpadding="1" border="1" width='100%'>
    <?php
    $agdg=null;
    if($qgdg=$CI->db->query("select wh_code from po_qty_alloc q 
        inner join purchase_order_lineitems i on i.line_number=q.line_id_po 
        where i.purchase_order_number='$po_number'  and q.qty>0
        group by wh_code")){
            foreach($qgdg->result() as $gdg){
                $agdg[]=$gdg->wh_code;
            }
        }
    echo "<thead>";
    if($agdg){
        $s="";
        echo "<th>Item Distribusi</th>";
        for($i=0;$i<count($agdg);$i++){
            $s.="<th>".$agdg[$i]."</th>";
        }
        echo $s;
        echo "<th>Total</th>";
    }
    echo "</thead><tbody>";
    if($q=$CI->db->query("select q.wh_code,q.qty,i.item_number from po_qty_alloc q 
        inner join purchase_order_lineitems i on i.line_number=q.line_id_po
        where i.purchase_order_number='$po_number' and q.qty>0 
        order by i.item_number")){
            $qgdg=null;
            foreach($q->result() as $row){
                for($ii=0;$ii<count($agdg)-1;$ii++){                    
                    $qgdg[$row->item_number][$row->wh_code]=$row->qty;                    
                }
            }
            echo "<tr>";
            while ($gdg = current($qgdg)) {
                echo "<td>".key($qgdg)."</td>";
                $total=0;                
                for($i=0;$i<count($agdg);$i++){
                    $qty=$gdg[$agdg[$i]];    
                    $total+=$qty;
                    echo "<td align='center'>$qty</td>";
                }
                echo "<td align='center'>$total</td></tr>";
                
                next($qgdg);
            }
        }
     echo "</tbody>";
    ?>
    
</table>            


