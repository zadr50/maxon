<?php
$CI =& get_instance();
$CI->load->model('supplier_model');
$sup=$CI->supplier_model->get_by_id($supplier)->row();
$po=$CI->purchase_order_model->get_by_id($po_number)->row();
$format_print=$this->sysvar->getvar('format_print');
$company="";
if($po->bill_to_contact!=""){
    $company=$CI->db->select("company_name")->where("company_code",$po->bill_to_contact)
        ->get("preferences")->row()->company_name;
}
$outlet_name="";
if($q=$CI->db->where("location_number",$po->warehouse_code)->get("shipping_locations")){
    if($r=$q->row()){
        $outlet_name=$r->attention_name;
    }
}
?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>themes/standard/style_print.css">

<table width='100%'> 
    <tr><td>User: <?=$create_by?></td>
        <td><strong>PURCHASE ORDER</strong></td><td> Hal: 1</td></tr>
    <tr><td> </td>
        <td><strong><?=$po_number?></strong></td><td> <?=$tanggal?></td></tr>      	
    <tr><td></td><td></td><td><?=$po->bill_to_contact?> - <?=$company?></td></tr>
    <tr><td colspan=2><strong>Kepada Yth,</strong></td>
        <td><?=$po->warehouse_code?> - <?=$outlet_name?></td>
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
				where purchase_order_number='".$po_number."' order by no_urut";
		$query=$CI->db->query($sql);
		$tbl="";
        $no=0;
        $qty=0;$count=0;
		 foreach($query->result() as $row){
		     $no++;
			$tbl.="<tr><td>$no</th>";
			$tbl.="<td>".$row->item_number."</td>";
			$tbl.="<td>".$row->description."</td>";
			$tbl.="<td width=\"30\" align=\"right\">".number_format($row->quantity)."</td>";
			$tbl.="<td align=\"right\">".number_format($row->price)."</td>";
			$tbl.="<td align=\"right\">".number_format($row->total_price)."</td>";
			$tbl.="</tr>";
            $qty+=$row->quantity;
	   };
       $tbl.="    <tr><td></td><td><strong>TOTAL</strong></td><td></td><td align='right'>$qty</td><td></td>
            <td align='right'></td></tr>";
	   echo $tbl;
	   ?>
	 
</table> 

<table width='100%'>
     <tr>
         <td>Pajak  (PPN) <?=$tax?> </td><td  align="right"><?=number_format($tax_amount)?>&nbsp&nbsp</td>
         <td>Sub Total </td><td align="right"><?=number_format($sub_total)?></td>
     </tr>
     <tr>
         <td>Ongkos </td><td  align="right"><?=number_format($freight)?>&nbsp&nbsp</td>
         <td>Discount [<?=$discount?>]</td><td align="right"><?=number_format($disc_amount)?></td>
     </tr>
     <tr>
         <td>Lain-lain </td><td  align="right"><?=number_format($others)?>&nbsp&nbsp</td>
         <td><strong>Jumlah </strong></td><td  align="right"><strong><?=number_format($amount)?></strong></td>
     </tr>
    <tr><td colspan=4></td></tr>
     <tr><td>A. Kredit : </td><td><?="$po->terms"?></td><td colspan=2>F. Pengiriman Barang yg terlambat, dianggap BATAL</td></tr>
     <tr><td>B. System : </td><td><?=$po->type_of_invoice?></td><td colspan=2>G. Penyerahan Barang HARUS disertai PO, Surat Jalan, dan Faktur</td></tr>
     <tr><td>C. Tgl Pengiriman : </td><td><?=$po->due_date?></td><td colspan=2>H. Jumlah barang yg dikirim HARUS sama dengan PO</td></tr>
     <tr><td>D. Waktu Pengiriman : </td><td>Senin - Jumat <br>Pukul: 09:00 - 16:00</td><td colspan=2>I. Barang Cacat/Rusak akan di RETUR</td></tr>
     <tr><td colspan=2>E. Nota didanggap SAH 1(satu) hari setelah barang diterima.</td><td colspan=2>J. Jumlah yg dibayar adalah jumlah terkecil antara PO dan faktur</td></tr>
     <tr><td>Catatan : </td><td><?=$comments?></td></tr>

</table> 

<table width='100%'> 
    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>
    <tr><td><strong>Supplier</strong></td><td><strong>Dipesan Oleh</strong></td></tr>    
    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>    
    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>    
    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>    
    <tr><td></td><td><?=$po->ordered_by?></td></tr>
</table>


