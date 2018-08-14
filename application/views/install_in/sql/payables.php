<?

$table="payables";

	$sql="

CREATE TABLE IF NOT EXISTS `".$cid."payables` (
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
  PRIMARY KEY  (`bill_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;
";
if($link->query($sql))echo mysqli_error($link);
	$table="payables";

$sql="

INSERT INTO `".$cid."payables` (`bill_id`, `vendor_type`, `supplier_number`, `other_number`, `purchase_order`, `purchase_order_number`, `expense_type`, `account_id`, `invoice_number`, `invoice_date`, `amount`, `due_date`, `terms`, `discount_taken`, `purpose_of_expense`, `tax_deductible`, `comments`, `paid`, `posted`, `posting_gl_id`, `batch_post`, `X1099`, `invoice_received`, `items_received`, `many_po`, `curr_code`, `curr_rate`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `saldo_invoice`) VALUES
(1, NULL, 'ALFAMART', NULL, 1, '0', 'Purchase Order', 0, '0', '2012-11-25 00:00:00', 0, '2012-11-25 00:00:00', 'Kredit', 0, 'Purchase Order', 0, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 'KS', NULL, 1, 'PI00003', 'Purchase Order', NULL, 'PI00003', '2013-08-18 00:00:00', 92000, NULL, 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, 'YOGYA', NULL, 1, 'PO00118', 'Purchase Order', NULL, 'PO00118', '2014-03-25 07:00:00', 1000, '2014-03-25 07:00:00', 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, 'YOGYA', NULL, 1, 'PO00152', 'Purchase Order', NULL, 'PO00152', '2014-03-25 07:00:00', 1000, '2014-03-25 07:00:00', 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if($link->query($sql))echo mysqli_error($link);
	$table="payables_items";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."payables_items` (
  `bill_id` int(11) default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);

	$table="payables_many_po";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."payables_many_po` (
  `bill_id` int(11) default NULL,
  `purchase_order_number` varchar(50) character set utf8 default NULL,
  `payment_amount` double default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))echo mysqli_error($link);
	$table="payables_payments";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."payables_payments` (
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
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;
";
if($link->query($sql))echo mysqli_error($link);

	$table="payables_payments";

$sql="

INSERT INTO `".$cid."payables_payments` (`bill_id`, `line_number`, `date_paid`, `how_paid`, `how_paid_account_id`, `check_number`, `amount_paid`, `amount_alloc`, `trans_id`, `curr_code`, `curr_rate`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `purchase_order_number`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `no_bukti`, `paid_by`) VALUES
(1, 1, '2013-01-04 00:00:00', 'CASH OUT', 0, '', 6000, 0, 1, 'IDR', 1, NULL, NULL, NULL, 'PBL00115', NULL, NULL, NULL, NULL, 'APP00039', ''),
(0, 17, '2013-08-18 00:00:00', 'Cash', NULL, NULL, 190000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FBC0100004', NULL, NULL, NULL, NULL, 'APP00050', NULL),
(1, 12, '2013-08-17 00:00:00', 'Cash', NULL, NULL, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PBL00115', NULL, NULL, NULL, NULL, 'APP00045', NULL),
(0, 16, '2013-08-17 00:00:00', 'Giro', NULL, NULL, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PI00002', NULL, NULL, NULL, NULL, 'APP00049', NULL),
(1, 14, '2013-08-17 00:00:00', 'Cash', NULL, NULL, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PBL00115', NULL, NULL, NULL, NULL, 'APP00047', NULL),
(57, 33, '2014-03-24 07:00:00', '0', 1374, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PI00014', NULL, NULL, NULL, NULL, 'APP00066', NULL),
(57, 34, '2014-03-24 07:00:00', '1', 0, NULL, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PI00014', NULL, NULL, NULL, NULL, 'APP00067', NULL);
";
	if($link->query($sql))echo mysqli_error($link);	
?>