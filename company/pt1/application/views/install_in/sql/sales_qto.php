<?

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."quotation` (
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
  `other` double default NULL,
  `freight` double default NULL,
  `discount` double default NULL,
  `comments` double default NULL,
  `sales_tax_code` varchar(10) character set utf8 default NULL,
  `sales_tax_percent` double(11,0) default NULL,
  `sales_tax2_code` varchar(10) character set utf8 default NULL,
  `sales_tax_percent_2` double(11,0) default NULL,
  `disc_amount_1` double default NULL,
  `disc_2` double(11,0) default NULL,
  `disc_amount_2` double default NULL,
  `disc_3` double(11,0) default NULL,
  `disc_amount_3` double default NULL,
  `create_invoice` bit(1) default NULL,
  `delivered` bit(1) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`sales_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))echo mysqli_error($link);
$sql="

CREATE TABLE IF NOT EXISTS `".$cid."quotation_lineitems` (
  `sales_order_number` varchar(50) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `item_number` varchar(50) character set utf8 default NULL,
  `quantity` double(11,0) default NULL,
  `unit` varchar(15) character set utf8 default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `price` double default NULL,
  `discount` int(11) default NULL,
  `taxable` bit(1) default NULL,
  `ship_date` datetime default NULL,
  `ship_qty` double(11,0) default NULL,
  `serial_number` varchar(50) character set utf8 default NULL,
  `job_reference` varchar(50) character set utf8 default NULL,
  `comments` double default NULL,
  `color` varchar(20) character set utf8 default NULL,
  `size` varchar(10) character set utf8 default NULL,
  `warehouse_code` varchar(15) character set utf8 default NULL,
  `amount` double default NULL,
  `forex_price` double default NULL,
  `base_curr_amount` double default NULL,
  `cost` double default NULL,
  `revenue_acct_id` int(11) default NULL,
  `currency_code` varchar(255) character set utf8 default NULL,
  `currency_rate` int(11) default NULL,
  `multi_unit` varchar(255) character set utf8 default NULL,
  `mu_qty` double(255,0) default NULL,
  `mu_harga` double default NULL,
  `discount_amount` double default NULL,
  `disc_2` double(11,0) default NULL,
  `disc_amount_2` double default NULL,
  `disc_3` double(11,0) default NULL,
  `disc_amount_3` double default NULL,
  `disc_amount_1` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);	
	
	?>