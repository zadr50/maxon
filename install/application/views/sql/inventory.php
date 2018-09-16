<?php

	$table="inventory";

	$sql="

CREATE TABLE IF NOT EXISTS `inventory` (
  `item_number` varchar(50) character set utf8 NOT NULL,
  `active` bit(1) default NULL,
  `class` varchar(50) character set utf8 default NULL,
  `category` varchar(50) character set utf8 default NULL,
  `sub_category` varchar(50) character set utf8 default NULL,
  `picking_order` int(11) default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `description` varchar(50) character set utf8 default NULL,
  `manufacturer` varchar(50) character set utf8 default NULL,
  `model` varchar(50) character set utf8 default NULL,
  `last_inventory_date` datetime default NULL,
  `cost` double default NULL,
  `cost_from_mfg` double default NULL,
  `retail` double default NULL,
  `special_features` varchar(255) default NULL,
  `item_picture` varchar(255) character set utf8 default NULL,
  `last_order_date` datetime default NULL,
  `expected_delivery` datetime default NULL,
  `lead_time` varchar(20) character set utf8 default NULL,
  `case_pack` double default NULL,
  `unit_of_measure` varchar(15) character set utf8 default NULL,
  `location` varchar(50) character set utf8 default NULL,
  `bin` varchar(50) character set utf8 default NULL,
  `weight` double default NULL,
  `weight_unit` varchar(15) character set utf8 default NULL,
  `manufacturer_item_number` varchar(50) character set utf8 default NULL,
  `upc_code` varchar(30) character set utf8 default NULL,
  `serialized` bit(1) default NULL,
  `assembly` bit(1) default NULL,
  `multiple_pricing` bit(1) default NULL,
  `multiple_warehouse` bit(1) default NULL,
  `style` bit(1) default NULL,
  `inventory_account` int(11) default NULL,
  `sales_account` int(11) default NULL,
  `cogs_account` int(11) default NULL,
  `amount_ordered` int(11) default NULL,
  `quantity_in_stock` int(11) default NULL,
  `quantity_on_back_order` int(11) default NULL,
  `quantity_on_order` int(11) default NULL,
  `reorder_point` int(11) default NULL,
  `reorder_quantity` int(11) default NULL,
  `taxable` bit(1) default NULL,
  `recordstate` int(11) default NULL,
  `gudang_1` double(11,0) default NULL,
  `gudang_2` double(11,0) default NULL,
  `gudang_3` double(11,0) default NULL,
  `gudang_4` double(11,0) default NULL,
  `gudang_5` double(11,0) default NULL,
  `gudang_6` double(11,0) default NULL,
  `gudang_7` double(11,0) default NULL,
  `gudang_8` double(11,0) default NULL,
  `gudang_9` double(11,0) default NULL,
  `gudang_10` double(11,0) default NULL,
  `total_amount` double default NULL,
  `upd_qty_asm_method` int(11) default NULL,
  `iskitchenitem` bit(1) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `custom_field_1` varchar(50) character set utf8 default NULL,
  `custom_label_1` varchar(50) character set utf8 default NULL,
  `custom_field_2` varchar(50) character set utf8 default NULL,
  `custom_label_2` varchar(50) character set utf8 default NULL,
  `custom_field_3` varchar(50) character set utf8 default NULL,
  `custom_label_3` varchar(50) character set utf8 default NULL,
  `custom_field_4` varchar(50) character set utf8 default NULL,
  `custom_label_4` varchar(50) character set utf8 default NULL,
  `custom_field_5` varchar(50) character set utf8 default NULL,
  `custom_label_5` varchar(50) character set utf8 default NULL,
  `custom_field_6` varchar(50) character set utf8 default NULL,
  `custom_label_6` varchar(50) character set utf8 default NULL,
  `custom_field_7` varchar(50) character set utf8 default NULL,
  `custom_label_7` varchar(50) character set utf8 default NULL,
  `custom_field_8` varchar(50) character set utf8 default NULL,
  `custom_label_8` varchar(50) character set utf8 default NULL,
  `custom_field_9` varchar(50) character set utf8 default NULL,
  `custom_label_9` varchar(50) character set utf8 default NULL,
  `custom_field_10` varchar(50) character set utf8 default NULL,
  `custom_label_10` varchar(50) character set utf8 default NULL,
  `qstep1` double(11,0) default NULL,
  `qstep2` double(11,0) default NULL,
  `qstep3` double(11,0) default NULL,
  `qty_awal` double default NULL,
  `discount_percent` double default NULL,
  `allowchangeprice` bit(1) default NULL,
  `allowchangedisc` bit(1) default NULL,
  `setuptime` int(11) default NULL,
  `processtime` int(11) default NULL,
  `finishtime` int(11) default NULL,
  `linkto_product1` double default NULL,
  `linkto_product2` double default NULL,
  `linkto_product3` double default NULL,
  `komisi` double default NULL,
  `isservice` bit(1) default NULL,
  `isneedprocesstime` bit(1) default NULL,
  `pricestep1` double default NULL,
  `pricestep2` double default NULL,
  `pricestep3` double default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `tax_account` int(11) default NULL,
  PRIMARY KEY  (`item_number`),
  UNIQUE KEY `ix_item` (`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory";

$sql="

INSERT INTO `inventory` (`item_number`, `active`, `class`, `category`, `sub_category`, `picking_order`, `supplier_number`, `description`, `manufacturer`, `model`, `last_inventory_date`, `cost`, `cost_from_mfg`, `retail`, `special_features`, `item_picture`, `last_order_date`, `expected_delivery`, `lead_time`, `case_pack`, `unit_of_measure`, `location`, `bin`, `weight`, `weight_unit`, `manufacturer_item_number`, `upc_code`, `serialized`, `assembly`, `multiple_pricing`, `multiple_warehouse`, `style`, `inventory_account`, `sales_account`, `cogs_account`, `amount_ordered`, `quantity_in_stock`, `quantity_on_back_order`, `quantity_on_order`, `reorder_point`, `reorder_quantity`, `taxable`, `recordstate`, `gudang_1`, `gudang_2`, `gudang_3`, `gudang_4`, `gudang_5`, `gudang_6`, `gudang_7`, `gudang_8`, `gudang_9`, `gudang_10`, `total_amount`, `upd_qty_asm_method`, `iskitchenitem`, `org_id`, `update_status`, `custom_field_1`, `custom_label_1`, `custom_field_2`, `custom_label_2`, `custom_field_3`, `custom_label_3`, `custom_field_4`, `custom_label_4`, `custom_field_5`, `custom_label_5`, `custom_field_6`, `custom_label_6`, `custom_field_7`, `custom_label_7`, `custom_field_8`, `custom_label_8`, `custom_field_9`, `custom_label_9`, `custom_field_10`, `custom_label_10`, `qstep1`, `qstep2`, `qstep3`, `qty_awal`, `discount_percent`, `allowchangeprice`, `allowchangedisc`, `setuptime`, `processtime`, `finishtime`, `linkto_product1`, `linkto_product2`, `linkto_product3`, `komisi`, `isservice`, `isneedprocesstime`, `pricestep1`, `pricestep2`, `pricestep3`, `create_date`, `create_by`, `update_date`, `update_by`, `tax_account`) VALUES
('ABC', b'1', 'Stock Item', 'MAKANAN', '''', 0, 'ALFAMART', 'Kopi Susu Abc', '01', '01', '2013-08-14 00:00:00', 900, 1, 1000, '1', '11', '2013-08-14 00:00:00', '2013-08-14 00:00:00', '', 1, 'PCS', '', '', 1, '1', '1', '', b'1', b'1', b'1', b'0', b'1', 1374, 1373, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2013-08-14 00:00:00', '', '2013-08-14 00:00:00', '', 1375),
('SLNC', b'1', 'Stock Item', 'CAT', 'OBAT', 0, 'ALFAMART', 'Salonpas Cair', '0', '0', '2013-08-14 00:00:00', 4000, 0, 5000, '', '', '2013-08-14 00:00:00', '2013-08-14 00:00:00', '', 0, 'Pcs', '', '', 0, '', '', '', b'0', b'0', b'0', b'0', b'0', 1376, 1373, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2013-08-14 00:00:00', '', '2013-08-14 00:00:00', '', 1396),
('DJISAMSU', b'0', 'Stock Item', 'MAKANAN', '', 0, 'ALFAMART', 'Djisamsu Kretek', '0', '0', '2013-08-15 00:00:00', 10000, 0, 12000, '', '', '2013-08-15 00:00:00', '2013-08-15 00:00:00', '', 0, 'Bks', '', '', 0, '', '', '', b'0', b'0', b'0', b'0', b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2013-08-15 00:00:00', '', '2013-08-15 00:00:00', '', 0),
('SAMP', b'1', 'Stock Item', 'MAKANAN', '', 0, 'ALFAMART', 'Sampoerna Hijau', '0', '0', '2013-08-12 00:00:00', 7000, 0, 8000, '', '', '2013-08-12 00:00:00', '2013-08-12 00:00:00', '', 0, 'Bks', '', '', 0, '', '', '', b'0', b'0', b'0', b'0', b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2013-08-12 00:00:00', '', '2013-08-12 00:00:00', '', 0),
('KOREK', b'1', 'Stock Item', 'MAKANAN', '', 0, 'ALFAMART', 'Korek Gas', '0', '0', '2013-08-15 00:00:00', 2000, 0, 3000, '', '', '2013-08-15 00:00:00', '2013-08-15 00:00:00', '', 0, 'Pcs', '', '', 0, '', '', '', b'0', b'0', b'0', b'0', b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2013-08-15 00:00:00', '', '2013-08-15 00:00:00', '', 0),
('Palu', b'1', 'Stock Item', 'TOOLS', '0', NULL, 'ALFAMART', 'Palu', '0', '0', '0000-00-00 00:00:00', 20000, 0, 25000, NULL, NULL, NULL, NULL, NULL, NULL, 'Pcs', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, b'0', b'0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('CD', b'1', 'Stock Item', 'TOOLS', '', 0, 'ALFAMART', 'CD Blank Maxel', '0', '0', '2013-07-09 00:00:00', 1000, 0, 2000, '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', 0, 'Pcs', '', '', 0, '', '', '', b'0', b'0', b'0', b'0', b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2013-07-09 00:00:00', '', '2013-07-09 00:00:00', '', 0),
('AQ001', b'1', 'Stock Item', 'MINUMAN', '0', NULL, 'ALFAMART', 'Aqua Gelas', '0', '0', NULL, 900, 0, 1000, NULL, NULL, NULL, NULL, NULL, NULL, 'Pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('NOK123', b'1', 'Stock Item', 'HANDPHONE', '', 0, 'KS', 'Hanphone Nokia 123', '', '', '2014-02-09 00:00:00', 0, 700000, 850000, '', '', '2014-02-09 00:00:00', '2014-02-09 00:00:00', '', 0, 'Pcs', '', '', 0, '', '', '', b'0', b'0', b'0', b'0', b'0', 1419, 1415, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2014-02-09 00:00:00', '', '2014-02-09 00:00:00', '', 1396),
('TEHKO', b'1', 'Stock Item', 'MINUMAN', '', 0, 'ALFAMART', 'Teh Kotak', '', '', '2013-09-07 00:00:00', 0, 900, 1000, '', '', '2013-09-07 00:00:00', '2013-09-07 00:00:00', '', 0, 'Pcs', '', '', 0, '', '', '', b'1', b'1', b'1', b'0', b'1', 1419, 1415, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2013-09-07 00:00:00', '', '2013-09-07 00:00:00', '', 1396),
('ffsdg', b'1', 'Stock Item', 'MINUMAN', 'MINUMAN', 0, 'ALFAMART', 'fgsdf', '', '', '2014-03-16 00:00:00', 0, 1000, 1200, '', '', '2014-03-16 00:00:00', '2014-03-16 00:00:00', '', 0, 'Pcs', '', '', 0, '', '', '', b'0', b'0', b'0', b'0', b'0', 1417, 1415, 0, 0, 0, 0, 0, 0, 0, b'0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, b'0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, 0, 0, 0, 0, b'0', b'0', 0, 0, 0, '2014-03-16 00:00:00', '', '2014-03-16 00:00:00', '', 1396);

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_assembly";

$sql="

CREATE TABLE IF NOT EXISTS `inventorysource` (
  `item_number` varchar(50) character set utf8 default NULL,
  `description` varchar(100) character set utf8 default NULL,
  `unit_of_measure` varchar(15) character set utf8 default NULL,
  `quantity_in_stock` int(11) default NULL,
  `cost` double default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_assembly";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_assembly` (
  `item_number` varchar(50) character set utf8 default NULL,
  `assembly_item_number` varchar(50) character set utf8 default NULL,
  `comment` double default NULL,
  `quantity` int(11) default NULL,
  `update_status` int(11) default NULL,
  `default_cost` double default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  UNIQUE KEY `x1` (`item_number`,`assembly_item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_categories";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_categories` (
  `kode` varchar(50) character set utf8 NOT NULL,
  `category` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `custom_label_1` varchar(50) character set utf8 default NULL,
  `custom_label_2` varchar(50) character set utf8 default NULL,
  `custom_label_3` varchar(50) character set utf8 default NULL,
  `custom_label_4` varchar(50) character set utf8 default NULL,
  `custom_label_5` varchar(50) character set utf8 default NULL,
  `custom_label_6` varchar(50) character set utf8 default NULL,
  `custom_label_7` varchar(50) character set utf8 default NULL,
  `custom_label_8` varchar(50) character set utf8 default NULL,
  `custom_label_9` varchar(50) character set utf8 default NULL,
  `custom_label_10` varchar(50) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `parent_id` varchar(50) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_categories";

$sql="

INSERT INTO `inventory_categories` (`kode`, `category`, `update_status`, `custom_label_1`, `custom_label_2`, `custom_label_3`, `custom_label_4`, `custom_label_5`, `custom_label_6`, `custom_label_7`, `custom_label_8`, `custom_label_9`, `custom_label_10`, `sourceautonumber`, `sourcefile`, `parent_id`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
('MAKANAN', 'MAKANAN', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2013-08-12 00:00:00', '', '2013-08-12 00:00:00', ''),
('MINUMAN', 'MINUMAN', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2013-08-14 00:00:00', '', '2013-08-14 00:00:00', ''),
('CAT', 'CAT', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2013-08-14 00:00:00', '', '2013-08-14 00:00:00', ''),
('TOOLS', 'TOOLS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('MAINAN', 'MAINAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('OBAT', 'OBAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PAKAIAN', 'PAKAIAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('HANDPHONE', 'HANDPHONE', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2013-09-07 00:00:00', '', '2013-09-07 00:00:00', ''),
('MOBIL', 'MOBIL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_class";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_class` (
  `kode` varchar(50) character set utf8 default NULL,
  `class` varchar(50) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`kode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_class";

 
$sql="
INSERT INTO `inventory_class` (`kode`, `class`, `id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
('Stock Item', 'Stock Item', 6, NULL, NULL, NULL),
('Service', 'Service', 7, NULL, NULL, NULL),
('Employee', 'Employee', 8, NULL, NULL, NULL),
('Labour', 'Labour', 9, NULL, NULL, NULL),
('Material', 'Material', 14, NULL, NULL, NULL);

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_moving";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_moving` (
  `transfer_id` varchar(50) character set utf8 default NULL,
  `item_number` varchar(50) character set utf8 default NULL,
  `date_trans` datetime default NULL,
  `from_location` varchar(50) character set utf8 default NULL,
  `from_qty` int(11) default NULL,
  `to_location` varchar(50) character set utf8 default NULL,
  `to_qty` int(11) default NULL,
  `trans_by` varchar(50) character set utf8 default NULL,
  `cost` double default NULL,
  `update_status` int(11) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `comments` varchar(250) character set utf8 default NULL,
  `trans_type` varchar(10) default NULL,
  `total_amount` double default NULL,
  `unit` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`transfer_id`,`item_number`,`date_trans`,`from_location`,`to_location`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_prices";

$sql="

INSERT INTO `inventory_moving` (`transfer_id`, `item_number`, `date_trans`, `from_location`, `from_qty`, `to_location`, `to_qty`, `trans_by`, `cost`, `update_status`, `id`, `comments`, `trans_type`, `total_amount`, `unit`) VALUES
('TRX00002', 'NOK123', '2014-03-26 11:08:52', 'Ambon', 1, 'Bali', 1, NULL, 0, NULL, 33, '', NULL, 0, 'Pcs'),
('TRX00002', 'AQ001', '2014-03-26 11:08:52', 'Ambon', 1, 'Bali', 1, NULL, 900, NULL, 32, '', NULL, 900, 'Pcs'),
('TRX00002', 'DJISAMSU', '2014-03-26 11:08:52', 'Ambon', 1, 'Bali', 1, NULL, 10000, NULL, 31, '', NULL, 10000, 'Bks');

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

CREATE TABLE IF NOT EXISTS `inventory_prices` (
  `item_number` varchar(50) character set utf8 default NULL,
  `customer_pricing_code` varchar(10) character set utf8 default NULL,
  `retail` double default NULL,
  `quantity_high` int(11) default NULL,
  `quantity_low` int(11) default NULL,
  `date_from` datetime default NULL,
  `date_to` datetime default NULL,
  `update_status` int(11) default NULL,
  UNIQUE KEY `x1` (`item_number`,`customer_pricing_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="inventory_price_history";

$sql="

CREATE TABLE IF NOT EXISTS `inventory_price_history` (
  `item_number` varchar(50) character set utf8 default NULL,
  `date_changed` datetime default NULL,
  `po_or_so` varchar(50) character set utf8 default NULL,
  `sales_price` double default NULL,
  `order_price` double default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
 
	
	
	