<?php
 $msg="";
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
	
$table="q_all_trans";
	
$sql="CREATE  VIEW q_all_trans AS
select `purchase_order`.`purchase_order_number` AS `nomor_bukti`,
`purchase_order`.`po_date` AS `tanggal`,'faktur pembelian kredit' AS `jenis`,
`purchase_order`.`posted` AS `posted`,`purchase_order`.`comments` AS `comments`,
`purchase_order`.`amount` AS `amount` from `purchase_order` 
where ((`purchase_order`.`potype` = 'i') and (`purchase_order`.`terms` 
not in ('cash','kontan','','tunai'))) 
union all select `purchase_order`.`purchase_order_number` AS `nomor_bukti`,
`purchase_order`.`po_date` AS `tanggal`,'retur pembelian' AS `jenis`,
`purchase_order`.`posted` AS `posted`,
`purchase_order`.`comments` AS `comments`,
`purchase_order`.`amount` AS `amount` from `purchase_order` 
where (`purchase_order`.`potype` = 'r') 
union all 
select `purchase_order`.`purchase_order_number` AS `nomor_bukti`,
`purchase_order`.`po_date` AS `tanggal`,'faktur beli konsinyasi' AS `jenis`,
`purchase_order`.`posted` AS `posted`,`purchase_order`.`comments` AS `comments`,
`purchase_order`.`amount` AS `amount` from `purchase_order` 
where (`purchase_order`.`potype` = 'k') 
union all 
select `crdb_memo`.`kodecrdb` AS `kodecrdb`,`crdb_memo`.`tanggal` AS `tanggal`,
'debit credit memo pembelian' AS `debit credit memo pembelian`,
`crdb_memo`.`posted` AS `posted`,`crdb_memo`.`keterangan` AS `keterangan`,
`crdb_memo`.`amount` AS `amount` from `crdb_memo` 
where (`crdb_memo`.`transtype` in ('po-debit memo','po-credit memo')) 
union all 
select `payables`.`bill_id` AS `bill_id`,`payables`.`invoice_date` AS `invoice_date`,
'faktur pembelian non po' AS `faktur pembelian non po`,`payables`.`posted` AS `posted`,`payables`.`comments` AS `comments`,
`payables`.`amount` AS `amount` from `payables` 
where (`payables`.`purchase_order` = 0) 
union all select `invoice`.`invoice_number` AS `nomor_bukti`,
`invoice`.`invoice_date` AS `tanggal`,'faktur penjualan kontan' AS `jenis`,
`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,
`invoice`.`amount` AS `amount` from `invoice` 
where ((`invoice`.`invoice_type` = 'i') and (`invoice`.`payment_terms` 
in ('cash','kontan','','tunai'))) 
union all 
select `invoice`.`invoice_number` AS `nomor_bukti`,
`invoice`.`invoice_date` AS `tanggal`,'faktur penjualan kredit' AS `jenis`,
`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,
`invoice`.`amount` AS `amount` from `invoice` 
where ((`invoice`.`invoice_type` = 'i') and (`invoice`.`payment_terms` 
not in ('cash','kontan','','tunai'))) 
union all 
select `invoice`.`invoice_number` AS `nomor_bukti`,
`invoice`.`invoice_date` AS `tanggal`,'retur penjualan' AS `jenis`,
`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,
`invoice`.`amount` AS `amount` from `invoice` 
where (`invoice`.`invoice_type` = 'r') 
union all 
select `invoice`.`invoice_number` AS `nomor_bukti`,
`invoice`.`invoice_date` AS `tanggal`,'faktur jual konsinyasi' AS `jenis`,
`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,
`invoice`.`amount` AS `amount` from `invoice` 
where (`invoice`.`invoice_type` = 'k') 
union all 
select `crdb_memo`.`kodecrdb` AS `kodecrdb`,`crdb_memo`.`tanggal` AS `tanggal`,
'debit credit memo penjualan' AS `debit credit memo penjualan`,
`crdb_memo`.`posted` AS `posted`,`crdb_memo`.`keterangan` AS `keterangan`,
`crdb_memo`.`amount` AS `amount` from `crdb_memo` 
where (`crdb_memo`.`transtype` in ('so-debit memo','so-credit memo')) 
union all 
select `cw`.`voucher` AS `voucher`,`cw`.`check_date` AS `check_date`,
'kas masuk' AS `kas masuk`,`cw`.`posted` AS `posted`,`cw`.`memo` AS `memo`,
`cw`.`deposit_amount` AS `deposit_amount` from (`check_writer` `cw` 
left join `invoice` `i` on((`cw`.`voucher` = `i`.`invoice_number`))) 
where ((`cw`.`trans_type` in ('cash in','cheque in','trans in')) 
and isnull(`i`.`invoice_number`)) 
union all 
select `check_writer`.`voucher` AS `voucher`,`check_writer`.`check_date` AS `check_date`,
'kas keluar' AS `kas keluar`,
`check_writer`.`posted` AS `posted`,`check_writer`.`memo` AS `memo`,
`check_writer`.`deposit_amount` AS `deposit_amount` 
from `check_writer` where (`check_writer`.`trans_type` in ('cash out','cheque','trans out')) 
union all 
select distinct `inventory_products`.`shipment_id` AS `shipment_id`,concat(year(`inventory_products`.`date_received`),'-',month(`inventory_products`.`date_received`),'-',
dayofmonth(`inventory_products`.`date_received`)) AS `date_received`,
'assembly disassembly' AS `assembly disassembly`,`inventory_products`.`posted` AS `posted`,`inventory_products`.`comments` AS `comments`,`inventory_products`.`total_amount` AS `total_amount` from `inventory_products` 
where (`inventory_products`.`receipt_type` in ('prod_a','prod_d')) 
union all 
select distinct `inventory_products`.`shipment_id` AS `shipment_id`,concat(year(`inventory_products`.`date_received`),'-',month(`inventory_products`.`date_received`),'-',
dayofmonth(`inventory_products`.`date_received`)) AS `date_received`,
'assembly disassembly' AS `assembly disassembly`,`inventory_products`.`posted` AS `posted`,
`inventory_products`.`comments` AS `comments`,`inventory_products`.`total_amount` AS `total_amount` from `inventory_products` where (`inventory_products`.`receipt_type` 
in ('etc','etc_in','etc_out')) 
union all 
select distinct `inventory_moving`.`transfer_id` AS `transfer_id`,concat(year(`inventory_moving`.`date_trans`),'-',
month(`inventory_moving`.`date_trans`),'-',dayofmonth(`inventory_moving`.`date_trans`)) AS `date_trans`,
'stock adjustment' AS `Keterangan`,`inventory_moving`.`posted` AS `posted`,
`inventory_moving`.`comments` AS `comments`,`inventory_moving`.`total_amount` AS `total_amount` 
from `inventory_moving` 
where ((`inventory_moving`.`from_location` = `inventory_moving`.`to_location`) and (`inventory_moving`.`trans_type` = 'ADJ')) 
union all 
select `check_writer`.`voucher` AS `voucher`,
`check_writer`.`check_date` AS `check_date`,'bank transfer' AS `bank transfer`,`check_writer`.`posted` AS `posted`,
`check_writer`.`memo` AS `memo`,
`check_writer`.`payment_amount` AS `payment_amount` from `check_writer` where (`check_writer`.`trans_type` = 'trans acc') union all select `invoice`.`invoice_number` AS `nomor_bukti`,
`invoice`.`invoice_date` AS `tanggal`,'barang keluar lainnya' AS `jenis`,`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,`invoice`.`amount` AS `amount` 
from `invoice` 
where (`invoice`.`invoice_type` = 'l')
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	
	
?>