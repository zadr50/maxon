

-- Dumping structure for table simak.user_job
CREATE TABLE IF NOT EXISTS `user_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `group_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`user_id`,`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.user_job: 49 rows
/*!40000 ALTER TABLE `user_job` DISABLE KEYS */;
REPLACE INTO `user_job` (`id`, `user_id`, `group_id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(252, 'admin', 'ADM', NULL, NULL, NULL),
	(16, 'Kasir', 'INV', NULL, NULL, NULL),
	(17, 'Kasir', 'PUR', NULL, NULL, NULL),
	(18, 'Kasir', 'BYR', NULL, NULL, NULL),
	(45, 'Administrator', 'ADM', NULL, NULL, NULL),
	(115, 'andri', 'SYSMENU', NULL, NULL, NULL),
	(245, 'admin', 'INV', NULL, NULL, NULL),
	(255, 'sales', 'SLSADM', NULL, NULL, NULL),
	(250, 'Spv', 'SPV', NULL, NULL, NULL),
	(254, 'sales', 'SLS', NULL, NULL, NULL),
	(60, 'Kasir', 'FIN', NULL, NULL, NULL),
	(61, 'Administrator', 'ANDRI', NULL, NULL, NULL),
	(200, 'bbb', 'DRV', NULL, NULL, NULL),
	(199, 'bbb', 'COL', NULL, NULL, NULL),
	(244, 'ongkim', 'SLS', NULL, NULL, NULL),
	(68, 'buyer', 'BYR', NULL, NULL, NULL),
	(233, 'gl', 'GL', NULL, NULL, NULL),
	(234, 'andri', 'PUR', NULL, NULL, NULL),
	(235, 'andri', 'TRV', NULL, NULL, NULL),
	(251, 'admin', 'GL', NULL, NULL, NULL),
	(243, 'admin', 'SLS', NULL, NULL, NULL),
	(247, 'admin', 'Gudang', NULL, NULL, NULL),
	(248, 'admin', 'Administrator', NULL, NULL, NULL),
	(249, 'admin', 'SPV', NULL, NULL, NULL),
	(253, 'admin', 'FIN', NULL, NULL, NULL),
	(256, 'gudang', 'Gudang', NULL, NULL, NULL),
	(257, 'finance', 'FIN', NULL, NULL, NULL);
/*!40000 ALTER TABLE `user_job` ENABLE KEYS */;


-- Dumping structure for table simak.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` varchar(50) DEFAULT NULL,
  `roles_type` varchar(50) DEFAULT NULL,
  `roles_item` varchar(50) DEFAULT NULL,
  `roles_value1` double DEFAULT NULL,
  `roles_value2` double DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.user_roles: 4 rows
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
REPLACE INTO `user_roles` (`user_id`, `roles_type`, `roles_item`, `roles_value1`, `roles_value2`, `description`, `id`) VALUES
	('kerawang', '2', 'Kerawang', NULL, NULL, 'Kerawang', 1),
	('admin', '1', 'Kantor', NULL, NULL, 'Kantor', 4),
	('admin', '1', 'Kantor', NULL, NULL, 'Kantor', 5),
	('admin', '1', 'JKT', NULL, NULL, 'JAKARTA', 6);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;


-- Dumping structure for table simak.voucher_master
CREATE TABLE IF NOT EXISTS `voucher_master` (
  `voucher_no` varchar(50) CHARACTER SET utf8 NOT NULL,
  `tanggal_dibuat` datetime DEFAULT NULL,
  `tanggal_aktif` datetime DEFAULT NULL,
  `tanggal_expire` datetime DEFAULT NULL,
  `customer_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `voucher_amt` double DEFAULT NULL,
  `voucher_amt_terpakai` double DEFAULT NULL,
  `voucher_amt_sisa` double DEFAULT NULL,
  `voucher_point` int(11) DEFAULT NULL,
  `voucher_point_terpakai` int(11) DEFAULT NULL,
  `voucher_point_sisa` int(11) DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`voucher_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.voucher_master: 0 rows
/*!40000 ALTER TABLE `voucher_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `voucher_master` ENABLE KEYS */;


