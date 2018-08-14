

-- Dumping structure for table simak.hr_pph_form
CREATE TABLE IF NOT EXISTS `hr_pph_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelompok` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nomor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `header` int DEFAULT NULL,
  `rumus` varchar(250) DEFAULT NULL,
  `template` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_pph_form: 0 rows
/*!40000 ALTER TABLE `hr_pph_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_pph_form` ENABLE KEYS */;


-- Dumping structure for table simak.hr_ptkp
CREATE TABLE IF NOT EXISTS `hr_ptkp` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_ptkp: 5 rows
/*!40000 ALTER TABLE `hr_ptkp` DISABLE KEYS */;
REPLACE INTO `hr_ptkp` (`kode`, `keterangan`, `jumlah`) VALUES
	('K0', 'KAWIN ANAK 0', 26326000),
	('K1', 'KAWIN ANAK 1', 28350000),
	('K2', 'KAWIN ANAK 2', 30375000),
	('K3', 'KAWIN ANAK 3', 32400000),
	('TK', 'BELUM KAWIN', 24300000);
/*!40000 ALTER TABLE `hr_ptkp` ENABLE KEYS */;


-- Dumping structure for table simak.hr_shift
CREATE TABLE IF NOT EXISTS `hr_shift` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `different_day` int DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_shift: 0 rows
/*!40000 ALTER TABLE `hr_shift` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_shift` ENABLE KEYS */;


