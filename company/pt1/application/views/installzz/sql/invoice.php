<?

$table="invoice";

	$sql="
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_number` varchar(20) character set utf8 NOT NULL,
  `invoice_type` varchar(1) character set utf8 default NULL,
  `sales_order_number` varchar(22) character set utf8 default NULL,
  `type_of_invoice` varchar(50) character set utf8 default NULL,
  `account_id` int(11) default NULL,
  `sold_to_customer` varchar(50) character set utf8 default NULL,
  `ship_to_customer` varchar(50) character set utf8 default NULL,
  `invoice_date` datetime default NULL,
  `your_order__` varchar(20) character set utf8 default NULL,
  `source_of_order` varchar(50) character set utf8 default NULL,
  `payment_terms` varchar(20) character set utf8 default NULL,
  `salesman` varchar(30) character set utf8 default NULL,
  `fob` varchar(20) character set utf8 default NULL,
  `shipped_via` varchar(20) character set utf8 default NULL,
  `tax` double default NULL,
  `tax_2` double default NULL,
  `freight` double default NULL,
  `discount` double default NULL,
  `other` double default NULL,
  `paid` int(1) default NULL,
  `comments` varchar(250) default NULL,
  `sales_tax_code` varchar(10) character set utf8 default NULL,
  `sales_tax_percent` double(11,0) default NULL,
  `sales_tax2_code` varchar(10) character set utf8 default NULL,
  `sales_tax_percent_2` double(11,0) default NULL,
  `posted` int(1) default NULL,
  `posting_gl_id` varchar(20) character set utf8 default NULL,
  `batch_post` int(1) default NULL,
  `finance_charge` int(1) default NULL,
  `department` varchar(50) character set utf8 default NULL,
  `truck` varchar(50) character set utf8 default NULL,
  `capacity` varchar(50) character set utf8 default NULL,
  `printed` int(1) default NULL,
  `payment` varchar(50) character set utf8 default NULL,
  `insurance` varchar(50) character set utf8 default NULL,
  `packing` varchar(50) character set utf8 default NULL,
  `discount_2` double(11,0) default NULL,
  `discount_3` double(11,0) default NULL,
  `print_counter` int(11) default NULL,
  `uang_muka` double default NULL,
  `saldo_invoice` double default NULL,
  `amount` double default NULL,
  `disc_amount_1` double default NULL,
  `disc_amount_2` double default NULL,
  `disc_amount_3` double default NULL,
  `total_amount` double default NULL,
  `audit_status` varchar(50) character set utf8 default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `ppn_amount` double default NULL,
  `do_invoiced` int(1) default NULL,
  `your_order_date` datetime default NULL,
  `disc_amount` double default NULL,
  `sales_name` varchar(50) character set utf8 default NULL,
  `promosi_code` varchar(50) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `no_so_text` varchar(200) character set utf8 default NULL,
  `no_po_text` varchar(200) character set utf8 default NULL,
  `currency_code` varchar(50) default NULL,
  `currency_rate` double default NULL,
  `warehouse_code` varchar(50) default NULL,
  `subtotal` double default NULL,
  `due_date` datetime default NULL,
  PRIMARY KEY  (`invoice_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `invoice` (`invoice_number`, `invoice_type`, `sales_order_number`, `type_of_invoice`, `account_id`, `sold_to_customer`, `ship_to_customer`, `invoice_date`, `your_order__`, `source_of_order`, `payment_terms`, `salesman`, `fob`, `shipped_via`, `tax`, `tax_2`, `freight`, `discount`, `other`, `paid`, `comments`, `sales_tax_code`, `sales_tax_percent`, `sales_tax2_code`, `sales_tax_percent_2`, `posted`, `posting_gl_id`, `batch_post`, `finance_charge`, `department`, `truck`, `capacity`, `printed`, `payment`, `insurance`, `packing`, `discount_2`, `discount_3`, `print_counter`, `uang_muka`, `saldo_invoice`, `amount`, `disc_amount_1`, `disc_amount_2`, `disc_amount_3`, `total_amount`, `audit_status`, `org_id`, `update_status`, `ppn_amount`, `do_invoiced`, `your_order_date`, `disc_amount`, `sales_name`, `promosi_code`, `create_date`, `create_by`, `update_date`, `update_by`, `no_so_text`, `no_po_text`, `currency_code`, `currency_rate`, `warehouse_code`, `subtotal`, `due_date`) VALUES
