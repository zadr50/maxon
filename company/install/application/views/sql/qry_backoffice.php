<?php
$msg=""; 
$table="qry_coa";
$sql="
CREATE  VIEW `qry_coa` AS select `chart_of_accounts`.`account` AS `account`,
`chart_of_accounts`.`account_description` AS `account_description`,_utf8'D' AS `jenis`,
`chart_of_accounts`.`db_or_cr` AS `db_or_cr`,`chart_of_accounts`.`beginning_balance` AS `saldo_awal`,
`chart_of_accounts`.`group_type` AS `parent` from `chart_of_accounts` 
union all 
select `gl_report_groups`.`group_type` AS `group_type`,`gl_report_groups`.`group_name` AS `group_name`,
_utf8'H' AS `jenis`,_utf8'' AS `db_or_cr`,NULL AS `0`,`gl_report_groups`.`parent_group_type` AS `parent_group_type` 
from `gl_report_groups`;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_adj";
$sql="
CREATE VIEW `qry_kartustock_adj` AS select `i`.`date_trans` AS `tanggal`,
_utf8'Adjustment' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,
`s`.`description` AS `description`,abs(if((`i`.`to_qty` > 0),`i`.`to_qty`,0)) AS `qty_masuk`,
abs(if((`i`.`to_qty` < 0),`i`.`to_qty`,0)) AS `qty_keluar`,0 AS `price`,`i`.`cost` AS `cost`,
(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,
`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` 
from (`inventory_moving` `i` left join `inventory` `s` 
on ((`i`.`item_number` = `s`.`item_number`)));
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_delivery";
$sql="
CREATE  VIEW `qry_kartustock_delivery` AS select `i`.`invoice_date` AS `tanggal`,
`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,
`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,
`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,0 AS `qty_masuk`,
abs(`il`.`quantity`) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,
`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,
`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,
`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,
`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` 
 from (`invoice` `i` left join `invoice_lineitems` `il` on ((`i`.`invoice_number` = `il`.`invoice_number`))) 
 where (`i`.`invoice_type` = _utf8'D');
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_etc_out";
$sql="
CREATE   VIEW `qry_kartustock_etc_out` AS select `pp`.`date_received` AS `tanggal`,
`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,
`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,
`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`pp`.`quantity_received`) AS `qty_keluar`,
`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,`pp`.`cost` AS `cost`,0 AS `discount`,
0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,`pp`.`warehouse_code` AS `gudang`,
_utf8'IDR' AS `mata_uang`,1 AS `rate`,`pp`.`supplier_number` AS `supplier`,
`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,`pp`.`multi_unit` AS `multi_unit`,
`pp`.`mu_price` AS `mu_price` from (`inventory_products` `pp` left join `inventory` `s` 
on ((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` = _utf8'ETC_OUT');
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_invoice";
$sql="
CREATE   VIEW `qry_kartustock_invoice` AS select `i`.`invoice_date` AS `tanggal`,
`i`.`invoice_type` AS `tipe`,_utf8'Faktur Jual Kontan' AS `jenis`,`i`.`payment_terms` AS `termin`,
`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,
`il`.`description` AS `description`,if((`il`.`quantity` < 0),
abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),
abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,
`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,
`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,
`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,
`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` 
from (`invoice` `i` left join `invoice_lineitems` `il` 
on ((`i`.`invoice_number` = `il`.`invoice_number`))) where ((`i`.`invoice_type` = _utf8'I') 
and (`i`.`payment_terms` in (_utf8'Cash',_utf8'',_utf8'Tunai',_utf8'Kontan'))) 
union all 
select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,
`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,
`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,
if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,
if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,
`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,
`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,
`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,
`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,
`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` 
from (`invoice` `i` left join `invoice_lineitems` `il` 
on ((`i`.`invoice_number` = `il`.`invoice_number`))) 
where ((`i`.`invoice_type` = _utf8'D') and (`il`.`from_line_type` = _utf8'SO')) 
union all 
select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Retur Jual' AS `jenis`,
`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,
`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,
abs(`il`.`quantity`) AS `qty_masuk`,0 AS `qty_keluar`,`il`.`unit` AS `unit`,
`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,
`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,
`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,
`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,
`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,
`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` 
on ((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'R') union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Konsinyasi' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'K');
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_purchcase";
$sql="
CREATE VIEW `qry_kartustock_purchase` AS select `p`.`po_date` AS `tanggal`, 
_utf8'BELI_KONTAN' AS `tipe`,_utf8'Faktur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,
`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,
`pi`.`description` AS `description`,`pi`.`quantity` AS `qty_masuk`,0 AS `qty_keluar`,
`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,
`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,
`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,
`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,
`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,
`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,
`p`.`comments` AS `comments` 
from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` 
on ((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) 
where ((`p`.`potype` = _utf8'I') and (`p`.`terms` 
in (_utf8'',_utf8'CASH',_utf8'TUNAI',_utf8'KONTAN'))) 
union all select `p`.`po_date` AS `tanggal`,_utf8'RET_BELI' AS `tipe`,
_utf8'Retur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,
`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,
`pi`.`description` AS `description`,0 AS `qty_masuk`,abs(`pi`.`quantity`) AS `qty_keluar`,
`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,
`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,
`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,
`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,
`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,
`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,
`p`.`comments` AS `comments` 
from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` 
on((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) 
where (`p`.`potype` = _utf8'R');
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_receipt";
$sql="
CREATE  VIEW `qry_kartustock_receipt` AS select `pp`.`date_received` AS `tanggal`,
`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,
`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,
`s`.`description` AS `description`,abs(if((`pp`.`quantity_received` > 0)
,`pp`.`quantity_received`,0)) AS `qty_masuk`,abs(if((`pp`.`quantity_received` < 0),
`pp`.`quantity_received`,0)) AS `qty_keluar`,`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,
`pp`.`cost` AS `cost`,0 AS `discount`,0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,
`pp`.`warehouse_code` AS `gudang`,_utf8'IDR' AS `mata_uang`,1 AS `rate`,
`pp`.`supplier_number` AS `supplier`,`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,
`pp`.`multi_unit` AS `multi_unit`,`pp`.`mu_price` AS `mu_price` 
from (`inventory_products` `pp` left join `inventory` `s` 
on((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` 
not in (_utf8'INVOICE',_utf8'RET_BELI',_utf8'ETC_OUT'));
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_transfer";
$sql="
CREATE VIEW `qry_kartustock_transfer` AS select `i`.`date_trans` AS `tanggal`,
_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,
`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`i`.`to_qty`) AS `qty_keluar`,
0 AS `price`,0 AS `cost`,0 AS `amount_masuk`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_keluar`,
`i`.`from_location` AS `gudang`,`i`.`comments` AS `comments` 
from (`inventory_moving` `i` left join `inventory` `s` 
on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`) 
union all select `i`.`date_trans` AS `tanggal`,_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(`i`.`to_qty`) AS `qty_masuk`,0 AS `qty_keluar`,0 AS `price`,0 AS `cost`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="qry_kartustock_union";
$sql="CREATE VIEW `qry_kartustock_union` AS select `i`.`tanggal` AS `tanggal`,
`i`.`jenis` AS `jenis`,`i`.`no_sumber` AS `no_sumber`,`i`.`item_number` AS `item_number`,
`i`.`description` AS `description`,`i`.`qty_masuk` AS `qty_masuk`,
`i`.`qty_keluar` AS `qty_keluar`,`i`.`price` AS `price`,`i`.`cost` AS `cost`,
if((`i`.`qty_masuk` > 0),(`i`.`cost` * `i`.`qty_masuk`),0) AS `amount_masuk`,
if((`i`.`qty_masuk` > 0),0,(`i`.`cost` * `i`.`qty_keluar`)) AS `amount_keluar`,
`i`.`gudang` AS `gudang`,`i`.`comments` AS `comments` from `qry_kartustock_invoice` `i` 
where (`i`.`item_number` is not null) union all select `r`.`tanggal` AS `tanggal`,
`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,`r`.`item_number` AS `item_number`,
`r`.`description` AS `description`,`r`.`qty_masuk` AS `qty_masuk`,
`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,`r`.`cost` AS `cost`,
if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,
if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,
`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_receipt` `r` 
union all select `r`.`tanggal` AS `tanggal`,`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,
`r`.`item_number` AS `item_number`,`r`.`description` AS `description`,
`r`.`qty_masuk` AS `qty_masuk`,`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,
`r`.`cost` AS `cost`,if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,
if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,
`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_etc_out` `r` 
union all select `p`.`tanggal` AS `tanggal`,`p`.`jenis` AS `jenis`,
`p`.`no_sumber` AS `no_sumber`,`p`.`item_number` AS `item_number`,
`p`.`description` AS `description`,`p`.`qty_masuk` AS `qty_masuk`,
`p`.`qty_keluar` AS `qty_keluar`,`p`.`price` AS `price`,`p`.`cost` AS `cost`,
`p`.`amount_masuk` AS `amount_masuk`,`p`.`amount_keluar` AS `amount_keluar`,
`p`.`gudang` AS `gudang`,`p`.`comments` AS `comments` from `qry_kartustock_purchase` `p` 
union all select `qry_kartustock_adj`.`tanggal` AS `tanggal`,
`qry_kartustock_adj`.`jenis` AS `jenis`,`qry_kartustock_adj`.`no_sumber` AS `no_sumber`,
`qry_kartustock_adj`.`item_number` AS `item_number`,
`qry_kartustock_adj`.`description` AS `description`,
`qry_kartustock_adj`.`qty_masuk` AS `qty_masuk`,`qry_kartustock_adj`.`qty_keluar` AS `qty_keluar`,
`qry_kartustock_adj`.`price` AS `price`,`qry_kartustock_adj`.`cost` AS `cost`,
`qry_kartustock_adj`.`amount_masuk` AS `amount_masuk`,
`qry_kartustock_adj`.`amount_keluar` AS `amount_keluar`,`qry_kartustock_adj`.`gudang` AS `gudang`,
`qry_kartustock_adj`.`comments` AS `comments` from `qry_kartustock_adj` 
union all select `qry_kartustock_transfer`.`tanggal` AS `tanggal`,
`qry_kartustock_transfer`.`jenis` AS `jenis`,`qry_kartustock_transfer`.`no_sumber` AS `no_sumber`,
`qry_kartustock_transfer`.`item_number` AS `item_number`,`qry_kartustock_transfer`.`description` AS `description`,
`qry_kartustock_transfer`.`qty_masuk` AS `qty_masuk`,`qry_kartustock_transfer`.`qty_keluar` AS `qty_keluar`,
`qry_kartustock_transfer`.`price` AS `price`,`qry_kartustock_transfer`.`cost` AS `cost`,
`qry_kartustock_transfer`.`amount_masuk` AS `amount_masuk`,`qry_kartustock_transfer`.`amount_keluar` AS `amount_keluar`,
`qry_kartustock_transfer`.`gudang` AS `gudang`,`qry_kartustock_transfer`.`comments` AS `comments` 
from `qry_kartustock_transfer`;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
?>	