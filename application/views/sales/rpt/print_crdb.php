<?php
   $CI =& get_instance();
   $sold_to_customer="";
   $company="";					$first_name="";
   $fax="";
   $phone="";
   $street="";
   if($transtype=="SO-DEBIT MEMO" || $transtype=="SO-CREDIT MEMO"){
	   if($q=$CI->db->select("sold_to_customer")->where("invoice_number",$docnumber)->get("invoice")){
	   		if($r=$q->row()){
	   			$sold_to_customer=$r->sold_to_customer;
	   		}	
	   }
	   if($q=$CI->db->where("customer_number",$sold_to_customer)->get("customers")){
	   		if($r=$q->row()){
	   			$company=$r->company;
				$fax=$r->fax;
				$phone=$r->phone;
				$street=$r->street;
				$first_name=$r->first_name;
	   		}
	   };
   	
   } else {
   
   		$s="select i.supplier_number,s.supplier_name,s.fax,s.phone,s.street,s.suite,s.first_name 
   		from purchase_order i 
   		left join suppliers s on s.supplier_number=i.supplier_number 
   		where i.purchase_order_number='$docnumber' ";
   		if($q=$CI->db->query($s)){
   			if($r=$q->row()){
   				$sold_to_customer=$r->supplier_number;
				$company=$r->supplier_name;
				$fax=$r->fax;
				$phone=$r->phone;
				$street=$r->street." - ".$r->suite;
				$first_name=$r->first_name;
   			}	
   		}
   	
   }
?>
<h1>BUKTI MEMO</h2><h2>Nomor: <?=$kodecrdb?></h2>
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td>Tanggal</td><td><?=$tanggal?></td>
     	<td colspan="2"><?=$sold_to_customer.' ('.$company.')'?></td>
     </tr>
     <tr>
     	<td>Ref#</td><td><?=$docnumber?></td>
     	<td colspan="2"><?=$street?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Phone: '.$phone.' - Fax: '.$fax?></td>
     </tr>
     <tr>
     	<td></td><td></td>
     	<td colspan="2"><?='Up: '.$first_name?></td>
     </tr>
     <tr><td>Catatan: <?=$keterangan?></td><td></td><td></td><td align="right"></td></tr>
     <tr><td>Jumlah: <?=$amount?></td><td></td><td></td><td align="right"></td></tr>
</table>
