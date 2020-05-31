<?php

$table="inventory_products";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_products` (
  `id` int(11) NOT NULL auto_increment,
  `item_number` varchar(50) character set utf8 default NULL,
  `shipment_id` varchar(50) character set utf8 default NULL,
  `date_received` datetime default NULL,
  `cost` double default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `warehouse_code` varchar(15) character set utf8 default NULL,
  `color` varchar(20) character set utf8 default NULL,
  `size` varchar(10) character set utf8 default NULL,
  `purchase_order_number` varchar(50) character set utf8 default NULL,
  `quantity_in_stock` int(11) default NULL,
  `quantity_received` int(11) default NULL,
  `total_amount` double default NULL,
  `selected` tinyint(1) default NULL,
  `other_doc_number` varchar(50) character set utf8 default NULL,
  `receipt_type` varchar(50) character set utf8 default NULL,
  `receipt_by` varchar(50) character set utf8 default NULL,
  `comments` varchar(250) default NULL,
  `production_code` varchar(50) character set utf8 default NULL,
  `unit` varchar(50) character set utf8 default NULL,
  `multi_unit` varchar(50) character set utf8 default NULL,
  `mu_qty` int(11) default NULL,
  `mu_price` double default NULL,
  `new_cost` double default NULL,
  `from_line_number` int(11) default NULL,
  `tanggal_jual` datetime default NULL,
  `no_faktur_beli` varchar(50) character set utf8 default NULL,
  `no_faktur_jual` varchar(50) character set utf8 default NULL,
  `no_do_jual` varchar(50) character set utf8 default NULL,
  `tanggal_beli` datetime default NULL,
  `no_retur_jual` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `serial_number` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `retail` double default NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`item_number`,`shipment_id`),
  KEY `x2` (`shipment_id`),
  KEY `x3` (`receipt_type`),
  KEY `x4` (`warehouse_code`),
  KEY `x6` (`purchase_order_number`),
  KEY `x7` (`purchase_order_number`,`from_line_number`),
  KEY `x5` (`date_received`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


$table.=", inventory_promotion";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_promotion` (
  `kode` varchar(20) character set utf8 NOT NULL,
  `datefrom` datetime default NULL,
  `dateto` datetime default NULL,
  `discpercent` int(11) default NULL,
  `nominal` double default NULL,
  `keterangan` varchar(200) character set utf8 default NULL,
  `promotype` varchar(10) character set utf8 default NULL,
  `sundayprc` double(11,0) default NULL,
  `mondayprc` double(11,0) default NULL,
  `tuesdayprc` double(11,0) default NULL,
  `wednesdayprc` double(11,0) default NULL,
  `thursdayprc` double(11,0) default NULL,
  `fridayprc` double(11,0) default NULL,
  `saturdayprc` double(11,0) default NULL,
  `active` bit(1) default NULL,
  `update_status` double(11,0) default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", inventory_sales_disc";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_sales_disc` (
  `item_number` varchar(50) character set utf8 default NULL,
  `category` varchar(50) character set utf8 default NULL,
  `datefrom` datetime default NULL,
  `timefrom` datetime default NULL,
  `sunday` double(11,0) default NULL,
  `monday` double(11,0) default NULL,
  `tuesday` double(11,0) default NULL,
  `wednesday` double(11,0) default NULL,
  `thursday` double(11,0) default NULL,
  `friday` double(11,0) default NULL,
  `saturday` double(11,0) default NULL,
  `update_status` double(11,0) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", inventory_serialized_items";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_serialized_items` (
  `item_number` varchar(50) character set utf8 default NULL,
  `shipment_id` varchar(50) character set utf8 default NULL,
  `serial_number` varchar(50) character set utf8 default NULL,
  `date_received` datetime default NULL,
  `comment` varchar(50) character set utf8 default NULL,
  `date_activated` datetime default NULL,
  `date_expired` datetime default NULL,
  `status` int(11) default NULL,
  `month_guaranted` int(11) default NULL,
  `tanggal_jual` datetime default NULL,
  `no_faktur_beli` varchar(50) character set utf8 default NULL,
  `no_faktur_jual` varchar(50) character set utf8 default NULL,
  `no_do_jual` varchar(50) character set utf8 default NULL,
  `tanggal_beli` datetime default NULL,
  `no_retur_beli` varchar(50) character set utf8 default NULL,
  `no_retur_jual` varchar(50) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`item_number`,`serial_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", inventory_suppliers";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_suppliers` (
  `item_number` varchar(50) character set utf8 default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `supplier_item_number` varchar(50) character set utf8 default NULL,
  `lead_time` varchar(20) character set utf8 default NULL,
  `cost` double default NULL,
  `update_status` int(11) default NULL,
  UNIQUE KEY `x1` (`item_number`,`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.=", inventory_warehouse";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_warehouse` (
  `item_number` varchar(50) character set utf8 default NULL,
  `warehouse_code` varchar(50) character set utf8 default NULL,
  `quantity` int(11) default NULL,
  `reorderlevel` int(11) default NULL,
  `lastorderdate` datetime default NULL,
  `lastorderqty` int(11) default NULL,
  `whtype` int(11) default NULL,
  `update_status` int(11) default NULL,
  `unit` varchar(50) character set utf8 default NULL,
  `max_qty` int(11) default NULL,
  `opening_qty` int(11) default NULL,
  `trx_qty` int(11) default NULL,
  `ending_qty` int(11) default NULL,
  `price` double default NULL,
  `discount` int(11) default NULL,
  `topten` int(11) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `sc_able` bit(1) default NULL,
  `tax_abcle` bit(1) default NULL,
  `ignore_qty_check` bit(1) default NULL,
  `sales_commision_percent` bit(1) default NULL,
  `cost` double default NULL,
  `manufacturer` varchar(50) character set utf8 default NULL,
  `model` varchar(50) character set utf8 default NULL,
  `qstep1` int(11) default NULL,
  `pricestep1` double default NULL,
  `qstep2` int(11) default NULL,
  `pricestep2` double default NULL,
  `qstep3` int(11) default NULL,
  `pricestep3` double default NULL,
  `minprice` double default NULL,
  `matrix` int(11) default NULL,
  `description` varchar(250) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`item_number`,`warehouse_code`),
  KEY `x2` (`item_number`),
  KEY `x3` (`warehouse_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


?>