('PJL00106', 'I', '', '', 0, '12019', '', '2014-02-11 00:00:00', '', '', '60 Hari', 'Andri', '', '', 0, 0, 100, 0.5, 200, 0, '', '', 0, '', 0, 0, '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 5003500, 5109800, 0, 0, 0, 0, '', '', 0, 0, 0, '2014-02-11 00:00:00', 0, '', '', '2014-02-11 00:00:00', '', '2014-02-11 00:00:00', '', '', '', '', 0, '', 10219000, '2014-02-11 00:00:00'),
('PJL00101', 'I', '', '', 0, 'C102', '', '2013-08-28 00:00:00', '', '', 'Kredit 30 Hari', 'Andri', '', '', 0, 0, 0, 0, 0, 0, '', '', 0, '', 0, 0, '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 112400, 109000, 0, 0, 0, 0, '', '', 0, 0, 0, '2013-08-28 00:00:00', 0, '', '', '2013-08-28 00:00:00', '', '2013-08-28 00:00:00', '', '', '', '', 0, '', 109000, '2013-08-28 00:00:00'),
('SJ00038', 'D', 'SO00094', NULL, NULL, 'CASH', NULL, '2014-03-25 03:04:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1750000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1750000, '2014-03-25 07:00:00'),
('SJ00015', 'D', 'SO00129', NULL, NULL, '12019', NULL, '2014-03-25 15:47:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-25 07:00:00'),
('SJ00017', 'D', 'SO00158', NULL, NULL, 'Irfan', NULL, '2014-03-25 15:48:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-25 07:00:00'),
('PJL00113', 'I', '', 'Simple', NULL, 'ANDRI', NULL, '2014-03-27 07:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13000, 13000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13000, '2014-03-27 07:00:00');

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();


$table="invoice_delivery_order_info";

$sql="

CREATE TABLE IF NOT EXISTS `invoice_delivery_order_info` (
  `id` int(11) NOT NULL auto_increment,
  `do_number` varchar(50) character set utf8 default NULL,
  `reason_type` varchar(50) character set utf8 default NULL,
  `reason_date` datetime default NULL,
  `comments` varchar(250) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();


$table="invoice_lineitems";

$sql="

CREATE TABLE IF NOT EXISTS `invoice_lineitems` (
  `invoice_number` varchar(50) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `item_number` varchar(50) character set utf8 default NULL,
  `quantity` double(11,0) default NULL,
  `unit` varchar(15) character set utf8 default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `price` double(11,2) default NULL,
  `discount` double(11,2) default NULL,
  `taxable` bit(1) default NULL,
  `shipped` bit(1) default NULL,
  `ship_date` datetime default NULL,
  `ship_qty` double(11,0) default NULL,
  `bo_qty` double(11,0) default NULL,
  `serial_number` varchar(255) character set utf8 default NULL,
  `job_reference` varchar(50) character set utf8 default NULL,
  `comments` double default NULL,
  `cost` double default NULL,
  `color` varchar(20) character set utf8 default NULL,
  `size` varchar(10) character set utf8 default NULL,
  `warehouse_code` varchar(15) character set utf8 default NULL,
  `revenue_acct_id` int(11) default NULL,
  `amount` double default NULL,
  `currency_code` varchar(50) character set utf8 default NULL,
  `currency_rate` double default NULL,
  `discount_amount` double default NULL,
  `quality` varchar(50) character set utf8 default NULL,
  `packing_material` varchar(50) character set utf8 default NULL,
  `multi_unit` varchar(25) character set utf8 default NULL,
  `mu_qty` double(11,0) default NULL,
  `mu_harga` double default NULL,
  `forex_price` double default NULL,
  `base_curr_amount` double default NULL,
  `disc_2` double(11,0) default NULL,
  `disc_amount_2` double default NULL,
  `disc_3` double(11,0) default NULL,
  `disc_amount_3` double default NULL,
  `update_status` int(11) default NULL,
  `ppn_amount` double default NULL,
  `nett_amount` double default NULL,
  `from_line_number` double default NULL,
  `from_line_type` varchar(50) character set utf8 default NULL,
  `from_line_doc` varchar(50) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `discount_addition` int(11) default NULL,
  `printcount` int(11) default NULL,
  `tax_amount` double default NULL,
  `sales_comm_percent` int(11) default NULL,
  `sales_comm_amount` double default NULL,
  `employee_id` varchar(50) character set utf8 default NULL,
  `line_order_type` varchar(50) character set utf8 default NULL,
  `start_time` datetime default NULL,
  `duration_minute` int(11) default NULL,
  `promo` varchar(50) character set utf8 default NULL,
  `coa1` int(11) default NULL,
  `coa2` int(11) default NULL,
  `coa3` int(11) default NULL,
  `coa4` int(11) default NULL,
  `coa5` int(11) default NULL,
  `coa1amt` double default NULL,
  `coa2amt` double default NULL,
  `coa3amt` double default NULL,
  `coa4amt` double default NULL,
  `coa5amt` double default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `sc_amount` double default NULL,
  PRIMARY KEY  (`line_number`),
  KEY `ix_invoice_lineitems_1` (`invoice_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=595 ;
";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="invoice_lineitems";

$sql="

INSERT INTO `invoice_lineitems` (`invoice_number`, `line_number`, `item_number`, `quantity`, `unit`, `description`, `price`, `discount`, `taxable`, `shipped`, `ship_date`, `ship_qty`, `bo_qty`, `serial_number`, `job_reference`, `comments`, `cost`, `color`, `size`, `warehouse_code`, `revenue_acct_id`, `amount`, `currency_code`, `currency_rate`, `discount_amount`, `quality`, `packing_material`, `multi_unit`, `mu_qty`, `mu_harga`, `forex_price`, `base_curr_amount`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `update_status`, `ppn_amount`, `nett_amount`, `from_line_number`, `from_line_type`, `from_line_doc`, `sourceautonumber`, `sourcefile`, `discount_addition`, `printcount`, `tax_amount`, `sales_comm_percent`, `sales_comm_amount`, `employee_id`, `line_order_type`, `start_time`, `duration_minute`, `promo`, `coa1`, `coa2`, `coa3`, `coa4`, `coa5`, `coa1amt`, `coa2amt`, `coa3amt`, `coa4amt`, `coa5amt`, `create_date`, `create_by`, `update_date`, `update_by`, `sc_amount`) VALUES
('PJL00086', 181, 'ABC', 1, 'PCS', 'KOPI SUSU ABC', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 182, 'DJISAMSU', 1, 'Bks', 'Djisamsu Kretek', 12000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 183, 'SAMP', 1, 'Bks', 'Sampoerna Hijau', 8000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 184, 'SLNC', 1, 'Pcs', 'SALON PAS CAIR', 5000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 185, 'ABC', 2, 'PCS', 'KOPI SUSU ABC', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00113', 594, 'SAMP', 1, 'Bks', 'Sampoerna Hijau', 8000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7000, NULL, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();


$table="invoice_serialized_items";

$sql="

CREATE TABLE IF NOT EXISTS `invoice_serialized_items` (
  `id` int(11) NOT NULL auto_increment,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `item_number` varchar(50) character set utf8 default NULL,
  `serial_number` varchar(50) character set utf8 default NULL,
  `month_guaranted` int(11) default NULL,
  `date_activated` datetime default NULL,
  `date_expired` datetime default NULL,
  `comments` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();


$table="invoice_shipment";

$sql="

CREATE TABLE IF NOT EXISTS `invoice_shipment` (
  `id` int(11) NOT NULL auto_increment,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `expeditur` varchar(50) character set utf8 default NULL,
  `jenis_kendaraan` varchar(50) character set utf8 default NULL,
  `nomor_polisi` varchar(50) character set utf8 default NULL,
  `nama_sopir` varchar(50) character set utf8 default NULL,
  `tujuan` varchar(50) character set utf8 default NULL,
  `jumlah_do_induk` int(11) default NULL,
  `qty_do_before` double(11,0) default NULL,
  `qty_do_current` double(11,0) default NULL,
  `qty_do_after` double(11,0) default NULL,
  `tanggal_do_induk` datetime default NULL,
  `nomor_do_induk` varchar(50) character set utf8 default NULL,
  `custkirim_nama` varchar(255) character set utf8 default NULL,
  `custkirim_address1` varchar(255) character set utf8 default NULL,
  `custkirim_address2` varchar(255) character set utf8 default NULL,
  `custkirim_address3` varchar(255) character set utf8 default NULL,
  `custkirim_address4` varchar(255) character set utf8 default NULL,
  `custkirim_address5` varchar(255) character set utf8 default NULL,
  `custterima_nama` varchar(255) character set utf8 default NULL,
  `custterima_address1` varchar(255) character set utf8 default NULL,
  `custterima_address2` varchar(255) character set utf8 default NULL,
  `custterima_address3` varchar(255) character set utf8 default NULL,
  `custterima_address4` varchar(255) character set utf8 default NULL,
  `custterima_address5` varchar(255) character set utf8 default NULL,
  `kota_asal` varchar(50) character set utf8 default NULL,
  `kota_tujuan` varchar(50) character set utf8 default NULL,
  `customer_pengirim` varchar(50) character set utf8 default NULL,
  `customer_penerima` varchar(50) character set utf8 default NULL,
  `kode_rute` varchar(50) character set utf8 default NULL,
  `tagihan_untuk` int(11) default NULL,
  `biaya_dokumen` double default NULL,
  `biaya_pengepakan` double default NULL,
  `biaya_lain` double default NULL,
  `nomor_surat_jalan` double default NULL,
  `nomor_voucher_kas` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="invoice_shipment_export";

$sql="

CREATE TABLE IF NOT EXISTS `invoice_shipment_export` (
  `invoice_number` varchar(50) character set utf8 default NULL,
  `lc_no` varchar(50) character set utf8 default NULL,
  `issuing_bank` varchar(50) character set utf8 default NULL,
  `feeder_vessel` varchar(50) character set utf8 default NULL,
  `mother_vessel` varchar(50) character set utf8 default NULL,
  `port_of_loading` varchar(50) character set utf8 default NULL,
  `destination` varchar(50) character set utf8 default NULL,
  `flight` varchar(50) character set utf8 default NULL,
  `carrier_by` varchar(50) character set utf8 default NULL,
  `shipping_marks` varchar(50) character set utf8 default NULL,
  `notes` varchar(100) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="invoice_tax_serial";

$sql="

CREATE TABLE IF NOT EXISTS `invoice_tax_serial` (
  `id` int(11) NOT NULL auto_increment,
  `nofaktur` varchar(50) character set utf8 default NULL,
  `noseripajak` varchar(50) character set utf8 default NULL,
  `tanggalpajak` datetime default NULL,
  `customernumber` varchar(50) character set utf8 default NULL,
  `customernpwp` varchar(50) character set utf8 default NULL,
  `customernppkp` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `ship_to` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="kas_kasir";

$sql="

CREATE TABLE IF NOT EXISTS `kas_kasir` (
  `comno` varchar(10) character set utf8 default NULL,
  `tanggal` datetime default NULL,
  `jumlah` double default NULL,
  `supervisor` varchar(50) character set utf8 default NULL,
  `jmlakhir` double default NULL,
  `update_status` int(11) default NULL,
  `kasir` varchar(50) character set utf8 default NULL,
  `shift` varchar(50) character set utf8 default NULL,
  `catatan` varchar(255) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

$table="kendaraan";

$sql="

CREATE TABLE IF NOT EXISTS `kendaraan` (
  `kode` varchar(50) character set utf8 NOT NULL,
  `nomor_plat` varchar(50) character set utf8 default NULL,
  `nama_supir` varchar(50) character set utf8 default NULL,
  `kapasitas` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `merk` varchar(50) character set utf8 default NULL,
  `bpkb_no` varchar(50) character set utf8 default NULL,
  `bpkb_name` varchar(50) character set utf8 default NULL,
  `model` varchar(50) character set utf8 default NULL,
  `colour` varchar(50) character set utf8 default NULL,
  `bpkb_address` varchar(250) character set utf8 default NULL,
  `stnk_date` datetime default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
	if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();
 

	
	?>