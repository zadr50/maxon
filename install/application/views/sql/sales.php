<?php
 
	$table="sales_order";

	$sql="

CREATE TABLE IF NOT EXISTS `sales_order` (
  `sales_order_number` varchar(22) character set utf8 NOT NULL,
  `invoice_number` varchar(20) character set utf8 default NULL,
  `type_of_invoice` varchar(50) character set utf8 default NULL,
  `sold_to_customer` varchar(15) character set utf8 default NULL,
  `ship_to_customer` varchar(15) character set utf8 default NULL,
  `sales_date` datetime default NULL,
  `your_order__` varchar(20) character set utf8 default NULL,
  `source_of_order` varchar(50) character set utf8 default NULL,
  `payment_terms` varchar(20) character set utf8 default NULL,
  `salesman` varchar(30) character set utf8 default NULL,
  `shipped_via` varchar(20) character set utf8 default NULL,
  `tax` double default NULL,
  `tax_2` double default NULL,
  `freight` double default NULL,
  `discount` double default NULL,
  `other` double default NULL,
  `back_order` bit(1) default NULL,
  `comments` varchar(255) default NULL,
  `sales_tax_code` varchar(10) character set utf8 default NULL,
  `sales_tax_percent` double default NULL,
  `sales_tax2_code` varchar(10) character set utf8 default NULL,
  `sales_tax_percent_2` double(11,0) default NULL,
  `create_invoice` bit(1) default NULL,
  `disc_amount_1` double default NULL,
  `disc_2` int(11) default NULL,
  `disc_amount_2` double default NULL,
  `disc_3` int(11) default NULL,
  `disc_amount_3` double default NULL,
  `delivered` int(1) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `uang_muka` double default NULL,
  `amount` double default NULL,
  `saldo` double default NULL,
  `close_by` varchar(50) character set utf8 default NULL,
  `close_date` datetime default NULL,
  `close_memo` varchar(200) character set utf8 default NULL,
  `approved` bit(1) default NULL,
  `appr_by` varchar(50) character set utf8 default NULL,
  `appr_date` varchar(50) character set utf8 default NULL,
  `appr_memo` varchar(200) character set utf8 default NULL,
  `status` int(11) default NULL,
  `cancel_by` varchar(50) character set utf8 default NULL,
  `cancel_date` datetime default NULL,
  `cancel_memo` varchar(200) character set utf8 default NULL,
  `pending_by` varchar(50) character set utf8 default NULL,
  `pending_date` datetime default NULL,
  `pending_memo` varchar(200) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `due_date` datetime default NULL,
  `currency_code` varchar(50) default NULL,
  `currency_rate` double default NULL,
  `subtotal` double default NULL,
  `ship_date` datetime default NULL,
  `warehouse_code` varchar(50) default NULL,
  `account_id` int(11) default NULL,
  `paid` int(1) default NULL,
  `ship_day` varchar(50) DEFAULT NULL,
  `ship_weight` varchar(50) DEFAULT NULL,
  `ship_no` varchar(50) DEFAULT NULL,
  `supplier_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sales_order_number`),
  KEY `x1` (`sold_to_customer`),
  KEY `x2` (`sales_date`),
  KEY `x3` (`warehouse_code`),
  KEY `x4` (`salesman`),
  KEY `x5` (`shipped_via`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


$sql="

CREATE TABLE IF NOT EXISTS `sales_order_lineitems` (
  `sales_order_number` varchar(22) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `item_number` varchar(50) character set utf8 default NULL,
  `quantity` double(11,0) default NULL,
  `unit` varchar(15) character set utf8 default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `price` double default NULL,
  `discount` double(11,2) default NULL,
  `taxable` int(1) default NULL,
  `shipped` int(1) default NULL,
  `ship_date` datetime default NULL,
  `ship_qty` double(11,0) default NULL,
  `bo_qty` double(11,0) default NULL,
  `prev_ship_qty` double(11,0) default NULL,
  `serial_number` varchar(50) character set utf8 default NULL,
  `job_reference` varchar(50) character set utf8 default NULL,
  `comments` varchar(255) default NULL,
  `cost` double default NULL,
  `color` varchar(20) character set utf8 default NULL,
  `size` varchar(10) character set utf8 default NULL,
  `warehouse_code` varchar(15) character set utf8 default NULL,
  `revenue_acct_id` int(11) default NULL,
  `amount` double default NULL,
  `currency_code` varchar(50) character set utf8 default NULL,
  `currency_rate` double default NULL,
  `multi_unit` varchar(50) character set utf8 default NULL,
  `mu_qty` double(11,0) default NULL,
  `mu_harga` double default NULL,
  `discount_amount` double default NULL,
  `forex_price` double default NULL,
  `base_curr_amount` double default NULL,
  `disc_2` double(11,0) default NULL,
  `disc_amount_2` double default NULL,
  `disc_3` double(11,0) default NULL,
  `disc_amount_3` double default NULL,
  `disc_amount_1` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY (`line_number`),
  KEY `x1` (`sales_order_number`),
  KEY `x2` (`warehouse_code`),
  KEY `x3` (`item_number`),
  KEY `x4` (`description`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", sales_tax_rates";

$sql="

CREATE TABLE IF NOT EXISTS `sales_tax_rates` (
  `code` varchar(10) character set utf8 NOT NULL,
  `tax_rate` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", shipped_via";

$sql="

CREATE TABLE IF NOT EXISTS `shipped_via` (
  `shipped_via` varchar(50) character set utf8 NOT NULL,
  `address_1` varchar(255) character set utf8 default NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `contact_name` varchar(50) character set utf8 default NULL,
  `address_2` varchar(50) character set utf8 default NULL,
  `telp_1` varchar(50) character set utf8 default NULL,
  `telp_2` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`shipped_via`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", source_of_order";

$sql="

CREATE TABLE IF NOT EXISTS `source_of_order` (
  `source_of_order` varchar(50) character set utf8 NOT NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`source_of_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
?>