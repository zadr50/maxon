<?
$table="check_writer";
$sql="
CREATE TABLE IF NOT EXISTS `check_writer` (
  `trans_id` int(11) NOT NULL auto_increment,
  `trans_type` varchar(50) character set utf8 default NULL,
  `account_number` varchar(50) character set utf8 default NULL,
  `check_number` varchar(50) character set utf8 default NULL,
  `check_date` datetime default NULL,
  `payee` varchar(50) character set utf8 default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `payment_amount` double default NULL,
  `deposit_amount` double default NULL,
  `memo` varchar(150) character set utf8 default NULL,
  `cleared` int(1) default NULL,
  `cleared_date` datetime default NULL,
  `void` int(1) default NULL,
  `print` int(1) default NULL,
  `voucher` varchar(50) character set utf8 default NULL,
  `adjustment_dr_account_id` int(11) default NULL,
  `adjustment_cr_account_id` int(11) default NULL,
  `bill_payment` int(1) default NULL,
  `posting_gl_id` varchar(20) character set utf8 default NULL,
  `posted` int(1) default NULL,
  `printed` datetime default NULL,
  `batch_post` int(1) default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `paymentlineid` int(11) default NULL,
  `from_bank` varchar(50) character set utf8 default NULL,
  `bank_tran_id` varchar(50) character set utf8 default NULL,
  `curr_code` varchar(50) character set utf8 default NULL,
  `curr_rate` double default NULL,
  `curr_rate_exc` double default NULL,
  `curr_code_org` varchar(50) character set utf8 default NULL,
  `curr_rate_org` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `jenisuangmuka` varchar(50) character set utf8 default NULL,
  `sisauangmuka` double default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY  (`trans_id`),
  KEY `x1` (`payee`),
  KEY `x2` (`voucher`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$table="check_writer_deposit_detail";
$sql="
CREATE TABLE IF NOT EXISTS `check_writer_deposit_detail` (
  `trans_id` int(11) default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_number` varchar(50) character set utf8 default NULL,
  `routing_code` varchar(20) character set utf8 default NULL,
  `check_number` varchar(50) character set utf8 default NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="check_writer_items";
$sql="
CREATE TABLE IF NOT EXISTS `check_writer_items` (
  `trans_id` int(11) default NULL,
  `trans_type` varchar(200) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `comments` varchar(200) character set utf8 default NULL,
  `account` varchar(50) character set utf8 default NULL,
  `description` varchar(200) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `invoice_number` varchar(50) default NULL,
  `ref1` varchar(50) default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="check_writer_print_settings";
$sql="
CREATE TABLE IF NOT EXISTS `check_writer_print_settings` (
  `id` int(11) NOT NULL auto_increment,
  `check_position` double default NULL,
  `check_type` double default NULL,
  `paper_type` double default NULL,
  `print_all_info` bit(1) default NULL,
  `print_check_num` bit(1) default NULL,
  `print_check_stub` bit(1) default NULL,
  `print_company_info` bit(1) default NULL,
  `print_bank_info` bit(1) default NULL,
  `print_payee_address` bit(1) default NULL,
  `print_micr` bit(1) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="check_writer_recurring_payments";

$ql="
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payments` (
  `payment_number` int(11) default NULL,
  `bank_account_number` varchar(50) character set utf8 default NULL,
  `payee` varchar(50) character set utf8 default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `payment_amount` double default NULL,
  `memo` varchar(150) character set utf8 default NULL,
  `voucher` double default NULL,
  `frequency` varchar(20) character set utf8 default NULL,
  `selected` bit(1) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payment_items` (
  `payment_number` int(11) default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="check_writer_undeposited_checks";

$sql="
CREATE TABLE IF NOT EXISTS `check_writer_undeposited_checks` (
  `payment_date` datetime default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `check_number` varchar(50) character set utf8 default NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `amount` double default NULL,
  `selected` bit(1) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
	if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();
	
	
	
	?>