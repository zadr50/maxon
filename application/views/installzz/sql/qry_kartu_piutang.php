<?php
 
$table="qry_kartu_piutang";
	
$sql="CREATE  VIEW qry_kartu_piutang AS
   select invoice_type as jenis, sales_order_number as ref,invoice_number as no_bukti
  ,invoice_date as tanggal,amount ,sold_to_customer as customer_number
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
  where how_paid in ('GIRO','1') and doc_status=1
  
  Union All
  select 'P' as jenis,p.invoice_number,no_bukti, date_paid, amount_paid*-1, i.sold_to_customer
  from payments p
  left join invoice i on p.invoice_number=i.invoice_number
  where how_paid not in ('GIRO','1')
    

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
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();
	

$table="qry_invoice_credit";

$sql="CREATE VIEW `qry_invoice_credit` AS select `crdb_memo`.`docnumber` AS `docnumber`,
sum(`crdb_memo`.`amount`) AS `cr_amount` 
from `crdb_memo` where (`crdb_memo`.`transtype` = _utf8'SO-CREDIT MEMO') 
group by `crdb_memo`.`docnumber`";

if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();


$table="qry_invoice_debit";
$sql="CREATE VIEW `qry_invoice_debit` AS select `crdb_memo`.`docnumber` AS `docnumber`,
sum(`crdb_memo`.`amount`) AS `db_amount` from `crdb_memo` 
where (`crdb_memo`.`transtype` = _utf8'SO-DEBIT MEMO') 
group by `crdb_memo`.`docnumber`";

if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="qry_invoice_header_sum";
$sql="CREATE VIEW `qry_invoice_header_sum` AS select `ls_invoice_header`.`loan_id` AS `loan_id`,
sum(`ls_invoice_header`.`pokok`) AS `z_pokok`,sum(`ls_invoice_header`.`pokok_paid`) AS `z_pokok_paid`,
(sum(`ls_invoice_header`.`pokok`) - sum(`ls_invoice_header`.`pokok_paid`)) AS `z_saldo_pokok` 
from `ls_invoice_header` group by `ls_invoice_header`.`loan_id` ";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="qry_invoice_lancar_macet";
$sql="CREATE VIEW `qry_invoice_lancar_macet` AS select `ls_invoice_header`.`loan_id` AS `loan_id`,
year(`ls_invoice_header`.`invoice_date`) AS `tahun`,month(`ls_invoice_header`.`invoice_date`) AS `bulan`,
sum(if(((`ls_invoice_header`.`hari_telat` >= 0) 
and (`ls_invoice_header`.`hari_telat` < 7)),1,0)) AS `lancar`,
sum(if(((`ls_invoice_header`.`hari_telat` >= 7) and (`ls_invoice_header`.`hari_telat` < 14)),1,0)) AS `kurang`,
sum(if((`ls_invoice_header`.`hari_telat` >= 14),1,0)) AS `macet`,
sum(if(((`ls_invoice_header`.`hari_telat` >= 0) and (`ls_invoice_header`.`hari_telat` < 7)),
`ls_invoice_header`.`amount`,0)) AS `lancar_amt`,
sum(if(((`ls_invoice_header`.`hari_telat` >= 7) and (`ls_invoice_header`.`hari_telat` < 14)),
`ls_invoice_header`.`amount`,0)) AS `kurang_amt`,sum(if((`ls_invoice_header`.`hari_telat` >= 14),
`ls_invoice_header`.`amount`,0)) AS `macet_amt` 
from `ls_invoice_header` 
group by `ls_invoice_header`.`loan_id`,year(`ls_invoice_header`.`invoice_date`),
month(`ls_invoice_header`.`invoice_date`)";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="qry_invoice_payment";
$sql="CREATE VIEW `qry_invoice_payment` AS select `payments`.`invoice_number` AS `invoice_number`,
sum(`payments`.`amount_paid`) AS `payment` from `payments` 
group by `payments`.`invoice_number` ";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="qry_invoice_payment_non_giro";
$sql="CREATE VIEW `qry_invoice_payment_non_giro` 
AS select `payments`.`invoice_number` AS `invoice_number`,
sum(`payments`.`amount_paid`) AS `payment` from `payments` 
where `how_paid` not in ('1','GIRO')
group by `payments`.`invoice_number` ";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="qry_invoice_payment_giro_cleared";
$sql="CREATE VIEW `qry_invoice_payment_giro_cleared` 
AS select `payments`.`invoice_number` AS `invoice_number`,
sum(`payments`.`amount_paid`) AS `payment` from `payments` 
where `how_paid` in ('1','GIRO') and doc_status='1'
group by `payments`.`invoice_number` ";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="qry_invoice_payment_giro_not_cleared";
$sql="CREATE VIEW `qry_invoice_payment_giro_not_cleared` 
AS select `payments`.`invoice_number` AS `invoice_number`,
sum(`payments`.`amount_paid`) AS `payment` from `payments` 
where `how_paid` in ('1','GIRO') and doc_status is null
group by `payments`.`invoice_number` ";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="qry_invoice_retur";
$sql="CREATE VIEW `qry_invoice_retur` AS select `invoice`.`your_order__` AS `your_order__`,
sum(`invoice`.`amount`) AS `retur` from `invoice` where (`invoice`.`invoice_type` = _utf8'R') 
group by `invoice`.`your_order__` ";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();
	
$table="qry_invoice";
$sql="CREATE VIEW `qry_invoice` AS select `i`.`invoice_date` AS `invoice_date`,
	`i`.`invoice_number` AS `invoice_number`,`i`.`sold_to_customer` AS `sold_to_customer`,
	`c`.`company` AS `company`,`i`.`due_date` AS `due_date`,`i`.`payment_terms` AS `payment_terms`,
	`i`.`salesman` AS `salesman`,`i`.`amount` AS `amount`,
	`i`.`sales_order_number` AS `sales_order_number`,
	coalesce(`p1`.`payment`,0)+coalesce(`p2`.`payment`,0) AS `payment`,
	coalesce(`r`.`retur`,0) AS `retur`,
	coalesce(p1.payment,0) as payment_non_giro,
	coalesce(p2.payment,0) as payment_giro_cleared,
	coalesce(p3.payment,0) as payment_giro_not_cleared,
	`cr`.`cr_amount` AS `cr_amount`,`d`.`db_amount` AS `db_amount` 
	from ((((((((`invoice` `i` left join `customers` `c` 
		on((`c`.`customer_number` = `i`.`sold_to_customer`))) 
	left join `qry_invoice_payment` `p` 
		on((convert(`p`.`invoice_number` using utf8) = `i`.`invoice_number`))) 
	left join `qry_invoice_payment_non_giro` `p1` 
		on((convert(`p1`.`invoice_number` using utf8) = `i`.`invoice_number`))) 
	left join `qry_invoice_payment_giro_cleared` `p2` 
		on((convert(`p2`.`invoice_number` using utf8) = `i`.`invoice_number`))) 
	left join `qry_invoice_payment_giro_not_cleared` `p3` 
		on((convert(`p3`.`invoice_number` using utf8) = `i`.`invoice_number`))) 
	left join `qry_invoice_retur` `r` 
		on((convert(`r`.`your_order__` using utf8) = `i`.`invoice_number`))) 
	left join `qry_invoice_credit` `cr` 
		on((convert(`cr`.`docnumber` using utf8) = `i`.`invoice_number`))) 
	left join `qry_invoice_debit` `d` 
		on((convert(`d`.`docnumber` using utf8) = `i`.`invoice_number`))) 
	where (`i`.`invoice_type` = _utf8'I') ;

";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

			
?>