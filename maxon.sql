CREATE TABLE `hr_leaves` (
  `nip` varchar(50) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `leave_type` varchar(50) DEFAULT NULL,
  `leave_day` varchar(50) DEFAULT NULL,
  `reason` varchar(250) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `doc_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping structure for table simak.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `date_post` datetime DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `show_on_top` int(11) DEFAULT NULL,
  `icon_file` varchar(250) DEFAULT NULL,
  `doc_name` varchar(50) DEFAULT NULL,
  `section_name` varchar(50) DEFAULT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- Dumping structure for table simak.bank_accounts
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `bank_account_number` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `type_bank` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bank_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aba_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `routing_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state_province` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `starting_check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_bank_statement_date` datetime DEFAULT NULL,
  `last_bank_statement_balance` double DEFAULT NULL,
  `account_id` int(50) DEFAULT NULL,
  `micr_line` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `no_bukti_in` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_bukti_out` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`bank_account_number`),
  KEY `x1` (`bank_account_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.bank_accounts: 3 rows
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
REPLACE INTO `bank_accounts` (`bank_account_number`, `type_bank`, `bank_name`, `aba_number`, `routing_code`, `street`, `suite`, `city`, `state_province`, `zip_postal_code`, `country`, `contact_name`, `phone_number`, `fax_number`, `starting_check_number`, `last_bank_statement_date`, `last_bank_statement_balance`, `account_id`, `micr_line`, `no_bukti_in`, `no_bukti_out`, `org_id`, `update_status`) VALUES
	('BCA', '0', 'BCA', '', '', '', '', '', '', '', '', '', '', '', '', '2015-11-15 00:00:00', 0, 1485, '', '', '', '', ''),
	('CASH', '1', 'CASH', '', '', '', '', '', '', '', '', '', '', '', '', '2015-11-15 00:00:00', 0, 1370, '', '', '', '', ''),
	('aaa', '0', 'bbbb', '', '', '0', '', '0', '', '', '', '', '0', '', '', '2015-11-15 00:00:00', 0, 1495, '', '', '', '', '');
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;


-- Dumping structure for table simak.bill_detail
CREATE TABLE IF NOT EXISTS `bill_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `tgl_jatuh_tempo` datetime DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_bill_detail` (`bill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.bill_detail: 0 rows
/*!40000 ALTER TABLE `bill_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill_detail` ENABLE KEYS */;


-- Dumping structure for table simak.bill_header
CREATE TABLE IF NOT EXISTS `bill_header` (
  `bill_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `customer_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_id`),
  KEY `ix_customer` (`customer_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.bill_header: 0 rows
/*!40000 ALTER TABLE `bill_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill_header` ENABLE KEYS */;


-- Dumping structure for table simak.branch
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
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
  PRIMARY KEY (`branch_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table simak.branch: 3 rows
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
REPLACE INTO `branch` (`branch_code`, `branch_name`, `address_type`, `attention_name`, `company_name`, `street`, `suite`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `other_phone`, `comments`, `update_status`) VALUES
	('KRW', 'KARAWANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CWG', 'CAWANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PST', 'PUSAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;


-- Dumping structure for table simak.budget
CREATE TABLE IF NOT EXISTS `budget` (
  `account_id` int(11) DEFAULT NULL,
  `budget_year` int(11) DEFAULT NULL,
  `january` double DEFAULT NULL,
  `february` double DEFAULT NULL,
  `march` double DEFAULT NULL,
  `april` double DEFAULT NULL,
  `may` double DEFAULT NULL,
  `june` double DEFAULT NULL,
  `july` double DEFAULT NULL,
  `august` double DEFAULT NULL,
  `september` double DEFAULT NULL,
  `october` double DEFAULT NULL,
  `november` double DEFAULT NULL,
  `december` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `x1` (`account_id`,`budget_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.budget: 0 rows
/*!40000 ALTER TABLE `budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `budget` ENABLE KEYS */;


-- Dumping structure for table simak.chart_account_link
CREATE TABLE IF NOT EXISTS `chart_account_link` (
  `company_code` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `hutang` int(11) DEFAULT NULL,
  `penerimaan` int(11) DEFAULT NULL,
  `piutang` int(11) DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `laba_periode` int(11) DEFAULT NULL,
  `laba_ditahan` int(11) DEFAULT NULL,
  `historical_balancing` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.chart_account_link: 0 rows
/*!40000 ALTER TABLE `chart_account_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `chart_account_link` ENABLE KEYS */;


-- Dumping structure for table simak.chart_of_accounts
CREATE TABLE IF NOT EXISTS `chart_of_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `account_type` double DEFAULT NULL,
  `group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `group_sequence` double DEFAULT NULL,
  `account` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `account_description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sub_account` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `sub_account_description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `beginning_balance` double DEFAULT NULL,
  `notes` double DEFAULT NULL,
  `db_or_cr` int(11) DEFAULT NULL,
  `flag_archive` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`account`),
  KEY `x2` (`account_description`)
) ENGINE=MyISAM AUTO_INCREMENT=1509 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.chart_of_accounts: 72 rows
/*!40000 ALTER TABLE `chart_of_accounts` DISABLE KEYS */;
REPLACE INTO `chart_of_accounts` (`id`, `company_code`, `account_type`, `group_type`, `group_sequence`, `account`, `account_description`, `sub_account`, `sub_account_description`, `beginning_balance`, `notes`, `db_or_cr`, `flag_archive`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(1370, 'MYPOS', 1, '10000', 0, '11001', 'Cash', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1373, 'MYPOS', 1, '10000', 0, '13200', 'Piutang Dagang', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1374, 'MYPOS', 1, '11', 0, '13700', 'Persediaan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1375, 'MYPOS', 1, '11', 5, '13800', 'Biaya dibayar dimuka', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1376, 'MYPOS', 1, '12', 0, '15100', 'Tanah', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1377, 'MYPOS', 1, '12', 0, '15150', 'Gedung', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1378, 'MYPOS', 1, '12', 0, '15151', 'Akumulasi Depr. Gedung', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1379, 'MYPOS', 1, '12', 0, '15200', 'Peralatan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1380, 'MYPOS', 1, '12', 0, '15201', 'Akumulasi Depr. Peralatan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1381, 'MYPOS', 1, '12', 0, '15230', 'Komputer', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1382, 'MYPOS', 1, '12', 0, '15231', 'Akumulasi Depr. Komputer', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1383, 'MYPOS', 1, '12', 8, '15480', 'Furnitur dan Mebel', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1384, 'MYPOS', 1, '12', 0, '15481', 'Akumulasi Depr.Meubel', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1385, 'MYPOS', 1, '12', 0, '16610', 'Kendaraan dan Truk', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1386, 'MYPOS', 1, '12', 0, '16611', 'Akumulasi Depr. Kendaraan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1393, 'MYPOS', 2, '20000', 0, '21000', 'Hutang Dagang', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1394, 'MYPOS', 2, '21', 2, '21200', 'Hutang (Cicilan)', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1396, 'MYPOS', 2, '21', 4, '21700', 'PPN', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1408, 'MYPOS', 3, '33', 0, '30200', 'Laba (Rugi) ditahan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1410, 'MYPOS', 3, '33', 0, '30400', 'Modal', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1411, 'MYPOS', 3, '33', 0, '30500', 'Prive', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1415, 'MYPOS', 4, '41', 0, '40005', 'Penjualan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1416, 'MYPOS', 4, '41', 0, '44000', 'Potongan Penjualan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1417, 'MYPOS', 4, '41', 0, '45000', 'Ongkos Angkut', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1419, 'MYPOS', 5, '51', 0, '50001', 'Harga Pokok Penjualan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1420, 'MYPOS', 5, '51', 3, '50002', 'Ongkos Angkut Pembelian', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1421, 'MYPOS', 5, '51', 4, '50003', 'Potongan Pembelian', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1423, 'MYPOS', 6, '61', 1, '60100', 'Biaya Administrasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1424, 'MYPOS', 6, '61', 0, '60110', 'Biaya Iklan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1427, 'MYPOS', 6, '61', 0, '60350', 'Biaya Bank', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1429, 'MYPOS', 6, '61', 7, '60500', 'Biaya Komisi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1430, 'MYPOS', 6, '61', 0, '60600', 'Biaya Konsultasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1433, 'MYPOS', 6, '61', 11, '60700', 'Biaya Kirim', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1434, 'MYPOS', 6, '61', 0, '60720', 'Biaya Penyusutan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1437, 'MYPOS', 6, '61', 15, '62160', 'Biaya Marketing', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1438, 'MYPOS', 6, '61', 16, '62190', 'Biaya Sewa Perlengkapan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1447, 'MYPOS', 6, '61', 25, '64900', 'Biaya Maintenance dan Perbaikan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1448, 'MYPOS', 6, '61', 0, '64950', 'Biaya Peralatan Kantor', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1449, 'MYPOS', 6, '61', 0, '65250', 'Biaya Gaji', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1450, 'MYPOS', 6, '61', 0, '65400', 'Biaya Promosi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1452, 'MYPOS', 6, '61', 0, '65600', 'Biaya Sewa', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1453, 'MYPOS', 6, '61', 31, '66000', 'Biaya Gaji Bag. Administrasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1454, 'MYPOS', 6, '61', 32, '66100', 'Biaya Gaji Bag. Sales', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1455, 'MYPOS', 6, '61', 0, '66200', 'Biaya Keamanan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1456, 'MYPOS', 6, '61', 34, '66300', 'Biaya Software', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1457, 'MYPOS', 6, '61', 35, '66350', 'Biaya Perlengkapan Kantor', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1458, 'MYPOS', 7, '71', 0, '66351', 'Biaya Pajak', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1464, 'MYPOS', 6, '61', 0, '66352', 'Biaya Telphone', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1465, 'MYPOS', 6, '61', 43, '66353', 'Biaya Perjalanan Dinas', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1473, 'MYPOS', 1, '10000', 0, '11006', 'BCA Cab. Jakarta', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1477, 'MYPOS', 1, '11', 0, '14000', 'Uang muka penjualan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1481, 'MYPOS', 5, '51', 0, '51002', 'Harga Pokok Penjualan Konsinyasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1482, 'MYPOS', 4, '41', 0, '46000', 'Lain-lain', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1483, 'MYPOS', 3, '33', 0, '30100', 'Laba (Rugi) berjalan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1484, 'MYPOS', 8, '81', 0, '81001', 'PPH', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1485, 'MYPOS', 1, '10000', 0, '11002', 'BCA Cab. Bandung', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1489, 'MYPOS', 6, '61', 0, '66354', 'Biaya Kirim Barang', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1491, 'MYPOS', 1, '11', 0, '19001', 'Ayat Silang', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1498, NULL, 1, '10000', NULL, '13201', 'Piutang Bunga', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1508, NULL, 1, '10000', NULL, '13705', 'Persediaan Barang Dlm Produksi', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `chart_of_accounts` ENABLE KEYS */;


-- Dumping structure for table simak.chart_of_account_types
CREATE TABLE IF NOT EXISTS `chart_of_account_types` (
  `account_type_num` double NOT NULL DEFAULT '0',
  `account_type` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `income_statement_num` int(11) DEFAULT NULL,
  `sub_acc_income` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`account_type_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.chart_of_account_types: 8 rows
/*!40000 ALTER TABLE `chart_of_account_types` DISABLE KEYS */;
REPLACE INTO `chart_of_account_types` (`account_type_num`, `account_type`, `income_statement_num`, `sub_acc_income`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'Aktiva', NULL, NULL, NULL, NULL, NULL),
	(2, 'Hutang', NULL, NULL, NULL, NULL, NULL),
	(3, 'Modal', NULL, NULL, NULL, NULL, NULL),
	(4, 'Pendapatan', NULL, NULL, NULL, NULL, NULL),
	(5, 'Harga Pokok', NULL, NULL, NULL, NULL, NULL),
	(6, 'Biaya', NULL, NULL, NULL, NULL, NULL),
	(7, 'Pendapatan Lain', NULL, NULL, NULL, NULL, NULL),
	(8, 'Baya Lain', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `chart_of_account_types` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer
CREATE TABLE IF NOT EXISTS `check_writer` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `check_date` datetime DEFAULT NULL,
  `payee` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `deposit_amount` double DEFAULT NULL,
  `memo` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `cleared` int(1) DEFAULT NULL,
  `cleared_date` datetime DEFAULT NULL,
  `void` int(1) DEFAULT NULL,
  `print` int(1) DEFAULT NULL,
  `voucher` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `adjustment_dr_account_id` int(11) DEFAULT NULL,
  `adjustment_cr_account_id` int(11) DEFAULT NULL,
  `bill_payment` int(1) DEFAULT NULL,
  `posting_gl_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int(1) DEFAULT NULL,
  `printed` datetime DEFAULT NULL,
  `batch_post` int(1) DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `paymentlineid` int(11) DEFAULT NULL,
  `from_bank` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bank_tran_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_rate_exc` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `jenisuangmuka` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sisauangmuka` double DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `x1` (`payee`),
  KEY `x2` (`voucher`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer: 1 rows
/*!40000 ALTER TABLE `check_writer` DISABLE KEYS */;
REPLACE INTO `check_writer` (`trans_id`, `trans_type`, `account_number`, `check_number`, `check_date`, `payee`, `supplier_number`, `payment_amount`, `deposit_amount`, `memo`, `cleared`, `cleared_date`, `void`, `print`, `voucher`, `adjustment_dr_account_id`, `adjustment_cr_account_id`, `bill_payment`, `posting_gl_id`, `posted`, `printed`, `batch_post`, `invoice_number`, `paymentlineid`, `from_bank`, `bank_tran_id`, `curr_code`, `curr_rate`, `curr_rate_exc`, `curr_code_org`, `curr_rate_org`, `org_id`, `update_status`, `jenisuangmuka`, `sisauangmuka`, `sourceautonumber`, `sourcefile`, `update_date`) VALUES
	(1, 'cash in', 'CASH', '', '2016-03-12 00:00:00', 'Adrian', '101', 0, 1000000, '', 0, '2016-03-12 00:00:00', 0, 0, 'KM00005', 0, 0, 0, '', 0, '2016-03-12 00:00:00', 0, '', 0, '', '', '', 0, 0, '', 0, '', 0, '', 0, '', '', '2016-03-12 00:00:00');
/*!40000 ALTER TABLE `check_writer` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_deposit_detail
CREATE TABLE IF NOT EXISTS `check_writer_deposit_detail` (
  `trans_id` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `routing_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`),
  KEY `x1` (`trans_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_deposit_detail: 0 rows
/*!40000 ALTER TABLE `check_writer_deposit_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_deposit_detail` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_items
CREATE TABLE IF NOT EXISTS `check_writer_items` (
  `trans_id` int(11) DEFAULT NULL,
  `trans_type` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `comments` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `account` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `ref1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`line_number`),
  KEY `x1` (`trans_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_items: 1 rows
/*!40000 ALTER TABLE `check_writer_items` DISABLE KEYS */;
REPLACE INTO `check_writer_items` (`trans_id`, `trans_type`, `line_number`, `account_id`, `amount`, `comments`, `account`, `description`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `invoice_number`, `ref1`) VALUES
	(1, NULL, 1, 1373, 1000000, '', '13200', 'Piutang Dagang', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `check_writer_items` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_print_settings
CREATE TABLE IF NOT EXISTS `check_writer_print_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `check_position` double DEFAULT NULL,
  `check_type` double DEFAULT NULL,
  `paper_type` double DEFAULT NULL,
  `print_all_info` int DEFAULT NULL,
  `print_check_num` int DEFAULT NULL,
  `print_check_stub` int DEFAULT NULL,
  `print_company_info` int DEFAULT NULL,
  `print_bank_info` int DEFAULT NULL,
  `print_payee_address` int DEFAULT NULL,
  `print_micr` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_print_settings: 0 rows
/*!40000 ALTER TABLE `check_writer_print_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_print_settings` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_recurring_payments
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payments` (
  `payment_number` int(11) DEFAULT NULL,
  `bank_account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payee` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `memo` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `voucher` double DEFAULT NULL,
  `frequency` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `selected` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_recurring_payments: 0 rows
/*!40000 ALTER TABLE `check_writer_recurring_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_recurring_payments` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_recurring_payment_items
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payment_items` (
  `payment_number` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_recurring_payment_items: 0 rows
/*!40000 ALTER TABLE `check_writer_recurring_payment_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_recurring_payment_items` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_undeposited_checks
CREATE TABLE IF NOT EXISTS `check_writer_undeposited_checks` (
  `payment_date` datetime DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `selected` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_undeposited_checks: 0 rows
/*!40000 ALTER TABLE `check_writer_undeposited_checks` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_undeposited_checks` ENABLE KEYS */;


-- Dumping structure for table simak.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `city_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.city: 3 rows
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
REPLACE INTO `city` (`city_id`, `city_name`) VALUES
	('01', 'Purwakarta'),
	('02', 'Jakarta'),
	('03', 'Surabaya');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;


-- Dumping structure for table simak.com_list
CREATE TABLE IF NOT EXISTS `com_list` (
  `com_code` varchar(50) DEFAULT NULL,
  `com_db_name` varchar(50) DEFAULT NULL,
  `com_url` varchar(150) DEFAULT NULL,
  `com_short_desc` varchar(250) DEFAULT NULL,
  `com_long_desc` varchar(550) DEFAULT NULL,
  `com_logo` varchar(150) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.com_list: 7 rows
/*!40000 ALTER TABLE `com_list` DISABLE KEYS */;
REPLACE INTO `com_list` (`com_code`, `com_db_name`, `com_url`, `com_short_desc`, `com_long_desc`, `com_logo`, `id`) VALUES
	('test1', 'test1', 'http://localhost/talagasoft/simak/v6.maxon//company/test1/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test1/images/logo.jpg', 1),
	('test8', 'test8', 'http://localhost/talagasoft/simak/v6.maxon//company/test8/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test8/images/gnome-db.png', 7);
/*!40000 ALTER TABLE `com_list` ENABLE KEYS */;


-- Dumping structure for table simak.country
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` varchar(50) DEFAULT NULL,
  `country_name` varchar(50) DEFAULT NULL,
  `curr_code` varchar(50) DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.country: 2 rows
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
REPLACE INTO `country` (`country_id`, `country_name`, `curr_code`, `curr_rate`, `id`) VALUES
	('INA', 'Indonesia', 'Rp.', 1, 1),
	('US', 'United States', '$', 0, 2);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;


-- Dumping structure for table simak.crdb_memo
CREATE TABLE IF NOT EXISTS `crdb_memo` (
  `linenumber` int(11) NOT NULL AUTO_INCREMENT,
  `transtype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `docnumber` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `amount` double DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `kodecrdb` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int(1) DEFAULT NULL,
  `accountid` int(11) DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`linenumber`,`docnumber`),
  KEY `x1` (`docnumber`),
  KEY `x2` (`kodecrdb`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.crdb_memo: 0 rows
/*!40000 ALTER TABLE `crdb_memo` DISABLE KEYS */;
/*!40000 ALTER TABLE `crdb_memo` ENABLE KEYS */;


-- Dumping structure for table simak.crdb_memo_dtl
CREATE TABLE IF NOT EXISTS `crdb_memo_dtl` (
  `lineid` int(11) NOT NULL AUTO_INCREMENT,
  `kodecrdb` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `accountid` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`lineid`),
  KEY `x1` (`kodecrdb`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.crdb_memo_dtl: 0 rows
/*!40000 ALTER TABLE `crdb_memo_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `crdb_memo_dtl` ENABLE KEYS */;


-- Dumping structure for table simak.credit_card_type
CREATE TABLE IF NOT EXISTS `credit_card_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `card_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `disc_percent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`card_type`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.credit_card_type: 4 rows
/*!40000 ALTER TABLE `credit_card_type` DISABLE KEYS */;
REPLACE INTO `credit_card_type` (`id`, `card_type`, `update_status`, `sourceautonumber`, `sourcefile`, `card_name`, `to_date`, `from_date`, `disc_percent`) VALUES
	(1, 'Citibank', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'Mandiri Visa', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'Mandiri Master', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'Amex', NULL, NULL, NULL, 'Amex Card', '2010-02-11 00:00:00', '2009-07-24 00:00:00', 10);
/*!40000 ALTER TABLE `credit_card_type` ENABLE KEYS */;


-- Dumping structure for table simak.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `currency_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`currency_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.currencies: 2 rows
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
REPLACE INTO `currencies` (`currency_code`, `description`, `update_status`) VALUES
	('IDR', 'Rupiah', NULL),
	('USD', 'Dollar', NULL);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;


-- Dumping structure for table simak.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int(1) DEFAULT NULL,
  `customer_record_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `region` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salutation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `middle_initial` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tax_exempt` int(1) DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `credit_limit` double DEFAULT NULL,
  `discount_percent` double(11,0) DEFAULT NULL,
  `markup_percent` double(11,0) DEFAULT NULL,
  `credit_balance` double DEFAULT NULL,
  `pricing_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `credithold` int(1) DEFAULT NULL,
  `salesman` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `route_delivery_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `route_delivery_sequence` int(11) DEFAULT NULL,
  `route_delivery_day` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `finance_charges` int DEFAULT NULL,
  `last_finance_charge_date` datetime DEFAULT NULL,
  `finance_charge_acct` int(11) DEFAULT NULL,
  `finance_charge_pct` double DEFAULT NULL,
  `bill_to_customer_number` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `current_balance` double DEFAULT NULL,
  `npwp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `nppkp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `limi_date` datetime DEFAULT NULL,
  `disc_min_qty` double DEFAULT NULL,
  `markup_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `disc_prc_2` double DEFAULT NULL,
  `disc_prc_3` double DEFAULT NULL,
  PRIMARY KEY (`customer_number`),
  KEY `x1` (`company`),
  KEY `x2` (`city`),
  KEY `x3` (`type_of_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customers: 18 rows
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
REPLACE INTO `customers` (`customer_number`, `active`, `customer_record_type`, `type_of_customer`, `region`, `salutation`, `first_name`, `middle_initial`, `last_name`, `company`, `street`, `suite`, `city`, `state`, `zip_postal_code`, `country`, `phone`, `fax`, `other_phone`, `email`, `tax_exempt`, `sales_tax_code`, `sales_tax2_code`, `credit_limit`, `discount_percent`, `markup_percent`, `credit_balance`, `pricing_type`, `code`, `comments`, `payment_terms`, `credithold`, `salesman`, `shipped_via`, `route_delivery_code`, `route_delivery_sequence`, `route_delivery_day`, `finance_charges`, `last_finance_charge_date`, `finance_charge_acct`, `finance_charge_pct`, `bill_to_customer_number`, `current_balance`, `npwp`, `org_id`, `update_status`, `nppkp`, `create_date`, `create_by`, `update_date`, `update_by`, `password`, `limi_date`, `disc_min_qty`, `markup_amount`, `discount_amount`, `disc_prc_2`, `disc_prc_3`) VALUES
	('101', NULL, '', NULL, '', '', '', '', '', 'Adrian', 'Jl. Raya Sadang', '', 'Jakarta', NULL, '', '', '', '', NULL, '', NULL, NULL, NULL, 10000000, 30, 0, 8799469.959, NULL, NULL, 0, 'Po Net 45', NULL, 'AGUS', '', NULL, 0, NULL, NULL, '2015-01-28 21:08:39', 0, 0, NULL, 1200530.041, '0', NULL, 1, NULL, '2013-10-22 13:29:50', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 20, 10),
	('103', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ovie', NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -16920000, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 16920000, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ganda', NULL, NULL, 'Surabaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('90120', NULL, 'GROSIR', 'BESAR', NULL, NULL, NULL, NULL, NULL, 'Andri Andriana', 'Jl. Raya Purwakarta No. 87', NULL, 'Purwakarta', NULL, NULL, NULL, '082192992', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -1693000, NULL, NULL, 0, 'PO Net 15', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2016-01-15 11:22:07', 0, 0, NULL, 1712800, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('9975370922', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Annisa Azhari', 'Ds. Blang Panyang', NULL, 'Lhokseumawe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -3303200, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2014-01-22 00:00:00', 0, 0, NULL, 7158800, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Ateng', NULL, NULL, 'Guest', NULL, 'Mr', NULL, NULL, NULL, 'Ateng', 'Jl. Raya Sadang, No. 27A', NULL, 'Purwakarta', NULL, NULL, 'INA       ', '026499933', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 759000, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CASH', NULL, NULL, 'ECERAN', NULL, NULL, NULL, NULL, NULL, 'CASH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2013-10-31 12:19:39', 0, 0, NULL, 8855700, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SONY', NULL, 'Pelanggan', NULL, NULL, NULL, NULL, NULL, NULL, 'Sony Music Entertain', NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 100, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2013-03-05 09:18:21', 0, 0, NULL, 0, '.', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;


-- Dumping structure for table simak.customers_other_info
CREATE TABLE IF NOT EXISTS `customers_other_info` (
  `cust_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `disc_percent` int(11) DEFAULT NULL,
  `disc_from_date` datetime DEFAULT NULL,
  `disc_to_date` datetime DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `min_sales` double DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  PRIMARY KEY (`cust_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customers_other_info: 0 rows
/*!40000 ALTER TABLE `customers_other_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_other_info` ENABLE KEYS */;


-- Dumping structure for table simak.customer_beginning_balance
CREATE TABLE IF NOT EXISTS `customer_beginning_balance` (
  `tanggal` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `customer_number` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `piutang_awal` double DEFAULT NULL,
  `piutang` double DEFAULT NULL,
  `piutang_akhir` double DEFAULT NULL,
  `amountin` double DEFAULT NULL,
  `amountout` double DEFAULT NULL,
  `flagawal` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`tanggal`,`customer_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customer_beginning_balance: 0 rows
/*!40000 ALTER TABLE `customer_beginning_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_beginning_balance` ENABLE KEYS */;


-- Dumping structure for table simak.customer_shipto
CREATE TABLE IF NOT EXISTS `customer_shipto` (
  `customer_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `location_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `kota` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_pos` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `x1` (`customer_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customer_shipto: 0 rows
/*!40000 ALTER TABLE `customer_shipto` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_shipto` ENABLE KEYS */;


-- Dumping structure for table simak.customer_statement_defaults
CREATE TABLE IF NOT EXISTS `customer_statement_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aging_date` datetime DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `print_type` int(11) DEFAULT NULL,
  `number_of_copies` int(11) DEFAULT NULL,
  `statement_type` int(11) DEFAULT NULL,
  `customer_range` int(11) DEFAULT NULL,
  `print_dunning_messages` int DEFAULT NULL,
  `minimum_past_due_amount` double DEFAULT NULL,
  `minimum_invoice_age` double DEFAULT NULL,
  `minimum_customer_balance` double DEFAULT NULL,
  `print_zero_balances` int DEFAULT NULL,
  `print_credit_balances` int DEFAULT NULL,
  `current_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_30_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_60_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_90_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_120_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `paymentdisplay` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customer_statement_defaults: 0 rows
/*!40000 ALTER TABLE `customer_statement_defaults` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_statement_defaults` ENABLE KEYS */;


-- Dumping structure for table simak.customer_type
CREATE TABLE IF NOT EXISTS `customer_type` (
  `type_id` varchar(50) DEFAULT NULL,
  `type_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`type_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.customer_type: 2 rows
/*!40000 ALTER TABLE `customer_type` DISABLE KEYS */;
REPLACE INTO `customer_type` (`type_id`, `type_name`) VALUES
	('02', 'ECERAN'),
	('01', 'GROSIR');
/*!40000 ALTER TABLE `customer_type` ENABLE KEYS */;


-- Dumping structure for table simak.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dept_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`dept_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.departments: 0 rows
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;


-- Dumping structure for table simak.divisions
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `div_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `div_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`div_code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.divisions: 4 rows
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
REPLACE INTO `divisions` (`id`, `div_code`, `div_name`, `company_code`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'JKT', 'JAKARTA', NULL, NULL, NULL, NULL),
	(2, 'BDG', 'BANDUNG', NULL, NULL, NULL, NULL),
	(3, 'Kantor', 'Kantor', NULL, NULL, NULL, NULL),
	(4, 'Lapangan', 'Lapangan', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;


-- Dumping structure for table simak.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `nip` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tgllahir` datetime DEFAULT NULL,
  `agama` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `kelamin` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `idktpno` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `hireddate` datetime DEFAULT NULL,
  `dept` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `divisi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `level` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supervisor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payperiod` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `kodepos` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telpon` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `hp` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `gp` double DEFAULT NULL,
  `tjabatan` double DEFAULT NULL,
  `ttransport` double DEFAULT NULL,
  `tmakan` double DEFAULT NULL,
  `incentive` double DEFAULT NULL,
  `sc` double(11,0) DEFAULT NULL,
  `rateot` double DEFAULT NULL,
  `tkesehatan` double DEFAULT NULL,
  `tlain` double DEFAULT NULL,
  `bjabatang` double DEFAULT NULL,
  `iurantht` double DEFAULT NULL,
  `blain` double DEFAULT NULL,
  `emptype` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `emplevel` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `pathimage` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `nip_id` int(11) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `gol_darah` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `x1` (`nama`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee: 3 rows
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
REPLACE INTO `employee` (`nip`, `nama`, `tgllahir`, `agama`, `kelamin`, `status`, `idktpno`, `hireddate`, `dept`, `divisi`, `level`, `position`, `supervisor`, `payperiod`, `alamat`, `kodepos`, `telpon`, `hp`, `gp`, `tjabatan`, `ttransport`, `tmakan`, `incentive`, `sc`, `rateot`, `tkesehatan`, `tlain`, `bjabatang`, `iurantht`, `blain`, `emptype`, `emplevel`, `pathimage`, `update_status`, `nip_id`, `npwp`, `account`, `pendidikan`, `tempat_lahir`, `gol_darah`, `bank_name`) VALUES
	('ANDRI', 'Andri Andriana', '2015-01-13 07:00:00', '', 'L', 'K1', '', '2015-01-13 07:00:00', 'HRD', 'JKT', NULL, '', '', NULL, '', '', '', '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAJI1', 'L01', '', NULL, 0, '', '', '', '', 'A', ''),
	('121', 'Puput Melati', '2015-01-13 18:27:38', 'Islam', 'P', 'K1', '123.3239.2929', '2015-01-13 18:27:38', 'HRD', 'JKT', NULL, '', '', NULL, 'Jl. Raya Purwakarta 20', '41172', '', '082112829192', 2000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAJI1', 'L01', '', NULL, 0, '123467', '13800', 'SMA', 'Purwakarta', 'A', ''),
	('122', 'Inul Daratista', '2015-01-13 18:50:30', '', 'P', 'K2', '', '2015-01-13 18:50:30', 'HRD', 'JKT', NULL, '', '', NULL, '', '', '', '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAJI1', 'L01', '', NULL, 0, '', '', '', '', 'A', '');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


-- Dumping structure for table simak.employeeeducations
CREATE TABLE IF NOT EXISTS `employeeeducations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `educationlevel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `school` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `major` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `enteryear` int(11) DEFAULT NULL,
  `graduationyear` int(11) DEFAULT NULL,
  `yearofattend` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `graduate` int DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeeeducations: 2 rows
/*!40000 ALTER TABLE `employeeeducations` DISABLE KEYS */;
REPLACE INTO `employeeeducations` (`id`, `employeeid`, `educationlevel`, `school`, `place`, `major`, `enteryear`, `graduationyear`, `yearofattend`, `graduate`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', 'daf', 'dfaf', 'dfads', NULL, 0, 0, 'dfadsdf', b'10000000', NULL, NULL),
	(2, 'ANDRI', 'dfads', '', '', NULL, 0, 0, '', b'10000000', NULL, NULL);
/*!40000 ALTER TABLE `employeeeducations` ENABLE KEYS */;


-- Dumping structure for table simak.employeeexperience
CREATE TABLE IF NOT EXISTS `employeeexperience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `startdate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `finishdate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `firstposition` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `endposition` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastsalary` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supervisor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `referencename` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `referencephone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reasontoleave` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeeexperience: 2 rows
/*!40000 ALTER TABLE `employeeexperience` DISABLE KEYS */;
REPLACE INTO `employeeexperience` (`id`, `employeeid`, `company`, `startdate`, `finishdate`, `firstposition`, `endposition`, `place`, `lastsalary`, `supervisor`, `referencename`, `referencephone`, `reasontoleave`, `sourceautonumber`, `sourcefile`) VALUES
	(1, '122', 'Ida Royani', '2015-01-13 19:02:31', '2015-01-13 19:02:31', 'a', 'A', 'ss', 'W', 'W', 'W', 'W', 'W', NULL, NULL),
	(3, 'ANDRI', 'dafddfasfd', '2015-06-09 07:32:15', '2015-06-09 07:32:15', 'dfasf', 'dfasf', '', '', '', '', '', '', NULL, NULL);
/*!40000 ALTER TABLE `employeeexperience` ENABLE KEYS */;


-- Dumping structure for table simak.employeefamily
CREATE TABLE IF NOT EXISTS `employeefamily` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `familyname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `relationship` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `age` datetime DEFAULT NULL,
  `education` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `job` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mariagestatus` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeefamily: 1 rows
/*!40000 ALTER TABLE `employeefamily` DISABLE KEYS */;
REPLACE INTO `employeefamily` (`id`, `employeeid`, `familyname`, `relationship`, `age`, `education`, `job`, `mariagestatus`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', 'dfasf', 'dfasd', '1970-01-01 00:00:00', '', '', '', NULL, NULL);
/*!40000 ALTER TABLE `employeefamily` ENABLE KEYS */;


-- Dumping structure for table simak.employeelicense
CREATE TABLE IF NOT EXISTS `employeelicense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `licensenumber` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lincensetype` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `finishdate` datetime DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeelicense: 0 rows
/*!40000 ALTER TABLE `employeelicense` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeelicense` ENABLE KEYS */;


-- Dumping structure for table simak.employeemedical
CREATE TABLE IF NOT EXISTS `employeemedical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `medicaldate` datetime DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeemedical: 1 rows
/*!40000 ALTER TABLE `employeemedical` DISABLE KEYS */;
REPLACE INTO `employeemedical` (`id`, `employeeid`, `medicaldate`, `description`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', '1970-01-01 00:00:00', 'dfasdfsf', NULL, NULL);
/*!40000 ALTER TABLE `employeemedical` ENABLE KEYS */;


-- Dumping structure for table simak.employeerewardpunish
CREATE TABLE IF NOT EXISTS `employeerewardpunish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `daterp` datetime DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rankinglevel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `typerp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeerewardpunish: 1 rows
/*!40000 ALTER TABLE `employeerewardpunish` DISABLE KEYS */;
REPLACE INTO `employeerewardpunish` (`id`, `employeeid`, `daterp`, `description`, `rankinglevel`, `typerp`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', '1970-01-01 00:00:00', 'dfas', 'dfas', '', NULL, NULL);
/*!40000 ALTER TABLE `employeerewardpunish` ENABLE KEYS */;


-- Dumping structure for table simak.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `employeeNumber` int(11) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `officeCode` varchar(10) NOT NULL,
  `reportsTo` int(11) DEFAULT NULL,
  `jobTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`employeeNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employees: 23 rows
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
REPLACE INTO `employees` (`employeeNumber`, `lastName`, `firstName`, `extension`, `email`, `officeCode`, `reportsTo`, `jobTitle`) VALUES
	(1621, 'Nishi', 'Mami', 'x101', 'mnishi@classicmodelcars.com', '5', 1056, 'Sales Rep'),
	(1702, 'Gerard', 'Martin', 'x2312', 'mgerard@classicmodelcars.com', '4', 1102, 'Sales Rep');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;


-- Dumping structure for table simak.employeeskill
CREATE TABLE IF NOT EXISTS `employeeskill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `skillname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `skilllevel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeeskill: 0 rows
/*!40000 ALTER TABLE `employeeskill` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeeskill` ENABLE KEYS */;


-- Dumping structure for table simak.employeetraining
CREATE TABLE IF NOT EXISTS `employeetraining` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `trainingname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `traningdate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `topic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `certificate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeetraining: 0 rows
/*!40000 ALTER TABLE `employeetraining` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeetraining` ENABLE KEYS */;


-- Dumping structure for table simak.employee_group
CREATE TABLE IF NOT EXISTS `employee_group` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_group: 2 rows
/*!40000 ALTER TABLE `employee_group` DISABLE KEYS */;
REPLACE INTO `employee_group` (`kode`, `keterangan`) VALUES
	('GAJI2', 'GAJI2'),
	('GAJI1', 'GAJI1');
/*!40000 ALTER TABLE `employee_group` ENABLE KEYS */;


-- Dumping structure for table simak.employee_level
CREATE TABLE IF NOT EXISTS `employee_level` (
  `levelkode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `levelname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `creationdate` datetime DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`levelkode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_level: 1 rows
/*!40000 ALTER TABLE `employee_level` DISABLE KEYS */;
REPLACE INTO `employee_level` (`levelkode`, `levelname`, `creationdate`, `keterangan`, `update_status`) VALUES
	('L01', 'Level 1', NULL, 'Level 1', NULL);
/*!40000 ALTER TABLE `employee_level` ENABLE KEYS */;


-- Dumping structure for table simak.employee_pph
CREATE TABLE IF NOT EXISTS `employee_pph` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nomor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_pph: 0 rows
/*!40000 ALTER TABLE `employee_pph` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_pph` ENABLE KEYS */;


-- Dumping structure for table simak.employee_shift
CREATE TABLE IF NOT EXISTS `employee_shift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_shift` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan` int(11) DEFAULT NULL,
  `tcid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_shift: 0 rows
/*!40000 ALTER TABLE `employee_shift` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_shift` ENABLE KEYS */;


-- Dumping structure for table simak.employee_type
CREATE TABLE IF NOT EXISTS `employee_type` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_type: 0 rows
/*!40000 ALTER TABLE `employee_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_type` ENABLE KEYS */;


-- Dumping structure for table simak.em_articles
CREATE TABLE IF NOT EXISTS `em_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `date_post` datetime DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `show_on_top` int(11) DEFAULT NULL,
  `icon_file` varchar(250) DEFAULT NULL,
  `doc_name` varchar(50) DEFAULT NULL,
  `section_name` varchar(50) DEFAULT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.em_articles: 2 rows
/*!40000 ALTER TABLE `em_articles` DISABLE KEYS */;
REPLACE INTO `em_articles` (`id`, `title`, `date_post`, `view_count`, `author`, `category`, `content`, `show_on_top`, `icon_file`, `doc_name`, `section_name`, `class_name`) VALUES
	(56, 'Software Kasir', NULL, NULL, NULL, 'email_promo', 'MyPOS adalah software kasir  digunakan untuk mencatat nota-nota penjualan secara cepat baik penjualan tunai ataupun kartu kredit. Software ini bisa anda gunakan di toko retail, toko buku, toko komputer, toko kelontong, sembako,salon, restaurant dan lain-lain. Software MyPos telah disesuaikan dengan operasional di kasir yang menuntut kecepatan input transaksi, otomatis dan interface yang menarik dan mudah digunakan. Kunjungi http://www.talagasoft.com', NULL, NULL, NULL, NULL, NULL),
	(55, 'MyPOS Versi Retail', NULL, NULL, NULL, 'email_promo', 'MyPOS adalah software kasir  digunakan untuk mencatat nota-nota penjualan secara cepat baik penjualan tunai ataupun kartu kredit.  Software ini bisa anda gunakan di toko retail, toko buku, toko komputer, toko kelontong, sembako,salon, restaurant dan lain-lain. Software MyPos telah disesuaikan dengan operasional di kasir yang menuntut kecepatan input transaksi, otomatis dan interface yang menarik dan mudah digunakan. Kunjungi http://www.talagasoft.com', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `em_articles` ENABLE KEYS */;


-- Dumping structure for table simak.em_email
CREATE TABLE IF NOT EXISTS `em_email` (
  `email` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.em_email: 4 rows
/*!40000 ALTER TABLE `em_email` DISABLE KEYS */;
REPLACE INTO `em_email` (`email`, `id`) VALUES
	('andri@talagasoft.com', 80),
	('andri@talagasoft.com', 83),
	('undefined', 84),
	('undefined', 85);
/*!40000 ALTER TABLE `em_email` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_catatan
CREATE TABLE IF NOT EXISTS `eshop_catatan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_toko` int(10) NOT NULL,
  `kelompok` varchar(50) NOT NULL,
  `isi_catatan` varchar(500) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` varchar(50) NOT NULL,
  `update_date` datetime NOT NULL,
  `tampil` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_catatan: 0 rows
/*!40000 ALTER TABLE `eshop_catatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `eshop_catatan` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_comments
CREATE TABLE IF NOT EXISTS `eshop_comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(50) NOT NULL,
  `cm_userid` varchar(50) NOT NULL,
  `cm_username` varchar(50) NOT NULL,
  `cm_date` datetime NOT NULL,
  `comments` varchar(250) NOT NULL,
  `rate_quality` int(11) NOT NULL,
  `rate_accurate` int(11) NOT NULL,
  `rate_speed` int(11) NOT NULL,
  `rate_service` int(11) NOT NULL,
  `reply` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index 2` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_comments: 16 rows
/*!40000 ALTER TABLE `eshop_comments` DISABLE KEYS */;
REPLACE INTO `eshop_comments` (`id`, `item_id`, `cm_userid`, `cm_username`, `cm_date`, `comments`, `rate_quality`, `rate_accurate`, `rate_speed`, `rate_service`, `reply`) VALUES
	(1, 'ABC', '12020', 'udin', '2015-02-14 15:43:12', 'Barang bagus pelayanan mantap', 4, 4, 4, 4, 0),
	(16, 'aaaaa', '', 'bagus', '2015-07-26 16:02:53', 'coba coba bang siapa tau ok', 1, 2, 3, 1, 0);
/*!40000 ALTER TABLE `eshop_comments` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_discuss
CREATE TABLE IF NOT EXISTS `eshop_discuss` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(50) NOT NULL,
  `cm_userid` varchar(50) NOT NULL,
  `cm_username` varchar(50) NOT NULL,
  `cm_date` datetime NOT NULL,
  `comments` varchar(250) NOT NULL,
  `reply` tinyint(4) NOT NULL DEFAULT '0',
  `reply_from` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index 2` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.eshop_discuss: 11 rows
/*!40000 ALTER TABLE `eshop_discuss` DISABLE KEYS */;
REPLACE INTO `eshop_discuss` (`id`, `item_id`, `cm_userid`, `cm_username`, `cm_date`, `comments`, `reply`, `reply_from`) VALUES
	(1, 'abc', 'jono', 'jono', '2015-02-14 16:30:48', 'tanya boleh gan', 0, NULL),
	(11, 'aaaaa', '', 'bagus', '2015-07-26 16:23:55', 'testa et te etee te', 0, NULL);
/*!40000 ALTER TABLE `eshop_discuss` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_etalase
CREATE TABLE IF NOT EXISTS `eshop_etalase` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_toko` int(10) NOT NULL,
  `nama_etalase` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `kelompok` varchar(250) NOT NULL,
  `banner_etalase` varchar(250) NOT NULL,
  `user_admin` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_etalase: 0 rows
/*!40000 ALTER TABLE `eshop_etalase` DISABLE KEYS */;
/*!40000 ALTER TABLE `eshop_etalase` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_lokasi
CREATE TABLE IF NOT EXISTS `eshop_lokasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `telpon` varchar(50) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `kabupaten` varchar(150) NOT NULL,
  `kota` varchar(150) NOT NULL,
  `kode_pos` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_lokasi: 0 rows
/*!40000 ALTER TABLE `eshop_lokasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `eshop_lokasi` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_toko
CREATE TABLE IF NOT EXISTS `eshop_toko` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `slogan` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status_toko` varchar(50) NOT NULL,
  `foto_sampul` varchar(150) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `kabupaten` varchar(150) NOT NULL,
  `kota` varchar(150) NOT NULL,
  `kode_pos` varchar(150) NOT NULL,
  `jasa_kirim` varchar(150) NOT NULL,
  `jenis_bayar` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_toko: 1 rows
/*!40000 ALTER TABLE `eshop_toko` DISABLE KEYS */;
REPLACE INTO `eshop_toko` (`id`, `nama_toko`, `user_id`, `slogan`, `description`, `status_toko`, `foto_sampul`, `provinsi`, `kabupaten`, `kota`, `kode_pos`, `jasa_kirim`, `jenis_bayar`) VALUES
	(8, 'Talagasoft', 'anang', 'Mudah, murah dan otomatis', 'Pusat penjualan software berkwalitas', 'Open', 'sampul.jpg', 'Jawa Barat', 'Purwakarta', 'Pasawahan', '0', 'RPX,CAHAYA,', 'BCA,MANDIRI,');
/*!40000 ALTER TABLE `eshop_toko` ENABLE KEYS */;


-- Dumping structure for table simak.exchange_rate
CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `er_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcecurrency` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `targetcurrency` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.exchange_rate: 0 rows
/*!40000 ALTER TABLE `exchange_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchange_rate` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset
CREATE TABLE IF NOT EXISTS `fa_asset` (
  `id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `group_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `location_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cost_centre_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custodian_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vendor_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sn` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `acquisition_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `acquisition_cost` double DEFAULT NULL,
  `warranty_date` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `depn_method` int(11) DEFAULT NULL,
  `useful_lives` int(11) DEFAULT NULL,
  `salvage_value` int(11) DEFAULT NULL,
  `private_use` int(11) DEFAULT NULL,
  `journal_id` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset: 2 rows
/*!40000 ALTER TABLE `fa_asset` DISABLE KEYS */;
REPLACE INTO `fa_asset` (`id`, `description`, `group_id`, `location_id`, `cost_centre_id`, `custodian_id`, `vendor_id`, `sn`, `acquisition_date`, `acquisition_cost`, `warranty_date`, `depn_method`, `useful_lives`, `salvage_value`, `private_use`, `journal_id`, `update_status`) VALUES
	('0101', 'Komputer Server XEON', '01', '1', '2', '3', '4', '5', '2015-01-01 19:27:27', 10000000, '2015-11-', 0, 12, 1000000, 0, 0, 0),
	('0102', 'Gedung Pabrik Plant 1', '02', '', '', '', '', '', '2015-01-01 00:00:00', 10000000, '1970-01-', 0, 100, 0, 0, 0, 0);
/*!40000 ALTER TABLE `fa_asset` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_depreciation
CREATE TABLE IF NOT EXISTS `fa_asset_depreciation` (
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `depn_year` int(11) DEFAULT NULL,
  `depn_month` int(11) DEFAULT NULL,
  `depn_id` int(11) DEFAULT NULL,
  `acquisition_cost` double DEFAULT NULL,
  `depn_exp` double DEFAULT NULL,
  `accum_depn` double DEFAULT NULL,
  `book_value` double DEFAULT NULL,
  `journal_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_depreciation: 0 rows
/*!40000 ALTER TABLE `fa_asset_depreciation` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_asset_depreciation` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_depreciation_schedule
CREATE TABLE IF NOT EXISTS `fa_asset_depreciation_schedule` (
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `depn_year` int(11) DEFAULT NULL,
  `depn_id` int(11) DEFAULT NULL,
  `acquisition_cost` double DEFAULT NULL,
  `depn_exp` double DEFAULT NULL,
  `accum_depn` double DEFAULT NULL,
  `book_value` double DEFAULT NULL,
  `posted` int DEFAULT NULL,
  `glid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_depreciation_schedule: 6 rows
/*!40000 ALTER TABLE `fa_asset_depreciation_schedule` DISABLE KEYS */;
REPLACE INTO `fa_asset_depreciation_schedule` (`asset_id`, `depn_year`, `depn_id`, `acquisition_cost`, `depn_exp`, `accum_depn`, `book_value`, `posted`, `glid`, `update_status`) VALUES
	('0101', 201612, NULL, 10000000, 750000, NULL, NULL, NULL, NULL, NULL),
	('0102', 201612, NULL, 10000000, 100000, 2400000, 7600000, NULL, NULL, NULL);
/*!40000 ALTER TABLE `fa_asset_depreciation_schedule` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_group
CREATE TABLE IF NOT EXISTS `fa_asset_group` (
  `id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `at_cost` int(11) DEFAULT NULL,
  `accum_depn` int(11) DEFAULT NULL,
  `profit_on_sale` int(11) DEFAULT NULL,
  `loss_on_sale` int(11) DEFAULT NULL,
  `cash_bank` int(11) DEFAULT NULL,
  `depn_method` int(11) DEFAULT NULL,
  `useful_lives` int(11) DEFAULT NULL,
  `salvage_value` int(11) DEFAULT NULL,
  `expenses_depn` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `warranty_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_group: 2 rows
/*!40000 ALTER TABLE `fa_asset_group` DISABLE KEYS */;
REPLACE INTO `fa_asset_group` (`id`, `name`, `at_cost`, `accum_depn`, `profit_on_sale`, `loss_on_sale`, `cash_bank`, `depn_method`, `useful_lives`, `salvage_value`, `expenses_depn`, `update_status`, `warranty_date`) VALUES
	('01', 'KOMPUTER', 1419, 1382, 1370, 1370, 0, 0, 12, 1000000, 1448, 0, '2016-03-12 00:00:00'),
	('02', 'GEDUNG', 1419, 1378, 1370, 1370, 0, 0, 120, 10000000, 1434, 0, '2015-11-28 00:00:00');
/*!40000 ALTER TABLE `fa_asset_group` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_service_log
CREATE TABLE IF NOT EXISTS `fa_asset_service_log` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `service_date` datetime DEFAULT NULL,
  `service_provider_id` double DEFAULT NULL,
  `service_contract` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `service_cost` double DEFAULT NULL,
  `notes` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `next_service_due` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `journal_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int DEFAULT NULL,
  `debit_account_id` double DEFAULT NULL,
  `credit_account_id` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_service_log: 0 rows
/*!40000 ALTER TABLE `fa_asset_service_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_asset_service_log` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_transaction
CREATE TABLE IF NOT EXISTS `fa_asset_transaction` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `trans_type` int(11) DEFAULT NULL,
  `trans_date` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `trade_in_allowance` double DEFAULT NULL,
  `trans_value` double DEFAULT NULL,
  `vendor_id` double DEFAULT NULL,
  `cash_bank_ap` int(11) DEFAULT NULL,
  `journal_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_transaction: 0 rows
/*!40000 ALTER TABLE `fa_asset_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_asset_transaction` ENABLE KEYS */;


-- Dumping structure for table simak.fa_cards
CREATE TABLE IF NOT EXISTS `fa_cards` (
  `id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `type` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street_add` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `postcode` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `account_no1` int(11) DEFAULT NULL,
  `account_no2` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_cards: 0 rows
/*!40000 ALTER TABLE `fa_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_cards` ENABLE KEYS */;


-- Dumping structure for table simak.fa_setting
CREATE TABLE IF NOT EXISTS `fa_setting` (
  `type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `enable` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_setting: 0 rows
/*!40000 ALTER TABLE `fa_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_setting` ENABLE KEYS */;


-- Dumping structure for table simak.fb_room
CREATE TABLE IF NOT EXISTS `fb_room` (
  `room_code` varchar(50) NOT NULL DEFAULT '',
  `room_name` varchar(50) DEFAULT NULL,
  `regular_hour` double DEFAULT NULL,
  `happy_hour` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `nota` varchar(50) DEFAULT NULL,
  `dept` varchar(50) DEFAULT NULL,
  `RType` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  `desciption` varchar(100) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`room_code`),
  KEY `room_code` (`room_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.fb_room: 3 rows
/*!40000 ALTER TABLE `fb_room` DISABLE KEYS */;
REPLACE INTO `fb_room` (`room_code`, `room_name`, `regular_hour`, `happy_hour`, `status`, `nota`, `dept`, `RType`, `capacity`, `desciption`, `update_status`) VALUES
	('Meja 1', 'Meja 1', 0, 0, 1, '', '', '', '', '', NULL),
	('Meja 2', 'Meja 2', 0, 0, 1, '', '', '', '', '', NULL),
	('Meja 3', 'Meja 3', 0, 0, 1, '', '', '', '', '', NULL);
/*!40000 ALTER TABLE `fb_room` ENABLE KEYS */;


-- Dumping structure for table simak.finance_charge_defaults
CREATE TABLE IF NOT EXISTS `finance_charge_defaults` (
  `minimum_days_past_due` int(11) DEFAULT NULL,
  `minimum_customer_balance` double DEFAULT NULL,
  `minimum_finance_charge` double DEFAULT NULL,
  `number_days_between_charges` int(11) DEFAULT NULL,
  `use_one_month_or_actual_days` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `annual_finance_charge_pct` double DEFAULT NULL,
  `daily_finance_charge_pct` double DEFAULT NULL,
  `include_fin_chg_in_past_due_amt` int DEFAULT NULL,
  `finance_charge_acct` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.finance_charge_defaults: 0 rows
/*!40000 ALTER TABLE `finance_charge_defaults` DISABLE KEYS */;
/*!40000 ALTER TABLE `finance_charge_defaults` ENABLE KEYS */;


-- Dumping structure for table simak.financial_periods
CREATE TABLE IF NOT EXISTS `financial_periods` (
  `year_id` int(11) DEFAULT NULL,
  `sequence` double DEFAULT NULL,
  `period` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `closed` tinyint(1) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.financial_periods: 24 rows
/*!40000 ALTER TABLE `financial_periods` DISABLE KEYS */;
REPLACE INTO `financial_periods` (`year_id`, `sequence`, `period`, `startdate`, `enddate`, `closed`, `update_status`, `id`, `month_name`) VALUES
	(2016, 1, '2016-01', '2016-01-01 00:00:00', '2016-01-31 23:59:59', 0, NULL, 13, 'Jan'),
	(2016, 2, '2016-02', '2016-02-01 00:00:00', '2016-02-29 23:59:59', 0, NULL, 14, 'Feb'),
	(2016, 3, '2016-03', '2016-03-01 00:00:00', '2016-03-31 23:59:59', 0, 0, 15, 'Mar'),
	(2016, 4, '2016-04', '2016-04-01 00:00:00', '2016-04-30 23:59:59', 0, NULL, 16, 'Apr'),
	(2016, 5, '2016-05', '2016-05-01 00:00:00', '2016-05-31 23:59:59', 0, NULL, 17, 'May'),
	(2016, 6, '2016-06', '2016-06-01 00:00:00', '2016-06-30 23:59:59', 0, NULL, 18, 'Jun'),
	(2016, 7, '2016-07', '2016-07-01 00:00:00', '2016-07-31 23:59:59', 0, NULL, 19, 'Jul'),
	(2016, 8, '2016-08', '2016-08-01 00:00:00', '2016-08-31 23:59:59', 0, NULL, 20, 'Aug'),
	(2016, 9, '2016-09', '2016-09-01 00:00:00', '2016-09-30 23:59:59', 0, NULL, 21, 'Sep'),
	(2016, 10, '2016-10', '2016-10-01 00:00:00', '2016-10-31 23:59:59', 0, NULL, 22, 'Oct'),
	(2016, 11, '2016-11', '2016-11-01 00:00:00', '2016-11-30 23:59:59', 0, NULL, 23, 'Nov'),
	(2016, 12, '2016-12', '2016-12-01 00:00:00', '2016-12-31 23:59:59', 0, NULL, 24, 'Dec');
/*!40000 ALTER TABLE `financial_periods` ENABLE KEYS */;


-- Dumping structure for table simak.gl_begbalarc_year
CREATE TABLE IF NOT EXISTS `gl_begbalarc_year` (
  `account_id` int(11) DEFAULT NULL,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `year` datetime DEFAULT NULL,
  `beginning_balance` double DEFAULT NULL,
  `debit_base` double DEFAULT NULL,
  `credit_base` double DEFAULT NULL,
  `ending_balance` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_begbalarc_year: 0 rows
/*!40000 ALTER TABLE `gl_begbalarc_year` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_begbalarc_year` ENABLE KEYS */;


-- Dumping structure for table simak.gl_beginning_balance_archive
CREATE TABLE IF NOT EXISTS `gl_beginning_balance_archive` (
  `account_id` int(11) DEFAULT NULL,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `year` datetime DEFAULT NULL,
  `beginning_balance` double DEFAULT NULL,
  `debit_base` double DEFAULT NULL,
  `credit_base` double DEFAULT NULL,
  `ending_balance` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_beginning_balance_archive: 0 rows
/*!40000 ALTER TABLE `gl_beginning_balance_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_beginning_balance_archive` ENABLE KEYS */;


-- Dumping structure for table simak.gl_projects
CREATE TABLE IF NOT EXISTS `gl_projects` (
  `kode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `budget_amount` double DEFAULT NULL,
  `project_amount` double DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `person_in_charge` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status_project` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category_project` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sales` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `expense` double DEFAULT NULL,
  `labarugi` double DEFAULT NULL,
  `finish_prc` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_projects: 2 rows
/*!40000 ALTER TABLE `gl_projects` DISABLE KEYS */;
REPLACE INTO `gl_projects` (`kode`, `keterangan`, `client`, `tgl_mulai`, `tgl_selesai`, `budget_amount`, `project_amount`, `lokasi`, `person_in_charge`, `id`, `date_created`, `last_update`, `updated_by`, `status_project`, `category_project`, `sales`, `cost`, `expense`, `labarugi`, `finish_prc`, `update_status`, `sourceautonumber`, `sourcefile`, `invoice_number`) VALUES
	('dfasf', 'dfasf', 'dfafd', '2015-06-12 23:09:18', '2015-06-12 23:09:18', 0, 0, '', 'dfasfasdfsaf', 3, NULL, NULL, NULL, 'OPEN', 'GEDUNG', 0, 0, 0, 0, 0, NULL, NULL, NULL, 0),
	('dfafasf', 'daf', 'dfafs', '2015-06-12 23:12:21', '2015-06-12 23:12:21', 0, 0, 'dfasf', 'dfasfd', 4, NULL, NULL, NULL, '', '', 0, 0, 0, 0, 0, NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `gl_projects` ENABLE KEYS */;


-- Dumping structure for table simak.gl_projects_budget
CREATE TABLE IF NOT EXISTS `gl_projects_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `bulan_1` double DEFAULT NULL,
  `bulan_2` double DEFAULT NULL,
  `bulan_3` double DEFAULT NULL,
  `bulan_4` double DEFAULT NULL,
  `bulan_5` double DEFAULT NULL,
  `bulan_6` double DEFAULT NULL,
  `bulan_7` double DEFAULT NULL,
  `bulan_8` double DEFAULT NULL,
  `bulan_9` double DEFAULT NULL,
  `bulan_10` double DEFAULT NULL,
  `bulan_11` double DEFAULT NULL,
  `bulan_12` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_projects_budget: 0 rows
/*!40000 ALTER TABLE `gl_projects_budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_projects_budget` ENABLE KEYS */;


-- Dumping structure for table simak.gl_projects_saldo
CREATE TABLE IF NOT EXISTS `gl_projects_saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=290 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_projects_saldo: 289 rows
/*!40000 ALTER TABLE `gl_projects_saldo` DISABLE KEYS */;
REPLACE INTO `gl_projects_saldo` (`id`, `project_code`, `start_date`, `account_id`, `amount`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'RSU', '2007-12-31 00:00:00', 1415, 0, NULL, NULL, NULL),
	(289, 'PJL00292.2129', '2013-12-31 00:00:00', 1484, 0, NULL, NULL, NULL);
/*!40000 ALTER TABLE `gl_projects_saldo` ENABLE KEYS */;


-- Dumping structure for table simak.gl_report_groups
CREATE TABLE IF NOT EXISTS `gl_report_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_type` double DEFAULT NULL,
  `group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `group_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `parent_group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`group_type`)
) ENGINE=MyISAM AUTO_INCREMENT=269 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_report_groups: 10 rows
/*!40000 ALTER TABLE `gl_report_groups` DISABLE KEYS */;
REPLACE INTO `gl_report_groups` (`id`, `company_code`, `account_type`, `group_type`, `group_name`, `parent_group_type`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(216, 'MYPOS', 1, '10000', 'Aktiva Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(219, 'MYPOS', 2, '20000', 'Hutang Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(223, 'MYPOS', 3, '33000', 'Modal', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(224, 'MYPOS', 4, '40000', 'Pendapatan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(225, 'MYPOS', 5, '50000', 'Harga Pokok Penjualan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(226, 'MYPOS', 6, '60000', 'Biaya', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(227, 'MYPOS', 7, '70000', 'Pendapatan Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(228, 'MYPOS', 8, '80000', 'Biaya Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(268, NULL, 1, '12000', 'Aktiva Tetap', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(267, NULL, 1, '11010', 'Kas Kecil', '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `gl_report_groups` ENABLE KEYS */;


-- Dumping structure for table simak.gl_transactions
CREATE TABLE IF NOT EXISTS `gl_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `gl_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `date_time_stamp` datetime DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `source` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `operation` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `custsuppbank` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `jurnaltype` int(11) DEFAULT NULL,
  `project_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `x1` (`gl_id`),
  KEY `x2` (`custsuppbank`),
  KEY `x3` (`operation`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_transactions: 2 rows
/*!40000 ALTER TABLE `gl_transactions` DISABLE KEYS */;
REPLACE INTO `gl_transactions` (`transaction_id`, `company_code`, `gl_id`, `date_time_stamp`, `account_id`, `date`, `debit`, `credit`, `source`, `operation`, `custsuppbank`, `jurnaltype`, `project_code`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `id_name`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(4, NULL, 'GL00006', NULL, 1450, '2016-03-12 00:00:00', 1000, 0, 'Beli Perangko', 'operasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, NULL, 'GL00006', NULL, 1370, '2016-03-12 00:00:00', 0, 1000, 'Beli Perangko', 'operasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `gl_transactions` ENABLE KEYS */;


-- Dumping structure for table simak.gl_transactions_archive
CREATE TABLE IF NOT EXISTS `gl_transactions_archive` (
  `transaction_id` int(11) DEFAULT NULL,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `gl_id` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `date_time_stamp` datetime DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `source` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `operation` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_transactions_archive: 0 rows
/*!40000 ALTER TABLE `gl_transactions_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_transactions_archive` ENABLE KEYS */;


-- Dumping structure for table simak.hr_emp_default_com
CREATE TABLE IF NOT EXISTS `hr_emp_default_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) CHARACTER SET utf8 NOT NULL,
  `def_com_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `def_com_value` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_emp_default_com: 0 rows
/*!40000 ALTER TABLE `hr_emp_default_com` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_emp_default_com` ENABLE KEYS */;


-- Dumping structure for table simak.hr_emp_level_com
CREATE TABLE IF NOT EXISTS `hr_emp_level_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `no_urut` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `formula_string` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `take_home_pay` int(11) DEFAULT NULL,
  `salary_com_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `salary_com_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_emp_level_com: 6 rows
/*!40000 ALTER TABLE `hr_emp_level_com` DISABLE KEYS */;
REPLACE INTO `hr_emp_level_com` (`id`, `level_code`, `no_urut`, `formula_string`, `take_home_pay`, `salary_com_code`, `salary_com_name`) VALUES
	(3, 'GAJI1', '1', 'dfadfdasfasdfd', NULL, 'GAPOK', NULL),
	(4, 'GAJI1', '1', 'SDSDAd', NULL, 'MAKAN', NULL),
	(10, 'GAJI1', '1', 'SDSDAd', NULL, 'TOKO', NULL),
	(11, 'GAJI2', '1', '', NULL, 'GAPOK', NULL),
	(12, 'GAJI2', '2', '', NULL, 'MAKAN', NULL),
	(13, 'GAJI2', '3', '', NULL, 'TOKO', NULL);
/*!40000 ALTER TABLE `hr_emp_level_com` ENABLE KEYS */;


-- Dumping structure for table simak.hr_emp_loan
CREATE TABLE IF NOT EXISTS `hr_emp_loan` (
  `loan_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `loan_type` int(11) NOT NULL,
  `date_loan` datetime DEFAULT NULL,
  `loan_amount` double DEFAULT NULL,
  `loan_balance` double DEFAULT NULL,
  `angsuran` double DEFAULT NULL,
  `loan_count` int(11) DEFAULT NULL,
  `loan_last_to` int(11) DEFAULT NULL,
  `loan_last_date` datetime DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `pay_method` int(11) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokok` double NOT NULL DEFAULT '0',
  `bunga` double NOT NULL DEFAULT '0',
  `rate_method` int(11) NOT NULL DEFAULT '0',
  `rate_percent` float NOT NULL DEFAULT '0',
  `comments` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_emp_loan: 4 rows
/*!40000 ALTER TABLE `hr_emp_loan` DISABLE KEYS */;
REPLACE INTO `hr_emp_loan` (`loan_number`, `loan_type`, `date_loan`, `loan_amount`, `loan_balance`, `angsuran`, `loan_count`, `loan_last_to`, `loan_last_date`, `approved_by`, `pay_method`, `nip`, `id`, `pokok`, `bunga`, `rate_method`, `rate_percent`, `comments`) VALUES
	('LN00001', 0, '2014-06-04 17:22:00', 1000000, 0, 0, 12, 0, '2014-06-04 07:00:00', '', 0, '121', 1, 100000, 10000, 0, 10, ''),
	('LN00003', 0, '2014-06-04 17:22:00', 1000000, 0, 0, 12, 0, '2014-06-04 07:00:00', '', 0, '121', 3, 100000, 10000, 0, 10, ''),
	('LN00002', 0, '2015-01-13 20:07:29', 1000000, 0, 0, 12, 0, '2015-01-13 20:07:30', '', 0, 'ANDRI', 4, 83333.333333333, 0, 0, 0, ''),
	('LN00004', 0, '2015-01-13 20:07:29', 1000000, 0, 0, 12, 0, '2015-01-13 20:07:30', '', 0, 'ANDRI', 5, 83333.333333333, 0, 0, 10, '');
/*!40000 ALTER TABLE `hr_emp_loan` ENABLE KEYS */;


-- Dumping structure for table simak.hr_pph
CREATE TABLE IF NOT EXISTS `hr_pph` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `percent_value` double DEFAULT NULL,
  `low_value` double DEFAULT NULL,
  `high_value` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_pph: 0 rows
/*!40000 ALTER TABLE `hr_pph` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_pph` ENABLE KEYS */;



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
  PRIMARY KEY (`item_number`),
  KEY `x1` (`description`),
  KEY `x2` (`category`),
  KEY `x3` (`class`),
  KEY `x4` (`manufacturer`),
  KEY `x5` (`model`),
  KEY `x6` (`supplier_number`)
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
  PRIMARY KEY (`kode`),
  KEY `x1` (`category`)
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
  UNIQUE KEY `x1` (`transfer_id`,`item_number`,`date_trans`,`from_location`,`to_location`),
  KEY `x2` (`transfer_id`),
  KEY `x3` (`trans_type`)
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
  UNIQUE KEY `x1` (`item_number`,`customer_pricing_code`),
  KEY `x2` (`item_number`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`item_no`)
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
  KEY `x1` (`item_number`,`shipment_id`),
  KEY `x2` (`shipment_id`),
  KEY `x3` (`receipt_type`),
  KEY `x4` (`warehouse_code`),
  KEY `x6` (`purchase_order_number`),
  KEY `x7` (`purchase_order_number`,`from_line_number`),
  KEY `x5` (`date_received`)
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
  UNIQUE KEY `x1` (`item_number`,`warehouse_code`),
  KEY `x2` (`item_number`),
  KEY `x3` (`warehouse_code`)
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
  PRIMARY KEY (`invoice_number`),
  KEY `x1` (`invoice_date`),
  KEY `x2` (`sold_to_customer`),
  KEY `x3` (`invoice_type`),
  KEY `x4` (`type_of_invoice`)
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
  PRIMARY KEY (`line_number`),
  KEY `x1` (`invoice_number`),
  KEY `x2` (`warehouse_code`),
  KEY `x3` (`item_number`),
  KEY `x4` (`line_order_type`),
  KEY `x5` (`employee_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`invoice_number`)
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
  PRIMARY KEY (`kode`),
  KEY `x1` (`keterangan`)
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
  PRIMARY KEY (`kode`),
  KEY `x1` (`keterangan`)
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
  PRIMARY KEY (`kode`),
  KEY `x1` (`nomor_plat`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`app_id`),
  KEY `x1` (`app_date`),
  KEY `x2` (`cust_id`),
  KEY `x3` (`counter_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`),
  KEY `x2` (`obj_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_id`)
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
  UNIQUE KEY `x_cust_id` (`cust_id`),
  KEY `x1` (`cust_name`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`cust_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`cust_id`)
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
  PRIMARY KEY (`invoice_number`),
  KEY `x1` (`loan_id`),
  KEY `x2` (`app_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`invoice_number`),
  KEY `x2` (`date_paid`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`loan_id`),
  KEY `x2` (`loan_date`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`obj_item_id`),
  KEY `x2` (`loan_id`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`mat_rel_no`),
  KEY `x2` (`item_number`)
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
  PRIMARY KEY (`mat_rel_no`),
  KEY `x1` (`date_rel`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_name`),
  KEY `x2` (`app_type`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`rcp_to`),
  KEY `x2` (`msg_date`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`app_title`),
  KEY `x2` (`app_type`)
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
	('6', '6', 'themes', 'free', '', NULL, 0, 0, '6', NULL, 27, '', '', '', '', '', '', '', '');
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
  PRIMARY KEY (`module_id`),
  KEY `x1` (`module_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.modules: 606 rows
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
 
INSERT INTO `modules` VALUES ('frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', 'Form', 'frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', '_30010', '0', null, null, null);
INSERT INTO `modules` VALUES ('frmMain.Addnew', 'frmMain.Addnew', 'Form', 'frmMain.Addnew', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('frmRptCriteria', 'frmRptCriteria', 'Form', 'frmRptCriteria', 'Please entry this', '_90000', '0', null, null, null);
INSERT INTO `modules` VALUES ('ID_ExportImport', 'ID_ExportImport', 'Form', 'ID_ExportImport', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('ID_ItemPrices', 'Item Prices', 'Form', 'ID_ItemPrices', '', 'ID_ItemPrices', '0', '0', '', '');
INSERT INTO `modules` VALUES ('ID_JasaKiriman', 'ID_JasaKiriman', 'Form', 'ID_JasaKiriman', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\BANKCEK2.RPT', '004. Cek keluar - Status Belum Cair / Gantung', 'Form', '\\CEK\\BANKCEK2.RPT', '004. Cek Keluar - Status Belum Cair', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\BANKCEKGL.RPT', '011. Laporan Cek Keluar (Dengan Kode Perkiraan)', 'Form', '\\CEK\\BANKCEKGL.RPT', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\BANKCEKM2.RPT', '005. Cek Masuk - Status Belum Cair / Gantung', 'Form', '\\CEK\\BANKCEKM2.RPT', 'A005. Cek Masuk - Status Belum Cair', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\cek\\BANKCODE.rpt', '001. Daftar Bank', 'Form', '\\cek\\BANKCODE.rpt', 'A004. Cek Keluar - Status Cair', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Cek\\BankMutasiBank.rpt', '012. Laporan Mutasi Transaksi Bank', 'Form', '\\Cek\\BankMutasiBank.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\ChInSum.Rpt', '006. Daftar Penerimaan Cek/Giro', 'Form', '\\CEK\\ChInSum.Rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\ChOutSum.Rpt', '007. Daftar Pengeluran Cek/Giro', 'Form', '\\CEK\\ChOutSum.Rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\KasInSum.Rpt', '002. Daftar Penerimaan Kas', 'Form', '\\CEK\\KasInSum.Rpt', 'Daftar Penerimaan Kas', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\KasOutSum.Rpt', '003. Daftar Pengeluran Kas', 'Form', '\\CEK\\KasOutSum.Rpt', 'Daftar Pengeluaran Kas', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Cek\\MutasiKas_Saldo.rpt', '008. Laporan Mutasi Kas/Bank', 'Form', '\\Cek\\MutasiKas_Saldo.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\transfer_in.rpt', '009. Daftar Penerimaan transfer', 'Form', '\\CEK\\transfer_in.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\CEK\\transfer_out.rpt', '010. Daftar Pengeluaran transfer', 'Form', '\\CEK\\transfer_out.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\gl\\balancesheet2.rpt', '009. Laporan Neraca', 'Form', '\\gl\\balancesheet2.rpt', '009. Laporan Neraca', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\gl\\neracaT.rpt', 'Laporan Neraca T-Form', 'Form', '\\gl\\neracaT.rpt', 'Laporan Neraca T-Form', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\gl\\RLCompare.rpt', 'Laporan Rugi Laba Comparison', 'Form', '\\gl\\RLCompare.rpt', 'Laporan Rugi Laba Comparison', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\AsmItem.Rpt', 'Laporan Assembly item', 'Form', '\\Inv\\AsmItem.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\AsmItem17.Rpt', '022. Laporan Assembly item - Summary', 'Form', '\\Inv\\AsmItem17.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\DaftarBarang.Rpt', 'Laporan Daftar  Barang', 'Form', '\\Inv\\DaftarBarang.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\FisikInventory.rpt', 'Laporan Fisik Inventory', 'Form', '\\Inv\\FisikInventory.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\HargaBeli.Rpt', 'Laporan Daftar Harga Beli', 'Form', '\\Inv\\HargaBeli.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\HargaJual.Rpt', 'Laporan Daftar Harga Jual', 'Form', '\\Inv\\HargaJual.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\InventoryMoving.rpt', 'Laporan Keluar Masuk Barang', 'Form', '\\Inv\\InventoryMoving.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\InvPriceHistory.rpt', 'Laporan History Harga', 'Form', '\\Inv\\InvPriceHistory.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\InvTranCategory.Rpt', '023. Inventory Transaction by Category', 'Form', '\\Inv\\InvTranCategory.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\InvTranItem.Rpt', '024. Inventory Transaction by Item Number', 'Form', '\\Inv\\InvTranItem.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\inv\\invvalue.rpt', 'Laporan Nilai Persediaan Inventory', 'Form', '\\inv\\invvalue.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\inv\\KeluarReturPembelian.rpt', 'Pengeluaran Barang Retur Pembelian', 'Form', '\\inv\\KeluarReturPembelian.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\MutasiGudang.rpt', 'Mutasi Per Barang Per Gudang', 'Form', '\\Inv\\MutasiGudang.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\StokMgmtLow.rpt', 'Stock Mgmt - Inventory Low Stock', 'Form', '\\Inv\\StokMgmtLow.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\StokMgMtOnBOrder.rpt', 'Stock MgMt - Inventory on Back Order', 'Form', '\\Inv\\StokMgMtOnBOrder.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\StokMgMtOut.rpt', 'Stock MgMt - Inventory Out Of Stock', 'Form', '\\Inv\\StokMgMtOut.rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Inv\\StokMgMtRecon.Rpt', 'Stock MgMt - Inventory Reconsiliation', 'Form', '\\Inv\\StokMgMtRecon.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\DaftarHutang.rpt', 'A0041. Hutang Supplier dan Pembayaran', 'Form', '\\Po\\DaftarHutang.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\po\\DaftarSupplier.rpt', 'A002. Daftar Supplier Urut Nama', 'Form', '\\po\\DaftarSupplier.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\po\\DaftarSupplierUtama.rpt', 'Daftar Hutang per Supplier', 'Form', '\\po\\DaftarSupplierUtama.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\HistoryHargaItemSupplier.rpt', '020. History Harga Item Per Supplier', 'Form', '\\Po\\HistoryHargaItemSupplier.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\Keluar.rpt', 'Laporan Pengeluaran Barang', 'Form', '\\PO\\Keluar.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\KeluarPerPO.rpt', 'Laporan Pengeluaran Barang/Retur - Per PO', 'Form', '\\PO\\KeluarPerPO.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\OpenPO.rpt', 'Open Purchase Order by PO Number', 'Form', '\\PO\\OpenPO.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\OrderPembelian.rpt', 'Order Pembelian / PO', 'Form', '\\Po\\OrderPembelian.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\OrderPembelianItemSupplierDetail.rpt', 'A008. Pembelian  per Item, Supplier - Detail ', 'Form', '\\Po\\OrderPembelianItemSupplierDetail.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\PayAnaSupplier.Rpt', 'A016. Total Pembayaran per Supplier - Detail', 'Form', '\\PO\\PayAnaSupplier.Rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\PayDetailDaily.Rpt', 'A014. Total Pembayaran Harian', 'Form', '\\PO\\PayDetailDaily.Rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\PayDetailMonthly.Rpt', 'A015. Total Pembayaran Bulanan', 'Form', '\\PO\\PayDetailMonthly.Rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\PODaily.rpt', 'A009. Total Faktur Pembelian dibuat - Harian - Summary', 'Form', '\\PO\\PODaily.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\PODetailDaily.rpt', 'A010. Total Faktur Pembelian dibuat - Harian - Detail', 'Form', '\\PO\\PODetailDaily.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\POItemNoRecvItem.rpt', 'Purchase Order Items Not Received- by Item', 'Form', '\\PO\\POItemNoRecvItem.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\POItemNoRecvSupplier.rpt', 'Purchase Order Items Not Received- by Supplier', 'Form', '\\PO\\POItemNoRecvSupplier.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\POItemOverItem.rpt', 'Purchase Order Items Overdue - by Item', 'Form', '\\PO\\POItemOverItem.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\POItemOverSupplier.rpt', 'Purchase Order Items Overdue - by Supplier', 'Form', '\\PO\\POItemOverSupplier.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\POMonthly.rpt', 'A011. Total Faktur Pembelian dibuat - Bulanan - Summary', 'Form', '\\PO\\POMonthly.rpt', 'Please entry this', '_90070', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\SaldoHutang.rpt', 'A005. Daftar Saldo Hutang Supplier', 'Form', '\\Po\\SaldoHutang.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\po\\SelisihKursHutang1.Rpt', '015. Selisih Kurs Pembelian', 'Form', '\\po\\SelisihKursHutang1.Rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\po\\sisa_hutang.rpt', '011. Daftar Sisa Hutang - Per Invoice', 'Form', '\\po\\sisa_hutang.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\po\\sisa_hutang_bulan.rpt', '012. Daftar Sisa Hutang - Per Bulan', 'Form', '\\po\\sisa_hutang_bulan.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\po\\supplierEnvelop.rpt', 'Supplier Envelope', 'Form', '\\po\\supplierEnvelop.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\SupplierLstFinancial.rpt', 'Supplier Financial Listing', 'Form', '\\Po\\SupplierLstFinancial.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\SupplierLstNumber.Rpt', 'Supplier List by Supplier Number', 'Form', '\\Po\\SupplierLstNumber.Rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\Po\\SupplierPayables.rpt', 'Supplier Total Period Payables', 'Form', '\\Po\\SupplierPayables.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\Terima.Rpt', '021. Penerimaan Barang - Detail', 'Form', '\\PO\\Terima.Rpt', 'Please entry this', '_90040', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\PO\\TotalPayableSupplier.rpt', 'Total Period Payable Paid by Supplier', 'Form', '\\PO\\TotalPayableSupplier.rpt', 'Please entry this', '_90120', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', 'A003. Penjualan per Customer - Summary', 'Form', '\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', 'A012. Penjualan per Jenis Pembayaran - Detail', 'Form', '\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', 'A011. Penjualan per Jenis Pembayaran - Summary', 'Form', '\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', 'Laporan analisa penjualan per kategory customer', 'Form', '\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', 'Laporan analisa penjualan per salesman - perbulan', 'Form', '\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', 'Laporan analisa penjualan per source of order - perbulan', 'Form', '\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\AnalisaPenjualanPerWilayah.rpt', 'Laporan analisa penjualan per wilayah', 'Form', '\\So\\AnalisaPenjualanPerWilayah.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\CustCredit.rpt', 'Customer on Credit Hold', 'Form', '\\so\\CustCredit.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\CustCreditAll.rpt', 'Customer on Credit Hold - Columns Style', 'Form', '\\so\\CustCreditAll.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\CustHighest.Rpt', 'Customer Sales by Highest Total', 'Form', '\\So\\CustHighest.Rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\CustListCompany.rpt', 'Customer Listing by Company', 'Form', '\\so\\CustListCompany.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\CustListCustomer.rpt', 'Customer Listing by Customer Number', 'Form', '\\so\\CustListCustomer.rpt', 'Please entry this', '_90010', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\customerEnvelop.rpt', 'Customer Envelope/Label', 'Form', '\\so\\customerEnvelop.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\CustPayHistory2.rpt', 'A0061. Piutang Customer dan Pembayaran', 'Form', '\\so\\CustPayHistory2.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\CustPayHistoryByCust.rpt', 'A003. Daftar pembayaran piutang - group by customer', 'Form', '\\So\\CustPayHistoryByCust.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\CustSalesHistory.rpt', 'Customer Sales History', 'Form', '\\So\\CustSalesHistory.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\CustSalesHistoryLast.rpt', 'Customer Sales History - Last Order', 'Form', '\\So\\CustSalesHistoryLast.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\daftarcustomer.rpt', 'A001. Daftar Customer urut Nama', 'Form', '\\so\\daftarcustomer.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\DaftarPiutang.rpt', 'A006. Piutang Customer dan Pembayaran', 'Form', '\\so\\DaftarPiutang.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\DaftarTagihan.rpt', 'Daftar Tagihan dan Pembayaran', 'Form', '\\So\\DaftarTagihan.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\DODetail100.Rpt', 'Laporan Pengiriman Barang / DO', 'Form', '\\So\\DODetail100.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPelunasanPiutang.Rpt', 'A009. Pelunasan Piutang - per Invoice (All)', 'Form', '\\So\\FakturPelunasanPiutang.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanDetailTanggal.Rpt', 'A2.Faktur Penjualan - Summary', 'Form', '\\So\\FakturPenjualanDetailTanggal.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanDetailtem.Rpt', 'A006. Penjualan per Item - Detail', 'Form', '\\So\\FakturPenjualanDetailtem.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanSummary.Rpt', 'Faktur Penjualan - Summary - Jenis Pembayaran', 'Form', '\\So\\FakturPenjualanSummary.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanSummaryBayar.Rpt', 'Faktur Penjualan - Summary - Per Status Pembayaran', 'Form', '\\So\\FakturPenjualanSummaryBayar.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanSummaryItemCust.Rpt', 'A012. Penjualan per Customer per Item - Detail', 'Form', '\\So\\FakturPenjualanSummaryItemCust.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanSummarySupplier.Rpt', 'Faktur Penjualan - Summary - Per Supplier', 'Form', '\\So\\FakturPenjualanSummarySupplier.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanSummaryTanggal.Rpt', 'Faktur Penjualan - Summary -  per tanggal', 'Form', '\\So\\FakturPenjualanSummaryTanggal.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FakturPenjualanSummaryWilayah.Rpt', 'Faktur Penjualan - Summary - Per Wilayah', 'Form', '\\So\\FakturPenjualanSummaryWilayah.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FB_RoomResv.rpt', 'F&B Room Reservation - Daily', 'Form', '\\So\\FB_RoomResv.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FB_RoomResv2.rpt', 'F&B Room Reservation - Daily - By Waiter', 'Form', '\\So\\FB_RoomResv2.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FB_RoomResv3.rpt', 'F&B Room Reservation - Daily - By Room', 'Form', '\\So\\FB_RoomResv3.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FB_RoomResvSumDay.rpt', 'F&B Room Reservation Summary - Daily', 'Form', '\\So\\FB_RoomResvSumDay.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\FB_TableResv.rpt', 'F&B Table Reservation - Daily', 'Form', '\\So\\FB_TableResv.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\HargaHistoryMonthly.rpt', 'Laporan History Harga Monthly', 'Form', '\\SO\\HargaHistoryMonthly.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\HistoryHargaItemCustomer.rpt', '019. History Harga Item Per Customer', 'Form', '\\So\\HistoryHargaItemCustomer.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\InvoiceAllTypePerCustomer.rpt', 'Invoice - All Type - per Customers', 'Form', '\\So\\InvoiceAllTypePerCustomer.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\InvoicePerTypePerCustomer.rpt', 'Invoice - InvoiceType - per Customers', 'Form', '\\So\\InvoicePerTypePerCustomer.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\Jual100.Rpt', 'Laporan Penjualan Detail', 'Form', '\\So\\Jual100.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\JualCustSum.Rpt', 'Penjualan per Customer', 'Form', '\\so\\JualCustSum.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\JualKasirDateTime.Rpt', 'Laporan penjualan kasir with Date, Time', 'Form', '\\SO\\JualKasirDateTime.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\JualKonsinyasiTglMonthly.Rpt', 'Laporan Penjualan Konsinyasi Bulanan', 'Form', '\\SO\\JualKonsinyasiTglMonthly.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\JualReturTglMonthly.Rpt', 'Laporan Retur Penjualan Bulanan', 'Form', '\\SO\\JualReturTglMonthly.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\JualTglMonthly.Rpt', 'Laporan Penjualan Bulanan', 'Form', '\\SO\\JualTglMonthly.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\JualTglMonthlyDept.Rpt', 'Laporan Penjualan per Department', 'Form', '\\SO\\JualTglMonthlyDept.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\JualTglMonthlySales.Rpt', 'Laporan Penjualan Bulanan per Salesman', 'Form', '\\SO\\JualTglMonthlySales.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\KomisiSalesmanMonthly.rpt', 'Laporan Komisi Salesman - per Bulan', 'Form', '\\So\\KomisiSalesmanMonthly.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\KomisiSalesmanSummary.rpt', 'Laporan Komisi Salesman - Total Periode', 'Form', '\\So\\KomisiSalesmanSummary.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\KreditMemoSummary.rpt', 'Kredit Memo Summary', 'Form', '\\So\\KreditMemoSummary.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\MutasiStock.Rpt', 'Laporan Mutasi Stock Bulanan', 'Form', '\\SO\\MutasiStock.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\MutasiStockPrice.Rpt', 'Laporan Mutasi Stock, Price Bulanan ', 'Form', '\\SO\\MutasiStockPrice.Rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\PenjualanCustomer.rpt', 'Penjualan per Customer - Detail', 'Form', '\\So\\PenjualanCustomer.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\PenjualanCustomerDetail.rpt', 'A002. Penjualan per Customer - Detail', 'Form', '\\So\\PenjualanCustomerDetail.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\PenjualanPerbulanDetail.rpt', 'A002. Penjualan perbulan - Detail', 'Form', '\\So\\PenjualanPerbulanDetail.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\So\\SaldoPiutang.rpt', 'A007. Daftar Saldo Piutang Customer', 'Form', '\\So\\SaldoPiutang.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\SalesKomisi.exe', 'Query Komisi Salesman', 'Form', '\\SO\\SalesKomisi.exe', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\SalesOrder.rpt', 'Sales Order Summary', 'Form', '\\SO\\SalesOrder.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\SalesOrderDetail.rpt', 'Sales Order Detail', 'Form', '\\so\\SalesOrderDetail.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\salesorder_do.rpt', 'Sales Order - Delivery Order - Summary', 'Form', '\\so\\salesorder_do.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\salesorder_do_item.rpt', 'Sales Order - Delivery Order - Item - Detail', 'Form', '\\so\\salesorder_do_item.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\sisa_piutang.rpt', '011. Daftar Sisa Piutang - Per Invoice', 'Form', '\\so\\sisa_piutang.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\so\\sisa_piutang_bulan.rpt', '012. Daftar Sisa Piutang - Per Bulan', 'Form', '\\so\\sisa_piutang_bulan.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\SOOpenItem.rpt', 'Open Sales Order - by Item', 'Form', '\\SO\\SOOpenItem.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('\\SO\\SOOpenTanggal.rpt', 'Open Sales Order - by Tanggal', 'Form', '\\SO\\SOOpenTanggal.rpt', 'Please entry this', '_90090', '0', null, null, null);
INSERT INTO `modules` VALUES ('_00000', 'Setting', 'Form', '_00000', 'Setup data perusahaan atau aturan-aturan umum lainnya.', '0', '0', '7', '', '');
INSERT INTO `modules` VALUES ('_00010', 'Job Responsibility', 'Form', 'jobs', 'Job Responsibility', '_00000', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_00011', 'Create', 'Form', '_00011', '.', '_00010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00012', 'Edit', 'Form', '_00012', '.', '_00010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00013', 'Delete', 'Form', '_00013', '.', '_00010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00020', 'User Access', 'Form', 'user', 'User Access', '_00000', '1', '2', '', null);
INSERT INTO `modules` VALUES ('_00021', 'Create', 'Form', '_00021', '.', '_00020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00022', 'Edit', 'Form', '_00022', '.', '_00020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00023', 'Delete', 'Form', '_00023', '.', '_00020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00030', 'Global Setting', 'Form', 'seting', 'Global Setting', '_00000', '1', '1', '', null);
INSERT INTO `modules` VALUES ('_00031', 'Save', 'Form', '_00031', '.', '_00030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00032', 'Remove All Database', 'Form', '_00032', 'Remove All Database', '_00030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00040', 'Report List System', 'Form', 'report_list', 'Report List System', '_00000', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_00041', 'Add', 'Form', 'frmReportList.cmdAdd', '.', '_00040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00042', 'Edit', 'Form', 'frmReportList.cmdEdit', '.', '_00040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00043', 'Delete', 'Form', 'frmReportList.cmdDelete', '.', '_00040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_00050', 'List Modules System', 'Form', 'modules', 'List Modules System', '_00000', '1', '5', '', null);
INSERT INTO `modules` VALUES ('_10000', 'General Ledger', 'Form', '_10000', 'Modul General Ledger atau Akuntansi.', '0', '0', '0', '', '');
INSERT INTO `modules` VALUES ('_10010', 'Perkiraan (COA)', 'Form', '_10010', '.', '_10000', '1', null, '', null);
INSERT INTO `modules` VALUES ('_10011', 'Create', 'Form', '_10011', '.', '_10010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10012', 'Edit', 'Form', '_10012', '.', '_10010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10013', 'Delete', 'Form', '_10013', '.', '_10010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10015', 'Create New COA Group', 'Form', '_10015', 'Create New COA Group', '_10010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10016', 'Remove COA Group', 'Form', '_10016', 'Remove COA Group', '_10010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10020', 'Budgeting ', 'Form', 'budget', 'Budgeting Cost', '_10000', '1', '5', '', null);
INSERT INTO `modules` VALUES ('_10021', 'Save', 'Form', '_10021', '.', '_10020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10030', 'Periode Akuntansi', 'Form', 'periode', 'Periode Akuntansi', '_10000', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_10031', 'Save', 'Form', '_10031', '.', '_10030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10032', 'Copy To New Periode', 'Form', '_10032', '.', '_10030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10035', 'Closing Periode', 'Form', '_10035', '.', '_10030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10036', 'Re-Opening Periode', 'Form', '_10036', '.', '_10030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10060', 'Jurnal Entry', 'Form', 'jurnal', 'Jurnal Umum', '_10000', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_10060A', '_10060A', 'Form', '_10060A', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_10061', 'Create', 'Form', '_10061', '.', '_10060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10062', 'Edit', 'Form', '_10062', '.', '_10060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10063', 'Delete', 'Form', '_10063', '.', '_10060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10064', 'Jenis Perkiraan / COA', 'Form', 'coa', 'Jenis Perkiraan / COA', '_10000', '1', '1', '', null);
INSERT INTO `modules` VALUES ('_10065', 'Kelompok Perkiraan', 'Form', 'coa_group', 'Kelompok Perkiraan', '_10000', '1', '2', '', null);
INSERT INTO `modules` VALUES ('_10066', 'View Arsip Saldo Perkiraan', 'Form', 'gl_arsip', 'View Arsip Saldo Perkiraan', '_10000', '1', '6', '', null);
INSERT INTO `modules` VALUES ('_10067', 'Setting Autonumber Jurnal Entry', 'Form', '_10067', 'Setting Autonumber Jurnal Entry', '_10000', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10068', 'Setting Hotkey Jurnal Entry', 'Form', '_10068', 'Setting Hotkey Jurnal Entry', '_10000', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10069', 'Neraca Design Report', 'Form', '_10069', 'Neraca Design Report', '_10000', '1', null, null, null);
INSERT INTO `modules` VALUES ('_10070', 'Rugi Laba Design Report', 'Form', '_10070', 'Rugi Laba Design Report', '_10000', '1', null, null, null);
INSERT INTO `modules` VALUES ('_11000', '_11000', 'Form', '_11000', 'Manufacture dan pabrikasi module', '_00000', '0', '0', '', '');
INSERT INTO `modules` VALUES ('_12000', 'Payroll and HRD', 'Form', '_12000', 'Payroll and Human Resource Development', '0', '0', '0', '', '');
INSERT INTO `modules` VALUES ('_13000', '_13000', 'Form', '_13000', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000', 'Penjualan', 'Form', '_30000', 'Modul Penjualan, A/R, Pelanggan dan Pembayaran.', '0', '1', '1', '', null);
INSERT INTO `modules` VALUES ('_30000.0', 'Point Of Sales - MyPOS', 'Form', '_30000', 'Point Of Sales - MyPOS', '_30000', '0', null, '', null);
INSERT INTO `modules` VALUES ('_30000.001', 'Buat nota baru', 'Form', '_30000.001', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.002', 'Void atau pembatalan nota', 'Form', '_30000.002', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.003', 'Input discount nota', 'Form', '_30000.003', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.004', 'Input PPN nota', 'Form', '_30000.004', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.005', 'Input service charge', 'Form', '_30000.005', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.006', 'Laporan penjualan harian kasir', 'Form', '_30000.006', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.007', 'Input penerimaan barang ', 'Form', '_30000.007', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.008', 'Lihat daftar penerimaan barang', 'Form', '_30000.008', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.009', 'Input pengeluran barang ', 'Form', '_30000.009', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.010', 'Lihat daftar penerimaan barang', 'Form', '_30000.010', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.011', 'Cetak label / barcode barang  ', 'Form', '_30000.011', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.012', 'Buka cash drawer  ', 'Form', '_30000.012', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.013', 'Input master barang dan kelompok  ', 'Form', '_30000.013', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.014', 'Input master pelanggan', 'Form', '_30000.014', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.015', 'Input master waiter ', 'Form', '_30000.015', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.016', 'Input master table / meja / room  ', 'Form', '_30000.016', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.017', 'Input master salesman ', 'Form', '_30000.017', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.018', 'Input price manager ', 'Form', '_30000.018', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.019', 'Input barang promosi  ', 'Form', '_30000.019', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.020', 'Backup database', 'Form', '_30000.020', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.021', 'Seting nota dan perangkat keras', 'Form', '_30000.021', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.022', 'Seting pemakai dan user level ', 'Form', '_30000.022', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.023', 'Hapus semua data transaksi penjualan  ', 'Form', '_30000.023', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.024', 'Hapus semua data master barang', 'Form', '_30000.024', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.025', 'Export / Import data barang ', 'Form', '_30000.025', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.026', 'Reset nomor nota  ', 'Form', '_30000.026', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.027', 'Seting nomor nota ', 'Form', '_30000.027', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.028', 'Input kas awal, pengambilan kas ', 'Form', '_30000.028', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.029', 'Laporan: penjualan per nota ', 'Form', '_30000.029', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.030', 'Laporan: penjualan per kasir  ', 'Form', '_30000.030', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.031', 'Laporan: penjualan per item ', 'Form', '_30000.031', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.032', 'Laporan: penjualan per kategory ', 'Form', '_30000.032', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.033', 'Laporan: penjualan per waiter ', 'Form', '_30000.033', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.034', 'Laporan: penjualan per customer ', 'Form', '_30000.034', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.035', 'Laporan: Daftar nota  ', 'Form', '_30000.035', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.036', 'Laporan: Daftar pembayaran', 'Form', '_30000.036', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.037', 'Laporan: Kartu stock  ', 'Form', '_30000.037', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.038', 'Laporan: Item Paling laku ', 'Form', '_30000.038', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.039', 'Laporan: Item paling tidak laku ', 'Form', '_30000.039', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.040', 'Laporan: Rugi / laba penjualan', 'Form', '_30000.040', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.041', 'Laporan: Daftar barang', 'Form', '_30000.041', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.050', 'Penyesuaian Stock (Adjustment)', 'Form', '_30000.050', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.051', 'Proses Produksi Jadi (Assembly)', 'Form', '_30000.051', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.052', 'Laporan Proses Produksi Jadi (Assembly)', 'Form', '_30000.052', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.053', 'Laporan Penyesuaian Stock (Adjustment)', 'Form', '_30000.053', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.054', 'Daftar piutang customer', 'Form', '_30000.054', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.055', 'Formulir Stock Opname', 'Form', '_30000.055', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.056', 'Proses retur barang', 'Form', '_30000.056', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.057', 'Proses import master barang file MDB', 'Form', '_30000.057', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.058', 'Laporan penjualan item minus', 'Form', '_30000.058', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.059', 'Laporan kartu stock', 'Form', '_30000.059', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.060', 'Input discount bertingkat', 'Form', '_30000.060', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.061', 'Input ppn percent', 'Form', '_30000.061', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.062', 'Input discount percent nota', 'Form', '_30000.062', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.063', 'Daftar user level/job', 'Form', '_30000.063', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.064', 'Export master barang to excel', 'Form', '_30000.064', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.065', 'Import master barang dari excel', 'Form', '_30000.065', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.066', 'Daftar Kategori Barang', 'Form', '_30000.066', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.067', 'Laporan Penjualan per Customer, Item', 'Form', '_30000.067', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.068', 'Laporan Penjualan per Nota, Pembayaran', 'Form', '_30000.068', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30000.100', 'Proses Pelunasan ONACCOUNT', 'Form', '_30000.100', '.', '_30000.0', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30010', 'Master Data Customer', 'Form', 'customer/browse', '.', '_30000', '1', '1', '', 'customer');
INSERT INTO `modules` VALUES ('_30011', 'Create', 'Form', '_30011', '.', '_30010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30012', 'Edit', 'Form', '_30012', '.', '_30010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30013', 'Delete', 'Form', '_30013', '.', '_30010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30020', 'Master Salesman', 'Form', 'salesman', '.', '_30000', '1', '2', '', 'salesman');
INSERT INTO `modules` VALUES ('_30030', 'Setting Saldo Awal Piutang Customer', 'Form', 'customer/saldo_awal', '.', '_30000', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_30031', 'Proses', 'Form', '_30031', '.', '_30030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30033', 'Delete', 'Form', '_30033', '.', '_30030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30040', 'Arsip Bulanan Piutang Customer', 'Form', 'customer/proses_bulanan', '.', '_30000', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_30041', 'Proses', 'Form', '_30041', '.', '_30040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30042', 'Delete', 'Form', '_30042', '.', '_30040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30050', 'Pembuatan SO', 'Form', 'sales_order', '.', '_30000', '1', '5', '', null);
INSERT INTO `modules` VALUES ('_30051', 'Create', 'Form', '_30051', '.', '_30050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30052', 'Edit', 'Form', '_30052', '.', '_30050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30053', 'Delete', 'Form', '_30053', '.', '_30050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30054', 'Buat Invoice', 'Form', '_30054', '.', '_30050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30055', 'Buat Do', 'Form', '_30055', 'Buat Do', '_30000', '1', null, '', null);
INSERT INTO `modules` VALUES ('_30060', 'Pembuatan DO', 'Form', 'delivery_order', '.', '_30000', '1', '6', '', null);
INSERT INTO `modules` VALUES ('_30061', 'Create', 'Form', '_30061', '.', '_30060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30062', 'Edit', 'Form', '_30062', '.', '_30060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30063', 'Delete', 'Form', '_30063', '.', '_30060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30064', 'Print', 'Form', '_30064', '.', '_30060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30070', 'Pembuatan Invoice Kontan', 'Form', 'invoice/kontan', '.', '_30000', '1', '8', '', null);
INSERT INTO `modules` VALUES ('_30071', 'Create', 'Form', '_30071', '.', '_30070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30072', 'Edit', 'Form', '_30072', '.', '_30070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30073', 'Delete', 'Form', '_30073', '.', '_30070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30074', 'Print', 'Form', '_30074', '.', '_30070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30075', 'Posting', 'Form', '_30075', 'Posting', '_30070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30080', 'Pembuatan Invoice dari DO', 'Form', 'invoice/do', '.', '_30000', '1', '7', '', null);
INSERT INTO `modules` VALUES ('_30081', 'Save', 'Form', '_30081', '.', '_30080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30090', 'Pembuatan Retur Penjualan', 'Form', 'invoice/retur', '.', '_30000', '1', '11', '', null);
INSERT INTO `modules` VALUES ('_300900', '_300900', 'Form', '_300900', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_300901', '_300901', 'Form', '_300901', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_30091', 'Create', 'Form', '_30091', '.', '_30090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30092', 'Edit', 'Form', '_30092', '.', '_30090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30093', 'Delete', 'Form', '_30093', '.', '_30090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30094', 'Print', 'Form', '_30094', '.', '_30090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30095', 'Posting', 'Form', '_30095', '.', '_30090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30100', 'Batch Posting', 'Form', 'so_batch_posting', '.', '_30000', '1', '14', '', null);
INSERT INTO `modules` VALUES ('_30110', 'Pelunasan Piutang', 'Form', 'payments', '.', '_30000', '1', '10', '', null);
INSERT INTO `modules` VALUES ('_30112', 'Proses', 'Form', '_30112', '.', '_30110', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30120', 'Kredit Nota', 'Form', 'so_credit_memo', '.', '_30000', '1', '12', '', null);
INSERT INTO `modules` VALUES ('_30121', 'Create', 'Form', '_30121', '.', '_30100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30122', 'Edit', 'Form', '_30122', '.', '_30120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30123', 'Delete', 'Form', '_30123', '.', '_30120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30124', 'Print', 'Form', '_30124', '.', '_30120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30125', 'Posting', 'Form', '_30125', '.', '_30120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30130', 'Debit Nota', 'Form', 'so_debit_memo', '.', '_30000', '1', '13', '', null);
INSERT INTO `modules` VALUES ('_30131', 'Create', 'Form', '_30131', '.', '_30100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30132', 'Edit', 'Form', '_30132', '.', '_30130', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30133', 'Delete', 'Form', '_30133', '.', '_30130', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30134', 'Print', 'Form', '_30134', '.', '_30130', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30135', 'Posting', 'Form', '_30135', '.', '_30130', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30140', 'Daftar Pelunasan Giro', 'Form', 'payments/giro', '.', '_30000', '1', '15', '', null);
INSERT INTO `modules` VALUES ('_30141', 'Cairkan', 'Form', '_30141', '.', '_30100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30142', 'Tolak', 'Form', '_30142', '.', '_30140', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30143', 'Hapus', 'Form', '_30143', '.', '_30140', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30150', 'Daftar Pelunasan Cash', 'Form', 'payments/cash', '.', '_30000', '1', '16', '', null);
INSERT INTO `modules` VALUES ('_30151', 'Delete', 'Form', '_30151', '.', '_30150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30160', 'Pembuatan Invoice Kredit', 'Form', 'invoice', '.', '_30000', '1', '8', '', null);
INSERT INTO `modules` VALUES ('_30161', 'Create', 'Form', '_30161', '.', '_30160', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30162', 'Edit', 'Form', '_30162', '.', '_30160', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30163', 'Delete', 'Form', '_30163', '.', '_30160', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30164', 'Print', 'Form', '_30164', '.', '_30160', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30165', 'Posting', 'Form', '_30165', 'Posting', '_30160', '1', null, null, null);
INSERT INTO `modules` VALUES ('_30170', '_30170', 'Form', '_30170', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_40000', 'Pembelian', 'Form', '_40000', 'Modul Hutang, A/P, Hutang, Pembayaran, Supplier dan Pembayaran.', '0', '1', '2', '', null);
INSERT INTO `modules` VALUES ('_40010', 'Master Data Supplier', 'Form', 'supplier/browse', '.', '_40000', '1', '1', '', null);
INSERT INTO `modules` VALUES ('_40011', 'Create', 'Form', '_40011', '.', '_40010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40012', 'Edit', 'Form', '_40012', '.', '_40010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40013', 'Delete', 'Form', '_40013', '.', '_40010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40020', 'Setting Saldo Awal Hutang Supplier', 'Form', 'supplier/saldo_awal', '.', '_40000', '1', '2', '', null);
INSERT INTO `modules` VALUES ('_40021', 'Proses', 'Form', '_40021', '.', '_40020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40023', 'Delete', 'Form', '_40023', '.', '_40020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40030', 'Arsip Bulanan Hutang Supplier', 'Form', 'supplier/proses_bulanan', '.', '_40000', '1', '13', '', null);
INSERT INTO `modules` VALUES ('_40031', 'Proses', 'Form', '_40031', '.', '_40030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40033', 'Delete', 'Form', '_40033', '.', '_40030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40040', 'Pembuatan PO', 'Form', 'purchase_order', '.', '_40000', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_40041', 'Create', 'Form', '_40041', '.', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40042', 'Edit', 'Form', '_40042', '.', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40043', 'Delete', 'Form', '_40043', '.', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40044', 'Print', 'Form', '_40044', '.', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40045', 'Close PO Manual', 'Form', '_40045', 'Close PO Manual', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40046', 'Buat Faktur', 'Form', '_40046', 'Buat Faktur', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40047', 'Create Duplikat PO', 'Form', '_40047', 'Create Duplikat PO', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40048', 'Daftar Penerimaan PO', 'Form', '_40048', 'Daftar Penerimaan PO', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40049', 'Buat Faktur dari daftar penerimaan', 'Form', '_40049', 'Buat Faktur Dari daftar penerimaan', '_40040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40050', 'Faktur Pembelian Kontan', 'Form', 'beli/kontan', '.', '_40000', '1', '5', '', null);
INSERT INTO `modules` VALUES ('_40051', 'Create', 'Form', '_40051', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40052', 'Edit', 'Form', '_40052', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40053', 'Delete', 'Form', '_40053', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40054', 'Print', 'Form', '_40054', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40055', 'Posting', 'Form', '_40055', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40060', 'Pembuatan Retur Pembelian', 'Form', 'po_retur', '.', '_40000', '1', '7', '', null);
INSERT INTO `modules` VALUES ('_40061', 'Create', 'Form', '_40061', '.', '_40060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40062', 'Edit', 'Form', '_40062', '.', '_40060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40063', 'Delete', 'Form', '_40063', '.', '_40060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40064', 'Print', 'Form', '_40064', '.', '_40060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40065', 'Posting', 'Form', '_40065', '.', '_40060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40070', 'Pembayaran Hutang', 'Form', 'payables_payments', '.', '_40000', '1', '6', '', null);
INSERT INTO `modules` VALUES ('_40071', 'Proses', 'Form', '_40071', '.', '_40070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40080', 'Hutang Manager', 'Form', 'payables', '.', '_40000', '1', '8', '', null);
INSERT INTO `modules` VALUES ('_40081', 'Create', 'Form', '_40081', '.', '_40080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40082', 'Edit', 'Form', '_40082', '.', '_40080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40083', 'Delete', 'Form', '_40083', '.', '_40080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40084', 'Bayar Hutang', 'Form', '_40084', '.', '_40080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40085', 'Posting', 'Form', '_40085', '.', '_40080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40090', 'Kredit Memo', 'Form', 'po_credit_memo', '.', '_40000', '1', '9', '', null);
INSERT INTO `modules` VALUES ('_40091', 'Create', 'Form', '_40091', '.', '_40090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40092', 'Edit', 'Form', '_40092', '.', '_40090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40093', 'Delete', 'Form', '_40093', '.', '_40090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40094', 'Print', 'Form', '_40094', '.', '_40090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40095', 'Posting', 'Form', '_40095', 'Posting', '_40090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40100', 'Debit Memo', 'Form', 'po_debit_memo', '.', '_40000', '1', '10', '', null);
INSERT INTO `modules` VALUES ('_40101', 'Create', 'Form', '_40101', '.', '_40100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40102', 'Edit', 'Form', '_40102', '.', '_40100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40103', 'Delete', 'Form', '_40103', '.', '_40100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40104', 'Print', 'Form', '_40104', '.', '_40100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40105', 'Posting', 'Form', '_40105', 'Posting', '_40100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40110', 'Daftar Pembayaran Giro', 'Form', 'payables_payments/giro', '.', '_40000', '1', '11', '', null);
INSERT INTO `modules` VALUES ('_40113', 'Cair', 'Form', '_40113', '.', '_40110', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40114', 'Tolak', 'Form', '_40114', '.', '_40110', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40115', 'Delete', 'Form', '_40115', '.', '_40110', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40120', 'Daftar Pembayaran Cash', 'Form', 'payables_payments/cash', '.', '_40000', '1', '12', '', null);
INSERT INTO `modules` VALUES ('_40123', 'Delete', 'Form', '_40123', '.', '_40120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40130', 'Faktur Pembelian Kredit', 'Form', 'beli', '.', '_40000', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_40131', 'Create', 'Form', '_40131', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40132', 'Edit', 'Form', '_40132', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40134', 'Delete', 'Form', '_40134', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40135', 'Print', 'Form', '_40135', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_40136', 'Posting', 'Form', '_40136', '.', '_40050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60000', 'Cash & Bank', 'Form', '_60000', 'Modul untuk pencatatan semua aktifitas kas atau bank.', '0', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_60010', 'Pembuatan Account Bank', 'Form', 'bank', '.', '_60000', '1', '1', '', null);
INSERT INTO `modules` VALUES ('_60011', 'Create', 'Form', '_60011', '.', '_60010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60012', 'Edit', 'Form', '_60012', '.', '_60010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60013', 'Delete', 'Form', '_60013', '.', '_60010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60020', 'Cash Masuk', 'Form', 'bank_cash/in', '.', '_60000', '1', '2', '', null);
INSERT INTO `modules` VALUES ('_60021', 'Create', 'Form', '_60021', '.', '_60020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60022', 'Edit', 'Form', '_60022', '.', '_60020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60023', 'Delete', 'Form', '_60023', '.', '_60020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60024', 'Print', 'Form', '_60024', '.', '_60020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60025', 'Posting', 'Form', '_60025', '.', '_60020', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60030', 'Cash Keluar', 'Form', 'bank_cash/out', '.', '_60000', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_60031', 'Create', 'Form', '_60031', '.', '_60030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60032', 'Edit', 'Form', '_60032', '.', '_60030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60033', 'Delete', 'Form', '_60033', '.', '_60030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60034', 'Print', 'Form', '_60034', '.', '_60030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60035', 'Posting', 'Form', '_60035', '.', '_60030', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60040', 'Giro Masuk', 'Form', 'bank_giro/in', '.', '_60000', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_60041', 'Create', 'Form', '_60041', '.', '_60040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60042', 'Edit', 'Form', '_60042', '.', '_60040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60043', 'Delete', 'Form', '_60043', '.', '_60040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60044', 'Print', 'Form', '_60044', '.', '_60040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60045', 'Posting', 'Form', '_60045', '.', '_60040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60050', 'Giro Keluar', 'Form', 'bank_giro/out', '.', '_60000', '1', '5', '', null);
INSERT INTO `modules` VALUES ('_60051', 'Create', 'Form', '_60051', '.', '_60050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60052', 'Edit', 'Form', '_60052', '.', '_60050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60053', 'Delete', 'Form', '_60053', '.', '_60050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60054', 'Print', 'Form', '_60054', '.', '_60050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60055', 'Posting', 'Form', '_60055', '.', '_60050', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60060', 'Transfer Masuk', 'Form', 'bank_transfer/in', '.', '_60000', '1', '6', '', null);
INSERT INTO `modules` VALUES ('_60061', 'Create', 'Form', '_60061', '.', '_60060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60062', 'Edit', 'Form', '_60062', '.', '_60060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60063', 'Delete', 'Form', '_60063', '.', '_60060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60064', 'Print', 'Form', '_60064', '.', '_60060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60065', 'Posting', 'Form', '_60065', '.', '_60060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60070', 'Transfer Keluar', 'Form', 'bank_transfer/out', '.', '_60000', '1', '7', '', null);
INSERT INTO `modules` VALUES ('_60071', 'Create', 'Form', '_60071', '.', '_60070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60072', 'Edit', 'Form', '_60072', '.', '_60070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60073', 'Delete', 'Form', '_60073', '.', '_60070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60074', 'Print', 'Form', '_60074', '.', '_60070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60075', 'Posting', 'Form', '_60075', '.', '_60070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60080', 'Adjusment', 'Form', 'bank_adjust', '.', '_60000', '1', '8', '', null);
INSERT INTO `modules` VALUES ('_60081', 'Create', 'Form', '_60081', '.', '_60080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60082', 'Edit', 'Form', '_60082', '.', '_60080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60083', 'Delete', 'Form', '_60083', '.', '_60080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60085', 'Posting', 'Form', '_60085', '.', '_60080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80000', 'Inventory', 'Form', '_80000', 'Modul Pengelolaan dan transaksi barang dagangan.', '0', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_80010', 'Master Data Stock', 'Form', 'inventory', '.', '_80000', '1', '1', '', null);
INSERT INTO `modules` VALUES ('_80010.01', '_80010.01', 'Form', '_80010.01', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80010.02', '_80010.02', 'Form', '_80010.02', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80010.03', '_80010.03', 'Form', '_80010.03', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80010.04', '_80010.04', 'Form', '_80010.04', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80010.05', '_80010.05', 'Form', '_80010.05', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80010.06', '_80010.06', 'Form', '_80010.06', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80010.07', '_80010.07', 'Form', '_80010.07', 'Please entry this', '_00000', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80011', 'Create', 'Form', '_80011', '.', '_80010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80012', 'Edit', 'Form', '_80012', '.', '_80010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80013', 'Delete', 'Form', '_80013', '.', '_80010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80014', 'Serial Number', 'Form', '_80014', '.', '_80010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80015', 'Ubah Kode', 'Form', '_80015', 'Ubah kode barang atau jasa', '_80010', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80020', 'Master Kategory', 'Form', 'category', '.', '_80000', '1', '2', '', null);
INSERT INTO `modules` VALUES ('_80021', 'Create', 'Form', '_80021', '.', '_80020', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80022', 'Edit', 'Form', '_80022', '.', '_80020', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80023', 'Delete', 'Form', '_80023', '.', '_80020', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80024', 'Print', 'Form', '_80024', '.', '_80020', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80030', 'Master Gudang', 'Form', 'gudang', '.', '_80000', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_80031', 'Create', 'Form', '_80031', '.', '_80030', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80032', 'Edit', 'Form', '_80032', '.', '_80030', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80033', 'Delete', 'Form', '_80033', '.', '_80030', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80034', 'Print', 'Form', '_80034', '.', '_80030', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80040', 'Transfer Stock', 'Form', 'transfer', '.', '_80000', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_80041', 'Create', 'Form', '_80041', '.', '_80040', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80042', 'Edit', 'Form', '_80042', '.', '_80040', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80043', 'Delete', 'Form', '_80043', '.', '_80040', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80044', 'Print', 'Form', '_80044', '.', '_80040', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80050', 'Penerimaan dari PO', 'Form', 'receive', '.', '_80000', '1', '6', '', null);
INSERT INTO `modules` VALUES ('_80051', 'Create', null, '_80051', null, '_80050', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80052', 'Edit', null, '_80052', null, '_80050', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80053', 'Delete', null, '_80053', null, '_80050', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80054', 'Print', null, '_80054', null, '_80050', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80060', 'Penerimaan Lain-lain', null, 'stock_recv_etc', null, '_80000', '1', '7', '', null);
INSERT INTO `modules` VALUES ('_80061', 'Create', null, '_80061', null, '_80060', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80062', 'Edit', null, '_80062', null, '_80060', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80063', 'Delete', null, '_80063', null, '_80060', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80064', 'Print', 'Form', '_80064', '.', '_80060', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80070', 'Pengeluaran Lain-Lain', null, 'stock_send_etc', null, '_80000', '1', '8', '', null);
INSERT INTO `modules` VALUES ('_80071', 'Create', null, '_80071', null, '_80070', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80072', 'Edit', null, '_80072', null, '_80070', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80073', 'Delete', null, '_80073', null, '_80070', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80074', 'Print', null, '_80074', null, '_80070', '0', null, null, null);
INSERT INTO `modules` VALUES ('_80080', 'Pengeluaran ke WIP', null, '_80080', null, '_80000', '1', null, '', null);
INSERT INTO `modules` VALUES ('_80081', 'Create', null, '_80081', null, '_80080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80082', 'Edit', null, '_80082', null, '_80080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80083', 'Delete', null, '_80083', null, '_80080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80084', 'Print', null, '_80084', null, '_80080', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80090', 'Penerimaan dari WIP', null, '_80090', null, '_80000', '1', null, '', null);
INSERT INTO `modules` VALUES ('_80091', 'Create', null, '_80091', null, '_80090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80092', 'Edit', null, '_80092', null, '_80090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80093', 'Delete', null, '_80093', null, '_80090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80094', 'Print', null, '_80094', null, '_80090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80100', 'Proses Assembly', null, 'assembly', null, '_80000', '1', '9', '', null);
INSERT INTO `modules` VALUES ('_80101', 'Proses', null, '_80101', null, '_80100', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80110', 'Proses DisAssembly', null, 'disassembly', null, '_80000', '1', '10', '', null);
INSERT INTO `modules` VALUES ('_80111', 'Proses', null, '_80111', null, '_80110', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80120', 'Adjusment Stock', null, 'stock_adjust', null, '_80000', '1', '5', '', null);
INSERT INTO `modules` VALUES ('_80121', 'Proses', null, '_80121', null, '_80120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80130', 'Arsip Bulanan Stock', null, 'stock_proses_bulanan', null, '_80000', '1', '11', '', null);
INSERT INTO `modules` VALUES ('_80131', 'Proses', null, '_80131', null, '_80130', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80132', 'Delete', null, '_80132', null, '_80130', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80140', 'Setting Saldo Awal', null, 'stock_saldo_awal', null, '_80000', '1', '12', '', null);
INSERT INTO `modules` VALUES ('_80141', 'Proses', null, '_80141', null, '_80140', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80200', 'Penerimaan barang non PO', null, '_80200', null, '_80000', '1', null, '', null);
INSERT INTO `modules` VALUES ('_80201', 'Save', null, '_80201', null, '_80200', '1', null, null, null);
INSERT INTO `modules` VALUES ('_80202', 'Print', null, '_80202', null, '_80200', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90000', 'Laporan', null, '_90000', 'Modul Daftar Laporan', '0', '1', '8', '', null);
INSERT INTO `modules` VALUES ('_90010', 'General Ledger', 'Group', 'laporan/gl', 'Laporan General Ledger', '_90000', '1', '3', '', null);
INSERT INTO `modules` VALUES ('_90011', '001. Daftar Perkiraan / Chart Of Accounts', 'Report', '\\Gl\\chartofaccount1.rpt', 'Daftar Perkiraan', '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90012', '002. Jurnal Transaksi - Sort by Kode Jurnal', null, '\\gl\\gltransactions1.rpt', null, '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90013', '003. Jurnal Transaksi - Sort by Tanggal', null, '\\gl\\gltransactions2.rpt', null, '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90014', '004. Kartu General Ledger', null, '\\Gl\\glCards.rpt', null, '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90015', '005. Kartu General Ledger - All Date', null, '\\Gl\\glCards2.rpt', null, '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90016', '006. Kartu General Ledger - All Date, Account', null, '\\Gl\\glCards3.rpt', null, '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90017', '007. Neraca Percobaan', null, '\\gl\\trialbalances.rpt', null, '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90018', '008. Laporan Rugi Laba', null, '\\gl\\incomestatement1.rpt', null, '_90010', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90040', 'Inventory', null, 'laporan/stock', 'Laporan Inventory', '_90000', '1', '4', '', null);
INSERT INTO `modules` VALUES ('_90041', '001. Daftar Stock Item Number', null, '\\Inv\\InvListing.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90042', '002. Daftar Stock per Gudang', null, '\\Inv\\PosisiStockGudang.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90043', '003. Daftar Stock - With Financial', null, '\\Inv\\DaftarBarang12.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90044', '004. Daftar Stock - With to Order', null, '\\Inv\\DaftarBarang11.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90045', '005. Formulir Stock Opname', null, '\\Inv\\FStockOpname.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90046', '006. Price List', null, '\\Inv\\PriceList.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90047', '007. Kartu Stock', null, '\\Inv\\KartuStock.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90048', '008. Kartu Stock Summary', null, '\\Inv\\KartuStockSum.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90049', '009. Penerimaan Barang - Detail by No PO', null, '\\PO\\TerimaByPO.Rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90050', '010. Penerimaan Barang - Detail by No Bukti', null, '\\PO\\TerimaByRecvId.Rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90051', '011. Penerimaan Barang - Detail by Item', null, '\\PO\\TerimaByItem.Rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90052', '012. Penerimaan Barang dari WIP', null, '\\PO\\TerimaFG.Rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90053', '013. Pengeluaran Barang ke WIP', null, '\\Po\\KeluarWO.Rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90054', '014. Retur Barang Penjualan', null, '\\inv\\TerimaReturPenjualan.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90055', '015. Retur Barang Pembelian ', null, '\\Po\\ReturBarangPembelian.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90056', '016. Transfer Stok Antar Gudang ', null, '\\inv\\Transfer001.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90057', '017. Laporan Assembly & Disassembly', null, '\\Inv\\AsmItem18.Rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90058', '018. Daftar Transaksi Stock - per Gudang', null, '\\Inv\\TransaksiInventory.rpt', null, '_90040', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90070', 'Pembelian', null, 'laporan/pembelian', 'Laporan Pembelian', '_90000', '1', '2', '', null);
INSERT INTO `modules` VALUES ('_90071', '001. Pembelian - Summary', null, '\\Po\\OrderPembelianSummary.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90072', '002. Pembelian  Per Supplier - Summary ', null, '\\Po\\OrderPembelianDetail.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90073', '003. Pembelian  Per Supplier  - Detail ', null, '\\Po\\BeliSuppSum.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90074', '004. Pembelian  Per Item Summary', null, '\\Po\\OrderPembelianSupplierDetail.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90075', '005. Pembelian  Per Item - Detail ', null, '\\Po\\PembelianItemSummary.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90076', '006. Pembelian  Per Katagori - Summary', null, '\\Po\\OrderPembelianItemDetail.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90077', '007. Pembelian  Per Kategori - Detail ', null, '\\Po\\OrderPembelianItemKategoriSum.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90078', '009. Pembelian per Mata Uang', null, '\\Po\\OrderPembelianItemKategoriDetail.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90079', '010. Laporan Pajak Masukan', null, '\\po\\BeliCurrency.Rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90080', '011. Daftar PO', null, '\\Po\\PajakMasukan.Rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90081', '012. Daftar PO - Detail', null, '\\PO\\DaftarPO.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90082', '013. Faktur Pembelian - Detail', null, '\\PO\\PODetailMonthly.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90083', '014. History Harga Per Supplier', null, '\\po\\PembelianDetail.Rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90084', '015. Selisih Kurs Pembelian', null, '\\Po\\HistoryHargaPerSupplier.rpt', null, '_90070', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90090', 'Penjualan', null, 'laporan/penjualan', 'Laporan Penjualan', '_90000', '1', '1', '', null);
INSERT INTO `modules` VALUES ('_90091', '001. Penjualan - Summary ', null, '\\So\\AnalisaPenjualanPerJenisFakturPerbulan.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90092', '002. Penjualan By Customer - Summary ', null, '\\So\\PenjualanCustomerSum.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90093', '003. Penjualan by Customer - Detail ', null, '\\So\\SumJualByCust.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90094', '004. Penjualan per Item - Summary', null, '\\So\\FakturPenjualanSummaryTrading.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90095', '005. Penjualan per Item - Detail', null, '\\So\\PenjualanPeritemDetailTrading.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90096', '006. Penjualan per kategori Item - Summary', null, '\\So\\AnalisaPenjualanPerkategoriSummary.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90097', '007. Penjualan Per Kategori - Detail', null, '\\So\\AnalisaPenjualanPerkategori.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90098', '008. Penjualan per Salesman - Summary', null, '\\So\\FakturPenjualanMonthSales.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90099', '009. Penjualan per Salesman - Detail', null, '\\So\\FakturPenjualanSummarySales.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90100', '010. Penjualan per wilayah - Summary', null, '\\So\\AnalisaPenjualanPerWilayahPerbulan.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90101', '011. Penjualan per Mata Uang', null, '\\so\\JualCurrency.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90102', '012. Faktur Penjualan - Detail', null, '\\So\\FakturPenjualan.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90103', '013. Retur Penjualan', null, '\\So\\ReturPenjualan.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90104', '014. Komisi Salesman', null, '\\So\\KomisiSalesman.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90105', '015. Laporan Pajak Keluaran', null, '\\So\\PajakKeluaran.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90106', '017. Daftar DO Customer', null, '\\SO\\DODetail300.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90107', '018. Daftar DO - Detail', null, '\\SO\\DODetail200.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90108', '019. History Harga Per Customer', null, '\\So\\HistoryHargaPerCustomer.rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90109', '020. Selisih Kurs Penjualan', null, '\\so\\SelisihKursPiutang1.Rpt', null, '_90090', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90120', 'Supplier / Hutang', null, 'laporan/supplier', 'Laporan Supplier atau Hutang', '_90000', '1', '5', '', null);
INSERT INTO `modules` VALUES ('_90121', '001. Daftar Supplier Urut Kode', null, '\\po\\DaftarSupplier2.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90122', '002. History Pembayaran Hutang Supplier', null, '\\po\\SuppPayHistory01.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90123', '003. Daftar Pembayaran Hutang', null, '\\po\\SuppPayHistory.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90124', '004. Kartu Hutang Supplier Summary', null, '\\po\\KartuHutangSum.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90125', '005. Kartu Hutang Supplier Detail', null, '\\Po\\KartuHutang.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90126', '006. Laporan Umur Hutang - Summary', null, '\\Po\\UmurHutang.Rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90127', '007. Laporan Umur Hutang Supplier - Summary', null, '\\Po\\UmurHutang_Supplier.Rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90128', '008. Laporan Umur Hutang Supplier - Detail', null, '\\Po\\UmurHutang_SupplierDetail.Rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90129', '009. Daftar Pembayaran Hutang - Currency', null, '\\PO\\BayarHutang0011.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90130', '010. Daftar Pembayaran Hutang per Supplier - Currency', null, '\\PO\\BayarHutang0012.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90131', '011. Daftar Hutang - Currency', null, '\\po\\DaftarHutang009.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90132', '012. Daftar Hutang per Supplier - Currency', null, '\\po\\DaftarHutang010.rpt', null, '_90120', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90150', 'Customer / Piutang', null, 'laporan/customer', 'Laporan Customer atau Piutang', '_90000', '1', '6', '', null);
INSERT INTO `modules` VALUES ('_90151', '001. Daftar Customer urut Kode', null, '\\so\\daftarcustomerkode.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90152', '002. History Pembayaran Piutang Customer', null, '\\So\\CustPayHistory01.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90153', '003. Daftar Pembayaran Piutang', null, '\\So\\CustPayHistory.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90154', '004. Kartu Piutang Customer - Summary', null, '\\so\\KartuPiutangSum.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90155', '005. Kartu Piutang Customer - Detail', null, '\\so\\KartuPiutang.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90156', '006. Laporan Umur Piutang - Summary', null, '\\So\\UmurPiutang.Rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90157', '007. Laporan Umur Piutang Pelanggan - Summary', null, '\\So\\UmurPiutang_Customer.Rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90158', '008. Laporan Umur Piutang Pelanggan - Detail', null, '\\So\\UmurPiutang_CustomerDetail.Rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90159', '009. Daftar Pembayaran Piutang - Currency', null, '\\SO\\BayarPiutang0010.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90160', '010. Daftar Pembayaran Piutang per Customer - Currency', null, '\\SO\\BayarPiutang0011.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90161', '011. Daftar Piutang - Currency', null, '\\so\\DaftarPiutang0011.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_90162', '012. Daftar Piutang per Customer - Currency', null, '\\so\\DaftarPiutang0012.rpt', null, '_90150', '1', null, null, null);
INSERT INTO `modules` VALUES ('_60084', 'Mutasi Antar Rekening', 'Form', 'bank_mutasi', null, '_60000', null, '9', '', null);
INSERT INTO `modules` VALUES ('_18000', 'Leasing', 'Form', '_18000', 'Leasing elektronik, kendaraan atau lainnya', '0', '0', '0', '', '');
INSERT INTO `modules` VALUES ('_18000.001', 'Data Pelanggan', 'Form', '_18000.001', 'Data Pelanggan', '_18000', '0', '0', '', '');
INSERT INTO `modules` VALUES ('_18000.002', 'Object Kredit', 'Form', '_18000.002', 'Data Master Object Kredit', '_18000', '0', '2', '', '');
INSERT INTO `modules` VALUES ('_18000.003', 'Aplikasi Kredit', 'Form', '_18000.003', 'Formulir Aplikasi Kredit', '_18000', '0', '3', '', '');
INSERT INTO `modules` VALUES ('_18000.004', 'Phone Verification', 'Form', '_18000.004', 'Proses Verifikasi Applikasi Kredit', '_18000', '0', '4', '', '');
INSERT INTO `modules` VALUES ('_18000.005', 'Scoring', 'Form', '_18000.005', 'Proses Scoring Aplikasi Kredit', '_18000', '0', '6', '', '');
INSERT INTO `modules` VALUES ('_18000.006', 'Survey', 'Form', '_18000.006', 'Proses Survey Aplikasi Kredit', '_18000', '0', '7', '', '');
INSERT INTO `modules` VALUES ('_18000.007', 'Proses Risk', 'Form', '_18000.007', 'Proses Risk', '_18000', '0', '8', '', '');
INSERT INTO `modules` VALUES ('_18000.008', 'Formulir Kredit', 'Form', '_18000.008', 'Formulir Kredit', '_18000', '0', '9', '', '');
INSERT INTO `modules` VALUES ('_18000.009', 'Billing', 'Form', '_18000.008\\9', 'Billing', '_18000', '0', '9', '', '');
INSERT INTO `modules` VALUES ('_18000.010', 'Bayar Cicilan', 'Form', '_18000.010', 'Bayar Cicilan', '_18000', '0', '10', '', '');
INSERT INTO `modules` VALUES ('_18000.011', 'Kolektor', 'Form', '_18000.011', 'Kolektor', '_18000', '0', '11', '', '');
INSERT INTO `modules` VALUES ('_18000.012', 'Penutupan', 'Form', '_18000.012', 'Penutupan', '_18000', '0', '12', '', '');
INSERT INTO `modules` VALUES ('_18000.013', 'Counter', 'Form', '_18000.013', 'Data Master Counter dan Cabang', '_18000', '0', '13', '', '');
INSERT INTO `modules` VALUES ('_18000.100', 'Setting', 'Form', '_18000.100', 'Pengaturan Modul Leasing', '_18000', '0', '100', '', '');
INSERT INTO `modules` VALUES ('_18000.014', 'Approval', 'Form', '_18000.014', 'Approval Pengajuan Kredit', '_18000', '0', '14', '', '');
INSERT INTO `modules` VALUES ('_18000.015', 'Recomend To Survey', 'Form', '_18000.015', 'Recomend To Survey', '_18000', '0', '15', '', '');
INSERT INTO `modules` VALUES ('_18000.020', 'Export Absensi', 'Form', '_18000.020', 'Export Data Absensi', '_18000', '0', '20', '', '');
INSERT INTO `modules` VALUES ('_20000', 'Website', 'Form', '_20000', 'Website utama untuk perusahaan', '_00000', '0', '21', '', '');
INSERT INTO `modules` VALUES ('_21000', 'Travel Agent', 'Form', '_21000', 'Modul Travel Agent', '0', '0', '1', '', '');
INSERT INTO `modules` VALUES ('_21010', 'Maskapai', 'Form', '_21010', 'Data master maskapai penerbangan', '_21000', '0', '1', '', '');
INSERT INTO `modules` VALUES ('_18000.900', 'Clear Data Transaksi', 'Form', '_18000.900', 'Clear Data Transaksi', '_18000', '0', '12', '', '');
INSERT INTO `modules` VALUES ('_18000.901', 'Clear Data Master', 'Form', '_18000.901', 'Clear Data Master', '_18000', '0', '12', '', '');
INSERT INTO `modules` VALUES ('_11001', 'Work Order', 'Form', '_11001', 'Work order', '_11000', '0', '0', '', '');
INSERT INTO `modules` VALUES ('_12001', 'Employee Master', 'Form', '_12001', 'Employee Master', '_12000', '0', '0', '', '');
INSERT INTO `modules` VALUES ('_18000.021', 'Jadwal Kontrak Untuk SA', 'Form', '_18000.021', 'Jadwal Kontrak Untuk SA', '_18000', '0', '3', '', '');
INSERT INTO `modules` VALUES ('_18000.022', 'Jadwal Kontrak Untuk Admin', 'Form', '_18000.022', 'Jadwal Kontrak Untuk Admin', '_18000', '0', '3', '', '');
INSERT INTO `modules` VALUES ('_14001', 'Daftar Aktiva', 'Form', '_14001', 'Daftar Aktiva Tetap', '_14000', '0', '1', '', '');
INSERT INTO `modules` VALUES ('_14000', 'Aktiva Tetap', 'Form', '_14000', 'Aktiva Tetap', '0', '0', '1', '', '');
INSERT INTO `modules` VALUES ('_30057', 'Approval SO', 'Form', '_30057', 'Approval SO', '_30050', '0', '5', '', '');
INSERT INTO `modules` VALUES ('_30067', 'Approval DO', 'Form', '_30067', 'Approval DO', '_30060', '0', '4', '', '');
INSERT INTO `modules` VALUES ('_18000.023', 'Tanda Terima Barang', 'Form', '_18000.023', 'Tanda Terima Barang', '_18000', '0', '7', '', '');
INSERT INTO `modules` VALUES ('retur_toko', 'retur_toko', 'Form', 'retur_toko', 'Retur dari toko (tambah)', '_80000', '0', '0', '', '');
INSERT INTO `modules` VALUES ('retur_toko_add', 'retur_toko_add', 'Form', 'retur_toko_add', 'Retur dari toko (tambah)', '_80000', '0', '0', '', '');
INSERT INTO `modules` VALUES ('retur_toko_view', 'retur_toko_view', 'form', 'retur_toko_view', 'retur_toko_view', '_80000', '0', '1', '', '');
INSERT INTO `modules` VALUES ('retur_toko_print', 'retur_toko_print', '', 'retur_toko_print', 'retur_toko_print', '_80000', '0', '0', '', '');
 


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
  UNIQUE KEY `x1` (`user_group_id`),
  KEY `x2` (`user_group_name`)
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
  PRIMARY KEY (`org_id`),
  KEY `x1` (`org_name`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`tanggal`),
  KEY `x2` (`nip`)
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
  PRIMARY KEY (`bill_id`),
  KEY `x1` (`purchase_order_number`),
  KEY `x2` (`invoice_number`),
  KEY `x3` (`supplier_number`),
  KEY `x4` (`invoice_date`)
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
  PRIMARY KEY (`line_number`),
  KEY `x1` (`bill_id`)
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
  PRIMARY KEY (`line_number`),
  KEY `x1` (`bill_id`),
  KEY `x2` (`date_paid`)
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
  PRIMARY KEY (`line_number`),
  KEY `x1` (`invoice_number`),
  KEY `x2` (`date_paid`),
  KEY `x3` (`how_paid`)
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
  PRIMARY KEY (`promosi_code`),
  KEY `x1` (`description`),
  KEY `x2` (`category`),
  KEY `x3` (`date_to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_disc: 14 rows
/*!40000 ALTER TABLE `promosi_disc` DISABLE KEYS */;
REPLACE INTO `promosi_disc` (`promosi_code`, `description`, `date_from`, `category`, `date_to`, `tipe`, `qty`, `nilai`, `issameitem`, `update_status`, `outlet`, `disc_base`, `total_sales`, `method`, `create_date`, `create_by`, `update_date`, `update_by`, `flag1`, `flag2`, `flag3`, `flag4`, `flag5`) VALUES
	('Extra Qty', 'Extra Qty Sample', '2013-07-04 00:00:00', 2, '2015-11-13 23:59:59', 0, 2, 1, 0, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Reguler', 'Contoh Disc Reguler', '2013-07-04 00:00:00', 1, '2016-02-23 23:59:59', 2, 0, 0.1, 0, 0, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `promosi_disc` ENABLE KEYS */;

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
  KEY `x1` (`promosi_code`,`item_number`),
  KEY `x2` (`promosi_code`),
  KEY `x3` (`item_number`)
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
  UNIQUE KEY `x1` (`promosi_code`,`item_number`),
  KEY `x3` (`item_number`),
  KEY `x2` (`promosi_code`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`cust_code`),
  KEY `x2` (`tanggal`),
  KEY `x3` (`ref1`)
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
  PRIMARY KEY (`purchase_order_number`),
  KEY `x1` (`po_date`),
  KEY `x2` (`supplier_number`),
  KEY `x3` (`potype`),
  KEY `x4` (`warehouse_code`),
  KEY `x5` (`branch_code`),
  KEY `x6` (`project_code`)
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
  PRIMARY KEY (`line_number`),
  KEY `x1` (`purchase_order_number`),
  KEY `x2` (`warehouse_code`),
  KEY `x3` (`item_number`),
  KEY `x4` (`description`)
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
  PRIMARY KEY (`line_number`),
  KEY `x1` (`sales_order_number`)
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
  PRIMARY KEY (`report_code`),
  KEY `x1` (`report_name`),
  KEY `x2` (`report_category`)
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
  PRIMARY KEY (`groupid`),
  KEY `x1` (`salesman`)
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
  PRIMARY KEY (`sales_order_number`),
  KEY `x1` (`sold_to_customer`),
  KEY `x2` (`sales_date`),
  KEY `x3` (`warehouse_code`),
  KEY `x4` (`salesman`),
  KEY `x5` (`shipped_via`)
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
  PRIMARY KEY (`line_number`),
  KEY `x1` (`sales_order_number`),
  KEY `x2` (`warehouse_code`),
  KEY `x3` (`item_number`),
  KEY `x4` (`description`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`job_id`)
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
  PRIMARY KEY (`no_bukti`),
  KEY `x1` (`customer`)
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
  PRIMARY KEY (`supplier_number`),
  KEY `x1` (`supplier_name`),
  KEY `x2` (`city`)
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
  UNIQUE KEY `x1` (`tanggal`,`supplier_number`),
  KEY `x2` (`supplier_number`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`varname`),
  KEY `x2` (`keterangan`),
  KEY `x3` (`category`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`salary_no`),
  KEY `x2` (`nip`)
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
  PRIMARY KEY (`user_id`),
  KEY `x1` (`username`)
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
  UNIQUE KEY `x1` (`group_id`,`module_id`),
  KEY `x2` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3194 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.user_group_modules: 1,015 rows
/*!40000 ALTER TABLE `user_group_modules` DISABLE KEYS */;

INSERT INTO `user_group_modules` VALUES ('97', 'BYR', '_40110', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('98', 'BYR', '_40120', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('99', 'BYR', '_80010', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('100', 'BYR', '_80020', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('101', 'BYR', '_80030', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('102', 'BYR', '_90070', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('103', 'BYR', '_90071', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('104', 'BYR', '_90072', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('105', 'BYR', '_90073', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('106', 'BYR', '_90075', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('107', 'BYR', '_90076', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('2228', 'Administrator', '_00011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('192', 'SYSMENU', '_10000', '0', null, null, null);
INSERT INTO `user_group_modules` VALUES ('193', 'SYSMENU', '_11000', '0', null, null, null);
INSERT INTO `user_group_modules` VALUES ('194', 'SYSMENU', '_10060', '0', null, null, null);
INSERT INTO `user_group_modules` VALUES ('195', 'SYSMENU', '_30010', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('196', 'SYSMENU', '_30011', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('197', 'SYSMENU', '_30012', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('2227', 'Administrator', '_00010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('307', 'BYR', '_40010', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('308', 'BYR', '_40040', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('309', 'BYR', '_40041', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('310', 'BYR', '_40042', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('311', 'BYR', '_40043', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('312', 'BYR', '_40044', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('313', 'BYR', '_40050', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('314', 'BYR', '_40051', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('315', 'BYR', '_40052', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('316', 'BYR', '_40053', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('372', 'BYR', '_90074', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('373', 'BYR', '_90077', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('374', 'BYR', '_90078', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('375', 'BYR', '_90079', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('376', 'BYR', '_90080', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('377', 'BYR', '_90081', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('378', 'BYR', '_90082', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('379', 'BYR', '_90083', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('380', 'BYR', '_90084', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('381', 'BYR', '_90120', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('382', 'BYR', '_90121', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('383', 'BYR', '_90122', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('384', 'BYR', '_90123', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('385', 'BYR', '_90124', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('386', 'BYR', '_90125', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('387', 'BYR', '_90126', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('388', 'BYR', '_90127', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('389', 'BYR', '_90128', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('390', 'BYR', '_90129', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('391', 'BYR', '_90131', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('392', 'BYR', '_90130', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('393', 'BYR', '_90132', '0', '1', null, null);
INSERT INTO `user_group_modules` VALUES ('8495', 'Gudang', '_40065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5398', 'ADM', '_30000.064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5399', 'ADM', '_30000.065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5400', 'ADM', '_30000.066', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5401', 'ADM', '_30000.100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5402', 'ADM', '_30057', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8116', 'SPV', '_80042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8117', 'SPV', '_80044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8118', 'SPV', '_80060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8119', 'SPV', '_80061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8120', 'SPV', '_80064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8121', 'SPV', '_80080', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8122', 'SPV', '_80081', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8123', 'SPV', '_80082', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8124', 'SPV', '_80084', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8125', 'SPV', '_80090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8126', 'SPV', '_80091', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8127', 'SPV', '_80092', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8128', 'SPV', '_80094', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8129', 'SPV', '_90096', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8130', 'SPV', '_90097', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5359', 'ADM', '_30000.007', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5358', 'ADM', '_30000.006', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5357', 'ADM', '_30000.005', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5356', 'ADM', '_30000.004', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5355', 'ADM', '_30000.003', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5354', 'ADM', '_30000.002', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5353', 'ADM', '_30000.001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5352', 'ADM', '_80010.07', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5351', 'ADM', '_80010.06', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5350', 'ADM', '_80010.05', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5349', 'ADM', '_80010.04', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5348', 'ADM', '_80010.03', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5347', 'ADM', '_80010.02', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5346', 'ADM', '_80010.01', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5345', 'ADM', '_30170', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5344', 'ADM', '_300901', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5343', 'ADM', '_300900', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5342', 'ADM', '_20000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5341', 'ADM', '_13000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5340', 'ADM', '_11001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5339', 'ADM', '_11000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1982', 'PUR', '_80010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1981', 'PUR', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1980', 'PUR', '_40044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1979', 'PUR', '_40042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1978', 'PUR', '_40041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1977', 'PUR', '_40040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1976', 'PUR', '_40030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1975', 'PUR', '_40020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1974', 'PUR', '_40012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1973', 'PUR', '_40011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1972', 'PUR', '_40010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1971', 'PUR', '_40000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('819', 'BYR', 'socustomerEnvelop.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('820', 'BYR', '_10010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('821', 'BYR', '_10020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('822', 'BYR', '_10030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('823', 'BYR', '_10060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('824', 'BYR', '_10064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('825', 'BYR', '_30000.0', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('826', 'BYR', '_30010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('827', 'BYR', '_30020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('828', 'BYR', '_30030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2148', 'INV', '_80100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2149', 'INV', '_80120', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1677', 'ANDRI', '_80010.07', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1676', 'ANDRI', '_80010.06', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1675', 'ANDRI', '_80010.05', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1674', 'ANDRI', '_80010.04', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1673', 'ANDRI', '_80010.03', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1672', 'ANDRI', '_80010.02', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1671', 'ANDRI', '_80010.01', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1670', 'ANDRI', '_30170', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1669', 'ANDRI', '_300901', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1668', 'ANDRI', '_300900', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1667', 'ANDRI', '_13000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1666', 'ANDRI', '_11000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1665', 'ANDRI', '_10060A', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1664', 'ANDRI', '_00050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1663', 'ANDRI', '_00040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1662', 'ANDRI', '_00030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1661', 'ANDRI', '_00020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1660', 'ANDRI', '_00010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1659', 'ANDRI', 'ID_JasaKiriman', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1658', 'ANDRI', 'ID_ExportImport', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1657', 'ANDRI', 'frmMain.Addnew', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1114', 'BYR', '_40000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1115', 'BYR', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1116', 'BYR', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1117', 'BYR', '_60000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2226', 'Administrator', 'ID_JasaKiriman', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2225', 'Administrator', 'ID_ExportImport', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2156', 'SA', '_18000.003', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1680', 'ANDRI', '_10030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1678', 'ANDRI', '_10010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1679', 'ANDRI', '_10020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1848', 'GM', '_18000.015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2155', 'SA', '_18000.001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1686', 'VF', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1687', 'VF', '_18000.004', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1847', 'GM', '_18000.005', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1846', 'GM', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5334', 'ADM', '_00041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5335', 'ADM', '_00042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5336', 'ADM', '_00043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5337', 'ADM', '_00050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5338', 'ADM', '_10060A', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1822', 'BS', '_18000.005', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1821', 'BS', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1857', 'SV', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1825', 'MRISK', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1826', 'MRISK', '_18000.007', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1827', 'GMRISK', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1828', 'GMRISK', '_18000.014', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2164', 'LSADM', '_18000.020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2229', 'Administrator', '_00012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2230', 'Administrator', '_00013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2163', 'LSADM', '_18000.012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2162', 'LSADM', '_18000.011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2161', 'LSADM', '_18000.010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1849', 'GM', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1850', 'GM', '_40000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1851', 'COL', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1852', 'COL', '_18000.011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1853', 'GMBS', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1854', 'GMBS', '_18000.015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1855', 'RS', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1856', 'RS', '_18000.006', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2160', 'LSADM', '_18000.008', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2159', 'LSADM', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2154', 'SA', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5333', 'ADM', '_00040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2147', 'INV', '_80090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2146', 'INV', '_80070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2145', 'INV', '_80060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2144', 'INV', '_80050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2143', 'INV', '_80040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2142', 'INV', '_80030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2141', 'INV', '_80020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2140', 'INV', '_80010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2139', 'INV', '_11000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1983', 'PUR', '_80011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('1984', 'PUR', '_80012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8498', 'Gudang', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8499', 'Gudang', 'retur_toko', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8500', 'Gudang', 'retur_toko_add', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8501', 'Gudang', 'retur_toko_print', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2070', 'TRV', '_21000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2071', 'TRV', '_21010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5360', 'ADM', '_30000.009', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2150', 'INV', '_80130', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2151', 'INV', '_80200', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2152', 'PYR', '_12000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2153', 'PYR', '_12001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2157', 'SA', '_18000.011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2158', 'SA', '_18000.021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2165', 'LSADM', '_18000.022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3201', 'admin', '_00023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3200', 'admin', '_00022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3199', 'admin', '_00021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3198', 'admin', '_00020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3197', 'admin', '_00013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3196', 'admin', '_00012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3195', 'admin', '_00011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3194', 'admin', '_00010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3282', 'SLS', '_30000.035', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3281', 'SLS', '_30000.034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3280', 'SLS', '_30000.033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3279', 'SLS', '_30000.032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3278', 'SLS', '_30000.031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3277', 'SLS', '_30000.030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3276', 'SLS', '_30000.029', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3275', 'SLS', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5397', 'ADM', '_30000.063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2224', 'Administrator', 'frmMain.Addnew', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2223', 'Administrator', '_00000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2231', 'Administrator', '_00020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2232', 'Administrator', '_00021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2233', 'Administrator', '_00022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2234', 'Administrator', '_00023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2235', 'Administrator', '_00030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2236', 'Administrator', '_00031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2237', 'Administrator', '_00032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2238', 'Administrator', '_00040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2239', 'Administrator', '_00041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2240', 'Administrator', '_00042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2241', 'Administrator', '_00043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2242', 'Administrator', '_00050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2243', 'Administrator', '_10060A', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2244', 'Administrator', '_11000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2245', 'Administrator', '_11001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2246', 'Administrator', '_13000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2247', 'Administrator', '_20000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2248', 'Administrator', '_300900', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2249', 'Administrator', '_300901', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2250', 'Administrator', '_30170', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2251', 'Administrator', '_80010.01', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2252', 'Administrator', '_80010.02', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2253', 'Administrator', '_80010.03', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2254', 'Administrator', '_80010.04', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2255', 'Administrator', '_80010.05', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2256', 'Administrator', '_80010.06', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2257', 'Administrator', '_80010.07', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2258', 'Administrator', '_10000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2259', 'Administrator', '_10010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2260', 'Administrator', '_10011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2261', 'Administrator', '_10012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2262', 'Administrator', '_10013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2263', 'Administrator', '_10015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2264', 'Administrator', '_10016', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2265', 'Administrator', '_10020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2266', 'Administrator', '_10021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2267', 'Administrator', '_10030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2268', 'Administrator', '_10031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2269', 'Administrator', '_10032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2270', 'Administrator', '_10035', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2271', 'Administrator', '_10036', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2272', 'Administrator', '_10060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2273', 'Administrator', '_10061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2274', 'Administrator', '_10062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2275', 'Administrator', '_10063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2276', 'Administrator', '_10064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2277', 'Administrator', '_10065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2278', 'Administrator', '_10066', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2279', 'Administrator', '_10067', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2280', 'Administrator', '_10068', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2281', 'Administrator', '_10069', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2282', 'Administrator', '_10070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2283', 'Administrator', '_12000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2284', 'Administrator', '_12001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2285', 'Administrator', '_18000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2286', 'Administrator', '_18000.001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2287', 'Administrator', '_18000.002', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2288', 'Administrator', '_18000.003', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2289', 'Administrator', '_18000.004', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2290', 'Administrator', '_18000.005', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2291', 'Administrator', '_18000.006', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2292', 'Administrator', '_18000.007', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2293', 'Administrator', '_18000.008', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2294', 'Administrator', '_18000.009', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2295', 'Administrator', '_18000.010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2296', 'Administrator', '_18000.011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2297', 'Administrator', '_18000.012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2298', 'Administrator', '_18000.013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2299', 'Administrator', '_18000.014', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2300', 'Administrator', '_18000.015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2301', 'Administrator', '_18000.020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2302', 'Administrator', '_18000.021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2303', 'Administrator', '_18000.022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2304', 'Administrator', '_18000.100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2305', 'Administrator', '_18000.900', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2306', 'Administrator', '_18000.901', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2307', 'Administrator', '_21000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2308', 'Administrator', '_21010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2309', 'Administrator', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2310', 'Administrator', '_30000.0', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2311', 'Administrator', '_30000.001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2312', 'Administrator', '_30000.002', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2313', 'Administrator', '_30000.003', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2314', 'Administrator', '_30000.004', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2315', 'Administrator', '_30000.005', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2316', 'Administrator', '_30000.006', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2317', 'Administrator', '_30000.007', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2318', 'Administrator', '_30000.008', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2319', 'Administrator', '_30000.009', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2320', 'Administrator', '_30000.010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2321', 'Administrator', '_30000.011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2322', 'Administrator', '_30000.012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2323', 'Administrator', '_30000.013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2324', 'Administrator', '_30000.014', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2325', 'Administrator', '_30000.015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2326', 'Administrator', '_30000.016', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2327', 'Administrator', '_30000.017', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2328', 'Administrator', '_30000.018', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2329', 'Administrator', '_30000.019', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2330', 'Administrator', '_30000.020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2331', 'Administrator', '_30000.021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2332', 'Administrator', '_30000.022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2333', 'Administrator', '_30000.023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2334', 'Administrator', '_30000.024', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2335', 'Administrator', '_30000.025', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2336', 'Administrator', '_30000.026', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2337', 'Administrator', '_30000.027', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2338', 'Administrator', '_30000.028', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2339', 'Administrator', '_30000.029', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2340', 'Administrator', '_30000.030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2341', 'Administrator', '_30000.031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2342', 'Administrator', '_30000.032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2343', 'Administrator', '_30000.033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2344', 'Administrator', '_30000.034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2345', 'Administrator', '_30000.035', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2346', 'Administrator', '_30000.036', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2347', 'Administrator', '_30000.037', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2348', 'Administrator', '_30000.038', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2349', 'Administrator', '_30000.039', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2350', 'Administrator', '_30000.040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2351', 'Administrator', '_30000.041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2352', 'Administrator', '_30000.050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2353', 'Administrator', '_30000.051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2354', 'Administrator', '_30000.052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2355', 'Administrator', '_30000.053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2356', 'Administrator', '_30000.054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2357', 'Administrator', '_30000.055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2358', 'Administrator', '_30000.056', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2359', 'Administrator', '_30000.057', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2360', 'Administrator', '_30000.058', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2361', 'Administrator', '_30000.059', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2362', 'Administrator', '_30000.060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2363', 'Administrator', '_30000.061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2364', 'Administrator', '_30000.062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2365', 'Administrator', '_30000.063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2366', 'Administrator', '_30000.064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2367', 'Administrator', '_30000.065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2368', 'Administrator', '_30000.066', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2369', 'Administrator', '_30000.067', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2370', 'Administrator', '_30000.068', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2371', 'Administrator', '_30000.100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2372', 'Administrator', '_30010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2373', 'Administrator', 'frmCustomers.cmdSaveShipTo', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2374', 'Administrator', '_30011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2375', 'Administrator', '_30012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2376', 'Administrator', '_30013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2377', 'Administrator', '_30020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2378', 'Administrator', '_30030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2379', 'Administrator', '_30031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2380', 'Administrator', '_30033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2381', 'Administrator', '_30040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2382', 'Administrator', '_30041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2383', 'Administrator', '_30042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2384', 'Administrator', '_30050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2385', 'Administrator', '_30051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2386', 'Administrator', '_30052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2387', 'Administrator', '_30053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2388', 'Administrator', '_30054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2389', 'Administrator', '_30055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2390', 'Administrator', '_30060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2391', 'Administrator', '_30061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2392', 'Administrator', '_30062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2393', 'Administrator', '_30063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2394', 'Administrator', '_30064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2395', 'Administrator', '_30070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2396', 'Administrator', '_30071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2397', 'Administrator', '_30072', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2398', 'Administrator', '_30073', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2399', 'Administrator', '_30074', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2400', 'Administrator', '_30075', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2401', 'Administrator', '_30080', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2402', 'Administrator', '_30081', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2403', 'Administrator', '_30090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2404', 'Administrator', '_30091', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2405', 'Administrator', '_30092', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2406', 'Administrator', '_30093', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2407', 'Administrator', '_30094', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2408', 'Administrator', '_30095', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2409', 'Administrator', '_30100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2410', 'Administrator', '_30121', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2411', 'Administrator', '_30131', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2412', 'Administrator', '_30141', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2413', 'Administrator', '_30110', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2414', 'Administrator', '_30112', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2415', 'Administrator', '_30120', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2416', 'Administrator', '_30122', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2417', 'Administrator', '_30123', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2418', 'Administrator', '_30124', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2419', 'Administrator', '_30125', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2420', 'Administrator', '_30130', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2421', 'Administrator', '_30132', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2422', 'Administrator', '_30133', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2423', 'Administrator', '_30134', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2424', 'Administrator', '_30135', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2425', 'Administrator', '_30140', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2426', 'Administrator', '_30142', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2427', 'Administrator', '_30143', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2428', 'Administrator', '_30150', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2429', 'Administrator', '_30151', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2430', 'Administrator', '_30160', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2431', 'Administrator', '_30161', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2432', 'Administrator', '_30162', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2433', 'Administrator', '_30163', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2434', 'Administrator', '_30164', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2435', 'Administrator', '_30165', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2436', 'Administrator', '_40000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2437', 'Administrator', '_40010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2438', 'Administrator', '_40011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2439', 'Administrator', '_40012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2440', 'Administrator', '_40013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2441', 'Administrator', '_40020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2442', 'Administrator', '_40021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2443', 'Administrator', '_40023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2444', 'Administrator', '_40030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2445', 'Administrator', '_40031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2446', 'Administrator', '_40033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2447', 'Administrator', '_40040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2448', 'Administrator', '_40041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2449', 'Administrator', '_40042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2450', 'Administrator', '_40043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2451', 'Administrator', '_40044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2452', 'Administrator', '_40045', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2453', 'Administrator', '_40046', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2454', 'Administrator', '_40047', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2455', 'Administrator', '_40048', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2456', 'Administrator', '_40049', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2457', 'Administrator', '_40050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2458', 'Administrator', '_40051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2459', 'Administrator', '_40052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2460', 'Administrator', '_40053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2461', 'Administrator', '_40054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2462', 'Administrator', '_40055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2463', 'Administrator', '_40131', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2464', 'Administrator', '_40132', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2465', 'Administrator', '_40134', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2466', 'Administrator', '_40135', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2467', 'Administrator', '_40136', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2468', 'Administrator', '_40060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2469', 'Administrator', '_40061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2470', 'Administrator', '_40062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2471', 'Administrator', '_40063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2472', 'Administrator', '_40064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2473', 'Administrator', '_40065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2474', 'Administrator', '_40070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2475', 'Administrator', '_40071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2476', 'Administrator', '_40080', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2477', 'Administrator', '_40081', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2478', 'Administrator', '_40082', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2479', 'Administrator', '_40083', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2480', 'Administrator', '_40084', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2481', 'Administrator', '_40085', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2482', 'Administrator', '_40090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2483', 'Administrator', '_40091', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2484', 'Administrator', '_40092', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2485', 'Administrator', '_40093', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2486', 'Administrator', '_40094', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2487', 'Administrator', '_40095', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2488', 'Administrator', '_40100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2489', 'Administrator', '_40101', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2490', 'Administrator', '_40102', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2491', 'Administrator', '_40103', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2492', 'Administrator', '_40104', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2493', 'Administrator', '_40105', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2494', 'Administrator', '_40110', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2495', 'Administrator', '_40113', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2496', 'Administrator', '_40114', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2497', 'Administrator', '_40115', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2498', 'Administrator', '_40120', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2499', 'Administrator', '_40123', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2500', 'Administrator', '_40130', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2501', 'Administrator', '_60000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2502', 'Administrator', '_60010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2503', 'Administrator', '_60011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2504', 'Administrator', '_60012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2505', 'Administrator', '_60013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2506', 'Administrator', '_60020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2507', 'Administrator', '_60021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2508', 'Administrator', '_60022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2509', 'Administrator', '_60023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2510', 'Administrator', '_60024', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2511', 'Administrator', '_60025', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2512', 'Administrator', '_60030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2513', 'Administrator', '_60031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2514', 'Administrator', '_60032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2515', 'Administrator', '_60033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2516', 'Administrator', '_60034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2517', 'Administrator', '_60035', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2518', 'Administrator', '_60040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2519', 'Administrator', '_60041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2520', 'Administrator', '_60042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2521', 'Administrator', '_60043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2522', 'Administrator', '_60044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2523', 'Administrator', '_60045', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2524', 'Administrator', '_60050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2525', 'Administrator', '_60051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2526', 'Administrator', '_60052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2527', 'Administrator', '_60053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2528', 'Administrator', '_60054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2529', 'Administrator', '_60055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2530', 'Administrator', '_60060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2531', 'Administrator', '_60061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2532', 'Administrator', '_60062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2533', 'Administrator', '_60063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2534', 'Administrator', '_60064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2535', 'Administrator', '_60065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2536', 'Administrator', '_60070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2537', 'Administrator', '_60071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2538', 'Administrator', '_60072', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2539', 'Administrator', '_60073', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2540', 'Administrator', '_60074', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2541', 'Administrator', '_60075', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2542', 'Administrator', '_60080', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2543', 'Administrator', '_60081', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2544', 'Administrator', '_60082', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2545', 'Administrator', '_60083', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2546', 'Administrator', '_60085', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2547', 'Administrator', '_60084', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2548', 'Administrator', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2549', 'Administrator', '_80010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2550', 'Administrator', '_80011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2551', 'Administrator', '_80012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2552', 'Administrator', '_80013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2553', 'Administrator', '_80014', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2554', 'Administrator', '_80015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2555', 'Administrator', '_80020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2556', 'Administrator', '_80021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2557', 'Administrator', '_80022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2558', 'Administrator', '_80023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2559', 'Administrator', '_80024', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2560', 'Administrator', '_80030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2561', 'Administrator', '_80031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2562', 'Administrator', '_80032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2563', 'Administrator', '_80033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2564', 'Administrator', '_80034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2565', 'Administrator', '_80040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2566', 'Administrator', '_80041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2567', 'Administrator', '_80042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2568', 'Administrator', '_80043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2569', 'Administrator', '_80044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2570', 'Administrator', '_80050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2571', 'Administrator', '_80051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2572', 'Administrator', '_80052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2573', 'Administrator', '_80053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2574', 'Administrator', '_80054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2575', 'Administrator', '_80060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2576', 'Administrator', '_80061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2577', 'Administrator', '_80062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2578', 'Administrator', '_80063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2579', 'Administrator', '_80064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2580', 'Administrator', '_80070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2581', 'Administrator', '_80071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2582', 'Administrator', '_80072', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2583', 'Administrator', '_80073', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2584', 'Administrator', '_80074', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2585', 'Administrator', '_80080', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2586', 'Administrator', '_80081', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2587', 'Administrator', '_80082', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2588', 'Administrator', '_80083', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2589', 'Administrator', '_80084', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2590', 'Administrator', '_80090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2591', 'Administrator', '_80091', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2592', 'Administrator', '_80092', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2593', 'Administrator', '_80093', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2594', 'Administrator', '_80094', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2595', 'Administrator', '_80100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2596', 'Administrator', '_80101', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2597', 'Administrator', '_80110', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2598', 'Administrator', '_80111', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2599', 'Administrator', '_80120', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2600', 'Administrator', '_80121', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2601', 'Administrator', '_80130', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2602', 'Administrator', '_80131', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2603', 'Administrator', '_80132', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2604', 'Administrator', '_80140', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2605', 'Administrator', '_80141', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2606', 'Administrator', '_80200', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2607', 'Administrator', '_80201', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2608', 'Administrator', '_80202', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2609', 'Administrator', '_90000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2610', 'Administrator', 'frmRptCriteria', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2611', 'Administrator', '_90010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2612', 'Administrator', '\\CEK\\BANKCEK2.RPT', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2613', 'Administrator', '\\CEK\\BANKCEKGL.RPT', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2614', 'Administrator', '\\CEK\\BANKCEKM2.RPT', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2615', 'Administrator', '\\cek\\BANKCODE.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2616', 'Administrator', '\\Cek\\BankMutasiBank.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2617', 'Administrator', '\\CEK\\ChInSum.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2618', 'Administrator', '\\CEK\\ChOutSum.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2619', 'Administrator', '\\CEK\\KasInSum.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2620', 'Administrator', '\\CEK\\KasOutSum.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2621', 'Administrator', '\\Cek\\MutasiKas_Saldo.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2622', 'Administrator', '\\CEK\\transfer_in.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2623', 'Administrator', '\\CEK\\transfer_out.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2624', 'Administrator', '\\gl\\balancesheet2.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2625', 'Administrator', '\\gl\\neracaT.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2626', 'Administrator', '\\gl\\RLCompare.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2627', 'Administrator', '\\so\\CustCredit.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2628', 'Administrator', '\\so\\CustCreditAll.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2629', 'Administrator', '\\So\\CustHighest.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2630', 'Administrator', '\\so\\CustListCompany.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2631', 'Administrator', '\\so\\CustListCustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2632', 'Administrator', '_90011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2633', 'Administrator', '_90012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2634', 'Administrator', '_90013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2635', 'Administrator', '_90014', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2636', 'Administrator', '_90015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2637', 'Administrator', '_90016', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2638', 'Administrator', '_90017', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2639', 'Administrator', '_90018', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2640', 'Administrator', '_90040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2641', 'Administrator', '\\Inv\\AsmItem.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2642', 'Administrator', '\\Inv\\AsmItem17.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2643', 'Administrator', '\\Inv\\DaftarBarang.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2644', 'Administrator', '\\Inv\\FisikInventory.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2645', 'Administrator', '\\Inv\\HargaBeli.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2646', 'Administrator', '\\Inv\\HargaJual.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2647', 'Administrator', '\\Inv\\InventoryMoving.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2648', 'Administrator', '\\Inv\\InvPriceHistory.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2649', 'Administrator', '\\Inv\\InvTranCategory.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2650', 'Administrator', '\\Inv\\InvTranItem.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2651', 'Administrator', '\\inv\\invvalue.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2652', 'Administrator', '\\inv\\KeluarReturPembelian.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2653', 'Administrator', '\\Inv\\MutasiGudang.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2654', 'Administrator', '\\Inv\\StokMgmtLow.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2655', 'Administrator', '\\Inv\\StokMgMtOnBOrder.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2656', 'Administrator', '\\Inv\\StokMgMtOut.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2657', 'Administrator', '\\Inv\\StokMgMtRecon.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2658', 'Administrator', '\\PO\\Terima.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2659', 'Administrator', '_90041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2660', 'Administrator', '_90042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2661', 'Administrator', '_90043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2662', 'Administrator', '_90044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2663', 'Administrator', '_90045', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2664', 'Administrator', '_90046', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2665', 'Administrator', '_90047', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2666', 'Administrator', '_90048', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2667', 'Administrator', '_90049', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2668', 'Administrator', '_90050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2669', 'Administrator', '_90051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2670', 'Administrator', '_90052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2671', 'Administrator', '_90053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2672', 'Administrator', '_90054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2673', 'Administrator', '_90055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2674', 'Administrator', '_90056', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2675', 'Administrator', '_90057', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2676', 'Administrator', '_90058', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2677', 'Administrator', '_90070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2678', 'Administrator', '\\PO\\Keluar.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2679', 'Administrator', '\\PO\\KeluarPerPO.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2680', 'Administrator', '\\PO\\OpenPO.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2681', 'Administrator', '\\Po\\OrderPembelian.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2682', 'Administrator', '\\Po\\OrderPembelianItemSupplierDetail.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2683', 'Administrator', '\\PO\\PODaily.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2684', 'Administrator', '\\PO\\PODetailDaily.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2685', 'Administrator', '\\PO\\POItemNoRecvItem.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2686', 'Administrator', '\\PO\\POItemNoRecvSupplier.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2687', 'Administrator', '\\PO\\POItemOverItem.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2688', 'Administrator', '\\PO\\POItemOverSupplier.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2689', 'Administrator', '\\PO\\POMonthly.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2690', 'Administrator', '_90071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2691', 'Administrator', '_90072', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2692', 'Administrator', '_90073', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2693', 'Administrator', '_90074', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2694', 'Administrator', '_90075', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2695', 'Administrator', '_90076', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2696', 'Administrator', '_90077', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2697', 'Administrator', '_90078', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2698', 'Administrator', '_90079', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2699', 'Administrator', '_90080', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2700', 'Administrator', '_90081', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2701', 'Administrator', '_90082', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2702', 'Administrator', '_90083', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2703', 'Administrator', '_90084', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2704', 'Administrator', '_90090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2705', 'Administrator', '\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2706', 'Administrator', '\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2707', 'Administrator', '\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2708', 'Administrator', '\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2709', 'Administrator', '\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2710', 'Administrator', '\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2711', 'Administrator', '\\So\\AnalisaPenjualanPerWilayah.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2712', 'Administrator', '\\so\\customerEnvelop.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2713', 'Administrator', '\\so\\CustPayHistory2.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2714', 'Administrator', '\\So\\CustPayHistoryByCust.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2715', 'Administrator', '\\So\\CustSalesHistory.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2716', 'Administrator', '\\So\\CustSalesHistoryLast.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2717', 'Administrator', '\\so\\daftarcustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2718', 'Administrator', '\\so\\DaftarPiutang.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2719', 'Administrator', '\\So\\DaftarTagihan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2720', 'Administrator', '\\So\\DODetail100.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2721', 'Administrator', '\\So\\FakturPelunasanPiutang.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2722', 'Administrator', '\\So\\FakturPenjualanDetailTanggal.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2723', 'Administrator', '\\So\\FakturPenjualanDetailtem.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2724', 'Administrator', '\\So\\FakturPenjualanSummary.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2725', 'Administrator', '\\So\\FakturPenjualanSummaryBayar.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2726', 'Administrator', '\\So\\FakturPenjualanSummaryItemCust.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2727', 'Administrator', '\\So\\FakturPenjualanSummarySupplier.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2728', 'Administrator', '\\So\\FakturPenjualanSummaryTanggal.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2729', 'Administrator', '\\So\\FakturPenjualanSummaryWilayah.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2730', 'Administrator', '\\So\\FB_RoomResv.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2731', 'Administrator', '\\So\\FB_RoomResv2.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2732', 'Administrator', '\\So\\FB_RoomResv3.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2733', 'Administrator', '\\So\\FB_RoomResvSumDay.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2734', 'Administrator', '\\So\\FB_TableResv.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2735', 'Administrator', '\\SO\\HargaHistoryMonthly.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2736', 'Administrator', '\\So\\HistoryHargaItemCustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2737', 'Administrator', '\\So\\InvoiceAllTypePerCustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2738', 'Administrator', '\\So\\InvoicePerTypePerCustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2739', 'Administrator', '\\So\\Jual100.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2740', 'Administrator', '\\so\\JualCustSum.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2741', 'Administrator', '\\SO\\JualKasirDateTime.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2742', 'Administrator', '\\SO\\JualKonsinyasiTglMonthly.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2743', 'Administrator', '\\SO\\JualReturTglMonthly.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2744', 'Administrator', '\\SO\\JualTglMonthly.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2745', 'Administrator', '\\SO\\JualTglMonthlyDept.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2746', 'Administrator', '\\SO\\JualTglMonthlySales.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2747', 'Administrator', '\\So\\KomisiSalesmanMonthly.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2748', 'Administrator', '\\So\\KomisiSalesmanSummary.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2749', 'Administrator', '\\So\\KreditMemoSummary.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2750', 'Administrator', '\\SO\\MutasiStock.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2751', 'Administrator', '\\SO\\MutasiStockPrice.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2752', 'Administrator', '\\So\\PenjualanCustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2753', 'Administrator', '\\So\\PenjualanCustomerDetail.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2754', 'Administrator', '\\So\\PenjualanPerbulanDetail.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2755', 'Administrator', '\\So\\SaldoPiutang.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2756', 'Administrator', '\\SO\\SalesKomisi.exe', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2757', 'Administrator', '\\SO\\SalesOrder.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2758', 'Administrator', '\\so\\SalesOrderDetail.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2759', 'Administrator', '\\so\\salesorder_do.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2760', 'Administrator', '\\so\\salesorder_do_item.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2761', 'Administrator', '\\so\\sisa_piutang.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2762', 'Administrator', '\\so\\sisa_piutang_bulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2763', 'Administrator', '\\SO\\SOOpenItem.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2764', 'Administrator', '\\SO\\SOOpenTanggal.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2765', 'Administrator', '_90091', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2766', 'Administrator', '_90092', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2767', 'Administrator', '_90093', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2768', 'Administrator', '_90094', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2769', 'Administrator', '_90095', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2770', 'Administrator', '_90096', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2771', 'Administrator', '_90097', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2772', 'Administrator', '_90098', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2773', 'Administrator', '_90099', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2774', 'Administrator', '_90100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2775', 'Administrator', '_90101', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2776', 'Administrator', '_90102', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2777', 'Administrator', '_90103', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2778', 'Administrator', '_90104', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2779', 'Administrator', '_90105', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2780', 'Administrator', '_90106', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2781', 'Administrator', '_90107', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2782', 'Administrator', '_90108', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2783', 'Administrator', '_90109', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2784', 'Administrator', '_90120', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2785', 'Administrator', '\\Po\\DaftarHutang.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2786', 'Administrator', '\\po\\DaftarSupplier.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2787', 'Administrator', '\\po\\DaftarSupplierUtama.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2788', 'Administrator', '\\Po\\HistoryHargaItemSupplier.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2789', 'Administrator', '\\PO\\PayAnaSupplier.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2790', 'Administrator', '\\PO\\PayDetailDaily.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2791', 'Administrator', '\\PO\\PayDetailMonthly.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2792', 'Administrator', '\\Po\\SaldoHutang.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2793', 'Administrator', '\\po\\SelisihKursHutang1.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2794', 'Administrator', '\\po\\sisa_hutang.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2795', 'Administrator', '\\po\\sisa_hutang_bulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2796', 'Administrator', '\\po\\supplierEnvelop.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2797', 'Administrator', '\\Po\\SupplierLstFinancial.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2798', 'Administrator', '\\Po\\SupplierLstNumber.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2799', 'Administrator', '\\Po\\SupplierPayables.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2800', 'Administrator', '\\PO\\TotalPayableSupplier.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2801', 'Administrator', '_90121', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2802', 'Administrator', '_90122', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2803', 'Administrator', '_90123', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2804', 'Administrator', '_90124', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2805', 'Administrator', '_90125', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2806', 'Administrator', '_90126', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2807', 'Administrator', '_90127', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2808', 'Administrator', '_90128', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2809', 'Administrator', '_90129', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2810', 'Administrator', '_90130', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2811', 'Administrator', '_90131', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2812', 'Administrator', '_90132', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2813', 'Administrator', '_90150', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2814', 'Administrator', '_90151', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2815', 'Administrator', '_90152', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2816', 'Administrator', '_90153', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2817', 'Administrator', '_90154', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2818', 'Administrator', '_90155', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2819', 'Administrator', '_90156', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2820', 'Administrator', '_90157', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2821', 'Administrator', '_90158', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2822', 'Administrator', '_90159', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2823', 'Administrator', '_90160', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2824', 'Administrator', '_90161', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2825', 'Administrator', '_90162', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5332', 'ADM', '_00032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5331', 'ADM', '_00031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5330', 'ADM', '_00030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5329', 'ADM', '_00023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5328', 'ADM', '_00022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5327', 'ADM', '_00021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5326', 'ADM', '_00020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5325', 'ADM', '_00013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5324', 'ADM', '_00012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5323', 'ADM', '_00011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5322', 'ADM', '_00010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5321', 'ADM', 'ID_JasaKiriman', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2893', 'aaa', 'frmMain.Addnew', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2894', 'aaa', 'ID_ExportImport', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2895', 'aaa', 'ID_JasaKiriman', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('2896', 'aaa', '_00010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3289', 'SLSADM', '_30012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3288', 'SLSADM', '_30011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3287', 'SLSADM', 'frmCustomers.cmdSaveShipTo', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3286', 'SLSADM', '_30010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3285', 'SLSADM', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3284', 'SLSADM', '_18000.023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8502', 'Gudang', 'retur_toko_view', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8503', 'Gudang', '_80010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8504', 'Gudang', '_80011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8505', 'Gudang', '_80012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8506', 'Gudang', '_80013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8507', 'Gudang', '_80020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8508', 'Gudang', '_80021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8509', 'Gudang', '_80022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8510', 'Gudang', '_80024', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8511', 'Gudang', '_80030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8512', 'Gudang', '_80031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8513', 'Gudang', '_80032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8514', 'Gudang', '_80034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8515', 'Gudang', '_80040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8516', 'Gudang', '_80041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8517', 'Gudang', '_80042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8518', 'Gudang', '_80044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8519', 'Gudang', '_80050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8520', 'Gudang', '_80051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8521', 'Gudang', '_80052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8522', 'Gudang', '_80054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8523', 'Gudang', '_80060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8114', 'SPV', '_80040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8115', 'SPV', '_80041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5367', 'ADM', '_30000.018', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5368', 'ADM', '_30000.019', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5369', 'ADM', '_30000.020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5370', 'ADM', '_30000.021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5371', 'ADM', '_30000.022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7072', 'KSR', '\\SO\\JualTglMonthlyDept.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7071', 'KSR', '\\SO\\JualTglMonthly.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7070', 'KSR', '\\So\\Jual100.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7069', 'KSR', '\\So\\DODetail100.Rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7068', 'KSR', '\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7067', 'KSR', '\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7066', 'KSR', '\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7065', 'KSR', '\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7064', 'KSR', '\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7063', 'KSR', '\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7062', 'KSR', '_80074', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7061', 'KSR', '_80071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7060', 'KSR', '_80070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7059', 'KSR', '_80063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7058', 'KSR', '_80061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7028', 'KSR', '_30000.0', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7029', 'KSR', '_30000.001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7030', 'KSR', '_30000.003', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7031', 'KSR', '_30000.004', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7032', 'KSR', '_30000.006', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7033', 'KSR', '_30000.007', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7034', 'KSR', '_30000.008', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7035', 'KSR', '_30000.009', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7036', 'KSR', '_30000.010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7037', 'KSR', '_30000.029', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7038', 'KSR', '_30000.030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7039', 'KSR', '_30000.031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8497', 'Gudang', '_40071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8496', 'Gudang', '_40070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7055', 'KSR', '_80043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7056', 'KSR', '_80044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7057', 'KSR', '_80060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3202', 'admin', '_30057', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5361', 'ADM', '_30000.012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5362', 'ADM', '_30000.013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5363', 'ADM', '_30000.014', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5364', 'ADM', '_30000.015', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5365', 'ADM', '_30000.016', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5366', 'ADM', '_30000.017', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3272', 'SLSINV', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3273', 'SLSINV', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3274', 'SLSINV', '_80010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3283', 'SLS', '_30067', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3290', 'SLSADM', '_30020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3291', 'SLSADM', '_30050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3292', 'SLSADM', '_30051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('3293', 'SLSADM', '_30052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7043', 'KSR', '_30000.036', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7044', 'KSR', '_30000.056', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7045', 'KSR', '_30000.067', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7046', 'KSR', '_30000.068', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7047', 'KSR', 'retur_toko', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7048', 'KSR', 'retur_toko_add', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7049', 'KSR', '_80011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7050', 'KSR', '_80012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7051', 'KSR', '_80013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7052', 'KSR', '_80040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7053', 'KSR', '_80041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8113', 'SPV', 'retur_toko_view', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8112', 'SPV', 'retur_toko_print', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8111', 'SPV', 'retur_toko_add', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8110', 'SPV', 'retur_toko', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8103', 'SPV', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8104', 'SPV', '_40060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8105', 'SPV', '_40061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8106', 'SPV', '_40062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8107', 'SPV', '_40064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8108', 'SPV', '_40065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8109', 'SPV', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7042', 'KSR', '_30000.035', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7041', 'KSR', '_30000.033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7040', 'KSR', '_30000.032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5396', 'ADM', '_30000.062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5395', 'ADM', '_30000.061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5394', 'ADM', '_30000.060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5393', 'ADM', '_30000.059', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5392', 'ADM', '_30000.057', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5391', 'ADM', '_30000.056', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5390', 'ADM', '_30000.054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5389', 'ADM', '_30000.041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5388', 'ADM', '_30000.040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5387', 'ADM', '_30000.039', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5386', 'ADM', '_30000.038', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5385', 'ADM', '_30000.037', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5384', 'ADM', '_30000.036', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5383', 'ADM', '_30000.035', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5382', 'ADM', '_30000.034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5381', 'ADM', '_30000.032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5380', 'ADM', '_30000.031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5379', 'ADM', '_30000.030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5378', 'ADM', '_30000.029', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5377', 'ADM', '_30000.028', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5376', 'ADM', '_30000.027', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5375', 'ADM', '_30000.026', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5374', 'ADM', '_30000.025', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5373', 'ADM', '_30000.024', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5372', 'ADM', '_30000.023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('7054', 'KSR', '_80042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8524', 'Gudang', '_80061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8525', 'Gudang', '_80062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8526', 'Gudang', '_80064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8527', 'Gudang', '_80070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8528', 'Gudang', '_80071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8529', 'Gudang', '_80072', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8530', 'Gudang', '_80074', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8531', 'Gudang', '_80080', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8532', 'Gudang', '_80081', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8533', 'Gudang', '_80082', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8534', 'Gudang', '_80084', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8535', 'Gudang', '_80090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8536', 'Gudang', '_80091', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8537', 'Gudang', '_80092', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8538', 'Gudang', '_80094', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8539', 'Gudang', '_80100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8540', 'Gudang', '_80101', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8541', 'Gudang', '_80120', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8542', 'Gudang', '_80121', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8543', 'Gudang', '_80200', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8544', 'Gudang', '_80201', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8545', 'Gudang', '_80202', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8546', 'Gudang', '_90000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8547', 'Gudang', '_90041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8548', 'Gudang', '_90042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8549', 'Gudang', '_90047', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8550', 'Gudang', '_90048', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8551', 'Gudang', '_90049', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8552', 'Gudang', '_90050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8553', 'Gudang', '_90051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8554', 'Gudang', '_90052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8555', 'Gudang', '_90053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8556', 'Gudang', '_90054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8557', 'Gudang', '_90055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8558', 'Gudang', '_90056', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8559', 'Gudang', '_90058', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8560', 'HRGA', '_12000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8561', 'HRGA', '_12001', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5320', 'ADM', 'ID_ExportImport', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5319', 'ADM', 'frmMain.Addnew', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('5318', 'ADM', '_00000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8378', 'FIN', '_10000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8379', 'FIN', '_30160', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8380', 'FIN', '_40000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8381', 'FIN', '_40010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8382', 'FIN', '_40011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8383', 'FIN', '_40012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8384', 'FIN', '_40013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8385', 'FIN', '_40020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8386', 'FIN', '_40021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8387', 'FIN', '_40023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8388', 'FIN', '_40049', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8389', 'FIN', '_40050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8390', 'FIN', '_40051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8391', 'FIN', '_40052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8392', 'FIN', '_40053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8393', 'FIN', '_40054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8394', 'FIN', '_40055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8395', 'FIN', '_40131', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8396', 'FIN', '_40132', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8397', 'FIN', '_40134', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8398', 'FIN', '_40135', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8399', 'FIN', '_40136', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8400', 'FIN', '_40060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8401', 'FIN', '_40061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8402', 'FIN', '_40062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8403', 'FIN', '_40063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8404', 'FIN', '_40064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8405', 'FIN', '_40065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8406', 'FIN', '_40070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8407', 'FIN', '_40071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8408', 'FIN', '_40090', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8409', 'FIN', '_40091', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8410', 'FIN', '_40092', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8411', 'FIN', '_40093', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8412', 'FIN', '_40094', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8413', 'FIN', '_40095', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8414', 'FIN', '_40100', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8415', 'FIN', '_40101', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8416', 'FIN', '_40102', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8417', 'FIN', '_40103', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8418', 'FIN', '_40104', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8419', 'FIN', '_40105', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8420', 'FIN', '_40110', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8421', 'FIN', '_40113', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8422', 'FIN', '_40114', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8423', 'FIN', '_40115', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8424', 'FIN', '_40120', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8425', 'FIN', '_40123', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8426', 'FIN', '_40130', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8427', 'FIN', '_60000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8428', 'FIN', '_60020', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8429', 'FIN', '_60021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8430', 'FIN', '_60022', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8431', 'FIN', '_60023', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8432', 'FIN', '_60024', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8433', 'FIN', '_60025', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8434', 'FIN', '_60030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8435', 'FIN', '_60031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8436', 'FIN', '_60032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8437', 'FIN', '_60033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8438', 'FIN', '_60034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8439', 'FIN', '_60035', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8440', 'FIN', '_60040', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8441', 'FIN', '_60041', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8442', 'FIN', '_60042', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8443', 'FIN', '_60043', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8444', 'FIN', '_60044', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8445', 'FIN', '_60045', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8446', 'FIN', '_60050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8447', 'FIN', '_60051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8448', 'FIN', '_60052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8449', 'FIN', '_60053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8450', 'FIN', '_60054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8451', 'FIN', '_60055', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8452', 'FIN', '_60060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8453', 'FIN', '_60061', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8454', 'FIN', '_60062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8455', 'FIN', '_60063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8456', 'FIN', '_60064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8457', 'FIN', '_60065', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8458', 'FIN', '_60070', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8131', 'GL', '_10000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8132', 'GL', '_12000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8133', 'GL', '_14000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8134', 'GL', '_30000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8135', 'GL', '_30160', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8136', 'GL', '_40000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8137', 'GL', '_60000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8138', 'GL', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8139', 'GL', '_90000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8469', 'FIN', '_80010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8470', 'FIN', '_80011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8471', 'FIN', '_80012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8472', 'FIN', '_80013', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8473', 'FIN', '_80030', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8474', 'FIN', '_80031', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8475', 'FIN', '_80032', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8476', 'FIN', '_80033', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8477', 'FIN', '_80034', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8478', 'FIN', '_80050', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8479', 'FIN', '_80051', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8480', 'FIN', '_80052', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8481', 'FIN', '_80053', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8482', 'FIN', '_80054', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8483', 'FIN', '_90000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8459', 'FIN', '_60071', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8460', 'FIN', '_60072', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8461', 'FIN', '_60073', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8462', 'FIN', '_60074', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8463', 'FIN', '_60075', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8464', 'FIN', '_80000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8465', 'FIN', 'retur_toko', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8466', 'FIN', 'retur_toko_add', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8467', 'FIN', 'retur_toko_print', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8468', 'FIN', 'retur_toko_view', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8494', 'Gudang', '_40064', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8493', 'Gudang', '_40063', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8492', 'Gudang', '_40062', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8484', 'Gudang', '_30067', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8485', 'Gudang', '_40000', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8486', 'Gudang', '_40010', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8487', 'Gudang', '_40011', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8488', 'Gudang', '_40012', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8489', 'Gudang', '_40021', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8490', 'Gudang', '_40060', null, null, null, null);
INSERT INTO `user_group_modules` VALUES ('8491', 'Gudang', '_40061', null, null, null, null);

/*!40000 ALTER TABLE `user_group_modules` ENABLE KEYS */;


-- Dumping structure for table simak.user_job
CREATE TABLE IF NOT EXISTS `user_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `group_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`user_id`,`group_id`),
  KEY `x2` (`user_id`)
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
  PRIMARY KEY (`voucher_no`),
  KEY `x1` (`tanggal_dibuat`)
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
  PRIMARY KEY (`work_exec_no`),
  KEY `x1` (`wo_number`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`work_exec_no`),
  KEY `x2` (`item_number`)
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
  PRIMARY KEY (`work_order_no`),
  KEY `x1` (`start_date`)
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
  PRIMARY KEY (`id`),
  KEY `x1` (`work_order_no`),
  KEY `x2` (`item_number`)
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
 
CREATE VIEW `qry_coa` AS select `coa`.`account` AS `account`,
`coa`.`account_description` AS `account_description`,
_utf8'D' AS `jenis`,`coa`.`db_or_cr` AS `db_or_cr`,
`coa`.`beginning_balance` AS `saldo_awal`,`coa`.`group_type` AS `parent` 
from `chart_of_accounts` `coa` 
union all
select `grg`.`group_type` AS `group_type`,`grg`.`group_name` AS `group_name`,
_utf8'H' AS `jenis`,
_utf8'' AS `Unknown`,NULL AS `0`,`grg`.`parent_group_type` AS `parent_group_type` 
from `gl_report_groups` `grg` ;
 


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

-- ----------------------------
-- View structure for qry_loan_by_counter
-- ----------------------------
DROP TABLE IF EXISTS `qry_loan_by_counter`;
CREATE VIEW `qry_loan_by_counter` AS select `lc`.`area_name` AS `area_name`,`lc`.`area` AS `area`,`lam`.`counter_id` AS `counter_id`,`lc`.`counter_name` AS `counter_name`,year(`l`.`loan_date`) AS `tahun`,month(`l`.`loan_date`) AS `bulan`,sum(`l`.`loan_amount`) AS `z_loan`,sum(`l`.`ar_bal_amount`) AS `z_balance`,sum(`l`.`total_amount_paid`) AS `z_payment`,sum(`z_ih`.`z_pokok`) AS `z_pokok`,sum(`z_ih`.`z_saldo_pokok`) AS `z_saldo_pokok_sum`,count(1) AS `z_noa`,sum(`h`.`lancar`) AS `z_lancar`,sum(`h`.`kurang`) AS `z_kurang`,sum(`h`.`macet`) AS `z_macet`,sum(`h`.`lancar_amt`) AS `z_lancar_amt`,sum(`h`.`kurang_amt`) AS `z_kurang_amt`,sum(`h`.`macet_amt`) AS `z_macet_amt`,sum(`loi`.`price`) AS `z_price` from (((((`ls_loan_master` `l` left join `qry_invoice_header_sum` `z_ih` on((`z_ih`.`loan_id` = `l`.`loan_id`))) left join `ls_loan_obj_items` `loi` on((`loi`.`loan_id` = `l`.`loan_id`))) left join `ls_app_master` `lam` on((`lam`.`app_id` = `l`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `lam`.`counter_id`))) left join `qry_invoice_lancar_macet` `h` on(((`h`.`loan_id` = `l`.`loan_id`) and (`h`.`tahun` = year(`l`.`loan_date`)) and (`h`.`bulan` = month(`l`.`loan_date`))))) where (`l`.`status` = 1) group by `lc`.`area_name`,`lc`.`counter_name`,year(`l`.`loan_date`),month(`l`.`loan_date`);

-- ----------------------------
-- View structure for qry_ls_cash_receive
-- ----------------------------
DROP TABLE IF EXISTS `qry_ls_cash_receive`;
CREATE  VIEW `qry_ls_cash_receive` AS select 'INV' AS `jenis`,`p`.`date_paid` AS `tanggal`,`ih`.`invoice_number` AS `no_bukti`,`p`.`voucher_no` AS `ref`,`p`.`amount_paid` AS `amount_recv`,`ih`.`paid` AS `status`,`c`.`cust_name` AS `cust_name`,`ih`.`posted` AS `posted`,ifnull(`p`.`create_by`,`lam`.`create_by`) AS `create_by`,`u`.`username` AS `username`,`lc`.`area_name` AS `area_name`,`lc`.`counter_name` AS `counter_name`,`ih`.`pokok` AS `pokok`,`p`.`pokok` AS `pokok_paid`,`p`.`bunga` AS `bunga_paid`,`ih`.`bunga` AS `bunga`,`lam`.`dp_prc` AS `dp_prc`,0 AS `z_dp_amount`,0 AS `z_admin_amount`,`p`.`denda` AS `denda_paid`,`ih`.`saldo` AS `saldo`,`ih`.`saldo_titip` AS `saldo_titip`,`ih`.`denda_tagih` AS `denda_tagih`,`p`.`how_paid` AS `payment_method` from ((((((`ls_invoice_payments` `p` left join `ls_invoice_header` `ih` on((`ih`.`invoice_number` = convert(`p`.`invoice_number` using utf8)))) left join `ls_cust_master` `c` on((`c`.`cust_id` = `ih`.`cust_deal_id`))) left join `ls_loan_master` `l` on((`l`.`loan_id` = `ih`.`loan_id`))) left join `ls_app_master` `lam` on((`lam`.`app_id` = `l`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `lam`.`counter_id`))) left join `user` `u` on((`u`.`user_id` = `p`.`create_by`))) union all select 'DP' AS `jenis`,`l`.`loan_date` AS `loan_date`,`m`.`app_id` AS `app_id`,`l`.`loan_id` AS `loan_id`,(`m`.`dp_amount` + `m`.`admin_amount`) AS `m.dp_amount+m.admin_amount`,`m`.`status` AS `status`,`c`.`cust_name` AS `cust_name`,`l`.`posted` AS `posted`,`m`.`create_by` AS `create_by`,`u`.`username` AS `username`,`lc`.`area_name` AS `area_name`,`lc`.`counter_name` AS `counter_name`,0 AS `0`,0 AS `My_exp_0`,0 AS `My_exp_1_0`,0 AS `My_exp_2_0`,`m`.`dp_prc` AS `dp_prc`,`m`.`dp_amount` AS `m_dp_amount`,`m`.`admin_amount` AS `admin_amount`,0 AS `denda_paid`,0 AS `saldo`,0 AS `saldo_titip`,0 AS `denda_tagih`,'Cash' AS `payment_method` from ((((`ls_app_master` `m` left join `ls_cust_master` `c` on((`c`.`cust_id` = `m`.`cust_id`))) left join `ls_loan_master` `l` on((`l`.`app_id` = `m`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `m`.`counter_id`))) left join `user` `u` on((`u`.`user_id` = `m`.`create_by`))) where (`m`.`status` = 'Finish');
-- ----------------------------
-- View structure for c02_qry_payroll_component
-- ----------------------------
DROP TABLE IF EXISTS `qry_payroll_component`;
CREATE  VIEW `qry_payroll_component` AS select 'income' AS `jenis`,`jenis_tunjangan`.`kode` AS `kode`,`jenis_tunjangan`.`keterangan` AS `keterangan`,`jenis_tunjangan`.`sifat` AS `sifat`,`jenis_tunjangan`.`is_variable` AS `is_variable`,`jenis_tunjangan`.`ref_column` AS `ref_column` from `jenis_tunjangan` union all select 'deduct' AS `jenis`,`jenis_potongan`.`kode` AS `kode`,`jenis_potongan`.`keterangan` AS `keterangan`,`jenis_potongan`.`sifat` AS `sifat`,`jenis_potongan`.`is_variable` AS `is_variable`,`jenis_potongan`.`ref_column` AS `ref_column` from `jenis_potongan`;



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

-- ----------------------------
-- View structure for qry_loan_by_counter
-- ----------------------------
DROP TABLE IF EXISTS `qry_loan_by_counter`;
CREATE VIEW `qry_loan_by_counter` AS select `lc`.`area_name` AS `area_name`,`lc`.`area` AS `area`,`lam`.`counter_id` AS `counter_id`,`lc`.`counter_name` AS `counter_name`,year(`l`.`loan_date`) AS `tahun`,month(`l`.`loan_date`) AS `bulan`,sum(`l`.`loan_amount`) AS `z_loan`,sum(`l`.`ar_bal_amount`) AS `z_balance`,sum(`l`.`total_amount_paid`) AS `z_payment`,sum(`z_ih`.`z_pokok`) AS `z_pokok`,sum(`z_ih`.`z_saldo_pokok`) AS `z_saldo_pokok_sum`,count(1) AS `z_noa`,sum(`h`.`lancar`) AS `z_lancar`,sum(`h`.`kurang`) AS `z_kurang`,sum(`h`.`macet`) AS `z_macet`,sum(`h`.`lancar_amt`) AS `z_lancar_amt`,sum(`h`.`kurang_amt`) AS `z_kurang_amt`,sum(`h`.`macet_amt`) AS `z_macet_amt`,sum(`loi`.`price`) AS `z_price` from (((((`ls_loan_master` `l` left join `qry_invoice_header_sum` `z_ih` on((`z_ih`.`loan_id` = `l`.`loan_id`))) left join `ls_loan_obj_items` `loi` on((`loi`.`loan_id` = `l`.`loan_id`))) left join `ls_app_master` `lam` on((`lam`.`app_id` = `l`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `lam`.`counter_id`))) left join `qry_invoice_lancar_macet` `h` on(((`h`.`loan_id` = `l`.`loan_id`) and (`h`.`tahun` = year(`l`.`loan_date`)) and (`h`.`bulan` = month(`l`.`loan_date`))))) where (`l`.`status` = 1) group by `lc`.`area_name`,`lc`.`counter_name`,year(`l`.`loan_date`),month(`l`.`loan_date`);

-- ----------------------------
-- View structure for qry_ls_cash_receive
-- ----------------------------
DROP TABLE IF EXISTS `qry_ls_cash_receive`;
CREATE  VIEW `qry_ls_cash_receive` AS select 'INV' AS `jenis`,`p`.`date_paid` AS `tanggal`,`ih`.`invoice_number` AS `no_bukti`,`p`.`voucher_no` AS `ref`,`p`.`amount_paid` AS `amount_recv`,`ih`.`paid` AS `status`,`c`.`cust_name` AS `cust_name`,`ih`.`posted` AS `posted`,ifnull(`p`.`create_by`,`lam`.`create_by`) AS `create_by`,`u`.`username` AS `username`,`lc`.`area_name` AS `area_name`,`lc`.`counter_name` AS `counter_name`,`ih`.`pokok` AS `pokok`,`p`.`pokok` AS `pokok_paid`,`p`.`bunga` AS `bunga_paid`,`ih`.`bunga` AS `bunga`,`lam`.`dp_prc` AS `dp_prc`,0 AS `z_dp_amount`,0 AS `z_admin_amount`,`p`.`denda` AS `denda_paid`,`ih`.`saldo` AS `saldo`,`ih`.`saldo_titip` AS `saldo_titip`,`ih`.`denda_tagih` AS `denda_tagih`,`p`.`how_paid` AS `payment_method` from ((((((`ls_invoice_payments` `p` left join `ls_invoice_header` `ih` on((`ih`.`invoice_number` = convert(`p`.`invoice_number` using utf8)))) left join `ls_cust_master` `c` on((`c`.`cust_id` = `ih`.`cust_deal_id`))) left join `ls_loan_master` `l` on((`l`.`loan_id` = `ih`.`loan_id`))) left join `ls_app_master` `lam` on((`lam`.`app_id` = `l`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `lam`.`counter_id`))) left join `user` `u` on((`u`.`user_id` = `p`.`create_by`))) union all select 'DP' AS `jenis`,`l`.`loan_date` AS `loan_date`,`m`.`app_id` AS `app_id`,`l`.`loan_id` AS `loan_id`,(`m`.`dp_amount` + `m`.`admin_amount`) AS `m.dp_amount+m.admin_amount`,`m`.`status` AS `status`,`c`.`cust_name` AS `cust_name`,`l`.`posted` AS `posted`,`m`.`create_by` AS `create_by`,`u`.`username` AS `username`,`lc`.`area_name` AS `area_name`,`lc`.`counter_name` AS `counter_name`,0 AS `0`,0 AS `My_exp_0`,0 AS `My_exp_1_0`,0 AS `My_exp_2_0`,`m`.`dp_prc` AS `dp_prc`,`m`.`dp_amount` AS `m_dp_amount`,`m`.`admin_amount` AS `admin_amount`,0 AS `denda_paid`,0 AS `saldo`,0 AS `saldo_titip`,0 AS `denda_tagih`,'Cash' AS `payment_method` from ((((`ls_app_master` `m` left join `ls_cust_master` `c` on((`c`.`cust_id` = `m`.`cust_id`))) left join `ls_loan_master` `l` on((`l`.`app_id` = `m`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `m`.`counter_id`))) left join `user` `u` on((`u`.`user_id` = `m`.`create_by`))) where (`m`.`status` = 'Finish');
-- ----------------------------
-- View structure for c02_qry_payroll_component
-- ----------------------------
DROP TABLE IF EXISTS `qry_payroll_component`;
CREATE  VIEW `qry_payroll_component` AS select 'income' AS `jenis`,`jenis_tunjangan`.`kode` AS `kode`,`jenis_tunjangan`.`keterangan` AS `keterangan`,`jenis_tunjangan`.`sifat` AS `sifat`,`jenis_tunjangan`.`is_variable` AS `is_variable`,`jenis_tunjangan`.`ref_column` AS `ref_column` from `jenis_tunjangan` union all select 'deduct' AS `jenis`,`jenis_potongan`.`kode` AS `kode`,`jenis_potongan`.`keterangan` AS `keterangan`,`jenis_potongan`.`sifat` AS `sifat`,`jenis_potongan`.`is_variable` AS `is_variable`,`jenis_potongan`.`ref_column` AS `ref_column` from `jenis_potongan`;




