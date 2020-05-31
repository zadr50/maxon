<?php

$table="payables";

	$sql="

CREATE TABLE IF NOT EXISTS `payables` (
  `bill_id` int(11) NOT NULL auto_increment,
  `vendor_type` int(11) default NULL,
  `supplier_number` varchar(20) character set utf8 default NULL,
  `other_number` int(11) default NULL,
  `purchase_order` tinyint(1) default NULL,
  `purchase_order_number` varchar(50) character set utf8 default NULL,
  `expense_type` varchar(50) character set utf8 default NULL,
  `account_id` int(11) default NULL,
  `invoice_number` varchar(20) character set utf8 default NULL,
  `invoice_date` datetime default NULL,
  `amount` double default NULL,
  `due_date` datetime default NULL,
  `terms` varchar(20) character set utf8 default NULL,
  `discount_taken` double default NULL,
  `purpose_of_expense` varchar(255) character set utf8 default NULL,
  `tax_deductible` tinyint(1) default NULL,
  `comments` varchar(255) default NULL,
  `paid` tinyint(1) default NULL,
  `posted` tinyint(1) default NULL,
  `posting_gl_id` varchar(50) character set utf8 default NULL,
  `batch_post` tinyint(1) default NULL,
  `X1099` tinyint(1) default NULL,
  `invoice_received` tinyint(1) default NULL,
  `items_received` tinyint(1) default NULL,
  `many_po` tinyint(1) default NULL,
  `curr_code` varchar(50) character set utf8 default NULL,
  `curr_rate` double default NULL,
  `curr_code_org` varchar(50) character set utf8 default NULL,
  `curr_rate_org` double default NULL,
  `curr_selisih` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `saldo_invoice` double default NULL,
  PRIMARY KEY (`bill_id`),
  KEY `x1` (`purchase_order_number`),
  KEY `x2` (`invoice_number`),
  KEY `x3` (`supplier_number`),
  KEY `x4` (`invoice_date`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


$table.=", payables_items";

$sql="

CREATE TABLE IF NOT EXISTS `payables_items` (
  `bill_id` int(11) default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY (`line_number`),
  KEY `x1` (`bill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


$table.=", payables_many_po";

$sql="

CREATE TABLE IF NOT EXISTS `payables_many_po` (
  `bill_id` int(11) default NULL,
  `purchase_order_number` varchar(50) character set utf8 default NULL,
  `payment_amount` double default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", payables_payments";

$sql="

CREATE TABLE IF NOT EXISTS `payables_payments` (
  `bill_id` int(11) default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `date_paid` datetime default NULL,
  `how_paid` varchar(50) character set utf8 default NULL,
  `how_paid_account_id` int(11) default NULL,
  `check_number` varchar(50) character set utf8 default NULL,
  `amount_paid` double default NULL,
  `amount_alloc` double default NULL,
  `trans_id` int(11) default NULL,
  `curr_code` varchar(50) character set utf8 default NULL,
  `curr_rate` double default NULL,
  `curr_code_org` varchar(50) character set utf8 default NULL,
  `curr_rate_org` double default NULL,
  `curr_selisih` double default NULL,
  `purchase_order_number` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `no_bukti` varchar(50) default NULL,
  `paid_by` varchar(50) default NULL,
  PRIMARY KEY (`line_number`),
  KEY `x1` (`bill_id`),
  KEY `x2` (`date_paid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


?>