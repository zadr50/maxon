<?php

$table="gl_report_groups";

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

$table="gl_transactions";

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
  PRIMARY KEY  (`transaction_id`),
  KEY `x1` (`gl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1012 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
 
$sql="

INSERT INTO `gl_transactions` (`transaction_id`, `company_code`, `gl_id`, `date_time_stamp`, `account_id`, `date`, `debit`, `credit`, `source`, `operation`, `custsuppbank`, `jurnaltype`, `project_code`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `id_name`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
(6, NULL, 'a', NULL, 1394, '2013-08-11 00:00:00', 20000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 'a', NULL, 1378, '2013-08-11 00:00:00', 90000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, 'a', NULL, 1375, '2013-08-11 00:00:00', 9000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, 'a', NULL, 1373, '2013-08-11 00:00:00', 120000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, 'a', NULL, 1396, '2013-08-11 00:00:00', 900, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, 'b', NULL, 1375, '2013-08-14 00:00:00', 90000, 0, 'b', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, 'b', NULL, 1385, '2013-08-12 00:00:00', 0, 20000, 'c', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, 'test', NULL, 1373, '2013-08-15 00:00:00', 9000, 0, 'tes', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(966, 'C01', 'PJL00152', NULL, 1373, '2014-03-09 07:00:00', 13000, 0, 'Test', 'Account Receivable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(965, 'C01', 'PJL00152', NULL, 1373, '2014-03-09 07:00:00', 0, 1000, 'Test', 'Sales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(964, 'C01', 'PJL00152', NULL, 1419, '2014-03-09 07:00:00', 900, 0, 'Test', 'Cogs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(963, 'C01', 'PJL00152', NULL, 1374, '2014-03-09 07:00:00', 0, 900, 'Test', 'Inventory', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(844, 'C01', 'PJL00086', NULL, 1373, '2013-05-09 00:00:00', 0, 5000, NULL, 'Sales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(845, 'C01', 'PJL00086', NULL, 1373, '2013-05-09 00:00:00', 0, 2000, NULL, 'Sales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="gl_transactions_archive";

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
	
	
	?>