<?php
$table="chart_account_link";
$sql="CREATE TABLE IF NOT EXISTS `chart_account_link` (
  `company_code` varchar(50) character set utf8 NOT NULL default '',
  `hutang` int(11) default NULL,
  `penerimaan` int(11) default NULL,
  `piutang` int(11) default NULL,
  `pembayaran` int(11) default NULL,
  `laba_periode` int(11) default NULL,
  `laba_ditahan` int(11) default NULL,
  `historical_balancing` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";

if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
$table.=", chart_of_accounts";

$sql="CREATE TABLE IF NOT EXISTS `chart_of_accounts` (
  `id` int(11) NOT NULL auto_increment,
  `company_code` varchar(15) character set utf8 default NULL,
  `account_type` double default NULL,
  `group_type` varchar(10) character set utf8 default NULL,
  `group_sequence` double default NULL,
  `account` varchar(20) character set utf8 default NULL,
  `account_description` varchar(50) character set utf8 default NULL,
  `sub_account` varchar(8) character set utf8 default NULL,
  `sub_account_description` varchar(50) character set utf8 default NULL,
  `beginning_balance` double default NULL,
  `notes` double default NULL,
  `db_or_cr` int(11) default NULL,
  `flag_archive` bit(1) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  KEY `x1` (`account`),
  KEY `x2` (`account_description`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1505 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", chart_of_account_types";

$sql="
CREATE TABLE IF NOT EXISTS `chart_of_account_types` (
  `account_type_num` double NOT NULL default '0',
  `account_type` varchar(30) character set utf8 default NULL,
  `income_statement_num` int(11) default NULL,
  `sub_acc_income` int(11) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`account_type_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="
INSERT INTO `chart_of_account_types` (`account_type_num`, `account_type`, `income_statement_num`, `sub_acc_income`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
(1, 'Aktiva', NULL, NULL, NULL, NULL, NULL),
(2, 'Hutang', NULL, NULL, NULL, NULL, NULL),
(3, 'Modal', NULL, NULL, NULL, NULL, NULL),
(4, 'Pendapatan', NULL, NULL, NULL, NULL, NULL),
(5, 'Harga Pokok', NULL, NULL, NULL, NULL, NULL),
(6, 'Biaya', NULL, NULL, NULL, NULL, NULL),
(7, 'Pendapatan Lain', NULL, NULL, NULL, NULL, NULL),
(8, 'Baya Lain', NULL, NULL, NULL, NULL, NULL);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	
?>