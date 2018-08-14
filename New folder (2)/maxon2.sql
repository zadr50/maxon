
-- Dumping structure for table simak.promosi_extra_item
CREATE TABLE IF NOT EXISTS `promosi_extra_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `table_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`promosi_code`,`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_extra_item: 0 rows
/*!40000 ALTER TABLE `promosi_extra_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_extra_item` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_item
CREATE TABLE IF NOT EXISTS `promosi_item` (
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `table_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`promosi_code`,`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_item: 0 rows
/*!40000 ALTER TABLE `promosi_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_item` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_item_category
CREATE TABLE IF NOT EXISTS `promosi_item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_item_category: 0 rows
/*!40000 ALTER TABLE `promosi_item_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_item_category` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_item_customer
CREATE TABLE IF NOT EXISTS `promosi_item_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cust_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_item_customer: 0 rows
/*!40000 ALTER TABLE `promosi_item_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_item_customer` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_outlet
CREATE TABLE IF NOT EXISTS `promosi_outlet` (
  `outlet` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_outlet: 0 rows
/*!40000 ALTER TABLE `promosi_outlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_outlet` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_point_transactions
CREATE TABLE IF NOT EXISTS `promosi_point_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jenis_transaksi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `ref1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_point_transactions: 0 rows
/*!40000 ALTER TABLE `promosi_point_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_point_transactions` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_time
CREATE TABLE IF NOT EXISTS `promosi_time` (
  `time_value` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_time: 0 rows
/*!40000 ALTER TABLE `promosi_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_time` ENABLE KEYS */;


-- Dumping structure for table simak.purchase_order
CREATE TABLE IF NOT EXISTS `purchase_order` (
  `purchase_order_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `po_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `inv_date` datetime DEFAULT NULL,
  `ship_to_contact` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `bill_to_contact` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `ordered_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `terms` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fob` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ship_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `approved_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `received` tinyint(1) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `ship_customer_display` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bill_customer_display` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `posted` tinyint(1) DEFAULT NULL,
  `posting_gl_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `potype` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `po_ref` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `uang_muka` double DEFAULT NULL,
  `saldo_invoice` double DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `currency_code` varchar(50) DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  `division_code` varchar(50) DEFAULT NULL,
  `dept_code` varchar(50) DEFAULT NULL,
  `doc_status` varchar(50) DEFAULT NULL,
  `project_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`purchase_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.purchase_order: 6 rows
/*!40000 ALTER TABLE `purchase_order` DISABLE KEYS */;
REPLACE INTO `purchase_order` (`purchase_order_number`, `supplier_number`, `po_date`, `due_date`, `inv_date`, `ship_to_contact`, `bill_to_contact`, `ordered_by`, `terms`, `fob`, `shipped_via`, `ship_date`, `approved_by`, `approved_date`, `freight`, `tax`, `tax_2`, `other`, `received`, `paid`, `ship_customer_display`, `bill_customer_display`, `posted`, `posting_gl_id`, `discount`, `potype`, `po_ref`, `uang_muka`, `saldo_invoice`, `comments`, `account_id`, `disc_amount_1`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `org_id`, `update_status`, `amount`, `type_of_invoice`, `update_date`, `tax_amount`, `warehouse_code`, `currency_code`, `currency_rate`, `subtotal`, `branch_code`, `division_code`, `dept_code`, `doc_status`, `project_code`) VALUES
	('PI00019', 'ALFAMART', '2016-02-01 00:00:00', '2016-02-27 00:00:00', NULL, NULL, NULL, NULL, '60 Hari', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'I', NULL, NULL, 2300000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2300000, NULL, NULL, 0, NULL, NULL, NULL, 2300000, NULL, NULL, NULL, NULL, NULL),
	('PI00020', 'AM', '2016-02-02 00:00:00', '2016-02-27 00:00:00', NULL, NULL, NULL, NULL, 'Kredit 30 Hari', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'I', NULL, NULL, 500000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 500000, NULL, NULL, 0, NULL, NULL, NULL, 500000, NULL, NULL, NULL, NULL, NULL),
	('PI00021', 'JKT.KI', '2016-01-01 00:00:00', '2016-02-27 00:00:00', NULL, NULL, NULL, NULL, 'KREDIT', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'I', NULL, NULL, 1500000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1500000, NULL, NULL, 0, NULL, NULL, NULL, 1500000, NULL, NULL, NULL, NULL, NULL),
	('POR-00003', NULL, '2016-03-12 17:15:49', '2016-03-12 00:00:00', NULL, NULL, NULL, 'ANDRI', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'Q', NULL, NULL, 250000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 250000, NULL, NULL, 0, NULL, NULL, NULL, 250000, 'KRW', NULL, '', 'OPEN', 'dfafasf'),
	('PO00278', 'ALFAMART', '2016-04-11 00:00:00', '2016-04-11 00:00:00', NULL, NULL, NULL, NULL, '60 Hari', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'O', NULL, NULL, 180000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 180000, NULL, NULL, 0, NULL, NULL, NULL, 180000, NULL, NULL, NULL, NULL, NULL),
	('PO00279', 'ALFAMART', '2016-04-11 00:00:00', '2016-04-11 00:00:00', NULL, NULL, NULL, NULL, 'KREDIT', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'O', NULL, NULL, 90000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90000, NULL, NULL, 0, NULL, NULL, NULL, 90000, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `purchase_order` ENABLE KEYS */;


-- Dumping structure for table simak.purchase_order_lineitems
CREATE TABLE IF NOT EXISTS `purchase_order_lineitems` (
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `stock_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_expec` datetime DEFAULT NULL,
  `date_recvd` datetime DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double DEFAULT NULL,
  `received` tinyint(1) DEFAULT NULL,
  `comment` double DEFAULT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `qty_recvd` double(11,2) DEFAULT NULL,
  `quantity` double(11,2) DEFAULT NULL,
  `discount` double(11,2) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `multi_unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(11,0) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `inventory_account` int(11) DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double(11,2) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,2) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `from_line_number` int(11) DEFAULT NULL,
  `from_line_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `from_line_doc` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `retail` double DEFAULT NULL,
  `dept` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dept_sub` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `price_margin` int(11) DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `selected` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.purchase_order_lineitems: 8 rows
