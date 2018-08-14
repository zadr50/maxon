<?
   $CI =& get_instance();
   $sold_to_customer=$CI->db->select("sold_to_customer")->
   where("invoice_number",$docnumber)->get("invoice")->row()->sold_to_customer;
   $cst=$CI->db->where("customer_number",$sold_to_customer)->get("customers")->row();
?>
<h1>BUKTI MEMO</h2><h2>Nomor: <?=$kodecrdb?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal</td><td><?=$tanggal?></td>
     	<td colspan="2"><?=$sold_to_customer.' ('.$cst->company.')'?></td>
     </tr>
     <tr>
     	<td>Ref#</td><td><?=$docnumber?></td>
     	<td colspan="2"><?=$cst->street?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$cst->phone.' - Fax: '.$cst->fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Up: '.$cst->first_name?></td>
     </tr>
     <tr><td>Catatan: <?=$keterangan?></td><td></td><td></td><td align="right"></td></tr>
     <tr><td>Jumlah: <?=$amount?></td><td></td><td></td><td align="right"></td></tr>
</table>
