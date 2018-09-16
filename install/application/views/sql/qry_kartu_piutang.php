<?php
 
	$table="qry_kartu_piutang";
	
$sql="CREATE  VIEW qry_kartu_piutang AS
   select invoice_type as jenis, sales_order_number as ref,invoice_number as no_bukti
  ,invoice_date as tanggal,amount as jumlah,sold_to_customer as customer_number
   From invoice
  where invoice_type='I'

  Union All
  select invoice_type, your_order__,invoice_number, invoice_date,-1*abs(amount),sold_to_customer
  From invoice
  where invoice_type='R'

  Union All
  select 'P' as jenis,p.invoice_number,no_bukti, date_paid, amount_paid*-1, i.sold_to_customer
  from payments p
  left join invoice i on p.invoice_number=i.invoice_number

  Union All
  select 'C' as jenis,docnumber,kodecrdb,tanggal,-1*c.amount,i.sold_to_customer
  from crdb_memo c
  left join invoice i on i.invoice_number=c.docnumber
  where transtype='SO-CREDIT MEMO' and invoice_type='I'

  Union All
  select 'C' as jenis,docnumber,kodecrdb,tanggal,-1*c.amount,i.sold_to_customer
  from crdb_memo c
  left join invoice i on i.invoice_number=c.docnumber
  where transtype='SO-DEBIT MEMO' and invoice_type='I'
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	
?>