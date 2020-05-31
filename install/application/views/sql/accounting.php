<?php

$table="gl_report_groups";
$sql="CREATE TABLE IF NOT EXISTS `gl_report_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_type` double DEFAULT NULL,
  `group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `group_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `parent_group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`group_type`)
) ENGINE=MyISAM AUTO_INCREMENT=269 DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

INSERT INTO `gl_report_groups` (`id`, `company_code`, `account_type`, `group_type`, `group_name`, `parent_group_type`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
(216, 'MYPOS', 1, '10000', 'Aktiva Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 'MYPOS', 2, '20000', 'Hutang Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(223, 'MYPOS', 3, '33000', 'Modal', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 'MYPOS', 4, '40000', 'Pendapatan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 'MYPOS', 5, '50000', 'Harga Pokok Penjualan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 'MYPOS', 6, '60000', 'Biaya', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 'MYPOS', 7, '70000', 'Pendapatan Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 'MYPOS', 8, '80000', 'Biaya Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(268, NULL, 1, '12000', 'Aktiva Tetap', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(267, NULL, 1, '11010', 'Kas Kecil', '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(270, NULL, 1, '11020', 'Kas Besar', '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", gl_transactions";

$sql="

CREATE TABLE IF NOT EXISTS `gl_transactions` (
  `transaction_id` int(11) NOT NULL auto_increment,
  `company_code` varchar(15) character set utf8 default NULL,
  `gl_id` varchar(100) character set utf8 default NULL,
  `date_time_stamp` datetime default NULL,
  `account_id` int(11) default NULL,
  `date` datetime default NULL,
  `debit` double default NULL,
  `credit` double default NULL,
  `source` varchar(150) character set utf8 default NULL,
  `operation` varchar(150) character set utf8 default NULL,
  `custsuppbank` varchar(20) character set utf8 default NULL,
  `jurnaltype` int(11) default NULL,
  `project_code` varchar(50) character set utf8 default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id_name` varchar(250) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `x1` (`gl_id`),
  KEY `x2` (`custsuppbank`),
  KEY `x3` (`operation`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", gl_transactions_archive";

$sql="

CREATE TABLE IF NOT EXISTS `gl_transactions_archive` (
  `transaction_id` int(11) default NULL,
  `company_code` varchar(15) character set utf8 default NULL,
  `gl_id` varchar(22) character set utf8 default NULL,
  `date_time_stamp` datetime default NULL,
  `account_id` int(11) default NULL,
  `date` datetime default NULL,
  `debit` double default NULL,
  `credit` double default NULL,
  `source` varchar(150) character set utf8 default NULL,
  `operation` varchar(150) character set utf8 default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	

$sql="
CREATE VIEW `q_all_trans` AS select `purchase_order`.`purchase_order_number` AS `nomor_bukti`,`purchase_order`.`po_date` AS `tanggal`,
'faktur pembelian kredit' AS `jenis`,`purchase_order`.`posted` AS `posted`,
`purchase_order`.`comments` AS `comments`,`purchase_order`.`amount` AS `amount` 
from `purchase_order` where ((`purchase_order`.`potype` = 'i') 
and (`purchase_order`.`terms` not in ('cash','kontan','','tunai'))) 
union all 
select `purchase_order`.`purchase_order_number` AS `nomor_bukti`,`purchase_order`.`po_date` AS `tanggal`,
'retur pembelian' AS `jenis`,`purchase_order`.`posted` AS `posted`,
`purchase_order`.`comments` AS `comments`,`purchase_order`.`amount` AS `amount` 
from `purchase_order` where (`purchase_order`.`potype` = 'r') 
union all 
select `purchase_order`.`purchase_order_number` AS `nomor_bukti`,`purchase_order`.`po_date` AS `tanggal`,
'faktur beli konsinyasi' AS `jenis`,`purchase_order`.`posted` AS `posted`,`purchase_order`.`comments` AS `comments`,`purchase_order`.`amount` AS `amount` from `purchase_order` where (`purchase_order`.`potype` = 'k') union all select `crdb_memo`.`kodecrdb` AS `kodecrdb`,`crdb_memo`.`tanggal` AS `tanggal`,'debit credit memo pembelian' AS `debit credit memo pembelian`,`crdb_memo`.`posted` AS `posted`,`crdb_memo`.`keterangan` AS `keterangan`,`crdb_memo`.`amount` AS `amount` from `crdb_memo` where (`crdb_memo`.`transtype` in ('po-debit memo','po-credit memo')) union all select `payables`.`bill_id` AS `bill_id`,`payables`.`invoice_date` AS `invoice_date`,'faktur pembelian non po' AS `faktur pembelian non po`,`payables`.`posted` AS `posted`,`payables`.`comments` AS `comments`,`payables`.`amount` AS `amount` from `payables` where (`payables`.`purchase_order` = 0) union all select `invoice`.`invoice_number` AS `nomor_bukti`,`invoice`.`invoice_date` AS `tanggal`,'faktur penjualan kontan' AS `jenis`,`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,`invoice`.`amount` AS `amount` from `invoice` where ((`invoice`.`invoice_type` = 'i') and (`invoice`.`payment_terms` in ('cash','kontan','','tunai'))) union all select `invoice`.`invoice_number` AS `nomor_bukti`,`invoice`.`invoice_date` AS `tanggal`,'faktur penjualan kredit' AS `jenis`,`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,`invoice`.`amount` AS `amount` from `invoice` where ((`invoice`.`invoice_type` = 'i') and (`invoice`.`payment_terms` not in ('cash','kontan','','tunai'))) union all select `invoice`.`invoice_number` AS `nomor_bukti`,`invoice`.`invoice_date` AS `tanggal`,'retur penjualan' AS `jenis`,`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,`invoice`.`amount` AS `amount` from `invoice` where (`invoice`.`invoice_type` = 'r') union all select `invoice`.`invoice_number` AS `nomor_bukti`,`invoice`.`invoice_date` AS `tanggal`,'faktur jual konsinyasi' AS `jenis`,`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,`invoice`.`amount` AS `amount` from `invoice` where (`invoice`.`invoice_type` = 'k') union all select `crdb_memo`.`kodecrdb` AS `kodecrdb`,`crdb_memo`.`tanggal` AS `tanggal`,'debit credit memo penjualan' AS `debit credit memo penjualan`,`crdb_memo`.`posted` AS `posted`,`crdb_memo`.`keterangan` AS `keterangan`,`crdb_memo`.`amount` AS `amount` from `crdb_memo` where (`crdb_memo`.`transtype` in ('so-debit memo','so-credit memo')) union all select `cw`.`voucher` AS `voucher`,`cw`.`check_date` AS `check_date`,'kas masuk' AS `kas masuk`,`cw`.`posted` AS `posted`,`cw`.`memo` AS `memo`,`cw`.`deposit_amount` AS `deposit_amount` from (`check_writer` `cw` left join `invoice` `i` on((`cw`.`voucher` = `i`.`invoice_number`))) where ((`cw`.`trans_type` in ('cash in','cheque in','trans in')) and isnull(`i`.`invoice_number`)) union all select `check_writer`.`voucher` AS `voucher`,`check_writer`.`check_date` AS `check_date`,'kas keluar' AS `kas keluar`,`check_writer`.`posted` AS `posted`,`check_writer`.`memo` AS `memo`,`check_writer`.`deposit_amount` AS `deposit_amount` from `check_writer` where (`check_writer`.`trans_type` in ('cash out','cheque','trans out')) union all select distinct `inventory_products`.`shipment_id` AS `shipment_id`,concat(year(`inventory_products`.`date_received`),'-',month(`inventory_products`.`date_received`),'-',dayofmonth(`inventory_products`.`date_received`)) AS `date_received`,'assembly disassembly' AS `assembly disassembly`,`inventory_products`.`posted` AS `posted`,`inventory_products`.`comments` AS `comments`,`inventory_products`.`total_amount` AS `total_amount` from `inventory_products` where (`inventory_products`.`receipt_type` in ('prod_a','prod_d')) union all select distinct `inventory_products`.`shipment_id` AS `shipment_id`,concat(year(`inventory_products`.`date_received`),'-',month(`inventory_products`.`date_received`),'-',dayofmonth(`inventory_products`.`date_received`)) AS `date_received`,'assembly disassembly' AS `assembly disassembly`,`inventory_products`.`posted` AS `posted`,`inventory_products`.`comments` AS `comments`,`inventory_products`.`total_amount` AS `total_amount` from `inventory_products` where (`inventory_products`.`receipt_type` in ('etc','etc_in','etc_out')) union all select distinct `inventory_moving`.`transfer_id` AS `transfer_id`,concat(year(`inventory_moving`.`date_trans`),'-',month(`inventory_moving`.`date_trans`),'-',dayofmonth(`inventory_moving`.`date_trans`)) AS `date_trans`,'stock adjustment' AS `Keterangan`,`inventory_moving`.`posted` AS `posted`,`inventory_moving`.`comments` AS `comments`,`inventory_moving`.`total_amount` AS `total_amount` from `inventory_moving` where ((`inventory_moving`.`from_location` = `inventory_moving`.`to_location`) and (`inventory_moving`.`trans_type` = 'ADJ')) union all select `check_writer`.`voucher` AS `voucher`,`check_writer`.`check_date` AS `check_date`,'bank transfer' AS `bank transfer`,`check_writer`.`posted` AS `posted`,`check_writer`.`memo` AS `memo`,`check_writer`.`payment_amount` AS `payment_amount` from `check_writer` where (`check_writer`.`trans_type` = 'trans acc') union all select `invoice`.`invoice_number` AS `nomor_bukti`,`invoice`.`invoice_date` AS `tanggal`,'barang keluar lainnya' AS `jenis`,`invoice`.`posted` AS `posted`,`invoice`.`comments` AS `comments`,`invoice`.`amount` AS `amount` from `invoice` where (`invoice`.`invoice_type` = 'l');

";
$table.=", q_all_trans";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="
CREATE TABLE `branch` (
  `branch_code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `address_type` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `attention_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`branch_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
";
$table.=", branch";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
?>