-- Dumping structure for table simak.wilayah
CREATE TABLE IF NOT EXISTS `wilayah` (
  `wilayah` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ongkos_kirim` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.wilayah: 2 rows
/*!40000 ALTER TABLE `wilayah` DISABLE KEYS */;
REPLACE INTO `wilayah` (`wilayah`, `update_status`, `kode`, `ongkos_kirim`) VALUES
	('JAKARTA BARAT', NULL, 'JAKBAR', NULL),
	('JAKARTA TIMUR', NULL, 'JAKTIM', NULL);
/*!40000 ALTER TABLE `wilayah` ENABLE KEYS */;


-- Dumping structure for table simak.work_exec
CREATE TABLE IF NOT EXISTS `work_exec` (
  `work_exec_no` varchar(50) NOT NULL DEFAULT '',
  `wo_number` varchar(50) NOT NULL DEFAULT '',
  `start_date` datetime DEFAULT NULL,
  `expected_date` datetime DEFAULT NULL,
  `dept_code` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `person_in_charge` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `wo_customer` varchar(50) NOT NULL,
  PRIMARY KEY (`work_exec_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_exec: 2 rows
/*!40000 ALTER TABLE `work_exec` DISABLE KEYS */;
REPLACE INTO `work_exec` (`work_exec_no`, `wo_number`, `start_date`, `expected_date`, `dept_code`, `comments`, `person_in_charge`, `status`, `wo_customer`) VALUES
	('WOE00008', 'WO-00015', '2015-11-14 07:52:29', '2015-11-14 07:52:29', '', '', 'ANDRI', 0, ''),
	('WOE00009', 'WO-00017', '2016-03-12 00:00:00', '2016-03-12 00:00:00', '', '', '121', 0, '');
/*!40000 ALTER TABLE `work_exec` ENABLE KEYS */;


-- Dumping structure for table simak.work_exec_detail
CREATE TABLE IF NOT EXISTS `work_exec_detail` (
  `work_exec_no` varchar(50) DEFAULT NULL,
  `item_number` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_exec_detail: 2 rows
/*!40000 ALTER TABLE `work_exec_detail` DISABLE KEYS */;
REPLACE INTO `work_exec_detail` (`work_exec_no`, `item_number`, `description`, `quantity`, `unit`, `price`, `total`, `id`) VALUES
	('WOE00008', 'MEJA', 'MEJA KANTOR', 1, 'Pcs', 0, 0, 1),
	('WOE00009', '100', 'Baju Anak Koko', 8, NULL, 0, 0, 2);
/*!40000 ALTER TABLE `work_exec_detail` ENABLE KEYS */;


-- Dumping structure for table simak.work_order
CREATE TABLE IF NOT EXISTS `work_order` (
  `work_order_no` varchar(50) NOT NULL DEFAULT '',
  `start_date` datetime DEFAULT NULL,
  `expected_date` datetime DEFAULT NULL,
  `customer_number` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `wo_status` varchar(50) DEFAULT NULL,
  `special_order` tinyint(1) DEFAULT NULL,
  `sales_order_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`work_order_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_order: 3 rows
/*!40000 ALTER TABLE `work_order` DISABLE KEYS */;
REPLACE INTO `work_order` (`work_order_no`, `start_date`, `expected_date`, `customer_number`, `comments`, `wo_status`, `special_order`, `sales_order_number`) VALUES
	('WO-00015', '2015-11-14 07:50:44', '2015-11-14 07:50:44', '39393', NULL, '', 0, 'SO00099'),
	('WO-00016', '2015-11-15 12:58:39', '2015-11-15 12:58:39', 'MJ', NULL, '0', 0, 'SO00100'),
	('WO-00017', '2016-03-12 00:00:00', '2016-03-12 00:00:00', '101', NULL, '', 0, '4444');
/*!40000 ALTER TABLE `work_order` ENABLE KEYS */;


-- Dumping structure for table simak.work_order_detail
CREATE TABLE IF NOT EXISTS `work_order_detail` (
  `work_order_no` varchar(50) DEFAULT NULL,
  `item_number` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty_exec` double DEFAULT NULL,
  `qty_bal` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_order_detail: 3 rows
/*!40000 ALTER TABLE `work_order_detail` DISABLE KEYS */;
REPLACE INTO `work_order_detail` (`work_order_no`, `item_number`, `description`, `quantity`, `unit`, `price`, `total`, `id`, `qty_exec`, `qty_bal`) VALUES
	('WO-00015', 'MEJA', 'MEJA KANTOR', 1, 'Pcs', 0, 0, 1, 1, 0),
	('WO-00016', 'MEJA', 'MEJA KANTOR', 1, 'Pcs', 0, 0, 2, NULL, NULL),
	('WO-00017', '100', 'Baju Anak Koko', 8, NULL, 50000, 400000, 3, 8, 0);
/*!40000 ALTER TABLE `work_order_detail` ENABLE KEYS */;


-- Dumping structure for table simak.yescalendaricons
CREATE TABLE IF NOT EXISTS `yescalendaricons` (
  `noteiconname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `noteiconcategory` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `noteicon` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.yescalendaricons: 0 rows
/*!40000 ALTER TABLE `yescalendaricons` DISABLE KEYS */;
/*!40000 ALTER TABLE `yescalendaricons` ENABLE KEYS */;


-- Dumping structure for table simak.yes_smartsearchdefinition
CREATE TABLE IF NOT EXISTS `yes_smartsearchdefinition` (
  `searchid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `optionlabel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `listlabel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `rowsource` double DEFAULT NULL,
  `columncount` int(11) DEFAULT NULL,
  `columnwidths` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `boundcolumn` int(11) DEFAULT NULL,
  `textsearchlabel` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `textsearchfield` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `lastselectedoption` int(11) DEFAULT NULL,
  `source_table` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.yes_smartsearchdefinition: 0 rows
/*!40000 ALTER TABLE `yes_smartsearchdefinition` DISABLE KEYS */;
/*!40000 ALTER TABLE `yes_smartsearchdefinition` ENABLE KEYS */;


-- Dumping structure for view simak.qry_coa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_coa` (
	`account` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`account_description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`db_or_cr` VARCHAR(11) NULL COLLATE 'utf8_general_ci',
	`saldo_awal` DOUBLE NULL,
	`parent` VARCHAR(10) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice` (
	`invoice_date` DATETIME NULL,
	`invoice_number` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`sold_to_customer` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`company` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`due_date` DATETIME NULL,
	`payment_terms` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`salesman` VARCHAR(30) NULL COLLATE 'utf8_general_ci',
	`amount` DOUBLE NULL,
	`sales_order_number` VARCHAR(22) NULL COLLATE 'utf8_general_ci',
	`payment` DOUBLE NULL,
	`retur` DOUBLE NULL,
	`cr_amount` DOUBLE NULL,
	`db_amount` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_credit
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_credit` (
	`docnumber` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`cr_amount` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_debit
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_debit` (
	`docnumber` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`db_amount` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_header_sum
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_header_sum` (
	`loan_id` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`z_pokok` DOUBLE NULL,
	`z_pokok_paid` DOUBLE NULL,
	`z_saldo_pokok` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_lancar_macet
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_lancar_macet` (
	`loan_id` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`tahun` INT(4) NULL,
	`bulan` INT(2) NULL,
	`lancar` DECIMAL(23,0) NULL,
	`kurang` DECIMAL(23,0) NULL,
	`macet` DECIMAL(23,0) NULL,
	`lancar_amt` DOUBLE NULL,
	`kurang_amt` DOUBLE NULL,
	`macet_amt` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_payment
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_payment` (
	`invoice_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`payment` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_retur
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_retur` (
	`your_order__` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`retur` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_adj
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_adj` (
	`tanggal` DATETIME NULL,
	`jenis` VARCHAR(10) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` BIGINT(11) NULL,
	`qty_keluar` BIGINT(11) NULL,
	`price` INT(1) NOT NULL,
	`cost` DOUBLE NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` INT(1) NOT NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_delivery
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_delivery` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(11) NOT NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` INT(1) NOT NULL,
	`qty_keluar` DOUBLE(19,2) NULL,
	`unit` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE(11,2) NULL,
	`cost` DOUBLE NULL,
	`discount` DOUBLE(11,2) NULL,
	`discount_amount` DOUBLE NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`rate` DOUBLE NULL,
	`customer` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` DOUBLE(11,2) NULL,
	`multi_unit` VARCHAR(25) NULL COLLATE 'utf8_general_ci',
	`mu_harga` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_etc_out
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_etc_out` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(7) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` INT(1) NOT NULL,
	`qty_keluar` BIGINT(11) NULL,
	`unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`discount` INT(1) NOT NULL,
	`discount_amount` INT(1) NOT NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(3) NOT NULL COLLATE 'utf8_general_ci',
	`rate` INT(1) NOT NULL,
	`supplier` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` INT(11) NULL,
	`multi_unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_price` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_invoice
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_invoice` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(18) NOT NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` DOUBLE(19,2) NULL,
	`qty_keluar` DOUBLE NULL,
	`unit` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE(11,2) NULL,
	`cost` DOUBLE NULL,
	`discount` DOUBLE(11,2) NULL,
	`discount_amount` DOUBLE NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`rate` DOUBLE NULL,
	`customer` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` DOUBLE(11,2) NULL,
	`multi_unit` VARCHAR(25) NULL COLLATE 'utf8_general_ci',
	`mu_harga` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_purchase
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_purchase` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(11) NOT NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(18) NOT NULL COLLATE 'utf8_general_ci',
	`terms` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` DOUBLE(11,2) NULL,
	`qty_keluar` DOUBLE NULL,
	`unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`discount` DOUBLE(11,2) NULL,
	`disc_amount_1` DOUBLE NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` BIGINT(20) NOT NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`mata_uang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`rate` DOUBLE NULL,
	`supplier_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_qty` DOUBLE(11,0) NULL,
	`multi_unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_harga` DOUBLE NULL,
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_receipt
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_receipt` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(7) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` BIGINT(11) NULL,
	`qty_keluar` BIGINT(11) NULL,
	`unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`discount` INT(1) NOT NULL,
	`discount_amount` INT(1) NOT NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(3) NOT NULL COLLATE 'utf8_general_ci',
	`rate` INT(1) NOT NULL,
	`supplier` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` INT(11) NULL,
	`multi_unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_price` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_transfer
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_transfer` (
	`tanggal` DATETIME NULL,
	`jenis` VARCHAR(8) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` BIGINT(20) NULL,
	`qty_keluar` BIGINT(20) NULL,
	`price` BIGINT(20) NOT NULL,
	`cost` BIGINT(20) NOT NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` DOUBLE NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_union
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_union` (
	`tanggal` DATETIME NULL,
	`jenis` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` DOUBLE NULL,
	`qty_keluar` DOUBLE NULL,
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` DOUBLE NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_coa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_coa`;
CREATE VIEW `qry_coa` AS select `coa`.`account` AS `account`,`coa`.`account_description` AS `account_description`,_utf8'D' AS `jenis`,`coa`.`db_or_cr` AS `db_or_cr`,`coa`.`beginning_balance` AS `saldo_awal`,`coa`.`group_type` AS `parent` from `chart_of_accounts` `coa` union all select `grg`.`group_type` AS `group_type`,`grg`.`group_name` AS `group_name`,_utf8'H' AS `jenis`,_utf8'' AS `Unknown`,NULL AS `0`,`grg`.`parent_group_type` AS `parent_group_type` from `gl_report_groups` `grg` ;


-- Dumping structure for view simak.qry_invoice
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice`;
CREATE VIEW `qry_invoice` AS select `i`.`invoice_date` AS `invoice_date`,`i`.`invoice_number` AS `invoice_number`,`i`.`sold_to_customer` AS `sold_to_customer`,`c`.`company` AS `company`,`i`.`due_date` AS `due_date`,`i`.`payment_terms` AS `payment_terms`,`i`.`salesman` AS `salesman`,`i`.`amount` AS `amount`,`i`.`sales_order_number` AS `sales_order_number`,`p`.`payment` AS `payment`,`r`.`retur` AS `retur`,`cr`.`cr_amount` AS `cr_amount`,`d`.`db_amount` AS `db_amount` from (((((`invoice` `i` left join `customers` `c` on((`c`.`customer_number` = `i`.`sold_to_customer`))) left join `qry_invoice_payment` `p` on((convert(`p`.`invoice_number` using utf8) = `i`.`invoice_number`))) left join `qry_invoice_retur` `r` on((convert(`r`.`your_order__` using utf8) = `i`.`invoice_number`))) left join `qry_invoice_credit` `cr` on((convert(`cr`.`docnumber` using utf8) = `i`.`invoice_number`))) left join `qry_invoice_debit` `d` on((convert(`d`.`docnumber` using utf8) = `i`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'I') ;


-- Dumping structure for view simak.qry_invoice_credit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_credit`;
CREATE VIEW `qry_invoice_credit` AS select `crdb_memo`.`docnumber` AS `docnumber`,sum(`crdb_memo`.`amount`) AS `cr_amount` from `crdb_memo` where (`crdb_memo`.`transtype` = _utf8'SO-CREDIT MEMO') group by `crdb_memo`.`docnumber` ;


-- Dumping structure for view simak.qry_invoice_debit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_debit`;
CREATE VIEW `qry_invoice_debit` AS select `crdb_memo`.`docnumber` AS `docnumber`,sum(`crdb_memo`.`amount`) AS `db_amount` from `crdb_memo` where (`crdb_memo`.`transtype` = _utf8'SO-DEBIT MEMO') group by `crdb_memo`.`docnumber` ;


-- Dumping structure for view simak.qry_invoice_header_sum
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_header_sum`;
CREATE VIEW `qry_invoice_header_sum` AS select `ls_invoice_header`.`loan_id` AS `loan_id`,sum(`ls_invoice_header`.`pokok`) AS `z_pokok`,sum(`ls_invoice_header`.`pokok_paid`) AS `z_pokok_paid`,(sum(`ls_invoice_header`.`pokok`) - sum(`ls_invoice_header`.`pokok_paid`)) AS `z_saldo_pokok` from `ls_invoice_header` group by `ls_invoice_header`.`loan_id` ;


-- Dumping structure for view simak.qry_invoice_lancar_macet
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_lancar_macet`;
CREATE VIEW `qry_invoice_lancar_macet` AS select `ls_invoice_header`.`loan_id` AS `loan_id`,year(`ls_invoice_header`.`invoice_date`) AS `tahun`,month(`ls_invoice_header`.`invoice_date`) AS `bulan`,sum(if(((`ls_invoice_header`.`hari_telat` >= 0) and (`ls_invoice_header`.`hari_telat` < 7)),1,0)) AS `lancar`,sum(if(((`ls_invoice_header`.`hari_telat` >= 7) and (`ls_invoice_header`.`hari_telat` < 14)),1,0)) AS `kurang`,sum(if((`ls_invoice_header`.`hari_telat` >= 14),1,0)) AS `macet`,sum(if(((`ls_invoice_header`.`hari_telat` >= 0) and (`ls_invoice_header`.`hari_telat` < 7)),`ls_invoice_header`.`amount`,0)) AS `lancar_amt`,sum(if(((`ls_invoice_header`.`hari_telat` >= 7) and (`ls_invoice_header`.`hari_telat` < 14)),`ls_invoice_header`.`amount`,0)) AS `kurang_amt`,sum(if((`ls_invoice_header`.`hari_telat` >= 14),`ls_invoice_header`.`amount`,0)) AS `macet_amt` from `ls_invoice_header` group by `ls_invoice_header`.`loan_id`,year(`ls_invoice_header`.`invoice_date`),month(`ls_invoice_header`.`invoice_date`) ;


-- Dumping structure for view simak.qry_invoice_payment
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_payment`;
CREATE VIEW `qry_invoice_payment` AS select `payments`.`invoice_number` AS `invoice_number`,sum(`payments`.`amount_paid`) AS `payment` from `payments` group by `payments`.`invoice_number` ;


-- Dumping structure for view simak.qry_invoice_retur
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_retur`;
CREATE VIEW `qry_invoice_retur` AS select `invoice`.`your_order__` AS `your_order__`,sum(`invoice`.`amount`) AS `retur` from `invoice` where (`invoice`.`invoice_type` = _utf8'R') group by `invoice`.`invoice_number` ;


-- Dumping structure for view simak.qry_kartustock_adj
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_adj`;
CREATE VIEW `qry_kartustock_adj` AS select `i`.`date_trans` AS `tanggal`,_utf8'Adjustment' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(if((`i`.`to_qty` > 0),`i`.`to_qty`,0)) AS `qty_masuk`,abs(if((`i`.`to_qty` < 0),`i`.`to_qty`,0)) AS `qty_keluar`,0 AS `price`,`i`.`cost` AS `cost`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) ;


-- Dumping structure for view simak.qry_kartustock_delivery
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_delivery`;
CREATE VIEW `qry_kartustock_delivery` AS select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,0 AS `qty_masuk`,abs(`il`.`quantity`) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'D') ;


-- Dumping structure for view simak.qry_kartustock_etc_out
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_etc_out`;
CREATE VIEW `qry_kartustock_etc_out` AS select `pp`.`date_received` AS `tanggal`,`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`pp`.`quantity_received`) AS `qty_keluar`,`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,`pp`.`cost` AS `cost`,0 AS `discount`,0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,`pp`.`warehouse_code` AS `gudang`,_utf8'IDR' AS `mata_uang`,1 AS `rate`,`pp`.`supplier_number` AS `supplier`,`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,`pp`.`multi_unit` AS `multi_unit`,`pp`.`mu_price` AS `mu_price` from (`inventory_products` `pp` left join `inventory` `s` on((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` = _utf8'ETC_OUT') ;


-- Dumping structure for view simak.qry_kartustock_invoice
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_invoice`;
CREATE VIEW `qry_kartustock_invoice` AS select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Faktur Jual Kontan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where ((`i`.`invoice_type` = _utf8'I') and (`i`.`payment_terms` in (_utf8'Cash',_utf8'',_utf8'Tunai',_utf8'Kontan'))) union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where ((`i`.`invoice_type` = _utf8'D') and (`il`.`from_line_type` = _utf8'SO')) union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Retur Jual' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,abs(`il`.`quantity`) AS `qty_masuk`,0 AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'R') union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Konsinyasi' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'K') ;


-- Dumping structure for view simak.qry_kartustock_purchase
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_purchase`;
CREATE VIEW `qry_kartustock_purchase` AS select `p`.`po_date` AS `tanggal`,_utf8'BELI_KONTAN' AS `tipe`,_utf8'Faktur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,`pi`.`description` AS `description`,`pi`.`quantity` AS `qty_masuk`,0 AS `qty_keluar`,`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,`p`.`comments` AS `comments` from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) where ((`p`.`potype` = _utf8'I') and (`p`.`terms` in (_utf8'',_utf8'CASH',_utf8'TUNAI',_utf8'KONTAN'))) union all select `p`.`po_date` AS `tanggal`,_utf8'RET_BELI' AS `tipe`,_utf8'Retur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,`pi`.`description` AS `description`,0 AS `qty_masuk`,abs(`pi`.`quantity`) AS `qty_keluar`,`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,`p`.`comments` AS `comments` from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) where (`p`.`potype` = _utf8'R') ;


-- Dumping structure for view simak.qry_kartustock_receipt
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_receipt`;
CREATE VIEW `qry_kartustock_receipt` AS select `pp`.`date_received` AS `tanggal`,`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(if((`pp`.`quantity_received` > 0),`pp`.`quantity_received`,0)) AS `qty_masuk`,abs(if((`pp`.`quantity_received` < 0),`pp`.`quantity_received`,0)) AS `qty_keluar`,`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,`pp`.`cost` AS `cost`,0 AS `discount`,0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,`pp`.`warehouse_code` AS `gudang`,_utf8'IDR' AS `mata_uang`,1 AS `rate`,`pp`.`supplier_number` AS `supplier`,`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,`pp`.`multi_unit` AS `multi_unit`,`pp`.`mu_price` AS `mu_price` from (`inventory_products` `pp` left join `inventory` `s` on((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` not in (_utf8'INVOICE',_utf8'RET_BELI',_utf8'ETC_OUT')) ;


-- Dumping structure for view simak.qry_kartustock_transfer
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_transfer`;
CREATE VIEW `qry_kartustock_transfer` AS select `i`.`date_trans` AS `tanggal`,_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`i`.`to_qty`) AS `qty_keluar`,0 AS `price`,0 AS `cost`,0 AS `amount_masuk`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_keluar`,`i`.`from_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`) union all select `i`.`date_trans` AS `tanggal`,_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(`i`.`to_qty`) AS `qty_masuk`,0 AS `qty_keluar`,0 AS `price`,0 AS `cost`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`) ;


-- Dumping structure for view simak.qry_kartustock_union
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_union`;
CREATE VIEW `qry_kartustock_union` AS select `i`.`tanggal` AS `tanggal`,`i`.`jenis` AS `jenis`,`i`.`no_sumber` AS `no_sumber`,`i`.`item_number` AS `item_number`,`i`.`description` AS `description`,`i`.`qty_masuk` AS `qty_masuk`,`i`.`qty_keluar` AS `qty_keluar`,`i`.`price` AS `price`,`i`.`cost` AS `cost`,if((`i`.`qty_masuk` > 0),(`i`.`cost` * `i`.`qty_masuk`),0) AS `amount_masuk`,if((`i`.`qty_masuk` > 0),0,(`i`.`cost` * `i`.`qty_keluar`)) AS `amount_keluar`,`i`.`gudang` AS `gudang`,`i`.`comments` AS `comments` from `qry_kartustock_invoice` `i` where (`i`.`item_number` is not null) union all select `r`.`tanggal` AS `tanggal`,`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,`r`.`item_number` AS `item_number`,`r`.`description` AS `description`,`r`.`qty_masuk` AS `qty_masuk`,`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,`r`.`cost` AS `cost`,if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_receipt` `r` union all select `r`.`tanggal` AS `tanggal`,`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,`r`.`item_number` AS `item_number`,`r`.`description` AS `description`,`r`.`qty_masuk` AS `qty_masuk`,`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,`r`.`cost` AS `cost`,if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_etc_out` `r` union all select `p`.`tanggal` AS `tanggal`,`p`.`jenis` AS `jenis`,`p`.`no_sumber` AS `no_sumber`,`p`.`item_number` AS `item_number`,`p`.`description` AS `description`,`p`.`qty_masuk` AS `qty_masuk`,`p`.`qty_keluar` AS `qty_keluar`,`p`.`price` AS `price`,`p`.`cost` AS `cost`,`p`.`amount_masuk` AS `amount_masuk`,`p`.`amount_keluar` AS `amount_keluar`,`p`.`gudang` AS `gudang`,`p`.`comments` AS `comments` from `qry_kartustock_purchase` `p` union all select `adj`.`tanggal` AS `tanggal`,`adj`.`jenis` AS `jenis`,`adj`.`no_sumber` AS `no_sumber`,`adj`.`item_number` AS `item_number`,`adj`.`description` AS `description`,`adj`.`qty_masuk` AS `qty_masuk`,`adj`.`qty_keluar` AS `qty_keluar`,`adj`.`price` AS `price`,`adj`.`cost` AS `cost`,`adj`.`amount_masuk` AS `amount_masuk`,`adj`.`amount_keluar` AS `amount_keluar`,`adj`.`gudang` AS `gudang`,`adj`.`comments` AS `comments` from `qry_kartustock_adj` `adj` union all select `trn`.`tanggal` AS `tanggal`,`trn`.`jenis` AS `jenis`,`trn`.`no_sumber` AS `no_sumber`,`trn`.`item_number` AS `item_number`,`trn`.`description` AS `description`,`trn`.`qty_masuk` AS `qty_masuk`,`trn`.`qty_keluar` AS `qty_keluar`,`trn`.`price` AS `price`,`trn`.`cost` AS `cost`,`trn`.`amount_masuk` AS `amount_masuk`,`trn`.`amount_keluar` AS `amount_keluar`,`trn`.`gudang` AS `gudang`,`trn`.`comments` AS `comments` from `qry_kartustock_transfer` `trn` ;

-- ----------------------------
-- View structure for qry_kartu_hutang
-- ----------------------------
DROP TABLE IF EXISTS `qry_kartu_hutang`;
CREATE VIEW `qry_kartu_hutang` AS select `payables`.`invoice_date` AS `Tanggal`,if(`payables`.`purchase_order`,`payables`.`purchase_order_number`,`payables`.`bill_id`) AS `NoBukti`,`payables`.`bill_id` AS `Ref1`,`payables`.`invoice_number` AS `ref2`,'Faktur' AS `Jenis`,`payables`.`supplier_number` AS `Supplier_Number`,`payables`.`amount` AS `amount` from `payables` union all select `pp`.`date_paid` AS `date_paid`,`cw`.`voucher` AS `voucher`,`pp`.`bill_id` AS `bill_id`,`pp`.`trans_id` AS `trans_id`,'Bayar' AS `jenis`,`p`.`supplier_number` AS `supplier_number`,(-(1) * `pp`.`amount_paid`) AS `jumlah` from ((`payables_payments` `pp` left join `payables` `p` on((`p`.`bill_id` = `pp`.`bill_id`))) left join `check_writer` `cw` on((`cw`.`trans_id` = `pp`.`trans_id`))) union all select `purchase_order`.`po_date` AS `po_date`,`purchase_order`.`purchase_order_number` AS `purchase_order_number`,`purchase_order`.`po_ref` AS `po_ref`,'' AS `ref2`,'Retur' AS `jenis`,`purchase_order`.`supplier_number` AS `supplier_number`,(-(1) * abs(`purchase_order`.`saldo_invoice`)) AS `jumlah` from `purchase_order` where (`purchase_order`.`potype` = 'R') union all select `c`.`tanggal` AS `tanggal`,`c`.`kodecrdb` AS `kodecrdb`,`c`.`docnumber` AS `docnumber`,'' AS `ref2`,'Debit Memo' AS `jenis`,`p`.`supplier_number` AS `supplier_number`,(-(1) * abs(`c`.`amount`)) AS `jumlah` from (`crdb_memo` `c` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `c`.`docnumber`))) where (`c`.`transtype` = 'PO-DEBIT MEMO') union all select `c`.`tanggal` AS `tanggal`,`c`.`kodecrdb` AS `kodecrdb`,`c`.`docnumber` AS `docnumber`,'' AS `ref2`,'Credit Memo' AS `jenis`,`p`.`supplier_number` AS `supplier_number`,`c`.`amount` AS `amount` from (`crdb_memo` `c` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `c`.`docnumber`))) where (`c`.`transtype` = 'PO-CREDIT MEMO');

-- ----------------------------
-- View structure for qry_kartu_piutang
-- ----------------------------
DROP TABLE IF EXISTS `qry_kartu_piutang`;
CREATE VIEW `qry_kartu_piutang` AS select `invoice`.`invoice_type` AS `Jenis`,`invoice`.`invoice_number` AS `Ref`,`invoice`.`invoice_number` AS `NoBukti`,`invoice`.`invoice_date` AS `Tanggal`,`invoice`.`amount` AS `Amount`,`invoice`.`sold_to_customer` AS `customer_number` from `invoice` where (`invoice`.`invoice_type` = 'I') union all select `invoice`.`invoice_type` AS `Jenis`,`invoice`.`your_order__` AS `Ref`,`invoice`.`invoice_number` AS `NoBukti`,`invoice`.`invoice_date` AS `Tanggal`,(`invoice`.`amount` * -(1)) AS `Jumlah`,`invoice`.`sold_to_customer` AS `customer_number` from `invoice` where (`invoice`.`invoice_type` = 'R') union all select 'P' AS `Jenis`,`p`.`invoice_number` AS `Ref`,`p`.`no_bukti` AS `no_bukti`,`p`.`date_paid` AS `date_paid`,(`p`.`amount_paid` * -(1)) AS `jumlah`,`i`.`sold_to_customer` AS `customer_number` from (`payments` `p` left join `invoice` `i` on((`p`.`invoice_number` = `i`.`invoice_number`))) union all select 'C' AS `Jenis`,`crdb_memo`.`docnumber` AS `DocNumber`,`crdb_memo`.`kodecrdb` AS `KodeCrDb`,`crdb_memo`.`tanggal` AS `Tanggal`,(-(1) * `crdb_memo`.`amount`) AS `jumlah`,'unknown' AS `unknown` from `crdb_memo` where (`crdb_memo`.`transtype` = 'SO-CREDIT MEMO') union all select 'C' AS `Jenis`,`crdb_memo`.`docnumber` AS `DocNumber`,`crdb_memo`.`kodecrdb` AS `KodeCrDb`,`crdb_memo`.`tanggal` AS `Tanggal`,`crdb_memo`.`amount` AS `Amount`,'unknown' AS `unknown` from `crdb_memo` where (`crdb_memo`.`transtype` = 'SO-DEBIT MEMO');