-- Dumping structure for table simak.inventory
CREATE TABLE IF NOT EXISTS `inventory` (
  `item_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int DEFAULT NULL,
  `class` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sub_category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `picking_order` int(11) DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `manufacturer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_inventory_date` datetime DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `cost_from_mfg` double DEFAULT NULL,
  `retail` double DEFAULT NULL,
  `special_features` varchar(1000) DEFAULT NULL,
  `item_picture` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_order_date` datetime DEFAULT NULL,
  `expected_delivery` datetime DEFAULT NULL,
  `lead_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `case_pack` double DEFAULT NULL,
  `unit_of_measure` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bin` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `weight_unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `manufacturer_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `upc_code` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `serialized` int DEFAULT NULL,
  `assembly` int DEFAULT NULL,
  `multiple_pricing` int DEFAULT NULL,
  `multiple_warehouse` int DEFAULT NULL,
  `style` int DEFAULT NULL,
  `inventory_account` int(11) DEFAULT NULL,
  `sales_account` int(11) DEFAULT NULL,
  `cogs_account` int(11) DEFAULT NULL,
  `amount_ordered` int(11) DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `quantity_on_back_order` int(11) DEFAULT NULL,
  `quantity_on_order` int(11) DEFAULT NULL,
  `reorder_point` int(11) DEFAULT NULL,
  `reorder_quantity` int(11) DEFAULT NULL,
  `taxable` int DEFAULT NULL,
  `recordstate` int(11) DEFAULT NULL,
  `gudang_1` double(11,0) DEFAULT NULL,
  `gudang_2` double(11,0) DEFAULT NULL,
  `gudang_3` double(11,0) DEFAULT NULL,
  `gudang_4` double(11,0) DEFAULT NULL,
  `gudang_5` double(11,0) DEFAULT NULL,
  `gudang_6` double(11,0) DEFAULT NULL,
  `gudang_7` double(11,0) DEFAULT NULL,
  `gudang_8` double(11,0) DEFAULT NULL,
  `gudang_9` double(11,0) DEFAULT NULL,
  `gudang_10` double(11,0) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `upd_qty_asm_method` int(11) DEFAULT NULL,
  `iskitchenitem` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `custom_field_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_6` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_6` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_7` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_7` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_8` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_8` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_9` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_9` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_10` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_10` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qstep1` double(11,0) DEFAULT NULL,
  `qstep2` double(11,0) DEFAULT NULL,
  `qstep3` double(11,0) DEFAULT NULL,
  `qty_awal` double DEFAULT NULL,
  `discount_percent` double DEFAULT NULL,
  `allowchangeprice` int DEFAULT NULL,
  `allowchangedisc` int DEFAULT NULL,
  `setuptime` int(11) DEFAULT NULL,
  `processtime` int(11) DEFAULT NULL,
  `finishtime` int(11) DEFAULT NULL,
  `linkto_product1` double DEFAULT NULL,
  `linkto_product2` double DEFAULT NULL,
  `linkto_product3` double DEFAULT NULL,
  `komisi` double DEFAULT NULL,
  `isservice` int DEFAULT NULL,
  `isneedprocesstime` int DEFAULT NULL,
  `pricestep1` double DEFAULT NULL,
  `pricestep2` double DEFAULT NULL,
  `pricestep3` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tax_account` int(11) DEFAULT NULL,
  `item_picture2` varchar(50) DEFAULT NULL,
  `item_picture3` varchar(50) DEFAULT NULL,
  `item_picture4` varchar(50) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `sales_count` int(11) DEFAULT NULL,
  `condition` varchar(50) DEFAULT NULL,
  `insr_name` varchar(50) DEFAULT NULL,
  `sales_min` int(11) DEFAULT NULL,
  `delivery_by` varchar(150) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory: 632 rows
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
REPLACE INTO `inventory` (`item_number`, `active`, `class`, `category`, `sub_category`, `picking_order`, `supplier_number`, `description`, `manufacturer`, `model`, `last_inventory_date`, `cost`, `cost_from_mfg`, `retail`, `special_features`, `item_picture`, `last_order_date`, `expected_delivery`, `lead_time`, `case_pack`, `unit_of_measure`, `location`, `bin`, `weight`, `weight_unit`, `manufacturer_item_number`, `upc_code`, `serialized`, `assembly`, `multiple_pricing`, `multiple_warehouse`, `style`, `inventory_account`, `sales_account`, `cogs_account`, `amount_ordered`, `quantity_in_stock`, `quantity_on_back_order`, `quantity_on_order`, `reorder_point`, `reorder_quantity`, `taxable`, `recordstate`, `gudang_1`, `gudang_2`, `gudang_3`, `gudang_4`, `gudang_5`, `gudang_6`, `gudang_7`, `gudang_8`, `gudang_9`, `gudang_10`, `total_amount`, `upd_qty_asm_method`, `iskitchenitem`, `org_id`, `update_status`, `custom_field_1`, `custom_label_1`, `custom_field_2`, `custom_label_2`, `custom_field_3`, `custom_label_3`, `custom_field_4`, `custom_label_4`, `custom_field_5`, `custom_label_5`, `custom_field_6`, `custom_label_6`, `custom_field_7`, `custom_label_7`, `custom_field_8`, `custom_label_8`, `custom_field_9`, `custom_label_9`, `custom_field_10`, `custom_label_10`, `qstep1`, `qstep2`, `qstep3`, `qty_awal`, `discount_percent`, `allowchangeprice`, `allowchangedisc`, `setuptime`, `processtime`, `finishtime`, `linkto_product1`, `linkto_product2`, `linkto_product3`, `komisi`, `isservice`, `isneedprocesstime`, `pricestep1`, `pricestep2`, `pricestep3`, `create_date`, `create_by`, `update_date`, `update_by`, `tax_account`, `item_picture2`, `item_picture3`, `item_picture4`, `view_count`, `sales_count`, `condition`, `insr_name`, `sales_min`, `delivery_by`, `division`) VALUES
	('0', NULL, 'Non Stock', NULL, NULL, 0, NULL, 'Opening Balance', NULL, NULL, '2015-11-01 17:59:47', 5000000, 5000000, 0, '0', NULL, '2015-11-23 00:00:00', '2015-11-23 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '0', 'Ñ01Ó', NULL, NULL, NULL, NULL, NULL, 2409, 2409, 2409, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000000, 0, NULL, NULL, 1, NULL, 'Custom Field 0', NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 2409, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00002', NULL, 'Stock Item', 'Komputer', 'KOM', -17, 'MM', 'Komputer Desktop Presario GLX 1001 White Green', '.', '2500000', '2016-02-19 16:26:50', 2500000, 2500000, 27500000, '0', 'D:gambar2602.jpg', '2016-02-19 16:26:05', '2012-10-22 00:00:00', '32', 0, 'pcs', 'R1.3.S2', NULL, 0, NULL, '00002', 'Ò  Í2aÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 1419, 25000000, 892, 0, 1, 0, 2, NULL, 1, 0, 765, 10, 9, 0, 108, 0, 0, 0, 0, 2252750000, 0, NULL, NULL, 1, 'DIMEN1', 'Custom 0', '2mm', 'Custom 1', 'Silver', 'Custom 2', 'Custom 0', 'Custom 3', 'Pavilon', 'Custom 4', 'Section 1', 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 43, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00004', NULL, 'Stock Item', 'Komputer', NULL, -4, 'JKT.KI', 'Keyboard Logitech', NULL, '6872.6599999999999', '2016-02-17 14:01:27', 5600, 10000, 5600, '0', '0', '2016-02-17 13:43:54', '2013-10-07 00:00:00', '32', 0, '.', 'A21', NULL, 0, NULL, '00004', 'Ò  Í4iÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 100000, 210, 100, 5, 0, 4, NULL, 1, 0, 205, -1, -1, 0, 7, 0, 0, 0, 0, 2240000, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 477, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00005', NULL, 'Stock Item', 'Komputer', NULL, -5, 'ALFAMART', 'Printer Epson LX300', NULL, '1100000', '2016-02-19 16:26:50', 500000, 500000, 1100000, '0', '0', '2016-02-19 16:26:05', '2014-02-15 00:00:00', '1', 0, 'PCS', 'MM', NULL, 0, NULL, '00005', 'Ò  Í5mÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 30000000, 124, 0, 0, 0, 0, NULL, 1, 0, 12, 107, 0, 0, 6, 0, -1, 0, 0, 64980620.46, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00007', NULL, 'Stock Item', 'MINUMAN', NULL, 18, '5', 'Mizone', '.', '1500', '2016-02-17 14:02:11', 0, 3500, 1700, '0', NULL, '2016-02-17 14:01:56', '2010-08-04 00:00:00', '47', 0, 'Btl', 'A100', NULL, 0, NULL, '00007', 'Ò  Í7uÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 80500, 312, 0, -170, 0, 31, NULL, 1, 0, 247, 80, 0, 0, -15, 0, 0, 0, 0, 1281000, 0, NULL, NULL, 1, '0.15540000000000001', 'Custom 1', '5.4300000000000001E-2', 'Custom 2', '0', 'Custom 3', 'Custom 0', 'AQUA', '0', 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 3000, 2000, 3000, 713, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 10, 20, 2000, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00012', NULL, 'Stock Item', 'Rumah', NULL, 0, '0', 'Garasi Tambahan', NULL, '0', '2015-11-13 17:47:40', 0, 0, 0, '0', NULL, '2013-11-22 21:59:28', '2010-09-23 00:00:00', ' ', 0, 'Unit', NULL, NULL, 0, NULL, '00012', 'Ò !Í2cÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 2, -1, 0, 0, 2, 1, NULL, 1, 0, -1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00021', NULL, 'Stock Item', 'Minuman', NULL, 0, '1', 'Teh Tarik', '.', '900', '2016-01-15 12:31:30', 3000, 3000, 1000, '0', 'D:prgmvb	alagaaccpropro3IMAGES\receive.bmp', '2016-01-15 12:28:37', '2011-05-09 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00021', 'Ò "Í1aÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 1418000000, 985, 0, 0, 0, 6, NULL, 1, 0, 985, 0, 0, 0, 0, 0, 0, 0, 0, 5973000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', '.', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 1000, 900, 800, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 10, 20, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00022', NULL, 'Stock Item', 'KAYU', NULL, 0, '0', 'Korek Api Gas', NULL, '1000', '2014-10-22 14:11:36', -1, 2000, 1200, '0', NULL, '2015-11-18 07:24:53', '2011-06-12 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00022', 'Ò "Í2eÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 20000, -11, 0, 0, 26, 15, NULL, 1, 0, -6, 0, 0, 0, -5, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00028', NULL, 'Stock Item', 'MAKANAN', NULL, -2, '0', 'Donat', NULL, '0', '2015-11-17 21:44:46', 5000, 5000, 6000, '0', NULL, '2016-01-17 07:17:06', '2011-10-23 00:00:00', '125', 0, 'Pcs', NULL, NULL, 0, NULL, '00028', 'Ò "Í8}Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 325000, 8998, 0, 5, 0, 1005, NULL, 1, 0, 10000, 0, 0, -1002, 0, 0, 0, 0, 0, 100035000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00029', NULL, 'Stock Item', 'BOLA', NULL, 0, '5', 'USB Flashdisk', NULL, '1000', '2015-11-28 08:36:36', 0, 0, 20000, '0', NULL, '2015-11-13 17:46:27', '2011-11-16 00:00:00', ' ', 0, 'pcs', NULL, NULL, 0, NULL, '00029', 'Ò "Í9ÊÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 990, 27, 0, 0, 0, 3, NULL, 1, 0, -3, 0, 30, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 20000, 18000, 15000, -8, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 10, 20, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00036', NULL, 'Stock Item', 'CAT', NULL, 0, '0', 'SAMSUNG GALAXY MINI', NULL, '800', '2016-02-17 13:29:04', 3500000, 3500000, 900, '0', NULL, '2015-11-19 22:08:33', '2012-09-13 00:00:00', ' ', 0, 'PCS', NULL, NULL, 0, NULL, '00036', 'Ò #Í6wÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 42304000, 6, 0, 0, 0, 0, NULL, 0, 0, 11, 0, 0, -5, 0, 0, 0, 0, 0, 42000000, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 79, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00040', NULL, 'Stock Item', 'Komputer', NULL, 0, '0', 'Komputer Server', NULL, '0', '2016-02-17 13:29:04', 4000000, 4000000, 1000000, '0', NULL, '2015-11-19 22:08:33', '2012-10-22 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00040', 'Ò $Í0aÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 21304000, -9, 0, 0, 24, 15, NULL, 0, 0, -4, 0, 0, 0, -5, 0, 0, 0, 0, 21999999.98, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00054', NULL, 'Stock Item', 'MAKANAN', NULL, 0, '0', 'Kopi ABC Sachet', NULL, '1000', '2013-06-05 16:01:03', -2, 0, 1200, '0', NULL, '2013-06-05 10:26:41', '2011-03-11 00:00:00', ' ', 0, 'pcs', NULL, NULL, 0, NULL, '00019', 'Ò %Í4sÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', 'ABC', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00057', NULL, 'Stock Item', 'Makanan', NULL, -1, '0', 'Rokok Star Mild', NULL, '1000', '2015-11-13 17:47:40', 0, 0, 1200, '0', NULL, '2015-11-13 17:46:27', '2013-06-24 00:00:00', ' ', 0, 'Bks', NULL, NULL, 0, NULL, '00057', 'Ò %Í7ÈÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 990, 1, 0, 0, 0, 0, NULL, 1, 3, 0, 0, -2, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00065', NULL, 'Stock Item', '10', NULL, 0, '0', 'Pahemat', NULL, '12900', '2014-05-03 00:00:00', 2, 0, 0, '0', NULL, '2015-02-04 17:47:45', '2014-05-03 00:00:00', ' ', 0, 'set', NULL, NULL, 0, NULL, '00065', 'Ò &Í5yÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 19900, 0, 0, 4, 0, 0, NULL, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100', NULL, NULL, 'Baju Anak', NULL, 0, NULL, 'Baju Anak Koko', NULL, NULL, '2016-01-15 12:31:30', 50000, 50000, 10000, '0', NULL, '2016-01-15 12:28:37', '2016-01-15 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1415000000, 187, 0, 0, 0, 1, NULL, 1, 0, 187, 0, 0, 0, 0, 0, 0, 0, 0, 19400000, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100001', NULL, 'Stock', 'Keramik', NULL, 3, 'CATUR', 'Keramik Roman 30x30', NULL, NULL, '2016-02-18 00:00:00', 50000, 50000, 100000, '0', NULL, '2016-02-19 14:16:57', '2016-02-18 00:00:00', ' ', 0, 'BOX', NULL, NULL, 0, NULL, '100001', 'Ò* !/Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 5500000, 35, 0, 75, 0, 0, NULL, 0, 0, 10, 0, 0, 15, 10, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10201', NULL, 'Stock Item', 'Baju', NULL, 0, '3', 'Celana Jeans Pria', '.', '120000', '2016-01-16 16:01:03', 120000, 120000, 132000, '0', NULL, '2015-02-04 17:47:45', '2013-06-22 00:00:00', '65', 0, 'Pcs', NULL, NULL, 0, NULL, NULL, 'Ò*4Í1(Ó', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1339900, 0, 0, 0, 0, 0, NULL, 0, 0, -4, 0, 0, -1, 0, 0, 0, 0, 0, 1878319.61, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40000, 20000, 0, 0, 0, NULL, NULL, 30, 30, 30, 0, 0, 0, 0, NULL, NULL, 5, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12', NULL, 'Stock Item', 'CAT', NULL, 0, '0', 'cat base', '.', '0', '2014-05-29 00:00:00', 1, 0, 0, '0', NULL, '2015-02-04 17:47:45', '2014-05-29 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Ñ12VÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1339900, 0, 0, 0, 1, 1, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -9, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CASGBRHB4', b'10000000', 'Stock Item', 'Stock Item', 'ASG', NULL, 'Megatex', 'CASUAL BR HB4', NULL, NULL, NULL, 0, 0, 80500, NULL, NULL, NULL, NULL, NULL, NULL, 'Lusin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;


-- Dumping structure for table simak.inventorysource
CREATE TABLE IF NOT EXISTS `inventorysource` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `unit_of_measure` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventorysource: 0 rows
/*!40000 ALTER TABLE `inventorysource` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventorysource` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_assembly
CREATE TABLE IF NOT EXISTS `inventory_assembly` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `assembly_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `default_cost` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`assembly_item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_assembly: 0 rows
/*!40000 ALTER TABLE `inventory_assembly` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_assembly` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_beginning_balance
CREATE TABLE IF NOT EXISTS `inventory_beginning_balance` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `amount_awal` double DEFAULT NULL,
  `amount_trans` double DEFAULT NULL,
  `amount_akhir` double DEFAULT NULL,
  `qty_awal_gd1` int(11) DEFAULT NULL,
  `qty_trans_gd1` int(11) DEFAULT NULL,
  `qty_akhir_gd1` int(11) DEFAULT NULL,
  `qty_awal_gd2` int(11) DEFAULT NULL,
  `qty_trans_gd2` int(11) DEFAULT NULL,
  `qty_akhir_gd2` int(11) DEFAULT NULL,
  `qty_awal_gd3` int(11) DEFAULT NULL,
  `qty_trans_gd3` int(11) DEFAULT NULL,
  `qty_akhir_gd3` int(11) DEFAULT NULL,
  `qty_awal_gd4` int(11) DEFAULT NULL,
  `qty_trans_gd4` int(11) DEFAULT NULL,
  `qty_akhir_gd4` int(11) DEFAULT NULL,
  `qty_awal_gd5` int(11) DEFAULT NULL,
  `qty_trans_gd5` int(11) DEFAULT NULL,
  `qty_akhir_gd5` int(11) DEFAULT NULL,
  `qty_awal_gd6` int(11) DEFAULT NULL,
  `qty_trans_gd6` int(11) DEFAULT NULL,
  `qty_akhir_gd6` int(11) DEFAULT NULL,
  `qty_awal_gd7` int(11) DEFAULT NULL,
  `qty_trans_gd7` int(11) DEFAULT NULL,
  `qty_akhir_gd7` int(11) DEFAULT NULL,
  `qty_awal_gd8` int(11) DEFAULT NULL,
  `qty_trans_gd8` int(11) DEFAULT NULL,
  `qty_akhir_gd8` int(11) DEFAULT NULL,
  `qty_awal_gd9` int(11) DEFAULT NULL,
  `qty_trans_gd9` int(11) DEFAULT NULL,
  `qty_akhir_gd9` int(11) DEFAULT NULL,
  `qty_awal_gd10` int(11) DEFAULT NULL,
  `qty_trans_gd10` int(11) DEFAULT NULL,
  `qty_akhir_gd10` int(11) DEFAULT NULL,
  `ttlqty_awal` int(11) DEFAULT NULL,
  `ttlqty_trans` int(11) DEFAULT NULL,
  `ttlqty_akhir` int(11) DEFAULT NULL,
  `qtyin` int(11) DEFAULT NULL,
  `qtyout` int(11) DEFAULT NULL,
  `amountin` double DEFAULT NULL,
  `amountout` double DEFAULT NULL,
  `flagawal` int DEFAULT NULL,
  `hpp_awal` double DEFAULT NULL,
  `hpp_akhir` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`tanggal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_beginning_balance: 0 rows
/*!40000 ALTER TABLE `inventory_beginning_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_beginning_balance` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_categories
CREATE TABLE IF NOT EXISTS `inventory_categories` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `custom_label_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_6` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_7` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_8` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_9` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_10` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `parent_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_picture` varchar(150) DEFAULT NULL,
  `description` varchar(350) DEFAULT NULL,
  `icon_picture` varchar(150) DEFAULT NULL,
  `sales_disc_prc` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_categories: 3 rows
/*!40000 ALTER TABLE `inventory_categories` DISABLE KEYS */;
REPLACE INTO `inventory_categories` (`kode`, `category`, `update_status`, `custom_label_1`, `custom_label_2`, `custom_label_3`, `custom_label_4`, `custom_label_5`, `custom_label_6`, `custom_label_7`, `custom_label_8`, `custom_label_9`, `custom_label_10`, `sourceautonumber`, `sourcefile`, `parent_id`, `create_date`, `create_by`, `update_date`, `update_by`, `item_picture`, `description`, `icon_picture`, `sales_disc_prc`) VALUES
	('MAKANAN', 'MAKANAN', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-03-12 00:00:00', '', '2016-03-12 00:00:00', '', '', '', '', 0),
	('MINUMAN', 'MINUMAN', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-03-12 00:00:00', '', '2016-03-12 00:00:00', '', '', '', '', 0),
	('KERAMIK', 'KERAMIK', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-03-12 00:00:00', '', '2016-03-12 00:00:00', '', '', '', '', 0);
/*!40000 ALTER TABLE `inventory_categories` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_class
CREATE TABLE IF NOT EXISTS `inventory_class` (
  `kode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `class` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_class: 5 rows
/*!40000 ALTER TABLE `inventory_class` DISABLE KEYS */;
REPLACE INTO `inventory_class` (`kode`, `class`, `id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('Stock Item', 'Stock Item', 6, NULL, NULL, NULL),
	('Service', 'Service', 7, NULL, NULL, NULL),
	('Employee', 'Employee', 8, NULL, NULL, NULL),
	('Labour', 'Labour', 9, NULL, NULL, NULL),
	('Material', 'Material', 14, NULL, NULL, NULL);
/*!40000 ALTER TABLE `inventory_class` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_moving
CREATE TABLE IF NOT EXISTS `inventory_moving` (
  `transfer_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_trans` datetime DEFAULT NULL,
  `from_location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `from_qty` int(11) DEFAULT NULL,
  `to_location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `to_qty` int(11) DEFAULT NULL,
  `trans_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `trans_type` varchar(10) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `verify_by` varchar(50) DEFAULT NULL,
  `verify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`transfer_id`,`item_number`,`date_trans`,`from_location`,`to_location`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_moving: 2 rows
/*!40000 ALTER TABLE `inventory_moving` DISABLE KEYS */;
REPLACE INTO `inventory_moving` (`transfer_id`, `item_number`, `date_trans`, `from_location`, `from_qty`, `to_location`, `to_qty`, `trans_by`, `cost`, `update_status`, `id`, `comments`, `trans_type`, `total_amount`, `unit`, `status`, `verify_by`, `verify_date`) VALUES
	('TRX00012', 'R001', '2016-03-17 17:59:00', 'Cawang', 1, 'Gudang', 1, NULL, 50000, NULL, 1, '', NULL, 50000, '', '0', NULL, NULL),
	('TRX00012', '00035', '2016-03-17 17:59:00', 'Cawang', 1, 'Gudang', 1, NULL, -1, NULL, 2, '', NULL, -1, '', '0', NULL, NULL);
/*!40000 ALTER TABLE `inventory_moving` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_prices
CREATE TABLE IF NOT EXISTS `inventory_prices` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer_pricing_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `retail` double DEFAULT NULL,
  `quantity_high` int(11) DEFAULT NULL,
  `quantity_low` int(11) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`customer_pricing_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_prices: 0 rows
/*!40000 ALTER TABLE `inventory_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_prices` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_price_customers
CREATE TABLE IF NOT EXISTS `inventory_price_customers` (
  `item_no` varchar(50) DEFAULT NULL,
  `cust_type` varchar(50) DEFAULT NULL,
  `sales_price` double DEFAULT NULL,
  `disc_prc_from` double DEFAULT NULL,
  `min_qty` double DEFAULT NULL,
  `disc_prc_to` double DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `cust_no` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `disc_prc_2` double DEFAULT NULL,
  `disc_prc_3` double DEFAULT NULL,
  `min_qty_sold` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.inventory_price_customers: 13 rows
/*!40000 ALTER TABLE `inventory_price_customers` DISABLE KEYS */;
REPLACE INTO `inventory_price_customers` (`item_no`, `cust_type`, `sales_price`, `disc_prc_from`, `min_qty`, `disc_prc_to`, `description`, `id`, `cust_no`, `category`, `disc_amount`, `disc_prc_2`, `disc_prc_3`, `min_qty_sold`) VALUES
	(NULL, NULL, 1, NULL, NULL, 1, 'Minuman', 1, NULL, 'MI', 1, NULL, NULL, NULL),
	(NULL, NULL, 1, NULL, NULL, 1, 'Minuman', 2, NULL, 'MI', 1, NULL, NULL, NULL),
	(NULL, NULL, 0, NULL, 12, 1, 'KERAMIK', 16, '101', 'KERAMIK', 0, 2, 3, NULL);
/*!40000 ALTER TABLE `inventory_price_customers` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_price_history
CREATE TABLE IF NOT EXISTS `inventory_price_history` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_changed` datetime DEFAULT NULL,
  `po_or_so` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sales_price` double DEFAULT NULL,
  `order_price` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_price_history: 0 rows
/*!40000 ALTER TABLE `inventory_price_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_price_history` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_products
CREATE TABLE IF NOT EXISTS `inventory_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipment_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `quantity_received` int(11) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `selected` tinyint(1) DEFAULT NULL,
  `other_doc_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `receipt_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `receipt_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `production_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `multi_unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` int(11) DEFAULT NULL,
  `mu_price` double DEFAULT NULL,
  `new_cost` double DEFAULT NULL,
  `from_line_number` int(11) DEFAULT NULL,
  `tanggal_jual` datetime DEFAULT NULL,
  `no_faktur_beli` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_faktur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_do_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `no_retur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `retail` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`item_number`,`shipment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_products: 3 rows
/*!40000 ALTER TABLE `inventory_products` DISABLE KEYS */;
REPLACE INTO `inventory_products` (`id`, `item_number`, `shipment_id`, `date_received`, `cost`, `supplier_number`, `warehouse_code`, `color`, `size`, `purchase_order_number`, `quantity_in_stock`, `quantity_received`, `total_amount`, `selected`, `other_doc_number`, `receipt_type`, `receipt_by`, `comments`, `production_code`, `unit`, `multi_unit`, `mu_qty`, `mu_price`, `new_cost`, `from_line_number`, `tanggal_jual`, `no_faktur_beli`, `no_faktur_jual`, `no_do_jual`, `tanggal_beli`, `no_retur_jual`, `update_status`, `sourceautonumber`, `sourcefile`, `serial_number`, `create_date`, `create_by`, `update_date`, `update_by`, `retail`) VALUES
	(1, '100', 'ADJ00010', '2016-03-12 15:47:00', 50000, NULL, 'Gudang', NULL, NULL, NULL, NULL, 1, 50000, NULL, NULL, 'ADJ', NULL, '', NULL, '', '', 1, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, '10201', 'ADJ00010', '2016-03-12 15:47:00', 120000, NULL, 'Gudang', NULL, NULL, NULL, NULL, 1, 120000, NULL, NULL, 'ADJ', NULL, '', NULL, 'Pcs', 'Pcs', 1, 120000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, '100', 'RPRD00006', '2016-03-12 17:08:00', 50000, NULL, 'Cawang', NULL, NULL, 'WO-00017', NULL, 1, 50000, NULL, NULL, 'RCV_PROD', NULL, '', NULL, '', '', 1, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `inventory_products` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_promotion
CREATE TABLE IF NOT EXISTS `inventory_promotion` (
  `kode` varchar(20) CHARACTER SET utf8 NOT NULL,
  `datefrom` datetime DEFAULT NULL,
  `dateto` datetime DEFAULT NULL,
  `discpercent` int(11) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `keterangan` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `promotype` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sundayprc` double(11,0) DEFAULT NULL,
  `mondayprc` double(11,0) DEFAULT NULL,
  `tuesdayprc` double(11,0) DEFAULT NULL,
  `wednesdayprc` double(11,0) DEFAULT NULL,
  `thursdayprc` double(11,0) DEFAULT NULL,
  `fridayprc` double(11,0) DEFAULT NULL,
  `saturdayprc` double(11,0) DEFAULT NULL,
  `active` int DEFAULT NULL,
  `update_status` double(11,0) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_promotion: 0 rows
/*!40000 ALTER TABLE `inventory_promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_promotion` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_sales_disc
CREATE TABLE IF NOT EXISTS `inventory_sales_disc` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `datefrom` datetime DEFAULT NULL,
  `timefrom` datetime DEFAULT NULL,
  `sunday` double(11,0) DEFAULT NULL,
  `monday` double(11,0) DEFAULT NULL,
  `tuesday` double(11,0) DEFAULT NULL,
  `wednesday` double(11,0) DEFAULT NULL,
  `thursday` double(11,0) DEFAULT NULL,
  `friday` double(11,0) DEFAULT NULL,
  `saturday` double(11,0) DEFAULT NULL,
  `update_status` double(11,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_sales_disc: 0 rows
/*!40000 ALTER TABLE `inventory_sales_disc` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_sales_disc` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_serialized_items
CREATE TABLE IF NOT EXISTS `inventory_serialized_items` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipment_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `comment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_activated` datetime DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `month_guaranted` int(11) DEFAULT NULL,
  `tanggal_jual` datetime DEFAULT NULL,
  `no_faktur_beli` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_faktur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_do_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `no_retur_beli` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_retur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`item_number`,`serial_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_serialized_items: 0 rows
/*!40000 ALTER TABLE `inventory_serialized_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_serialized_items` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_suppliers
CREATE TABLE IF NOT EXISTS `inventory_suppliers` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lead_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_suppliers: 0 rows
/*!40000 ALTER TABLE `inventory_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_suppliers` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_warehouse
CREATE TABLE IF NOT EXISTS `inventory_warehouse` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorderlevel` int(11) DEFAULT NULL,
  `lastorderdate` datetime DEFAULT NULL,
  `lastorderqty` int(11) DEFAULT NULL,
  `whtype` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `max_qty` int(11) DEFAULT NULL,
  `opening_qty` int(11) DEFAULT NULL,
  `trx_qty` int(11) DEFAULT NULL,
  `ending_qty` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `topten` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_able` int DEFAULT NULL,
  `tax_abcle` int DEFAULT NULL,
  `ignore_qty_check` int DEFAULT NULL,
  `sales_commision_percent` int DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `manufacturer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qstep1` int(11) DEFAULT NULL,
  `pricestep1` double DEFAULT NULL,
  `qstep2` int(11) DEFAULT NULL,
  `pricestep2` double DEFAULT NULL,
  `qstep3` int(11) DEFAULT NULL,
  `pricestep3` double DEFAULT NULL,
  `minprice` double DEFAULT NULL,
  `matrix` int(11) DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`item_number`,`warehouse_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_warehouse: 0 rows
/*!40000 ALTER TABLE `inventory_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_warehouse` ENABLE KEYS */;


-- Dumping structure for table simak.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_number` varchar(20) CHARACTER SET utf8 NOT NULL,
  `invoice_type` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `sales_order_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `sold_to_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `your_order__` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `source_of_order` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salesman` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fob` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `paid` int(1) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent` double DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent_2` double DEFAULT NULL,
  `posted` int(1) DEFAULT NULL,
  `posting_gl_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `batch_post` int(1) DEFAULT NULL,
  `finance_charge` int(1) DEFAULT NULL,
  `department` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `truck` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `capacity` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `printed` int(1) DEFAULT NULL,
  `payment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `insurance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `packing` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `discount_2` double DEFAULT NULL,
  `discount_3` double DEFAULT NULL,
  `print_counter` int(11) DEFAULT NULL,
  `uang_muka` double DEFAULT NULL,
  `saldo_invoice` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `audit_status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `ppn_amount` double DEFAULT NULL,
  `do_invoiced` int(1) DEFAULT NULL,
  `your_order_date` datetime DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `sales_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_so_text` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `no_po_text` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `currency_code` varchar(50) DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  PRIMARY KEY (`invoice_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice: 40 rows
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
REPLACE INTO `invoice` (`invoice_number`, `invoice_type`, `sales_order_number`, `type_of_invoice`, `account_id`, `sold_to_customer`, `ship_to_customer`, `invoice_date`, `your_order__`, `source_of_order`, `payment_terms`, `salesman`, `fob`, `shipped_via`, `tax`, `tax_2`, `freight`, `discount`, `other`, `paid`, `comments`, `sales_tax_code`, `sales_tax_percent`, `sales_tax2_code`, `sales_tax_percent_2`, `posted`, `posting_gl_id`, `batch_post`, `finance_charge`, `department`, `truck`, `capacity`, `printed`, `payment`, `insurance`, `packing`, `discount_2`, `discount_3`, `print_counter`, `uang_muka`, `saldo_invoice`, `amount`, `disc_amount_1`, `disc_amount_2`, `disc_amount_3`, `total_amount`, `audit_status`, `org_id`, `update_status`, `ppn_amount`, `do_invoiced`, `your_order_date`, `disc_amount`, `sales_name`, `promosi_code`, `create_date`, `create_by`, `update_date`, `update_by`, `no_so_text`, `no_po_text`, `currency_code`, `currency_rate`, `warehouse_code`, `subtotal`, `due_date`) VALUES
	('K01-00279', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-25 08:55:22', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 800, 1, '0', 'PPN', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SJ00054', 'D', 'SO00119', NULL, NULL, '101', NULL, '2016-03-17 18:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cawang', NULL, '2016-03-17 00:00:00');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_delivery_order_info
CREATE TABLE IF NOT EXISTS `invoice_delivery_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `do_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reason_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reason_date` datetime DEFAULT NULL,
  `comments` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_delivery_order_info: 0 rows
/*!40000 ALTER TABLE `invoice_delivery_order_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_delivery_order_info` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_lineitems
CREATE TABLE IF NOT EXISTS `invoice_lineitems` (
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` double(11,2) DEFAULT NULL,
  `unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `discount` double(11,2) DEFAULT NULL,
  `taxable` int DEFAULT NULL,
  `shipped` int DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `ship_qty` double(11,0) DEFAULT NULL,
  `bo_qty` double(11,0) DEFAULT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `job_reference` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `revenue_acct_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `quality` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `packing_material` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `multi_unit` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(11,2) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `disc_2` double(11,2) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,2) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `ppn_amount` double DEFAULT NULL,
  `nett_amount` double DEFAULT NULL,
  `from_line_number` double DEFAULT NULL,
  `from_line_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `from_line_doc` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `discount_addition` int(11) DEFAULT NULL,
  `printcount` int(11) DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `sales_comm_percent` int(11) DEFAULT NULL,
  `sales_comm_amount` double DEFAULT NULL,
  `employee_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_order_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `duration_minute` int(11) DEFAULT NULL,
  `promo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `coa1` int(11) DEFAULT NULL,
  `coa2` int(11) DEFAULT NULL,
  `coa3` int(11) DEFAULT NULL,
  `coa4` int(11) DEFAULT NULL,
  `coa5` int(11) DEFAULT NULL,
  `coa1amt` double DEFAULT NULL,
  `coa2amt` double DEFAULT NULL,
  `coa3amt` double DEFAULT NULL,
  `coa4amt` double DEFAULT NULL,
  `coa5amt` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sc_amount` double DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_lineitems: 86 rows
/*!40000 ALTER TABLE `invoice_lineitems` DISABLE KEYS */;
REPLACE INTO `invoice_lineitems` (`invoice_number`, `line_number`, `item_number`, `quantity`, `unit`, `description`, `price`, `discount`, `taxable`, `shipped`, `ship_date`, `ship_qty`, `bo_qty`, `serial_number`, `job_reference`, `comments`, `cost`, `color`, `size`, `warehouse_code`, `revenue_acct_id`, `amount`, `currency_code`, `currency_rate`, `discount_amount`, `quality`, `packing_material`, `multi_unit`, `mu_qty`, `mu_harga`, `forex_price`, `base_curr_amount`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `update_status`, `ppn_amount`, `nett_amount`, `from_line_number`, `from_line_type`, `from_line_doc`, `sourceautonumber`, `sourcefile`, `discount_addition`, `printcount`, `tax_amount`, `sales_comm_percent`, `sales_comm_amount`, `employee_id`, `line_order_type`, `start_time`, `duration_minute`, `promo`, `coa1`, `coa2`, `coa3`, `coa4`, `coa5`, `coa1amt`, `coa2amt`, `coa3amt`, `coa4amt`, `coa5amt`, `create_date`, `create_by`, `update_date`, `update_by`, `sc_amount`) VALUES
	('T00007', 1, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1698.3, 'IDR', 1, 1.7, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('PJL00171', 86, '10201', 1.00, 'Pcs', 'Celana Jeans Pria', 132000.00, 0.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 120000, NULL, NULL, 'Cawang', 1415, 66000, NULL, NULL, 66000, NULL, NULL, 'Pcs', 1.00, 132000, NULL, NULL, 0.00, 0, 0.00, 0, NULL, NULL, NULL, 83, 'DO', 'SJ00054', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `invoice_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_serialized_items
CREATE TABLE IF NOT EXISTS `invoice_serialized_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `month_guaranted` int(11) DEFAULT NULL,
  `date_activated` datetime DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  `comments` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_serialized_items: 0 rows
/*!40000 ALTER TABLE `invoice_serialized_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_serialized_items` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_shipment
CREATE TABLE IF NOT EXISTS `invoice_shipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `expeditur` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jenis_kendaraan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nomor_polisi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nama_sopir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tujuan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jumlah_do_induk` int(11) DEFAULT NULL,
  `qty_do_before` double(11,0) DEFAULT NULL,
  `qty_do_current` double(11,0) DEFAULT NULL,
  `qty_do_after` double(11,0) DEFAULT NULL,
  `tanggal_do_induk` datetime DEFAULT NULL,
  `nomor_do_induk` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_nama` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_nama` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `kota_asal` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kota_tujuan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer_pengirim` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer_penerima` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_rute` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tagihan_untuk` int(11) DEFAULT NULL,
  `biaya_dokumen` double DEFAULT NULL,
  `biaya_pengepakan` double DEFAULT NULL,
  `biaya_lain` double DEFAULT NULL,
  `nomor_surat_jalan` double DEFAULT NULL,
  `nomor_voucher_kas` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_shipment: 0 rows
/*!40000 ALTER TABLE `invoice_shipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_shipment` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_shipment_export
CREATE TABLE IF NOT EXISTS `invoice_shipment_export` (
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lc_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `issuing_bank` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `feeder_vessel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mother_vessel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `port_of_loading` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `destination` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `flight` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `carrier_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipping_marks` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_shipment_export: 0 rows
/*!40000 ALTER TABLE `invoice_shipment_export` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_shipment_export` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_tax_serial
CREATE TABLE IF NOT EXISTS `invoice_tax_serial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nofaktur` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `noseripajak` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggalpajak` datetime DEFAULT NULL,
  `customernumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customernpwp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customernppkp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_tax_serial: 0 rows
/*!40000 ALTER TABLE `invoice_tax_serial` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_tax_serial` ENABLE KEYS */;


-- Dumping structure for table simak.jenis_potongan
CREATE TABLE IF NOT EXISTS `jenis_potongan` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sifat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `is_variable` smallint(1) DEFAULT '0',
  `ref_column` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.jenis_potongan: 1 rows
/*!40000 ALTER TABLE `jenis_potongan` DISABLE KEYS */;
REPLACE INTO `jenis_potongan` (`kode`, `keterangan`, `sifat`, `is_variable`, `ref_column`, `update_status`) VALUES
	('TOKO', 'POTONGAN TOKO', '', 0, '', NULL);
/*!40000 ALTER TABLE `jenis_potongan` ENABLE KEYS */;


-- Dumping structure for table simak.jenis_tunjangan
CREATE TABLE IF NOT EXISTS `jenis_tunjangan` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sifat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `is_variable` smallint(1) DEFAULT '0',
  `ref_column` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.jenis_tunjangan: 2 rows
/*!40000 ALTER TABLE `jenis_tunjangan` DISABLE KEYS */;
REPLACE INTO `jenis_tunjangan` (`kode`, `keterangan`, `sifat`, `is_variable`, `ref_column`, `update_status`) VALUES
	('GAPOK', 'GAJI POKOK', '0', 0, '12', NULL),
	('MAKAN', 'MAKAN', '0', 0, '10', NULL);
/*!40000 ALTER TABLE `jenis_tunjangan` ENABLE KEYS */;


-- Dumping structure for table simak.kas_kasir
CREATE TABLE IF NOT EXISTS `kas_kasir` (
  `comno` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `supervisor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jmlakhir` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `kasir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shift` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `catatan` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.kas_kasir: 318 rows
/*!40000 ALTER TABLE `kas_kasir` DISABLE KEYS */;
REPLACE INTO `kas_kasir` (`comno`, `tanggal`, `jumlah`, `supervisor`, `jmlakhir`, `update_status`, `kasir`, `shift`, `catatan`) VALUES
	('K01', '2015-11-12 10:32:20', 1000000, 'andri', 0, 0, 'kasir', '1032', 'modal kasir'),
	('K01', '2016-02-19 15:06:26', 1000000, 'adiana', 0, 0, 'kasir', '1506', NULL);
/*!40000 ALTER TABLE `kas_kasir` ENABLE KEYS */;


-- Dumping structure for table simak.kendaraan
CREATE TABLE IF NOT EXISTS `kendaraan` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nomor_plat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nama_supir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kapasitas` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `merk` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bpkb_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bpkb_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colour` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bpkb_address` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `stnk_date` datetime DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.kendaraan: 0 rows
/*!40000 ALTER TABLE `kendaraan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kendaraan` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_approved
CREATE TABLE IF NOT EXISTS `ls_app_approved` (
  `app_id` varchar(50) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `approved_rate` varchar(50) DEFAULT NULL,
  `first_score` varchar(50) DEFAULT NULL,
  `last_score` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_approved: 0 rows
/*!40000 ALTER TABLE `ls_app_approved` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_approved` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_bill_cust_address
CREATE TABLE IF NOT EXISTS `ls_app_bill_cust_address` (
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `loan_id` varchar(50) DEFAULT NULL,
  `default_ship_to_id` varchar(50) DEFAULT NULL,
  `coll_id` varchar(50) DEFAULT NULL,
  `coll_cost` varchar(50) DEFAULT NULL,
  `send_letter_via` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_bill_cust_address: 0 rows
/*!40000 ALTER TABLE `ls_app_bill_cust_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_bill_cust_address` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_confirm
CREATE TABLE IF NOT EXISTS `ls_app_confirm` (
  `app_id` varchar(50) DEFAULT NULL,
  `confirm_date` date DEFAULT NULL,
  `confirm_by` varchar(50) DEFAULT NULL,
  `confirm_count` int(11) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_confirm: 0 rows
/*!40000 ALTER TABLE `ls_app_confirm` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_confirm` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_cost
CREATE TABLE IF NOT EXISTS `ls_app_cost` (
  `app_id` varchar(50) DEFAULT NULL,
  `cost_type` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_cost: 0 rows
/*!40000 ALTER TABLE `ls_app_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_cost` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_installment
CREATE TABLE IF NOT EXISTS `ls_app_installment` (
  `app_id` varchar(50) DEFAULT NULL,
  `bank_id` varchar(50) DEFAULT NULL,
  `inst_date` varchar(50) DEFAULT NULL,
  `loan_amount` varchar(50) DEFAULT NULL,
  `inst_amount` varchar(50) DEFAULT NULL,
  `disc_amount` varchar(50) DEFAULT NULL,
  `subsidi_dealer_amount` varchar(50) DEFAULT NULL,
  `dp_received_by` varchar(50) DEFAULT NULL,
  `inst_id` varchar(50) DEFAULT NULL,
  `inst_type` varchar(50) DEFAULT NULL,
  `inst_top` varchar(50) DEFAULT NULL,
  `inst_first_date` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_installment: 0 rows
/*!40000 ALTER TABLE `ls_app_installment` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_installment` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_insurance
CREATE TABLE IF NOT EXISTS `ls_app_insurance` (
  `app_id` varchar(50) DEFAULT NULL,
  `insr_id` varchar(50) DEFAULT NULL,
  `insr_type` varchar(50) DEFAULT NULL,
  `insr_top` varchar(50) DEFAULT NULL,
  `insr_season` varchar(50) DEFAULT NULL,
  `flat_rate_prc` varchar(50) DEFAULT NULL,
  `eff_rate_prc` varchar(50) DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_insurance: 0 rows
/*!40000 ALTER TABLE `ls_app_insurance` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_insurance` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_master
CREATE TABLE IF NOT EXISTS `ls_app_master` (
  `app_id` varchar(50) NOT NULL DEFAULT '',
  `app_date` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `counter_id` varchar(50) DEFAULT NULL,
  `dealer_id` varchar(50) DEFAULT NULL,
  `terms_id` varchar(50) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `contract_id` varchar(50) DEFAULT NULL,
  `dp_amount` float DEFAULT NULL,
  `dp_prc` float DEFAULT NULL,
  `insr_amount` float DEFAULT NULL,
  `admin_amount` float DEFAULT NULL,
  `insr_prc` float DEFAULT NULL,
  `inst_amount` float DEFAULT NULL,
  `inst_month` float DEFAULT NULL,
  `loan_amount` float DEFAULT NULL,
  `rate_prc` float DEFAULT NULL,
  `rate_amount` float DEFAULT NULL,
  `verified` int(11) DEFAULT '0',
  `scored` int(11) DEFAULT '0',
  `score_value` int(11) DEFAULT '0',
  `confirmed` int(11) DEFAULT '0',
  `surveyed` int(11) DEFAULT '0',
  `approved` int(11) DEFAULT '0',
  `create_by` varchar(50) DEFAULT NULL,
  `risk_approved` int(11) DEFAULT '0',
  `update_by` varchar(50) DEFAULT NULL,
  `sub_total` float DEFAULT NULL,
  `posted` int(11) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `promo_code` varchar(50) DEFAULT NULL,
  `item_del_by` varchar(50) DEFAULT NULL,
  `item_del_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_master: 40 rows
/*!40000 ALTER TABLE `ls_app_master` DISABLE KEYS */;
REPLACE INTO `ls_app_master` (`app_id`, `app_date`, `cust_id`, `counter_id`, `dealer_id`, `terms_id`, `notes`, `status`, `contract_id`, `dp_amount`, `dp_prc`, `insr_amount`, `admin_amount`, `insr_prc`, `inst_amount`, `inst_month`, `loan_amount`, `rate_prc`, `rate_amount`, `verified`, `scored`, `score_value`, `confirmed`, `surveyed`, `approved`, `create_by`, `risk_approved`, `update_by`, `sub_total`, `posted`, `create_date`, `update_date`, `promo_code`, `item_del_by`, `item_del_date`) VALUES
	('SPK00008', '2015-01-26 11:30:00', '00004LS1411', 'C1', NULL, NULL, NULL, 'Finish', '4252423', 277500, 0.15, 0, 100000, NULL, 575273, 3, 1572500, 0.0325, 51106.2, 1, 1, 55, 0, 1, 1, '', 1, 'andri', 1850000, 0, '1970-01-01 00:00:00', NULL, '', '', ''),
	('SPK00048', '2015-05-03 00:00:00', '00023LS1503', 'pluit', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'andri', 0, NULL, 0, 0, '2015-05-03 00:00:00', NULL, '', '', '');
/*!40000 ALTER TABLE `ls_app_master` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_object_items
CREATE TABLE IF NOT EXISTS `ls_app_object_items` (
  `app_id` varchar(50) DEFAULT NULL,
  `obj_id` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `disc_prc` float DEFAULT NULL,
  `disc_amount` float DEFAULT NULL,
  `tax_prc` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `dp` float NOT NULL DEFAULT '0',
  `dp_amount` float NOT NULL DEFAULT '0',
  `aft_dp_amount` float NOT NULL DEFAULT '0',
  `bunga` float NOT NULL DEFAULT '0',
  `bunga_amount` float NOT NULL DEFAULT '0',
  `loan_amount` float NOT NULL DEFAULT '0',
  `tenor` int(11) NOT NULL DEFAULT '0',
  `aft_tenor` float NOT NULL DEFAULT '0',
  `angsuran` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_object_items: 42 rows
/*!40000 ALTER TABLE `ls_app_object_items` DISABLE KEYS */;
REPLACE INTO `ls_app_object_items` (`app_id`, `obj_id`, `description`, `qty`, `price`, `disc_prc`, `disc_amount`, `tax_prc`, `tax_amount`, `amount`, `comments`, `id`, `dp`, `dp_amount`, `aft_dp_amount`, `bunga`, `bunga_amount`, `loan_amount`, `tenor`, `aft_tenor`, `angsuran`) VALUES
	('SPK00008', 'hps1', 'samsung duos', 1, 1850000, NULL, NULL, NULL, NULL, 1850000, NULL, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0),
	('SPK00047', '100405', 'HN SMSUNG T2110', 1, 3199000, NULL, NULL, NULL, NULL, 3199000, NULL, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `ls_app_object_items` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_scoring
CREATE TABLE IF NOT EXISTS `ls_app_scoring` (
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `office_phone` varchar(50) DEFAULT NULL,
  `v2_cust_name` varchar(50) DEFAULT NULL,
  `v2_cust_name_x` varchar(50) DEFAULT NULL,
  `v2_place_birth` varchar(50) DEFAULT NULL,
  `v2_date_birth` varchar(50) DEFAULT NULL,
  `v2_mother_name` varchar(50) DEFAULT NULL,
  `v2_mother_name_x` varchar(50) DEFAULT NULL,
  `v1_fam_name` varchar(50) DEFAULT NULL,
  `v1_fam_relation` varchar(50) DEFAULT NULL,
  `v1_fam_street` varchar(250) DEFAULT NULL,
  `v1_fam_kel` varchar(100) DEFAULT NULL,
  `v1_fam_kec` varchar(100) DEFAULT NULL,
  `v1_fam_kota` varchar(100) DEFAULT NULL,
  `v1_fam_pos` varchar(50) DEFAULT NULL,
  `v1_fam_phone` varchar(50) DEFAULT NULL,
  `v1_cust_name` varchar(50) DEFAULT NULL,
  `v1_mother_name` varchar(50) DEFAULT NULL,
  `v1_street` varchar(250) DEFAULT NULL,
  `v1_rtrw` varchar(50) DEFAULT NULL,
  `v1_kel` varchar(50) DEFAULT NULL,
  `v1_kec` varchar(50) DEFAULT NULL,
  `v1_kota` varchar(50) DEFAULT NULL,
  `v1_pos` varchar(50) DEFAULT NULL,
  `v1_phone` varchar(50) DEFAULT NULL,
  `v1_hp` varchar(50) DEFAULT NULL,
  `v1_house_status` varchar(50) DEFAULT NULL,
  `v1_house_status_x` varchar(50) DEFAULT NULL,
  `v3_com_name` varchar(50) DEFAULT NULL,
  `v3_street` varchar(250) DEFAULT NULL,
  `v3_bidang` varchar(50) DEFAULT NULL,
  `v3_emp_status` varchar(50) DEFAULT NULL,
  `v3_jabatan` varchar(50) DEFAULT NULL,
  `v3_com_status` varchar(50) DEFAULT NULL,
  `v3_year` varchar(50) DEFAULT NULL,
  `v3_salary` varchar(50) DEFAULT NULL,
  `v3_supervisor` varchar(50) DEFAULT NULL,
  `v3_hrd` varchar(50) DEFAULT NULL,
  `type_data` varchar(50) DEFAULT NULL COMMENT '0 - verify, 1 - appmaster',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `v1_lama_tahun` varchar(50) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.ls_app_scoring: 44 rows
/*!40000 ALTER TABLE `ls_app_scoring` DISABLE KEYS */;
REPLACE INTO `ls_app_scoring` (`app_id`, `cust_id`, `cust_name`, `phone`, `office_phone`, `v2_cust_name`, `v2_cust_name_x`, `v2_place_birth`, `v2_date_birth`, `v2_mother_name`, `v2_mother_name_x`, `v1_fam_name`, `v1_fam_relation`, `v1_fam_street`, `v1_fam_kel`, `v1_fam_kec`, `v1_fam_kota`, `v1_fam_pos`, `v1_fam_phone`, `v1_cust_name`, `v1_mother_name`, `v1_street`, `v1_rtrw`, `v1_kel`, `v1_kec`, `v1_kota`, `v1_pos`, `v1_phone`, `v1_hp`, `v1_house_status`, `v1_house_status_x`, `v3_com_name`, `v3_street`, `v3_bidang`, `v3_emp_status`, `v3_jabatan`, `v3_com_status`, `v3_year`, `v3_salary`, `v3_supervisor`, `v3_hrd`, `type_data`, `id`, `v1_lama_tahun`, `create_date`, `update_date`, `create_by`, `update_by`, `catatan`) VALUES
	('SPK00002', '00003LS1411', 'Ucok Baba', '082112829192', NULL, 'on', NULL, 'on', '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '0', NULL, NULL, NULL, NULL, NULL),
	('SPK00047', '00023LS1503', 'dede yusuf', '082112829192', NULL, '1', NULL, '1', '1', '1', NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, '1', NULL, NULL, '1', '1', '1', '1', NULL, 46, '1', NULL, NULL, NULL, NULL, '');
/*!40000 ALTER TABLE `ls_app_scoring` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_survey
CREATE TABLE IF NOT EXISTS `ls_app_survey` (
  `app_id` varchar(50) DEFAULT NULL,
  `survey_times` varchar(50) DEFAULT NULL,
  `survey_date` varchar(50) DEFAULT NULL,
  `survey_by` varchar(50) DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `hasil` varchar(250) DEFAULT NULL,
  `foto_depan` varchar(250) DEFAULT NULL,
  `foto_kiri` varchar(50) DEFAULT NULL,
  `foto_kanan` varchar(50) DEFAULT NULL,
  `recomended` int(11) DEFAULT '0',
  `foto_1` varchar(250) DEFAULT NULL,
  `foto_ket_1` varchar(250) DEFAULT NULL,
  `foto_2` varchar(250) DEFAULT NULL,
  `foto_ket_2` varchar(250) DEFAULT NULL,
  `foto_3` varchar(250) DEFAULT NULL,
  `foto_ket_3` varchar(250) DEFAULT NULL,
  `foto_4` varchar(250) DEFAULT NULL,
  `foto_ket_4` varchar(250) DEFAULT NULL,
  `foto_5` varchar(250) DEFAULT NULL,
  `foto_ket_5` varchar(250) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_survey: 35 rows
/*!40000 ALTER TABLE `ls_app_survey` DISABLE KEYS */;
REPLACE INTO `ls_app_survey` (`app_id`, `survey_times`, `survey_date`, `survey_by`, `comments`, `id`, `status`, `area`, `hasil`, `foto_depan`, `foto_kiri`, `foto_kanan`, `recomended`, `foto_1`, `foto_ket_1`, `foto_2`, `foto_ket_2`, `foto_3`, `foto_ket_3`, `foto_4`, `foto_ket_4`, `foto_5`, `foto_ket_5`, `create_date`, `update_date`, `create_by`, `update_by`) VALUES
	('SPK00002', NULL, '2014-11-27 06:29:06', 'admin', NULL, 1, '1', 'default', 'dafdfsafdsaf', 'talaga1.jpg', 'intanhotel2.jpg', 'qolby19.jpg', 1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL),
	('SPK00047', NULL, '2015-05-01 09:30:45', 'andri', NULL, 45, '1', 'default', 'rekomend deh, alamat jelas, orangnya baik', '', '', '', 1, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ls_app_survey` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_verify
CREATE TABLE IF NOT EXISTS `ls_app_verify` (
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `office_phone` varchar(50) DEFAULT NULL,
  `v2_cust_name` varchar(50) DEFAULT NULL,
  `v2_cust_name_x` varchar(50) DEFAULT NULL,
  `v2_place_birth` varchar(50) DEFAULT NULL,
  `v2_date_birth` date DEFAULT NULL,
  `v2_mother_name` varchar(50) DEFAULT NULL,
  `v2_mother_name_x` varchar(50) DEFAULT NULL,
  `v1_fam_name` varchar(50) DEFAULT NULL,
  `v1_fam_relation` varchar(50) DEFAULT NULL,
  `v1_fam_street` varchar(250) DEFAULT NULL,
  `v1_fam_kel` varchar(100) DEFAULT NULL,
  `v1_fam_kec` varchar(100) DEFAULT NULL,
  `v1_fam_kota` varchar(100) DEFAULT NULL,
  `v1_fam_pos` varchar(50) DEFAULT NULL,
  `v1_fam_phone` varchar(50) DEFAULT NULL,
  `v1_cust_name` varchar(50) DEFAULT NULL,
  `v1_mother_name` varchar(50) DEFAULT NULL,
  `v1_street` varchar(250) DEFAULT NULL,
  `v1_rtrw` varchar(50) DEFAULT NULL,
  `v1_kel` varchar(50) DEFAULT NULL,
  `v1_kec` varchar(50) DEFAULT NULL,
  `v1_kota` varchar(50) DEFAULT NULL,
  `v1_pos` varchar(50) DEFAULT NULL,
  `v1_phone` varchar(50) DEFAULT NULL,
  `v1_hp` varchar(50) DEFAULT NULL,
  `v1_house_status` varchar(50) DEFAULT NULL,
  `v1_house_status_x` varchar(50) DEFAULT NULL,
  `v3_com_name` varchar(50) DEFAULT NULL,
  `v3_street` varchar(250) DEFAULT NULL,
  `v3_bidang` varchar(50) DEFAULT NULL,
  `v3_emp_status` varchar(50) DEFAULT NULL,
  `v3_jabatan` varchar(50) DEFAULT NULL,
  `v3_com_status` varchar(50) DEFAULT NULL,
  `v3_year` varchar(50) DEFAULT NULL,
  `v3_salary` float DEFAULT NULL,
  `v3_supervisor` varchar(50) DEFAULT NULL,
  `v3_hrd` varchar(50) DEFAULT NULL,
  `v1_lama_tahun` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_app_verify: 43 rows
/*!40000 ALTER TABLE `ls_app_verify` DISABLE KEYS */;
REPLACE INTO `ls_app_verify` (`app_id`, `cust_id`, `cust_name`, `phone`, `office_phone`, `v2_cust_name`, `v2_cust_name_x`, `v2_place_birth`, `v2_date_birth`, `v2_mother_name`, `v2_mother_name_x`, `v1_fam_name`, `v1_fam_relation`, `v1_fam_street`, `v1_fam_kel`, `v1_fam_kec`, `v1_fam_kota`, `v1_fam_pos`, `v1_fam_phone`, `v1_cust_name`, `v1_mother_name`, `v1_street`, `v1_rtrw`, `v1_kel`, `v1_kec`, `v1_kota`, `v1_pos`, `v1_phone`, `v1_hp`, `v1_house_status`, `v1_house_status_x`, `v3_com_name`, `v3_street`, `v3_bidang`, `v3_emp_status`, `v3_jabatan`, `v3_com_status`, `v3_year`, `v3_salary`, `v3_supervisor`, `v3_hrd`, `v1_lama_tahun`, `id`, `create_date`, `update_date`, `create_by`, `update_by`) VALUES
	('SPK00032', '00009LS1412', 'Olga Saputra', '324324', NULL, '2', '1', '1', '2015-02-06', '2', '1', '1', '1', '3', NULL, NULL, NULL, NULL, '1', NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', '2', NULL, NULL, '3', NULL, NULL, '3', 3, '3', '3', '1', 0, NULL, NULL, NULL, NULL),
	('SPK00047', '00023LS1503', 'dede yusuf', '082112829192', NULL, 'B', 'DEDE YUSUF', 'JAKARTA', '1970-01-01', 'B', 'YANI', 'YUNI', 'ADIK', 'JL. RAYA JOGLO 8', NULL, NULL, NULL, NULL, '082112829192', NULL, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B', 'MILIK SENDIRI', 'B', NULL, NULL, 'C', NULL, NULL, 'C', 0, 'C', 'C', '10', 47, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ls_app_verify` ENABLE KEYS */;


-- Dumping structure for table simak.ls_bunga_range
CREATE TABLE IF NOT EXISTS `ls_bunga_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount_from` float NOT NULL DEFAULT '0',
  `amount_to` float NOT NULL DEFAULT '0',
  `bunga_prc` float NOT NULL DEFAULT '0',
  `comments` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.ls_bunga_range: 4 rows
/*!40000 ALTER TABLE `ls_bunga_range` DISABLE KEYS */;
REPLACE INTO `ls_bunga_range` (`id`, `amount_from`, `amount_to`, `bunga_prc`, `comments`) VALUES
	(9, 500000, 1500000, 3, ''),
	(10, 0, 500000, 0, ''),
	(11, 1500000, 3000000, 4, ''),
	(12, 3000000, 900000000, 3.5, '');
/*!40000 ALTER TABLE `ls_bunga_range` ENABLE KEYS */;


-- Dumping structure for table simak.ls_counter
CREATE TABLE IF NOT EXISTS `ls_counter` (
  `counter_id` varchar(50) NOT NULL DEFAULT '',
  `counter_name` varchar(150) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `area_name` varchar(150) DEFAULT NULL,
  `sales_agent` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `target` float DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`counter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_counter: 2 rows
/*!40000 ALTER TABLE `ls_counter` DISABLE KEYS */;
REPLACE INTO `ls_counter` (`counter_id`, `counter_name`, `area`, `area_name`, `sales_agent`, `address`, `phone`, `join_date`, `target`, `active`) VALUES
	('C1', 'Jakarta Barat', 'Grogol', NULL, 'SA', 'Jl. Daan Mogot Raya No.12', '2292002202', '2014-11-23 00:00:00', 200000000, 1),
	('C2', 'Jakarta Utara ', 'Pluit', 'Pluit Jakarta Barat', '', '', '', '2014-12-17 00:00:00', 0, 0);
/*!40000 ALTER TABLE `ls_counter` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_company
CREATE TABLE IF NOT EXISTS `ls_cust_company` (
  `cust_id` varchar(50) DEFAULT NULL,
  `comp_type` varchar(50) DEFAULT NULL,
  `bussiness_type` varchar(50) DEFAULT NULL,
  `industry_type` varchar(50) DEFAULT NULL,
  `office_status` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `notaris_no` varchar(50) DEFAULT NULL,
  `notaris_date` varchar(50) DEFAULT NULL,
  `notaris_name` varchar(50) DEFAULT NULL,
  `tdp_number` varchar(50) DEFAULT NULL,
  `tdp_date` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `siup_number` varchar(50) DEFAULT NULL,
  `siup_date` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `total_employee` varchar(50) DEFAULT NULL,
  `comp_name` varchar(50) DEFAULT NULL,
  `since_year` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `rtrw` varchar(50) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `phone_ext` varchar(50) DEFAULT NULL,
  `spv_name` varchar(50) DEFAULT NULL,
  `job_status` varchar(50) DEFAULT NULL,
  `job_level` varchar(50) DEFAULT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `job_status_etc` varchar(50) DEFAULT NULL,
  `job_type_etc` varchar(50) DEFAULT NULL,
  `emp_status` varchar(50) DEFAULT NULL,
  `emp_status_etc` varchar(50) DEFAULT NULL,
  `comp_desc` varchar(50) DEFAULT NULL,
  `office_status_etc` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `hrd_name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_company: 20 rows
/*!40000 ALTER TABLE `ls_cust_company` DISABLE KEYS */;
REPLACE INTO `ls_cust_company` (`cust_id`, `comp_type`, `bussiness_type`, `industry_type`, `office_status`, `npwp`, `notaris_no`, `notaris_date`, `notaris_name`, `tdp_number`, `tdp_date`, `zip_pos`, `siup_number`, `siup_date`, `contact_name`, `contact_phone`, `total_employee`, `comp_name`, `since_year`, `street`, `city`, `rtrw`, `kel`, `kec`, `phone_ext`, `spv_name`, `job_status`, `job_level`, `job_type`, `job_status_etc`, `job_type_etc`, `emp_status`, `emp_status_etc`, `comp_desc`, `office_status_etc`, `id`, `hrd_name`) VALUES
	('00003LS1411', NULL, '1', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'f', NULL, NULL, NULL, 'g', '2', '1', '1', 'a', 'e', 'b', 'c', 'd', '1', '11', '1', '1', '0', '1', '1', '0', '1', '1', '1', 6, '0'),
	('00023LS1503', NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '0', '', '', '', '', '', '', '', '', '', '1', '', '0', '', '', '0', '', '', '', 30, '');
/*!40000 ALTER TABLE `ls_cust_company` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_company_owner
CREATE TABLE IF NOT EXISTS `ls_cust_company_owner` (
  `cust_id` varchar(50) DEFAULT NULL,
  `owner_name` varchar(50) DEFAULT NULL,
  `id_ktp` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `pangsa` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `suite` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_company_owner: 0 rows
/*!40000 ALTER TABLE `ls_cust_company_owner` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_cust_company_owner` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_crcard
CREATE TABLE IF NOT EXISTS `ls_cust_crcard` (
  `cust_id` varchar(50) DEFAULT NULL,
  `card_no` varchar(50) DEFAULT NULL,
  `card_bank` varchar(50) DEFAULT NULL,
  `card_expire` varchar(50) DEFAULT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `card_type_etc` varchar(50) DEFAULT NULL,
  `card_limit` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_crcard: 4 rows
/*!40000 ALTER TABLE `ls_cust_crcard` DISABLE KEYS */;
REPLACE INTO `ls_cust_crcard` (`cust_id`, `card_no`, `card_bank`, `card_expire`, `card_type`, `card_type_etc`, `card_limit`, `id`) VALUES
	('00003LS1411', '213213', '23231', 'dfasdf', 'dfsd', NULL, 'dfs', 5),
	('00003LS1411', '213123', '23213', '2322', '', NULL, '', 6),
	('00006LS1412', '23213213', 'bca', '2014-10-10', 'xxx', NULL, 'xx', 7),
	('00010LS1412', '23213213', 'Citibank', '2015-10-10', 'VISA', NULL, '5000000', 8);
/*!40000 ALTER TABLE `ls_cust_crcard` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_master
CREATE TABLE IF NOT EXISTS `ls_cust_master` (
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `suite` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_acc_number` varchar(50) DEFAULT NULL,
  `credit_card_number` varchar(50) DEFAULT NULL,
  `is_send_email` varchar(50) DEFAULT NULL,
  `is_active` varchar(50) DEFAULT NULL,
  `balance_amount` varchar(50) DEFAULT NULL,
  `credit_amount` varchar(50) DEFAULT NULL,
  `credit_balance` varchar(50) DEFAULT NULL,
  `credit_limit` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ref_doc_id` varchar(50) DEFAULT NULL,
  `cust_type` varchar(50) DEFAULT NULL,
  `parent_cust_id` varchar(50) DEFAULT NULL,
  `call_name` varchar(50) DEFAULT NULL,
  `id_card_no` varchar(50) DEFAULT NULL,
  `id_card_exp` varchar(50) DEFAULT NULL,
  `rtrw` varchar(50) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `lama_thn` int(11) DEFAULT NULL,
  `lama_bln` int(11) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `spouse_name` varchar(50) DEFAULT NULL,
  `spouse_birth_place` varchar(50) DEFAULT NULL,
  `spouse_birth_date` datetime DEFAULT NULL,
  `spouse_phone` varchar(50) DEFAULT NULL,
  `salary_source` varchar(50) DEFAULT NULL,
  `spouse_salary_source` float DEFAULT NULL,
  `other_income_source` float DEFAULT NULL,
  `deduct` float DEFAULT NULL,
  `deduct_source` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `spouse_hp` varchar(50) NOT NULL DEFAULT '0',
  `other_loan` float NOT NULL DEFAULT '0',
  `cust_foto` varchar(250) DEFAULT NULL,
  `rt` int(11) DEFAULT NULL,
  `rw` int(11) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `cust_foto_2` varchar(250) DEFAULT NULL,
  `cust_foto_3` varchar(250) DEFAULT NULL,
  `cust_foto_4` varchar(250) DEFAULT NULL,
  `cust_foto_5` varchar(250) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x_cust_id` (`cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_master: 20 rows
/*!40000 ALTER TABLE `ls_cust_master` DISABLE KEYS */;
REPLACE INTO `ls_cust_master` (`cust_id`, `cust_name`, `first_name`, `last_name`, `street`, `suite`, `city`, `zip_pos`, `region`, `province`, `country`, `phone`, `fax`, `email`, `bank_name`, `bank_acc_number`, `credit_card_number`, `is_send_email`, `is_active`, `balance_amount`, `credit_amount`, `credit_balance`, `credit_limit`, `status`, `ref_doc_id`, `cust_type`, `parent_cust_id`, `call_name`, `id_card_no`, `id_card_exp`, `rtrw`, `kel`, `kec`, `lama_thn`, `lama_bln`, `mother_name`, `spouse_name`, `spouse_birth_place`, `spouse_birth_date`, `spouse_phone`, `salary_source`, `spouse_salary_source`, `other_income_source`, `deduct`, `deduct_source`, `id`, `spouse_hp`, `other_loan`, `cust_foto`, `rt`, `rw`, `hp`, `cust_foto_2`, `cust_foto_3`, `cust_foto_4`, `cust_foto_5`, `create_by`, `update_by`, `create_date`, `update_date`) VALUES
	('00003LS1411', 'Ucok Baba', 'Ucok Baba Sembiring', 'a', 'Jl. Raya Serang Km. 200', 'b', 'Purwakarta', '41172', '1', '1', '1', '082112829192', '1', '1', '1', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'Karyawan', '11', 'Ucok', '1243516651', '1970-01-01 07:00:00', '12/12', 'Pasawahan', 'Pasawahan', 5, NULL, 'Yeni', 'Yati Rachman', 'Medan', '1970-01-01 07:00:00', '0221544', NULL, NULL, NULL, NULL, NULL, 9, '02132555', 0, '35aochk-jpg6.png', 12, 12, '02645125661', '51_m1.jpg', '20.jpg', 'Adek4.JPG', 'ah_kieu_weh.jpg', '', 'andri', '1970-01-01 07:00:00', '2015-02-27 19:23:34'),
	('00023LS1503', 'dede yusuf', 'dede', '', 'x', '', 'KABUPATEN BADUNG', '32222', '', 'Bali', '', '082112829192', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'dede', 'dddd', '1970-01-01 07:00:00', '0/0', 'ABIAN BASE', 'ABIAN BASE', 0, NULL, 'dddd', '', '', '2015-03-17 00:00:00', '', NULL, NULL, NULL, NULL, NULL, 40, '', 0, '', 0, 0, '02645125661', '', '', '', '', 'andri', 'andri', '2015-03-17 00:00:00', '2015-03-17 21:58:20');
/*!40000 ALTER TABLE `ls_cust_master` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_personal
CREATE TABLE IF NOT EXISTS `ls_cust_personal` (
  `cust_id` varchar(50) DEFAULT NULL,
  `subcust_id` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birth_place` varchar(50) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `house_status` varchar(50) DEFAULT NULL,
  `salary` decimal(10,0) DEFAULT NULL,
  `spouse_salary` decimal(10,0) DEFAULT NULL,
  `other_income` decimal(10,0) DEFAULT NULL,
  `no_of_dependents` int(11) DEFAULT NULL,
  `year_of_service` int(11) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `deduct` decimal(10,0) DEFAULT NULL,
  `salary_source` varchar(50) DEFAULT NULL,
  `spouse_salary_source` varchar(50) DEFAULT NULL,
  `deduct_source` varchar(50) DEFAULT NULL,
  `other_income_source` varchar(50) DEFAULT NULL,
  `other_loan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_personal: 21 rows
/*!40000 ALTER TABLE `ls_cust_personal` DISABLE KEYS */;
REPLACE INTO `ls_cust_personal` (`cust_id`, `subcust_id`, `gender`, `birth_place`, `birth_date`, `religion`, `occupation`, `education`, `marital_status`, `house_status`, `salary`, `spouse_salary`, `other_income`, `no_of_dependents`, `year_of_service`, `id`, `deduct`, `salary_source`, `spouse_salary_source`, `deduct_source`, `other_income_source`, `other_loan`) VALUES
	('00003LS1411', NULL, 'L', 'Medan', '2015-02-01 19:35:00', NULL, NULL, NULL, '0', '0', 3000000, 2000000, 6000000, 1, NULL, 7, 6000000, 'a', 'b', 'd', 'c', ''),
	('00023LS1503', NULL, 'L', 'ddf', '1970-01-01 07:00:00', NULL, NULL, NULL, '0', '0', 0, 0, 0, 0, NULL, 32, 0, 'ddd', '', NULL, '', '0');
/*!40000 ALTER TABLE `ls_cust_personal` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_ship_to
CREATE TABLE IF NOT EXISTS `ls_cust_ship_to` (
  `cust_id` varchar(50) DEFAULT NULL,
  `ship_to_type` varchar(50) DEFAULT NULL,
  `ship_to_id` varchar(50) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `suite` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `rtrw` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `rt` int(9) NOT NULL DEFAULT '0',
  `rw` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_ship_to: 17 rows
/*!40000 ALTER TABLE `ls_cust_ship_to` DISABLE KEYS */;
REPLACE INTO `ls_cust_ship_to` (`cust_id`, `ship_to_type`, `ship_to_id`, `relation`, `first_name`, `last_name`, `street`, `suite`, `city`, `zip_pos`, `region`, `province`, `country`, `phone`, `fax`, `email`, `kel`, `kec`, `rtrw`, `hp`, `id`, `rt`, `rw`) VALUES
	('00004LS1411', 'Saat Ini', NULL, 'Family', 'Andri', NULL, 'Jl. Raya Serang Km. 200', 'Gedung Artha Guna', 'Purwakarta', '', 'Jawa Barat', 'dfads', NULL, '0264-9399393', '', '', 'Pasawahan', 'Pasawahan', '', '', 14, 0, 0),
	('00010LS1412', 'Family', NULL, 'adik', 'ibu ratmi', NULL, 'Jl. Raya Serang Km. 200', NULL, 'Jakarta', '41172', NULL, 'DKI Jakarta', NULL, '082112829192', '0299200111', 'zadr50@yahoo.com', 'pamulang timur', 'Pasawahan', NULL, '2', 39, 1, 12);
/*!40000 ALTER TABLE `ls_cust_ship_to` ENABLE KEYS */;


-- Dumping structure for table simak.ls_dp_range
CREATE TABLE IF NOT EXISTS `ls_dp_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dp_from` float NOT NULL DEFAULT '0',
  `dp_to` float NOT NULL DEFAULT '0',
  `dp_prc` float NOT NULL DEFAULT '0',
  `comments` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_dp_range: 4 rows
/*!40000 ALTER TABLE `ls_dp_range` DISABLE KEYS */;
REPLACE INTO `ls_dp_range` (`id`, `dp_from`, `dp_to`, `dp_prc`, `comments`) VALUES
	(1, 0, 500000, 0, ''),
	(2, 500000, 1500000, 10, ''),
	(3, 1500000, 3000000, 15, ''),
	(4, 3000000, 100000000, 20, '');
/*!40000 ALTER TABLE `ls_dp_range` ENABLE KEYS */;


-- Dumping structure for table simak.ls_invoice_header
CREATE TABLE IF NOT EXISTS `ls_invoice_header` (
  `loan_id` varchar(50) DEFAULT NULL,
  `app_id` varchar(50) DEFAULT NULL,
  `idx_month` int(11) DEFAULT NULL,
  `invoice_number` varchar(50) NOT NULL DEFAULT '',
  `invoice_date` varchar(50) DEFAULT NULL,
  `invoice_type` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT '0',
  `paid` int(11) DEFAULT '0',
  `date_paid` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `voucher` varchar(50) DEFAULT NULL,
  `cust_deal_id` varchar(50) DEFAULT NULL,
  `cust_deal_ship_id` varchar(50) DEFAULT NULL,
  `gross_amount` float DEFAULT '0',
  `disc_amount` float DEFAULT '0',
  `insr_amount` float DEFAULT '0',
  `admin_amount` float DEFAULT '0',
  `pokok` float DEFAULT '0',
  `bunga` float DEFAULT '0',
  `hari_telat` int(11) DEFAULT '0',
  `pokok_paid` float DEFAULT '0',
  `bunga_paid` float DEFAULT '0',
  `denda` float DEFAULT '0',
  `bunga_finalty` float DEFAULT '0',
  `posted` int(11) DEFAULT '0',
  `visit_count` int(11) DEFAULT '0',
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `denda_tagih` float DEFAULT NULL,
  `saldo` float DEFAULT NULL,
  `saldo_titip` double DEFAULT NULL,
  `saldo_titip_paid` double DEFAULT NULL,
  PRIMARY KEY (`invoice_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_invoice_header: 197 rows
/*!40000 ALTER TABLE `ls_invoice_header` DISABLE KEYS */;
REPLACE INTO `ls_invoice_header` (`loan_id`, `app_id`, `idx_month`, `invoice_number`, `invoice_date`, `invoice_type`, `amount`, `paid`, `date_paid`, `payment_method`, `amount_paid`, `voucher`, `cust_deal_id`, `cust_deal_ship_id`, `gross_amount`, `disc_amount`, `insr_amount`, `admin_amount`, `pokok`, `bunga`, `hari_telat`, `pokok_paid`, `bunga_paid`, `denda`, `bunga_finalty`, `posted`, `visit_count`, `create_by`, `update_by`, `create_date`, `update_date`, `denda_tagih`, `saldo`, `saldo_titip`, `saldo_titip_paid`) VALUES
	('0163000024', 'SPK00024', 1, '0163000024-01', '2015-02-21 23:59:59', 'I', 597429, 0, NULL, NULL, 0, NULL, '00009LS1412', 'C2', 469800, 0, 0, 0, 348000, 121800, 163, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 127629, 0, 0, NULL),
	('4252423', 'SPK00008', 3, '4252423-3', '2015-02-14 23:59:59', 'I', 575273, 0, '2015-02-14 03:50:26', 'Cash', 0, NULL, '00004LS1411', 'C1', 1269790, 0, 0, 0, 524167, 51106.2, 0, 0, 0, 0, 561457, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL);
/*!40000 ALTER TABLE `ls_invoice_header` ENABLE KEYS */;


-- Dumping structure for table simak.ls_invoice_payments
CREATE TABLE IF NOT EXISTS `ls_invoice_payments` (
  `invoice_number` varchar(50) DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `how_paid` varchar(50) DEFAULT NULL,
  `amount_paid` float DEFAULT '0',
  `voucher_no` varchar(50) DEFAULT NULL,
  `denda` float DEFAULT '0',
  `pokok` float DEFAULT '0',
  `bunga` float DEFAULT '0',
  `asuransi` float DEFAULT '0',
  `admin` float DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `dont_calculate` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_invoice_payments: 66 rows
/*!40000 ALTER TABLE `ls_invoice_payments` DISABLE KEYS */;
REPLACE INTO `ls_invoice_payments` (`invoice_number`, `date_paid`, `how_paid`, `amount_paid`, `voucher_no`, `denda`, `pokok`, `bunga`, `asuransi`, `admin`, `id`, `create_by`, `update_by`, `create_date`, `update_date`, `dont_calculate`) VALUES
	('14120011-1', '2014-12-30 00:00:00', 'Cash', 10, '14120011-1-30', 1, 5, 4, 0, 0, 1, NULL, NULL, NULL, NULL, 0),
	('2013031700022-1', '2015-08-07 00:00:00', 'Cash', 47261, 'P2013031700022-1-143', 0, 47261, 0, 0, 0, 143, 'andri', NULL, '2015-08-07 14:16:50', NULL, 0);
/*!40000 ALTER TABLE `ls_invoice_payments` ENABLE KEYS */;


-- Dumping structure for table simak.ls_loan_col_sched
CREATE TABLE IF NOT EXISTS `ls_loan_col_sched` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `loan_id` varchar(50) NOT NULL,
  `sch_date` datetime NOT NULL,
  `user_col` varchar(50) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `visited` int(11) NOT NULL DEFAULT '0',
  `visit_date` datetime NOT NULL,
  `visit_notes` varchar(50) NOT NULL,
  `amount_col` float NOT NULL,
  `collected` int(11) NOT NULL DEFAULT '0',
  `promise_date` datetime NOT NULL,
  `visit_ke` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_loan_col_sched: 22 rows
/*!40000 ALTER TABLE `ls_loan_col_sched` DISABLE KEYS */;
REPLACE INTO `ls_loan_col_sched` (`id`, `loan_id`, `sch_date`, `user_col`, `invoice_no`, `visited`, `visit_date`, `visit_notes`, `amount_col`, `collected`, `promise_date`, `visit_ke`) VALUES
	(1, '', '1970-01-01 00:00:00', 'andri', '25-1', 1, '2014-12-29 00:00:00', 'kunjungan ke 2', 0, 0, '2014-12-29 14:24:45', 12),
	(22, '', '2015-02-27 00:00:00', 'andri', '14120017-3', 1, '2015-02-28 00:00:00', 'dddd', 0, 0, '2015-02-27 00:00:00', 0);
/*!40000 ALTER TABLE `ls_loan_col_sched` ENABLE KEYS */;


-- Dumping structure for table simak.ls_loan_master
CREATE TABLE IF NOT EXISTS `ls_loan_master` (
  `loan_id` varchar(50) DEFAULT NULL,
  `loan_date` datetime DEFAULT NULL,
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `loan_amount` float DEFAULT NULL,
  `interest_amount` float DEFAULT NULL,
  `dp_amount` float DEFAULT NULL,
  `adm_amount` float DEFAULT NULL,
  `insr_amount` float DEFAULT NULL,
  `ar_amount` float DEFAULT NULL,
  `ar_bal_amount` float DEFAULT NULL,
  `first_dp_amount` float DEFAULT NULL,
  `inst_amount` float DEFAULT NULL,
  `first_paid_amount` float DEFAULT NULL,
  `first_paid_date` datetime DEFAULT NULL,
  `first_adm_amount` float DEFAULT NULL,
  `first_adm_date` datetime DEFAULT NULL,
  `first_insr_amount` float DEFAULT NULL,
  `first_insr_date` datetime DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `first_dealer_id` varchar(50) DEFAULT NULL,
  `max_month` int(11) DEFAULT NULL,
  `interest_percent` float DEFAULT NULL,
  `insr_percent` float DEFAULT NULL,
  `dp_percent` float DEFAULT NULL,
  `dealer_id` varchar(50) DEFAULT NULL,
  `dealer_name` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `last_idx_month` int(11) DEFAULT NULL,
  `last_date_paid` datetime DEFAULT NULL,
  `last_amount_paid` float DEFAULT NULL,
  `total_amount_paid` float DEFAULT NULL,
  `posted` int(11) DEFAULT '0',
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `loan_date_aggr` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_loan_master: 21 rows
/*!40000 ALTER TABLE `ls_loan_master` DISABLE KEYS */;
REPLACE INTO `ls_loan_master` (`loan_id`, `loan_date`, `app_id`, `cust_id`, `cust_name`, `loan_amount`, `interest_amount`, `dp_amount`, `adm_amount`, `insr_amount`, `ar_amount`, `ar_bal_amount`, `first_dp_amount`, `inst_amount`, `first_paid_amount`, `first_paid_date`, `first_adm_amount`, `first_adm_date`, `first_insr_amount`, `first_insr_date`, `paid`, `status`, `first_dealer_id`, `max_month`, `interest_percent`, `insr_percent`, `dp_percent`, `dealer_id`, `dealer_name`, `id`, `last_idx_month`, `last_date_paid`, `last_amount_paid`, `total_amount_paid`, `posted`, `create_by`, `update_by`, `create_date`, `update_date`, `loan_date_aggr`) VALUES
	('4252423', '2014-12-14 15:50:00', 'SPK00008', '00004LS1411', 'Rafi Achmad', 1572500, 51106.2, 277500, 100000, 0, NULL, 1572500, NULL, 575273, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1', 'C1', 3, 0.0325, NULL, 0.15, 'C1', 'Jakarta Barat', 17, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL),
	('01630K00047', '2015-05-03 00:00:00', 'SPK00047', '00023LS1503', 'dede yusuf', 2559200, NULL, 639800, NULL, NULL, NULL, NULL, NULL, 936241, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'C2', 3, 0.0325, NULL, 0.2, 'C2', 'Jakarta Utara ', 49, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '2015-05-10 00:00:00');
/*!40000 ALTER TABLE `ls_loan_master` ENABLE KEYS */;


-- Dumping structure for table simak.ls_loan_obj_items
CREATE TABLE IF NOT EXISTS `ls_loan_obj_items` (
  `obj_item_id` varchar(50) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `disc_amount` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `loan_id` varchar(50) DEFAULT NULL,
  `line_type` varchar(50) DEFAULT NULL,
  `price_list_id` varchar(50) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `item_brand` varchar(50) DEFAULT NULL,
  `item_model` varchar(50) DEFAULT NULL,
  `bunga` float NOT NULL DEFAULT '0',
  `bunga_amount` float NOT NULL DEFAULT '0',
  `loan_amount` float NOT NULL DEFAULT '0',
  `tenor` int(11) NOT NULL DEFAULT '0',
  `aft_tenor` float NOT NULL DEFAULT '0',
  `angsuran` float NOT NULL DEFAULT '0',
  `made_in` varchar(50) DEFAULT NULL,
  `mfg_year` varchar(50) DEFAULT NULL,
  `colour` varchar(50) DEFAULT NULL,
  `name_on_bpkp` varchar(50) DEFAULT NULL,
  `frame_no` varchar(50) DEFAULT NULL,
  `engine_no` varchar(50) DEFAULT NULL,
  `engine_capacity` varchar(50) DEFAULT NULL,
  `police_no` varchar(50) DEFAULT NULL,
  `insr_company` varchar(50) DEFAULT NULL,
  `insr_policy_no` varchar(50) DEFAULT NULL,
  `insr_name` varchar(50) DEFAULT NULL,
  `insr_order_no` varchar(50) DEFAULT NULL,
  `insr_date_from` datetime DEFAULT NULL,
  `insr_date_to` datetime DEFAULT NULL,
  `insr_amount` float DEFAULT NULL,
  `flat_rate_prc` float DEFAULT NULL,
  `obj_desc` varchar(50) DEFAULT NULL,
  `comments` varchar(150) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `dp` float NOT NULL DEFAULT '0',
  `aft_dp_amount` float NOT NULL DEFAULT '0',
  `dp_amount` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_loan_obj_items: 26 rows
/*!40000 ALTER TABLE `ls_loan_obj_items` DISABLE KEYS */;
REPLACE INTO `ls_loan_obj_items` (`obj_item_id`, `qty`, `unit`, `price`, `discount`, `disc_amount`, `amount`, `loan_id`, `line_type`, `price_list_id`, `item_type`, `item_brand`, `item_model`, `bunga`, `bunga_amount`, `loan_amount`, `tenor`, `aft_tenor`, `angsuran`, `made_in`, `mfg_year`, `colour`, `name_on_bpkp`, `frame_no`, `engine_no`, `engine_capacity`, `police_no`, `insr_company`, `insr_policy_no`, `insr_name`, `insr_order_no`, `insr_date_from`, `insr_date_to`, `insr_amount`, `flat_rate_prc`, `obj_desc`, `comments`, `id`, `dp`, `aft_dp_amount`, `dp_amount`) VALUES
	('hps1', 1, 'Pcs', 1850000, NULL, NULL, 1850000, '4252423', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'samsung duos', NULL, 17, 0, 0, NULL),
	('Palu', 100, 'Pcs', 25000, NULL, NULL, 2500000, '14120017', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Palu', NULL, 18, 0, 0, NULL),
	('100405', 1, 'Pcs', 3199000, NULL, NULL, 3199000, '01630K00047', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HN SMSUNG T2110', NULL, 55, 0, 0, 0);
/*!40000 ALTER TABLE `ls_loan_obj_items` ENABLE KEYS */;


-- Dumping structure for table simak.mat_release_detail
CREATE TABLE IF NOT EXISTS `mat_release_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mat_rel_no` varchar(50) DEFAULT NULL,
  `item_number` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `warehouse` varchar(50) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `line_exec_no` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.mat_release_detail: 0 rows
/*!40000 ALTER TABLE `mat_release_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mat_release_detail` ENABLE KEYS */;


-- Dumping structure for table simak.mat_release_header
CREATE TABLE IF NOT EXISTS `mat_release_header` (
  `mat_rel_no` varchar(50) NOT NULL DEFAULT '',
  `date_rel` datetime DEFAULT NULL,
  `wo_number` varchar(50) DEFAULT NULL,
  `exec_number` varchar(50) DEFAULT NULL,
  `warehouse` varchar(50) DEFAULT NULL,
  `person` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`mat_rel_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.mat_release_header: 1 rows
/*!40000 ALTER TABLE `mat_release_header` DISABLE KEYS */;
REPLACE INTO `mat_release_header` (`mat_rel_no`, `date_rel`, `wo_number`, `exec_number`, `warehouse`, `person`, `comments`) VALUES
	('MR00014', '2016-03-12 00:00:00', 'WO-00017', 'WOE00009', 'Cawang', '', '');
/*!40000 ALTER TABLE `mat_release_header` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_apps
CREATE TABLE IF NOT EXISTS `maxon_apps` (
  `app_name` varchar(200) DEFAULT NULL,
  `app_desc` varchar(200) DEFAULT NULL,
  `app_type` varchar(50) DEFAULT NULL,
  `app_ico` varchar(50) DEFAULT NULL,
  `app_path` varchar(50) DEFAULT NULL,
  `is_core` int(11) DEFAULT '0',
  `is_active` int(11) DEFAULT '0',
  `app_create_by` varchar(50) DEFAULT NULL,
  `app_url` varchar(200) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(50) NOT NULL,
  `app_controller` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.maxon_apps: 19 rows
/*!40000 ALTER TABLE `maxon_apps` DISABLE KEYS */;
REPLACE INTO `maxon_apps` (`app_name`, `app_desc`, `app_type`, `app_ico`, `app_path`, `is_core`, `is_active`, `app_create_by`, `app_url`, `id`, `app_id`, `app_controller`) VALUES
	('Pembelian', 'Pembuatan purchase order (PO) supplier, beserta pengelolaan hutang dan pelunasan hutang.', 'Modul', 'ico_purchase.png', '\\', 1, 1, 'andri', 'purchase', 1, '_40000', 'purchase'),
	('Penjualan', 'Pembuatan sales order (SO) pelanggan, pengiriman, kartu piutang sampai pelunasan piutang.', 'Modul', 'ico_sales.png', '\\', 1, 1, 'andri', 'sales', 2, '_30000', 'sales'),
	('Inventory', 'Pengelolaan data stock meliputi penerimaan, pengeluaran, transfer, adjustment dan lainnya.', 'Modul', 'ico_inventory.png', '\\', 1, 1, 'andri', 'inventory', 3, '_80000', 'inventory'),
	('Buku Kas', 'Pencatatan kas masuk dan kas keluar diluar pelunasan hutang piutang.', 'Modul', 'ico_bank.png', '\\', 1, 1, 'andri', 'bank', 4, '_60000', 'bank'),
	('Aktiva Tetap', 'Pengelolaan biaya penyusutan terhadap aktiva tetap seperti gedung, kendaraan dan lainnya', 'Modul', 'ico_asset.png', '\\', 0, 1, 'andri', '', 5, '_14000', 'aktiva'),
	('Manufacture', 'Proses pembuatan dari mulai bahan baku sampai penerimaan barang jadi di sebuah pabrik.', 'Modul', 'ico_manuf.png', '\\', 0, 1, 'andri', '', 6, '_11000', 'manuf'),
	('Payroll', 'Pengelollan data pegawai berupa absensi, shift, tunjangan, slip gaji dan lainnya', 'Modul', 'ico_payroll.png', '\\', 0, 0, 'andri', '', 7, '_12000', 'payroll'),
	('Koperasi', 'Pencatatan anggota koperasi beserta pinjaman, tabungan dan pelunasannya.', 'Modul', 'ico_koperasi.png', '\\', 0, 0, 'andri', '', 8, '_13000', 'koperasi'),
	('Point Of Sales', 'Modul penjualan tunai / kasir, untuk melayani pelanggan secara cepat', 'Modul', 'ico_pos.png', '\\', 0, 1, 'andri', '', 9, '_30000.0', 'pos'),
	('Akuntansi', 'Modul buku besar dan jurnal-jurnal yang dihasilkan semua transaksi yang menghasilkan laporan neraca dan rugi laba', 'Modul', 'ico_akun.png', '\\', 1, 1, 'andri', '', 10, '_10000', 'gl'),
	('Travel Agent', 'Modul untuk usaha travel agent, meliputi jadwal pesawat pembuatan invoice dan pelunasan.', 'Modul', 'office.png', '\\', 0, 0, 'andri', '', 11, '_21000', 'travel'),
	('Hotel', 'Modul pengelolaan data transaksi untuk usaha hotel dan penginapan.', 'Modul', 'eog.png', '\\', 0, 0, 'andri', '', 12, '_15000', 'hotel'),
	('Restaurant', 'Modul untuk dipakai di restoran dan rumah makan', 'Modul', 'gazpacho.png', '\\', 0, 0, 'andri', '', 13, '_16000', 'resto'),
	('Laundry', 'Modul untuk laundry dan pencucian pakaian.', 'Modul', 'glob2-icon-48.png', '\\', 0, 0, 'andri', '', 14, '_17000', 'laundry'),
	('Leasing', 'Modul untuk usaha leasing dan kredit kendaraan beserta angsurannya', 'Modul', 'gnome-fs-network.png', '\\', 0, 0, 'andri', '', 15, '_18000', 'leasing'),
	('Sekolah', 'Modul untuk sekolah dan dunia pendidikan.', 'Modul', 'gnome-db.png', '\\', 0, 0, 'andri', '', 16, '_19000', 'sekolah'),
	('Setting', 'Seting user login, kelompok user atau job dan modul yang boleh di akses.', 'Modul', 'ico_setting.png', '\\', 1, 1, 'andri', '', 17, '_00000', 'admin'),
	('Website', 'Halaman utama untuk website perusahaan', 'Modul', 'office.png', '\\', 0, 0, 'andri', '', 18, '_20000', 'website'),
	('Online Shop', 'Halaman Penjualan Online', 'Modul', 'eog.png', '\\eshop', 0, 0, 'andri', 'eshop', 19, 'eshop', 'eshop');
/*!40000 ALTER TABLE `maxon_apps` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_chat
CREATE TABLE IF NOT EXISTS `maxon_chat` (
  `userid` varchar(50) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.maxon_chat: 26 rows
/*!40000 ALTER TABLE `maxon_chat` DISABLE KEYS */;
REPLACE INTO `maxon_chat` (`userid`, `message`, `id`) VALUES
	('Guest', 'test', 1),
	('andri', 'saldo awal barang diinput lewat menu inventory disebelah kanan ada menu terima barang non po', 26);
/*!40000 ALTER TABLE `maxon_chat` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_inbox
CREATE TABLE IF NOT EXISTS `maxon_inbox` (
  `rcp_from` varchar(250) DEFAULT NULL,
  `rcp_to` varchar(250) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `msg_date` datetime DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `reply_id` int(9) NOT NULL DEFAULT '0',
  `is_archieve` tinyint(4) NOT NULL DEFAULT '0',
  `is_trash` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.maxon_inbox: 112 rows
/*!40000 ALTER TABLE `maxon_inbox` DISABLE KEYS */;
REPLACE INTO `maxon_inbox` (`rcp_from`, `rcp_to`, `subject`, `message`, `is_read`, `msg_date`, `id`, `reply_id`, `is_archieve`, `is_trash`) VALUES
	('andri', 'admin', 'subject', 'message', NULL, '2014-11-19 16:42:19', 1, 0, 0, 0),
	('anang', 'bagus', 'ggg', 'gg', 0, '2015-07-27 23:20:14', 112, 108, 0, 0);
/*!40000 ALTER TABLE `maxon_inbox` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_log_ip
CREATE TABLE IF NOT EXISTS `maxon_log_ip` (
  `period` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.maxon_log_ip: 47 rows
/*!40000 ALTER TABLE `maxon_log_ip` DISABLE KEYS */;
REPLACE INTO `maxon_log_ip` (`period`, `ip_address`) VALUES
	('20150222', '192.168.1.15'),
	('20160202', '::1');
/*!40000 ALTER TABLE `maxon_log_ip` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_market
CREATE TABLE IF NOT EXISTS `maxon_market` (
  `app_title` varchar(200) DEFAULT NULL,
  `app_desc` varchar(200) DEFAULT NULL,
  `app_type` varchar(50) DEFAULT NULL,
  `lic_type` varchar(50) DEFAULT NULL,
  `app_ico` varchar(50) DEFAULT NULL,
  `app_path` varchar(50) DEFAULT NULL,
  `is_core` int(11) DEFAULT '0',
  `is_active` int(11) DEFAULT '0',
  `app_create_by` varchar(50) DEFAULT NULL,
  `app_url` varchar(200) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(50) NOT NULL,
  `app_controller` varchar(150) NOT NULL,
  `app_file` varchar(150) NOT NULL,
  `app_scr_1` varchar(150) NOT NULL,
  `app_scr_2` varchar(150) NOT NULL,
  `app_scr_3` varchar(150) NOT NULL,
  `app_scr_4` varchar(150) NOT NULL,
  `app_scr_5` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.maxon_market: 8 rows
/*!40000 ALTER TABLE `maxon_market` DISABLE KEYS */;
REPLACE INTO `maxon_market` (`app_title`, `app_desc`, `app_type`, `lic_type`, `app_ico`, `app_path`, `is_core`, `is_active`, `app_create_by`, `app_url`, `id`, `app_id`, `app_controller`, `app_file`, `app_scr_1`, `app_scr_2`, `app_scr_3`, `app_scr_4`, `app_scr_5`) VALUES
	('1', '1', 'themes', 'free', NULL, NULL, 0, 0, '1', NULL, 19, '', '', '', '', '', '', '', ''),
	('4', '4', 'apps', 'paid', '0', NULL, 0, 0, '44', NULL, 20, '', '', '0', '', '', '', '', ''),
	('66', '6', 'themes', 'paid', 'hamil.jpg', NULL, 0, 0, '6', NULL, 21, '', '', 'coet.zip', '', '', '', '', ''),
	('Payroll', 'Pengelolaan data karyawan dan penggajian beserta absensi secara realtime, modul: pegawai, absensi, overtime, slip gaji, pph21', 'apps', 'paid', 'coet.jpg', NULL, 0, 0, 'Andri', NULL, 22, '', '', 'coet.zip', '', '', '', '', ''),
	('Buku Panduan MaxOn ERP Software', 'Buku panduan dasar-dasar penggunakan aplikasi software MaxOn ERP berisi tutorial dan tatacara penggunaan, disusun secara mudah untuk dipelajari.', 'books', 'free', 'maling bh.jpg', NULL, 0, 0, 'Andri', NULL, 23, '', '', 'coet.zip', '', '', '', '', ''),
	('Buku Panduan Untuk Developer', 'Berisi panduan untuk developer atau programmer yang ingin menambah fungsi atau modul-modul atau tema yang bisa anda tambahkan ke dalam software MaxOn ERP.', 'books', 'paid', '10968446_1050713611611315_3536989720526861468_n.jp', NULL, 0, 0, 'Andri', NULL, 24, '', '', 'coet.zip', 'djuarsa.jpg', 'maling bh.jpg', 'gambar-orang-lucu-narsis.jpg', 'kutil.jpg', 'IMG_2665.JPG'),
	('6', '6', 'themes', 'free', '', NULL, 0, 0, '6', NULL, 27, '', '', '', '', '', '', '', ''),
	('Funny Books', 'dkjfalkds klsdfjsa klfjsdalkfj salkjsad lksjflskajf sdlkjfsa lfkjslfkjs alfkajslkfajs flsda;jfd', 'books', 'paid', 'bayi-lucu-112.jpg', NULL, 0, 0, 'Andri', NULL, 28, '', '', 'bayi-lucu-12.jpg', 'bayi-lucu-113.jpg', 'bayi-lucu-114.jpg', 'bayi-lucu-115.jpg', 'bayi-lucu-116.jpg', 'bayi-lucu-117.jpg');
/*!40000 ALTER TABLE `maxon_market` ENABLE KEYS */;


-- Dumping structure for table simak.media_list
CREATE TABLE IF NOT EXISTS `media_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index 1` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.media_list: 2 rows
/*!40000 ALTER TABLE `media_list` DISABLE KEYS */;
REPLACE INTO `media_list` (`id`, `filename`, `description`, `title`) VALUES
	(1, 'martabak1.jpg', 'martabak 1', 'martabak'),
	(2, 'eshop.jpg', 'ehsop', 'ehsop');
/*!40000 ALTER TABLE `media_list` ENABLE KEYS */;


-- Dumping structure for table simak.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `module_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `form_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(225) CHARACTER SET utf8 DEFAULT NULL,
  `parentid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sequence` int(5) DEFAULT NULL,
  `visible` int DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.modules: 606 rows
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
REPLACE INTO `modules` (`module_id`, `module_name`, `type`, `form_name`, `description`, `parentid`, `update_status`, `sequence`, `visible`, `controller`) VALUES
	('frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', 'Form', 'frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', '_30010', 0, NULL, NULL, NULL),
	('frmMain.Addnew', 'frmMain.Addnew', 'Form', 'frmMain.Addnew', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_14001', 'Daftar Aktiva', 'Form', '_14001', 'Daftar Aktiva Tetap', '_14000', 0, 1, b'00000000', ''),
	('_14000', 'Aktiva Tetap', 'Form', '_14000', 'Aktiva Tetap', '0', 0, 1, b'00000000', '');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;


-- Dumping structure for table simak.modules_groups
CREATE TABLE IF NOT EXISTS `modules_groups` (
  `user_group_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `user_group_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `path_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`user_group_id`),
  UNIQUE KEY `x1` (`user_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.modules_groups: 15 rows
/*!40000 ALTER TABLE `modules_groups` DISABLE KEYS */;
REPLACE INTO `modules_groups` (`user_group_id`, `user_group_name`, `creation_date`, `description`, `path_image`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('Administrator', 'Administrator', '2015-11-06 00:00:00', 'Administrator', '', 0, '', ''),
	('ANDRI', 'Khusus job untuk andri', '2014-11-10 00:00:00', 'Khusus Job untuk andri', '', 0, '', ''),
	('BYR', 'Buyer', '2013-08-31 00:00:00', 'Buyer', '', 0, '', ''),
	('FIN', 'Financial', '2015-11-28 00:00:00', 'Kelompok finansial bertugas untuk mencatat data keuangan', '', 0, '', ''),
	('Gudang', 'Gudang', '2015-11-14 00:00:00', 'Bagian gudang', '', 0, '', ''),
	('INV', 'Inventory', '2015-01-09 00:00:00', '', '', 0, '', ''),
	('KSR', 'Kasir', '2003-11-14 20:41:59', NULL, NULL, 1, NULL, NULL),
	('PUR', 'Purchasing', '2014-12-31 00:00:00', '', '', 0, '', ''),
	('SLS', 'Sales', '2015-11-04 00:00:00', '', '', 0, '', ''),
	('SPV', 'Supervisor', '2015-11-04 00:00:00', '', '', 0, '', ''),
	('SYSMENU', 'SYSMENU', '2006-09-23 20:59:05', 'aaaa', 'a1.ico', 1, NULL, NULL),
	('ADM', 'Admin', '2015-11-14 00:00:00', 'Admin', '', 0, '', ''),
	('GL', 'Akuntansi', '2014-12-27 00:00:00', 'Perkiraan, closing, jurnal, neraca dan rugilaba', '', 0, '', ''),
	('admin', 'admin', '2015-11-04 00:00:00', 'admin', '', 0, '', ''),
	('SLSADM', 'Sales Admin', '2015-11-14 00:00:00', 'Sales Admin', '', 0, '', '');
/*!40000 ALTER TABLE `modules_groups` ENABLE KEYS */;


-- Dumping structure for table simak.org_struct
CREATE TABLE IF NOT EXISTS `org_struct` (
  `org_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `org_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact_person` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_parent` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `source_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `is_head_office` int DEFAULT NULL,
  PRIMARY KEY (`org_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.org_struct: 0 rows
/*!40000 ALTER TABLE `org_struct` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_struct` ENABLE KEYS */;


-- Dumping structure for table simak.other_vendors
CREATE TABLE IF NOT EXISTS `other_vendors` (
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_vendor` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salutation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `middle_initial` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `credit_limit` double DEFAULT NULL,
  `fed_tax_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `credit_balance` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.other_vendors: 0 rows
/*!40000 ALTER TABLE `other_vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_vendors` ENABLE KEYS */;


-- Dumping structure for table simak.overtime_detail
CREATE TABLE IF NOT EXISTS `overtime_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `time_in` varchar(50) DEFAULT NULL,
  `time_out` varchar(50) DEFAULT NULL,
  `time_total` varchar(50) DEFAULT NULL,
  `supervisor` varchar(50) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `istirahat` double DEFAULT NULL,
  `ttc_1x` double DEFAULT NULL,
  `ttc_2x` double DEFAULT NULL,
  `ttc_3x` double DEFAULT NULL,
  `ttc_4x` double DEFAULT NULL,
  `time_total_calc` double DEFAULT NULL,
  `meal` tinyint(1) DEFAULT '0',
  `others` tinyint(1) DEFAULT '0',
  `amount` double DEFAULT NULL,
  `tcid` varchar(50) DEFAULT NULL,
  `salary_no` varchar(50) DEFAULT NULL,
  `hari_libur` tinyint(1) DEFAULT '0',
  `work_status` varchar(50) DEFAULT NULL,
  `add_to_slip` tinyint(1) DEFAULT '1',
  `time_total_run` double DEFAULT NULL,
  `periode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.overtime_detail: 9 rows
/*!40000 ALTER TABLE `overtime_detail` DISABLE KEYS */;
REPLACE INTO `overtime_detail` (`id`, `tanggal`, `nip`, `time_in`, `time_out`, `time_total`, `supervisor`, `keterangan`, `org_id`, `jenis`, `istirahat`, `ttc_1x`, `ttc_2x`, `ttc_3x`, `ttc_4x`, `time_total_calc`, `meal`, `others`, `amount`, `tcid`, `salary_no`, `hari_libur`, `work_status`, `add_to_slip`, `time_total_run`, `periode`) VALUES
	(13, '2014-05-29 17:31:09', '122', '08:00', '17:25', '09:25:00', 'andri', NULL, NULL, NULL, NULL, 1.5, 18, 0, 0, 19.5, 0, 0, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL),
	(15, '2014-06-04 17:30:30', '342', '17:00', '20:20', '03:20:00', '', NULL, NULL, NULL, NULL, 1.5, 6, 0, 0, 7.5, 0, 0, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL);
/*!40000 ALTER TABLE `overtime_detail` ENABLE KEYS */;


-- Dumping structure for table simak.payables
CREATE TABLE IF NOT EXISTS `payables` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_type` int(11) DEFAULT NULL,
  `supplier_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_number` int(11) DEFAULT NULL,
  `purchase_order` tinyint(1) DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `expense_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `discount_taken` double DEFAULT NULL,
  `purpose_of_expense` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tax_deductible` tinyint(1) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `posted` tinyint(1) DEFAULT NULL,
  `posting_gl_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `batch_post` tinyint(1) DEFAULT NULL,
  `X1099` tinyint(1) DEFAULT NULL,
  `invoice_received` tinyint(1) DEFAULT NULL,
  `items_received` tinyint(1) DEFAULT NULL,
  `many_po` tinyint(1) DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `curr_selisih` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `saldo_invoice` double DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables: 3 rows
/*!40000 ALTER TABLE `payables` DISABLE KEYS */;
REPLACE INTO `payables` (`bill_id`, `vendor_type`, `supplier_number`, `other_number`, `purchase_order`, `purchase_order_number`, `expense_type`, `account_id`, `invoice_number`, `invoice_date`, `amount`, `due_date`, `terms`, `discount_taken`, `purpose_of_expense`, `tax_deductible`, `comments`, `paid`, `posted`, `posting_gl_id`, `batch_post`, `X1099`, `invoice_received`, `items_received`, `many_po`, `curr_code`, `curr_rate`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `saldo_invoice`) VALUES
	(1, NULL, 'ALFAMART', NULL, 1, 'PI00019', 'Purchase Order', NULL, 'PI00019', '2016-02-01 00:00:00', 2300000, '2016-02-27 00:00:00', '60 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, 'AM', NULL, 1, 'PI00020', 'Purchase Order', NULL, 'PI00020', '2016-02-02 00:00:00', 500000, '2016-02-27 00:00:00', 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, NULL, 'JKT.KI', NULL, 1, 'PI00021', 'Purchase Order', NULL, 'PI00021', '2016-01-01 00:00:00', 1500000, '2016-02-27 00:00:00', 'KREDIT', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `payables` ENABLE KEYS */;


-- Dumping structure for table simak.payables_items
CREATE TABLE IF NOT EXISTS `payables_items` (
  `bill_id` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables_items: 0 rows
/*!40000 ALTER TABLE `payables_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `payables_items` ENABLE KEYS */;


-- Dumping structure for table simak.payables_many_po
CREATE TABLE IF NOT EXISTS `payables_many_po` (
  `bill_id` int(11) DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables_many_po: 0 rows
/*!40000 ALTER TABLE `payables_many_po` DISABLE KEYS */;
/*!40000 ALTER TABLE `payables_many_po` ENABLE KEYS */;


-- Dumping structure for table simak.payables_payments
CREATE TABLE IF NOT EXISTS `payables_payments` (
  `bill_id` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `date_paid` datetime DEFAULT NULL,
  `how_paid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `how_paid_account_id` int(11) DEFAULT NULL,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `amount_alloc` double DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `curr_selisih` double DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `no_bukti` varchar(50) DEFAULT NULL,
  `paid_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables_payments: 0 rows
/*!40000 ALTER TABLE `payables_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payables_payments` ENABLE KEYS */;


-- Dumping structure for table simak.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `date_paid` datetime DEFAULT NULL,
  `how_paid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `how_paid_acct_id` int(11) DEFAULT NULL,
  `credit_card_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `expiration_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `authorization` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `amount_alloc` double DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `check_type` int(11) DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_rate_exc` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `curr_selisih` double DEFAULT NULL,
  `no_bukti` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `receipt_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `credit_card_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `jenisuangmuka` int(11) DEFAULT NULL,
  `angsur_no_dari` int(11) DEFAULT NULL,
  `angsur_no_sampai` int(11) DEFAULT NULL,
  `angsur_sisa` double DEFAULT NULL,
  `angsur_lunas` double DEFAULT NULL,
  `angsur_lunas_bunga` int(11) DEFAULT NULL,
  `from_bank` varchar(50) DEFAULT NULL,
  `from_account` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payments: 154 rows
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
REPLACE INTO `payments` (`invoice_number`, `line_number`, `date_paid`, `how_paid`, `how_paid_acct_id`, `credit_card_number`, `expiration_date`, `authorization`, `amount_paid`, `amount_alloc`, `comments`, `check_type`, `curr_code`, `curr_rate`, `curr_rate_exc`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `no_bukti`, `trans_id`, `org_id`, `update_status`, `receipt_by`, `credit_card_type`, `sourceautonumber`, `sourcefile`, `jenisuangmuka`, `angsur_no_dari`, `angsur_no_sampai`, `angsur_sisa`, `angsur_lunas`, `angsur_lunas_bunga`, `from_bank`, `from_account`, `account_number`) VALUES
	('K01-00279', 1, '2016-02-25 08:55:22', 'CASH', 1485, NULL, NULL, NULL, 26142000, 30000000, 0, NULL, NULL, 0, 0, NULL, 0, 0, 'K01-002790225', NULL, NULL, 0, 'kasir', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
	('PJL00170', 154, '2016-03-12 17:00:10', 'CASH', NULL, NULL, NULL, NULL, 1116600, 883400, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;


-- Dumping structure for table simak.payroll_link
CREATE TABLE IF NOT EXISTS `payroll_link` (
  `last_check_file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_gl_file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_bank_account` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_source` int(11) DEFAULT NULL,
  `last_selchecks` int DEFAULT NULL,
  `last_selgl` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payroll_link: 0 rows
/*!40000 ALTER TABLE `payroll_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `payroll_link` ENABLE KEYS */;


-- Dumping structure for table simak.pending_stock_opname
CREATE TABLE IF NOT EXISTS `pending_stock_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `trans` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `artikel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `size1` int(11) DEFAULT NULL,
  `size2` int(11) DEFAULT NULL,
  `size3` int(11) DEFAULT NULL,
  `size4` int(11) DEFAULT NULL,
  `size5` int(11) DEFAULT NULL,
  `size6` int(11) DEFAULT NULL,
  `size7` int(11) DEFAULT NULL,
  `size8` int(11) DEFAULT NULL,
  `size9` int(11) DEFAULT NULL,
  `size10` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `current_price` int(11) DEFAULT NULL,
  `current_total` int(11) DEFAULT NULL,
  `process_count` int(11) DEFAULT NULL,
  `qty_stock` int(11) DEFAULT NULL,
  `qty_adjust` int(11) DEFAULT NULL,
  `color` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.pending_stock_opname: 0 rows
/*!40000 ALTER TABLE `pending_stock_opname` DISABLE KEYS */;
/*!40000 ALTER TABLE `pending_stock_opname` ENABLE KEYS */;


-- Dumping structure for table simak.pending_stock_opname_tmp
CREATE TABLE IF NOT EXISTS `pending_stock_opname_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `trans` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.pending_stock_opname_tmp: 0 rows
/*!40000 ALTER TABLE `pending_stock_opname_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `pending_stock_opname_tmp` ENABLE KEYS */;


-- Dumping structure for table simak.preferences
CREATE TABLE IF NOT EXISTS `preferences` (
  `company_code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `slogan` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `purchase_order_contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `city_state_zip_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fed_tax_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `perpetual_inventory` tinyint(1) DEFAULT NULL,
  `out_of_stock_checking` tinyint(1) DEFAULT NULL,
  `purchase_order_restocking` tinyint(1) DEFAULT NULL,
  `item_categories` tinyint(1) DEFAULT NULL,
  `supplier_numbering` double DEFAULT NULL,
  `default_invoice_type` double DEFAULT NULL,
  `default_bank_account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `default_credit_card_account` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_numbering` double DEFAULT NULL,
  `use_sales_order_number` tinyint(1) DEFAULT NULL,
  `customer_credit_account_number` int(11) DEFAULT NULL,
  `supplier_credit_account_number` int(11) DEFAULT NULL,
  `po_numbering` double DEFAULT NULL,
  `invoice_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__5` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__5` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `inventory_tracking` double DEFAULT NULL,
  `inventory_costing` double DEFAULT NULL,
  `customer_order` double DEFAULT NULL,
  `customer_numbering` double DEFAULT NULL,
  `general_ledger` tinyint(1) DEFAULT NULL,
  `freight_taxable` tinyint(1) DEFAULT NULL,
  `other_taxable` tinyint(1) DEFAULT NULL,
  `accounts_receivable` int(11) DEFAULT NULL,
  `so_freight` int(11) DEFAULT NULL,
  `so_other` int(11) DEFAULT NULL,
  `so_tax` int(11) DEFAULT NULL,
  `so_tax_2` int(11) DEFAULT NULL,
  `so_discounts_given` int(11) DEFAULT NULL,
  `accounts_payable` int(11) DEFAULT NULL,
  `po_freight` int(11) DEFAULT NULL,
  `po_other` int(11) DEFAULT NULL,
  `po_tax` int(11) DEFAULT NULL,
  `po_tax_2` int(11) DEFAULT NULL,
  `po_discounts_taken` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `inventory_sales` int(11) DEFAULT NULL,
  `inventory_cogs` int(11) DEFAULT NULL,
  `maximize_on_640` tinyint(1) DEFAULT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `po_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quote_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `sales_order_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `gl_post_date` int(11) DEFAULT NULL,
  `security` tinyint(1) DEFAULT NULL,
  `sales_selection` int(11) DEFAULT NULL,
  `printed_check_password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `unpost_password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `undeposited_checks` tinyint(1) DEFAULT NULL,
  `autostub` tinyint(1) DEFAULT NULL,
  `startup_company_schedule` tinyint(1) DEFAULT NULL,
  `po_show_items` double DEFAULT NULL,
  `acctproglocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `payrollproglocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `payrolldatalocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `custbalupdated` datetime DEFAULT NULL,
  `display_shiptos` double DEFAULT NULL,
  `version` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `inventorysearch` int(11) DEFAULT NULL,
  `barcodeinventorystandard` tinyint(1) DEFAULT NULL,
  `barcodeinventorywarehouse` tinyint(1) DEFAULT NULL,
  `barcodepo` tinyint(1) DEFAULT NULL,
  `barcodesales` tinyint(1) DEFAULT NULL,
  `invpridec` int(11) DEFAULT NULL,
  `invqtydec` int(11) DEFAULT NULL,
  `payrollsystem` double DEFAULT NULL,
  `poitemdisplay` int(11) DEFAULT NULL,
  `salesitemdisplay` int(11) DEFAULT NULL,
  `salpridec` int(11) DEFAULT NULL,
  `salqtydec` int(11) DEFAULT NULL,
  `state_tax_id` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `gl_post_date_2` int(11) DEFAULT NULL,
  `earning_account` int(11) DEFAULT NULL,
  `year_earning_account` int(11) DEFAULT NULL,
  `historical_balance_account` int(11) DEFAULT NULL,
  `default_cash_payment_account` int(11) DEFAULT NULL,
  `invamtdec` int(11) DEFAULT NULL,
  `salamtdec` int(11) DEFAULT NULL,
  `purpridec` int(11) DEFAULT NULL,
  `purqtydec` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `file_logo` varchar(200) DEFAULT NULL,
  `handphone` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.preferences: 1 rows
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
REPLACE INTO `preferences` (`company_code`, `company_name`, `slogan`, `invoice_contact`, `purchase_order_contact`, `street`, `suite`, `city_state_zip_code`, `phone_number`, `fax_number`, `email`, `fed_tax_id`, `perpetual_inventory`, `out_of_stock_checking`, `purchase_order_restocking`, `item_categories`, `supplier_numbering`, `default_invoice_type`, `default_bank_account_number`, `default_credit_card_account`, `invoice_numbering`, `use_sales_order_number`, `customer_credit_account_number`, `supplier_credit_account_number`, `po_numbering`, `invoice_message_copy__1`, `invoice_message_copy__2`, `invoice_message_copy__3`, `invoice_message_copy__4`, `invoice_message_copy__5`, `po_message_copy__1`, `po_message_copy__2`, `po_message_copy__3`, `po_message_copy__4`, `po_message_copy__5`, `bol_message_copy__1`, `bol_message_copy__2`, `bol_message_copy__3`, `bol_message_copy__4`, `inventory_tracking`, `inventory_costing`, `customer_order`, `customer_numbering`, `general_ledger`, `freight_taxable`, `other_taxable`, `accounts_receivable`, `so_freight`, `so_other`, `so_tax`, `so_tax_2`, `so_discounts_given`, `accounts_payable`, `po_freight`, `po_other`, `po_tax`, `po_tax_2`, `po_discounts_taken`, `inventory`, `inventory_sales`, `inventory_cogs`, `maximize_on_640`, `invoice_number`, `po_number`, `quote_number`, `sales_order_number`, `gl_post_date`, `security`, `sales_selection`, `printed_check_password`, `unpost_password`, `undeposited_checks`, `autostub`, `startup_company_schedule`, `po_show_items`, `acctproglocation`, `payrollproglocation`, `payrolldatalocation`, `custbalupdated`, `display_shiptos`, `version`, `inventorysearch`, `barcodeinventorystandard`, `barcodeinventorywarehouse`, `barcodepo`, `barcodesales`, `invpridec`, `invqtydec`, `payrollsystem`, `poitemdisplay`, `salesitemdisplay`, `salpridec`, `salqtydec`, `state_tax_id`, `gl_post_date_2`, `earning_account`, `year_earning_account`, `historical_balance_account`, `default_cash_payment_account`, `invamtdec`, `salamtdec`, `purpridec`, `purqtydec`, `update_status`, `file_logo`, `handphone`, `country`) VALUES
	('C01', 'PT. Megatax Indotama', NULL, NULL, NULL, 'Apartement Pesona Bahari R1', NULL, 'Jakarta', '0216124706', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1485', '1490', NULL, NULL, 1416, 1421, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1373, 1417, 1482, 1458, NULL, 1416, 1393, 1417, 1482, 1458, NULL, 1421, 1374, 1415, 1419, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1483, 1408, 1411, 1370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_disc
CREATE TABLE IF NOT EXISTS `promosi_disc` (
  `promosi_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `tipe` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  `issameitem` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `outlet` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `disc_base` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `total_sales` double DEFAULT NULL,
  `method` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `flag1` int DEFAULT NULL,
  `flag2` int DEFAULT NULL,
  `flag3` int DEFAULT NULL,
  `flag4` int DEFAULT NULL,
  `flag5` int DEFAULT NULL,
  PRIMARY KEY (`promosi_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_disc: 14 rows
/*!40000 ALTER TABLE `promosi_disc` DISABLE KEYS */;
REPLACE INTO `promosi_disc` (`promosi_code`, `description`, `date_from`, `category`, `date_to`, `tipe`, `qty`, `nilai`, `issameitem`, `update_status`, `outlet`, `disc_base`, `total_sales`, `method`, `create_date`, `create_by`, `update_date`, `update_by`, `flag1`, `flag2`, `flag3`, `flag4`, `flag5`) VALUES
	('Extra Qty', 'Extra Qty Sample', '2013-07-04 00:00:00', 2, '2015-11-13 23:59:59', 0, 2, 1, 0, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Reguler', 'Contoh Disc Reguler', '2013-07-04 00:00:00', 1, '2016-02-23 23:59:59', 2, 0, 0.1, 0, 0, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `promosi_disc` ENABLE KEYS */;