/*!40000 ALTER TABLE `purchase_order_lineitems` DISABLE KEYS */;
REPLACE INTO `purchase_order_lineitems` (`purchase_order_number`, `line_number`, `item_number`, `stock_item_number`, `date_expec`, `date_recvd`, `description`, `price`, `received`, `comment`, `serial_number`, `color`, `size`, `qty_recvd`, `quantity`, `discount`, `total_price`, `unit`, `currency_code`, `currency_rate`, `multi_unit`, `mu_qty`, `mu_harga`, `forex_price`, `base_curr_amount`, `inventory_account`, `disc_amount_1`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `update_status`, `from_line_number`, `from_line_type`, `from_line_doc`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`, `retail`, `dept`, `dept_sub`, `price_margin`, `warehouse_code`, `selected`) VALUES
	('PI00019', 1, 'R001', NULL, NULL, NULL, 'Bir Bintang', 50000, NULL, NULL, NULL, NULL, NULL, NULL, 10.00, 0.00, 500000, NULL, 'IDR', 1, '', 10, 50000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PI00019', 2, '10201', NULL, NULL, NULL, 'Celana Jeans Pria', 120000, NULL, NULL, NULL, NULL, NULL, NULL, 15.00, 0.00, 1800000, 'Pcs', 'IDR', 1, 'Pcs', 15, 120000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PO00279', 8, '100000117', NULL, NULL, NULL, 'ASTER PANEL KALIGRAFI II RED 9X20X25 (9PCS)', 90000, NULL, NULL, NULL, NULL, NULL, NULL, 1.00, 0.00, 90000, 'Pcs', 'IDR', 1, 'Pcs', 1, 90000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);
/*!40000 ALTER TABLE `purchase_order_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.qry_kartu_hutang
CREATE TABLE IF NOT EXISTS `qry_kartu_hutang` (
  `tanggal` datetime DEFAULT NULL,
  `no_bukti` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref2` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `jenis` varchar(10) CHARACTER SET utf8 NOT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_kartu_hutang: 0 rows
/*!40000 ALTER TABLE `qry_kartu_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_kartu_hutang` ENABLE KEYS */;


-- Dumping structure for table simak.qry_kartu_piutang
CREATE TABLE IF NOT EXISTS `qry_kartu_piutang` (
  `jenis` varchar(1) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `no_bukti` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `customer_number` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_kartu_piutang: 0 rows
/*!40000 ALTER TABLE `qry_kartu_piutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_kartu_piutang` ENABLE KEYS */;


-- Dumping structure for table simak.qry_loan_by_counter
CREATE TABLE IF NOT EXISTS `qry_loan_by_counter` (
  `area` varchar(50) DEFAULT NULL,
  `area_name` varchar(150) DEFAULT NULL,
  `counter_id` varchar(50) DEFAULT NULL,
  `counter_name` varchar(150) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `bulan` int(2) DEFAULT NULL,
  `z_loan` double DEFAULT NULL,
  `z_balance` double DEFAULT NULL,
  `z_payment` double DEFAULT NULL,
  `z_pokok` double DEFAULT NULL,
  `z_saldo_pokok_sum` double DEFAULT NULL,
  `z_noa` bigint(21) DEFAULT NULL,
  `z_lancar` decimal(45,0) DEFAULT NULL,
  `z_kurang` decimal(45,0) DEFAULT NULL,
  `z_macet` decimal(45,0) DEFAULT NULL,
  `z_lancar_amt` double DEFAULT NULL,
  `z_kurang_amt` double DEFAULT NULL,
  `z_macet_amt` double DEFAULT NULL,
  `z_price` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_loan_by_counter: 0 rows
/*!40000 ALTER TABLE `qry_loan_by_counter` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_loan_by_counter` ENABLE KEYS */;


-- Dumping structure for table simak.qry_ls_cash_receive
CREATE TABLE IF NOT EXISTS `qry_ls_cash_receive` (
  `jenis` varchar(3) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `no_bukti` varchar(50) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `amount_recv` double DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cust_deal_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `posted` int(11) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `area_name` varchar(150) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `counter_id` varchar(50) DEFAULT NULL,
  `counter_name` varchar(150) DEFAULT NULL,
  `pokok` float DEFAULT NULL,
  `pokok_paid` float DEFAULT NULL,
  `bunga_paid` float DEFAULT NULL,
  `bunga` float DEFAULT NULL,
  `dp_prc` float DEFAULT NULL,
  `z_dp_amount` double DEFAULT NULL,
  `z_admin_amount` double DEFAULT NULL,
  `denda_paid` float DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `saldo` float DEFAULT NULL,
  `saldo_titip` double DEFAULT NULL,
  `denda_tagih` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_ls_cash_receive: 0 rows
/*!40000 ALTER TABLE `qry_ls_cash_receive` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_ls_cash_receive` ENABLE KEYS */;


-- Dumping structure for table simak.qry_payroll_component
CREATE TABLE IF NOT EXISTS `qry_payroll_component` (
  `jenis` varchar(6) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `sifat` varchar(50) DEFAULT NULL,
  `is_variable` smallint(6) DEFAULT NULL,
  `ref_column` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_payroll_component: 0 rows
/*!40000 ALTER TABLE `qry_payroll_component` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_payroll_component` ENABLE KEYS */;


-- Dumping structure for table simak.quotation
CREATE TABLE IF NOT EXISTS `quotation` (
  `sales_order_number` varchar(22) CHARACTER SET utf8 NOT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sold_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `sales_date` datetime DEFAULT NULL,
  `your_order__` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `source_of_order` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salesman` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent` double(11,0) DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent_2` double(11,0) DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double(11,0) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,0) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `create_invoice` int DEFAULT NULL,
  `delivered` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`sales_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.quotation: 0 rows
/*!40000 ALTER TABLE `quotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotation` ENABLE KEYS */;


-- Dumping structure for table simak.quotation_lineitems
CREATE TABLE IF NOT EXISTS `quotation_lineitems` (
  `sales_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` double(11,0) DEFAULT NULL,
  `unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `taxable` int DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `ship_qty` double(11,0) DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `job_reference` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `revenue_acct_id` int(11) DEFAULT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` int(11) DEFAULT NULL,
  `multi_unit` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(255,0) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `disc_2` double(11,0) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,0) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.quotation_lineitems: 0 rows
/*!40000 ALTER TABLE `quotation_lineitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotation_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.region
CREATE TABLE IF NOT EXISTS `region` (
  `region_id` varchar(50) NOT NULL DEFAULT '',
  `region_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.region: 3 rows
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
REPLACE INTO `region` (`region_id`, `region_name`) VALUES
	('JAKBAR', 'Jakarta Barat'),
	('JAKTIM', 'Jakarta Timur'),
	('JAKUT', 'Jakarta Utara');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;


-- Dumping structure for table simak.report_list
CREATE TABLE IF NOT EXISTS `report_list` (
  `report_code` varchar(75) CHARACTER SET utf8 NOT NULL,
  `report_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `report_category` double DEFAULT NULL,
  `query_name` double DEFAULT NULL,
  `description` double DEFAULT NULL,
  `date_selectors` int DEFAULT NULL,
  `category_selectors` int DEFAULT NULL,
  `category_query` varchar(255) DEFAULT NULL,
  `category_text` varchar(255) DEFAULT NULL,
  `category_2_selectors` int DEFAULT NULL,
  `category_2_query` varchar(255) DEFAULT NULL,
  `category_2_text` varchar(255) DEFAULT NULL,
  `image` double DEFAULT NULL,
  `criteriatype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `criteria2type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `report_filename` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field_selection` varchar(255) DEFAULT NULL,
  `date_field_selection` varchar(255) DEFAULT NULL,
  `field_2_selection` varchar(255) DEFAULT NULL,
  `visible` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `criteria3type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category_3_selectors` int DEFAULT NULL,
  `category_3_query` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `category_3_text` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `field_3_selection` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `criteria4type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category_4_selectors` int DEFAULT NULL,
  `category_4_query` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `field_4_selection` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `category_4_text` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `criteria5type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category_5_selectors` int DEFAULT NULL,
  `category_5_query` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `field_5_selection` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `category_5_text` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`report_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.report_list: 0 rows
/*!40000 ALTER TABLE `report_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_list` ENABLE KEYS */;


-- Dumping structure for table simak.rpt_open_to_buy
CREATE TABLE IF NOT EXISTS `rpt_open_to_buy` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `period_mm` int(11) DEFAULT NULL,
  `opening_stock` double DEFAULT NULL,
  `forecast_sales` double DEFAULT NULL,
  `period_forward_cover` double DEFAULT NULL,
  `closing_stock_required` double DEFAULT NULL,
  `intake_required` double DEFAULT NULL,
  `on_order` double DEFAULT NULL,
  `otb_remaining` double DEFAULT NULL,
  `closing_stock` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=397 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.rpt_open_to_buy: 12 rows
/*!40000 ALTER TABLE `rpt_open_to_buy` DISABLE KEYS */;
REPLACE INTO `rpt_open_to_buy` (`item_number`, `period_mm`, `opening_stock`, `forecast_sales`, `period_forward_cover`, `closing_stock_required`, `intake_required`, `on_order`, `otb_remaining`, `closing_stock`, `id`) VALUES
	('00007', 1, 200, 100, 0, 0, 0, 200, 200, 100, 385),
	('00007', 2, 100, 150, 0, 0, 0, 100, 200, 50, 386),
	('00007', 12, 7713.86, 0, 0, 0, 0, 0, 0, 7713.86, 396);
/*!40000 ALTER TABLE `rpt_open_to_buy` ENABLE KEYS */;


-- Dumping structure for table simak.salesman
CREATE TABLE IF NOT EXISTS `salesman` (
  `salesman` varchar(50) CHARACTER SET utf8 NOT NULL,
  `commission_rate_1` int(11) DEFAULT NULL,
  `commission_rate_2` int(11) DEFAULT NULL,
  `salestype` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `lock_report` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`salesman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman: 1 rows
/*!40000 ALTER TABLE `salesman` DISABLE KEYS */;
REPLACE INTO `salesman` (`salesman`, `commission_rate_1`, `commission_rate_2`, `salestype`, `update_status`, `create_date`, `create_by`, `update_date`, `update_by`, `user_id`, `lock_report`) VALUES
	('Andri', 0, 0, 'GROSIR', NULL, NULL, NULL, NULL, NULL, 'admin', 0);
/*!40000 ALTER TABLE `salesman` ENABLE KEYS */;


-- Dumping structure for table simak.salesman_group
CREATE TABLE IF NOT EXISTS `salesman_group` (
  `groupid` varchar(20) CHARACTER SET utf8 NOT NULL,
  `salesman` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `komisiprc` double(11,0) DEFAULT NULL,
  `remarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman_group: 2 rows
/*!40000 ALTER TABLE `salesman_group` DISABLE KEYS */;
REPLACE INTO `salesman_group` (`groupid`, `salesman`, `komisiprc`, `remarks`, `update_status`) VALUES
	('RETAIL', NULL, 10, 'Kelompok Sales Retail', NULL),
	('GROSIR', NULL, 0, 'Kelompok Grosir', NULL);
/*!40000 ALTER TABLE `salesman_group` ENABLE KEYS */;


-- Dumping structure for table simak.salesman_group_komisi
CREATE TABLE IF NOT EXISTS `salesman_group_komisi` (
  `created_date` datetime DEFAULT NULL,
  `groupid` varchar(50) CHARACTER SET utf8 NOT NULL,
  `salesman` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_amount` double DEFAULT NULL,
  `komisi_prc` double(11,0) DEFAULT NULL,
  `komisi_amount` double DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman_group_komisi: 0 rows
/*!40000 ALTER TABLE `salesman_group_komisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `salesman_group_komisi` ENABLE KEYS */;


-- Dumping structure for table simak.salesman_komisi
CREATE TABLE IF NOT EXISTS `salesman_komisi` (
  `low_amount` double DEFAULT NULL,
  `high_amount` double DEFAULT NULL,
  `persen_komisi` double(11,0) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman_komisi: 0 rows
/*!40000 ALTER TABLE `salesman_komisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `salesman_komisi` ENABLE KEYS */;


-- Dumping structure for table simak.sales_order
CREATE TABLE IF NOT EXISTS `sales_order` (
  `sales_order_number` varchar(22) CHARACTER SET utf8 NOT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sold_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `sales_date` datetime DEFAULT NULL,
  `your_order__` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `source_of_order` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salesman` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `back_order` int DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent` double DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent_2` double DEFAULT NULL,
  `create_invoice` int DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `delivered` int(1) DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `uang_muka` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `close_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `close_date` datetime DEFAULT NULL,
  `close_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `approved` int DEFAULT NULL,
  `appr_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `appr_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `appr_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cancel_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cancel_date` datetime DEFAULT NULL,
  `cancel_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `pending_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pending_date` datetime DEFAULT NULL,
  `pending_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `currency_code` varchar(50) DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `paid` int(1) DEFAULT NULL,
  `ship_day` varchar(50) DEFAULT NULL,
  `ship_weight` varchar(50) DEFAULT NULL,
  `ship_no` varchar(50) DEFAULT NULL,
  `supplier_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sales_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sales_order: 7 rows
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
REPLACE INTO `sales_order` (`sales_order_number`, `invoice_number`, `type_of_invoice`, `sold_to_customer`, `ship_to_customer`, `sales_date`, `your_order__`, `source_of_order`, `payment_terms`, `salesman`, `shipped_via`, `tax`, `tax_2`, `freight`, `discount`, `other`, `back_order`, `comments`, `sales_tax_code`, `sales_tax_percent`, `sales_tax2_code`, `sales_tax_percent_2`, `create_invoice`, `disc_amount_1`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `delivered`, `org_id`, `update_status`, `uang_muka`, `amount`, `saldo`, `close_by`, `close_date`, `close_memo`, `approved`, `appr_by`, `appr_date`, `appr_memo`, `status`, `cancel_by`, `cancel_date`, `cancel_memo`, `pending_by`, `pending_date`, `pending_memo`, `create_date`, `create_by`, `update_date`, `update_by`, `due_date`, `currency_code`, `currency_rate`, `subtotal`, `ship_date`, `warehouse_code`, `account_id`, `paid`, `ship_day`, `ship_weight`, `ship_no`, `supplier_number`) VALUES
	('SO00191', NULL, 'Simple', '90120', '90120', '2016-02-25 16:49:13', NULL, NULL, 'PO Net 15', NULL, NULL, 0, 0, 0, 0, 0, NULL, '0', 'PPN', 0, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 11115, 11115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-25 16:50:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, 'KREDIT', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 71544, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 71544, '2016-03-17 18:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00120', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 14560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 14560, '1970-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00121', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12096, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 12096, '1970-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00122', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00123', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00124', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 0, '1970-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;


-- Dumping structure for table simak.sales_order_lineitems
CREATE TABLE IF NOT EXISTS `sales_order_lineitems` (
  `sales_order_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` double(11,0) DEFAULT NULL,
  `unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` double(11,2) DEFAULT NULL,
  `taxable` int(1) DEFAULT NULL,
  `shipped` int(1) DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `ship_qty` double(11,0) DEFAULT NULL,
  `bo_qty` double(11,0) DEFAULT NULL,
  `prev_ship_qty` double(11,0) DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `job_reference` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `revenue_acct_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `multi_unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(11,2) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `disc_2` double(11,2) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,2) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sales_order_lineitems: 9 rows
/*!40000 ALTER TABLE `sales_order_lineitems` DISABLE KEYS */;
REPLACE INTO `sales_order_lineitems` (`sales_order_number`, `line_number`, `item_number`, `quantity`, `unit`, `description`, `price`, `discount`, `taxable`, `shipped`, `ship_date`, `ship_qty`, `bo_qty`, `prev_ship_qty`, `serial_number`, `job_reference`, `comments`, `cost`, `color`, `size`, `warehouse_code`, `revenue_acct_id`, `amount`, `currency_code`, `currency_rate`, `multi_unit`, `mu_qty`, `mu_harga`, `discount_amount`, `forex_price`, `base_curr_amount`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `disc_amount_1`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	('SO00191', 1, '00002', 1, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000, 0.05, NULL, NULL, '2016-02-25 16:49:13', NULL, 0, 0, NULL, NULL, '0', 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 'pcs', 1.00, 10000, 500, 0, 0, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00191', 2, '00007', 1, 'Btl', 'Mizone', 1700, 0.05, NULL, NULL, '2016-02-25 16:49:13', NULL, 0, 0, NULL, NULL, '0', 3500, NULL, NULL, 'Toko', 1415, 1615, 'IDR', 1, 'Btl', 1.00, 1700, 85, 0, 0, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', 3, '100', 1, NULL, 'Baju Anak Koko', 10000, 0.30, NULL, 0, '2016-03-17 18:45:00', 1, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 5040, NULL, NULL, NULL, 1.00, 10000, 3000, NULL, NULL, 0.20, 1400, 0.10, 560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', 4, 'R001', 1, NULL, 'Bir Bintang', 1000, 0.30, NULL, 0, '2016-03-17 18:45:00', 1, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 504, NULL, NULL, NULL, 1.00, 1000, 300, NULL, NULL, 0.20, 140, 0.10, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', 5, '10201', 1, 'Pcs', 'Celana Jeans Pria', 132000, 0.50, NULL, 0, '2016-03-17 18:45:00', 1, NULL, NULL, NULL, NULL, NULL, 120000, NULL, NULL, NULL, NULL, 66000, NULL, NULL, 'Pcs', 1.00, 132000, 66000, NULL, NULL, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00120', 6, 'R001', 20, NULL, 'Bir Bintang', 1000, 0.15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 9520, NULL, NULL, NULL, 20.00, 1000, 3000, NULL, NULL, 0.20, 3400, 0.30, 4080, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00120', 7, '100', 1, NULL, 'Baju Anak Koko', 10000, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 5040, NULL, NULL, NULL, 1.00, 10000, 3000, NULL, NULL, 0.20, 1400, 0.10, 560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00121', 8, '100', 2, NULL, 'Baju Anak Koko', 10000, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 10080, NULL, NULL, NULL, 2.00, 10000, 6000, NULL, NULL, 0.20, 2800, 0.10, 1120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00121', 9, 'R001', 4, NULL, 'Bir Bintang', 1000, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 2016, NULL, NULL, NULL, 4.00, 1000, 1200, NULL, NULL, 0.20, 560, 0.10, 224, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `sales_order_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.sales_tax_rates
CREATE TABLE IF NOT EXISTS `sales_tax_rates` (
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `tax_rate` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sales_tax_rates: 0 rows
/*!40000 ALTER TABLE `sales_tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_tax_rates` ENABLE KEYS */;


-- Dumping structure for table simak.service_jobs
CREATE TABLE IF NOT EXISTS `service_jobs` (
  `job_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `service_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `teknisi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `garansi` int DEFAULT NULL,
  `job_finish` int DEFAULT NULL,
  `ongkos_kerja` double DEFAULT NULL,
  `masalah` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pekerjaan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `biaya_lain` double DEFAULT NULL,
  `total_amt_part` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.service_jobs: 0 rows
/*!40000 ALTER TABLE `service_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_jobs` ENABLE KEYS */;


-- Dumping structure for table simak.service_job_sparepart
CREATE TABLE IF NOT EXISTS `service_job_sparepart` (
  `job_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.service_job_sparepart: 0 rows
/*!40000 ALTER TABLE `service_job_sparepart` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_job_sparepart` ENABLE KEYS */;


-- Dumping structure for table simak.service_order
CREATE TABLE IF NOT EXISTS `service_order` (
  `no_bukti` varchar(50) CHARACTER SET utf8 NOT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alt_phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cust_po` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serv_rep` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `manufacture` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serial` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alt_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `service_amt` double DEFAULT NULL,
  `ongkos_amt` double DEFAULT NULL,
  `kirim_amt` double DEFAULT NULL,
  `lain_amt` double DEFAULT NULL,
  `ppn_prc` double(11,0) DEFAULT NULL,
  `ppn_amt` double DEFAULT NULL,
  `disc_prc` double(11,0) DEFAULT NULL,
  `disc_amt` double DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `selesai` int DEFAULT NULL,
  `part_amt` double DEFAULT NULL,
  `tanggal_akhir_garansi` datetime DEFAULT NULL,
  `source_invoice_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_bukti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.service_order: 0 rows
/*!40000 ALTER TABLE `service_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_order` ENABLE KEYS */;


-- Dumping structure for table simak.shipped_via
CREATE TABLE IF NOT EXISTS `shipped_via` (
  `shipped_via` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telp_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telp_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`shipped_via`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.shipped_via: 0 rows
/*!40000 ALTER TABLE `shipped_via` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipped_via` ENABLE KEYS */;


-- Dumping structure for table simak.shipping_locations
CREATE TABLE IF NOT EXISTS `shipping_locations` (
  `location_number` varchar(15) CHARACTER SET utf8 NOT NULL,
  `address_type` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `attention_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`location_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.shipping_locations: 4 rows
/*!40000 ALTER TABLE `shipping_locations` DISABLE KEYS */;
REPLACE INTO `shipping_locations` (`location_number`, `address_type`, `attention_name`, `company_name`, `street`, `suite`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `other_phone`, `comments`, `update_status`) VALUES
	('Jakarta', 'Penjualan', 'Udin', NULL, 'Jl. Raya Sadang', NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Cawang', 'Penyimpanan', 'Ibu Dewi', NULL, 'Jl. Raya Halim', NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Kerawang', 'Pabrik', 'Usman', NULL, 'Jl. Raya Dawuan', NULL, 'Kerawang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Gudang', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `shipping_locations` ENABLE KEYS */;


-- Dumping structure for table simak.source_of_order
CREATE TABLE IF NOT EXISTS `source_of_order` (
  `source_of_order` varchar(50) CHARACTER SET utf8 NOT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`source_of_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.source_of_order: 3 rows
/*!40000 ALTER TABLE `source_of_order` DISABLE KEYS */;
REPLACE INTO `source_of_order` (`source_of_order`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('', 0, '', ''),
	('By Invite', NULL, NULL, NULL),
	('By Phone', NULL, NULL, NULL);
/*!40000 ALTER TABLE `source_of_order` ENABLE KEYS */;


-- Dumping structure for table simak.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int(1) DEFAULT NULL,
  `supplier_other_vendor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_vendor` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `salutation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `middle_initial` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `credit_limit` double DEFAULT NULL,
  `fed_tax_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `credit_balance` double DEFAULT NULL,
  `default_account` int(11) DEFAULT NULL,
  `x1099` int DEFAULT NULL,
  `x1099fedwithheld` double DEFAULT NULL,
  `x1099line` int(11) DEFAULT NULL,
  `x1099statewithheld` double DEFAULT NULL,
  `print1099` int DEFAULT NULL,
  `state_tax_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `plafon_hutang` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `acc_biaya` int(11) DEFAULT NULL,
  PRIMARY KEY (`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.suppliers: 30 rows
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
REPLACE INTO `suppliers` (`supplier_number`, `active`, `supplier_other_vendor`, `supplier_account_number`, `type_of_vendor`, `supplier_name`, `salutation`, `first_name`, `middle_initial`, `last_name`, `street`, `suite`, `city`, `state`, `zip_postal_code`, `country`, `phone`, `fax`, `email`, `payment_terms`, `credit_limit`, `fed_tax_id`, `comments`, `credit_balance`, `default_account`, `x1099`, `x1099fedwithheld`, `x1099line`, `x1099statewithheld`, `print1099`, `state_tax_id`, `plafon_hutang`, `org_id`, `update_status`, `create_date`, `create_by`, `update_date`, `update_by`, `acc_biaya`) VALUES
	('3', NULL, NULL, '0', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('A100', NULL, NULL, '0', NULL, 'Asia Jaya, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -27910000, NULL, '0', 31140000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('ALFAMART', NULL, NULL, '1393', 'Konsinyasi', 'ALFAMART', 'Mr.', 'YENI', NULL, NULL, 'JL. RE.MARTADINATA', NULL, 'PURWAKARTA', NULL, NULL, NULL, '0264-393000', '0264-399939', 'YENI@YAHOO.COM', 'PO Net 30', -1562883500, 'PPN', '0', 1628683500, 1393, NULL, NULL, NULL, NULL, NULL, '123.123.122', 20000000, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('AM', NULL, NULL, '0', NULL, 'ARTHA MADIRI', NULL, NULL, NULL, NULL, 'JL. RAYA PELABUHAN', NULL, 'SERANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12500000, NULL, '0', 2550990, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('CATUR', NULL, NULL, '0', NULL, 'CATUR PRATAMA, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('FIF', NULL, NULL, '0', NULL, 'FIF Financial', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000000, NULL, '0', 50000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('JKT.KI', NULL, NULL, '0', NULL, 'KARYA INDAH', NULL, NULL, NULL, NULL, NULL, NULL, 'JKT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 148942400, NULL, '0', 111278000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('MM', NULL, NULL, '0', NULL, 'MAJU MUNDUR, PT', NULL, NULL, NULL, NULL, 'JL. RAYA BEKASI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -26244500, 'PPN', '0', 49234500, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S0010', NULL, NULL, '0', NULL, 'MAJU JAYA, PT', 'Mr.', 'Andri', NULL, NULL, 'Jl. Raya Pangandaran', NULL, 'Purwakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45000000, NULL, '0', 5005000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('SC', NULL, NULL, '0', NULL, 'SUPPLIER CARAKA UTAMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PO Net 30', 1600000, NULL, '0', 1600000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, NULL, NULL, NULL),
	('TIKI', NULL, NULL, '2404', 'Expedisi', 'TIKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PO Net 30', 1700000, 'PPN', '0', 1700000, 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('UNKNOWN', NULL, NULL, '0', NULL, 'UNKNOWN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;


-- Dumping structure for table simak.supplier_beginning_balance
CREATE TABLE IF NOT EXISTS `supplier_beginning_balance` (
  `tanggal` datetime DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `hutang_awal` double DEFAULT NULL,
  `hutang` double DEFAULT NULL,
  `hutang_akhir` double DEFAULT NULL,
  `amountin` double DEFAULT NULL,
  `amountout` double DEFAULT NULL,
  `flagawal` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  UNIQUE KEY `x1` (`tanggal`,`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.supplier_beginning_balance: 0 rows
/*!40000 ALTER TABLE `supplier_beginning_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_beginning_balance` ENABLE KEYS */;


-- Dumping structure for table simak.syslog
CREATE TABLE IF NOT EXISTS `syslog` (
  `tgljam` datetime DEFAULT NULL,
  `computer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `logtext` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `tcp_ip` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.syslog: 801 rows
/*!40000 ALTER TABLE `syslog` DISABLE KEYS */;
REPLACE INTO `syslog` (`tgljam`, `computer`, `userid`, `logtext`, `update_status`, `tcp_ip`, `jenis`) VALUES
	('2014-12-07 00:00:00', NULL, 'xxx', 'x', NULL, NULL, ''),
	('2016-04-11 18:45:19', NULL, 'admin', '', NULL, NULL, 'LOGIN');
/*!40000 ALTER TABLE `syslog` ENABLE KEYS */;


-- Dumping structure for table simak.sysreportdesign
CREATE TABLE IF NOT EXISTS `sysreportdesign` (
  `report_group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `formulas` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `debitorcredit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `plusorminus` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fonttype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colvalue1` double DEFAULT NULL,
  `colvalue2` double DEFAULT NULL,
  `colvalue3` double DEFAULT NULL,
  `colvalue4` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sysreportdesign: 0 rows
/*!40000 ALTER TABLE `sysreportdesign` DISABLE KEYS */;
/*!40000 ALTER TABLE `sysreportdesign` ENABLE KEYS */;


-- Dumping structure for table simak.sysreportdesignfiles
CREATE TABLE IF NOT EXISTS `sysreportdesignfiles` (
  `filename` varchar(50) CHARACTER SET utf8 NOT NULL,
  `report_group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `formulas` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `debitorcredit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `plusorminus` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fonttype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colvalue1` double DEFAULT NULL,
  `colvalue2` double DEFAULT NULL,
  `colvalue3` double DEFAULT NULL,
  `colvalue4` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sysreportdesignfiles: 0 rows
/*!40000 ALTER TABLE `sysreportdesignfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `sysreportdesignfiles` ENABLE KEYS */;


-- Dumping structure for table simak.system_variables
CREATE TABLE IF NOT EXISTS `system_variables` (
  `varname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `varlen` int(11) DEFAULT NULL,
  `varvalue` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `section` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vartype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `varlist` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55426 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.system_variables: 55,051 rows
/*!40000 ALTER TABLE `system_variables` DISABLE KEYS */;
REPLACE INTO `system_variables` (`varname`, `varlen`, `varvalue`, `keterangan`, `id`, `update_status`, `section`, `category`, `vartype`, `varlist`) VALUES
	('A/R Payment Numbering', 14, '!ARP~@-~$00001', '', 1, 1, 'Purchase', 'Auto Numbering', 'String', ''),
	('chatbox_visible', NULL, '', 'auto', 939, NULL, NULL, NULL, NULL, NULL),
	('chatbox_visible', NULL, '', 'auto', 940, NULL, NULL, NULL, NULL, NULL),
	('default_cash_account', NULL, NULL, 'auto', 941, NULL, NULL, NULL, NULL, NULL),
	('format_print', NULL, NULL, 'html', 942, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_price_customers] add field [disc_p', NULL, '1', '', 55425, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `system_variables` ENABLE KEYS */;


-- Dumping structure for table simak.sys_grid
CREATE TABLE IF NOT EXISTS `sys_grid` (
  `selectionindex` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colstr1` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr2` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr3` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr4` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr5` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colnum1` double DEFAULT NULL,
  `colnum2` double DEFAULT NULL,
  `colnum3` double DEFAULT NULL,
  `colnum4` double DEFAULT NULL,
  `colnum5` double DEFAULT NULL,
  `colnum6` double DEFAULT NULL,
  `colnum7` double DEFAULT NULL,
  `colnum8` double DEFAULT NULL,
  `colnum9` double DEFAULT NULL,
  `colnum10` double DEFAULT NULL,
  `colnum11` double DEFAULT NULL,
  `colnum12` double DEFAULT NULL,
  `colnum13` double DEFAULT NULL,
  `colnum14` double DEFAULT NULL,
  `colnum15` double DEFAULT NULL,
  `colnum16` double DEFAULT NULL,
  `colnum17` double DEFAULT NULL,
  `colnum18` double DEFAULT NULL,
  `colnum19` double DEFAULT NULL,
  `colnum20` double DEFAULT NULL,
  `coldate1` datetime DEFAULT NULL,
  `coldate2` datetime DEFAULT NULL,
  `coldate3` datetime DEFAULT NULL,
  `coldate4` datetime DEFAULT NULL,
  `coldate5` datetime DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`selectionindex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_grid: 0 rows
/*!40000 ALTER TABLE `sys_grid` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_grid` ENABLE KEYS */;


-- Dumping structure for table simak.sys_log_run
CREATE TABLE IF NOT EXISTS `sys_log_run` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `param1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1093 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_log_run: 1,092 rows
/*!40000 ALTER TABLE `sys_log_run` DISABLE KEYS */;
REPLACE INTO `sys_log_run` (`id`, `user_id`, `url`, `controller`, `method`, `param1`) VALUES
	(1, 'admin', 'http://localhost/talagasoft/simak/v7.maxon//index.php/welcome_message', NULL, NULL, NULL),
	(2, 'admin', 'http://localhost/talagasoft/simak/v7.maxon//index.php/sales/menu', 'menu', 'load', 'sales'),
	(1092, 'admin', 'http://localhost/talagasoft/simak/v7.maxon//index.php/purchase/purchase_order', 'purchase_order', 'add', NULL);
/*!40000 ALTER TABLE `sys_log_run` ENABLE KEYS */;


-- Dumping structure for table simak.sys_objects
CREATE TABLE IF NOT EXISTS `sys_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_form` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obj_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obj_index` int(11) DEFAULT NULL,
  `prop_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `prop_value` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obj_child` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_objects: 0 rows
/*!40000 ALTER TABLE `sys_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_objects` ENABLE KEYS */;


-- Dumping structure for table simak.sys_tooltip
CREATE TABLE IF NOT EXISTS `sys_tooltip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `help_key` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `help_desc` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_tooltip: 1 rows
/*!40000 ALTER TABLE `sys_tooltip` DISABLE KEYS */;
REPLACE INTO `sys_tooltip` (`id`, `date_created`, `created_by`, `date_updated`, `update_by`, `help_key`, `help_desc`, `sourceautonumber`, `sourcefile`) VALUES
	(1, NULL, 'administrator', NULL, NULL, 'frmReport.TreeView1', 'Daftar Laporan SIMAK Accounting', NULL, NULL);
/*!40000 ALTER TABLE `sys_tooltip` ENABLE KEYS */;


-- Dumping structure for table simak.tbtreeviewdata
CREATE TABLE IF NOT EXISTS `tbtreeviewdata` (
  `id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `parentid` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `text` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `expand` tinyint(1) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table simak.tbtreeviewdata: 10 rows
/*!40000 ALTER TABLE `tbtreeviewdata` DISABLE KEYS */;
REPLACE INTO `tbtreeviewdata` (`id`, `parentid`, `text`, `image`, `expand`, `rank`) VALUES
	('hardware', 'root', 'Hardware', 'Folder.gif', 1, 1),
	('software', 'root', 'Software', 'Folder.gif', 1, 2),
	('ebook', 'root', 'E-books', 'Folder.gif', 1, 4),
	('intel', 'hardware', 'Intel.doc', 'doc.gif', 0, 2),
	('recycle', 'root', 'Recycle', 'xpRecycle.gif', 1, 5),
	('amd', 'software', 'AMD.doc', 'doc.gif', 0, 2),
	('asus', 'hardware', 'Asus.doc', 'doc.gif', 0, 1),
	('windowxp', 'hardware', 'WindowXP.doc', 'doc.gif', 0, 3),
	('linux', 'software', 'Linux.doc', 'doc.gif', 0, 1),
	('macos', '', 'MacOs.doc', 'doc.gif', 0, 1);
/*!40000 ALTER TABLE `tbtreeviewdata` ENABLE KEYS */;


-- Dumping structure for table simak.tb_imageview
CREATE TABLE IF NOT EXISTS `tb_imageview` (
  `ID` int(11) NOT NULL,
  `Small_Image` varchar(30) NOT NULL,
  `Big_Image` varchar(30) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.tb_imageview: 6 rows
/*!40000 ALTER TABLE `tb_imageview` DISABLE KEYS */;
REPLACE INTO `tb_imageview` (`ID`, `Small_Image`, `Big_Image`, `Description`) VALUES
	(1, 'small_image1.jpg', 'big_image1.jpg', 'Color of Autumn'),
	(2, 'small_image2.jpg', 'big_image2.jpg', 'Back to Nature'),
	(3, 'small_image3.jpg', 'big_image3.jpg', 'Beauty of Hawaii '),
	(4, 'small_image4.jpg', 'big_image4.jpg', 'Pure'),
	(5, 'small_image5.jpg', 'big_image5.jpg', 'Dream Home'),
	(6, 'small_image6.jpg', 'big_image6.jpg', 'Imazing Nature');
/*!40000 ALTER TABLE `tb_imageview` ENABLE KEYS */;


-- Dumping structure for table simak.tb_slidemenu
CREATE TABLE IF NOT EXISTS `tb_slidemenu` (
  `ID` varchar(15) NOT NULL,
  `ParentID` varchar(15) NOT NULL,
  `IsChild` tinyint(1) NOT NULL,
  `Text` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.tb_slidemenu: 27 rows
/*!40000 ALTER TABLE `tb_slidemenu` DISABLE KEYS */;
REPLACE INTO `tb_slidemenu` (`ID`, `ParentID`, `IsChild`, `Text`) VALUES
	('companyhome', 'root', 0, 'Company Home'),
	('systemtasks', 'root', 0, 'System Tasks'),
	('otherplaces', 'root', 0, 'Other Places'),
	('OnlineBookLib', 'resources', 1, 'Online Book Library');
/*!40000 ALTER TABLE `tb_slidemenu` ENABLE KEYS */;


-- Dumping structure for table simak.time_card_detail
CREATE TABLE IF NOT EXISTS `time_card_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_no` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `absen_type` int(11) DEFAULT NULL,
  `shift_code` varchar(10) DEFAULT NULL,
  `work_status` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `time_in` varchar(5) DEFAULT NULL,
  `time_out` varchar(5) DEFAULT NULL,
  `time_hour` varchar(5) DEFAULT NULL,
  `ot_in` varchar(5) DEFAULT NULL,
  `ot_out` varchar(5) DEFAULT NULL,
  `ot_hour` varchar(5) DEFAULT NULL,
  `ot_type` varchar(10) DEFAULT NULL,
  `ot_exclude` int(11) DEFAULT NULL,
  `ot_amount` double DEFAULT NULL,
  `tc_1` double DEFAULT NULL,
  `tc_2` double DEFAULT NULL,
  `tc_3` double DEFAULT NULL,
  `tc_4` double DEFAULT NULL,
  `tc_sum` double DEFAULT NULL,
  `tc_run` double DEFAULT NULL,
  `tc_exp` double DEFAULT NULL,
  `free_in` varchar(5) DEFAULT NULL,
  `free_out` varchar(5) DEFAULT NULL,
  `free_hour` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=908 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.time_card_detail: 349 rows
/*!40000 ALTER TABLE `time_card_detail` DISABLE KEYS */;
REPLACE INTO `time_card_detail` (`id`, `salary_no`, `nip`, `absen_type`, `shift_code`, `work_status`, `tanggal`, `time_in`, `time_out`, `time_hour`, `ot_in`, `ot_out`, `ot_hour`, `ot_type`, `ot_exclude`, `ot_amount`, `tc_1`, `tc_2`, `tc_3`, `tc_4`, `tc_sum`, `tc_run`, `tc_exp`, `free_in`, `free_out`, `free_hour`) VALUES
	(1, 0, '121', NULL, NULL, NULL, '2014-04-11 07:00:00', '1', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 0, '122', NULL, NULL, NULL, '2014-04-11 07:00:00', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(825, 0, 'admin', NULL, NULL, NULL, '2015-01-09 00:00:00', '20:26', '22:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `time_card_detail` ENABLE KEYS */;


-- Dumping structure for table simak.trans_type
CREATE TABLE IF NOT EXISTS `trans_type` (
  `type_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `type_inout` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.trans_type: 0 rows
/*!40000 ALTER TABLE `trans_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_type` ENABLE KEYS */;


-- Dumping structure for table simak.trans_typex
CREATE TABLE IF NOT EXISTS `trans_typex` (
  `type_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `type_inout` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.trans_typex: 0 rows
/*!40000 ALTER TABLE `trans_typex` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_typex` ENABLE KEYS */;


-- Dumping structure for table simak.type_of_account
CREATE TABLE IF NOT EXISTS `type_of_account` (
  `type_of_account` varchar(20) CHARACTER SET utf8 NOT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`type_of_account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.type_of_account: 0 rows
/*!40000 ALTER TABLE `type_of_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_of_account` ENABLE KEYS */;


-- Dumping structure for table simak.type_of_payment
CREATE TABLE IF NOT EXISTS `type_of_payment` (
  `type_of_payment` varchar(50) CHARACTER SET utf8 NOT NULL,
  `discount_percent` double DEFAULT NULL,
  `discount_days` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`type_of_payment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.type_of_payment: 4 rows
/*!40000 ALTER TABLE `type_of_payment` DISABLE KEYS */;
REPLACE INTO `type_of_payment` (`type_of_payment`, `discount_percent`, `discount_days`, `days`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('Kredit 30 Hari', 0.12, 30, 30, 0, '', ''),
	('Kredit15 hari', 0.15, 0, 15, 0, '', ''),
	('60 Hari', 0, 30, 60, 0, '', ''),
	('KREDIT', 0, 0, 30, 0, '', '');
/*!40000 ALTER TABLE `type_of_payment` ENABLE KEYS */;


-- Dumping structure for table simak.unit_of_measure
CREATE TABLE IF NOT EXISTS `unit_of_measure` (
  `from_unit` varchar(50) DEFAULT NULL,
  `to_unit` varchar(50) DEFAULT NULL,
  `unit_value` double DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.unit_of_measure: 1 rows
/*!40000 ALTER TABLE `unit_of_measure` DISABLE KEYS */;
REPLACE INTO `unit_of_measure` (`from_unit`, `to_unit`, `unit_value`, `id`) VALUES
	('pcs', 'lusin', 12, 1);
/*!40000 ALTER TABLE `unit_of_measure` ENABLE KEYS */;


-- Dumping structure for table simak.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `path_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `disc_prc_max` double(11,0) DEFAULT NULL,
  `disc_amt_max` double DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `userlevel` varchar(50) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `cid` varchar(10) DEFAULT NULL,
  `supervisor` varchar(50) DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.user: 12 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`user_id`, `username`, `password`, `path_image`, `update_status`, `disc_prc_max`, `disc_amt_max`, `email`, `nip`, `userlevel`, `active`, `cid`, `supervisor`, `branch_code`) VALUES
	('admin', 'admin', 'admin', NULL, 0, 0, 0, '', '', '', 0, 'ALL', '', ''),
	('Administrator', 'Administrator', 'admin', 'bayi-lucu-1.jpg', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('andri', 'andri', '1', 'wonfeihung.jpg', 0, 0, 0, '', '', '', 0, 'C01', 'admin', NULL),
	('buyer', 'buyer', '1', '', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('Kasir', 'kasir', '1', 'kasir.gif', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('sales', 'sales', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', ''),
	('Spv', 'Supervisor', '1', '', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('gl', 'Accounting', '11', NULL, 0, 0, 0, '', '', '', 0, 'C01', NULL, NULL),
	('ongkim', 'ongkim', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', 'PST'),
	('gudang', 'gudang', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', ''),
	('finance', 'finance', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', ''),
	('kerawang', 'kerawang', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', 'KRW');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table simak.user_group_modules
CREATE TABLE IF NOT EXISTS `user_group_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `module_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`group_id`,`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3194 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.user_group_modules: 1,015 rows
/*!40000 ALTER TABLE `user_group_modules` DISABLE KEYS */;
REPLACE INTO `user_group_modules` (`id`, `group_id`, `module_id`, `permission`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(97, 'BYR', '_40110', 0, 1, NULL, NULL),
	(98, 'BYR', '_40120', 0, 1, NULL, NULL),
	(99, 'BYR', '_80010', 0, 1, NULL, NULL),
	(100, 'BYR', '_80020', 0, 1, NULL, NULL),
	(101, 'BYR', '_80030', 0, 1, NULL, NULL),
	(102, 'BYR', '_90070', 0, 1, NULL, NULL),
	(103, 'BYR', '_90071', 0, 1, NULL, NULL),
	(104, 'BYR', '_90072', 0, 1, NULL, NULL),
	(105, 'BYR', '_90073', 0, 1, NULL, NULL),
	(106, 'BYR', '_90075', 0, 1, NULL, NULL),
	(107, 'BYR', '_90076', 0, 1, NULL, NULL),
	(2228, 'Administrator', '_00011', NULL, NULL, NULL, NULL),
	(192, 'SYSMENU', '_10000', 0, NULL, NULL, NULL),
	(193, 'SYSMENU', '_11000', 0, NULL, NULL, NULL),
	(194, 'SYSMENU', '_10060', 0, NULL, NULL, NULL),
	(195, 'SYSMENU', '_30010', 0, 1, NULL, NULL),
	(196, 'SYSMENU', '_30011', 0, 1, NULL, NULL),
	(197, 'SYSMENU', '_30012', 0, 1, NULL, NULL),
	(2227, 'Administrator', '_00010', NULL, NULL, NULL, NULL),
	(307, 'BYR', '_40010', 0, 1, NULL, NULL),
	(308, 'BYR', '_40040', 0, 1, NULL, NULL),
	(309, 'BYR', '_40041', 0, 1, NULL, NULL),
	(310, 'BYR', '_40042', 0, 1, NULL, NULL),
	(311, 'BYR', '_40043', 0, 1, NULL, NULL),
	(312, 'BYR', '_40044', 0, 1, NULL, NULL),
	(313, 'BYR', '_40050', 0, 1, NULL, NULL),
	(314, 'BYR', '_40051', 0, 1, NULL, NULL),
	(315, 'BYR', '_40052', 0, 1, NULL, NULL),
	(316, 'BYR', '_40053', 0, 1, NULL, NULL),
	(372, 'BYR', '_90074', 0, 1, NULL, NULL),
	(373, 'BYR', '_90077', 0, 1, NULL, NULL),
	(374, 'BYR', '_90078', 0, 1, NULL, NULL),
	(375, 'BYR', '_90079', 0, 1, NULL, NULL),
	(376, 'BYR', '_90080', 0, 1, NULL, NULL),
	(377, 'BYR', '_90081', 0, 1, NULL, NULL),
	(378, 'BYR', '_90082', 0, 1, NULL, NULL),
	(379, 'BYR', '_90083', 0, 1, NULL, NULL),
	(380, 'BYR', '_90084', 0, 1, NULL, NULL),
	(381, 'BYR', '_90120', 0, 1, NULL, NULL),
	(382, 'BYR', '_90121', 0, 1, NULL, NULL),
	(383, 'BYR', '_90122', 0, 1, NULL, NULL),
	(384, 'BYR', '_90123', 0, 1, NULL, NULL),
	(385, 'BYR', '_90124', 0, 1, NULL, NULL),
	(386, 'BYR', '_90125', 0, 1, NULL, NULL),
	(387, 'BYR', '_90126', 0, 1, NULL, NULL),
	(388, 'BYR', '_90127', 0, 1, NULL, NULL),
	(389, 'BYR', '_90128', 0, 1, NULL, NULL),
	(390, 'BYR', '_90129', 0, 1, NULL, NULL),
	(391, 'BYR', '_90131', 0, 1, NULL, NULL),
	(392, 'BYR', '_90130', 0, 1, NULL, NULL),
	(393, 'BYR', '_90132', 0, 1, NULL, NULL),
	(3179, 'FIN', '_40090', NULL, NULL, NULL, NULL),
	(3180, 'FIN', '_40091', NULL, NULL, NULL, NULL),
	(2211, 'SPV', '_30000.066', NULL, NULL, NULL, NULL),
	(2210, 'SPV', '_30000.063', NULL, NULL, NULL, NULL),
	(2209, 'SPV', '_30000.059', NULL, NULL, NULL, NULL),
	(2208, 'SPV', '_30000.057', NULL, NULL, NULL, NULL),
	(2207, 'SPV', '_30000.056', NULL, NULL, NULL, NULL),
	(2206, 'SPV', '_30000.054', NULL, NULL, NULL, NULL),
	(2205, 'SPV', '_30000.041', NULL, NULL, NULL, NULL),
	(2204, 'SPV', '_30000.040', NULL, NULL, NULL, NULL),
	(2203, 'SPV', '_30000.039', NULL, NULL, NULL, NULL),
	(2202, 'SPV', '_30000.038', NULL, NULL, NULL, NULL),
	(2201, 'SPV', '_30000.037', NULL, NULL, NULL, NULL),
	(2200, 'SPV', '_30000.036', NULL, NULL, NULL, NULL),
	(2199, 'SPV', '_30000.035', NULL, NULL, NULL, NULL),
	(2198, 'SPV', '_30000.034', NULL, NULL, NULL, NULL),
	(2197, 'SPV', '_30000.032', NULL, NULL, NULL, NULL),
	(2196, 'SPV', '_30000.031', NULL, NULL, NULL, NULL),
	(2195, 'SPV', '_30000.030', NULL, NULL, NULL, NULL),
	(2194, 'SPV', '_30000.029', NULL, NULL, NULL, NULL),
	(2193, 'SPV', '_30000.028', NULL, NULL, NULL, NULL),
	(2192, 'SPV', '_30000.027', NULL, NULL, NULL, NULL),
	(2191, 'SPV', '_30000.026', NULL, NULL, NULL, NULL),
	(2190, 'SPV', '_30000.025', NULL, NULL, NULL, NULL),
	(2189, 'SPV', '_30000.024', NULL, NULL, NULL, NULL),
	(2188, 'SPV', '_30000.023', NULL, NULL, NULL, NULL),
	(2187, 'SPV', '_30000.022', NULL, NULL, NULL, NULL),
	(2186, 'SPV', '_30000.021', NULL, NULL, NULL, NULL),
	(2185, 'SPV', '_30000.020', NULL, NULL, NULL, NULL),
	(2184, 'SPV', '_30000.019', NULL, NULL, NULL, NULL),
	(2183, 'SPV', '_30000.018', NULL, NULL, NULL, NULL),
	(2182, 'SPV', '_30000.014', NULL, NULL, NULL, NULL),
	(2828, 'ADM', '_00011', NULL, NULL, NULL, NULL),
	(2829, 'ADM', '_00012', NULL, NULL, NULL, NULL),
	(2830, 'ADM', '_00013', NULL, NULL, NULL, NULL),
	(2831, 'ADM', '_00020', NULL, NULL, NULL, NULL),
	(2832, 'ADM', '_00021', NULL, NULL, NULL, NULL),
	(2833, 'ADM', '_00022', NULL, NULL, NULL, NULL),
	(2834, 'ADM', '_00023', NULL, NULL, NULL, NULL),
	(2835, 'ADM', '_00050', NULL, NULL, NULL, NULL),
	(2836, 'ADM', '_20000', NULL, NULL, NULL, NULL),
	(2837, 'ADM', '_18000', NULL, NULL, NULL, NULL),
	(2838, 'ADM', '_18000.002', NULL, NULL, NULL, NULL),
	(2839, 'ADM', '_18000.013', NULL, NULL, NULL, NULL),
	(2840, 'ADM', '_18000.100', NULL, NULL, NULL, NULL),
	(2841, 'ADM', '_18000.900', NULL, NULL, NULL, NULL),
	(2842, 'ADM', '_18000.901', NULL, NULL, NULL, NULL),
	(2843, 'ADM', '_30000.0', NULL, NULL, NULL, NULL),
	(2844, 'ADM', '_30000.001', NULL, NULL, NULL, NULL),
	(2845, 'ADM', '_30000.002', NULL, NULL, NULL, NULL),
	(2846, 'ADM', '_30000.003', NULL, NULL, NULL, NULL),
	(2847, 'ADM', '_30000.004', NULL, NULL, NULL, NULL),
	(2848, 'ADM', '_30000.005', NULL, NULL, NULL, NULL),
	(2849, 'ADM', '_30000.006', NULL, NULL, NULL, NULL),
	(2850, 'ADM', '_30000.007', NULL, NULL, NULL, NULL),
	(2851, 'ADM', '_30000.009', NULL, NULL, NULL, NULL),
	(2852, 'ADM', '_30000.012', NULL, NULL, NULL, NULL),
	(2853, 'ADM', '_30000.013', NULL, NULL, NULL, NULL),
	(2854, 'ADM', '_30000.014', NULL, NULL, NULL, NULL),
	(2855, 'ADM', '_30000.015', NULL, NULL, NULL, NULL),
	(2856, 'ADM', '_30000.016', NULL, NULL, NULL, NULL),
	(2857, 'ADM', '_30000.017', NULL, NULL, NULL, NULL),
	(2858, 'ADM', '_30000.018', NULL, NULL, NULL, NULL),
	(2859, 'ADM', '_30000.019', NULL, NULL, NULL, NULL),
	(2860, 'ADM', '_30000.020', NULL, NULL, NULL, NULL),
	(2861, 'ADM', '_30000.021', NULL, NULL, NULL, NULL),
	(2862, 'ADM', '_30000.022', NULL, NULL, NULL, NULL),
	(2863, 'ADM', '_30000.023', NULL, NULL, NULL, NULL),
	(1982, 'PUR', '_80010', NULL, NULL, NULL, NULL),
	(1981, 'PUR', '_80000', NULL, NULL, NULL, NULL),
	(1980, 'PUR', '_40044', NULL, NULL, NULL, NULL),
	(1979, 'PUR', '_40042', NULL, NULL, NULL, NULL),
	(1978, 'PUR', '_40041', NULL, NULL, NULL, NULL),
	(1977, 'PUR', '_40040', NULL, NULL, NULL, NULL),
	(1976, 'PUR', '_40030', NULL, NULL, NULL, NULL),
	(1975, 'PUR', '_40020', NULL, NULL, NULL, NULL),
	(1974, 'PUR', '_40012', NULL, NULL, NULL, NULL),
	(1973, 'PUR', '_40011', NULL, NULL, NULL, NULL),
	(1972, 'PUR', '_40010', NULL, NULL, NULL, NULL),
	(1971, 'PUR', '_40000', NULL, NULL, NULL, NULL),
	(819, 'BYR', 'socustomerEnvelop.rpt', NULL, NULL, NULL, NULL),
	(820, 'BYR', '_10010', NULL, NULL, NULL, NULL),
	(821, 'BYR', '_10020', NULL, NULL, NULL, NULL),
	(822, 'BYR', '_10030', NULL, NULL, NULL, NULL),
	(823, 'BYR', '_10060', NULL, NULL, NULL, NULL),
	(824, 'BYR', '_10064', NULL, NULL, NULL, NULL),
	(825, 'BYR', '_30000.0', NULL, NULL, NULL, NULL),
	(826, 'BYR', '_30010', NULL, NULL, NULL, NULL),
	(827, 'BYR', '_30020', NULL, NULL, NULL, NULL),
	(828, 'BYR', '_30030', NULL, NULL, NULL, NULL),
	(2148, 'INV', '_80100', NULL, NULL, NULL, NULL),
	(2149, 'INV', '_80120', NULL, NULL, NULL, NULL),
	(3115, 'FIN', '_80010.02', NULL, NULL, NULL, NULL),
	(3114, 'FIN', '_80010.01', NULL, NULL, NULL, NULL),
	(3181, 'FIN', '_40092', NULL, NULL, NULL, NULL),
	(3177, 'FIN', '_40081', NULL, NULL, NULL, NULL),
	(3178, 'FIN', '_40082', NULL, NULL, NULL, NULL),
	(1677, 'ANDRI', '_80010.07', NULL, NULL, NULL, NULL),
	(1676, 'ANDRI', '_80010.06', NULL, NULL, NULL, NULL),
	(1675, 'ANDRI', '_80010.05', NULL, NULL, NULL, NULL),
	(1674, 'ANDRI', '_80010.04', NULL, NULL, NULL, NULL),
	(1673, 'ANDRI', '_80010.03', NULL, NULL, NULL, NULL),
	(1672, 'ANDRI', '_80010.02', NULL, NULL, NULL, NULL),
	(1671, 'ANDRI', '_80010.01', NULL, NULL, NULL, NULL),
	(1670, 'ANDRI', '_30170', NULL, NULL, NULL, NULL),
	(1669, 'ANDRI', '_300901', NULL, NULL, NULL, NULL),
	(1668, 'ANDRI', '_300900', NULL, NULL, NULL, NULL),
	(1667, 'ANDRI', '_13000', NULL, NULL, NULL, NULL),
	(1666, 'ANDRI', '_11000', NULL, NULL, NULL, NULL),
	(1665, 'ANDRI', '_10060A', NULL, NULL, NULL, NULL),
	(1664, 'ANDRI', '_00050', NULL, NULL, NULL, NULL),
	(1663, 'ANDRI', '_00040', NULL, NULL, NULL, NULL),
	(1662, 'ANDRI', '_00030', NULL, NULL, NULL, NULL),
	(1661, 'ANDRI', '_00020', NULL, NULL, NULL, NULL),
	(1660, 'ANDRI', '_00010', NULL, NULL, NULL, NULL),
	(1659, 'ANDRI', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
	(1658, 'ANDRI', 'ID_ExportImport', NULL, NULL, NULL, NULL),
	(1657, 'ANDRI', 'frmMain.Addnew', NULL, NULL, NULL, NULL),
	(1114, 'BYR', '_40000', NULL, NULL, NULL, NULL),
	(1115, 'BYR', '_80000', NULL, NULL, NULL, NULL),
	(1116, 'BYR', '_30000', NULL, NULL, NULL, NULL),
	(1117, 'BYR', '_60000', NULL, NULL, NULL, NULL),
	(2226, 'Administrator', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
	(2225, 'Administrator', 'ID_ExportImport', NULL, NULL, NULL, NULL),
	(2156, 'SA', '_18000.003', NULL, NULL, NULL, NULL),
	(1680, 'ANDRI', '_10030', NULL, NULL, NULL, NULL),
	(1678, 'ANDRI', '_10010', NULL, NULL, NULL, NULL),
	(1679, 'ANDRI', '_10020', NULL, NULL, NULL, NULL),
	(1848, 'GM', '_18000.015', NULL, NULL, NULL, NULL),
	(2155, 'SA', '_18000.001', NULL, NULL, NULL, NULL),
	(1686, 'VF', '_18000', NULL, NULL, NULL, NULL),
	(1687, 'VF', '_18000.004', NULL, NULL, NULL, NULL),
	(1847, 'GM', '_18000.005', NULL, NULL, NULL, NULL),
	(1846, 'GM', '_18000', NULL, NULL, NULL, NULL),
	(2870, 'ADM', '_30000.030', NULL, NULL, NULL, NULL),
	(2871, 'ADM', '_30000.031', NULL, NULL, NULL, NULL),
	(2864, 'ADM', '_30000.024', NULL, NULL, NULL, NULL),
	(2865, 'ADM', '_30000.025', NULL, NULL, NULL, NULL),
	(2866, 'ADM', '_30000.026', NULL, NULL, NULL, NULL),
	(2867, 'ADM', '_30000.027', NULL, NULL, NULL, NULL),
	(2868, 'ADM', '_30000.028', NULL, NULL, NULL, NULL),
	(2869, 'ADM', '_30000.029', NULL, NULL, NULL, NULL),
	(1822, 'BS', '_18000.005', NULL, NULL, NULL, NULL),
	(1821, 'BS', '_18000', NULL, NULL, NULL, NULL),
	(1857, 'SV', '_18000', NULL, NULL, NULL, NULL),
	(1825, 'MRISK', '_18000', NULL, NULL, NULL, NULL),
	(1826, 'MRISK', '_18000.007', NULL, NULL, NULL, NULL),
	(1827, 'GMRISK', '_18000', NULL, NULL, NULL, NULL),
	(1828, 'GMRISK', '_18000.014', NULL, NULL, NULL, NULL),
	(2164, 'LSADM', '_18000.020', NULL, NULL, NULL, NULL),
	(2229, 'Administrator', '_00012', NULL, NULL, NULL, NULL),
	(2230, 'Administrator', '_00013', NULL, NULL, NULL, NULL),
	(2163, 'LSADM', '_18000.012', NULL, NULL, NULL, NULL),
	(2162, 'LSADM', '_18000.011', NULL, NULL, NULL, NULL),
	(2161, 'LSADM', '_18000.010', NULL, NULL, NULL, NULL),
	(1849, 'GM', '_30000', NULL, NULL, NULL, NULL),
	(1850, 'GM', '_40000', NULL, NULL, NULL, NULL),
	(1851, 'COL', '_18000', NULL, NULL, NULL, NULL),
	(1852, 'COL', '_18000.011', NULL, NULL, NULL, NULL),
	(1853, 'GMBS', '_18000', NULL, NULL, NULL, NULL),
	(1854, 'GMBS', '_18000.015', NULL, NULL, NULL, NULL),
	(1855, 'RS', '_18000', NULL, NULL, NULL, NULL),
	(1856, 'RS', '_18000.006', NULL, NULL, NULL, NULL),
	(2160, 'LSADM', '_18000.008', NULL, NULL, NULL, NULL),
	(2159, 'LSADM', '_18000', NULL, NULL, NULL, NULL),
	(2154, 'SA', '_18000', NULL, NULL, NULL, NULL),
	(2872, 'ADM', '_30000.032', NULL, NULL, NULL, NULL),
	(1957, 'GL', '_10070', NULL, NULL, NULL, NULL),
	(1956, 'GL', '_10069', NULL, NULL, NULL, NULL),
	(1955, 'GL', '_10066', NULL, NULL, NULL, NULL),
	(1954, 'GL', '_10065', NULL, NULL, NULL, NULL),
	(1953, 'GL', '_10064', NULL, NULL, NULL, NULL),
	(1952, 'GL', '_10060', NULL, NULL, NULL, NULL),
	(1951, 'GL', '_10030', NULL, NULL, NULL, NULL),
	(1950, 'GL', '_10020', NULL, NULL, NULL, NULL),
	(1949, 'GL', '_10010', NULL, NULL, NULL, NULL),
	(1948, 'GL', '_10000', NULL, NULL, NULL, NULL),
	(1958, 'GL', '_12000', NULL, NULL, NULL, NULL),
	(2147, 'INV', '_80090', NULL, NULL, NULL, NULL),
	(2146, 'INV', '_80070', NULL, NULL, NULL, NULL),
	(2145, 'INV', '_80060', NULL, NULL, NULL, NULL),
	(2144, 'INV', '_80050', NULL, NULL, NULL, NULL),
	(2143, 'INV', '_80040', NULL, NULL, NULL, NULL),
	(2142, 'INV', '_80030', NULL, NULL, NULL, NULL),
	(2141, 'INV', '_80020', NULL, NULL, NULL, NULL),
	(2140, 'INV', '_80010', NULL, NULL, NULL, NULL),
	(2139, 'INV', '_11000', NULL, NULL, NULL, NULL),
	(1983, 'PUR', '_80011', NULL, NULL, NULL, NULL),
	(1984, 'PUR', '_80012', NULL, NULL, NULL, NULL),
	(3116, 'FIN', '_80010.03', NULL, NULL, NULL, NULL),
	(3117, 'FIN', '_80010.04', NULL, NULL, NULL, NULL),
	(3118, 'FIN', '_80010.05', NULL, NULL, NULL, NULL),
	(3119, 'FIN', '_80010.06', NULL, NULL, NULL, NULL),
	(3120, 'FIN', '_80010.07', NULL, NULL, NULL, NULL),
	(3121, 'FIN', '_14000', NULL, NULL, NULL, NULL),
	(2070, 'TRV', '_21000', NULL, NULL, NULL, NULL),
	(2071, 'TRV', '_21010', NULL, NULL, NULL, NULL),
	(2827, 'ADM', '_00010', NULL, NULL, NULL, NULL),
	(2826, 'ADM', '_00000', NULL, NULL, NULL, NULL),
	(2150, 'INV', '_80130', NULL, NULL, NULL, NULL),
	(2151, 'INV', '_80200', NULL, NULL, NULL, NULL),
	(2152, 'PYR', '_12000', NULL, NULL, NULL, NULL),
	(2153, 'PYR', '_12001', NULL, NULL, NULL, NULL),
	(2157, 'SA', '_18000.011', NULL, NULL, NULL, NULL),
	(2158, 'SA', '_18000.021', NULL, NULL, NULL, NULL),
	(2165, 'LSADM', '_18000.022', NULL, NULL, NULL, NULL),
	(2166, 'admin', '_00010', NULL, NULL, NULL, NULL),
	(2167, 'admin', '_00011', NULL, NULL, NULL, NULL),
	(2168, 'admin', '_00012', NULL, NULL, NULL, NULL),
	(2169, 'admin', '_00013', NULL, NULL, NULL, NULL),
	(2170, 'admin', '_00020', NULL, NULL, NULL, NULL),
	(2171, 'admin', '_00021', NULL, NULL, NULL, NULL),
	(2172, 'admin', '_00022', NULL, NULL, NULL, NULL),
	(2173, 'admin', '_00023', NULL, NULL, NULL, NULL),
	(2174, 'SLS', '_30000', NULL, NULL, NULL, NULL),
	(2175, 'SLS', '_30000.029', NULL, NULL, NULL, NULL),
	(2176, 'SLS', '_30000.030', NULL, NULL, NULL, NULL),
	(2177, 'SLS', '_30000.031', NULL, NULL, NULL, NULL),
	(2178, 'SLS', '_30000.032', NULL, NULL, NULL, NULL),
	(2179, 'SLS', '_30000.033', NULL, NULL, NULL, NULL),
	(2180, 'SLS', '_30000.034', NULL, NULL, NULL, NULL),
	(2181, 'SLS', '_30000.035', NULL, NULL, NULL, NULL),
	(2212, 'SPV', '_30000.100', NULL, NULL, NULL, NULL),
	(2224, 'Administrator', 'frmMain.Addnew', NULL, NULL, NULL, NULL),
	(2223, 'Administrator', '_00000', NULL, NULL, NULL, NULL),
	(2231, 'Administrator', '_00020', NULL, NULL, NULL, NULL),
	(2232, 'Administrator', '_00021', NULL, NULL, NULL, NULL),
	(2233, 'Administrator', '_00022', NULL, NULL, NULL, NULL),
	(2234, 'Administrator', '_00023', NULL, NULL, NULL, NULL),
	(2235, 'Administrator', '_00030', NULL, NULL, NULL, NULL),
	(2236, 'Administrator', '_00031', NULL, NULL, NULL, NULL),
	(2237, 'Administrator', '_00032', NULL, NULL, NULL, NULL),
	(2238, 'Administrator', '_00040', NULL, NULL, NULL, NULL),
	(2239, 'Administrator', '_00041', NULL, NULL, NULL, NULL),
	(2240, 'Administrator', '_00042', NULL, NULL, NULL, NULL),
	(2241, 'Administrator', '_00043', NULL, NULL, NULL, NULL),
	(2242, 'Administrator', '_00050', NULL, NULL, NULL, NULL),
	(2243, 'Administrator', '_10060A', NULL, NULL, NULL, NULL),
	(2244, 'Administrator', '_11000', NULL, NULL, NULL, NULL),
	(2245, 'Administrator', '_11001', NULL, NULL, NULL, NULL),
	(2246, 'Administrator', '_13000', NULL, NULL, NULL, NULL),
	(2247, 'Administrator', '_20000', NULL, NULL, NULL, NULL),
	(2248, 'Administrator', '_300900', NULL, NULL, NULL, NULL),
	(2249, 'Administrator', '_300901', NULL, NULL, NULL, NULL),
	(2250, 'Administrator', '_30170', NULL, NULL, NULL, NULL),
	(2251, 'Administrator', '_80010.01', NULL, NULL, NULL, NULL),
	(2252, 'Administrator', '_80010.02', NULL, NULL, NULL, NULL),
	(2253, 'Administrator', '_80010.03', NULL, NULL, NULL, NULL),
	(2254, 'Administrator', '_80010.04', NULL, NULL, NULL, NULL),
	(2255, 'Administrator', '_80010.05', NULL, NULL, NULL, NULL),
	(2256, 'Administrator', '_80010.06', NULL, NULL, NULL, NULL),
	(2257, 'Administrator', '_80010.07', NULL, NULL, NULL, NULL),
	(2258, 'Administrator', '_10000', NULL, NULL, NULL, NULL),
	(2259, 'Administrator', '_10010', NULL, NULL, NULL, NULL),
	(2260, 'Administrator', '_10011', NULL, NULL, NULL, NULL),
	(2261, 'Administrator', '_10012', NULL, NULL, NULL, NULL),
	(2262, 'Administrator', '_10013', NULL, NULL, NULL, NULL),
	(2263, 'Administrator', '_10015', NULL, NULL, NULL, NULL),
	(2264, 'Administrator', '_10016', NULL, NULL, NULL, NULL),
	(2265, 'Administrator', '_10020', NULL, NULL, NULL, NULL),
	(2266, 'Administrator', '_10021', NULL, NULL, NULL, NULL),
	(2267, 'Administrator', '_10030', NULL, NULL, NULL, NULL),
	(2268, 'Administrator', '_10031', NULL, NULL, NULL, NULL),
	(2269, 'Administrator', '_10032', NULL, NULL, NULL, NULL),
	(2270, 'Administrator', '_10035', NULL, NULL, NULL, NULL),
	(2271, 'Administrator', '_10036', NULL, NULL, NULL, NULL),
	(2272, 'Administrator', '_10060', NULL, NULL, NULL, NULL),
	(2273, 'Administrator', '_10061', NULL, NULL, NULL, NULL),
	(2274, 'Administrator', '_10062', NULL, NULL, NULL, NULL),
	(2275, 'Administrator', '_10063', NULL, NULL, NULL, NULL),
	(2276, 'Administrator', '_10064', NULL, NULL, NULL, NULL),
	(2277, 'Administrator', '_10065', NULL, NULL, NULL, NULL),
	(2278, 'Administrator', '_10066', NULL, NULL, NULL, NULL),
	(2279, 'Administrator', '_10067', NULL, NULL, NULL, NULL),
	(2280, 'Administrator', '_10068', NULL, NULL, NULL, NULL),
	(2281, 'Administrator', '_10069', NULL, NULL, NULL, NULL),
	(2282, 'Administrator', '_10070', NULL, NULL, NULL, NULL),
	(2283, 'Administrator', '_12000', NULL, NULL, NULL, NULL),
	(2284, 'Administrator', '_12001', NULL, NULL, NULL, NULL),
	(2285, 'Administrator', '_18000', NULL, NULL, NULL, NULL),
	(2286, 'Administrator', '_18000.001', NULL, NULL, NULL, NULL),
	(2287, 'Administrator', '_18000.002', NULL, NULL, NULL, NULL),
	(2288, 'Administrator', '_18000.003', NULL, NULL, NULL, NULL),
	(2289, 'Administrator', '_18000.004', NULL, NULL, NULL, NULL),
	(2290, 'Administrator', '_18000.005', NULL, NULL, NULL, NULL),
	(2291, 'Administrator', '_18000.006', NULL, NULL, NULL, NULL),
	(2292, 'Administrator', '_18000.007', NULL, NULL, NULL, NULL),
	(2293, 'Administrator', '_18000.008', NULL, NULL, NULL, NULL),
	(2294, 'Administrator', '_18000.009', NULL, NULL, NULL, NULL),
	(2295, 'Administrator', '_18000.010', NULL, NULL, NULL, NULL),
	(2296, 'Administrator', '_18000.011', NULL, NULL, NULL, NULL),
	(2297, 'Administrator', '_18000.012', NULL, NULL, NULL, NULL),
	(2298, 'Administrator', '_18000.013', NULL, NULL, NULL, NULL),
	(2299, 'Administrator', '_18000.014', NULL, NULL, NULL, NULL),
	(2300, 'Administrator', '_18000.015', NULL, NULL, NULL, NULL),
	(2301, 'Administrator', '_18000.020', NULL, NULL, NULL, NULL),
	(2302, 'Administrator', '_18000.021', NULL, NULL, NULL, NULL),
	(2303, 'Administrator', '_18000.022', NULL, NULL, NULL, NULL),
	(2304, 'Administrator', '_18000.100', NULL, NULL, NULL, NULL),
	(2305, 'Administrator', '_18000.900', NULL, NULL, NULL, NULL),
	(2306, 'Administrator', '_18000.901', NULL, NULL, NULL, NULL),
	(2307, 'Administrator', '_21000', NULL, NULL, NULL, NULL),
	(2308, 'Administrator', '_21010', NULL, NULL, NULL, NULL),
	(2309, 'Administrator', '_30000', NULL, NULL, NULL, NULL),
	(2310, 'Administrator', '_30000.0', NULL, NULL, NULL, NULL),
	(2311, 'Administrator', '_30000.001', NULL, NULL, NULL, NULL),
	(2312, 'Administrator', '_30000.002', NULL, NULL, NULL, NULL),
	(2313, 'Administrator', '_30000.003', NULL, NULL, NULL, NULL),
	(2314, 'Administrator', '_30000.004', NULL, NULL, NULL, NULL),
	(2315, 'Administrator', '_30000.005', NULL, NULL, NULL, NULL),
	(2316, 'Administrator', '_30000.006', NULL, NULL, NULL, NULL),
	(2317, 'Administrator', '_30000.007', NULL, NULL, NULL, NULL),
	(2318, 'Administrator', '_30000.008', NULL, NULL, NULL, NULL),
	(2319, 'Administrator', '_30000.009', NULL, NULL, NULL, NULL),
	(2320, 'Administrator', '_30000.010', NULL, NULL, NULL, NULL),
	(2321, 'Administrator', '_30000.011', NULL, NULL, NULL, NULL),
	(2322, 'Administrator', '_30000.012', NULL, NULL, NULL, NULL),
	(2323, 'Administrator', '_30000.013', NULL, NULL, NULL, NULL),
	(2324, 'Administrator', '_30000.014', NULL, NULL, NULL, NULL),
	(2325, 'Administrator', '_30000.015', NULL, NULL, NULL, NULL),
	(2326, 'Administrator', '_30000.016', NULL, NULL, NULL, NULL),
	(2327, 'Administrator', '_30000.017', NULL, NULL, NULL, NULL),
	(2328, 'Administrator', '_30000.018', NULL, NULL, NULL, NULL),
	(2329, 'Administrator', '_30000.019', NULL, NULL, NULL, NULL),
	(2330, 'Administrator', '_30000.020', NULL, NULL, NULL, NULL),
	(2331, 'Administrator', '_30000.021', NULL, NULL, NULL, NULL),
	(2332, 'Administrator', '_30000.022', NULL, NULL, NULL, NULL),
	(2333, 'Administrator', '_30000.023', NULL, NULL, NULL, NULL),
	(2334, 'Administrator', '_30000.024', NULL, NULL, NULL, NULL),
	(2335, 'Administrator', '_30000.025', NULL, NULL, NULL, NULL),
	(2336, 'Administrator', '_30000.026', NULL, NULL, NULL, NULL),
	(2337, 'Administrator', '_30000.027', NULL, NULL, NULL, NULL),
	(2338, 'Administrator', '_30000.028', NULL, NULL, NULL, NULL),
	(2339, 'Administrator', '_30000.029', NULL, NULL, NULL, NULL),
	(2340, 'Administrator', '_30000.030', NULL, NULL, NULL, NULL),
	(2341, 'Administrator', '_30000.031', NULL, NULL, NULL, NULL),
	(2342, 'Administrator', '_30000.032', NULL, NULL, NULL, NULL),
	(2343, 'Administrator', '_30000.033', NULL, NULL, NULL, NULL),
	(2344, 'Administrator', '_30000.034', NULL, NULL, NULL, NULL),
	(2345, 'Administrator', '_30000.035', NULL, NULL, NULL, NULL),
	(2346, 'Administrator', '_30000.036', NULL, NULL, NULL, NULL),
	(2347, 'Administrator', '_30000.037', NULL, NULL, NULL, NULL),
	(2348, 'Administrator', '_30000.038', NULL, NULL, NULL, NULL),
	(2349, 'Administrator', '_30000.039', NULL, NULL, NULL, NULL),
	(2350, 'Administrator', '_30000.040', NULL, NULL, NULL, NULL),
	(2351, 'Administrator', '_30000.041', NULL, NULL, NULL, NULL),
	(2352, 'Administrator', '_30000.050', NULL, NULL, NULL, NULL),
	(2353, 'Administrator', '_30000.051', NULL, NULL, NULL, NULL),
	(2354, 'Administrator', '_30000.052', NULL, NULL, NULL, NULL),
	(2355, 'Administrator', '_30000.053', NULL, NULL, NULL, NULL),
	(2356, 'Administrator', '_30000.054', NULL, NULL, NULL, NULL),
	(2357, 'Administrator', '_30000.055', NULL, NULL, NULL, NULL),
	(2358, 'Administrator', '_30000.056', NULL, NULL, NULL, NULL),
	(2359, 'Administrator', '_30000.057', NULL, NULL, NULL, NULL),
	(2360, 'Administrator', '_30000.058', NULL, NULL, NULL, NULL),
	(2361, 'Administrator', '_30000.059', NULL, NULL, NULL, NULL),
	(2362, 'Administrator', '_30000.060', NULL, NULL, NULL, NULL),
	(2363, 'Administrator', '_30000.061', NULL, NULL, NULL, NULL),
	(2364, 'Administrator', '_30000.062', NULL, NULL, NULL, NULL),
	(2365, 'Administrator', '_30000.063', NULL, NULL, NULL, NULL),
	(2366, 'Administrator', '_30000.064', NULL, NULL, NULL, NULL),
	(2367, 'Administrator', '_30000.065', NULL, NULL, NULL, NULL),
	(2368, 'Administrator', '_30000.066', NULL, NULL, NULL, NULL),
	(2369, 'Administrator', '_30000.067', NULL, NULL, NULL, NULL),
	(2370, 'Administrator', '_30000.068', NULL, NULL, NULL, NULL),
	(2371, 'Administrator', '_30000.100', NULL, NULL, NULL, NULL),
	(2372, 'Administrator', '_30010', NULL, NULL, NULL, NULL),
	(2373, 'Administrator', 'frmCustomers.cmdSaveShipTo', NULL, NULL, NULL, NULL),
	(2374, 'Administrator', '_30011', NULL, NULL, NULL, NULL),
	(2375, 'Administrator', '_30012', NULL, NULL, NULL, NULL),
	(2376, 'Administrator', '_30013', NULL, NULL, NULL, NULL),
	(2377, 'Administrator', '_30020', NULL, NULL, NULL, NULL),
	(2378, 'Administrator', '_30030', NULL, NULL, NULL, NULL),
	(2379, 'Administrator', '_30031', NULL, NULL, NULL, NULL),
	(2380, 'Administrator', '_30033', NULL, NULL, NULL, NULL),
	(2381, 'Administrator', '_30040', NULL, NULL, NULL, NULL),
	(2382, 'Administrator', '_30041', NULL, NULL, NULL, NULL),
	(2383, 'Administrator', '_30042', NULL, NULL, NULL, NULL),
	(2384, 'Administrator', '_30050', NULL, NULL, NULL, NULL),
	(2385, 'Administrator', '_30051', NULL, NULL, NULL, NULL),
	(2386, 'Administrator', '_30052', NULL, NULL, NULL, NULL),
	(2387, 'Administrator', '_30053', NULL, NULL, NULL, NULL),
	(2388, 'Administrator', '_30054', NULL, NULL, NULL, NULL),
	(2389, 'Administrator', '_30055', NULL, NULL, NULL, NULL),
	(2390, 'Administrator', '_30060', NULL, NULL, NULL, NULL),
	(2391, 'Administrator', '_30061', NULL, NULL, NULL, NULL),
	(2392, 'Administrator', '_30062', NULL, NULL, NULL, NULL),
	(2393, 'Administrator', '_30063', NULL, NULL, NULL, NULL),
	(2394, 'Administrator', '_30064', NULL, NULL, NULL, NULL),
	(2395, 'Administrator', '_30070', NULL, NULL, NULL, NULL),
	(2396, 'Administrator', '_30071', NULL, NULL, NULL, NULL),
	(2397, 'Administrator', '_30072', NULL, NULL, NULL, NULL),
	(2398, 'Administrator', '_30073', NULL, NULL, NULL, NULL),
	(2399, 'Administrator', '_30074', NULL, NULL, NULL, NULL),
	(2400, 'Administrator', '_30075', NULL, NULL, NULL, NULL),
	(2401, 'Administrator', '_30080', NULL, NULL, NULL, NULL),
	(2402, 'Administrator', '_30081', NULL, NULL, NULL, NULL),
	(2403, 'Administrator', '_30090', NULL, NULL, NULL, NULL),
	(2404, 'Administrator', '_30091', NULL, NULL, NULL, NULL),
	(2405, 'Administrator', '_30092', NULL, NULL, NULL, NULL),
	(2406, 'Administrator', '_30093', NULL, NULL, NULL, NULL),
	(2407, 'Administrator', '_30094', NULL, NULL, NULL, NULL),
	(2408, 'Administrator', '_30095', NULL, NULL, NULL, NULL),
	(2409, 'Administrator', '_30100', NULL, NULL, NULL, NULL),
	(2410, 'Administrator', '_30121', NULL, NULL, NULL, NULL),
	(2411, 'Administrator', '_30131', NULL, NULL, NULL, NULL),
	(2412, 'Administrator', '_30141', NULL, NULL, NULL, NULL),
	(2413, 'Administrator', '_30110', NULL, NULL, NULL, NULL),
	(2414, 'Administrator', '_30112', NULL, NULL, NULL, NULL),
	(2415, 'Administrator', '_30120', NULL, NULL, NULL, NULL),
	(2416, 'Administrator', '_30122', NULL, NULL, NULL, NULL),
	(2417, 'Administrator', '_30123', NULL, NULL, NULL, NULL),
	(2418, 'Administrator', '_30124', NULL, NULL, NULL, NULL),
	(2419, 'Administrator', '_30125', NULL, NULL, NULL, NULL),
	(2420, 'Administrator', '_30130', NULL, NULL, NULL, NULL),
	(2421, 'Administrator', '_30132', NULL, NULL, NULL, NULL),
	(2422, 'Administrator', '_30133', NULL, NULL, NULL, NULL),
	(2423, 'Administrator', '_30134', NULL, NULL, NULL, NULL),
	(2424, 'Administrator', '_30135', NULL, NULL, NULL, NULL),
	(2425, 'Administrator', '_30140', NULL, NULL, NULL, NULL),
	(2426, 'Administrator', '_30142', NULL, NULL, NULL, NULL),
	(2427, 'Administrator', '_30143', NULL, NULL, NULL, NULL),
	(2428, 'Administrator', '_30150', NULL, NULL, NULL, NULL),
	(2429, 'Administrator', '_30151', NULL, NULL, NULL, NULL),
	(2430, 'Administrator', '_30160', NULL, NULL, NULL, NULL),
	(2431, 'Administrator', '_30161', NULL, NULL, NULL, NULL),
	(2432, 'Administrator', '_30162', NULL, NULL, NULL, NULL),
	(2433, 'Administrator', '_30163', NULL, NULL, NULL, NULL),
	(2434, 'Administrator', '_30164', NULL, NULL, NULL, NULL),
	(2435, 'Administrator', '_30165', NULL, NULL, NULL, NULL),
	(2436, 'Administrator', '_40000', NULL, NULL, NULL, NULL),
	(2437, 'Administrator', '_40010', NULL, NULL, NULL, NULL),
	(2438, 'Administrator', '_40011', NULL, NULL, NULL, NULL),
	(2439, 'Administrator', '_40012', NULL, NULL, NULL, NULL),
	(2440, 'Administrator', '_40013', NULL, NULL, NULL, NULL),
	(2441, 'Administrator', '_40020', NULL, NULL, NULL, NULL),
	(2442, 'Administrator', '_40021', NULL, NULL, NULL, NULL),
	(2443, 'Administrator', '_40023', NULL, NULL, NULL, NULL),
	(2444, 'Administrator', '_40030', NULL, NULL, NULL, NULL),
	(2445, 'Administrator', '_40031', NULL, NULL, NULL, NULL),
	(2446, 'Administrator', '_40033', NULL, NULL, NULL, NULL),
	(2447, 'Administrator', '_40040', NULL, NULL, NULL, NULL),
	(2448, 'Administrator', '_40041', NULL, NULL, NULL, NULL),
	(2449, 'Administrator', '_40042', NULL, NULL, NULL, NULL),
	(2450, 'Administrator', '_40043', NULL, NULL, NULL, NULL),
	(2451, 'Administrator', '_40044', NULL, NULL, NULL, NULL),
	(2452, 'Administrator', '_40045', NULL, NULL, NULL, NULL),
	(2453, 'Administrator', '_40046', NULL, NULL, NULL, NULL),
	(2454, 'Administrator', '_40047', NULL, NULL, NULL, NULL),
	(2455, 'Administrator', '_40048', NULL, NULL, NULL, NULL),
	(2456, 'Administrator', '_40049', NULL, NULL, NULL, NULL),
	(2457, 'Administrator', '_40050', NULL, NULL, NULL, NULL),
	(2458, 'Administrator', '_40051', NULL, NULL, NULL, NULL),
	(2459, 'Administrator', '_40052', NULL, NULL, NULL, NULL),
	(2460, 'Administrator', '_40053', NULL, NULL, NULL, NULL),
	(2461, 'Administrator', '_40054', NULL, NULL, NULL, NULL),
	(2462, 'Administrator', '_40055', NULL, NULL, NULL, NULL),
	(2463, 'Administrator', '_40131', NULL, NULL, NULL, NULL),
	(2464, 'Administrator', '_40132', NULL, NULL, NULL, NULL),
	(2465, 'Administrator', '_40134', NULL, NULL, NULL, NULL),
	(2466, 'Administrator', '_40135', NULL, NULL, NULL, NULL),
	(2467, 'Administrator', '_40136', NULL, NULL, NULL, NULL),
	(2468, 'Administrator', '_40060', NULL, NULL, NULL, NULL),
	(2469, 'Administrator', '_40061', NULL, NULL, NULL, NULL),
	(2470, 'Administrator', '_40062', NULL, NULL, NULL, NULL),
	(2471, 'Administrator', '_40063', NULL, NULL, NULL, NULL),
	(2472, 'Administrator', '_40064', NULL, NULL, NULL, NULL),
	(2473, 'Administrator', '_40065', NULL, NULL, NULL, NULL),
	(2474, 'Administrator', '_40070', NULL, NULL, NULL, NULL),
	(2475, 'Administrator', '_40071', NULL, NULL, NULL, NULL),
	(2476, 'Administrator', '_40080', NULL, NULL, NULL, NULL),
	(2477, 'Administrator', '_40081', NULL, NULL, NULL, NULL),
	(2478, 'Administrator', '_40082', NULL, NULL, NULL, NULL),
	(2479, 'Administrator', '_40083', NULL, NULL, NULL, NULL),
	(2480, 'Administrator', '_40084', NULL, NULL, NULL, NULL),
	(2481, 'Administrator', '_40085', NULL, NULL, NULL, NULL),
	(2482, 'Administrator', '_40090', NULL, NULL, NULL, NULL),
	(2483, 'Administrator', '_40091', NULL, NULL, NULL, NULL),
	(2484, 'Administrator', '_40092', NULL, NULL, NULL, NULL),
	(2485, 'Administrator', '_40093', NULL, NULL, NULL, NULL),
	(2486, 'Administrator', '_40094', NULL, NULL, NULL, NULL),
	(2487, 'Administrator', '_40095', NULL, NULL, NULL, NULL),
	(2488, 'Administrator', '_40100', NULL, NULL, NULL, NULL),
	(2489, 'Administrator', '_40101', NULL, NULL, NULL, NULL),
	(2490, 'Administrator', '_40102', NULL, NULL, NULL, NULL),
	(2491, 'Administrator', '_40103', NULL, NULL, NULL, NULL),
	(2492, 'Administrator', '_40104', NULL, NULL, NULL, NULL),
	(2493, 'Administrator', '_40105', NULL, NULL, NULL, NULL),
	(2494, 'Administrator', '_40110', NULL, NULL, NULL, NULL),
	(2495, 'Administrator', '_40113', NULL, NULL, NULL, NULL),
	(2496, 'Administrator', '_40114', NULL, NULL, NULL, NULL),
	(2497, 'Administrator', '_40115', NULL, NULL, NULL, NULL),
	(2498, 'Administrator', '_40120', NULL, NULL, NULL, NULL),
	(2499, 'Administrator', '_40123', NULL, NULL, NULL, NULL),
	(2500, 'Administrator', '_40130', NULL, NULL, NULL, NULL),
	(2501, 'Administrator', '_60000', NULL, NULL, NULL, NULL),
	(2502, 'Administrator', '_60010', NULL, NULL, NULL, NULL),
	(2503, 'Administrator', '_60011', NULL, NULL, NULL, NULL),
	(2504, 'Administrator', '_60012', NULL, NULL, NULL, NULL),
	(2505, 'Administrator', '_60013', NULL, NULL, NULL, NULL),
	(2506, 'Administrator', '_60020', NULL, NULL, NULL, NULL),
	(2507, 'Administrator', '_60021', NULL, NULL, NULL, NULL),
	(2508, 'Administrator', '_60022', NULL, NULL, NULL, NULL),
	(2509, 'Administrator', '_60023', NULL, NULL, NULL, NULL),
	(2510, 'Administrator', '_60024', NULL, NULL, NULL, NULL),
	(2511, 'Administrator', '_60025', NULL, NULL, NULL, NULL),
	(2512, 'Administrator', '_60030', NULL, NULL, NULL, NULL),
	(2513, 'Administrator', '_60031', NULL, NULL, NULL, NULL),
	(2514, 'Administrator', '_60032', NULL, NULL, NULL, NULL),
	(2515, 'Administrator', '_60033', NULL, NULL, NULL, NULL),
	(2516, 'Administrator', '_60034', NULL, NULL, NULL, NULL),
	(2517, 'Administrator', '_60035', NULL, NULL, NULL, NULL),
	(2518, 'Administrator', '_60040', NULL, NULL, NULL, NULL),
	(2519, 'Administrator', '_60041', NULL, NULL, NULL, NULL),
	(2520, 'Administrator', '_60042', NULL, NULL, NULL, NULL),
	(2521, 'Administrator', '_60043', NULL, NULL, NULL, NULL),
	(2522, 'Administrator', '_60044', NULL, NULL, NULL, NULL),
	(2523, 'Administrator', '_60045', NULL, NULL, NULL, NULL),
	(2524, 'Administrator', '_60050', NULL, NULL, NULL, NULL),
	(2525, 'Administrator', '_60051', NULL, NULL, NULL, NULL),
	(2526, 'Administrator', '_60052', NULL, NULL, NULL, NULL),
	(2527, 'Administrator', '_60053', NULL, NULL, NULL, NULL),
	(2528, 'Administrator', '_60054', NULL, NULL, NULL, NULL),
	(2529, 'Administrator', '_60055', NULL, NULL, NULL, NULL),
	(2530, 'Administrator', '_60060', NULL, NULL, NULL, NULL),
	(2531, 'Administrator', '_60061', NULL, NULL, NULL, NULL),
	(2532, 'Administrator', '_60062', NULL, NULL, NULL, NULL),
	(2533, 'Administrator', '_60063', NULL, NULL, NULL, NULL),
	(2534, 'Administrator', '_60064', NULL, NULL, NULL, NULL),
	(2535, 'Administrator', '_60065', NULL, NULL, NULL, NULL),
	(2536, 'Administrator', '_60070', NULL, NULL, NULL, NULL),
	(2537, 'Administrator', '_60071', NULL, NULL, NULL, NULL),
	(2538, 'Administrator', '_60072', NULL, NULL, NULL, NULL),
	(2539, 'Administrator', '_60073', NULL, NULL, NULL, NULL),
	(2540, 'Administrator', '_60074', NULL, NULL, NULL, NULL),
	(2541, 'Administrator', '_60075', NULL, NULL, NULL, NULL),
	(2542, 'Administrator', '_60080', NULL, NULL, NULL, NULL),
	(2543, 'Administrator', '_60081', NULL, NULL, NULL, NULL),
	(2544, 'Administrator', '_60082', NULL, NULL, NULL, NULL),
	(2545, 'Administrator', '_60083', NULL, NULL, NULL, NULL),
	(2546, 'Administrator', '_60085', NULL, NULL, NULL, NULL),
	(2547, 'Administrator', '_60084', NULL, NULL, NULL, NULL),
	(2548, 'Administrator', '_80000', NULL, NULL, NULL, NULL),
	(2549, 'Administrator', '_80010', NULL, NULL, NULL, NULL),
	(2550, 'Administrator', '_80011', NULL, NULL, NULL, NULL),
	(2551, 'Administrator', '_80012', NULL, NULL, NULL, NULL),
	(2552, 'Administrator', '_80013', NULL, NULL, NULL, NULL),
	(2553, 'Administrator', '_80014', NULL, NULL, NULL, NULL),
	(2554, 'Administrator', '_80015', NULL, NULL, NULL, NULL),
	(2555, 'Administrator', '_80020', NULL, NULL, NULL, NULL),
	(2556, 'Administrator', '_80021', NULL, NULL, NULL, NULL),
	(2557, 'Administrator', '_80022', NULL, NULL, NULL, NULL),
	(2558, 'Administrator', '_80023', NULL, NULL, NULL, NULL),
	(2559, 'Administrator', '_80024', NULL, NULL, NULL, NULL),
	(2560, 'Administrator', '_80030', NULL, NULL, NULL, NULL),
	(2561, 'Administrator', '_80031', NULL, NULL, NULL, NULL),
	(2562, 'Administrator', '_80032', NULL, NULL, NULL, NULL),
	(2563, 'Administrator', '_80033', NULL, NULL, NULL, NULL),
	(2564, 'Administrator', '_80034', NULL, NULL, NULL, NULL),
	(2565, 'Administrator', '_80040', NULL, NULL, NULL, NULL),
	(2566, 'Administrator', '_80041', NULL, NULL, NULL, NULL),
	(2567, 'Administrator', '_80042', NULL, NULL, NULL, NULL),
	(2568, 'Administrator', '_80043', NULL, NULL, NULL, NULL),
	(2569, 'Administrator', '_80044', NULL, NULL, NULL, NULL),
	(2570, 'Administrator', '_80050', NULL, NULL, NULL, NULL),
	(2571, 'Administrator', '_80051', NULL, NULL, NULL, NULL),
	(2572, 'Administrator', '_80052', NULL, NULL, NULL, NULL),
	(2573, 'Administrator', '_80053', NULL, NULL, NULL, NULL),
	(2574, 'Administrator', '_80054', NULL, NULL, NULL, NULL),
	(2575, 'Administrator', '_80060', NULL, NULL, NULL, NULL),
	(2576, 'Administrator', '_80061', NULL, NULL, NULL, NULL),
	(2577, 'Administrator', '_80062', NULL, NULL, NULL, NULL),
	(2578, 'Administrator', '_80063', NULL, NULL, NULL, NULL),
	(2579, 'Administrator', '_80064', NULL, NULL, NULL, NULL),
	(2580, 'Administrator', '_80070', NULL, NULL, NULL, NULL),
	(2581, 'Administrator', '_80071', NULL, NULL, NULL, NULL),
	(2582, 'Administrator', '_80072', NULL, NULL, NULL, NULL),
	(2583, 'Administrator', '_80073', NULL, NULL, NULL, NULL),
	(2584, 'Administrator', '_80074', NULL, NULL, NULL, NULL),
	(2585, 'Administrator', '_80080', NULL, NULL, NULL, NULL),
	(2586, 'Administrator', '_80081', NULL, NULL, NULL, NULL),
	(2587, 'Administrator', '_80082', NULL, NULL, NULL, NULL),
	(2588, 'Administrator', '_80083', NULL, NULL, NULL, NULL),
	(2589, 'Administrator', '_80084', NULL, NULL, NULL, NULL),
	(2590, 'Administrator', '_80090', NULL, NULL, NULL, NULL),
	(2591, 'Administrator', '_80091', NULL, NULL, NULL, NULL),
	(2592, 'Administrator', '_80092', NULL, NULL, NULL, NULL),
	(2593, 'Administrator', '_80093', NULL, NULL, NULL, NULL),
	(2594, 'Administrator', '_80094', NULL, NULL, NULL, NULL),
	(2595, 'Administrator', '_80100', NULL, NULL, NULL, NULL),
	(2596, 'Administrator', '_80101', NULL, NULL, NULL, NULL),
	(2597, 'Administrator', '_80110', NULL, NULL, NULL, NULL),
	(2598, 'Administrator', '_80111', NULL, NULL, NULL, NULL),
	(2599, 'Administrator', '_80120', NULL, NULL, NULL, NULL),
	(2600, 'Administrator', '_80121', NULL, NULL, NULL, NULL),
	(2601, 'Administrator', '_80130', NULL, NULL, NULL, NULL),
	(2602, 'Administrator', '_80131', NULL, NULL, NULL, NULL),
	(2603, 'Administrator', '_80132', NULL, NULL, NULL, NULL),
	(2604, 'Administrator', '_80140', NULL, NULL, NULL, NULL),
	(2605, 'Administrator', '_80141', NULL, NULL, NULL, NULL),
	(2606, 'Administrator', '_80200', NULL, NULL, NULL, NULL),
	(2607, 'Administrator', '_80201', NULL, NULL, NULL, NULL),
	(2608, 'Administrator', '_80202', NULL, NULL, NULL, NULL),
	(2609, 'Administrator', '_90000', NULL, NULL, NULL, NULL),
	(2610, 'Administrator', 'frmRptCriteria', NULL, NULL, NULL, NULL),
	(2611, 'Administrator', '_90010', NULL, NULL, NULL, NULL),
	(2612, 'Administrator', '\\CEK\\BANKCEK2.RPT', NULL, NULL, NULL, NULL),
	(2613, 'Administrator', '\\CEK\\BANKCEKGL.RPT', NULL, NULL, NULL, NULL),
	(2614, 'Administrator', '\\CEK\\BANKCEKM2.RPT', NULL, NULL, NULL, NULL),
	(2615, 'Administrator', '\\cek\\BANKCODE.rpt', NULL, NULL, NULL, NULL),
	(2616, 'Administrator', '\\Cek\\BankMutasiBank.rpt', NULL, NULL, NULL, NULL),
	(2617, 'Administrator', '\\CEK\\ChInSum.Rpt', NULL, NULL, NULL, NULL),
	(2618, 'Administrator', '\\CEK\\ChOutSum.Rpt', NULL, NULL, NULL, NULL),
	(2619, 'Administrator', '\\CEK\\KasInSum.Rpt', NULL, NULL, NULL, NULL),
	(2620, 'Administrator', '\\CEK\\KasOutSum.Rpt', NULL, NULL, NULL, NULL),
	(2621, 'Administrator', '\\Cek\\MutasiKas_Saldo.rpt', NULL, NULL, NULL, NULL),
	(2622, 'Administrator', '\\CEK\\transfer_in.rpt', NULL, NULL, NULL, NULL),
	(2623, 'Administrator', '\\CEK\\transfer_out.rpt', NULL, NULL, NULL, NULL),
	(2624, 'Administrator', '\\gl\\balancesheet2.rpt', NULL, NULL, NULL, NULL),
	(2625, 'Administrator', '\\gl\\neracaT.rpt', NULL, NULL, NULL, NULL),
	(2626, 'Administrator', '\\gl\\RLCompare.rpt', NULL, NULL, NULL, NULL),
	(2627, 'Administrator', '\\so\\CustCredit.rpt', NULL, NULL, NULL, NULL),
	(2628, 'Administrator', '\\so\\CustCreditAll.rpt', NULL, NULL, NULL, NULL),
	(2629, 'Administrator', '\\So\\CustHighest.Rpt', NULL, NULL, NULL, NULL),
	(2630, 'Administrator', '\\so\\CustListCompany.rpt', NULL, NULL, NULL, NULL),
	(2631, 'Administrator', '\\so\\CustListCustomer.rpt', NULL, NULL, NULL, NULL),
	(2632, 'Administrator', '_90011', NULL, NULL, NULL, NULL),
	(2633, 'Administrator', '_90012', NULL, NULL, NULL, NULL),
	(2634, 'Administrator', '_90013', NULL, NULL, NULL, NULL),
	(2635, 'Administrator', '_90014', NULL, NULL, NULL, NULL),
	(2636, 'Administrator', '_90015', NULL, NULL, NULL, NULL),
	(2637, 'Administrator', '_90016', NULL, NULL, NULL, NULL),
	(2638, 'Administrator', '_90017', NULL, NULL, NULL, NULL),
	(2639, 'Administrator', '_90018', NULL, NULL, NULL, NULL),
	(2640, 'Administrator', '_90040', NULL, NULL, NULL, NULL),
	(2641, 'Administrator', '\\Inv\\AsmItem.Rpt', NULL, NULL, NULL, NULL),
	(2642, 'Administrator', '\\Inv\\AsmItem17.Rpt', NULL, NULL, NULL, NULL),
	(2643, 'Administrator', '\\Inv\\DaftarBarang.Rpt', NULL, NULL, NULL, NULL),
	(2644, 'Administrator', '\\Inv\\FisikInventory.rpt', NULL, NULL, NULL, NULL),
	(2645, 'Administrator', '\\Inv\\HargaBeli.Rpt', NULL, NULL, NULL, NULL),
	(2646, 'Administrator', '\\Inv\\HargaJual.Rpt', NULL, NULL, NULL, NULL),
	(2647, 'Administrator', '\\Inv\\InventoryMoving.rpt', NULL, NULL, NULL, NULL),
	(2648, 'Administrator', '\\Inv\\InvPriceHistory.rpt', NULL, NULL, NULL, NULL),
	(2649, 'Administrator', '\\Inv\\InvTranCategory.Rpt', NULL, NULL, NULL, NULL),
	(2650, 'Administrator', '\\Inv\\InvTranItem.Rpt', NULL, NULL, NULL, NULL),
	(2651, 'Administrator', '\\inv\\invvalue.rpt', NULL, NULL, NULL, NULL),
	(2652, 'Administrator', '\\inv\\KeluarReturPembelian.rpt', NULL, NULL, NULL, NULL),
	(2653, 'Administrator', '\\Inv\\MutasiGudang.rpt', NULL, NULL, NULL, NULL),
	(2654, 'Administrator', '\\Inv\\StokMgmtLow.rpt', NULL, NULL, NULL, NULL),
	(2655, 'Administrator', '\\Inv\\StokMgMtOnBOrder.rpt', NULL, NULL, NULL, NULL),
	(2656, 'Administrator', '\\Inv\\StokMgMtOut.rpt', NULL, NULL, NULL, NULL),
	(2657, 'Administrator', '\\Inv\\StokMgMtRecon.Rpt', NULL, NULL, NULL, NULL),
	(2658, 'Administrator', '\\PO\\Terima.Rpt', NULL, NULL, NULL, NULL),
	(2659, 'Administrator', '_90041', NULL, NULL, NULL, NULL),
	(2660, 'Administrator', '_90042', NULL, NULL, NULL, NULL),
	(2661, 'Administrator', '_90043', NULL, NULL, NULL, NULL),
	(2662, 'Administrator', '_90044', NULL, NULL, NULL, NULL),
	(2663, 'Administrator', '_90045', NULL, NULL, NULL, NULL),
	(2664, 'Administrator', '_90046', NULL, NULL, NULL, NULL),
	(2665, 'Administrator', '_90047', NULL, NULL, NULL, NULL),
	(2666, 'Administrator', '_90048', NULL, NULL, NULL, NULL),
	(2667, 'Administrator', '_90049', NULL, NULL, NULL, NULL),
	(2668, 'Administrator', '_90050', NULL, NULL, NULL, NULL),
	(2669, 'Administrator', '_90051', NULL, NULL, NULL, NULL),
	(2670, 'Administrator', '_90052', NULL, NULL, NULL, NULL),
	(2671, 'Administrator', '_90053', NULL, NULL, NULL, NULL),
	(2672, 'Administrator', '_90054', NULL, NULL, NULL, NULL),
	(2673, 'Administrator', '_90055', NULL, NULL, NULL, NULL),
	(2674, 'Administrator', '_90056', NULL, NULL, NULL, NULL),
	(2675, 'Administrator', '_90057', NULL, NULL, NULL, NULL),
	(2676, 'Administrator', '_90058', NULL, NULL, NULL, NULL),
	(2677, 'Administrator', '_90070', NULL, NULL, NULL, NULL),
	(2678, 'Administrator', '\\PO\\Keluar.rpt', NULL, NULL, NULL, NULL),
	(2679, 'Administrator', '\\PO\\KeluarPerPO.rpt', NULL, NULL, NULL, NULL),
	(2680, 'Administrator', '\\PO\\OpenPO.rpt', NULL, NULL, NULL, NULL),
	(2681, 'Administrator', '\\Po\\OrderPembelian.rpt', NULL, NULL, NULL, NULL),
	(2682, 'Administrator', '\\Po\\OrderPembelianItemSupplierDetail.rpt', NULL, NULL, NULL, NULL),
	(2683, 'Administrator', '\\PO\\PODaily.rpt', NULL, NULL, NULL, NULL),
	(2684, 'Administrator', '\\PO\\PODetailDaily.rpt', NULL, NULL, NULL, NULL),
	(2685, 'Administrator', '\\PO\\POItemNoRecvItem.rpt', NULL, NULL, NULL, NULL),
	(2686, 'Administrator', '\\PO\\POItemNoRecvSupplier.rpt', NULL, NULL, NULL, NULL),
	(2687, 'Administrator', '\\PO\\POItemOverItem.rpt', NULL, NULL, NULL, NULL),
	(2688, 'Administrator', '\\PO\\POItemOverSupplier.rpt', NULL, NULL, NULL, NULL),
	(2689, 'Administrator', '\\PO\\POMonthly.rpt', NULL, NULL, NULL, NULL),
	(2690, 'Administrator', '_90071', NULL, NULL, NULL, NULL),
	(2691, 'Administrator', '_90072', NULL, NULL, NULL, NULL),
	(2692, 'Administrator', '_90073', NULL, NULL, NULL, NULL),
	(2693, 'Administrator', '_90074', NULL, NULL, NULL, NULL),
	(2694, 'Administrator', '_90075', NULL, NULL, NULL, NULL),
	(2695, 'Administrator', '_90076', NULL, NULL, NULL, NULL),
	(2696, 'Administrator', '_90077', NULL, NULL, NULL, NULL),
	(2697, 'Administrator', '_90078', NULL, NULL, NULL, NULL),
	(2698, 'Administrator', '_90079', NULL, NULL, NULL, NULL),
	(2699, 'Administrator', '_90080', NULL, NULL, NULL, NULL),
	(2700, 'Administrator', '_90081', NULL, NULL, NULL, NULL),
	(2701, 'Administrator', '_90082', NULL, NULL, NULL, NULL),
	(2702, 'Administrator', '_90083', NULL, NULL, NULL, NULL),
	(2703, 'Administrator', '_90084', NULL, NULL, NULL, NULL),
	(2704, 'Administrator', '_90090', NULL, NULL, NULL, NULL),
	(2705, 'Administrator', '\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', NULL, NULL, NULL, NULL),
	(2706, 'Administrator', '\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', NULL, NULL, NULL, NULL),
	(2707, 'Administrator', '\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', NULL, NULL, NULL, NULL),
	(2708, 'Administrator', '\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', NULL, NULL, NULL, NULL),
	(2709, 'Administrator', '\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', NULL, NULL, NULL, NULL),
	(2710, 'Administrator', '\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', NULL, NULL, NULL, NULL),
	(2711, 'Administrator', '\\So\\AnalisaPenjualanPerWilayah.rpt', NULL, NULL, NULL, NULL),
	(2712, 'Administrator', '\\so\\customerEnvelop.rpt', NULL, NULL, NULL, NULL),
	(2713, 'Administrator', '\\so\\CustPayHistory2.rpt', NULL, NULL, NULL, NULL),
	(2714, 'Administrator', '\\So\\CustPayHistoryByCust.rpt', NULL, NULL, NULL, NULL),
	(2715, 'Administrator', '\\So\\CustSalesHistory.rpt', NULL, NULL, NULL, NULL),
	(2716, 'Administrator', '\\So\\CustSalesHistoryLast.rpt', NULL, NULL, NULL, NULL),
	(2717, 'Administrator', '\\so\\daftarcustomer.rpt', NULL, NULL, NULL, NULL),
	(2718, 'Administrator', '\\so\\DaftarPiutang.rpt', NULL, NULL, NULL, NULL),
	(2719, 'Administrator', '\\So\\DaftarTagihan.rpt', NULL, NULL, NULL, NULL),
	(2720, 'Administrator', '\\So\\DODetail100.Rpt', NULL, NULL, NULL, NULL),
	(2721, 'Administrator', '\\So\\FakturPelunasanPiutang.Rpt', NULL, NULL, NULL, NULL),
	(2722, 'Administrator', '\\So\\FakturPenjualanDetailTanggal.Rpt', NULL, NULL, NULL, NULL),
	(2723, 'Administrator', '\\So\\FakturPenjualanDetailtem.Rpt', NULL, NULL, NULL, NULL),
	(2724, 'Administrator', '\\So\\FakturPenjualanSummary.Rpt', NULL, NULL, NULL, NULL),
	(2725, 'Administrator', '\\So\\FakturPenjualanSummaryBayar.Rpt', NULL, NULL, NULL, NULL),
	(2726, 'Administrator', '\\So\\FakturPenjualanSummaryItemCust.Rpt', NULL, NULL, NULL, NULL),
	(2727, 'Administrator', '\\So\\FakturPenjualanSummarySupplier.Rpt', NULL, NULL, NULL, NULL),
	(2728, 'Administrator', '\\So\\FakturPenjualanSummaryTanggal.Rpt', NULL, NULL, NULL, NULL),
	(2729, 'Administrator', '\\So\\FakturPenjualanSummaryWilayah.Rpt', NULL, NULL, NULL, NULL),
	(2730, 'Administrator', '\\So\\FB_RoomResv.rpt', NULL, NULL, NULL, NULL),
	(2731, 'Administrator', '\\So\\FB_RoomResv2.rpt', NULL, NULL, NULL, NULL),
	(2732, 'Administrator', '\\So\\FB_RoomResv3.rpt', NULL, NULL, NULL, NULL),
	(2733, 'Administrator', '\\So\\FB_RoomResvSumDay.rpt', NULL, NULL, NULL, NULL),
	(2734, 'Administrator', '\\So\\FB_TableResv.rpt', NULL, NULL, NULL, NULL),
	(2735, 'Administrator', '\\SO\\HargaHistoryMonthly.rpt', NULL, NULL, NULL, NULL),
	(2736, 'Administrator', '\\So\\HistoryHargaItemCustomer.rpt', NULL, NULL, NULL, NULL),
	(2737, 'Administrator', '\\So\\InvoiceAllTypePerCustomer.rpt', NULL, NULL, NULL, NULL),
	(2738, 'Administrator', '\\So\\InvoicePerTypePerCustomer.rpt', NULL, NULL, NULL, NULL),
	(2739, 'Administrator', '\\So\\Jual100.Rpt', NULL, NULL, NULL, NULL),
	(2740, 'Administrator', '\\so\\JualCustSum.Rpt', NULL, NULL, NULL, NULL),
	(2741, 'Administrator', '\\SO\\JualKasirDateTime.Rpt', NULL, NULL, NULL, NULL),
	(2742, 'Administrator', '\\SO\\JualKonsinyasiTglMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2743, 'Administrator', '\\SO\\JualReturTglMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2744, 'Administrator', '\\SO\\JualTglMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2745, 'Administrator', '\\SO\\JualTglMonthlyDept.Rpt', NULL, NULL, NULL, NULL),
	(2746, 'Administrator', '\\SO\\JualTglMonthlySales.Rpt', NULL, NULL, NULL, NULL),
	(2747, 'Administrator', '\\So\\KomisiSalesmanMonthly.rpt', NULL, NULL, NULL, NULL),
	(2748, 'Administrator', '\\So\\KomisiSalesmanSummary.rpt', NULL, NULL, NULL, NULL),
	(2749, 'Administrator', '\\So\\KreditMemoSummary.rpt', NULL, NULL, NULL, NULL),
	(2750, 'Administrator', '\\SO\\MutasiStock.Rpt', NULL, NULL, NULL, NULL),
	(2751, 'Administrator', '\\SO\\MutasiStockPrice.Rpt', NULL, NULL, NULL, NULL),
	(2752, 'Administrator', '\\So\\PenjualanCustomer.rpt', NULL, NULL, NULL, NULL),
	(2753, 'Administrator', '\\So\\PenjualanCustomerDetail.rpt', NULL, NULL, NULL, NULL),
	(2754, 'Administrator', '\\So\\PenjualanPerbulanDetail.rpt', NULL, NULL, NULL, NULL),
	(2755, 'Administrator', '\\So\\SaldoPiutang.rpt', NULL, NULL, NULL, NULL),
	(2756, 'Administrator', '\\SO\\SalesKomisi.exe', NULL, NULL, NULL, NULL),
	(2757, 'Administrator', '\\SO\\SalesOrder.rpt', NULL, NULL, NULL, NULL),
	(2758, 'Administrator', '\\so\\SalesOrderDetail.rpt', NULL, NULL, NULL, NULL),
	(2759, 'Administrator', '\\so\\salesorder_do.rpt', NULL, NULL, NULL, NULL),
	(2760, 'Administrator', '\\so\\salesorder_do_item.rpt', NULL, NULL, NULL, NULL),
	(2761, 'Administrator', '\\so\\sisa_piutang.rpt', NULL, NULL, NULL, NULL),
	(2762, 'Administrator', '\\so\\sisa_piutang_bulan.rpt', NULL, NULL, NULL, NULL),
	(2763, 'Administrator', '\\SO\\SOOpenItem.rpt', NULL, NULL, NULL, NULL),
	(2764, 'Administrator', '\\SO\\SOOpenTanggal.rpt', NULL, NULL, NULL, NULL),
	(2765, 'Administrator', '_90091', NULL, NULL, NULL, NULL),
	(2766, 'Administrator', '_90092', NULL, NULL, NULL, NULL),
	(2767, 'Administrator', '_90093', NULL, NULL, NULL, NULL),
	(2768, 'Administrator', '_90094', NULL, NULL, NULL, NULL),
	(2769, 'Administrator', '_90095', NULL, NULL, NULL, NULL),
	(2770, 'Administrator', '_90096', NULL, NULL, NULL, NULL),
	(2771, 'Administrator', '_90097', NULL, NULL, NULL, NULL),
	(2772, 'Administrator', '_90098', NULL, NULL, NULL, NULL),
	(2773, 'Administrator', '_90099', NULL, NULL, NULL, NULL),
	(2774, 'Administrator', '_90100', NULL, NULL, NULL, NULL),
	(2775, 'Administrator', '_90101', NULL, NULL, NULL, NULL),
	(2776, 'Administrator', '_90102', NULL, NULL, NULL, NULL),
	(2777, 'Administrator', '_90103', NULL, NULL, NULL, NULL),
	(2778, 'Administrator', '_90104', NULL, NULL, NULL, NULL),
	(2779, 'Administrator', '_90105', NULL, NULL, NULL, NULL),
	(2780, 'Administrator', '_90106', NULL, NULL, NULL, NULL),
	(2781, 'Administrator', '_90107', NULL, NULL, NULL, NULL),
	(2782, 'Administrator', '_90108', NULL, NULL, NULL, NULL),
	(2783, 'Administrator', '_90109', NULL, NULL, NULL, NULL),
	(2784, 'Administrator', '_90120', NULL, NULL, NULL, NULL),
	(2785, 'Administrator', '\\Po\\DaftarHutang.rpt', NULL, NULL, NULL, NULL),
	(2786, 'Administrator', '\\po\\DaftarSupplier.rpt', NULL, NULL, NULL, NULL),
	(2787, 'Administrator', '\\po\\DaftarSupplierUtama.rpt', NULL, NULL, NULL, NULL),
	(2788, 'Administrator', '\\Po\\HistoryHargaItemSupplier.rpt', NULL, NULL, NULL, NULL),
	(2789, 'Administrator', '\\PO\\PayAnaSupplier.Rpt', NULL, NULL, NULL, NULL),
	(2790, 'Administrator', '\\PO\\PayDetailDaily.Rpt', NULL, NULL, NULL, NULL),
	(2791, 'Administrator', '\\PO\\PayDetailMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2792, 'Administrator', '\\Po\\SaldoHutang.rpt', NULL, NULL, NULL, NULL),
	(2793, 'Administrator', '\\po\\SelisihKursHutang1.Rpt', NULL, NULL, NULL, NULL),
	(2794, 'Administrator', '\\po\\sisa_hutang.rpt', NULL, NULL, NULL, NULL),
	(2795, 'Administrator', '\\po\\sisa_hutang_bulan.rpt', NULL, NULL, NULL, NULL),
	(2796, 'Administrator', '\\po\\supplierEnvelop.rpt', NULL, NULL, NULL, NULL),
	(2797, 'Administrator', '\\Po\\SupplierLstFinancial.rpt', NULL, NULL, NULL, NULL),
	(2798, 'Administrator', '\\Po\\SupplierLstNumber.Rpt', NULL, NULL, NULL, NULL),
	(2799, 'Administrator', '\\Po\\SupplierPayables.rpt', NULL, NULL, NULL, NULL),
	(2800, 'Administrator', '\\PO\\TotalPayableSupplier.rpt', NULL, NULL, NULL, NULL),
	(2801, 'Administrator', '_90121', NULL, NULL, NULL, NULL),
	(2802, 'Administrator', '_90122', NULL, NULL, NULL, NULL),
	(2803, 'Administrator', '_90123', NULL, NULL, NULL, NULL),
	(2804, 'Administrator', '_90124', NULL, NULL, NULL, NULL),
	(2805, 'Administrator', '_90125', NULL, NULL, NULL, NULL),
	(2806, 'Administrator', '_90126', NULL, NULL, NULL, NULL),
	(2807, 'Administrator', '_90127', NULL, NULL, NULL, NULL),
	(2808, 'Administrator', '_90128', NULL, NULL, NULL, NULL),
	(2809, 'Administrator', '_90129', NULL, NULL, NULL, NULL),
	(2810, 'Administrator', '_90130', NULL, NULL, NULL, NULL),
	(2811, 'Administrator', '_90131', NULL, NULL, NULL, NULL),
	(2812, 'Administrator', '_90132', NULL, NULL, NULL, NULL),
	(2813, 'Administrator', '_90150', NULL, NULL, NULL, NULL),
	(2814, 'Administrator', '_90151', NULL, NULL, NULL, NULL),
	(2815, 'Administrator', '_90152', NULL, NULL, NULL, NULL),
	(2816, 'Administrator', '_90153', NULL, NULL, NULL, NULL),
	(2817, 'Administrator', '_90154', NULL, NULL, NULL, NULL),
	(2818, 'Administrator', '_90155', NULL, NULL, NULL, NULL),
	(2819, 'Administrator', '_90156', NULL, NULL, NULL, NULL),
	(2820, 'Administrator', '_90157', NULL, NULL, NULL, NULL),
	(2821, 'Administrator', '_90158', NULL, NULL, NULL, NULL),
	(2822, 'Administrator', '_90159', NULL, NULL, NULL, NULL),
	(2823, 'Administrator', '_90160', NULL, NULL, NULL, NULL),
	(2824, 'Administrator', '_90161', NULL, NULL, NULL, NULL),
	(2825, 'Administrator', '_90162', NULL, NULL, NULL, NULL),
	(2873, 'ADM', '_30000.034', NULL, NULL, NULL, NULL),
	(2874, 'ADM', '_30000.035', NULL, NULL, NULL, NULL),
	(2875, 'ADM', '_30000.036', NULL, NULL, NULL, NULL),
	(2876, 'ADM', '_30000.037', NULL, NULL, NULL, NULL),
	(2877, 'ADM', '_30000.038', NULL, NULL, NULL, NULL),
	(2878, 'ADM', '_30000.039', NULL, NULL, NULL, NULL),
	(2879, 'ADM', '_30000.040', NULL, NULL, NULL, NULL),
	(2880, 'ADM', '_30000.041', NULL, NULL, NULL, NULL),
	(2881, 'ADM', '_30000.054', NULL, NULL, NULL, NULL),
	(2882, 'ADM', '_30000.056', NULL, NULL, NULL, NULL),
	(2883, 'ADM', '_30000.057', NULL, NULL, NULL, NULL),
	(2884, 'ADM', '_30000.059', NULL, NULL, NULL, NULL),
	(2885, 'ADM', '_30000.060', NULL, NULL, NULL, NULL),
	(2886, 'ADM', '_30000.061', NULL, NULL, NULL, NULL),
	(2887, 'ADM', '_30000.062', NULL, NULL, NULL, NULL),
	(2888, 'ADM', '_30000.063', NULL, NULL, NULL, NULL),
	(2889, 'ADM', '_30000.064', NULL, NULL, NULL, NULL),
	(2890, 'ADM', '_30000.065', NULL, NULL, NULL, NULL),
	(2891, 'ADM', '_30000.066', NULL, NULL, NULL, NULL),
	(2892, 'ADM', '_30000.100', NULL, NULL, NULL, NULL),
	(2893, 'aaa', 'frmMain.Addnew', NULL, NULL, NULL, NULL),
	(2894, 'aaa', 'ID_ExportImport', NULL, NULL, NULL, NULL),
	(2895, 'aaa', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
	(2896, 'aaa', '_00010', NULL, NULL, NULL, NULL),
	(2897, 'SLSADM', '_30000', NULL, NULL, NULL, NULL),
	(2898, 'SLSADM', '_30010', NULL, NULL, NULL, NULL),
	(2899, 'SLSADM', 'frmCustomers.cmdSaveShipTo', NULL, NULL, NULL, NULL),
	(2900, 'SLSADM', '_30011', NULL, NULL, NULL, NULL),
	(2901, 'SLSADM', '_30012', NULL, NULL, NULL, NULL),
	(2902, 'SLSADM', '_30020', NULL, NULL, NULL, NULL),
	(2903, 'SLSADM', '_30050', NULL, NULL, NULL, NULL),
	(2904, 'SLSADM', '_30051', NULL, NULL, NULL, NULL),
	(2905, 'SLSADM', '_30052', NULL, NULL, NULL, NULL),
	(2992, 'Gudang', '_30000', NULL, NULL, NULL, NULL),
	(2993, 'Gudang', '_30060', NULL, NULL, NULL, NULL),
	(2994, 'Gudang', '_30061', NULL, NULL, NULL, NULL),
	(2995, 'Gudang', '_30062', NULL, NULL, NULL, NULL),
	(2996, 'Gudang', '_30064', NULL, NULL, NULL, NULL),
	(2997, 'Gudang', '_80000', NULL, NULL, NULL, NULL),
	(2998, 'Gudang', '_80010', NULL, NULL, NULL, NULL),
	(2999, 'Gudang', '_80011', NULL, NULL, NULL, NULL),
	(3000, 'Gudang', '_80012', NULL, NULL, NULL, NULL),
	(3001, 'Gudang', '_80020', NULL, NULL, NULL, NULL),
	(3002, 'Gudang', '_80021', NULL, NULL, NULL, NULL),
	(3192, 'FIN', '_40123', NULL, NULL, NULL, NULL),
	(3193, 'FIN', '_40130', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `user_group_modules` ENABLE KEYS */;
