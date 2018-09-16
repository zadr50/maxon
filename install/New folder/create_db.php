<?
//start creating tables
 
error_reporting(E_ALL);

include "koneksi.php";

$nomor=$_GET['nomor'];
$mag="";
$sql="";
switch($nomor){
case 1:
	$table="bank_accounts";
	$sql="CREATE TABLE IF NOT EXISTS `bank_accounts` (
	  `bank_account_number` varchar(50) character set utf8 NOT NULL default '',
	  `type_bank` varchar(50) character set utf8 default NULL,
	  `bank_name` varchar(50) character set utf8 default NULL,
	  `aba_number` varchar(50) character set utf8 default NULL,
	  `routing_code` varchar(15) character set utf8 default NULL,
	  `street` varchar(50) character set utf8 default NULL,
	  `suite` varchar(50) character set utf8 default NULL,
	  `city` varchar(50) character set utf8 default NULL,
	  `state_province` varchar(50) character set utf8 default NULL,
	  `zip_postal_code` varchar(50) character set utf8 default NULL,
	  `country` varchar(50) character set utf8 default NULL,
	  `contact_name` varchar(50) character set utf8 default NULL,
	  `phone_number` varchar(50) character set utf8 default NULL,
	  `fax_number` varchar(50) character set utf8 default NULL,
	  `starting_check_number` varchar(50) character set utf8 default NULL,
	  `last_bank_statement_date` datetime default NULL,
	  `last_bank_statement_balance` double default NULL,
	  `account_id` int(50) default NULL,
	  `micr_line` varchar(40) character set utf8 default NULL,
	  `no_bukti_in` varchar(50) character set utf8 default NULL,
	  `no_bukti_out` varchar(50) character set utf8 default NULL,
	  `org_id` varchar(50) character set utf8 default NULL,
	  `update_status` varchar(50) character set utf8 default NULL,
	  PRIMARY KEY  (`bank_account_number`),
	  KEY `x1` (`bank_account_number`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

	$table="bank_accounts";
	$sql="
	INSERT INTO `bank_accounts` (`bank_account_number`, `type_bank`, `bank_name`, `aba_number`, `routing_code`, `street`, `suite`, `city`, `state_province`, `zip_postal_code`, `country`, `contact_name`, `phone_number`, `fax_number`, `starting_check_number`, `last_bank_statement_date`, `last_bank_statement_balance`, `account_id`, `micr_line`, `no_bukti_in`, `no_bukti_out`, `org_id`, `update_status`) 
	VALUES('BCA', 'D', 'BCA', '', '', 'JL. RAYA PURWAKARTA NO. 38 a', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, 0, '', 'A', 'B', '', ''),
	('BNI', 'Bank', 'BNI', '', '', 'JL. RAYA PURWAKARTA NO. 38', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, 1374, '', 'A', 'B', '', ''),
	('BRI', 'Bank', 'BRI', '', '', 'JL. RAYA PURWAKARTA NO. 38', '', '', '', '', '', '', '', '', '', '2013-08-12 00:00:00', 0, 0, '', '', '', '', '')
	";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 4:
	$table="bill_detail";

$sql="CREATE TABLE IF NOT EXISTS `bill_detail` (
  `id` int(11) NOT NULL auto_increment,
  `bill_id` varchar(50) character set utf8 default NULL,
  `no` varchar(50) character set utf8 default NULL,
  `tanggal` datetime default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `keterangan` varchar(100) character set utf8 default NULL,
  `amount` double default NULL,
  `tgl_jatuh_tempo` datetime default NULL,
  `curr_code` varchar(50) character set utf8 default NULL,
  `curr_rate` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 5:
	$table="bill_header";

$sql="CREATE TABLE IF NOT EXISTS `bill_header` (
  `bill_id` varchar(50) character set utf8 NOT NULL default '',
  `customer_number` varchar(50) character set utf8 default NULL,
  `bill_date` datetime default NULL,
  `amount` double default NULL,
  `date_to` datetime default NULL,
  `comments` varchar(255) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`bill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 6:
	$table="budget";

$sql="CREATE TABLE IF NOT EXISTS `budget` (
  `account_id` int(11) default NULL,
  `budget_year` int(11) default NULL,
  `january` double default NULL,
  `february` double default NULL,
  `march` double default NULL,
  `april` double default NULL,
  `may` double default NULL,
  `june` double default NULL,
  `july` double default NULL,
  `august` double default NULL,
  `september` double default NULL,
  `october` double default NULL,
  `november` double default NULL,
  `december` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  KEY `x1` (`account_id`,`budget_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 7:
	$table="chart_account_link";

$sql="CREATE TABLE IF NOT EXISTS `chart_account_link` (
  `company_code` varchar(50) character set utf8 NOT NULL default '',
  `hutang` int(11) default NULL,
  `penerimaan` int(11) default NULL,
  `piutang` int(11) default NULL,
  `pembayaran` int(11) default NULL,
  `laba_periode` int(11) default NULL,
  `laba_ditahan` int(11) default NULL,
  `historical_balancing` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";

	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 8:
	$table="chart_bank_accounts";

$sql="CREATE TABLE IF NOT EXISTS `chart_of_accounts` (
  `id` int(11) NOT NULL auto_increment,
  `company_code` varchar(15) character set utf8 default NULL,
  `account_type` double default NULL,
  `group_type` varchar(10) character set utf8 default NULL,
  `group_sequence` double default NULL,
  `account` varchar(20) character set utf8 default NULL,
  `account_description` varchar(50) character set utf8 default NULL,
  `sub_account` varchar(8) character set utf8 default NULL,
  `sub_account_description` varchar(50) character set utf8 default NULL,
  `beginning_balance` double default NULL,
  `notes` double default NULL,
  `db_or_cr` int(11) default NULL,
  `flag_archive` bit(1) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  KEY `x1` (`account`),
  KEY `x2` (`account_description`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1505 ;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 9:
	$table="chart_of_account_types";

$sql="
CREATE TABLE IF NOT EXISTS `chart_of_account_types` (
  `account_type_num` double NOT NULL default '0',
  `account_type` varchar(30) character set utf8 default NULL,
  `income_statement_num` int(11) default NULL,
  `sub_acc_income` int(11) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`account_type_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
INSERT INTO `chart_of_account_types` (`account_type_num`, `account_type`, `income_statement_num`, `sub_acc_income`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
(1, 'Aktiva', NULL, NULL, NULL, NULL, NULL),
(2, 'Hutang', NULL, NULL, NULL, NULL, NULL),
(3, 'Modal', NULL, NULL, NULL, NULL, NULL),
(4, 'Pendapatan', NULL, NULL, NULL, NULL, NULL),
(5, 'Harga Pokok', NULL, NULL, NULL, NULL, NULL),
(6, 'Biaya', NULL, NULL, NULL, NULL, NULL),
(7, 'Pendapatan Lain', NULL, NULL, NULL, NULL, NULL),
(8, 'Baya Lain', NULL, NULL, NULL, NULL, NULL);
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 10:
	$table="check_writer";

	$sql="
CREATE TABLE IF NOT EXISTS `check_writer` (
  `trans_id` int(11) NOT NULL auto_increment,
  `trans_type` varchar(50) character set utf8 default NULL,
  `account_number` varchar(50) character set utf8 default NULL,
  `check_number` varchar(50) character set utf8 default NULL,
  `check_date` datetime default NULL,
  `payee` varchar(50) character set utf8 default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `payment_amount` double default NULL,
  `deposit_amount` double default NULL,
  `memo` varchar(150) character set utf8 default NULL,
  `cleared` int(1) default NULL,
  `cleared_date` datetime default NULL,
  `void` int(1) default NULL,
  `print` int(1) default NULL,
  `voucher` varchar(50) character set utf8 default NULL,
  `adjustment_dr_account_id` int(11) default NULL,
  `adjustment_cr_account_id` int(11) default NULL,
  `bill_payment` int(1) default NULL,
  `posting_gl_id` varchar(20) character set utf8 default NULL,
  `posted` int(1) default NULL,
  `printed` datetime default NULL,
  `batch_post` int(1) default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `paymentlineid` int(11) default NULL,
  `from_bank` varchar(50) character set utf8 default NULL,
  `bank_tran_id` varchar(50) character set utf8 default NULL,
  `curr_code` varchar(50) character set utf8 default NULL,
  `curr_rate` double default NULL,
  `curr_rate_exc` double default NULL,
  `curr_code_org` varchar(50) character set utf8 default NULL,
  `curr_rate_org` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `jenisuangmuka` varchar(50) character set utf8 default NULL,
  `sisauangmuka` double default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY  (`trans_id`),
  KEY `x1` (`payee`),
  KEY `x2` (`voucher`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `check_writer_deposit_detail` (
  `trans_id` int(11) default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_number` varchar(50) character set utf8 default NULL,
  `routing_code` varchar(20) character set utf8 default NULL,
  `check_number` varchar(50) character set utf8 default NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `check_writer_items` (
  `trans_id` int(11) default NULL,
  `trans_type` varchar(200) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `comments` varchar(200) character set utf8 default NULL,
  `account` varchar(50) character set utf8 default NULL,
  `description` varchar(200) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `invoice_number` varchar(50) default NULL,
  `ref1` varchar(50) default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `check_writer_print_settings` (
  `id` int(11) NOT NULL auto_increment,
  `check_position` double default NULL,
  `check_type` double default NULL,
  `paper_type` double default NULL,
  `print_all_info` bit(1) default NULL,
  `print_check_num` bit(1) default NULL,
  `print_check_stub` bit(1) default NULL,
  `print_company_info` bit(1) default NULL,
  `print_bank_info` bit(1) default NULL,
  `print_payee_address` bit(1) default NULL,
  `print_micr` bit(1) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$ql="
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payments` (
  `payment_number` int(11) default NULL,
  `bank_account_number` varchar(50) character set utf8 default NULL,
  `payee` varchar(50) character set utf8 default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `payment_amount` double default NULL,
  `memo` varchar(150) character set utf8 default NULL,
  `voucher` double default NULL,
  `frequency` varchar(20) character set utf8 default NULL,
  `selected` bit(1) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payment_items` (
  `payment_number` int(11) default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `check_writer_undeposited_checks` (
  `payment_date` datetime default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `check_number` varchar(50) character set utf8 default NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `amount` double default NULL,
  `selected` bit(1) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 11:
	$table="city";

$sql="

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` varchar(50) character set utf8 NOT NULL default '',
  `city_name` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `crdb_memo` (
  `linenumber` int(11) NOT NULL auto_increment,
  `transtype` varchar(50) character set utf8 default NULL,
  `tanggal` datetime default NULL,
  `docnumber` varchar(50) character set utf8 NOT NULL default '',
  `amount` double default NULL,
  `keterangan` varchar(255) character set utf8 default NULL,
  `kodecrdb` varchar(15) character set utf8 default NULL,
  `posted` int(1) default NULL,
  `accountid` int(11) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY  (`linenumber`,`docnumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `crdb_memo_dtl` (
  `lineid` int(11) NOT NULL auto_increment,
  `kodecrdb` varchar(15) character set utf8 default NULL,
  `accountid` int(11) default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `update_date` datetime default NULL,
  PRIMARY KEY  (`lineid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `credit_card_type` (
  `id` int(11) NOT NULL auto_increment,
  `card_type` varchar(255) character set utf8 NOT NULL default '',
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `card_name` varchar(255) character set utf8 default NULL,
  `to_date` datetime default NULL,
  `from_date` datetime default NULL,
  `disc_percent` int(11) default NULL,
  PRIMARY KEY  (`id`,`card_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

INSERT INTO `credit_card_type` (`id`, `card_type`, `update_status`, `sourceautonumber`, `sourcefile`, `card_name`, `to_date`, `from_date`, `disc_percent`) VALUES
(1, 'Citibank', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Mandiri Visa', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Mandiri Master', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Amex', NULL, NULL, NULL, 'Amex Card', '2010-02-11 00:00:00', '2009-07-24 00:00:00', 10);
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `currencies` (
  `currency_code` varchar(50) character set utf8 NOT NULL,
  `description` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`currency_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `currencies` (`currency_code`, `description`, `update_status`) VALUES
('IDR', 'Rupiah', NULL),
('USD', 'Dollar', NULL);
";

	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 12:
	$table="customers";

	$sql="

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_number` varchar(50) character set utf8 NOT NULL,
  `active` int(1) default NULL,
  `customer_record_type` varchar(50) character set utf8 default NULL,
  `type_of_customer` varchar(50) character set utf8 default NULL,
  `region` varchar(20) character set utf8 default NULL,
  `salutation` varchar(50) character set utf8 default NULL,
  `first_name` varchar(50) character set utf8 default NULL,
  `middle_initial` varchar(5) character set utf8 default NULL,
  `last_name` varchar(50) character set utf8 default NULL,
  `company` varchar(50) character set utf8 default NULL,
  `street` varchar(255) character set utf8 default NULL,
  `suite` varchar(50) character set utf8 default NULL,
  `city` varchar(50) character set utf8 default NULL,
  `state` varchar(50) character set utf8 default NULL,
  `zip_postal_code` varchar(10) character set utf8 default NULL,
  `country` varchar(20) character set utf8 default NULL,
  `phone` varchar(20) character set utf8 default NULL,
  `fax` varchar(20) character set utf8 default NULL,
  `other_phone` varchar(20) character set utf8 default NULL,
  `email` varchar(50) character set utf8 default NULL,
  `tax_exempt` int(1) default NULL,
  `sales_tax_code` varchar(10) character set utf8 default NULL,
  `sales_tax2_code` varchar(10) character set utf8 default NULL,
  `credit_limit` double default NULL,
  `discount_percent` double(11,0) default NULL,
  `markup_percent` double(11,0) default NULL,
  `credit_balance` double default NULL,
  `pricing_type` varchar(10) character set utf8 default NULL,
  `code` varchar(10) character set utf8 default NULL,
  `comments` double default NULL,
  `payment_terms` varchar(20) character set utf8 default NULL,
  `credithold` int(1) default NULL,
  `salesman` varchar(50) character set utf8 default NULL,
  `shipped_via` varchar(50) character set utf8 default NULL,
  `route_delivery_code` varchar(15) character set utf8 default NULL,
  `route_delivery_sequence` int(11) default NULL,
  `route_delivery_day` varchar(15) character set utf8 default NULL,
  `finance_charges` bit(1) default NULL,
  `last_finance_charge_date` datetime default NULL,
  `finance_charge_acct` int(11) default NULL,
  `finance_charge_pct` double default NULL,
  `bill_to_customer_number` varchar(15) character set utf8 default NULL,
  `current_balance` double default NULL,
  `npwp` varchar(50) character set utf8 default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `nppkp` varchar(50) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `password` varchar(50) default NULL,
  `limi_date` datetime default NULL,
  PRIMARY KEY  (`customer_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `customers` (`customer_number`, `active`, `customer_record_type`, `type_of_customer`, `region`, `salutation`, `first_name`, `middle_initial`, `last_name`, `company`, `street`, `suite`, `city`, `state`, `zip_postal_code`, `country`, `phone`, `fax`, `other_phone`, `email`, `tax_exempt`, `sales_tax_code`, `sales_tax2_code`, `credit_limit`, `discount_percent`, `markup_percent`, `credit_balance`, `pricing_type`, `code`, `comments`, `payment_terms`, `credithold`, `salesman`, `shipped_via`, `route_delivery_code`, `route_delivery_sequence`, `route_delivery_day`, `finance_charges`, `last_finance_charge_date`, `finance_charge_acct`, `finance_charge_pct`, `bill_to_customer_number`, `current_balance`, `npwp`, `org_id`, `update_status`, `nppkp`, `create_date`, `create_by`, `update_date`, `update_by`, `password`, `limi_date`) VALUES
('C102', 1, '', '', '', '', '', '', '', 'Dedy Mizwar', 'JL. RAYA SADANG NO. 29', '', 'Purwakarta', '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, 0, '', '', 0, 'Kredit 30 Hari', 0, '', '', '', 0, '', b'0', '2014-03-02 00:00:00', 1373, 0, '', 0, '', '', 0, '', '2014-03-02 00:00:00', '', '2014-03-02 00:00:00', '', '', '2014-03-02 00:00:00'),
('12019', 0, '', '', '', '', '', '', '', 'Ida Royani', 'JL. RAYA SUBANG NO. 20 PURWAKARTA', '', 'Purwakarta', '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, 0, '', '', 0, '', 0, '', '', '', 0, '', b'0', '2013-08-31 00:00:00', 0, 0, '', 0, '', '', 0, '', '2013-08-31 00:00:00', '', '2013-08-31 00:00:00', '', '', '2013-08-31 00:00:00'),
('NUR A', 1, '', '', '', '', '', '', '', 'NUR AZIZAH SOLIHATI', 'JL. BAITURAHMAN', 'LHOKSEUMAWE', 'Aceh', '', '', '', '', '', '', 'nur_a@yahoo.co.id', 0, '', '', 0, 0, 0, 0, '', '', 0, '60 Hari', 0, '', '', '', 0, '', b'0', '2013-08-31 00:00:00', 1373, 0, '', 0, '', '', 0, '', '2013-08-31 00:00:00', '', '2013-08-31 00:00:00', '', '', '2013-08-31 00:00:00'),
('Irfan', 1, '', '', '', '', '', '', '', 'Irfan Hakim', 'Jl. Raya Serang Km. 200', 'Gedung Artha Guna', 'Jakarta', '', '', '', '', '', '', 'irfan@yahoo.com', 0, '', '', 0, 0, 0, 0, '', '', 0, '60 Hari', 0, '', '', '', 0, '', b'0', '2014-03-02 00:00:00', 1373, 0, '', 0, '', '', 0, '', '2014-03-02 00:00:00', '', '2014-03-02 00:00:00', '', '', '2014-03-02 00:00:00'),
('UDIN', 1, '', '', '', '', '', '', '', 'UDIN SURUDIN', 'JL. RAYA PURWAKARTA NO. 38', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, 0, '', '', 0, '60 Hari', 0, '', '', '', 0, '', b'0', '2014-03-02 00:00:00', 1373, 0, '', 0, '', '', 0, '', '2014-03-02 00:00:00', '', '2014-03-02 00:00:00', '', '', '2014-03-02 00:00:00'),
('ANDRI', 1, '', '', '', '', '', '', '', 'ANDRI', 'JL. RAYA PURWAKARTA NO. 38', 'Gedung Indofood lantai 20', '', '', '', 'Indonesia', '62212002992', '0299200111', '', 'zadr50@yahoo.com', 0, '', '', 0, 0, 0, 0, '', '', 0, 'Kredit 30 Hari', 0, '', '', '', 0, '', b'1', '2013-07-19 00:00:00', 1373, 1396, '', 0, '', '', 0, '', '2013-07-19 00:00:00', '', '2013-07-19 00:00:00', '', '', NULL),
('CASH', 0, '', '', '', '', '', '', '', 'CASH', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, 0, '', '', 0, '', 0, '', '', '', 0, '', b'0', '2014-03-02 00:00:00', 1370, 0, '', 0, '', '', 0, '', '2014-03-02 00:00:00', '', '2014-03-02 00:00:00', '', '', '2014-03-02 00:00:00'),
('C1021', 1, '', '', '', '', '', '', '', 'ADI BIN SLAMET', 'Jl. Raya Serang Km. 200', '', 'Purwakarta', '', '', '', '0264-9399393', '0299200111', '', 'zadr50@yahoo.com', 0, '', '', 0, 0, 0, 0, '', '', 0, '60 Hari', 0, '', '', '', 0, '', b'0', '2014-03-02 00:00:00', 1373, 0, '', 0, '', '', 0, '', '2014-03-02 00:00:00', '', '2014-03-02 00:00:00', '', '', '2014-03-02 00:00:00'),
('aaa', 1, '', '', '', '', '', '', '', 'dfasfs', 'dfasdf', 'dfasdf', 'Purwakarta', '', '', '', '', '', '', 'dfasd', 0, '', '', 0, 0, 0, 0, '', '', 0, 'Kredi 90 Hari', 0, '', '', '', 0, '', b'0', '2014-03-16 00:00:00', 1373, 0, '', 0, '', '', 0, '', '2014-03-16 00:00:00', '', '2014-03-16 00:00:00', '', '', '2014-03-16 00:00:00');
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `customers_other_info` (
  `cust_code` varchar(50) character set utf8 NOT NULL,
  `disc_percent` int(11) default NULL,
  `disc_from_date` datetime default NULL,
  `disc_to_date` datetime default NULL,
  `join_date` datetime default NULL,
  `expire_date` datetime default NULL,
  `disc_amount` double default NULL,
  `min_sales` double default NULL,
  `birth_date` datetime default NULL,
  PRIMARY KEY  (`cust_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
 
$sql="

CREATE TABLE IF NOT EXISTS `customer_beginning_balance` (
  `tanggal` datetime NOT NULL default '0000-00-00 00:00:00',
  `customer_number` varchar(50) character set utf8 NOT NULL default '',
  `piutang_awal` double default NULL,
  `piutang` double default NULL,
  `piutang_akhir` double default NULL,
  `amountin` double default NULL,
  `amountout` double default NULL,
  `flagawal` bit(1) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`tanggal`,`customer_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `customer_shipto` (
  `customer_code` varchar(50) character set utf8 default NULL,
  `location_code` varchar(50) character set utf8 default NULL,
  `alamat` varchar(255) character set utf8 default NULL,
  `kota` varchar(50) character set utf8 default NULL,
  `kode_pos` varchar(50) character set utf8 default NULL,
  `telp` varchar(50) character set utf8 default NULL,
  `fax` varchar(50) character set utf8 default NULL,
  `contact` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

 
$sql="

CREATE TABLE IF NOT EXISTS `customer_statement_defaults` (
  `id` int(11) NOT NULL auto_increment,
  `aging_date` datetime default NULL,
  `from_date` datetime default NULL,
  `to_date` varchar(50) character set utf8 default NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `print_type` int(11) default NULL,
  `number_of_copies` int(11) default NULL,
  `statement_type` int(11) default NULL,
  `customer_range` int(11) default NULL,
  `print_dunning_messages` bit(1) default NULL,
  `minimum_past_due_amount` double default NULL,
  `minimum_invoice_age` double default NULL,
  `minimum_customer_balance` double default NULL,
  `print_zero_balances` bit(1) default NULL,
  `print_credit_balances` bit(1) default NULL,
  `current_message` varchar(200) character set utf8 default NULL,
  `over_30_message` varchar(200) character set utf8 default NULL,
  `over_60_message` varchar(200) character set utf8 default NULL,
  `over_90_message` varchar(200) character set utf8 default NULL,
  `over_120_message` varchar(200) character set utf8 default NULL,
  `paymentdisplay` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 13:
	$table="department";

$sql="

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL auto_increment,
  `dept_code` varchar(50) character set utf8 default NULL,
  `dept_name` varchar(50) character set utf8 default NULL,
  `company_code` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`dept_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 14:
	$table="employee";

	$sql="

CREATE TABLE IF NOT EXISTS `employee` (
  `nip` varchar(50) character set utf8 NOT NULL,
  `nama` varchar(50) character set utf8 default NULL,
  `tgllahir` datetime default NULL,
  `agama` varchar(12) character set utf8 default NULL,
  `kelamin` varchar(1) character set utf8 default NULL,
  `status` varchar(12) character set utf8 default NULL,
  `idktpno` varchar(20) character set utf8 default NULL,
  `hireddate` datetime default NULL,
  `dept` varchar(50) character set utf8 default NULL,
  `divisi` varchar(50) character set utf8 default NULL,
  `level` varchar(50) character set utf8 default NULL,
  `position` varchar(50) character set utf8 default NULL,
  `supervisor` varchar(50) character set utf8 default NULL,
  `payperiod` varchar(50) character set utf8 default NULL,
  `alamat` varchar(100) character set utf8 default NULL,
  `kodepos` varchar(50) character set utf8 default NULL,
  `telpon` varchar(12) character set utf8 default NULL,
  `hp` varchar(25) character set utf8 default NULL,
  `gp` double default NULL,
  `tjabatan` double default NULL,
  `ttransport` double default NULL,
  `tmakan` double default NULL,
  `incentive` double default NULL,
  `sc` double(11,0) default NULL,
  `rateot` double default NULL,
  `tkesehatan` double default NULL,
  `tlain` double default NULL,
  `bjabatang` double default NULL,
  `iurantht` double default NULL,
  `blain` double default NULL,
  `emptype` varchar(20) character set utf8 default NULL,
  `emplevel` varchar(20) character set utf8 default NULL,
  `pathimage` varchar(200) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `nip_id` varchar(50) default NULL,
  `npwp` varchar(50) default NULL,
  `bank_name` varchar(50) default NULL,
  `account` varchar(50) default NULL,
  `tempat_lahir` varchar(50) default NULL,
  `pendidikan` varchar(50) default NULL,
  `gol_darah` varchar(50) default NULL,
  PRIMARY KEY  (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employeeeducations` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `educationlevel` varchar(255) character set utf8 default NULL,
  `school` varchar(255) character set utf8 default NULL,
  `place` varchar(255) character set utf8 default NULL,
  `major` varchar(255) character set utf8 default NULL,
  `enteryear` int(11) default NULL,
  `graduationyear` int(11) default NULL,
  `yearofattend` varchar(255) character set utf8 default NULL,
  `graduate` bit(1) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employeeexperience` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `company` varchar(255) character set utf8 default NULL,
  `startdate` varchar(255) character set utf8 default NULL,
  `finishdate` varchar(255) character set utf8 default NULL,
  `firstposition` varchar(255) character set utf8 default NULL,
  `endposition` varchar(255) character set utf8 default NULL,
  `place` varchar(255) character set utf8 default NULL,
  `lastsalary` varchar(255) character set utf8 default NULL,
  `supervisor` varchar(255) character set utf8 default NULL,
  `referencename` varchar(255) character set utf8 default NULL,
  `referencephone` varchar(255) character set utf8 default NULL,
  `reasontoleave` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

CREATE TABLE IF NOT EXISTS `employeefamily` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `familyname` varchar(255) character set utf8 default NULL,
  `relationship` varchar(255) character set utf8 default NULL,
  `age` datetime default NULL,
  `education` varchar(255) character set utf8 default NULL,
  `job` varchar(255) character set utf8 default NULL,
  `mariagestatus` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

CREATE TABLE IF NOT EXISTS `employeelicense` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `licensenumber` varchar(255) character set utf8 default NULL,
  `lincensetype` varchar(255) character set utf8 default NULL,
  `startdate` datetime default NULL,
  `finishdate` datetime default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employeemedical` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `medicaldate` datetime default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employeerewardpunish` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `daterp` datetime default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `rankinglevel` varchar(255) character set utf8 default NULL,
  `typerp` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employeeskill` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `skillname` varchar(255) character set utf8 default NULL,
  `skilllevel` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employeetraining` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `trainingname` varchar(255) character set utf8 default NULL,
  `traningdate` varchar(255) character set utf8 default NULL,
  `place` varchar(255) character set utf8 default NULL,
  `topic` varchar(255) character set utf8 default NULL,
  `certificate` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employee_level` (
  `levelkode` varchar(50) character set utf8 NOT NULL,
  `levelname` varchar(50) character set utf8 default NULL,
  `creationdate` datetime default NULL,
  `keterangan` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`levelkode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `employee_type` (
  `kode` varchar(50) character set utf8 NOT NULL,
  `description` varchar(10) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `er_code` varchar(50) character set utf8 default NULL,
  `sourcecurrency` varchar(50) character set utf8 default NULL,
  `targetcurrency` varchar(50) character set utf8 default NULL,
  `currency_rate` double default NULL,
  `last_update` datetime default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";

	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 15:
	$table="fixed_asset";

	$sql="

CREATE TABLE IF NOT EXISTS `fa_asset` (
  `id` varchar(50) character set utf8 NOT NULL,
  `description` varchar(50) character set utf8 default NULL,
  `group_id` varchar(50) character set utf8 default NULL,
  `location_id` varchar(50) character set utf8 default NULL,
  `cost_centre_id` varchar(50) character set utf8 default NULL,
  `custodian_id` varchar(50) character set utf8 default NULL,
  `vendor_id` varchar(50) character set utf8 default NULL,
  `sn` varchar(50) character set utf8 default NULL,
  `acquisition_date`  datetime  default NULL,
  `acquisition_cost` double default NULL,
  `warranty_date` datetime default NULL,
  `depn_method` int(11) default NULL,
  `useful_lives` int(11) default NULL,
  `salvage_value` int(11) default NULL,
  `private_use` int(11) default NULL,
  `journal_id` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

CREATE TABLE IF NOT EXISTS `fa_asset_depreciation` (
  `asset_id` varchar(10) character set utf8 default NULL,
  `depn_year` int(11) default NULL,
  `depn_month` int(11) default NULL,
  `depn_id` int(11) default NULL,
  `acquisition_cost` double default NULL,
  `depn_exp` double default NULL,
  `accum_depn` double default NULL,
  `book_value` double default NULL,
  `journal_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `fa_asset_depreciation_schedule` (
  `asset_id` varchar(10) character set utf8 default NULL,
  `depn_year` int(11) default NULL,
  `depn_id` int(11) default NULL,
  `acquisition_cost` double default NULL,
  `depn_exp` double default NULL,
  `accum_depn` double default NULL,
  `book_value` double default NULL,
  `posted` bit(1) default NULL,
  `glid` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

CREATE TABLE IF NOT EXISTS `fa_asset_group` (
  `id` varchar(50) character set utf8 NOT NULL,
  `name` varchar(50) character set utf8 default NULL,
  `at_cost` int(11) default NULL,
  `accum_depn` int(11) default NULL,
  `profit_on_sale` int(11) default NULL,
  `loss_on_sale` int(11) default NULL,
  `cash_bank` int(11) default NULL,
  `depn_method` int(11) default NULL,
  `useful_lives` int(11) default NULL,
  `salvage_value` int(11) default NULL,
  `expenses_depn` int(11) default NULL,
  `update_status` int(11) default NULL,
  `warranty_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `fa_asset_service_log` (
  `id` int(50) NOT NULL auto_increment,
  `asset_id` varchar(10) character set utf8 default NULL,
  `service_date` datetime default NULL,
  `service_provider_id` double default NULL,
  `service_contract` varchar(20) character set utf8 default NULL,
  `service_cost` double default NULL,
  `notes` varchar(200) character set utf8 default NULL,
  `next_service_due` varchar(8) character set utf8 default NULL,
  `journal_id` varchar(50) character set utf8 default NULL,
  `posted` bit(1) default NULL,
  `debit_account_id` double default NULL,
  `credit_account_id` double default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

CREATE TABLE IF NOT EXISTS `fa_asset_transaction` (
  `id` int(50) NOT NULL auto_increment,
  `asset_id` varchar(10) character set utf8 default NULL,
  `trans_type` int(11) default NULL,
  `trans_date` varchar(8) character set utf8 default NULL,
  `notes` varchar(200) character set utf8 default NULL,
  `trade_in_allowance` double default NULL,
  `trans_value` double default NULL,
  `vendor_id` double default NULL,
  `cash_bank_ap` int(11) default NULL,
  `journal_id` varchar(50) character set utf8 default NULL,
  `posted` bit(1) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `fa_cards` (
  `id` varchar(50) character set utf8 NOT NULL default '',
  `type` varchar(16) character set utf8 default NULL,
  `name` varchar(50) character set utf8 default NULL,
  `street_add` varchar(50) character set utf8 default NULL,
  `city` varchar(30) character set utf8 default NULL,
  `state` varchar(30) character set utf8 default NULL,
  `postcode` varchar(10) character set utf8 default NULL,
  `phone` varchar(20) character set utf8 default NULL,
  `mobile` varchar(20) character set utf8 default NULL,
  `fax` varchar(20) character set utf8 default NULL,
  `email` varchar(50) character set utf8 default NULL,
  `contact` varchar(50) character set utf8 default NULL,
  `notes` varchar(100) character set utf8 default NULL,
  `account_no1` int(11) default NULL,
  `account_no2` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `fa_setting` (
  `type` varchar(50) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(50) character set utf8 default NULL,
  `enable` bit(1) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `fb_room` (
  `room_code` varchar(50) NOT NULL default '',
  `room_name` varchar(50) default NULL,
  `regular_hour` double default NULL,
  `happy_hour` double default NULL,
  `status` int(11) default NULL,
  `nota` varchar(50) default NULL,
  `dept` varchar(50) default NULL,
  `RType` varchar(50) default NULL,
  `capacity` varchar(50) default NULL,
  `desciption` varchar(100) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`room_code`),
  KEY `room_code` (`room_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `fb_room` (`room_code`, `room_name`, `regular_hour`, `happy_hour`, `status`, `nota`, `dept`, `RType`, `capacity`, `desciption`, `update_status`) VALUES
('Meja 1', 'Meja 1', 0, 0, 1, '', '', '', '', '', NULL),
('Meja 2', 'Meja 2', 0, 0, 1, '', '', '', '', '', NULL),
('Meja 3', 'Meja 3', 0, 0, 1, '', '', '', '', '', NULL);

";

	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 16:
	$table="financial";

	$sql="

CREATE TABLE IF NOT EXISTS `finance_charge_defaults` (
  `minimum_days_past_due` int(11) default NULL,
  `minimum_customer_balance` double default NULL,
  `minimum_finance_charge` double default NULL,
  `number_days_between_charges` int(11) default NULL,
  `use_one_month_or_actual_days` varchar(15) character set utf8 default NULL,
  `annual_finance_charge_pct` double default NULL,
  `daily_finance_charge_pct` double default NULL,
  `include_fin_chg_in_past_due_amt` bit(1) default NULL,
  `finance_charge_acct` int(11) default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `financial_periods` (
  `year_id` int(11) default NULL,
  `sequence` double default NULL,
  `period` varchar(50) character set utf8 default NULL,
  `startdate` datetime default NULL,
  `enddate` datetime default NULL,
  `closed` tinyint(1) default NULL,
  `update_status` int(11) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `financial_periods` (`year_id`, `sequence`, `period`, `startdate`, `enddate`, `closed`, `update_status`, `id`) VALUES
(2014, 2, '2014-02', '2014-02-01 00:00:00', '2014-02-28 00:00:00', 0, 0, 23),
(2013, 7, '2013-07', '2013-07-01 00:00:00', '2013-07-30 00:00:00', 0, 0, 14),
(2013, 6, '2013-06', '2013-06-01 00:00:00', '2013-06-30 00:00:00', 0, 0, 20),
(2013, 5, '2013-05', '2013-05-01 00:00:00', '2013-05-31 00:00:00', 0, 0, 12),
(2013, 4, '2013-04', '2013-04-01 00:00:00', '2013-04-30 00:00:00', 0, 0, 11),
(2013, 3, '2013-03', '2013-03-01 00:00:00', '2013-03-31 00:00:00', 0, 0, 10),
(2013, 2, '2013-02', '2013-02-01 00:00:00', '2013-02-28 00:00:00', 1, 0, 9),
(2013, 8, '2013-08', '2013-08-01 00:00:00', '2013-08-31 00:00:00', 0, 0, 21),
(2014, 1, '2014-01', '2014-01-01 00:00:00', '2014-01-31 23:59:00', 0, 0, 22);
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `gl_begbalarc_year` (
  `account_id` int(11) default NULL,
  `company_code` varchar(15) character set utf8 default NULL,
  `year` datetime default NULL,
  `beginning_balance` double default NULL,
  `debit_base` double default NULL,
  `credit_base` double default NULL,
  `ending_balance` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `gl_beginning_balance_archive` (
  `account_id` int(11) default NULL,
  `company_code` varchar(15) character set utf8 default NULL,
  `year` datetime default NULL,
  `beginning_balance` double default NULL,
  `debit_base` double default NULL,
  `credit_base` double default NULL,
  `ending_balance` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 17:
	$table="project";

$sql="

CREATE TABLE IF NOT EXISTS `gl_projects` (
  `kode` varchar(255) character set utf8 default NULL,
  `keterangan` varchar(255) character set utf8 default NULL,
  `client` varchar(255) character set utf8 default NULL,
  `tgl_mulai` datetime default NULL,
  `tgl_selesai` datetime default NULL,
  `budget_amount` double default NULL,
  `project_amount` double default NULL,
  `lokasi` varchar(255) character set utf8 default NULL,
  `person_in_charge` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  `date_created` datetime default NULL,
  `last_update` datetime default NULL,
  `updated_by` varchar(255) character set utf8 default NULL,
  `status_project` varchar(255) character set utf8 default NULL,
  `category_project` varchar(255) character set utf8 default NULL,
  `sales` double default NULL,
  `cost` double default NULL,
  `expense` double default NULL,
  `labarugi` double default NULL,
  `finish_prc` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `invoice_number` double default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `gl_projects_budget` (
  `id` int(11) NOT NULL auto_increment,
  `project_code` varchar(50) character set utf8 default NULL,
  `tahun` int(11) default NULL,
  `account_id` int(11) default NULL,
  `bulan_1` double default NULL,
  `bulan_2` double default NULL,
  `bulan_3` double default NULL,
  `bulan_4` double default NULL,
  `bulan_5` double default NULL,
  `bulan_6` double default NULL,
  `bulan_7` double default NULL,
  `bulan_8` double default NULL,
  `bulan_9` double default NULL,
  `bulan_10` double default NULL,
  `bulan_11` double default NULL,
  `bulan_12` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `gl_projects_saldo` (
  `id` int(11) NOT NULL auto_increment,
  `project_code` varchar(50) character set utf8 default NULL,
  `start_date` datetime default NULL,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `gl_report_groups` (
  `id` int(11) NOT NULL auto_increment,
  `company_code` varchar(50) character set utf8 default NULL,
  `account_type` double default NULL,
  `group_type` varchar(10) character set utf8 default NULL,
  `group_name` varchar(50) character set utf8 default NULL,
  `parent_group_type` varchar(10) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`group_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=271 ;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 18:
	$table="accounting";

$sql="

INSERT INTO `gl_report_groups` (`id`, `company_code`, `account_type`, `group_type`, `group_name`, `parent_group_type`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
(216, 'MYPOS', 1, '10000', 'Aktiva Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 'MYPOS', 2, '20000', 'Hutang Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(223, 'MYPOS', 3, '33000', 'Modal', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 'MYPOS', 4, '40000', 'Pendapatan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 'MYPOS', 5, '50000', 'Harga Pokok Penjualan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 'MYPOS', 6, '60000', 'Biaya', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 'MYPOS', 7, '70000', 'Pendapatan Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 'MYPOS', 8, '80000', 'Biaya Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(268, NULL, 1, '12000', 'Aktiva Tetap', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(267, NULL, 1, '11010', 'Kas Kecil', '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(270, NULL, 1, '11020', 'Kas Besar', '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `gl_transactions` (
  `transaction_id` int(11) NOT NULL auto_increment,
  `company_code` varchar(15) character set utf8 default NULL,
  `gl_id` varchar(100) character set utf8 default NULL,
  `date_time_stamp` datetime default NULL,
  `account_id` int(11) default NULL,
  `date` datetime default NULL,
  `debit` double default NULL,
  `credit` double default NULL,
  `source` varchar(150) character set utf8 default NULL,
  `operation` varchar(150) character set utf8 default NULL,
  `custsuppbank` varchar(20) character set utf8 default NULL,
  `jurnaltype` int(11) default NULL,
  `project_code` varchar(50) character set utf8 default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id_name` varchar(250) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`transaction_id`),
  KEY `x1` (`gl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1012 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
 
$sql="

INSERT INTO `gl_transactions` (`transaction_id`, `company_code`, `gl_id`, `date_time_stamp`, `account_id`, `date`, `debit`, `credit`, `source`, `operation`, `custsuppbank`, `jurnaltype`, `project_code`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `id_name`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
(6, NULL, 'a', NULL, 1394, '2013-08-11 00:00:00', 20000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 'a', NULL, 1378, '2013-08-11 00:00:00', 90000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, 'a', NULL, 1375, '2013-08-11 00:00:00', 9000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, 'a', NULL, 1373, '2013-08-11 00:00:00', 120000, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, 'a', NULL, 1396, '2013-08-11 00:00:00', 900, 0, 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, 'b', NULL, 1375, '2013-08-14 00:00:00', 90000, 0, 'b', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, 'b', NULL, 1385, '2013-08-12 00:00:00', 0, 20000, 'c', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, 'test', NULL, 1373, '2013-08-15 00:00:00', 9000, 0, 'tes', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(966, 'C01', 'PJL00152', NULL, 1373, '2014-03-09 07:00:00', 13000, 0, 'Test', 'Account Receivable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(965, 'C01', 'PJL00152', NULL, 1373, '2014-03-09 07:00:00', 0, 1000, 'Test', 'Sales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(964, 'C01', 'PJL00152', NULL, 1419, '2014-03-09 07:00:00', 900, 0, 'Test', 'Cogs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(963, 'C01', 'PJL00152', NULL, 1374, '2014-03-09 07:00:00', 0, 900, 'Test', 'Inventory', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(844, 'C01', 'PJL00086', NULL, 1373, '2013-05-09 00:00:00', 0, 5000, NULL, 'Sales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(845, 'C01', 'PJL00086', NULL, 1373, '2013-05-09 00:00:00', 0, 2000, NULL, 'Sales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `gl_transactions_archive` (
  `transaction_id` int(11) default NULL,
  `company_code` varchar(15) character set utf8 default NULL,
  `gl_id` varchar(22) character set utf8 default NULL,
  `date_time_stamp` datetime default NULL,
  `account_id` int(11) default NULL,
  `date` datetime default NULL,
  `debit` double default NULL,
  `credit` double default NULL,
  `source` varchar(150) character set utf8 default NULL,
  `operation` varchar(150) character set utf8 default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 19:
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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `inventory_beginning_balance` (
  `item_number` varchar(50) character set utf8 default NULL,
  `tanggal` datetime default NULL,
  `amount_awal` double default NULL,
  `amount_trans` double default NULL,
  `amount_akhir` double default NULL,
  `qty_awal_gd1` int(11) default NULL,
  `qty_trans_gd1` int(11) default NULL,
  `qty_akhir_gd1` int(11) default NULL,
  `qty_awal_gd2` int(11) default NULL,
  `qty_trans_gd2` int(11) default NULL,
  `qty_akhir_gd2` int(11) default NULL,
  `qty_awal_gd3` int(11) default NULL,
  `qty_trans_gd3` int(11) default NULL,
  `qty_akhir_gd3` int(11) default NULL,
  `qty_awal_gd4` int(11) default NULL,
  `qty_trans_gd4` int(11) default NULL,
  `qty_akhir_gd4` int(11) default NULL,
  `qty_awal_gd5` int(11) default NULL,
  `qty_trans_gd5` int(11) default NULL,
  `qty_akhir_gd5` int(11) default NULL,
  `qty_awal_gd6` int(11) default NULL,
  `qty_trans_gd6` int(11) default NULL,
  `qty_akhir_gd6` int(11) default NULL,
  `qty_awal_gd7` int(11) default NULL,
  `qty_trans_gd7` int(11) default NULL,
  `qty_akhir_gd7` int(11) default NULL,
  `qty_awal_gd8` int(11) default NULL,
  `qty_trans_gd8` int(11) default NULL,
  `qty_akhir_gd8` int(11) default NULL,
  `qty_awal_gd9` int(11) default NULL,
  `qty_trans_gd9` int(11) default NULL,
  `qty_akhir_gd9` int(11) default NULL,
  `qty_awal_gd10` int(11) default NULL,
  `qty_trans_gd10` int(11) default NULL,
  `qty_akhir_gd10` int(11) default NULL,
  `ttlqty_awal` int(11) default NULL,
  `ttlqty_trans` int(11) default NULL,
  `ttlqty_akhir` int(11) default NULL,
  `qtyin` int(11) default NULL,
  `qtyout` int(11) default NULL,
  `amountin` double default NULL,
  `amountout` double default NULL,
  `flagawal` bit(1) default NULL,
  `hpp_awal` double default NULL,
  `hpp_akhir` double default NULL,
  `harga` double default NULL,
  `qty` double default NULL,
  `update_status` int(11) default NULL,
  UNIQUE KEY `x1` (`item_number`,`tanggal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

 
$sql="
INSERT INTO `inventory_class` (`kode`, `class`, `id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
('Stock Item', 'Stock Item', 6, NULL, NULL, NULL),
('Service', 'Service', 7, NULL, NULL, NULL),
('Employee', 'Employee', 8, NULL, NULL, NULL),
('Labour', 'Labour', 9, NULL, NULL, NULL),
('Material', 'Material', 14, NULL, NULL, NULL);

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `inventory_moving` (`transfer_id`, `item_number`, `date_trans`, `from_location`, `from_qty`, `to_location`, `to_qty`, `trans_by`, `cost`, `update_status`, `id`, `comments`, `trans_type`, `total_amount`, `unit`) VALUES
('TRX00002', 'NOK123', '2014-03-26 11:08:52', 'Ambon', 1, 'Bali', 1, NULL, 0, NULL, 33, '', NULL, 0, 'Pcs'),
('TRX00002', 'AQ001', '2014-03-26 11:08:52', 'Ambon', 1, 'Bali', 1, NULL, 900, NULL, 32, '', NULL, 900, 'Pcs'),
('TRX00002', 'DJISAMSU', '2014-03-26 11:08:52', 'Ambon', 1, 'Bali', 1, NULL, 10000, NULL, 31, '', NULL, 10000, 'Bks');

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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

	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 21:
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
  PRIMARY KEY  (`id`),
  KEY `x1` (`item_number`,`shipment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=467 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `inventory_products` (`id`, `item_number`, `shipment_id`, `date_received`, `cost`, `supplier_number`, `warehouse_code`, `color`, `size`, `purchase_order_number`, `quantity_in_stock`, `quantity_received`, `total_amount`, `selected`, `other_doc_number`, `receipt_type`, `receipt_by`, `comments`, `production_code`, `unit`, `multi_unit`, `mu_qty`, `mu_price`, `new_cost`, `from_line_number`, `tanggal_jual`, `no_faktur_beli`, `no_faktur_jual`, `no_do_jual`, `tanggal_beli`, `no_retur_jual`, `update_status`, `sourceautonumber`, `sourcefile`, `serial_number`, `create_date`, `create_by`, `update_date`, `update_by`, `retail`) VALUES
(334, 'ABC', 'EIN00001', '2013-09-07 14:03:00', 900, 'test', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'etc_in', NULL, 'test', NULL, 'pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(332, 'Palu', 'EIN00001', '2013-09-07 14:01:38', 20000, 'ANDRI', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'etc_in', NULL, 'TEST', NULL, 'pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(335, 'CD', 'EIN00002', '2013-09-07 14:06:34', 1000, 'test', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'etc_in', NULL, 'test', NULL, 'pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 'SAMP', 'TRM00207', '2013-08-16 00:00:00', 7000, 'ALFAMART', 'Purwakarta', NULL, NULL, 'PO00108', NULL, 100, 700000, NULL, NULL, 'PO', '', '', NULL, 'Bks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 'KOREK', 'TRM00219', '2014-03-16 07:00:00', 2000, 'ALFAMART', 'Ambon', NULL, NULL, 'PO00108', NULL, 20, 40000, NULL, NULL, 'PO', '', '', NULL, 'Pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 'Palu', 'TRM00219', '2014-03-16 07:00:00', 20000, 'ALFAMART', 'Ambon', NULL, NULL, 'PO00108', NULL, 1, 20000, NULL, NULL, 'PO', '', '', NULL, 'Pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(376, 'ABC', 'EIN00005', '2014-03-16 08:46:51', 900, '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'etc_in', NULL, '', NULL, 'pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(464, 'CD', 'DOX00012', '2014-03-26 09:39:47', 1000, NULL, 'Surabaya', NULL, NULL, NULL, NULL, 1, 1000, NULL, NULL, 'ETC_OUT', NULL, 'Keluar barang bonus', NULL, 'Pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(465, 'KOREK', 'DOX00012', '2014-03-26 09:39:47', 2000, NULL, 'Surabaya', NULL, NULL, NULL, NULL, 1, 2000, NULL, NULL, 'ETC_OUT', NULL, 'Keluar barang bonus', NULL, 'Pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(466, 'DJISAMSU', 'DOX00012', '2014-03-26 09:39:47', 10000, NULL, 'Surabaya', NULL, NULL, NULL, NULL, 1, 10000, NULL, NULL, 'ETC_OUT', NULL, 'Keluar barang bonus', NULL, 'Bks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


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
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`item_number`,`warehouse_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 22:
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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `invoice` (`invoice_number`, `invoice_type`, `sales_order_number`, `type_of_invoice`, `account_id`, `sold_to_customer`, `ship_to_customer`, `invoice_date`, `your_order__`, `source_of_order`, `payment_terms`, `salesman`, `fob`, `shipped_via`, `tax`, `tax_2`, `freight`, `discount`, `other`, `paid`, `comments`, `sales_tax_code`, `sales_tax_percent`, `sales_tax2_code`, `sales_tax_percent_2`, `posted`, `posting_gl_id`, `batch_post`, `finance_charge`, `department`, `truck`, `capacity`, `printed`, `payment`, `insurance`, `packing`, `discount_2`, `discount_3`, `print_counter`, `uang_muka`, `saldo_invoice`, `amount`, `disc_amount_1`, `disc_amount_2`, `disc_amount_3`, `total_amount`, `audit_status`, `org_id`, `update_status`, `ppn_amount`, `do_invoiced`, `your_order_date`, `disc_amount`, `sales_name`, `promosi_code`, `create_date`, `create_by`, `update_date`, `update_by`, `no_so_text`, `no_po_text`, `currency_code`, `currency_rate`, `warehouse_code`, `subtotal`, `due_date`) VALUES
('PJL00106', 'I', '', '', 0, '12019', '', '2014-02-11 00:00:00', '', '', '60 Hari', 'Andri', '', '', 0, 0, 100, 0.5, 200, 0, '', '', 0, '', 0, 0, '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 5003500, 5109800, 0, 0, 0, 0, '', '', 0, 0, 0, '2014-02-11 00:00:00', 0, '', '', '2014-02-11 00:00:00', '', '2014-02-11 00:00:00', '', '', '', '', 0, '', 10219000, '2014-02-11 00:00:00'),
('PJL00101', 'I', '', '', 0, 'C102', '', '2013-08-28 00:00:00', '', '', 'Kredit 30 Hari', 'Andri', '', '', 0, 0, 0, 0, 0, 0, '', '', 0, '', 0, 0, '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 112400, 109000, 0, 0, 0, 0, '', '', 0, 0, 0, '2013-08-28 00:00:00', 0, '', '', '2013-08-28 00:00:00', '', '2013-08-28 00:00:00', '', '', '', '', 0, '', 109000, '2013-08-28 00:00:00'),
('SJ00038', 'D', 'SO00094', NULL, NULL, 'CASH', NULL, '2014-03-25 03:04:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1750000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1750000, '2014-03-25 07:00:00'),
('SJ00015', 'D', 'SO00129', NULL, NULL, '12019', NULL, '2014-03-25 15:47:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-25 07:00:00'),
('SJ00017', 'D', 'SO00158', NULL, NULL, 'Irfan', NULL, '2014-03-25 15:48:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-25 07:00:00'),
('PJL00113', 'I', '', 'Simple', NULL, 'ANDRI', NULL, '2014-03-27 07:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13000, 13000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13000, '2014-03-27 07:00:00');

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `invoice_lineitems` (`invoice_number`, `line_number`, `item_number`, `quantity`, `unit`, `description`, `price`, `discount`, `taxable`, `shipped`, `ship_date`, `ship_qty`, `bo_qty`, `serial_number`, `job_reference`, `comments`, `cost`, `color`, `size`, `warehouse_code`, `revenue_acct_id`, `amount`, `currency_code`, `currency_rate`, `discount_amount`, `quality`, `packing_material`, `multi_unit`, `mu_qty`, `mu_harga`, `forex_price`, `base_curr_amount`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `update_status`, `ppn_amount`, `nett_amount`, `from_line_number`, `from_line_type`, `from_line_doc`, `sourceautonumber`, `sourcefile`, `discount_addition`, `printcount`, `tax_amount`, `sales_comm_percent`, `sales_comm_amount`, `employee_id`, `line_order_type`, `start_time`, `duration_minute`, `promo`, `coa1`, `coa2`, `coa3`, `coa4`, `coa5`, `coa1amt`, `coa2amt`, `coa3amt`, `coa4amt`, `coa5amt`, `create_date`, `create_by`, `update_date`, `update_by`, `sc_amount`) VALUES
('PJL00086', 181, 'ABC', 1, 'PCS', 'KOPI SUSU ABC', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 182, 'DJISAMSU', 1, 'Bks', 'Djisamsu Kretek', 12000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 183, 'SAMP', 1, 'Bks', 'Sampoerna Hijau', 8000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 184, 'SLNC', 1, 'Pcs', 'SALON PAS CAIR', 5000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00086', 185, 'ABC', 2, 'PCS', 'KOPI SUSU ABC', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00113', 594, 'SAMP', 1, 'Bks', 'Sampoerna Hijau', 8000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7000, NULL, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 23:
	$table="modules";

	$sql="

CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` varchar(50) character set utf8 NOT NULL,
  `module_name` varchar(200) character set utf8 default NULL,
  `type` varchar(50) character set utf8 default NULL,
  `form_name` varchar(50) character set utf8 default NULL,
  `description` varchar(225) character set utf8 default NULL,
  `parentid` varchar(255) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sequence` int(5) default NULL,
  `visible` bit(1) default NULL,
  `controller` varchar(50) default NULL,
  PRIMARY KEY  (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
INSERT INTO `modules` (`module_id`, `module_name`, `type`, `form_name`, `description`, `parentid`, `update_status`, `sequence`, `visible`, `controller`) VALUES
	('frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', 'Form', 'frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', '_30010', 0, NULL, NULL, NULL),
	('frmMain.Addnew', 'xxxxxx', 'Form', 'frmMain.Addnew', 'xxxxxxxxxx', '_00000', 0, 0, b'00000000', ''),
	('frmRptCriteria', 'frmRptCriteria', 'Form', 'frmRptCriteria', 'Please entry this', '_90000', 0, NULL, NULL, NULL),
	('ID_ExportImport', 'ID_ExportImport', 'Form', 'ID_ExportImport', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('ID_ItemPrices', 'Item Prices', 'Form', 'ID_ItemPrices', '', 'ID_ItemPrices', 0, 0, b'00000000', ''),
	('ID_JasaKiriman', 'ID_JasaKiriman', 'Form', 'ID_JasaKiriman', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('\\CEK\\BANKCEK2.RPT', '004. Cek keluar - Status Belum Cair / Gantung', 'Form', '\\CEK\\BANKCEK2.RPT', '004. Cek Keluar - Status Belum Cair', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\BANKCEKGL.RPT', '011. Laporan Cek Keluar (Dengan Kode Perkiraan)', 'Form', '\\CEK\\BANKCEKGL.RPT', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\BANKCEKM2.RPT', '005. Cek Masuk - Status Belum Cair / Gantung', 'Form', '\\CEK\\BANKCEKM2.RPT', 'A005. Cek Masuk - Status Belum Cair', '_90010', 0, NULL, NULL, NULL),
	('\\cek\\BANKCODE.rpt', '001. Daftar Bank', 'Form', '\\cek\\BANKCODE.rpt', 'A004. Cek Keluar - Status Cair', '_90010', 0, NULL, NULL, NULL),
	('\\Cek\\BankMutasiBank.rpt', '012. Laporan Mutasi Transaksi Bank', 'Form', '\\Cek\\BankMutasiBank.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\ChInSum.Rpt', '006. Daftar Penerimaan Cek/Giro', 'Form', '\\CEK\\ChInSum.Rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\ChOutSum.Rpt', '007. Daftar Pengeluran Cek/Giro', 'Form', '\\CEK\\ChOutSum.Rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\KasInSum.Rpt', '002. Daftar Penerimaan Kas', 'Form', '\\CEK\\KasInSum.Rpt', 'Daftar Penerimaan Kas', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\KasOutSum.Rpt', '003. Daftar Pengeluran Kas', 'Form', '\\CEK\\KasOutSum.Rpt', 'Daftar Pengeluaran Kas', '_90010', 0, NULL, NULL, NULL),
	('\\Cek\\MutasiKas_Saldo.rpt', '008. Laporan Mutasi Kas/Bank', 'Form', '\\Cek\\MutasiKas_Saldo.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\transfer_in.rpt', '009. Daftar Penerimaan transfer', 'Form', '\\CEK\\transfer_in.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\transfer_out.rpt', '010. Daftar Pengeluaran transfer', 'Form', '\\CEK\\transfer_out.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\gl\\balancesheet2.rpt', '009. Laporan Neraca', 'Form', '\\gl\\balancesheet2.rpt', '009. Laporan Neraca', '_90010', 0, NULL, NULL, NULL),
	('\\gl\\neracaT.rpt', 'Laporan Neraca T-Form', 'Form', '\\gl\\neracaT.rpt', 'Laporan Neraca T-Form', '_90010', 0, NULL, NULL, NULL),
	('\\gl\\RLCompare.rpt', 'Laporan Rugi Laba Comparison', 'Form', '\\gl\\RLCompare.rpt', 'Laporan Rugi Laba Comparison', '_90010', 0, NULL, NULL, NULL),
	('\\Inv\\AsmItem.Rpt', 'Laporan Assembly item', 'Form', '\\Inv\\AsmItem.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\AsmItem17.Rpt', '022. Laporan Assembly item - Summary', 'Form', '\\Inv\\AsmItem17.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\DaftarBarang.Rpt', 'Laporan Daftar  Barang', 'Form', '\\Inv\\DaftarBarang.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\FisikInventory.rpt', 'Laporan Fisik Inventory', 'Form', '\\Inv\\FisikInventory.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\HargaBeli.Rpt', 'Laporan Daftar Harga Beli', 'Form', '\\Inv\\HargaBeli.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\HargaJual.Rpt', 'Laporan Daftar Harga Jual', 'Form', '\\Inv\\HargaJual.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InventoryMoving.rpt', 'Laporan Keluar Masuk Barang', 'Form', '\\Inv\\InventoryMoving.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InvPriceHistory.rpt', 'Laporan History Harga', 'Form', '\\Inv\\InvPriceHistory.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InvTranCategory.Rpt', '023. Inventory Transaction by Category', 'Form', '\\Inv\\InvTranCategory.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InvTranItem.Rpt', '024. Inventory Transaction by Item Number', 'Form', '\\Inv\\InvTranItem.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\inv\\invvalue.rpt', 'Laporan Nilai Persediaan Inventory', 'Form', '\\inv\\invvalue.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\inv\\KeluarReturPembelian.rpt', 'Pengeluaran Barang Retur Pembelian', 'Form', '\\inv\\KeluarReturPembelian.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\MutasiGudang.rpt', 'Mutasi Per Barang Per Gudang', 'Form', '\\Inv\\MutasiGudang.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgmtLow.rpt', 'Stock Mgmt - Inventory Low Stock', 'Form', '\\Inv\\StokMgmtLow.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgMtOnBOrder.rpt', 'Stock MgMt - Inventory on Back Order', 'Form', '\\Inv\\StokMgMtOnBOrder.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgMtOut.rpt', 'Stock MgMt - Inventory Out Of Stock', 'Form', '\\Inv\\StokMgMtOut.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgMtRecon.Rpt', 'Stock MgMt - Inventory Reconsiliation', 'Form', '\\Inv\\StokMgMtRecon.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Po\\DaftarHutang.rpt', 'A0041. Hutang Supplier dan Pembayaran', 'Form', '\\Po\\DaftarHutang.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\DaftarSupplier.rpt', 'A002. Daftar Supplier Urut Nama', 'Form', '\\po\\DaftarSupplier.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\DaftarSupplierUtama.rpt', 'Daftar Hutang per Supplier', 'Form', '\\po\\DaftarSupplierUtama.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\HistoryHargaItemSupplier.rpt', '020. History Harga Item Per Supplier', 'Form', '\\Po\\HistoryHargaItemSupplier.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\Keluar.rpt', 'Laporan Pengeluaran Barang', 'Form', '\\PO\\Keluar.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\KeluarPerPO.rpt', 'Laporan Pengeluaran Barang/Retur - Per PO', 'Form', '\\PO\\KeluarPerPO.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\OpenPO.rpt', 'Open Purchase Order by PO Number', 'Form', '\\PO\\OpenPO.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\Po\\OrderPembelian.rpt', 'Order Pembelian / PO', 'Form', '\\Po\\OrderPembelian.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\Po\\OrderPembelianItemSupplierDetail.rpt', 'A008. Pembelian  per Item, Supplier - Detail ', 'Form', '\\Po\\OrderPembelianItemSupplierDetail.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\PayAnaSupplier.Rpt', 'A016. Total Pembayaran per Supplier - Detail', 'Form', '\\PO\\PayAnaSupplier.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\PayDetailDaily.Rpt', 'A014. Total Pembayaran Harian', 'Form', '\\PO\\PayDetailDaily.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\PayDetailMonthly.Rpt', 'A015. Total Pembayaran Bulanan', 'Form', '\\PO\\PayDetailMonthly.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\PODaily.rpt', 'A009. Total Faktur Pembelian dibuat - Harian - Summary', 'Form', '\\PO\\PODaily.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\PODetailDaily.rpt', 'A010. Total Faktur Pembelian dibuat - Harian - Detail', 'Form', '\\PO\\PODetailDaily.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemNoRecvItem.rpt', 'Purchase Order Items Not Received- by Item', 'Form', '\\PO\\POItemNoRecvItem.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemNoRecvSupplier.rpt', 'Purchase Order Items Not Received- by Supplier', 'Form', '\\PO\\POItemNoRecvSupplier.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemOverItem.rpt', 'Purchase Order Items Overdue - by Item', 'Form', '\\PO\\POItemOverItem.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemOverSupplier.rpt', 'Purchase Order Items Overdue - by Supplier', 'Form', '\\PO\\POItemOverSupplier.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POMonthly.rpt', 'A011. Total Faktur Pembelian dibuat - Bulanan - Summary', 'Form', '\\PO\\POMonthly.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\Po\\SaldoHutang.rpt', 'A005. Daftar Saldo Hutang Supplier', 'Form', '\\Po\\SaldoHutang.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\SelisihKursHutang1.Rpt', '015. Selisih Kurs Pembelian', 'Form', '\\po\\SelisihKursHutang1.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\sisa_hutang.rpt', '011. Daftar Sisa Hutang - Per Invoice', 'Form', '\\po\\sisa_hutang.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\sisa_hutang_bulan.rpt', '012. Daftar Sisa Hutang - Per Bulan', 'Form', '\\po\\sisa_hutang_bulan.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\supplierEnvelop.rpt', 'Supplier Envelope', 'Form', '\\po\\supplierEnvelop.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\SupplierLstFinancial.rpt', 'Supplier Financial Listing', 'Form', '\\Po\\SupplierLstFinancial.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\SupplierLstNumber.Rpt', 'Supplier List by Supplier Number', 'Form', '\\Po\\SupplierLstNumber.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\SupplierPayables.rpt', 'Supplier Total Period Payables', 'Form', '\\Po\\SupplierPayables.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\Terima.Rpt', '021. Penerimaan Barang - Detail', 'Form', '\\PO\\Terima.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\PO\\TotalPayableSupplier.rpt', 'Total Period Payable Paid by Supplier', 'Form', '\\PO\\TotalPayableSupplier.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', 'A003. Penjualan per Customer - Summary', 'Form', '\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', 'A012. Penjualan per Jenis Pembayaran - Detail', 'Form', '\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', 'A011. Penjualan per Jenis Pembayaran - Summary', 'Form', '\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', 'Laporan analisa penjualan per kategory customer', 'Form', '\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', 'Laporan analisa penjualan per salesman - perbulan', 'Form', '\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', 'Laporan analisa penjualan per source of order - perbulan', 'Form', '\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerWilayah.rpt', 'Laporan analisa penjualan per wilayah', 'Form', '\\So\\AnalisaPenjualanPerWilayah.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\CustCredit.rpt', 'Customer on Credit Hold', 'Form', '\\so\\CustCredit.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\CustCreditAll.rpt', 'Customer on Credit Hold - Columns Style', 'Form', '\\so\\CustCreditAll.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\So\\CustHighest.Rpt', 'Customer Sales by Highest Total', 'Form', '\\So\\CustHighest.Rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\CustListCompany.rpt', 'Customer Listing by Company', 'Form', '\\so\\CustListCompany.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\CustListCustomer.rpt', 'Customer Listing by Customer Number', 'Form', '\\so\\CustListCustomer.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\customerEnvelop.rpt', 'Customer Envelope/Label', 'Form', '\\so\\customerEnvelop.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\CustPayHistory2.rpt', 'A0061. Piutang Customer dan Pembayaran', 'Form', '\\so\\CustPayHistory2.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\CustPayHistoryByCust.rpt', 'A003. Daftar pembayaran piutang - group by customer', 'Form', '\\So\\CustPayHistoryByCust.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\CustSalesHistory.rpt', 'Customer Sales History', 'Form', '\\So\\CustSalesHistory.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\CustSalesHistoryLast.rpt', 'Customer Sales History - Last Order', 'Form', '\\So\\CustSalesHistoryLast.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\daftarcustomer.rpt', 'A001. Daftar Customer urut Nama', 'Form', '\\so\\daftarcustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\DaftarPiutang.rpt', 'A006. Piutang Customer dan Pembayaran', 'Form', '\\so\\DaftarPiutang.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\DaftarTagihan.rpt', 'Daftar Tagihan dan Pembayaran', 'Form', '\\So\\DaftarTagihan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\DODetail100.Rpt', 'Laporan Pengiriman Barang / DO', 'Form', '\\So\\DODetail100.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPelunasanPiutang.Rpt', 'A009. Pelunasan Piutang - per Invoice (All)', 'Form', '\\So\\FakturPelunasanPiutang.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanDetailTanggal.Rpt', 'A2.Faktur Penjualan - Summary', 'Form', '\\So\\FakturPenjualanDetailTanggal.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanDetailtem.Rpt', 'A006. Penjualan per Item - Detail', 'Form', '\\So\\FakturPenjualanDetailtem.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummary.Rpt', 'Faktur Penjualan - Summary - Jenis Pembayaran', 'Form', '\\So\\FakturPenjualanSummary.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryBayar.Rpt', 'Faktur Penjualan - Summary - Per Status Pembayaran', 'Form', '\\So\\FakturPenjualanSummaryBayar.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryItemCust.Rpt', 'A012. Penjualan per Customer per Item - Detail', 'Form', '\\So\\FakturPenjualanSummaryItemCust.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummarySupplier.Rpt', 'Faktur Penjualan - Summary - Per Supplier', 'Form', '\\So\\FakturPenjualanSummarySupplier.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryTanggal.Rpt', 'Faktur Penjualan - Summary -  per tanggal', 'Form', '\\So\\FakturPenjualanSummaryTanggal.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryWilayah.Rpt', 'Faktur Penjualan - Summary - Per Wilayah', 'Form', '\\So\\FakturPenjualanSummaryWilayah.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResv.rpt', 'F&B Room Reservation - Daily', 'Form', '\\So\\FB_RoomResv.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResv2.rpt', 'F&B Room Reservation - Daily - By Waiter', 'Form', '\\So\\FB_RoomResv2.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResv3.rpt', 'F&B Room Reservation - Daily - By Room', 'Form', '\\So\\FB_RoomResv3.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResvSumDay.rpt', 'F&B Room Reservation Summary - Daily', 'Form', '\\So\\FB_RoomResvSumDay.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_TableResv.rpt', 'F&B Table Reservation - Daily', 'Form', '\\So\\FB_TableResv.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\HargaHistoryMonthly.rpt', 'Laporan History Harga Monthly', 'Form', '\\SO\\HargaHistoryMonthly.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\HistoryHargaItemCustomer.rpt', '019. History Harga Item Per Customer', 'Form', '\\So\\HistoryHargaItemCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\InvoiceAllTypePerCustomer.rpt', 'Invoice - All Type - per Customers', 'Form', '\\So\\InvoiceAllTypePerCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\InvoicePerTypePerCustomer.rpt', 'Invoice - InvoiceType - per Customers', 'Form', '\\So\\InvoicePerTypePerCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\Jual100.Rpt', 'Laporan Penjualan Detail', 'Form', '\\So\\Jual100.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\JualCustSum.Rpt', 'Penjualan per Customer', 'Form', '\\so\\JualCustSum.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualKasirDateTime.Rpt', 'Laporan penjualan kasir with Date, Time', 'Form', '\\SO\\JualKasirDateTime.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualKonsinyasiTglMonthly.Rpt', 'Laporan Penjualan Konsinyasi Bulanan', 'Form', '\\SO\\JualKonsinyasiTglMonthly.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualReturTglMonthly.Rpt', 'Laporan Retur Penjualan Bulanan', 'Form', '\\SO\\JualReturTglMonthly.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualTglMonthly.Rpt', 'Laporan Penjualan Bulanan', 'Form', '\\SO\\JualTglMonthly.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualTglMonthlyDept.Rpt', 'Laporan Penjualan per Department', 'Form', '\\SO\\JualTglMonthlyDept.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualTglMonthlySales.Rpt', 'Laporan Penjualan Bulanan per Salesman', 'Form', '\\SO\\JualTglMonthlySales.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\KomisiSalesmanMonthly.rpt', 'Laporan Komisi Salesman - per Bulan', 'Form', '\\So\\KomisiSalesmanMonthly.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\KomisiSalesmanSummary.rpt', 'Laporan Komisi Salesman - Total Periode', 'Form', '\\So\\KomisiSalesmanSummary.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\KreditMemoSummary.rpt', 'Kredit Memo Summary', 'Form', '\\So\\KreditMemoSummary.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\MutasiStock.Rpt', 'Laporan Mutasi Stock Bulanan', 'Form', '\\SO\\MutasiStock.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\MutasiStockPrice.Rpt', 'Laporan Mutasi Stock, Price Bulanan ', 'Form', '\\SO\\MutasiStockPrice.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\PenjualanCustomer.rpt', 'Penjualan per Customer - Detail', 'Form', '\\So\\PenjualanCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\PenjualanCustomerDetail.rpt', 'A002. Penjualan per Customer - Detail', 'Form', '\\So\\PenjualanCustomerDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\PenjualanPerbulanDetail.rpt', 'A002. Penjualan perbulan - Detail', 'Form', '\\So\\PenjualanPerbulanDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\SaldoPiutang.rpt', 'A007. Daftar Saldo Piutang Customer', 'Form', '\\So\\SaldoPiutang.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SalesKomisi.exe', 'Query Komisi Salesman', 'Form', '\\SO\\SalesKomisi.exe', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SalesOrder.rpt', 'Sales Order Summary', 'Form', '\\SO\\SalesOrder.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\SalesOrderDetail.rpt', 'Sales Order Detail', 'Form', '\\so\\SalesOrderDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\salesorder_do.rpt', 'Sales Order - Delivery Order - Summary', 'Form', '\\so\\salesorder_do.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\salesorder_do_item.rpt', 'Sales Order - Delivery Order - Item - Detail', 'Form', '\\so\\salesorder_do_item.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\sisa_piutang.rpt', '011. Daftar Sisa Piutang - Per Invoice', 'Form', '\\so\\sisa_piutang.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\sisa_piutang_bulan.rpt', '012. Daftar Sisa Piutang - Per Bulan', 'Form', '\\so\\sisa_piutang_bulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SOOpenItem.rpt', 'Open Sales Order - by Item', 'Form', '\\SO\\SOOpenItem.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SOOpenTanggal.rpt', 'Open Sales Order - by Tanggal', 'Form', '\\SO\\SOOpenTanggal.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('_00000', 'Setting', 'Form', '_00000', 'Setup data perusahaan atau aturan-aturan umum lainnya.', '0', 0, 7, b'00000000', ''),
	('_00010', 'Job Responsibility', 'Form', 'jobs', 'Job Responsibility', '_00000', 1, 3, b'10000000', NULL),
	('_00011', 'Create', 'Form', '_00011', '.', '_00010', 1, NULL, NULL, NULL),
	('_00012', 'Edit', 'Form', '_00012', '.', '_00010', 1, NULL, NULL, NULL),
	('_00013', 'Delete', 'Form', '_00013', '.', '_00010', 1, NULL, NULL, NULL),
	('_00020', 'User Access', 'Form', 'user', 'User Access', '_00000', 1, 2, b'10000000', NULL),
	('_00021', 'Create', 'Form', '_00021', '.', '_00020', 1, NULL, NULL, NULL),
	('_00022', 'Edit', 'Form', '_00022', '.', '_00020', 1, NULL, NULL, NULL),
	('_00023', 'Delete', 'Form', '_00023', '.', '_00020', 1, NULL, NULL, NULL),
	('_00030', 'Global Setting', 'Form', 'seting', 'Global Setting', '_00000', 1, 1, b'10000000', NULL),
	('_00031', 'Save', 'Form', '_00031', '.', '_00030', 1, NULL, NULL, NULL),
	('_00032', 'Remove All Database', 'Form', '_00032', 'Remove All Database', '_00030', 1, NULL, NULL, NULL),
	('_00040', 'Report List System', 'Form', 'report_list', 'Report List System', '_00000', 1, 4, b'10000000', NULL),
	('_00041', 'Add', 'Form', 'frmReportList.cmdAdd', '.', '_00040', 1, NULL, NULL, NULL),
	('_00042', 'Edit', 'Form', 'frmReportList.cmdEdit', '.', '_00040', 1, NULL, NULL, NULL),
	('_00043', 'Delete', 'Form', 'frmReportList.cmdDelete', '.', '_00040', 1, NULL, NULL, NULL),
	('_00050', 'List Modules System', 'Form', 'modules', 'List Modules System', '_00000', 1, 5, b'10000000', NULL),
	('_10000', 'General Ledger', 'Form', '_10000', 'Modul General Ledger atau Akuntansi.', '0', 1, 6, b'10000000', NULL),
	('_10010', 'Perkiraan (COA)', 'Form', '_10010', '.', '_10000', 1, NULL, b'00000000', NULL),
	('_10011', 'Create', 'Form', '_10011', '.', '_10010', 1, NULL, NULL, NULL),
	('_10012', 'Edit', 'Form', '_10012', '.', '_10010', 1, NULL, NULL, NULL),
	('_10013', 'Delete', 'Form', '_10013', '.', '_10010', 1, NULL, NULL, NULL),
	('_10015', 'Create New COA Group', 'Form', '_10015', 'Create New COA Group', '_10010', 1, NULL, NULL, NULL),
	('_10016', 'Remove COA Group', 'Form', '_10016', 'Remove COA Group', '_10010', 1, NULL, NULL, NULL),
	('_10020', 'Budgeting ', 'Form', 'budget', 'Budgeting Cost', '_10000', 1, 5, b'10000000', NULL),
	('_10021', 'Save', 'Form', '_10021', '.', '_10020', 1, NULL, NULL, NULL),
	('_10030', 'Periode Akuntansi', 'Form', 'periode', 'Periode Akuntansi', '_10000', 1, 4, b'10000000', NULL),
	('_10031', 'Save', 'Form', '_10031', '.', '_10030', 1, NULL, NULL, NULL),
	('_10032', 'Copy To New Periode', 'Form', '_10032', '.', '_10030', 1, NULL, NULL, NULL),
	('_10035', 'Closing Periode', 'Form', '_10035', '.', '_10030', 1, NULL, NULL, NULL),
	('_10036', 'Re-Opening Periode', 'Form', '_10036', '.', '_10030', 1, NULL, NULL, NULL),
	('_10060', 'Jurnal Entry', 'Form', 'jurnal', 'Jurnal Umum', '_10000', 1, 3, b'10000000', NULL),
	('_10060A', '_10060A', 'Form', '_10060A', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_10061', 'Create', 'Form', '_10061', '.', '_10060', 1, NULL, NULL, NULL),
	('_10062', 'Edit', 'Form', '_10062', '.', '_10060', 1, NULL, NULL, NULL),
	('_10063', 'Delete', 'Form', '_10063', '.', '_10060', 1, NULL, NULL, NULL),
	('_10064', 'Jenis Perkiraan / COA', 'Form', 'coa', 'Jenis Perkiraan / COA', '_10000', 1, 1, b'10000000', NULL),
	('_10065', 'Kelompok Perkiraan', 'Form', 'coa_group', 'Kelompok Perkiraan', '_10000', 1, 2, b'10000000', NULL),
	('_10066', 'View Arsip Saldo Perkiraan', 'Form', 'gl_arsip', 'View Arsip Saldo Perkiraan', '_10000', 1, 6, b'10000000', NULL),
	('_10067', 'Setting Autonumber Jurnal Entry', 'Form', '_10067', 'Setting Autonumber Jurnal Entry', '_10000', 1, NULL, NULL, NULL),
	('_10068', 'Setting Hotkey Jurnal Entry', 'Form', '_10068', 'Setting Hotkey Jurnal Entry', '_10000', 1, NULL, NULL, NULL),
	('_10069', 'Neraca Design Report', 'Form', '_10069', 'Neraca Design Report', '_10000', 1, NULL, NULL, NULL),
	('_10070', 'Rugi Laba Design Report', 'Form', '_10070', 'Rugi Laba Design Report', '_10000', 1, NULL, NULL, NULL),
	('_11000', 'Manufacturer', 'Form', '_11000', 'Manufacture dan pabrikasi module', '0', 0, 0, b'00000000', ''),
	('_12000', 'Payroll', 'Form', '_12000', 'Payroll and Human Resource Development', '0', 0, 0, b'00000000', ''),
	('_13000', 'Koperasi', 'Form', '_13000', 'Module Koperasi Simpan Pinjam', '0', 0, 0, b'00000000', ''),
	('_30000', 'Penjualan', 'Form', '_30000', 'Modul Penjualan, A/R, Pelanggan dan Pembayaran.', '0', 1, 1, b'10000000', NULL),
	('_30000.0', 'Point Of Sales - MyPOS', 'Form', '_30000', 'Point Of Sales - MyPOS', '_30000', 0, NULL, b'00000000', NULL),
	('_30000.001', 'Buat nota baru', 'Form', '_30000.001', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.002', 'Void atau pembatalan nota', 'Form', '_30000.002', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.003', 'Input discount nota', 'Form', '_30000.003', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.004', 'Input PPN nota', 'Form', '_30000.004', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.005', 'Input service charge', 'Form', '_30000.005', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.006', 'Laporan penjualan harian kasir', 'Form', '_30000.006', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.007', 'Input penerimaan barang ', 'Form', '_30000.007', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.008', 'Lihat daftar penerimaan barang', 'Form', '_30000.008', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.009', 'Input pengeluran barang ', 'Form', '_30000.009', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.010', 'Lihat daftar penerimaan barang', 'Form', '_30000.010', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.011', 'Cetak label / barcode barang  ', 'Form', '_30000.011', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.012', 'Buka cash drawer  ', 'Form', '_30000.012', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.013', 'Input master barang dan kelompok  ', 'Form', '_30000.013', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.014', 'Input master pelanggan', 'Form', '_30000.014', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.015', 'Input master waiter ', 'Form', '_30000.015', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.016', 'Input master table / meja / room  ', 'Form', '_30000.016', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.017', 'Input master salesman ', 'Form', '_30000.017', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.018', 'Input price manager ', 'Form', '_30000.018', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.019', 'Input barang promosi  ', 'Form', '_30000.019', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.020', 'Backup database', 'Form', '_30000.020', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.021', 'Seting nota dan perangkat keras', 'Form', '_30000.021', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.022', 'Seting pemakai dan user level ', 'Form', '_30000.022', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.023', 'Hapus semua data transaksi penjualan  ', 'Form', '_30000.023', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.024', 'Hapus semua data master barang', 'Form', '_30000.024', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.025', 'Export / Import data barang ', 'Form', '_30000.025', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.026', 'Reset nomor nota  ', 'Form', '_30000.026', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.027', 'Seting nomor nota ', 'Form', '_30000.027', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.028', 'Input kas awal, pengambilan kas ', 'Form', '_30000.028', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.029', 'Laporan: penjualan per nota ', 'Form', '_30000.029', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.030', 'Laporan: penjualan per kasir  ', 'Form', '_30000.030', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.031', 'Laporan: penjualan per item ', 'Form', '_30000.031', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.032', 'Laporan: penjualan per kategory ', 'Form', '_30000.032', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.033', 'Laporan: penjualan per waiter ', 'Form', '_30000.033', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.034', 'Laporan: penjualan per customer ', 'Form', '_30000.034', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.035', 'Laporan: Daftar nota  ', 'Form', '_30000.035', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.036', 'Laporan: Daftar pembayaran', 'Form', '_30000.036', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.037', 'Laporan: Kartu stock  ', 'Form', '_30000.037', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.038', 'Laporan: Item Paling laku ', 'Form', '_30000.038', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.039', 'Laporan: Item paling tidak laku ', 'Form', '_30000.039', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.040', 'Laporan: Rugi / laba penjualan', 'Form', '_30000.040', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.041', 'Laporan: Daftar barang', 'Form', '_30000.041', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.050', 'Penyesuaian Stock (Adjustment)', 'Form', '_30000.050', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.051', 'Proses Produksi Jadi (Assembly)', 'Form', '_30000.051', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.052', 'Laporan Proses Produksi Jadi (Assembly)', 'Form', '_30000.052', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.053', 'Laporan Penyesuaian Stock (Adjustment)', 'Form', '_30000.053', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.054', 'Daftar piutang customer', 'Form', '_30000.054', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.055', 'Formulir Stock Opname', 'Form', '_30000.055', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.056', 'Proses retur barang', 'Form', '_30000.056', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.057', 'Proses import master barang file MDB', 'Form', '_30000.057', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.058', 'Laporan penjualan item minus', 'Form', '_30000.058', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.059', 'Laporan kartu stock', 'Form', '_30000.059', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.060', 'Input discount bertingkat', 'Form', '_30000.060', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.061', 'Input ppn percent', 'Form', '_30000.061', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.062', 'Input discount percent nota', 'Form', '_30000.062', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.063', 'Daftar user level/job', 'Form', '_30000.063', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.064', 'Export master barang to excel', 'Form', '_30000.064', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.065', 'Import master barang dari excel', 'Form', '_30000.065', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.066', 'Daftar Kategori Barang', 'Form', '_30000.066', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.067', 'Laporan Penjualan per Customer, Item', 'Form', '_30000.067', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.068', 'Laporan Penjualan per Nota, Pembayaran', 'Form', '_30000.068', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.100', 'Proses Pelunasan ONACCOUNT', 'Form', '_30000.100', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30010', 'Master Data Customer', 'Form', 'customer/browse', '.', '_30000', 1, 1, b'10000000', 'customer'),
	('_30011', 'Create', 'Form', '_30011', '.', '_30010', 1, NULL, NULL, NULL),
	('_30012', 'Edit', 'Form', '_30012', '.', '_30010', 1, NULL, NULL, NULL),
	('_30013', 'Delete', 'Form', '_30013', '.', '_30010', 1, NULL, NULL, NULL),
	('_30020', 'Master Salesman', 'Form', 'salesman', '.', '_30000', 1, 2, b'10000000', 'salesman'),
	('_30030', 'Setting Saldo Awal Piutang Customer', 'Form', 'customer/saldo_awal', '.', '_30000', 1, 3, b'10000000', NULL),
	('_30031', 'Proses', 'Form', '_30031', '.', '_30030', 1, NULL, NULL, NULL),
	('_30033', 'Delete', 'Form', '_30033', '.', '_30030', 1, NULL, NULL, NULL),
	('_30040', 'Arsip Bulanan Piutang Customer', 'Form', 'customer/proses_bulanan', '.', '_30000', 1, 4, b'10000000', NULL),
	('_30041', 'Proses', 'Form', '_30041', '.', '_30040', 1, NULL, NULL, NULL),
	('_30042', 'Delete', 'Form', '_30042', '.', '_30040', 1, NULL, NULL, NULL),
	('_30050', 'Pembuatan SO', 'Form', 'sales_order', '.', '_30000', 1, 5, b'10000000', NULL),
	('_30051', 'Create', 'Form', '_30051', '.', '_30050', 1, NULL, NULL, NULL),
	('_30052', 'Edit', 'Form', '_30052', '.', '_30050', 1, NULL, NULL, NULL),
	('_30053', 'Delete', 'Form', '_30053', '.', '_30050', 1, NULL, NULL, NULL),
	('_30054', 'Buat Invoice', 'Form', '_30054', '.', '_30050', 1, NULL, NULL, NULL),
	('_30055', 'Buat Do', 'Form', '_30055', 'Buat Do', '_30000', 1, NULL, b'00000000', NULL),
	('_30060', 'Pembuatan DO', 'Form', 'delivery_order', '.', '_30000', 1, 6, b'10000000', NULL),
	('_30061', 'Create', 'Form', '_30061', '.', '_30060', 1, NULL, NULL, NULL),
	('_30062', 'Edit', 'Form', '_30062', '.', '_30060', 1, NULL, NULL, NULL),
	('_30063', 'Delete', 'Form', '_30063', '.', '_30060', 1, NULL, NULL, NULL),
	('_30064', 'Print', 'Form', '_30064', '.', '_30060', 1, NULL, NULL, NULL),
	('_30070', 'Pembuatan Invoice Kontan', 'Form', 'invoice/kontan', '.', '_30000', 1, 8, b'10000000', NULL),
	('_30071', 'Create', 'Form', '_30071', '.', '_30070', 1, NULL, NULL, NULL),
	('_30072', 'Edit', 'Form', '_30072', '.', '_30070', 1, NULL, NULL, NULL),
	('_30073', 'Delete', 'Form', '_30073', '.', '_30070', 1, NULL, NULL, NULL),
	('_30074', 'Print', 'Form', '_30074', '.', '_30070', 1, NULL, NULL, NULL),
	('_30075', 'Posting', 'Form', '_30075', 'Posting', '_30070', 1, NULL, NULL, NULL),
	('_30080', 'Pembuatan Invoice dari DO', 'Form', 'invoice/do', '.', '_30000', 1, 7, b'10000000', NULL),
	('_30081', 'Save', 'Form', '_30081', '.', '_30080', 1, NULL, NULL, NULL),
	('_30090', 'Pembuatan Retur Penjualan', 'Form', 'invoice/retur', '.', '_30000', 1, 11, b'10000000', NULL),
	('_300900', '_300900', 'Form', '_300900', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_300901', '_300901', 'Form', '_300901', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_30091', 'Create', 'Form', '_30091', '.', '_30090', 1, NULL, NULL, NULL),
	('_30092', 'Edit', 'Form', '_30092', '.', '_30090', 1, NULL, NULL, NULL),
	('_30093', 'Delete', 'Form', '_30093', '.', '_30090', 1, NULL, NULL, NULL),
	('_30094', 'Print', 'Form', '_30094', '.', '_30090', 1, NULL, NULL, NULL),
	('_30095', 'Posting', 'Form', '_30095', '.', '_30090', 1, NULL, NULL, NULL),
	('_30100', 'Batch Posting', 'Form', 'so_batch_posting', '.', '_30000', 1, 14, b'10000000', NULL),
	('_30110', 'Pelunasan Piutang', 'Form', 'payments', '.', '_30000', 1, 10, b'10000000', NULL),
	('_30112', 'Proses', 'Form', '_30112', '.', '_30110', 1, NULL, NULL, NULL),
	('_30120', 'Kredit Nota', 'Form', 'so_credit_memo', '.', '_30000', 1, 12, b'10000000', NULL),
	('_30121', 'Create', 'Form', '_30121', '.', '_30100', 1, NULL, NULL, NULL),
	('_30122', 'Edit', 'Form', '_30122', '.', '_30120', 1, NULL, NULL, NULL),
	('_30123', 'Delete', 'Form', '_30123', '.', '_30120', 1, NULL, NULL, NULL),
	('_30124', 'Print', 'Form', '_30124', '.', '_30120', 1, NULL, NULL, NULL),
	('_30125', 'Posting', 'Form', '_30125', '.', '_30120', 1, NULL, NULL, NULL),
	('_30130', 'Debit Nota', 'Form', 'so_debit_memo', '.', '_30000', 1, 13, b'10000000', NULL),
	('_30131', 'Create', 'Form', '_30131', '.', '_30100', 1, NULL, NULL, NULL),
	('_30132', 'Edit', 'Form', '_30132', '.', '_30130', 1, NULL, NULL, NULL),
	('_30133', 'Delete', 'Form', '_30133', '.', '_30130', 1, NULL, NULL, NULL),
	('_30134', 'Print', 'Form', '_30134', '.', '_30130', 1, NULL, NULL, NULL),
	('_30135', 'Posting', 'Form', '_30135', '.', '_30130', 1, NULL, NULL, NULL),
	('_30140', 'Daftar Pelunasan Giro', 'Form', 'payments/giro', '.', '_30000', 1, 15, b'10000000', NULL),
	('_30141', 'Cairkan', 'Form', '_30141', '.', '_30100', 1, NULL, NULL, NULL),
	('_30142', 'Tolak', 'Form', '_30142', '.', '_30140', 1, NULL, NULL, NULL),
	('_30143', 'Hapus', 'Form', '_30143', '.', '_30140', 1, NULL, NULL, NULL),
	('_30150', 'Daftar Pelunasan Cash', 'Form', 'payments/cash', '.', '_30000', 1, 16, b'10000000', NULL),
	('_30151', 'Delete', 'Form', '_30151', '.', '_30150', 1, NULL, NULL, NULL),
	('_30160', 'Pembuatan Invoice Kredit', 'Form', 'invoice', '.', '_30000', 1, 8, b'10000000', NULL),
	('_30161', 'Create', 'Form', '_30161', '.', '_30160', 1, NULL, NULL, NULL),
	('_30162', 'Edit', 'Form', '_30162', '.', '_30160', 1, NULL, NULL, NULL),
	('_30163', 'Delete', 'Form', '_30163', '.', '_30160', 1, NULL, NULL, NULL),
	('_30164', 'Print', 'Form', '_30164', '.', '_30160', 1, NULL, NULL, NULL),
	('_30165', 'Posting', 'Form', '_30165', 'Posting', '_30160', 1, NULL, NULL, NULL),
	('_30170', '_30170', 'Form', '_30170', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_40000', 'Pembelian', 'Form', '_40000', 'Modul Hutang, A/P, Hutang, Pembayaran, Supplier dan Pembayaran.', '0', 1, 2, b'10000000', NULL),
	('_40010', 'Master Data Supplier', 'Form', 'supplier/browse', '.', '_40000', 1, 1, b'10000000', NULL),
	('_40011', 'Create', 'Form', '_40011', '.', '_40010', 1, NULL, NULL, NULL),
	('_40012', 'Edit', 'Form', '_40012', '.', '_40010', 1, NULL, NULL, NULL),
	('_40013', 'Delete', 'Form', '_40013', '.', '_40010', 1, NULL, NULL, NULL),
	('_40020', 'Setting Saldo Awal Hutang Supplier', 'Form', 'supplier/saldo_awal', '.', '_40000', 1, 2, b'10000000', NULL),
	('_40021', 'Proses', 'Form', '_40021', '.', '_40020', 1, NULL, NULL, NULL),
	('_40023', 'Delete', 'Form', '_40023', '.', '_40020', 1, NULL, NULL, NULL),
	('_40030', 'Arsip Bulanan Hutang Supplier', 'Form', 'supplier/proses_bulanan', '.', '_40000', 1, 13, b'10000000', NULL),
	('_40031', 'Proses', 'Form', '_40031', '.', '_40030', 1, NULL, NULL, NULL),
	('_40033', 'Delete', 'Form', '_40033', '.', '_40030', 1, NULL, NULL, NULL),
	('_40040', 'Pembuatan PO', 'Form', 'purchase_order', '.', '_40000', 1, 3, b'10000000', NULL),
	('_40041', 'Create', 'Form', '_40041', '.', '_40040', 1, NULL, NULL, NULL),
	('_40042', 'Edit', 'Form', '_40042', '.', '_40040', 1, NULL, NULL, NULL),
	('_40043', 'Delete', 'Form', '_40043', '.', '_40040', 1, NULL, NULL, NULL),
	('_40044', 'Print', 'Form', '_40044', '.', '_40040', 1, NULL, NULL, NULL),
	('_40045', 'Close PO Manual', 'Form', '_40045', 'Close PO Manual', '_40040', 1, NULL, NULL, NULL),
	('_40046', 'Buat Faktur', 'Form', '_40046', 'Buat Faktur', '_40040', 1, NULL, NULL, NULL),
	('_40047', 'Create Duplikat PO', 'Form', '_40047', 'Create Duplikat PO', '_40040', 1, NULL, NULL, NULL),
	('_40048', 'Daftar Penerimaan PO', 'Form', '_40048', 'Daftar Penerimaan PO', '_40040', 1, NULL, NULL, NULL),
	('_40049', 'Buat Faktur dari daftar penerimaan', 'Form', '_40049', 'Buat Faktur Dari daftar penerimaan', '_40040', 1, NULL, NULL, NULL),
	('_40050', 'Faktur Pembelian Kontan', 'Form', 'beli/kontan', '.', '_40000', 1, 5, b'10000000', NULL),
	('_40051', 'Create', 'Form', '_40051', '.', '_40050', 1, NULL, NULL, NULL),
	('_40052', 'Edit', 'Form', '_40052', '.', '_40050', 1, NULL, NULL, NULL),
	('_40053', 'Delete', 'Form', '_40053', '.', '_40050', 1, NULL, NULL, NULL),
	('_40054', 'Print', 'Form', '_40054', '.', '_40050', 1, NULL, NULL, NULL),
	('_40055', 'Posting', 'Form', '_40055', '.', '_40050', 1, NULL, NULL, NULL),
	('_40060', 'Pembuatan Retur Pembelian', 'Form', 'po_retur', '.', '_40000', 1, 7, b'10000000', NULL),
	('_40061', 'Create', 'Form', '_40061', '.', '_40060', 1, NULL, NULL, NULL),
	('_40062', 'Edit', 'Form', '_40062', '.', '_40060', 1, NULL, NULL, NULL),
	('_40063', 'Delete', 'Form', '_40063', '.', '_40060', 1, NULL, NULL, NULL),
	('_40064', 'Print', 'Form', '_40064', '.', '_40060', 1, NULL, NULL, NULL),
	('_40065', 'Posting', 'Form', '_40065', '.', '_40060', 1, NULL, NULL, NULL),
	('_40070', 'Pembayaran Hutang', 'Form', 'payables_payments', '.', '_40000', 1, 6, b'10000000', NULL),
	('_40071', 'Proses', 'Form', '_40071', '.', '_40070', 1, NULL, NULL, NULL),
	('_40080', 'Hutang Manager', 'Form', 'payables', '.', '_40000', 1, 8, b'10000000', NULL),
	('_40081', 'Create', 'Form', '_40081', '.', '_40080', 1, NULL, NULL, NULL),
	('_40082', 'Edit', 'Form', '_40082', '.', '_40080', 1, NULL, NULL, NULL),
	('_40083', 'Delete', 'Form', '_40083', '.', '_40080', 1, NULL, NULL, NULL),
	('_40084', 'Bayar Hutang', 'Form', '_40084', '.', '_40080', 1, NULL, NULL, NULL),
	('_40085', 'Posting', 'Form', '_40085', '.', '_40080', 1, NULL, NULL, NULL),
	('_40090', 'Kredit Memo', 'Form', 'po_credit_memo', '.', '_40000', 1, 9, b'10000000', NULL),
	('_40091', 'Create', 'Form', '_40091', '.', '_40090', 1, NULL, NULL, NULL),
	('_40092', 'Edit', 'Form', '_40092', '.', '_40090', 1, NULL, NULL, NULL),
	('_40093', 'Delete', 'Form', '_40093', '.', '_40090', 1, NULL, NULL, NULL),
	('_40094', 'Print', 'Form', '_40094', '.', '_40090', 1, NULL, NULL, NULL),
	('_40095', 'Posting', 'Form', '_40095', 'Posting', '_40090', 1, NULL, NULL, NULL),
	('_40100', 'Debit Memo', 'Form', 'po_debit_memo', '.', '_40000', 1, 10, b'10000000', NULL),
	('_40101', 'Create', 'Form', '_40101', '.', '_40100', 1, NULL, NULL, NULL),
	('_40102', 'Edit', 'Form', '_40102', '.', '_40100', 1, NULL, NULL, NULL),
	('_40103', 'Delete', 'Form', '_40103', '.', '_40100', 1, NULL, NULL, NULL),
	('_40104', 'Print', 'Form', '_40104', '.', '_40100', 1, NULL, NULL, NULL),
	('_40105', 'Posting', 'Form', '_40105', 'Posting', '_40100', 1, NULL, NULL, NULL),
	('_40110', 'Daftar Pembayaran Giro', 'Form', 'payables_payments/giro', '.', '_40000', 1, 11, b'10000000', NULL),
	('_40113', 'Cair', 'Form', '_40113', '.', '_40110', 1, NULL, NULL, NULL),
	('_40114', 'Tolak', 'Form', '_40114', '.', '_40110', 1, NULL, NULL, NULL),
	('_40115', 'Delete', 'Form', '_40115', '.', '_40110', 1, NULL, NULL, NULL),
	('_40120', 'Daftar Pembayaran Cash', 'Form', 'payables_payments/cash', '.', '_40000', 1, 12, b'10000000', NULL),
	('_40123', 'Delete', 'Form', '_40123', '.', '_40120', 1, NULL, NULL, NULL),
	('_40130', 'Faktur Pembelian Kredit', 'Form', 'beli', '.', '_40000', 1, 4, b'10000000', NULL),
	('_40131', 'Create', 'Form', '_40131', '.', '_40050', 1, NULL, NULL, NULL),
	('_40132', 'Edit', 'Form', '_40132', '.', '_40050', 1, NULL, NULL, NULL),
	('_40134', 'Delete', 'Form', '_40134', '.', '_40050', 1, NULL, NULL, NULL),
	('_40135', 'Print', 'Form', '_40135', '.', '_40050', 1, NULL, NULL, NULL),
	('_40136', 'Posting', 'Form', '_40136', '.', '_40050', 1, NULL, NULL, NULL),
	('_60000', 'Cash & Bank', 'Form', '_60000', 'Modul untuk pencatatan semua aktifitas kas atau bank.', '0', 1, 3, b'10000000', NULL),
	('_60010', 'Pembuatan Account Bank', 'Form', 'bank', '.', '_60000', 1, 1, b'10000000', NULL),
	('_60011', 'Create', 'Form', '_60011', '.', '_60010', 1, NULL, NULL, NULL),
	('_60012', 'Edit', 'Form', '_60012', '.', '_60010', 1, NULL, NULL, NULL),
	('_60013', 'Delete', 'Form', '_60013', '.', '_60010', 1, NULL, NULL, NULL),
	('_60020', 'Cash Masuk', 'Form', 'bank_cash/in', '.', '_60000', 1, 2, b'10000000', NULL),
	('_60021', 'Create', 'Form', '_60021', '.', '_60020', 1, NULL, NULL, NULL),
	('_60022', 'Edit', 'Form', '_60022', '.', '_60020', 1, NULL, NULL, NULL),
	('_60023', 'Delete', 'Form', '_60023', '.', '_60020', 1, NULL, NULL, NULL),
	('_60024', 'Print', 'Form', '_60024', '.', '_60020', 1, NULL, NULL, NULL),
	('_60025', 'Posting', 'Form', '_60025', '.', '_60020', 1, NULL, NULL, NULL),
	('_60030', 'Cash Keluar', 'Form', 'bank_cash/out', '.', '_60000', 1, 3, b'10000000', NULL),
	('_60031', 'Create', 'Form', '_60031', '.', '_60030', 1, NULL, NULL, NULL),
	('_60032', 'Edit', 'Form', '_60032', '.', '_60030', 1, NULL, NULL, NULL),
	('_60033', 'Delete', 'Form', '_60033', '.', '_60030', 1, NULL, NULL, NULL),
	('_60034', 'Print', 'Form', '_60034', '.', '_60030', 1, NULL, NULL, NULL),
	('_60035', 'Posting', 'Form', '_60035', '.', '_60030', 1, NULL, NULL, NULL),
	('_60040', 'Giro Masuk', 'Form', 'bank_giro/in', '.', '_60000', 1, 4, b'10000000', NULL),
	('_60041', 'Create', 'Form', '_60041', '.', '_60040', 1, NULL, NULL, NULL),
	('_60042', 'Edit', 'Form', '_60042', '.', '_60040', 1, NULL, NULL, NULL),
	('_60043', 'Delete', 'Form', '_60043', '.', '_60040', 1, NULL, NULL, NULL),
	('_60044', 'Print', 'Form', '_60044', '.', '_60040', 1, NULL, NULL, NULL),
	('_60045', 'Posting', 'Form', '_60045', '.', '_60040', 1, NULL, NULL, NULL),
	('_60050', 'Giro Keluar', 'Form', 'bank_giro/out', '.', '_60000', 1, 5, b'10000000', NULL),
	('_60051', 'Create', 'Form', '_60051', '.', '_60050', 1, NULL, NULL, NULL),
	('_60052', 'Edit', 'Form', '_60052', '.', '_60050', 1, NULL, NULL, NULL),
	('_60053', 'Delete', 'Form', '_60053', '.', '_60050', 1, NULL, NULL, NULL),
	('_60054', 'Print', 'Form', '_60054', '.', '_60050', 1, NULL, NULL, NULL),
	('_60055', 'Posting', 'Form', '_60055', '.', '_60050', 1, NULL, NULL, NULL),
	('_60060', 'Transfer Masuk', 'Form', 'bank_transfer/in', '.', '_60000', 1, 6, b'10000000', NULL),
	('_60061', 'Create', 'Form', '_60061', '.', '_60060', 1, NULL, NULL, NULL),
	('_60062', 'Edit', 'Form', '_60062', '.', '_60060', 1, NULL, NULL, NULL),
	('_60063', 'Delete', 'Form', '_60063', '.', '_60060', 1, NULL, NULL, NULL),
	('_60064', 'Print', 'Form', '_60064', '.', '_60060', 1, NULL, NULL, NULL),
	('_60065', 'Posting', 'Form', '_60065', '.', '_60060', 1, NULL, NULL, NULL),
	('_60070', 'Transfer Keluar', 'Form', 'bank_transfer/out', '.', '_60000', 1, 7, b'10000000', NULL),
	('_60071', 'Create', 'Form', '_60071', '.', '_60070', 1, NULL, NULL, NULL),
	('_60072', 'Edit', 'Form', '_60072', '.', '_60070', 1, NULL, NULL, NULL),
	('_60073', 'Delete', 'Form', '_60073', '.', '_60070', 1, NULL, NULL, NULL),
	('_60074', 'Print', 'Form', '_60074', '.', '_60070', 1, NULL, NULL, NULL),
	('_60075', 'Posting', 'Form', '_60075', '.', '_60070', 1, NULL, NULL, NULL),
	('_60080', 'Adjusment', 'Form', 'bank_adjust', '.', '_60000', 1, 8, b'10000000', NULL),
	('_60081', 'Create', 'Form', '_60081', '.', '_60080', 1, NULL, NULL, NULL),
	('_60082', 'Edit', 'Form', '_60082', '.', '_60080', 1, NULL, NULL, NULL),
	('_60083', 'Delete', 'Form', '_60083', '.', '_60080', 1, NULL, NULL, NULL),
	('_60085', 'Posting', 'Form', '_60085', '.', '_60080', 1, NULL, NULL, NULL),
	('_80000', 'Inventory', 'Form', '_80000', 'Modul Pengelolaan dan transaksi barang dagangan.', '0', 1, 4, b'10000000', NULL),
	('_80010', 'Master Data Stock', 'Form', 'inventory', '.', '_80000', 1, 1, b'10000000', NULL),
	('_80010.01', '_80010.01', 'Form', '_80010.01', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.02', '_80010.02', 'Form', '_80010.02', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.03', '_80010.03', 'Form', '_80010.03', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.04', '_80010.04', 'Form', '_80010.04', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.05', '_80010.05', 'Form', '_80010.05', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.06', '_80010.06', 'Form', '_80010.06', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.07', '_80010.07', 'Form', '_80010.07', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80011', 'Create', 'Form', '_80011', '.', '_80010', 1, NULL, NULL, NULL),
	('_80012', 'Edit', 'Form', '_80012', '.', '_80010', 1, NULL, NULL, NULL),
	('_80013', 'Delete', 'Form', '_80013', '.', '_80010', 1, NULL, NULL, NULL),
	('_80014', 'Serial Number', 'Form', '_80014', '.', '_80010', 1, NULL, NULL, NULL),
	('_80015', 'Ubah Kode', 'Form', '_80015', 'Ubah kode barang atau jasa', '_80010', 0, NULL, NULL, NULL),
	('_80020', 'Master Kategory', 'Form', 'category', '.', '_80000', 1, 2, b'10000000', NULL),
	('_80021', 'Create', 'Form', '_80021', '.', '_80020', 0, NULL, NULL, NULL),
	('_80022', 'Edit', 'Form', '_80022', '.', '_80020', 0, NULL, NULL, NULL),
	('_80023', 'Delete', 'Form', '_80023', '.', '_80020', 0, NULL, NULL, NULL),
	('_80024', 'Print', 'Form', '_80024', '.', '_80020', 0, NULL, NULL, NULL),
	('_80030', 'Master Gudang', 'Form', 'gudang', '.', '_80000', 1, 3, b'10000000', NULL),
	('_80031', 'Create', 'Form', '_80031', '.', '_80030', 0, NULL, NULL, NULL),
	('_80032', 'Edit', 'Form', '_80032', '.', '_80030', 0, NULL, NULL, NULL),
	('_80033', 'Delete', 'Form', '_80033', '.', '_80030', 0, NULL, NULL, NULL),
	('_80034', 'Print', 'Form', '_80034', '.', '_80030', 0, NULL, NULL, NULL),
	('_80040', 'Transfer Stock', 'Form', 'transfer', '.', '_80000', 1, 4, b'10000000', NULL),
	('_80041', 'Create', 'Form', '_80041', '.', '_80040', 0, NULL, NULL, NULL),
	('_80042', 'Edit', 'Form', '_80042', '.', '_80040', 0, NULL, NULL, NULL),
	('_80043', 'Delete', 'Form', '_80043', '.', '_80040', 0, NULL, NULL, NULL),
	('_80044', 'Print', 'Form', '_80044', '.', '_80040', 0, NULL, NULL, NULL),
	('_80050', 'Penerimaan dari PO', 'Form', 'receive', '.', '_80000', 1, 6, b'10000000', NULL),
	('_80051', 'Create', NULL, '_80051', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80052', 'Edit', NULL, '_80052', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80053', 'Delete', NULL, '_80053', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80054', 'Print', NULL, '_80054', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80060', 'Penerimaan Lain-lain', NULL, 'stock_recv_etc', NULL, '_80000', 1, 7, b'10000000', NULL),
	('_80061', 'Create', NULL, '_80061', NULL, '_80060', 0, NULL, NULL, NULL),
	('_80062', 'Edit', NULL, '_80062', NULL, '_80060', 0, NULL, NULL, NULL),
	('_80063', 'Delete', NULL, '_80063', NULL, '_80060', 0, NULL, NULL, NULL),
	('_80064', 'Print', 'Form', '_80064', '.', '_80060', 1, NULL, NULL, NULL),
	('_80070', 'Pengeluaran Lain-Lain', NULL, 'stock_send_etc', NULL, '_80000', 1, 8, b'10000000', NULL),
	('_80071', 'Create', NULL, '_80071', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80072', 'Edit', NULL, '_80072', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80073', 'Delete', NULL, '_80073', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80074', 'Print', NULL, '_80074', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80080', 'Pengeluaran ke WIP', NULL, '_80080', NULL, '_80000', 1, NULL, b'00000000', NULL),
	('_80081', 'Create', NULL, '_80081', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80082', 'Edit', NULL, '_80082', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80083', 'Delete', NULL, '_80083', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80084', 'Print', NULL, '_80084', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80090', 'Penerimaan dari WIP', NULL, '_80090', NULL, '_80000', 1, NULL, b'00000000', NULL),
	('_80091', 'Create', NULL, '_80091', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80092', 'Edit', NULL, '_80092', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80093', 'Delete', NULL, '_80093', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80094', 'Print', NULL, '_80094', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80100', 'Proses Assembly', NULL, 'assembly', NULL, '_80000', 1, 9, b'10000000', NULL),
	('_80101', 'Proses', NULL, '_80101', NULL, '_80100', 1, NULL, NULL, NULL),
	('_80110', 'Proses DisAssembly', NULL, 'disassembly', NULL, '_80000', 1, 10, b'10000000', NULL),
	('_80111', 'Proses', NULL, '_80111', NULL, '_80110', 1, NULL, NULL, NULL),
	('_80120', 'Adjusment Stock', NULL, 'stock_adjust', NULL, '_80000', 1, 5, b'10000000', NULL),
	('_80121', 'Proses', NULL, '_80121', NULL, '_80120', 1, NULL, NULL, NULL),
	('_80130', 'Arsip Bulanan Stock', NULL, 'stock_proses_bulanan', NULL, '_80000', 1, 11, b'10000000', NULL),
	('_80131', 'Proses', NULL, '_80131', NULL, '_80130', 1, NULL, NULL, NULL),
	('_80132', 'Delete', NULL, '_80132', NULL, '_80130', 1, NULL, NULL, NULL),
	('_80140', 'Setting Saldo Awal', NULL, 'stock_saldo_awal', NULL, '_80000', 1, 12, b'10000000', NULL),
	('_80141', 'Proses', NULL, '_80141', NULL, '_80140', 1, NULL, NULL, NULL),
	('_80200', 'Penerimaan barang non PO', NULL, '_80200', NULL, '_80000', 1, NULL, b'00000000', NULL),
	('_80201', 'Save', NULL, '_80201', NULL, '_80200', 1, NULL, NULL, NULL),
	('_80202', 'Print', NULL, '_80202', NULL, '_80200', 1, NULL, NULL, NULL),
	('_90000', 'Laporan', NULL, '_90000', 'Modul Daftar Laporan', '0', 1, 8, b'10000000', NULL),
	('_90010', 'General Ledger', 'Group', 'laporan/gl', 'Laporan General Ledger', '_90000', 1, 3, b'10000000', NULL),
	('_90011', '001. Daftar Perkiraan / Chart Of Accounts', 'Report', '\\Gl\\chartofaccount1.rpt', 'Daftar Perkiraan', '_90010', 1, NULL, NULL, NULL),
	('_90012', '002. Jurnal Transaksi - Sort by Kode Jurnal', NULL, '\\gl\\gltransactions1.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90013', '003. Jurnal Transaksi - Sort by Tanggal', NULL, '\\gl\\gltransactions2.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90014', '004. Kartu General Ledger', NULL, '\\Gl\\glCards.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90015', '005. Kartu General Ledger - All Date', NULL, '\\Gl\\glCards2.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90016', '006. Kartu General Ledger - All Date, Account', NULL, '\\Gl\\glCards3.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90017', '007. Neraca Percobaan', NULL, '\\gl\\trialbalances.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90018', '008. Laporan Rugi Laba', NULL, '\\gl\\incomestatement1.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90040', 'Inventory', NULL, 'laporan/stock', 'Laporan Inventory', '_90000', 1, 4, b'10000000', NULL),
	('_90041', '001. Daftar Stock Item Number', NULL, '\\Inv\\InvListing.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90042', '002. Daftar Stock per Gudang', NULL, '\\Inv\\PosisiStockGudang.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90043', '003. Daftar Stock - With Financial', NULL, '\\Inv\\DaftarBarang12.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90044', '004. Daftar Stock - With to Order', NULL, '\\Inv\\DaftarBarang11.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90045', '005. Formulir Stock Opname', NULL, '\\Inv\\FStockOpname.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90046', '006. Price List', NULL, '\\Inv\\PriceList.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90047', '007. Kartu Stock', NULL, '\\Inv\\KartuStock.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90048', '008. Kartu Stock Summary', NULL, '\\Inv\\KartuStockSum.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90049', '009. Penerimaan Barang - Detail by No PO', NULL, '\\PO\\TerimaByPO.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90050', '010. Penerimaan Barang - Detail by No Bukti', NULL, '\\PO\\TerimaByRecvId.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90051', '011. Penerimaan Barang - Detail by Item', NULL, '\\PO\\TerimaByItem.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90052', '012. Penerimaan Barang dari WIP', NULL, '\\PO\\TerimaFG.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90053', '013. Pengeluaran Barang ke WIP', NULL, '\\Po\\KeluarWO.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90054', '014. Retur Barang Penjualan', NULL, '\\inv\\TerimaReturPenjualan.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90055', '015. Retur Barang Pembelian ', NULL, '\\Po\\ReturBarangPembelian.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90056', '016. Transfer Stok Antar Gudang ', NULL, '\\inv\\Transfer001.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90057', '017. Laporan Assembly & Disassembly', NULL, '\\Inv\\AsmItem18.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90058', '018. Daftar Transaksi Stock - per Gudang', NULL, '\\Inv\\TransaksiInventory.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90070', 'Pembelian', NULL, 'laporan/pembelian', 'Laporan Pembelian', '_90000', 1, 2, b'10000000', NULL),
	('_90071', '001. Pembelian - Summary', NULL, '\\Po\\OrderPembelianSummary.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90072', '002. Pembelian  Per Supplier - Summary ', NULL, '\\Po\\OrderPembelianDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90073', '003. Pembelian  Per Supplier  - Detail ', NULL, '\\Po\\BeliSuppSum.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90074', '004. Pembelian  Per Item Summary', NULL, '\\Po\\OrderPembelianSupplierDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90075', '005. Pembelian  Per Item - Detail ', NULL, '\\Po\\PembelianItemSummary.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90076', '006. Pembelian  Per Katagori - Summary', NULL, '\\Po\\OrderPembelianItemDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90077', '007. Pembelian  Per Kategori - Detail ', NULL, '\\Po\\OrderPembelianItemKategoriSum.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90078', '009. Pembelian per Mata Uang', NULL, '\\Po\\OrderPembelianItemKategoriDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90079', '010. Laporan Pajak Masukan', NULL, '\\po\\BeliCurrency.Rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90080', '011. Daftar PO', NULL, '\\Po\\PajakMasukan.Rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90081', '012. Daftar PO - Detail', NULL, '\\PO\\DaftarPO.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90082', '013. Faktur Pembelian - Detail', NULL, '\\PO\\PODetailMonthly.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90083', '014. History Harga Per Supplier', NULL, '\\po\\PembelianDetail.Rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90084', '015. Selisih Kurs Pembelian', NULL, '\\Po\\HistoryHargaPerSupplier.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90090', 'Penjualan', NULL, 'laporan/penjualan', 'Laporan Penjualan', '_90000', 1, 1, b'10000000', NULL),
	('_90091', '001. Penjualan - Summary ', NULL, '\\So\\AnalisaPenjualanPerJenisFakturPerbulan.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90092', '002. Penjualan By Customer - Summary ', NULL, '\\So\\PenjualanCustomerSum.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90093', '003. Penjualan by Customer - Detail ', NULL, '\\So\\SumJualByCust.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90094', '004. Penjualan per Item - Summary', NULL, '\\So\\FakturPenjualanSummaryTrading.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90095', '005. Penjualan per Item - Detail', NULL, '\\So\\PenjualanPeritemDetailTrading.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90096', '006. Penjualan per kategori Item - Summary', NULL, '\\So\\AnalisaPenjualanPerkategoriSummary.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90097', '007. Penjualan Per Kategori - Detail', NULL, '\\So\\AnalisaPenjualanPerkategori.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90098', '008. Penjualan per Salesman - Summary', NULL, '\\So\\FakturPenjualanMonthSales.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90099', '009. Penjualan per Salesman - Detail', NULL, '\\So\\FakturPenjualanSummarySales.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90100', '010. Penjualan per wilayah - Summary', NULL, '\\So\\AnalisaPenjualanPerWilayahPerbulan.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90101', '011. Penjualan per Mata Uang', NULL, '\\so\\JualCurrency.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90102', '012. Faktur Penjualan - Detail', NULL, '\\So\\FakturPenjualan.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90103', '013. Retur Penjualan', NULL, '\\So\\ReturPenjualan.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90104', '014. Komisi Salesman', NULL, '\\So\\KomisiSalesman.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90105', '015. Laporan Pajak Keluaran', NULL, '\\So\\PajakKeluaran.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90106', '017. Daftar DO Customer', NULL, '\\SO\\DODetail300.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90107', '018. Daftar DO - Detail', NULL, '\\SO\\DODetail200.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90108', '019. History Harga Per Customer', NULL, '\\So\\HistoryHargaPerCustomer.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90109', '020. Selisih Kurs Penjualan', NULL, '\\so\\SelisihKursPiutang1.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90120', 'Supplier / Hutang', NULL, 'laporan/supplier', 'Laporan Supplier atau Hutang', '_90000', 1, 5, b'10000000', NULL),
	('_90121', '001. Daftar Supplier Urut Kode', NULL, '\\po\\DaftarSupplier2.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90122', '002. History Pembayaran Hutang Supplier', NULL, '\\po\\SuppPayHistory01.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90123', '003. Daftar Pembayaran Hutang', NULL, '\\po\\SuppPayHistory.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90124', '004. Kartu Hutang Supplier Summary', NULL, '\\po\\KartuHutangSum.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90125', '005. Kartu Hutang Supplier Detail', NULL, '\\Po\\KartuHutang.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90126', '006. Laporan Umur Hutang - Summary', NULL, '\\Po\\UmurHutang.Rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90127', '007. Laporan Umur Hutang Supplier - Summary', NULL, '\\Po\\UmurHutang_Supplier.Rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90128', '008. Laporan Umur Hutang Supplier - Detail', NULL, '\\Po\\UmurHutang_SupplierDetail.Rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90129', '009. Daftar Pembayaran Hutang - Currency', NULL, '\\PO\\BayarHutang0011.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90130', '010. Daftar Pembayaran Hutang per Supplier - Currency', NULL, '\\PO\\BayarHutang0012.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90131', '011. Daftar Hutang - Currency', NULL, '\\po\\DaftarHutang009.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90132', '012. Daftar Hutang per Supplier - Currency', NULL, '\\po\\DaftarHutang010.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90150', 'Customer / Piutang', NULL, 'laporan/customer', 'Laporan Customer atau Piutang', '_90000', 1, 6, b'10000000', NULL),
	('_90151', '001. Daftar Customer urut Kode', NULL, '\\so\\daftarcustomerkode.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90152', '002. History Pembayaran Piutang Customer', NULL, '\\So\\CustPayHistory01.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90153', '003. Daftar Pembayaran Piutang', NULL, '\\So\\CustPayHistory.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90154', '004. Kartu Piutang Customer - Summary', NULL, '\\so\\KartuPiutangSum.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90155', '005. Kartu Piutang Customer - Detail', NULL, '\\so\\KartuPiutang.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90156', '006. Laporan Umur Piutang - Summary', NULL, '\\So\\UmurPiutang.Rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90157', '007. Laporan Umur Piutang Pelanggan - Summary', NULL, '\\So\\UmurPiutang_Customer.Rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90158', '008. Laporan Umur Piutang Pelanggan - Detail', NULL, '\\So\\UmurPiutang_CustomerDetail.Rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90159', '009. Daftar Pembayaran Piutang - Currency', NULL, '\\SO\\BayarPiutang0010.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90160', '010. Daftar Pembayaran Piutang per Customer - Currency', NULL, '\\SO\\BayarPiutang0011.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90161', '011. Daftar Piutang - Currency', NULL, '\\so\\DaftarPiutang0011.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90162', '012. Daftar Piutang per Customer - Currency', NULL, '\\so\\DaftarPiutang0012.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_60084', 'Mutasi Antar Rekening', 'Form', 'bank_mutasi', NULL, '_60000', NULL, 9, b'10000000', NULL),
	('_14000', 'Fixed Asset', 'Form', '_14000', 'Aktiva Tetap', '0', 0, 0, b'00000000', ''),
	('_14001', 'Master Aktiva Tetap', 'Form', '_14001', 'Master Aktiva Tetap', '_14000', 0, 0, b'00000000', ''),
	('_12001', 'Employee Master', 'Form', '_12001', 'Data karyawan dan personel', '_12000', 0, 1, b'00000000', ''),
	('_13001', 'Master Anggota', 'Form', '_13001', 'Master data anggota koperasi', '_13000', 0, 1, b'00000000', ''),
	('_11001', 'Master Barang Jadi', 'Form', '_11001', 'Master Barang Jadi', '_11000', 0, 1, b'00000000', '');
;
";
if(mysql_query($sql))$msg .="<br>Data $table..OK";else $msg .="<br>$table..<br>ERROR -" . mysql_error();

$table="modules_group";
$sql="

CREATE TABLE IF NOT EXISTS `modules_groups` (
  `user_group_id` varchar(50) character set utf8 NOT NULL default '',
  `user_group_name` varchar(50) character set utf8 default NULL,
  `creation_date` datetime default NULL,
  `description` varchar(255) default NULL,
  `path_image` varchar(255) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`user_group_id`),
  UNIQUE KEY `x1` (`user_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg .="<br>$table..OK";else $msg .="<br>$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `modules_groups` (`user_group_id`, `user_group_name`, `creation_date`, `description`, `path_image`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
('ADM', 'Admin', NULL, 'Admin', NULL, NULL, NULL, NULL),
('BYR', 'Buyer', '2013-08-31 00:00:00', 'Buyer', '', 0, '', ''),
('FIN', 'Financial', '2013-08-31 00:00:00', 'Kelompok finansial bertugas untuk mencatat data keuangan', '', 0, '', ''),
('INV', 'Inventory', '2001-10-09 15:11:08', NULL, NULL, 1, NULL, NULL),
('KSR', 'Kasir', '2003-11-14 20:41:59', NULL, NULL, 1, NULL, NULL),
('PUR', 'Purchasing', '2001-10-09 15:10:52', '', 'a1.ico', 1, NULL, NULL),
('SLS', 'Sales', '2001-10-09 15:11:00', NULL, NULL, 1, NULL, NULL),
('SPV', 'Supervisor', '2003-11-18 12:31:45', '', '', 1, NULL, NULL),
('Administrator', 'Administrator', '2013-09-01 00:00:00', 'Administrator', '', 0, '', ''),
('Gudang', 'Gudang', '2009-12-25 16:55:55', 'Bagian gudang', 'D:daftar.ico', NULL, NULL, NULL),
('ANDRI', 'Khusus job untuk andri', '2013-09-07 00:00:00', 'Khusus Job untuk andri', '', 0, '', ''),
('SYSMENU', 'SYSMENU', '2006-09-23 20:59:05', 'aaaa', 'a1.ico', 1, NULL, NULL),
('DRV', 'Driver', NULL, 'Driver', NULL, NULL, NULL, NULL),
('COL', 'Collector', NULL, 'Collector', NULL, NULL, NULL, NULL),
";
if(mysql_query($sql))$msg .="<br>Data $table..OK";else $msg .="<br>$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `org_struct` (
  `org_id` varchar(50) character set utf8 NOT NULL,
  `org_name` varchar(50) character set utf8 default NULL,
  `address` varchar(250) character set utf8 default NULL,
  `phone` varchar(50) character set utf8 default NULL,
  `fax` varchar(50) character set utf8 default NULL,
  `contact_person` varchar(50) character set utf8 default NULL,
  `org_type` varchar(50) character set utf8 default NULL,
  `org_parent` varchar(50) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `source_id` varchar(50) character set utf8 default NULL,
  `is_head_office` bit(1) default NULL,
  PRIMARY KEY  (`org_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg .="<br>$table..OK";else $msg .="<br>$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `other_vendors` (
  `vendor_id` int(11) default NULL,
  `vendor_name` varchar(50) character set utf8 default NULL,
  `type_of_vendor` varchar(20) character set utf8 default NULL,
  `salutation` varchar(50) character set utf8 default NULL,
  `first_name` varchar(50) character set utf8 default NULL,
  `middle_initial` varchar(50) character set utf8 default NULL,
  `last_name` varchar(50) character set utf8 default NULL,
  `street` varchar(255) character set utf8 default NULL,
  `suite` varchar(50) character set utf8 default NULL,
  `city` varchar(50) character set utf8 default NULL,
  `state` varchar(10) character set utf8 default NULL,
  `zip_postal_code` varchar(20) character set utf8 default NULL,
  `country` varchar(50) character set utf8 default NULL,
  `phone` varchar(30) character set utf8 default NULL,
  `fax` varchar(30) character set utf8 default NULL,
  `payment_terms` varchar(255) character set utf8 default NULL,
  `credit_limit` double default NULL,
  `fed_tax_id` varchar(10) character set utf8 default NULL,
  `comments` double default NULL,
  `credit_balance` double default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
	if(mysql_query($sql))$msg .="<br>$table..OK";else $msg="<br>$table..<br>ERROR -" . mysql_error();
	break;

case 24:
	$table="payables";

	$sql="

CREATE TABLE IF NOT EXISTS `payables` (
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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `payables` (`bill_id`, `vendor_type`, `supplier_number`, `other_number`, `purchase_order`, `purchase_order_number`, `expense_type`, `account_id`, `invoice_number`, `invoice_date`, `amount`, `due_date`, `terms`, `discount_taken`, `purpose_of_expense`, `tax_deductible`, `comments`, `paid`, `posted`, `posting_gl_id`, `batch_post`, `X1099`, `invoice_received`, `items_received`, `many_po`, `curr_code`, `curr_rate`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `saldo_invoice`) VALUES
(1, NULL, 'ALFAMART', NULL, 1, '0', 'Purchase Order', 0, '0', '2012-11-25 00:00:00', 0, '2012-11-25 00:00:00', 'Kredit', 0, 'Purchase Order', 0, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 'KS', NULL, 1, 'PI00003', 'Purchase Order', NULL, 'PI00003', '2013-08-18 00:00:00', 92000, NULL, 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, 'YOGYA', NULL, 1, 'PO00118', 'Purchase Order', NULL, 'PO00118', '2014-03-25 07:00:00', 1000, '2014-03-25 07:00:00', 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, 'YOGYA', NULL, 1, 'PO00152', 'Purchase Order', NULL, 'PO00152', '2014-03-25 07:00:00', 1000, '2014-03-25 07:00:00', 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `payables_items` (
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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `payables_many_po` (
  `bill_id` int(11) default NULL,
  `purchase_order_number` varchar(50) character set utf8 default NULL,
  `payment_amount` double default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `payables_payments` (
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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

INSERT INTO `payables_payments` (`bill_id`, `line_number`, `date_paid`, `how_paid`, `how_paid_account_id`, `check_number`, `amount_paid`, `amount_alloc`, `trans_id`, `curr_code`, `curr_rate`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `purchase_order_number`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `no_bukti`, `paid_by`) VALUES
(1, 1, '2013-01-04 00:00:00', 'CASH OUT', 0, '', 6000, 0, 1, 'IDR', 1, NULL, NULL, NULL, 'PBL00115', NULL, NULL, NULL, NULL, 'APP00039', ''),
(0, 17, '2013-08-18 00:00:00', 'Cash', NULL, NULL, 190000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FBC0100004', NULL, NULL, NULL, NULL, 'APP00050', NULL),
(1, 12, '2013-08-17 00:00:00', 'Cash', NULL, NULL, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PBL00115', NULL, NULL, NULL, NULL, 'APP00045', NULL),
(0, 16, '2013-08-17 00:00:00', 'Giro', NULL, NULL, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PI00002', NULL, NULL, NULL, NULL, 'APP00049', NULL),
(1, 14, '2013-08-17 00:00:00', 'Cash', NULL, NULL, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PBL00115', NULL, NULL, NULL, NULL, 'APP00047', NULL),
(57, 33, '2014-03-24 07:00:00', '0', 1374, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PI00014', NULL, NULL, NULL, NULL, 'APP00066', NULL),
(57, 34, '2014-03-24 07:00:00', '1', 0, NULL, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PI00014', NULL, NULL, NULL, NULL, 'APP00067', NULL);
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 25:
	$table="payments";

	$sql="

CREATE TABLE IF NOT EXISTS `payments` (
  `invoice_number` varchar(50) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `date_paid` datetime default NULL,
  `how_paid` varchar(50) character set utf8 default NULL,
  `how_paid_acct_id` int(11) default NULL,
  `credit_card_number` varchar(50) character set utf8 default NULL,
  `expiration_date` varchar(50) character set utf8 default NULL,
  `authorization` varchar(50) character set utf8 default NULL,
  `amount_paid` double default NULL,
  `amount_alloc` double default NULL,
  `comments` double default NULL,
  `check_type` int(11) default NULL,
  `curr_code` varchar(50) character set utf8 default NULL,
  `curr_rate` double default NULL,
  `curr_rate_exc` double default NULL,
  `curr_code_org` varchar(50) character set utf8 default NULL,
  `curr_rate_org` double default NULL,
  `curr_selisih` double default NULL,
  `no_bukti` varchar(50) character set utf8 default NULL,
  `trans_id` int(11) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `receipt_by` varchar(50) character set utf8 default NULL,
  `credit_card_type` varchar(50) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `jenisuangmuka` int(11) default NULL,
  `angsur_no_dari` int(11) default NULL,
  `angsur_no_sampai` int(11) default NULL,
  `angsur_sisa` double default NULL,
  `angsur_lunas` double default NULL,
  `angsur_lunas_bunga` int(11) default NULL,
  `from_bank` varchar(50) default NULL,
  `from_account` varchar(50) default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

INSERT INTO `payments` (`invoice_number`, `line_number`, `date_paid`, `how_paid`, `how_paid_acct_id`, `credit_card_number`, `expiration_date`, `authorization`, `amount_paid`, `amount_alloc`, `comments`, `check_type`, `curr_code`, `curr_rate`, `curr_rate_exc`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `no_bukti`, `trans_id`, `org_id`, `update_status`, `receipt_by`, `credit_card_type`, `sourceautonumber`, `sourcefile`, `jenisuangmuka`, `angsur_no_dari`, `angsur_no_sampai`, `angsur_sisa`, `angsur_lunas`, `angsur_lunas_bunga`, `from_bank`, `from_account`) VALUES
('SO00055', 1, '2012-09-04 00:00:00', 'TRANS IN', NULL, NULL, NULL, 'dfasfda', 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abadfas', 'dasdf'),
('PJL00106', 160, '2014-03-02 00:00:00', '0', NULL, NULL, NULL, NULL, 101300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00083', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00106', 161, '2014-03-02 00:00:00', '0', NULL, NULL, NULL, NULL, 6000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00084', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00150', 162, '2014-03-02 00:00:00', '0', NULL, NULL, NULL, NULL, 9000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00085', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00104', 163, '2014-03-02 07:00:00', '0', 0, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00086', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00104', 164, '2014-03-02 07:00:00', '0', 0, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00086', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00107', 140, '2014-02-28 00:00:00', '0', 0, NULL, NULL, NULL, 800000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00073', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00153', 175, '2014-03-25 07:00:00', '0', 0, NULL, NULL, NULL, 9500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00095', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `payroll_link` (
  `last_check_file` varchar(255) character set utf8 default NULL,
  `last_gl_file` varchar(255) character set utf8 default NULL,
  `last_bank_account` varchar(50) character set utf8 default NULL,
  `last_source` int(11) default NULL,
  `last_selchecks` bit(1) default NULL,
  `last_selgl` bit(1) default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `pending_stock_opname` (
  `id` int(11) NOT NULL auto_increment,
  `barcode` varchar(50) character set utf8 default NULL,
  `qty` int(11) default NULL,
  `trans` varchar(50) character set utf8 default NULL,
  `shipment` varchar(50) character set utf8 default NULL,
  `artikel` varchar(50) character set utf8 default NULL,
  `price` int(11) default NULL,
  `size1` int(11) default NULL,
  `size2` int(11) default NULL,
  `size3` int(11) default NULL,
  `size4` int(11) default NULL,
  `size5` int(11) default NULL,
  `size6` int(11) default NULL,
  `size7` int(11) default NULL,
  `size8` int(11) default NULL,
  `size9` int(11) default NULL,
  `size10` int(11) default NULL,
  `total` int(11) default NULL,
  `current_price` int(11) default NULL,
  `current_total` int(11) default NULL,
  `process_count` int(11) default NULL,
  `qty_stock` int(11) default NULL,
  `qty_adjust` int(11) default NULL,
  `color` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `pending_stock_opname_tmp` (
  `id` int(11) NOT NULL auto_increment,
  `barcode` varchar(50) character set utf8 default NULL,
  `qty` int(11) default NULL,
  `trans` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 26:
	$table="preferences";

$sql="

CREATE TABLE IF NOT EXISTS `preferences` (
  `company_code` varchar(15) character set utf8 NOT NULL,
  `company_name` varchar(50) character set utf8 default NULL,
  `slogan` varchar(50) character set utf8 default NULL,
  `invoice_contact` varchar(50) character set utf8 default NULL,
  `purchase_order_contact` varchar(50) character set utf8 default NULL,
  `street` varchar(50) character set utf8 default NULL,
  `suite` varchar(50) character set utf8 default NULL,
  `city_state_zip_code` varchar(50) character set utf8 default NULL,
  `phone_number` varchar(50) character set utf8 default NULL,
  `fax_number` varchar(50) character set utf8 default NULL,
  `email` varchar(50) character set utf8 default NULL,
  `fed_tax_id` varchar(50) character set utf8 default NULL,
  `perpetual_inventory` tinyint(1) default NULL,
  `out_of_stock_checking` tinyint(1) default NULL,
  `purchase_order_restocking` tinyint(1) default NULL,
  `item_categories` tinyint(1) default NULL,
  `supplier_numbering` double default NULL,
  `default_invoice_type` double default NULL,
  `default_bank_account_number` varchar(50) character set utf8 default NULL,
  `default_credit_card_account` varchar(50) character set utf8 default NULL,
  `invoice_numbering` double default NULL,
  `use_sales_order_number` tinyint(1) default NULL,
  `customer_credit_account_number` int(11) default NULL,
  `supplier_credit_account_number` int(11) default NULL,
  `po_numbering` double default NULL,
  `invoice_message_copy__1` varchar(75) character set utf8 default NULL,
  `invoice_message_copy__2` varchar(75) character set utf8 default NULL,
  `invoice_message_copy__3` varchar(75) character set utf8 default NULL,
  `invoice_message_copy__4` varchar(75) character set utf8 default NULL,
  `invoice_message_copy__5` varchar(75) character set utf8 default NULL,
  `po_message_copy__1` varchar(75) character set utf8 default NULL,
  `po_message_copy__2` varchar(75) character set utf8 default NULL,
  `po_message_copy__3` varchar(75) character set utf8 default NULL,
  `po_message_copy__4` varchar(75) character set utf8 default NULL,
  `po_message_copy__5` varchar(75) character set utf8 default NULL,
  `bol_message_copy__1` varchar(75) character set utf8 default NULL,
  `bol_message_copy__2` varchar(75) character set utf8 default NULL,
  `bol_message_copy__3` varchar(75) character set utf8 default NULL,
  `bol_message_copy__4` varchar(75) character set utf8 default NULL,
  `inventory_tracking` double default NULL,
  `inventory_costing` double default NULL,
  `customer_order` double default NULL,
  `customer_numbering` double default NULL,
  `general_ledger` tinyint(1) default NULL,
  `freight_taxable` tinyint(1) default NULL,
  `other_taxable` tinyint(1) default NULL,
  `accounts_receivable` int(11) default NULL,
  `so_freight` int(11) default NULL,
  `so_other` int(11) default NULL,
  `so_tax` int(11) default NULL,
  `so_tax_2` int(11) default NULL,
  `so_discounts_given` int(11) default NULL,
  `accounts_payable` int(11) default NULL,
  `po_freight` int(11) default NULL,
  `po_other` int(11) default NULL,
  `po_tax` int(11) default NULL,
  `po_tax_2` int(11) default NULL,
  `po_discounts_taken` int(11) default NULL,
  `inventory` int(11) default NULL,
  `inventory_sales` int(11) default NULL,
  `inventory_cogs` int(11) default NULL,
  `maximize_on_640` tinyint(1) default NULL,
  `invoice_number` varchar(20) character set utf8 default NULL,
  `po_number` varchar(50) character set utf8 default NULL,
  `quote_number` varchar(22) character set utf8 default NULL,
  `sales_order_number` varchar(22) character set utf8 default NULL,
  `gl_post_date` int(11) default NULL,
  `security` tinyint(1) default NULL,
  `sales_selection` int(11) default NULL,
  `printed_check_password` varchar(50) character set utf8 default NULL,
  `unpost_password` varchar(50) character set utf8 default NULL,
  `undeposited_checks` tinyint(1) default NULL,
  `autostub` tinyint(1) default NULL,
  `startup_company_schedule` tinyint(1) default NULL,
  `po_show_items` double default NULL,
  `acctproglocation` varchar(100) character set utf8 default NULL,
  `payrollproglocation` varchar(100) character set utf8 default NULL,
  `payrolldatalocation` varchar(100) character set utf8 default NULL,
  `custbalupdated` datetime default NULL,
  `display_shiptos` double default NULL,
  `version` varchar(4) character set utf8 default NULL,
  `inventorysearch` int(11) default NULL,
  `barcodeinventorystandard` tinyint(1) default NULL,
  `barcodeinventorywarehouse` tinyint(1) default NULL,
  `barcodepo` tinyint(1) default NULL,
  `barcodesales` tinyint(1) default NULL,
  `invpridec` int(11) default NULL,
  `invqtydec` int(11) default NULL,
  `payrollsystem` double default NULL,
  `poitemdisplay` int(11) default NULL,
  `salesitemdisplay` int(11) default NULL,
  `salpridec` int(11) default NULL,
  `salqtydec` int(11) default NULL,
  `state_tax_id` varchar(15) character set utf8 default NULL,
  `gl_post_date_2` int(11) default NULL,
  `earning_account` int(11) default NULL,
  `year_earning_account` int(11) default NULL,
  `historical_balance_account` int(11) default NULL,
  `default_cash_payment_account` int(11) default NULL,
  `invamtdec` int(11) default NULL,
  `salamtdec` int(11) default NULL,
  `purpridec` int(11) default NULL,
  `purqtydec` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `preferences` (`company_code`, `company_name`, `slogan`, `invoice_contact`, `purchase_order_contact`, `street`, `suite`, `city_state_zip_code`, `phone_number`, `fax_number`, `email`, `fed_tax_id`, `perpetual_inventory`, `out_of_stock_checking`, `purchase_order_restocking`, `item_categories`, `supplier_numbering`, `default_invoice_type`, `default_bank_account_number`, `default_credit_card_account`, `invoice_numbering`, `use_sales_order_number`, `customer_credit_account_number`, `supplier_credit_account_number`, `po_numbering`, `invoice_message_copy__1`, `invoice_message_copy__2`, `invoice_message_copy__3`, `invoice_message_copy__4`, `invoice_message_copy__5`, `po_message_copy__1`, `po_message_copy__2`, `po_message_copy__3`, `po_message_copy__4`, `po_message_copy__5`, `bol_message_copy__1`, `bol_message_copy__2`, `bol_message_copy__3`, `bol_message_copy__4`, `inventory_tracking`, `inventory_costing`, `customer_order`, `customer_numbering`, `general_ledger`, `freight_taxable`, `other_taxable`, `accounts_receivable`, `so_freight`, `so_other`, `so_tax`, `so_tax_2`, `so_discounts_given`, `accounts_payable`, `po_freight`, `po_other`, `po_tax`, `po_tax_2`, `po_discounts_taken`, `inventory`, `inventory_sales`, `inventory_cogs`, `maximize_on_640`, `invoice_number`, `po_number`, `quote_number`, `sales_order_number`, `gl_post_date`, `security`, `sales_selection`, `printed_check_password`, `unpost_password`, `undeposited_checks`, `autostub`, `startup_company_schedule`, `po_show_items`, `acctproglocation`, `payrollproglocation`, `payrolldatalocation`, `custbalupdated`, `display_shiptos`, `version`, `inventorysearch`, `barcodeinventorystandard`, `barcodeinventorywarehouse`, `barcodepo`, `barcodesales`, `invpridec`, `invqtydec`, `payrollsystem`, `poitemdisplay`, `salesitemdisplay`, `salpridec`, `salqtydec`, `state_tax_id`, `gl_post_date_2`, `earning_account`, `year_earning_account`, `historical_balance_account`, `default_cash_payment_account`, `invamtdec`, `salamtdec`, `purpridec`, `purqtydec`, `update_status`) VALUES
('MYPOS', 'Sample Company', 'Software Development Company x', 'Bagian Penjualan', 'Bagian Pembelian', 'MyPOS Retail System', 'Baghdad Square - Royal Park', 'Ph. 021-200022x', '021-393939x', '021-939399x', '021-939399x', '002.299.1999.7.000', 1, 1, 1, 1, 0, 0, 'BCA', '100.1000.10000', 0, 1, 1373, 1421, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 1, 1, 1373, 1417, 1482, 1482, 1219, 1416, 1393, 1420, 1484, 1458, 1219, 1421, 1374, 1415, 1419, 1, '1006', NULL, NULL, '0', 443, 1, 0, NULL, 'Admin', 1, 1, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, 1, 1, 2, 2, 0, 1, 1, 2, 2, NULL, 1, 1483, 1408, 1410, 1370, NULL, NULL, 2, 2, 1),
('T01', 'TOKO ALAM JAYA', '', '', '', 'JL. RAYA SUBANG NO. 20 PURWAKARTA', '', 'PURWAKARTA', '0264-2929929', '0264-29292929', 'andri@talagasoft.com', '', 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '2014-03-09 00:00:00', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('T02', 'Toko Sabar Indah', NULL, NULL, NULL, 'Jl. Pinangsia No, 39', '0', 'Jakarta Kota', '021693883', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C01', 'Head Office', '', '', '', 'Jl. Raya Kalibata No. 29', '', 'Jakarta', '021-2020022', '', '', '', 0, 0, 0, 0, 0, 0, '1485', '0', 0, 0, 1416, 1421, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 1373, 1417, 1482, 1396, 0, 1416, 1373, 1420, 1503, 1396, 0, 1421, 1374, 1415, 1419, 0, '', '', '', '', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '2013-09-08 00:00:00', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1483, 1408, 1411, 1370, 0, 0, 0, 0, 0),
('C02', 'Budidaya Lele', '', '', '', 'JL. RAYA SADANG NO. 29', '', 'Purwakarta', '08219292', '02192828', 'budi@localhost.com', '', 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '2014-03-02 00:00:00', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 27:
	$table="promosi";

$sql="

CREATE TABLE IF NOT EXISTS `promosi_disc` (
  `promosi_code` varchar(50) character set utf8 NOT NULL,
  `description` varchar(50) character set utf8 default NULL,
  `date_from` datetime default NULL,
  `category` int(11) default NULL,
  `date_to` datetime default NULL,
  `tipe` int(11) default NULL,
  `qty` double default NULL,
  `nilai` double default NULL,
  `issameitem` int(11) default NULL,
  `update_status` int(11) default NULL,
  `outlet` varchar(50) character set utf8 default NULL,
  `disc_base` varchar(50) character set utf8 default NULL,
  `total_sales` double default NULL,
  `method` int(11) default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `flag1` bit(1) default NULL,
  `flag2` bit(1) default NULL,
  `flag3` bit(1) default NULL,
  `flag4` bit(1) default NULL,
  `flag5` bit(1) default NULL,
  PRIMARY KEY  (`promosi_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `promosi_extra_item` (
  `id` int(11) NOT NULL auto_increment,
  `promosi_code` varchar(50) character set utf8 default NULL,
  `item_number` varchar(50) character set utf8 default NULL,
  `description` varchar(50) character set utf8 default NULL,
  `table_name` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `field1` varchar(50) character set utf8 default NULL,
  `field2` varchar(50) character set utf8 default NULL,
  `field3` varchar(50) character set utf8 default NULL,
  `field4` varchar(50) character set utf8 default NULL,
  `field5` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  KEY `x1` (`promosi_code`,`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `promosi_item` (
  `promosi_code` varchar(50) character set utf8 default NULL,
  `item_number` varchar(50) character set utf8 default NULL,
  `description` varchar(50) character set utf8 default NULL,
  `table_name` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`promosi_code`,`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `promosi_item_category` (
  `id` int(11) NOT NULL auto_increment,
  `promosi_code` varchar(50) character set utf8 default NULL,
  `kode_category` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `promosi_item_customer` (
  `id` int(11) NOT NULL auto_increment,
  `promosi_code` varchar(50) character set utf8 default NULL,
  `cust_code` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `promosi_outlet` (
  `outlet` varchar(50) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `promosi_point_transactions` (
  `id` int(11) NOT NULL auto_increment,
  `cust_code` varchar(50) character set utf8 default NULL,
  `tanggal` datetime default NULL,
  `jenis_transaksi` varchar(50) character set utf8 default NULL,
  `point` int(11) default NULL,
  `amount` int(11) default NULL,
  `ref1` varchar(50) character set utf8 default NULL,
  `ref2` varchar(50) character set utf8 default NULL,
  `ref3` varchar(50) character set utf8 default NULL,
  `ref4` varchar(50) character set utf8 default NULL,
  `ref5` varchar(50) character set utf8 default NULL,
  `nilai` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `promosi_time` (
  `time_value` varchar(50) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 28:
	$table="purchase_order";

$sql="

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `purchase_order_number` varchar(50) character set utf8 NOT NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `po_date` datetime default NULL,
  `due_date` datetime default NULL,
  `inv_date` datetime default NULL,
  `ship_to_contact` varchar(15) character set utf8 default NULL,
  `bill_to_contact` varchar(15) character set utf8 default NULL,
  `ordered_by` varchar(50) character set utf8 default NULL,
  `terms` varchar(50) character set utf8 default NULL,
  `fob` varchar(50) character set utf8 default NULL,
  `shipped_via` varchar(50) character set utf8 default NULL,
  `ship_date` varchar(50) character set utf8 default NULL,
  `approved_by` varchar(50) character set utf8 default NULL,
  `approved_date` datetime default NULL,
  `freight` double default NULL,
  `tax` double default NULL,
  `tax_2` double default NULL,
  `other` double default NULL,
  `received` tinyint(1) default NULL,
  `paid` tinyint(1) default NULL,
  `ship_customer_display` varchar(50) character set utf8 default NULL,
  `bill_customer_display` varchar(50) character set utf8 default NULL,
  `posted` tinyint(1) default NULL,
  `posting_gl_id` varchar(50) character set utf8 default NULL,
  `discount` double default NULL,
  `potype` varchar(5) character set utf8 default NULL,
  `po_ref` varchar(50) character set utf8 default NULL,
  `uang_muka` double default NULL,
  `saldo_invoice` double default NULL,
  `comments` varchar(250) default NULL,
  `account_id` int(11) default NULL,
  `disc_amount_1` double default NULL,
  `disc_2` double(11,0) default NULL,
  `disc_amount_2` double default NULL,
  `disc_3` double(11,0) default NULL,
  `disc_amount_3` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `amount` double default NULL,
  `type_of_invoice` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `tax_amount` double default NULL,
  `warehouse_code` varchar(50) default NULL,
  `currency_code` varchar(50) default NULL,
  `currency_rate` double default NULL,
  `subtotal` double default NULL,
  PRIMARY KEY  (`purchase_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `purchase_order_lineitems` (
  `purchase_order_number` varchar(50) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `item_number` varchar(50) character set utf8 default NULL,
  `stock_item_number` varchar(50) character set utf8 default NULL,
  `date_expec` datetime default NULL,
  `date_recvd` datetime default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `price` double default NULL,
  `received` tinyint(1) default NULL,
  `comment` double default NULL,
  `serial_number` varchar(255) character set utf8 default NULL,
  `color` varchar(20) character set utf8 default NULL,
  `size` varchar(10) character set utf8 default NULL,
  `qty_recvd` double(11,0) default NULL,
  `quantity` double(11,0) default NULL,
  `discount` double(11,2) default NULL,
  `total_price` double default NULL,
  `unit` varchar(50) character set utf8 default NULL,
  `currency_code` varchar(50) character set utf8 default NULL,
  `currency_rate` double default NULL,
  `multi_unit` varchar(50) character set utf8 default NULL,
  `mu_qty` double(11,0) default NULL,
  `mu_harga` double default NULL,
  `forex_price` double default NULL,
  `base_curr_amount` double default NULL,
  `inventory_account` int(11) default NULL,
  `disc_amount_1` double default NULL,
  `disc_2` double(11,0) default NULL,
  `disc_amount_2` double default NULL,
  `disc_3` double(11,0) default NULL,
  `disc_amount_3` double default NULL,
  `update_status` int(11) default NULL,
  `from_line_number` int(11) default NULL,
  `from_line_type` varchar(50) character set utf8 default NULL,
  `from_line_doc` varchar(50) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `retail` double default NULL,
  `dept` varchar(50) character set utf8 default NULL,
  `dept_sub` varchar(50) character set utf8 default NULL,
  `price_margin` int(11) default NULL,
  `warehouse_code` varchar(50) default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=313 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `quotation` (
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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `quotation_lineitems` (
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
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 31:
	$table="report_list";

	$sql="

CREATE TABLE IF NOT EXISTS `report_list` (
  `report_code` varchar(75) character set utf8 NOT NULL,
  `report_name` varchar(255) character set utf8 default NULL,
  `report_category` double default NULL,
  `query_name` double default NULL,
  `description` double default NULL,
  `date_selectors` bit(1) default NULL,
  `category_selectors` bit(1) default NULL,
  `category_query` varchar(255) default NULL,
  `category_text` varchar(255) default NULL,
  `category_2_selectors` bit(1) default NULL,
  `category_2_query` varchar(255) default NULL,
  `category_2_text` varchar(255) default NULL,
  `image` double default NULL,
  `criteriatype` varchar(50) character set utf8 default NULL,
  `criteria2type` varchar(50) character set utf8 default NULL,
  `report_filename` varchar(50) character set utf8 default NULL,
  `field_selection` varchar(255) default NULL,
  `date_field_selection` varchar(255) default NULL,
  `field_2_selection` varchar(255) default NULL,
  `visible` bit(1) default NULL,
  `created_date` datetime default NULL,
  `update_status` int(11) default NULL,
  `criteria3type` varchar(50) character set utf8 default NULL,
  `category_3_selectors` bit(1) default NULL,
  `category_3_query` varchar(250) character set utf8 default NULL,
  `category_3_text` varchar(250) character set utf8 default NULL,
  `field_3_selection` varchar(250) character set utf8 default NULL,
  `criteria4type` varchar(50) character set utf8 default NULL,
  `category_4_selectors` bit(1) default NULL,
  `category_4_query` varchar(250) character set utf8 default NULL,
  `field_4_selection` varchar(250) character set utf8 default NULL,
  `category_4_text` varchar(250) character set utf8 default NULL,
  `criteria5type` varchar(50) character set utf8 default NULL,
  `category_5_selectors` bit(1) default NULL,
  `category_5_query` varchar(250) character set utf8 default NULL,
  `field_5_selection` varchar(250) character set utf8 default NULL,
  `category_5_text` varchar(250) character set utf8 default NULL,
  PRIMARY KEY  (`report_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `rpt_open_to_buy` (
  `item_number` varchar(50) character set utf8 default NULL,
  `period_mm` int(11) default NULL,
  `opening_stock` double default NULL,
  `forecast_sales` double default NULL,
  `period_forward_cover` double default NULL,
  `closing_stock_required` double default NULL,
  `intake_required` double default NULL,
  `on_order` double default NULL,
  `otb_remaining` double default NULL,
  `closing_stock` double default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `salesman` (
  `salesman` varchar(50) character set utf8 NOT NULL,
  `commission_rate_1` int(11) default NULL,
  `commission_rate_2` int(11) default NULL,
  `salestype` varchar(10) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`salesman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `salesman_group` (
  `groupid` varchar(20) character set utf8 NOT NULL,
  `salesman` varchar(50) character set utf8 default NULL,
  `komisiprc` double(11,0) default NULL,
  `remarks` varchar(100) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `salesman_group_komisi` (
  `created_date` datetime default NULL,
  `groupid` varchar(50) character set utf8 NOT NULL,
  `salesman` varchar(50) character set utf8 default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `invoice_amount` double default NULL,
  `komisi_prc` double(11,0) default NULL,
  `komisi_amount` double default NULL,
  `keterangan` varchar(100) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `salesman_komisi` (
  `low_amount` double default NULL,
  `high_amount` double default NULL,
  `persen_komisi` double(11,0) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 32:
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
  PRIMARY KEY  (`sales_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


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
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=254 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `sales_tax_rates` (
  `code` varchar(10) character set utf8 NOT NULL,
  `tax_rate` int(11) default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `service_jobs` (
  `job_id` varchar(50) character set utf8 NOT NULL,
  `service_number` varchar(50) character set utf8 default NULL,
  `teknisi` varchar(50) character set utf8 default NULL,
  `garansi` bit(1) default NULL,
  `job_finish` bit(1) default NULL,
  `ongkos_kerja` double default NULL,
  `masalah` varchar(50) character set utf8 default NULL,
  `pekerjaan` varchar(50) character set utf8 default NULL,
  `biaya_lain` double default NULL,
  `total_amt_part` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `service_job_sparepart` (
  `job_id` varchar(50) character set utf8 default NULL,
  `qty` int(11) default NULL,
  `item_number` varchar(50) character set utf8 default NULL,
  `description` varchar(200) character set utf8 default NULL,
  `harga` double default NULL,
  `total` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `service_order` (
  `no_bukti` varchar(50) character set utf8 NOT NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `alt_phone` varchar(50) character set utf8 default NULL,
  `cust_po` varchar(50) character set utf8 default NULL,
  `serv_rep` varchar(50) character set utf8 default NULL,
  `manufacture` varchar(50) character set utf8 default NULL,
  `model` varchar(50) character set utf8 default NULL,
  `serial` varchar(50) character set utf8 default NULL,
  `alt_id` varchar(50) character set utf8 default NULL,
  `service_amt` double default NULL,
  `ongkos_amt` double default NULL,
  `kirim_amt` double default NULL,
  `lain_amt` double default NULL,
  `ppn_prc` double(11,0) default NULL,
  `ppn_amt` double default NULL,
  `disc_prc` double(11,0) default NULL,
  `disc_amt` double default NULL,
  `comments` double default NULL,
  `tanggal` datetime default NULL,
  `tanggal_selesai` datetime default NULL,
  `tanggal_beli` datetime default NULL,
  `selesai` bit(1) default NULL,
  `part_amt` double default NULL,
  `tanggal_akhir_garansi` datetime default NULL,
  `source_invoice_no` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`no_bukti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

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
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `shipping_locations` (
  `location_number` varchar(15) character set utf8 NOT NULL,
  `address_type` varchar(15) character set utf8 default NULL,
  `attention_name` varchar(50) character set utf8 default NULL,
  `company_name` varchar(50) character set utf8 default NULL,
  `street` varchar(250) character set utf8 default NULL,
  `suite` varchar(250) character set utf8 default NULL,
  `city` varchar(50) character set utf8 default NULL,
  `state` varchar(50) character set utf8 default NULL,
  `zip` varchar(50) character set utf8 default NULL,
  `country` varchar(50) character set utf8 default NULL,
  `phone` varchar(50) character set utf8 default NULL,
  `fax` varchar(20) character set utf8 default NULL,
  `other_phone` varchar(20) character set utf8 default NULL,
  `comments` double default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`location_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `shipping_locations` (`location_number`, `address_type`, `attention_name`, `company_name`, `street`, `suite`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `other_phone`, `comments`, `update_status`) VALUES
('Jakarta', 'Gudang', NULL, NULL, 'Jl. Raya Sadang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Jogja', 'Penyimpanan', '', '', 'JL. GARUDA KEMAYORAN', '', '', '', '', '', '', '', '', 0, 0),
('Bekasi', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Medan', 'Penyimpanan', '', '', 'Jl. Sunter 80', '', '', '', '', '', '', '', '', 0, 0),
('Purwakarta', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Surabaya', 'Penyimpanan', '', '', 'Jl. Raya pejaten timur no. 28', '', '', '', '', '', '', '', '', 0, 0),
('Ambon', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Bali', 'Penyimpanan', 'Husni', NULL, 'Jl. Raya Sabrang', NULL, 'Bali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `source_of_order` (
  `source_of_order` varchar(50) character set utf8 NOT NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`source_of_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 33:
	$table="supplier";

$sql="
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_number` varchar(50) character set utf8 NOT NULL,
  `active` int(1) default NULL,
  `supplier_other_vendor` varchar(50) character set utf8 default NULL,
  `supplier_account_number` varchar(50) character set utf8 default NULL,
  `type_of_vendor` varchar(20) character set utf8 default NULL,
  `supplier_name` varchar(50) character set utf8 default NULL,
  `salutation` varchar(50) character set utf8 default NULL,
  `first_name` varchar(50) character set utf8 default NULL,
  `middle_initial` varchar(50) character set utf8 default NULL,
  `last_name` varchar(50) character set utf8 default NULL,
  `street` varchar(255) character set utf8 default NULL,
  `suite` varchar(50) character set utf8 default NULL,
  `city` varchar(50) character set utf8 default NULL,
  `state` varchar(50) character set utf8 default NULL,
  `zip_postal_code` varchar(20) character set utf8 default NULL,
  `country` varchar(50) character set utf8 default NULL,
  `phone` varchar(30) character set utf8 default NULL,
  `fax` varchar(30) character set utf8 default NULL,
  `email` varchar(50) character set utf8 default NULL,
  `payment_terms` varchar(255) character set utf8 default NULL,
  `credit_limit` double default NULL,
  `fed_tax_id` varchar(50) character set utf8 default NULL,
  `comments` varchar(255) default NULL,
  `credit_balance` double default NULL,
  `default_account` int(11) default NULL,
  `x1099` bit(1) default NULL,
  `x1099fedwithheld` double default NULL,
  `x1099line` int(11) default NULL,
  `x1099statewithheld` double default NULL,
  `print1099` bit(1) default NULL,
  `state_tax_id` varchar(20) character set utf8 default NULL,
  `plafon_hutang` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `acc_biaya` int(11) default NULL,
  PRIMARY KEY  (`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `suppliers` (`supplier_number`, `active`, `supplier_other_vendor`, `supplier_account_number`, `type_of_vendor`, `supplier_name`, `salutation`, `first_name`, `middle_initial`, `last_name`, `street`, `suite`, `city`, `state`, `zip_postal_code`, `country`, `phone`, `fax`, `email`, `payment_terms`, `credit_limit`, `fed_tax_id`, `comments`, `credit_balance`, `default_account`, `x1099`, `x1099fedwithheld`, `x1099line`, `x1099statewithheld`, `print1099`, `state_tax_id`, `plafon_hutang`, `org_id`, `update_status`, `create_date`, `create_by`, `update_date`, `update_by`, `acc_biaya`) VALUES
('ALFAMART', 1, '', '1393', '', 'ALFAMART', '', '', '', '', 'JL. RAYA PURWAKARTA NO. 38', 'Gedung Indofood lantai 20', 'Jakarta', '', '', '', '62212002992', '0299200111', 'andri@talagasoft.com', 'Kredit 30 Hari', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2014-01-05 00:00:00', '', '2014-01-05 00:00:00', '', 1452),
('KS', 1, '', '1393', '', 'Krakatau Steel, PT', '', '', '', '', 'Jl. Raya Serang Km. 200', 'Banten', 'Banten', '', '', '', '029100000', '', '', '', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2013-08-18 00:00:00', '', '2013-08-18 00:00:00', '', 0),
('INDOMART', 1, '', '1393', '', 'INDOMART', '', '', '', '', 'Purwakarta', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2013-08-14 00:00:00', '', '2013-08-14 00:00:00', '', 1423),
('YOGYA', 1, '', '1393', '', 'YOGYA Dept Store', '', '', '', '', 'Jl. Jend. Sudirman', 'Purwakarta', '', '', '', '', '', '', 'yogya@localhost', '60 Hari', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2014-03-24 00:00:00', '', '2014-03-24 00:00:00', '', 1423);
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `supplier_beginning_balance` (
  `tanggal` datetime default NULL,
  `supplier_number` varchar(50) character set utf8 default NULL,
  `hutang_awal` double default NULL,
  `hutang` double default NULL,
  `hutang_akhir` double default NULL,
  `amountin` double default NULL,
  `amountout` double default NULL,
  `flagawal` bit(1) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  UNIQUE KEY `x1` (`tanggal`,`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `syslog` (
  `tgljam` datetime default NULL,
  `computer` varchar(50) character set utf8 default NULL,
  `userid` varchar(50) character set utf8 default NULL,
  `logtext` varchar(250) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `sysreportdesign` (
  `report_group` varchar(50) character set utf8 default NULL,
  `sequence` int(11) default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `formulas` varchar(255) character set utf8 default NULL,
  `debitorcredit` varchar(50) character set utf8 default NULL,
  `plusorminus` varchar(50) character set utf8 default NULL,
  `fonttype` varchar(50) character set utf8 default NULL,
  `colvalue1` double default NULL,
  `colvalue2` double default NULL,
  `colvalue3` double default NULL,
  `colvalue4` double default NULL,
  `id` int(11) NOT NULL auto_increment,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `sysreportdesignfiles` (
  `filename` varchar(50) character set utf8 NOT NULL,
  `report_group` varchar(50) character set utf8 default NULL,
  `sequence` int(11) default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `formulas` varchar(255) character set utf8 default NULL,
  `debitorcredit` varchar(50) character set utf8 default NULL,
  `plusorminus` varchar(50) character set utf8 default NULL,
  `fonttype` varchar(50) character set utf8 default NULL,
  `colvalue1` double default NULL,
  `colvalue2` double default NULL,
  `colvalue3` double default NULL,
  `colvalue4` double default NULL,
  `id` int(11) NOT NULL auto_increment,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

	break;

case 34:
	$table="sysvar";
$sql="

CREATE TABLE IF NOT EXISTS `system_variables` (
  `varname` varchar(50) character set utf8 default NULL,
  `varlen` int(11) default NULL,
  `varvalue` varchar(50) character set utf8 default NULL,
  `keterangan` varchar(200) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  `update_status` int(11) default NULL,
  `section` varchar(50) character set utf8 default NULL,
  `category` varchar(50) character set utf8 default NULL,
  `vartype` varchar(50) character set utf8 default NULL,
  `varlist` varchar(250) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=568 ;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `system_variables` (`varname`, `varlen`, `varvalue`, `keterangan`, `id`, `update_status`, `section`, `category`, `vartype`, `varlist`) VALUES
('A/R Payment Numbering', 14, '!ARP~@-~$00001', '', 1, 1, 'Purchase', 'Auto Numbering', 'String', ''),
('A/R Payment Numbering - AutoNumber', 7, '1', '', 2, 1, 'Purchase', '', '', ''),
('Admin Password', 3, 'bos', '', 5, 1, 'Inventory', 'Auto Numbering', '', ''),
('Allow Qty Stock Minus', 4, 'True', '', 6, 1, 'System', 'Auto Numbering', '', ''),
('AP Numbering', 14, '!ARP~@-~#MM~#DD~#YY~$00009', '', 7, 1, 'Purchase', 'Auto Numbering', '', ''),
('AP Numbering - AutoNumber', 7, '1', '', 8, 1, 'Purchase', 'Auto Numbering', '', ''),
('AP Payment Numbering', 14, '!APP~$00051', '', 9, 1, 'Sales', 'Auto Numbering', '', ''),
('AR Payment Numbering', 14, '!ARP~$00070', '', 10, 1, 'Sales', 'Auto Numbering', '', ''),
('AskAdminPassForExit', 5, 'False', 'NIL', 11, 1, 'Inventory', 'Auto Numbering', '', ''),
('Assembly Numbering', 14, '!ASM~@-~$00010', '', 12, 1, 'System', NULL, NULL, NULL),
('Assembly Numbering - AutoNumber', 7, '1', '', 13, 1, 'System', '', '', ''),
('AutoComplete', 5, 'True', NULL, 14, 1, 'System', NULL, NULL, NULL),
('AutoLogon', 1, '1', NULL, 15, 1, 'System', NULL, NULL, NULL),
('AutoLookUp', 4, 'True', NULL, 16, 1, 'System', NULL, NULL, NULL),
('Bersihkan Input', 1, 'True', '', 17, 1, 'Accounting', 'Auto Numbering', '', ''),
('Cetak_CreditCard', 1, '1', NULL, 18, 1, 'System', NULL, NULL, NULL),
('Cetak_LainLain', 1, '1', NULL, 19, 1, 'System', NULL, NULL, NULL),
('Cetak_PPN', 1, '1', NULL, 20, 1, 'System', NULL, NULL, NULL),
('COA Uang Muka', 4, '1209', '', 21, 1, 'Inventory', 'Auto Numbering', '', ''),
('COA Uang Muka Pembelian', 4, '1370', '', 22, 1, 'System', NULL, NULL, NULL),
('COA Uang Muka Penjualan', 4, '1370', '', 23, 1, 'System', NULL, NULL, NULL),
('CRDB SO Numbering', 15, '!CRDB~@-~$00107', '', 24, 1, 'System', NULL, NULL, NULL),
('current_org_id', 3, '000', 'struktur organisasi aktif', 25, 1, 'System', NULL, NULL, NULL),
('DisAssembly Numbering', 15, '!DASM~$00001', NULL, 26, 1, 'System', NULL, NULL, NULL),
('DisAssembly Numbering - AutoNumber', 7, '0', NULL, 27, 1, 'System', NULL, NULL, NULL),
('Display Supplier/Customer', 4, 'True', NULL, 28, 1, 'System', NULL, NULL, NULL),
('DisplayError', 1, 'True', '', 29, 1, 'System', NULL, NULL, NULL),
('Footer1', 11, 'Terimakasih', NULL, 76, 1, 'System', NULL, NULL, NULL),
('Footer2', 7, 'Footer2', NULL, 77, 1, 'System', NULL, NULL, NULL),
('Footer3', 7, 'Footer3', NULL, 78, 1, 'System', NULL, NULL, NULL),
('FormatNumeric', 14, '###,###,##0.00', NULL, 79, 1, 'System', NULL, NULL, NULL),
('GL Journal Numbering', 25, '!JU~$00004', '', 80, 1, 'Accounting', 'Auto Numbering', '', ''),
('GL Journal Numbering - AutoNumber', 1, '1', '', 81, 1, 'System', NULL, NULL, NULL),
('gstrTahunAktif', 0, '2001', NULL, 82, 1, 'System', NULL, NULL, NULL),
('Header1', 7, 'Header1', NULL, 83, 1, 'System', NULL, NULL, NULL),
('Header2', 7, 'Header2', NULL, 84, 1, 'System', NULL, NULL, NULL),
('Header3', 7, 'Header3', NULL, 85, 1, 'System', NULL, NULL, NULL),
('height', 0, '11190', NULL, 86, 1, 'System', NULL, NULL, NULL),
('Invoice DO Numbering', 14, '!JDO~$0045', '', 96, 1, 'Sales', NULL, NULL, NULL),
('Invoice DO Numbering - AutoNumber', 7, '1', '', 97, 1, 'Sales', NULL, NULL, NULL),
('Invoice Konsinyasi Numbering', 14, '!JKO~$00001', '', 98, 1, 'Sales', NULL, NULL, NULL),
('Invoice Konsinyasi Numbering - AutoNumber', 7, '1', '', 99, 1, 'Sales', NULL, NULL, NULL),
('Invoice Numbering', 14, '!PJL~$00115', '', 100, 1, 'Sales', NULL, NULL, NULL),
('Invoice Numbering - AutoNumber', 7, '1', '', 101, 1, 'Sales', NULL, NULL, NULL),
('Invoice Retur Numbering', 14, '!JRE~$00017', '', 102, 1, 'Sales', NULL, NULL, NULL),
('Invoice Retur Numbering - AutoNumber', 7, '1', '', 103, 1, 'Sales', NULL, NULL, NULL),
('Jenis_Usaha', 1, '1', 'NIL', 104, 1, 'System', NULL, NULL, NULL),
('JenisFaktur', 0, 'Invoice', NULL, 105, 1, 'Sales', NULL, NULL, NULL),
('Jumlah Discount', 1, '1', '', 106, 1, 'System', NULL, NULL, NULL),
('Konfirmasi Simpan Stock', 1, '0', NULL, 107, 1, 'System', NULL, NULL, NULL),
('Konsinyasi Numbering', 14, '!BKO~$00001', '', 108, 1, 'Sales', NULL, NULL, NULL),
('Konsinyasi Numbering - AutoNumber', 7, '1', '', 109, 1, 'Sales', NULL, NULL, NULL),
('Lady Resv Numbering', 0, '!RLD~@-~$00001', NULL, 110, 1, 'System', NULL, NULL, NULL),
('left', 0, '1650', NULL, 111, 1, 'System', NULL, NULL, NULL),
('Multi DO', 7, '0', '', 113, 1, 'Purchase', 'Auto Numbering', '', ''),
('no', 0, 'False', NULL, 114, 1, 'System', NULL, NULL, NULL),
('Pakai Discount Rupiah', 5, 'False', '', 115, 1, 'System', NULL, NULL, NULL),
('Pembelian Numbering', 14, '!PBL~$00116', '', 116, 1, 'System', NULL, NULL, NULL),
('Pembelian Numbering - AutoNumber', 7, '1', '', 117, 1, 'System', NULL, NULL, NULL),
('POS Numbering', 14, '!T8~$00019', NULL, 118, 1, 'System', NULL, NULL, NULL),
('POS Room Numbering', 14, '!POS~@-~$00016', NULL, 119, 1, 'System', NULL, NULL, NULL),
('Purchase Order Numbering', 13, '!PO~$00153', '', 120, 1, 'System', NULL, NULL, NULL),
('Purchase Order Numbering - AutoNumber', 7, '1', '', 121, 1, 'System', NULL, NULL, NULL),
('PurchaseUpdQtyWhen', 21, '1', '', 122, 1, 'System', NULL, NULL, NULL),
('Quotation Numbering', 14, '!QUT~$00001', '', 123, 1, 'Sales', NULL, NULL, NULL),
('Quotation Numbering - AutoNumber', 7, '1', '', 124, 1, 'Sales', NULL, NULL, NULL),
('Receivement Numbering', 14, '!TRM~$00248', '', 125, 1, 'System', NULL, NULL, NULL),
('Receivement Numbering - AutoNumber', 7, '1', '', 126, 1, 'System', NULL, NULL, NULL),
('Recv Finish Good Numbering', 14, '!RFG~@-~$00026', '', 127, 1, 'System', NULL, NULL, NULL),
('Reservation Numbering', 14, '!RPO~@-~$00034', NULL, 128, 1, 'System', NULL, NULL, NULL),
('Retur Beli Numbering', 14, '!BRE~$00020', '', 129, 1, 'System', NULL, NULL, NULL),
('Retur Numbering', 14, '!BRE~@-~$00018', NULL, 130, 1, 'Sales', NULL, NULL, NULL),
('Retur Numbering - AutoNumber', 7, '1', NULL, 131, 1, 'Sales', NULL, NULL, NULL),
('Room Resv Numbering', 14, '!RRN~@-~$00022', NULL, 132, 1, 'System', NULL, NULL, NULL),
('Sales Order Numbering', 13, '!SO~$00098', '', 135, 1, 'Sales', NULL, NULL, NULL),
('Sales Order Numbering - AutoNumber', 7, '1', '', 136, 1, 'Sales', NULL, NULL, NULL),
('SaleUpdQtyWhen', 21, '1 - Pengiriman Barang', '', 137, 1, 'Sales', NULL, NULL, NULL),
('Serial', 16, '0387F9FF00000686', 'NIL', 138, 1, 'System', NULL, NULL, NULL),
('SetCekStatusRoom', 5, 'False', 'NIL', 139, 1, 'System', NULL, NULL, NULL),
('SetCreditCard', 1, '0', 'NIL', 140, 1, 'System', NULL, NULL, NULL),
('SetDiscPrc', 3, '0.1', 'NIL', 141, 1, 'System', NULL, NULL, NULL),
('SetPB', 1, '0', 'NIL', 142, 1, 'System', NULL, NULL, NULL),
('SetRoundMinute', 1, '0', 'NIL', 143, 1, 'System', NULL, NULL, NULL),
('SetServiceCharge', 1, '0', 'NIL', 144, 1, 'System', NULL, NULL, NULL),
('SetShowKonsinyasi', 4, 'True', NULL, 145, 1, 'System', NULL, NULL, NULL),
('status_project', 4, 'Open', 'Status Project', 146, 1, 'System', NULL, NULL, NULL),
('status_project_1', 6, 'Closed', 'Status Project', 147, 1, 'System', NULL, NULL, NULL),
('Stock Receive Numbering', 14, '!RCV~@-~$00024', NULL, 148, 1, 'System', NULL, NULL, NULL),
('strCompany', 0, 'ATL', NULL, 149, 1, 'System', NULL, NULL, NULL),
('strCurrentModule', 0, 'frmMain', NULL, 150, 1, 'System', NULL, NULL, NULL),
('Tampil Harga Beli', 1, '0', '', 151, 1, 'System', NULL, NULL, NULL),
('Tampil History Harga', 1, '', '', 152, 1, 'System', NULL, NULL, NULL),
('Tampil Multi Pricing', 1, '', '', 153, 1, 'System', NULL, NULL, NULL),
('top', 0, '165', NULL, 154, 1, 'System', NULL, NULL, NULL),
('TRX OE Numbering', 0, '!TRX~$00004', NULL, 155, 1, 'System', NULL, NULL, NULL),
('txtPassword', 0, 'ADMIN', NULL, 156, 1, 'System', NULL, NULL, NULL),
('txtUsername', 0, 'administrator', NULL, 157, 1, 'System', NULL, NULL, NULL),
('Ubah Qty Assembly DisAssembly', 4, 'True', '', 158, 1, 'System', NULL, NULL, NULL),
('Update AR/AP Balance in Bank Module', 5, 'False', NULL, 159, 1, 'System', NULL, NULL, NULL),
('Use Stock Receipt', 1, '0', 'NIL', 160, 1, 'System', NULL, NULL, NULL),
('width', 0, '15480', NULL, 161, 1, 'System', NULL, NULL, NULL),
('WindowState', 1, '2', NULL, 162, 1, 'System', NULL, NULL, NULL),
('Work Order Numbering', 13, '!WO~@-~$00013', NULL, 163, 1, 'System', NULL, NULL, NULL),
('yes', 0, 'True', NULL, 164, 1, 'System', NULL, NULL, NULL),
('DefaultCurrency', 3, 'IDR', '', 175, 1, 'System', NULL, NULL, NULL),
('BeginDate', 10, '2012-01-01 00:00', '', 176, 1, 'System', NULL, NULL, NULL),
('FiscalYear', 10, '2012', '', 177, 1, 'System', NULL, NULL, NULL),
('AllowInputDateFrom', 10, '2012-01-01 00:00', '', 178, 1, 'System', 'Auto Numbering', '', ''),
('AllowInputDateTo', 10, '2012-12-31 00:00', '', 179, 1, 'Purchase', 'Auto Numbering', '', ''),
('ShowReminder', 4, 'True', '', 180, 1, 'System', NULL, NULL, NULL),
('ShowTips', 4, 'FALSE', 'Show Tips', 181, 1, 'System', NULL, NULL, NULL),
('PO Jumlah Discount', 1, '1', '', 206, NULL, 'System', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Simple', 'Jenis faktur', 211, NULL, 'Sales', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Profesional', 'Jenis faktur', 212, NULL, 'Sales', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Product Detail', 'Jenis faktur', 213, NULL, 'Sales', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Service', 'Jenis faktur', 214, NULL, 'Sales', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Konsinyasi', 'Jenis faktur', 215, NULL, 'Sales', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Faktur Eceran', 'Jenis faktur', 216, NULL, 'Sales', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Faktur Grosir', 'Jenis faktur', 217, NULL, 'Sales', NULL, NULL, NULL),
('AppSecureLevel', 1, '0', 'NIL', 219, NULL, 'Sales', 'Auto Numbering', '', ''),
('HargaBeliPoItem', 1, '0', '', 220, NULL, 'System', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Faktur Pangan', 'Jenis faktur', 222, NULL, 'Sales', NULL, NULL, NULL),
('TypeOfInvoice', 0, 'Faktur Kebun', 'Jenis faktur', 223, NULL, 'Sales', NULL, NULL, NULL),
('PO Request Numbering', 14, '!POR~@-~$00001', 'NIL', 225, NULL, 'System', NULL, NULL, NULL),
('AR Payment Numbering - AutoNumber', 1, '1', '', 232, NULL, 'System', NULL, NULL, NULL),
('Acc In KAS Numbering', 15, '!KM.KAS.~$00072', '', 233, NULL, 'Banking', 'Auto Numbering', '', ''),
('Acc Out KAS Numbering', 15, '!KK.KAS.~$00056', '', 234, NULL, 'Sales', 'Auto Numbering', '', ''),
('Retur Beli Numbering - AutoNumber', 1, '1', '', 236, NULL, 'System', NULL, NULL, NULL),
('AP Payment Numbering - AutoNumber', 1, '1', '', 237, NULL, 'Purchase', 'Auto Numbering', '', ''),
('Inventory Numbering - AutoNumber', 1, '1', '', 238, NULL, 'Inventory', NULL, NULL, NULL),
('Inventory Numbering', 6, '$00013', '', 239, NULL, 'Inventory', NULL, NULL, NULL),
('TerbilangInvoice', 1, '0', '', 257, NULL, 'System', NULL, NULL, NULL),
('SelectRecWhenPrintInvoice', 1, '0', '', 259, NULL, 'Sales', NULL, NULL, NULL),
('FingerprintKey', 1, 'UAA2ARPPEAEJEEE66', 'FingerprintKey', 268, NULL, 'System', NULL, NULL, NULL),
('LicenceKey', 37, 'HI42T2GP7EIMN3A2AAA13AE7IEE68IIA2EIAA', 'NIL', 269, NULL, 'System', NULL, NULL, NULL),
('LicenceCount', 1, '2', 'NIL', 270, NULL, 'System', NULL, NULL, NULL),
('LicenseKey', 1, 'HAA2A2BPE4EJ6EE66', 'LicenseKey', 271, NULL, 'System', NULL, NULL, NULL),
('LicenseCount', 1, '2', 'LicenseCount', 272, NULL, 'System', NULL, NULL, NULL),
('AppLicenseStatus', 1, '1', 'NIL', 273, NULL, 'Sales', 'Auto Numbering', '', ''),
('Acc In BCA Numbering', 15, '!BCA.KM.~$00035', '', 275, NULL, 'Banking', 'Auto Numbering', '', ''),
('Acc Out BCA Numbering', 15, '!BCA.KK.~$00015', '', 276, NULL, 'Banking', 'Auto Numbering', '', ''),
('MultiCurrency', 1, '1', 'NIL', 277, NULL, 'System', '', '', ''),
('MultiWarehouse', 1, '1', 'NIL', 278, NULL, 'System', '', '', ''),
('MultiBranch', 1, '1', 'NIL', 279, NULL, 'System', NULL, NULL, NULL),
('MultiCustomerBranch', 1, '1', 'NIL', 281, NULL, NULL, NULL, NULL, NULL),
('DefaultGudang', 6, 'Gudang', 'NIL', 282, NULL, NULL, NULL, NULL, NULL),
('DefaultCurrencyRate', 1, '1', 'Default Currency Rate', 283, NULL, NULL, NULL, NULL, NULL),
('Invoice Angkutan Numbering', 7, '$000016', 'NIL', 284, NULL, NULL, NULL, NULL, NULL),
('Biaya Angkutan Numbering', 11, '@BA~$000032', 'NIL', 285, NULL, NULL, NULL, NULL, NULL),
('ReCalcHppBeforeJournal', 1, '0', 'NIL', 286, NULL, NULL, NULL, NULL, NULL),
('AutoCreateSupplierWhenOrder', 1, 'True', '', 295, NULL, NULL, NULL, NULL, NULL),
('AllowMoveToNextControlWhenEmpty', 1, '', '', 296, NULL, NULL, NULL, NULL, NULL),
('Multi Currency', 1, 'True', '', 297, NULL, NULL, NULL, NULL, NULL),
('AutoCreateCustomerWhenOrder', 1, '1', '', 298, NULL, NULL, NULL, NULL, NULL),
('GridAutoCompletion', 1, '1', '', 299, NULL, NULL, NULL, NULL, NULL),
('GridAutoDropdown', 1, '1', '', 300, NULL, NULL, NULL, NULL, NULL),
('GridMoveColWithTab', 1, '0', '', 301, NULL, NULL, NULL, NULL, NULL),
('Service Order Numbering', 14, '!SRV~@-~$00003', 'service job numbering', 313, NULL, NULL, NULL, NULL, NULL),
('Service job numbering', 15, '!SJOB~@-~$00005', 'service job numbering', 314, NULL, NULL, NULL, NULL, NULL),
('NilaiPembulatan', 3, '0', 'nil', 315, NULL, NULL, NULL, NULL, NULL),
('adjust_raw_material', 5, 'True', 'nil', 322, NULL, NULL, NULL, NULL, NULL),
('recalc_discount_when_report', 5, 'False', 'nil', 325, NULL, NULL, NULL, NULL, NULL),
('Customer ShipTo Numbering', 6, '$00008', 'nil', 327, NULL, NULL, NULL, NULL, NULL),
('Invoice Numbering - Locked', 1, '1', '', 329, NULL, NULL, NULL, NULL, NULL),
('GabungKodeJurnal', 1, '1', '', 330, NULL, NULL, NULL, NULL, NULL),
('LoadSelectItem', 1, '', '', 331, NULL, NULL, NULL, NULL, NULL),
('ar_payment_date_locked', 1, '', '', 332, NULL, NULL, NULL, NULL, NULL),
('allow_reprint_do', 1, '', '', 333, NULL, NULL, NULL, NULL, NULL),
('allow_reprint_invoice', 1, '0', '', 334, NULL, NULL, NULL, NULL, NULL),
('allow_reprint_so', 1, '1', 'NIL', 335, NULL, NULL, NULL, NULL, NULL),
('allow_reprint_retur_jual', 1, '1', 'NIL', 336, NULL, NULL, NULL, NULL, NULL),
('allow_reprint_po', 1, '1', 'NIL', 337, NULL, NULL, NULL, NULL, NULL),
('allow_reprint_po_invoice', 1, '1', 'NIL', 338, NULL, NULL, NULL, NULL, NULL),
('allow_reprint_retur_beli', 1, '1', 'NIL', 339, NULL, NULL, NULL, NULL, NULL),
('lock_change_item', 5, 'True', 'nil', 343, NULL, NULL, NULL, NULL, NULL),
('Adjustment Numbering', 11, '!ADJ~$00020', '', 345, NULL, NULL, NULL, NULL, NULL),
('Transfer Stock Numbering', 14, '!TRX~$00002', '', 348, NULL, NULL, NULL, NULL, NULL),
('Adjustment Numbering - AutoNumber', 1, '1', '', 349, NULL, NULL, NULL, NULL, NULL),
('Transfer Stock Numbering - AutoNumber', 1, '0', 'NIL', 350, NULL, NULL, NULL, NULL, NULL),
('col_width_kode', 4, '3110', 'nil', 353, NULL, NULL, NULL, NULL, NULL),
('col_width_qty', 3, '555', 'nil', 354, NULL, NULL, NULL, NULL, NULL),
('col_width_unit', 3, '450', 'nil', 355, NULL, NULL, NULL, NULL, NULL),
('col_width_harga', 4, '1005', 'nil', 356, NULL, NULL, NULL, NULL, NULL),
('col_width_disc_prc', 3, '615', 'nil', 357, NULL, NULL, NULL, NULL, NULL),
('col_width_disc_amt', 3, '700', 'nil', 358, NULL, NULL, NULL, NULL, NULL),
('col_width_jumlah', 4, '1500', 'nil', 359, NULL, NULL, NULL, NULL, NULL),
('Acc In LIPO 234 Numbering', 11, '!KML~$00001', 'NIL', 365, NULL, NULL, NULL, NULL, NULL),
('Acc OutLIPO 234 Numbering', 11, '!KKL~$00002', 'NIL', 366, NULL, NULL, NULL, NULL, NULL),
('NextShipToId', 12, '!SHT1~$00008', 'Penomoran untuk kode pengiriman customer', 371, NULL, NULL, NULL, NULL, NULL),
('AllowChangePrice', 0, 'true', NULL, 372, NULL, NULL, NULL, NULL, NULL),
('AllowChangeDiscItem', 0, 'true', NULL, 373, NULL, NULL, NULL, NULL, NULL),
('allow_cashier_report', 4, 'True', 'nil', 376, NULL, NULL, NULL, NULL, NULL),
('LockSO_Freight', 0, 'true', NULL, 377, NULL, NULL, NULL, NULL, NULL),
('LockSO_Tax', 0, 'true', NULL, 378, NULL, NULL, NULL, NULL, NULL),
('DisplayConfirmWhenPayment', 0, 'false', NULL, 379, NULL, NULL, NULL, NULL, NULL),
('ItemReturBased', 1, '2', 'NIL', 387, NULL, NULL, NULL, NULL, NULL),
('AskGLIDPosting', 5, 'False', 'NIL', 394, NULL, NULL, NULL, NULL, NULL),
('Acc In Mandiri Numbering', 12, '!BMM.~$00002', 'NIL', 395, NULL, NULL, NULL, NULL, NULL),
('Acc OutMandiri Numbering', 12, '!BKM.~$00002', 'NIL', 396, NULL, NULL, NULL, NULL, NULL),
('Invoice DO Other Numbering - AutoNumber', 1, '1', '', 397, NULL, NULL, NULL, NULL, NULL),
('Invoice DO Other Numbering', 11, '!JDL~$00017', '', 398, NULL, NULL, NULL, NULL, NULL),
('Invoice DO Other Numbering - Locked', 1, '1', '', 399, NULL, NULL, NULL, NULL, NULL),
('tmp_no_po', 7, 'JDO0037', '', 400, NULL, NULL, NULL, NULL, NULL),
('tmp_no_so', 7, 'JDO0037', 'SO00033', 401, NULL, NULL, NULL, NULL, NULL),
('HideAccountEarningAccount', 5, 'True', '', 415, NULL, NULL, NULL, NULL, NULL),
('AllowVoucherNonMember', 5, 'True', 'nil', 416, NULL, NULL, NULL, NULL, NULL),
('MoveToNextCol', 5, 'False', 'NIL', 418, NULL, NULL, NULL, NULL, NULL),
('InvalidAcc_Jurnal', 0, '1483', 'InvalidAcc_Jurnal', 419, NULL, NULL, NULL, NULL, NULL),
('InvalidAcc_Jurnal', 0, '1408', 'InvalidAcc_Jurnal', 420, NULL, NULL, NULL, NULL, NULL),
('IncPoAutoNumWhenEdit', 0, 'true', NULL, 421, NULL, NULL, NULL, NULL, NULL),
('UnlockChangePriceInvoice', 5, '', '', 422, NULL, NULL, NULL, NULL, NULL),
('ProtectChangePrice', 5, '', '', 423, NULL, NULL, NULL, NULL, NULL),
('ProtectChangeDisc', 5, '', '', 424, NULL, NULL, NULL, NULL, NULL),
('Purchase Order Number', 21, '', 'No Comment', 445, NULL, NULL, NULL, NULL, NULL),
('Retur Jual Numbering', 20, '', 'No Comment', 446, NULL, NULL, NULL, NULL, NULL),
('Adjustmnet Numbering', 20, '', 'No Comment', 447, NULL, NULL, NULL, NULL, NULL),
('Other Delivery Numbering', 24, '!DOX~$00012', 'No Comment', 448, NULL, NULL, NULL, NULL, NULL),
('Retur Pembelian Numbering', 25, '!PR~$00028', 'No Comment', 449, NULL, NULL, NULL, NULL, NULL),
('Delivery Order Numbering', 24, '!SJ~$00039', 'No Comment', 450, NULL, NULL, NULL, NULL, NULL),
('Retur Invoice Numbering', 23, '', 'No Comment', 452, NULL, NULL, NULL, NULL, NULL),
('CRDB PO Numbering', 17, '!CRDB.PO.~@-~$00001', 'No Comment', 453, NULL, NULL, NULL, NULL, NULL),
('Voucher in Numbering', 20, '', 'No Comment', 454, NULL, NULL, NULL, NULL, NULL),
('Acc In  Numbering', 17, '', 'No Comment', 455, NULL, NULL, NULL, NULL, NULL),
('Acc In BCW Numbering', 20, '', 'No Comment', 456, NULL, NULL, NULL, NULL, NULL),
('Voucher  Numbering', 18, '', 'No Comment', 457, NULL, NULL, NULL, NULL, NULL),
('Voucher out Numbering', 21, '', 'No Comment', 458, NULL, NULL, NULL, NULL, NULL),
('Acc Out  Numbering', 18, '', 'No Comment', 460, NULL, NULL, NULL, NULL, NULL),
('Invoice Kontan Numbering', 24, '!FK~$00003', 'Faktur Jual Kontan', 475, NULL, NULL, NULL, NULL, NULL),
('', 0, '!TRP~$00001', 'Penerimaan PO', 489, NULL, NULL, NULL, NULL, NULL),
('PO Receive Numbering', 20, '!TRP~$00038', 'Penerimaan PO', 490, NULL, NULL, NULL, NULL, NULL),
('SalQtyDec', 9, '2', 'No Comment', 491, NULL, NULL, NULL, NULL, NULL),
('SalPriDec', 9, '0', 'No Comment', 492, NULL, NULL, NULL, NULL, NULL),
('InvQtyDec', 9, '2', 'No Comment', 493, NULL, NULL, NULL, NULL, NULL),
('InvPriDec', 9, '0', 'No Comment', 494, NULL, NULL, NULL, NULL, NULL),
('PurQtyDec', 9, '2', 'No Comment', 495, NULL, NULL, NULL, NULL, NULL),
('PurPriDec', 9, '0', 'No Comment', 496, NULL, NULL, NULL, NULL, NULL),
('DiscRupiah', 10, 'True', 'No Comment', 497, NULL, NULL, NULL, NULL, NULL),
('UseGiroGantung', 14, '1', 'No Comment', 498, NULL, NULL, NULL, NULL, NULL),
('AllowPayMinus', 13, '1', 'No Comment', 499, NULL, NULL, NULL, NULL, NULL),
('CR Debit Numbering', NULL, '!DBSO~@-~$00001', NULL, 500, NULL, NULL, NULL, NULL, NULL),
('ContactOnSales', NULL, 'Purchasing', NULL, 501, NULL, NULL, NULL, NULL, NULL),
('Default Invoice Type', NULL, 'Simple', NULL, 502, NULL, NULL, NULL, NULL, NULL),
('Freight Taxable', NULL, 'True', NULL, 503, NULL, NULL, NULL, NULL, NULL),
('Other Taxable', NULL, 'True', NULL, 504, NULL, NULL, NULL, NULL, NULL),
('Undeposited Checks', NULL, 'True', NULL, 505, NULL, NULL, NULL, NULL, NULL),
('show_kas', NULL, 'True', NULL, 506, NULL, NULL, NULL, NULL, NULL),
('so_number', 9, '!SO~$00052', 'No Comment', 507, NULL, NULL, NULL, NULL, NULL),
('faktur_number', 13, '!PJL~$00074', 'No Comment', 508, NULL, NULL, NULL, NULL, NULL),
('do_number', 9, '!JDO~$0044', 'No Comment', 509, NULL, NULL, NULL, NULL, NULL),
('konsinyasi_number', 17, '!JKO~$00001', 'No Comment', 510, NULL, NULL, NULL, NULL, NULL),
('retur_number', 12, '!JRE~$00015', 'No Comment', 511, NULL, NULL, NULL, NULL, NULL),
('payment_number', 14, '!ARP~$00030', 'No Comment', 512, NULL, NULL, NULL, NULL, NULL),
('quot_number', 11, '!QUT~$00001', 'No Comment', 513, NULL, NULL, NULL, NULL, NULL),
('stock_send_number', 17, '!DOX~$00007', 'No Comment', 514, NULL, NULL, NULL, NULL, NULL),
('credit_memo_number', 18, '!CRDB~@-~$00107', 'No Comment', 515, NULL, NULL, NULL, NULL, NULL),
('debit_memo_number', 17, '!DBSO~@-~$00001', 'No Comment', 516, NULL, NULL, NULL, NULL, NULL),
('fakur_pajak_number', 18, '', 'No Comment', 517, NULL, NULL, NULL, NULL, NULL),
('discount_bertingkat', 19, '1', 'No Comment', 518, NULL, NULL, NULL, NULL, NULL),
('nama_di_faktur', 14, 'Andri', 'No Comment', 519, NULL, NULL, NULL, NULL, NULL),
('CR PO Numbering', 15, 'CRPO~$00001', 'No Comment', 520, NULL, NULL, NULL, NULL, NULL),
('DB PO Numbering', 15, '!DBPO~$00001', 'No Comment', 521, NULL, NULL, NULL, NULL, NULL),
('Purchase Order Contact', 22, 'Purchasing', 'No Comment', 522, NULL, NULL, NULL, NULL, NULL),
('POItemDisplay', 13, '0', 'No Comment', 523, NULL, NULL, NULL, NULL, NULL),
('PO Show Items', 13, '0', 'No Comment', 524, NULL, NULL, NULL, NULL, NULL),
('Inventory Costing', 17, '0', 'No Comment', 525, NULL, NULL, NULL, NULL, NULL),
('Perpetual Inventory', 19, '0', 'No Comment', 526, NULL, NULL, NULL, NULL, NULL),
('Display ShipTos', 15, '0', 'No Comment', 527, NULL, NULL, NULL, NULL, NULL),
('customer order', 14, '0', 'No Comment', 528, NULL, NULL, NULL, NULL, NULL),
('InventorySearch', 15, '0', 'No Comment', 529, NULL, NULL, NULL, NULL, NULL),
('customer numbering', 18, '0', 'No Comment', 530, NULL, NULL, NULL, NULL, NULL),
('Supplier Numbering', 18, '0', 'No Comment', 531, NULL, NULL, NULL, NULL, NULL),
('button_position', 15, '0', 'No Comment', 532, NULL, NULL, NULL, NULL, NULL),
('C01 Invoice Numbering', NULL, '!P-C01~$00006', 'Numbering', 533, NULL, NULL, NULL, NULL, NULL),
(' Invoice Numbering', NULL, '!P-~$00001', 'Numbering', 534, NULL, NULL, NULL, NULL, NULL),
('T01 Invoice Numbering', NULL, '!P-T01~$00006', 'Numbering', 535, NULL, NULL, NULL, NULL, NULL),
('T01 Receive Numbering', NULL, '!R-T01~$00010', 'Numbering', 536, NULL, NULL, NULL, NULL, NULL),
('C01 Receive Numbering', NULL, '!R-C01~$00010', 'Numbering', 537, NULL, NULL, NULL, NULL, NULL),
('C01 Delivery Numbering', NULL, '!D-C01~$00009', 'Numbering', 538, NULL, NULL, NULL, NULL, NULL),
('C01 AR Payment Numbering', NULL, '!ARP-C01~$00006', 'Numbering', 539, NULL, NULL, NULL, NULL, NULL),
('C01 Adjust Numbering', NULL, '!ADJ-C01~$00004', 'Numbering', 540, NULL, NULL, NULL, NULL, NULL),
('C01 Pembelian Numbering', NULL, '!FBC01~$00011', 'Numbering', 541, NULL, NULL, NULL, NULL, NULL),
('C01 AP Payment Numbering', NULL, '!APP-C01~$00006', 'Numbering', 542, NULL, NULL, NULL, NULL, NULL),
('Flag [Customers] add sc exempt', 1, '1', 'nil', 543, NULL, NULL, NULL, NULL, NULL),
('Flag [Invoice lineitems] change field type', 1, '1', 'nil', 544, NULL, NULL, NULL, NULL, NULL),
('Purchase Invoice Numbering', NULL, '!PI~$00005', 'Numbering', 545, NULL, NULL, NULL, NULL, NULL),
('Retur Pembelian Numbering', NULL, '!PR~$00028', 'Numbering', 546, NULL, NULL, NULL, NULL, NULL),
('Delivery Order Numbering', NULL, '!SJ~$00039', 'Numbering', 547, NULL, NULL, NULL, NULL, NULL),
('CrDB Numbering', NULL, '!CRDB~$00003', 'Numbering', 548, NULL, NULL, NULL, NULL, NULL),
('Other Recievement Numbering', NULL, '!EIN~$00003', 'Numbering', 549, NULL, NULL, NULL, NULL, NULL),
('Other Receivement Numbering', NULL, '!EIN~$00007', 'Numbering', 550, NULL, NULL, NULL, NULL, NULL),
('COA Retur Penjualan', NULL, '1504', 'auto', 558, NULL, NULL, NULL, NULL, NULL),
('COA Retur Penjualan', NULL, '1504', 'auto', 559, NULL, NULL, NULL, NULL, NULL),
('COA Item Out Others', NULL, '1434', 'auto', 560, NULL, NULL, NULL, NULL, NULL),
('COA Item In Others', NULL, '1434', 'auto', 561, NULL, NULL, NULL, NULL, NULL),
('COA Item Adjustment', NULL, '1434', 'auto', 562, NULL, NULL, NULL, NULL, NULL),
('CoaChargeCreditCard', NULL, '0', 'auto', 563, NULL, NULL, NULL, NULL, NULL),
('CoaPromo', NULL, '0', 'auto', 564, NULL, NULL, NULL, NULL, NULL),
('CoaGift', NULL, '0', 'auto', 565, NULL, NULL, NULL, NULL, NULL),
('Adjust Numbering', NULL, '!ADJ~$00006', 'Numbering', 567, NULL, NULL, NULL, NULL, NULL);
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 35:
	$table="sysgrid";
$sql="

CREATE TABLE IF NOT EXISTS `sys_grid` (
  `selectionindex` int(11) NOT NULL auto_increment,
  `id` varchar(50) character set utf8 default NULL,
  `date_time` varchar(50) character set utf8 default NULL,
  `colstr1` varchar(250) character set utf8 default NULL,
  `colstr2` varchar(250) character set utf8 default NULL,
  `colstr3` varchar(250) character set utf8 default NULL,
  `colstr4` varchar(250) character set utf8 default NULL,
  `colstr5` varchar(250) character set utf8 default NULL,
  `colnum1` double default NULL,
  `colnum2` double default NULL,
  `colnum3` double default NULL,
  `colnum4` double default NULL,
  `colnum5` double default NULL,
  `colnum6` double default NULL,
  `colnum7` double default NULL,
  `colnum8` double default NULL,
  `colnum9` double default NULL,
  `colnum10` double default NULL,
  `colnum11` double default NULL,
  `colnum12` double default NULL,
  `colnum13` double default NULL,
  `colnum14` double default NULL,
  `colnum15` double default NULL,
  `colnum16` double default NULL,
  `colnum17` double default NULL,
  `colnum18` double default NULL,
  `colnum19` double default NULL,
  `colnum20` double default NULL,
  `coldate1` datetime default NULL,
  `coldate2` datetime default NULL,
  `coldate3` datetime default NULL,
  `coldate4` datetime default NULL,
  `coldate5` datetime default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`selectionindex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `sys_objects` (
  `id` int(11) NOT NULL auto_increment,
  `obj_form` varchar(50) character set utf8 default NULL,
  `user_id` varchar(50) character set utf8 default NULL,
  `obj_name` varchar(50) character set utf8 default NULL,
  `obj_index` int(11) default NULL,
  `prop_name` varchar(50) character set utf8 default NULL,
  `prop_value` varchar(50) character set utf8 default NULL,
  `obj_child` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `sys_tooltip` (
  `id` int(11) NOT NULL auto_increment,
  `date_created` datetime default NULL,
  `created_by` varchar(50) character set utf8 default NULL,
  `date_updated` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `help_key` varchar(50) character set utf8 default NULL,
  `help_desc` varchar(250) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `trans_type` (
  `type_id` varchar(50) character set utf8 NOT NULL,
  `type_inout` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `type_of_account` (
  `type_of_account` varchar(20) character set utf8 NOT NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`type_of_account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `type_of_payment` (
  `type_of_payment` varchar(50) character set utf8 NOT NULL,
  `discount_percent` double default NULL,
  `discount_days` int(11) default NULL,
  `days` int(11) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`type_of_payment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
$sql="

INSERT INTO `type_of_payment` (`type_of_payment`, `discount_percent`, `discount_days`, `days`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
('Kredit 30 Hari', 0.12, 30, 30, 0, '', ''),
('Kredit15 hari', 0.15, 0, 15, 0, '', ''),
('60 Hari', 0, 30, 60, 0, '', ''),
('Kredi 90 Hari', 0.1, 30, 90, 0, '', '');
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 3:
	$table="user";

$sql="

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(50) character set utf8 NOT NULL,
  `username` varchar(50) character set utf8 default NULL,
  `password` varchar(50) character set utf8 default NULL,
  `path_image` varchar(255) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `disc_prc_max` double(11,0) default NULL,
  `disc_amt_max` double default NULL,
  `email` varchar(50) default NULL,
  `NIP` varchar(50) default NULL,
  `userlevel` varchar(50) default NULL,
  `active` int(11) default '0',
  `cid` varchar(10) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `user` (`user_id`, `username`, `password`, `path_image`, `update_status`, `disc_prc_max`, `disc_amt_max`, `email`, `NIP`, `userlevel`, `active`, `cid`) VALUES
('admin', 'admin', 'admin', '', 0, 0, 0, '', '', '', 0, 'C01'),
('Administrator', 'Administrator', 'admin', 'admin.gif', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
('andri', 'andri', '1', '', NULL, NULL, NULL, NULL, NULL, 'GUEST', 1, 'C01'),
('buyer', 'buyer', '1', '', 0, 0, 0, '', '', '', 0, 'T01'),
('Kasir', 'kasir', '1', 'kasir.gif', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
('sales', 'sales', '*sales', NULL, NULL, NULL, NULL, NULL, NULL, 'GUEST', 0, NULL),
('Spv', 'Supervisor', '1', '', NULL, NULL, NULL, NULL, NULL, 'SUPER', 0, NULL),
('usman', 'usman', '1', 'usman.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'T01'),
('ujang', 'ujang', 'ujang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'T01'),
('acong', 'acong', 'acong', '', 0, 0, 0, '', '', '', 0, 'T01');
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

case 36:
	$table='user_group_modules';
$sql="

CREATE TABLE IF NOT EXISTS `user_group_modules` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` varchar(50) character set utf8 default NULL,
  `module_id` varchar(50) character set utf8 default NULL,
  `permission` int(11) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`group_id`,`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1655 ;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

	
$sql="

INSERT INTO `user_group_modules` (`id`, `group_id`, `module_id`, `permission`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
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
(165, 'Administrator', '_00000', 0, 1, NULL, NULL),
(192, 'SYSMENU', '_10000', 0, NULL, NULL, NULL),
(193, 'SYSMENU', '_11000', 0, NULL, NULL, NULL),
(194, 'SYSMENU', '_10060', 0, NULL, NULL, NULL),
(195, 'SYSMENU', '_30010', 0, 1, NULL, NULL),
(196, 'SYSMENU', '_30011', 0, 1, NULL, NULL),
(197, 'SYSMENU', '_30012', 0, 1, NULL, NULL),
(265, 'Administrator', '_30000', 0, 1, NULL, NULL),
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
(398, 'FIN', '_10014', 0, 1, NULL, NULL),
(401, 'FIN', '_10022', 0, 1, NULL, NULL),
(402, 'FIN', '_10023', 0, 1, NULL, NULL),
(403, 'FIN', '_10024', 0, 1, NULL, NULL),
(407, 'FIN', '_10033', 0, 1, NULL, NULL),
(408, 'FIN', '_10034', 0, 1, NULL, NULL),
(727, 'SPV', '_30000.018', 100, NULL, NULL, NULL),
(728, 'SPV', '_30000.019', 100, NULL, NULL, NULL),
(729, 'SPV', '_30000.020', 100, NULL, NULL, NULL),
(730, 'SPV', '_30000.021', 100, NULL, NULL, NULL),
(731, 'SPV', '_30000.022', 100, NULL, NULL, NULL),
(732, 'SPV', '_30000.023', 100, NULL, NULL, NULL),
(733, 'SPV', '_30000.024', 100, NULL, NULL, NULL),
(734, 'SPV', '_30000.025', 100, NULL, NULL, NULL),
(735, 'SPV', '_30000.026', 100, NULL, NULL, NULL),
(736, 'SPV', '_30000.027', 100, NULL, NULL, NULL),
(737, 'SPV', '_30000.028', 100, NULL, NULL, NULL),
(738, 'SPV', '_30000.029', 100, NULL, NULL, NULL),
(739, 'SPV', '_30000.030', 100, NULL, NULL, NULL),
(740, 'SPV', '_30000.031', 100, NULL, NULL, NULL),
(741, 'SPV', '_30000.032', 100, NULL, NULL, NULL),
(742, 'SPV', '_30000.034', 100, NULL, NULL, NULL),
(743, 'SPV', '_30000.035', 100, NULL, NULL, NULL),
(744, 'SPV', '_30000.036', 100, NULL, NULL, NULL),
(745, 'SPV', '_30000.037', 100, NULL, NULL, NULL),
(746, 'SPV', '_30000.038', 100, NULL, NULL, NULL),
(747, 'SPV', '_30000.039', 100, NULL, NULL, NULL),
(748, 'SPV', '_30000.040', 100, NULL, NULL, NULL),
(749, 'SPV', '_30000.041', 100, NULL, NULL, NULL),
(750, 'SPV', '_30000.054', 100, NULL, NULL, NULL),
(751, 'SPV', '_30000.056', 100, NULL, NULL, NULL),
(752, 'SPV', '_30000.057', 100, NULL, NULL, NULL),
(753, 'SPV', '_30000.059', 100, NULL, NULL, NULL),
(754, 'SPV', '_30000.063', 100, NULL, NULL, NULL),
(755, 'SPV', '_30000.066', 100, NULL, NULL, NULL),
(756, 'SPV', '_30000.100', 100, NULL, NULL, NULL),
(757, 'ADM', '_30000.0', 100, NULL, NULL, NULL),
(758, 'ADM', '_30000.001', 100, NULL, NULL, NULL),
(759, 'ADM', '_30000.002', 100, NULL, NULL, NULL),
(760, 'ADM', '_30000.003', 100, NULL, NULL, NULL),
(761, 'ADM', '_30000.004', 100, NULL, NULL, NULL),
(762, 'ADM', '_30000.005', 100, NULL, NULL, NULL),
(763, 'ADM', '_30000.006', 100, NULL, NULL, NULL),
(764, 'ADM', '_30000.007', 100, NULL, NULL, NULL),
(765, 'ADM', '_30000.009', 100, NULL, NULL, NULL),
(766, 'ADM', '_30000.012', 100, NULL, NULL, NULL),
(767, 'ADM', '_30000.013', 100, NULL, NULL, NULL),
(768, 'ADM', '_30000.014', 100, NULL, NULL, NULL),
(769, 'ADM', '_30000.015', 100, NULL, NULL, NULL),
(770, 'ADM', '_30000.016', 100, NULL, NULL, NULL),
(771, 'ADM', '_30000.017', 100, NULL, NULL, NULL),
(772, 'ADM', '_30000.018', 100, NULL, NULL, NULL),
(773, 'ADM', '_30000.019', 100, NULL, NULL, NULL),
(774, 'ADM', '_30000.020', 100, NULL, NULL, NULL),
(775, 'ADM', '_30000.021', 100, NULL, NULL, NULL),
(776, 'ADM', '_30000.022', 100, NULL, NULL, NULL),
(777, 'ADM', '_30000.023', 100, NULL, NULL, NULL),
(778, 'ADM', '_30000.024', 100, NULL, NULL, NULL),
(779, 'ADM', '_30000.025', 100, NULL, NULL, NULL),
(780, 'ADM', '_30000.026', 100, NULL, NULL, NULL),
(781, 'ADM', '_30000.027', 100, NULL, NULL, NULL),
(782, 'ADM', '_30000.028', 100, NULL, NULL, NULL),
(783, 'ADM', '_30000.029', 100, NULL, NULL, NULL),
(784, 'ADM', '_30000.030', 100, NULL, NULL, NULL),
(785, 'ADM', '_30000.031', 100, NULL, NULL, NULL),
(786, 'ADM', '_30000.032', 100, NULL, NULL, NULL),
(787, 'ADM', '_30000.034', 100, NULL, NULL, NULL),
(788, 'ADM', '_30000.035', 100, NULL, NULL, NULL),
(789, 'ADM', '_30000.036', 100, NULL, NULL, NULL),
(790, 'ADM', '_30000.037', 100, NULL, NULL, NULL),
(791, 'ADM', '_30000.038', 100, NULL, NULL, NULL),
(792, 'ADM', '_30000.039', 100, NULL, NULL, NULL),
(793, 'ADM', '_30000.040', 100, NULL, NULL, NULL),
(794, 'ADM', '_30000.041', 100, NULL, NULL, NULL),
(795, 'ADM', '_30000.054', 100, NULL, NULL, NULL),
(796, 'ADM', '_30000.056', 100, NULL, NULL, NULL),
(797, 'ADM', '_30000.057', 100, NULL, NULL, NULL),
(798, 'ADM', '_30000.059', 100, NULL, NULL, NULL),
(799, 'ADM', '_30000.060', 100, NULL, NULL, NULL),
(800, 'ADM', '_30000.061', 100, NULL, NULL, NULL),
(801, 'ADM', '_30000.062', 100, NULL, NULL, NULL),
(802, 'ADM', '_30000.063', 100, NULL, NULL, NULL),
(803, 'ADM', '_30000.064', 100, NULL, NULL, NULL),
(804, 'ADM', '_30000.065', 100, NULL, NULL, NULL),
(805, 'ADM', '_30000.066', 100, NULL, NULL, NULL),
(806, 'ADM', '_30000.100', 100, NULL, NULL, NULL),
(807, 'PUR', '_40000', 0, NULL, NULL, NULL),
(808, 'PUR', '_40010', 0, NULL, NULL, NULL),
(809, 'PUR', '_40011', 0, NULL, NULL, NULL),
(810, 'PUR', '_40012', 0, NULL, NULL, NULL),
(811, 'PUR', '_40040', 0, NULL, NULL, NULL),
(812, 'PUR', '_40041', 0, NULL, NULL, NULL),
(813, 'PUR', '_40042', 0, NULL, NULL, NULL),
(814, 'PUR', '_40044', 0, NULL, NULL, NULL),
(815, 'PUR', '_80000', 0, NULL, NULL, NULL),
(816, 'PUR', '_80010', 0, NULL, NULL, NULL),
(817, 'PUR', '_80011', 0, NULL, NULL, NULL),
(818, 'PUR', '_80012', 0, NULL, NULL, NULL),
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
(829, 'INV', '_80010', NULL, NULL, NULL, NULL),
(830, 'INV', '_80020', NULL, NULL, NULL, NULL),
(831, 'INV', '_80030', NULL, NULL, NULL, NULL),
(1065, 'FIN', 'ID_ExportImport', NULL, NULL, NULL, NULL),
(1066, 'FIN', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
(1067, 'FIN', '_00000', NULL, NULL, NULL, NULL),
(1068, 'FIN', '_00010', NULL, NULL, NULL, NULL),
(1069, 'FIN', '_00011', NULL, NULL, NULL, NULL),
(1070, 'FIN', '_00012', NULL, NULL, NULL, NULL),
(1071, 'FIN', '_00013', NULL, NULL, NULL, NULL),
(1072, 'FIN', 'frmMain.Addnew', NULL, NULL, NULL, NULL),
(1073, 'FIN', '_80010.01', NULL, NULL, NULL, NULL),
(1074, 'FIN', '_80010.02', NULL, NULL, NULL, NULL),
(1075, 'FIN', '_80010.03', NULL, NULL, NULL, NULL),
(1076, 'FIN', '_80010.04', NULL, NULL, NULL, NULL),
(1077, 'FIN', '_80010.05', NULL, NULL, NULL, NULL),
(1078, 'FIN', '_80010.06', NULL, NULL, NULL, NULL),
(1079, 'FIN', '_80010.07', NULL, NULL, NULL, NULL),
(1634, 'ANDRI', '_00010', NULL, NULL, NULL, NULL),
(1635, 'ANDRI', '_00020', NULL, NULL, NULL, NULL),
(1636, 'ANDRI', '_00030', NULL, NULL, NULL, NULL),
(1637, 'ANDRI', '_00040', NULL, NULL, NULL, NULL),
(1638, 'ANDRI', '_00050', NULL, NULL, NULL, NULL),
(1639, 'ANDRI', '_10010', NULL, NULL, NULL, NULL),
(1640, 'ANDRI', '_10020', NULL, NULL, NULL, NULL),
(1641, 'ANDRI', '_10030', NULL, NULL, NULL, NULL),
(1642, 'ANDRI', '_10060A', NULL, NULL, NULL, NULL),
(1643, 'ANDRI', '_11000', NULL, NULL, NULL, NULL),
(1644, 'ANDRI', '_13000', NULL, NULL, NULL, NULL),
(1645, 'ANDRI', '_300900', NULL, NULL, NULL, NULL),
(1646, 'ANDRI', '_300901', NULL, NULL, NULL, NULL),
(1647, 'ANDRI', '_30170', NULL, NULL, NULL, NULL),
(1648, 'ANDRI', '_80010.01', NULL, NULL, NULL, NULL),
(1649, 'ANDRI', '_80010.02', NULL, NULL, NULL, NULL),
(1650, 'ANDRI', '_80010.03', NULL, NULL, NULL, NULL),
(1651, 'ANDRI', '_80010.04', NULL, NULL, NULL, NULL),
(1652, 'ANDRI', '_80010.05', NULL, NULL, NULL, NULL),
(1653, 'ANDRI', '_80010.06', NULL, NULL, NULL, NULL),
(1654, 'ANDRI', '_80010.07', NULL, NULL, NULL, NULL),
(1113, 'Administrator', '_40000', NULL, NULL, NULL, NULL),
(1114, 'BYR', '_40000', NULL, NULL, NULL, NULL),
(1115, 'BYR', '_80000', NULL, NULL, NULL, NULL),
(1116, 'BYR', '_30000', NULL, NULL, NULL, NULL),
(1117, 'BYR', '_60000', NULL, NULL, NULL, NULL),
(1118, 'Administrator', '_60000', NULL, NULL, NULL, NULL),
(1119, 'Administrator', '_80000', NULL, NULL, NULL, NULL),
(1120, 'Administrator', '_90000', NULL, NULL, NULL, NULL),
(1632, 'ANDRI', 'ID_ExportImport', NULL, NULL, NULL, NULL),
(1633, 'ANDRI', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
(1631, 'ANDRI', 'frmMain.Addnew', NULL, NULL, NULL, NULL);
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 37:
	$table="jobs";


$sql="

CREATE TABLE IF NOT EXISTS `user_job` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` varchar(50) character set utf8 default NULL,
  `group_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`user_id`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203 ;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="

INSERT INTO `user_job` (`id`, `user_id`, `group_id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
(10, 'Spv', 'ADM', NULL, NULL, NULL),
(11, 'Spv', 'BYR', NULL, NULL, NULL),
(16, 'Kasir', 'INV', NULL, NULL, NULL),
(17, 'Kasir', 'PUR', NULL, NULL, NULL),
(18, 'Kasir', 'BYR', NULL, NULL, NULL),
(19, 'usman', 'PUR', NULL, NULL, NULL),
(20, 'usman', 'FIN', NULL, NULL, NULL),
(45, 'Administrator', 'ADM', NULL, NULL, NULL),
(115, 'andri', 'SYSMENU', NULL, NULL, NULL),
(202, 'admin', 'Administrator', NULL, NULL, NULL),
(50, 'sales', 'Administrator', NULL, NULL, NULL),
(57, 'Spv', 'FIN', NULL, NULL, NULL),
(59, 'sales', 'FIN', NULL, NULL, NULL),
(60, 'Kasir', 'FIN', NULL, NULL, NULL),
(61, 'Administrator', 'ANDRI', NULL, NULL, NULL),
(200, 'bbb', 'DRV', NULL, NULL, NULL),
(199, 'bbb', 'COL', NULL, NULL, NULL),
(68, 'buyer', 'BYR', NULL, NULL, NULL),
(111, 'andri', 'Gudang', NULL, NULL, NULL),
(112, 'andri', 'INV', NULL, NULL, NULL),
(113, 'andri', 'KSR', NULL, NULL, NULL),
(114, 'andri', 'SPV', NULL, NULL, NULL),
(116, 'andri', 'test', NULL, NULL, NULL),
(201, 'admin', 'ADM', NULL, NULL, NULL);
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 38:
	$table="voucher";


$sql="

CREATE TABLE IF NOT EXISTS `voucher_master` (
  `voucher_no` varchar(50) character set utf8 NOT NULL,
  `tanggal_dibuat` datetime default NULL,
  `tanggal_aktif` datetime default NULL,
  `tanggal_expire` datetime default NULL,
  `customer_number` varchar(50) character set utf8 default NULL,
  `invoice_number` varchar(50) character set utf8 default NULL,
  `voucher_amt` double default NULL,
  `voucher_amt_terpakai` double default NULL,
  `voucher_amt_sisa` double default NULL,
  `voucher_point` int(11) default NULL,
  `voucher_point_terpakai` int(11) default NULL,
  `voucher_point_sisa` int(11) default NULL,
  `comments` varchar(255) character set utf8 default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`voucher_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `wilayah` (
  `wilayah` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `kode` varchar(50) character set utf8 NOT NULL,
  `ongkos_kirim` double default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();


$sql="
CREATE TABLE IF NOT EXISTS `yescalendaricons` (
  `noteiconname` varchar(50) character set utf8 default NULL,
  `noteiconcategory` varchar(50) character set utf8 default NULL,
  `noteicon` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE TABLE IF NOT EXISTS `yes_smartsearchdefinition` (
  `searchid` varchar(50) character set utf8 default NULL,
  `sequence` int(11) default NULL,
  `optionlabel` varchar(50) character set utf8 default NULL,
  `listlabel` varchar(50) character set utf8 default NULL,
  `rowsource` double default NULL,
  `columncount` int(11) default NULL,
  `columnwidths` varchar(40) character set utf8 default NULL,
  `boundcolumn` int(11) default NULL,
  `textsearchlabel` varchar(22) character set utf8 default NULL,
  `textsearchfield` varchar(25) character set utf8 default NULL,
  `lastselectedoption` int(11) default NULL,
  `source_table` varchar(50) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 39:
	$table="query";
$sql="
CREATE  VIEW `qry_coa` AS select `chart_of_accounts`.`account` AS `account`,
`chart_of_accounts`.`account_description` AS `account_description`,_utf8'D' AS `jenis`,
`chart_of_accounts`.`db_or_cr` AS `db_or_cr`,`chart_of_accounts`.`beginning_balance` AS `saldo_awal`,
`chart_of_accounts`.`group_type` AS `parent` from `chart_of_accounts` 
union all 
select `gl_report_groups`.`group_type` AS `group_type`,`gl_report_groups`.`group_name` AS `group_name`,
_utf8'H' AS `jenis`,_utf8'' AS `db_or_cr`,NULL AS `0`,`gl_report_groups`.`parent_group_type` AS `parent_group_type` 
from `gl_report_groups`;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE VIEW `qry_kartustock_adj` AS select `i`.`date_trans` AS `tanggal`,_utf8'Adjustment' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(if((`i`.`to_qty` > 0),`i`.`to_qty`,0)) AS `qty_masuk`,abs(if((`i`.`to_qty` < 0),`i`.`to_qty`,0)) AS `qty_keluar`,0 AS `price`,`i`.`cost` AS `cost`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`)));
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE  VIEW `qry_kartustock_delivery` AS select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,0 AS `qty_masuk`,abs(`il`.`quantity`) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'D');
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE   VIEW `qry_kartustock_etc_out` AS select `pp`.`date_received` AS `tanggal`,`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`pp`.`quantity_received`) AS `qty_keluar`,`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,`pp`.`cost` AS `cost`,0 AS `discount`,0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,`pp`.`warehouse_code` AS `gudang`,_utf8'IDR' AS `mata_uang`,1 AS `rate`,`pp`.`supplier_number` AS `supplier`,`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,`pp`.`multi_unit` AS `multi_unit`,`pp`.`mu_price` AS `mu_price` from (`inventory_products` `pp` left join `inventory` `s` on((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` = _utf8'ETC_OUT');
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE   VIEW `qry_kartustock_invoice` AS select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Faktur Jual Kontan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where ((`i`.`invoice_type` = _utf8'I') and (`i`.`payment_terms` in (_utf8'Cash',_utf8'',_utf8'Tunai',_utf8'Kontan'))) union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where ((`i`.`invoice_type` = _utf8'D') and (`il`.`from_line_type` = _utf8'SO')) union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Retur Jual' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,abs(`il`.`quantity`) AS `qty_masuk`,0 AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'R') union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Konsinyasi' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'K');
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE VIEW `qry_kartustock_purchase` AS select `p`.`po_date` AS `tanggal`,_utf8'BELI_KONTAN' AS `tipe`,_utf8'Faktur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,`pi`.`description` AS `description`,`pi`.`quantity` AS `qty_masuk`,0 AS `qty_keluar`,`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,`p`.`comments` AS `comments` from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) where ((`p`.`potype` = _utf8'I') and (`p`.`terms` in (_utf8'',_utf8'CASH',_utf8'TUNAI',_utf8'KONTAN'))) union all select `p`.`po_date` AS `tanggal`,_utf8'RET_BELI' AS `tipe`,_utf8'Retur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,`pi`.`description` AS `description`,0 AS `qty_masuk`,abs(`pi`.`quantity`) AS `qty_keluar`,`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,`p`.`comments` AS `comments` from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) where (`p`.`potype` = _utf8'R');
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE  VIEW `qry_kartustock_receipt` AS select `pp`.`date_received` AS `tanggal`,`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(if((`pp`.`quantity_received` > 0),`pp`.`quantity_received`,0)) AS `qty_masuk`,abs(if((`pp`.`quantity_received` < 0),`pp`.`quantity_received`,0)) AS `qty_keluar`,`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,`pp`.`cost` AS `cost`,0 AS `discount`,0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,`pp`.`warehouse_code` AS `gudang`,_utf8'IDR' AS `mata_uang`,1 AS `rate`,`pp`.`supplier_number` AS `supplier`,`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,`pp`.`multi_unit` AS `multi_unit`,`pp`.`mu_price` AS `mu_price` from (`inventory_products` `pp` left join `inventory` `s` on((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` not in (_utf8'INVOICE',_utf8'RET_BELI',_utf8'ETC_OUT'));
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="
CREATE VIEW `qry_kartustock_transfer` AS select `i`.`date_trans` AS `tanggal`,_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`i`.`to_qty`) AS `qty_keluar`,0 AS `price`,0 AS `cost`,0 AS `amount_masuk`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_keluar`,`i`.`from_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`) union all select `i`.`date_trans` AS `tanggal`,_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(`i`.`to_qty`) AS `qty_masuk`,0 AS `qty_keluar`,0 AS `price`,0 AS `cost`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`);
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql="CREATE VIEW `qry_kartustock_union` AS select `i`.`tanggal` AS `tanggal`,`i`.`jenis` AS `jenis`,`i`.`no_sumber` AS `no_sumber`,`i`.`item_number` AS `item_number`,`i`.`description` AS `description`,`i`.`qty_masuk` AS `qty_masuk`,`i`.`qty_keluar` AS `qty_keluar`,`i`.`price` AS `price`,`i`.`cost` AS `cost`,if((`i`.`qty_masuk` > 0),(`i`.`cost` * `i`.`qty_masuk`),0) AS `amount_masuk`,if((`i`.`qty_masuk` > 0),0,(`i`.`cost` * `i`.`qty_keluar`)) AS `amount_keluar`,`i`.`gudang` AS `gudang`,`i`.`comments` AS `comments` from `qry_kartustock_invoice` `i` where (`i`.`item_number` is not null) union all select `r`.`tanggal` AS `tanggal`,`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,`r`.`item_number` AS `item_number`,`r`.`description` AS `description`,`r`.`qty_masuk` AS `qty_masuk`,`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,`r`.`cost` AS `cost`,if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_receipt` `r` union all select `r`.`tanggal` AS `tanggal`,`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,`r`.`item_number` AS `item_number`,`r`.`description` AS `description`,`r`.`qty_masuk` AS `qty_masuk`,`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,`r`.`cost` AS `cost`,if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_etc_out` `r` union all select `p`.`tanggal` AS `tanggal`,`p`.`jenis` AS `jenis`,`p`.`no_sumber` AS `no_sumber`,`p`.`item_number` AS `item_number`,`p`.`description` AS `description`,`p`.`qty_masuk` AS `qty_masuk`,`p`.`qty_keluar` AS `qty_keluar`,`p`.`price` AS `price`,`p`.`cost` AS `cost`,`p`.`amount_masuk` AS `amount_masuk`,`p`.`amount_keluar` AS `amount_keluar`,`p`.`gudang` AS `gudang`,`p`.`comments` AS `comments` from `qry_kartustock_purchase` `p` union all select `qry_kartustock_adj`.`tanggal` AS `tanggal`,`qry_kartustock_adj`.`jenis` AS `jenis`,`qry_kartustock_adj`.`no_sumber` AS `no_sumber`,`qry_kartustock_adj`.`item_number` AS `item_number`,`qry_kartustock_adj`.`description` AS `description`,`qry_kartustock_adj`.`qty_masuk` AS `qty_masuk`,`qry_kartustock_adj`.`qty_keluar` AS `qty_keluar`,`qry_kartustock_adj`.`price` AS `price`,`qry_kartustock_adj`.`cost` AS `cost`,`qry_kartustock_adj`.`amount_masuk` AS `amount_masuk`,`qry_kartustock_adj`.`amount_keluar` AS `amount_keluar`,`qry_kartustock_adj`.`gudang` AS `gudang`,`qry_kartustock_adj`.`comments` AS `comments` from `qry_kartustock_adj` union all select `qry_kartustock_transfer`.`tanggal` AS `tanggal`,`qry_kartustock_transfer`.`jenis` AS `jenis`,`qry_kartustock_transfer`.`no_sumber` AS `no_sumber`,`qry_kartustock_transfer`.`item_number` AS `item_number`,`qry_kartustock_transfer`.`description` AS `description`,`qry_kartustock_transfer`.`qty_masuk` AS `qty_masuk`,`qry_kartustock_transfer`.`qty_keluar` AS `qty_keluar`,`qry_kartustock_transfer`.`price` AS `price`,`qry_kartustock_transfer`.`cost` AS `cost`,`qry_kartustock_transfer`.`amount_masuk` AS `amount_masuk`,`qry_kartustock_transfer`.`amount_keluar` AS `amount_keluar`,`qry_kartustock_transfer`.`gudang` AS `gudang`,`qry_kartustock_transfer`.`comments` AS `comments` from `qry_kartustock_transfer`;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 30:
	$table="qry_kartu_piutang";
	
$sql="CREATE  VIEW qry_kartu_piutang AS
   select invoice_type as jenis, sales_order_number as ref,invoice_number as no_bukti
  ,invoice_date as tanggal,amount as jumlah,sold_to_customer as customer_number
   From invoice
  where invoice_type='I'

  Union All
  select invoice_type, your_order__,invoice_number, invoice_date,-1*abs(amount),sold_to_customer
  From invoice
  where invoice_type='R'

  Union All
  select 'P' as jenis,p.invoice_number,no_bukti, date_paid, amount_paid*-1, i.sold_to_customer
  from payments p
  left join invoice i on p.invoice_number=i.invoice_number

  Union All
  select 'C' as jenis,docnumber,kodecrdb,tanggal,-1*c.amount,i.sold_to_customer
  from crdb_memo c
  left join invoice i on i.invoice_number=c.docnumber
  where transtype='SO-CREDIT MEMO' and invoice_type='I'

  Union All
  select 'C' as jenis,docnumber,kodecrdb,tanggal,-1*c.amount,i.sold_to_customer
  from crdb_memo c
  left join invoice i on i.invoice_number=c.docnumber
  where transtype='SO-DEBIT MEMO' and invoice_type='I'
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 29:
	$table="qry_kartu_hutang";
$sql="create view qry_kartu_hutang as 

select invoice_date as tanggal,case when purchase_order<>0 then purchase_order_number
else bill_id end as no_bukti,
bill_id as ref1,invoice_number as ref2,'Hutang' as jenis,supplier_number,amount
from payables

UNION ALL
select pp.date_paid,cw.voucher,
pp.bill_id,pp.trans_id,'Bayar',p.supplier_number,-1*amount_paid
from payables_payments pp
left join payables p on p.bill_id=pp.bill_id
left join check_writer cw on cw.trans_id=pp.trans_id

UNION ALL
select po_date,purchase_order_number,po_ref,'','Retur',supplier_number,
-1*abs(saldo_invoice)
from purchase_order 
where potype='R'

UNION ALL
select c.tanggal,c.kodecrdb,c.docnumber,'','Debit Memo', p.supplier_number,
-1*abs(c.amount)
from crdb_memo c
left join purchase_order p on p.purchase_order_number=c.docnumber 
where c.transtype='PO-DEBIT MEMO'

UNION ALL
select c.tanggal,c.kodecrdb,c.docnumber,'','Debit Memo', p.supplier_number,
-1*abs(c.amount)
from crdb_memo c
left join purchase_order p on p.purchase_order_number=c.docnumber 
where c.transtype='PO-CREDIT MEMO'

";
	if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 40:
	$table="payroll";
$sql=" 
CREATE TABLE jenis_tunjangan (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	sifat varchar (50) character set utf8 NULL ,
	is_variable bit(1) default 0,
	ref_column varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 
CREATE TABLE jenis_potongan (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	sifat varchar (50) character set utf8 NULL ,
	is_variable bit(1) default 0,
	ref_column varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_type (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_group (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_status (
	status varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_level (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE divisions (
	div_code varchar (50) character set utf8 NOT NULL ,
	div_name varchar (50) character set utf8 NULL ,
	PRIMARY KEY  (div_code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

	break;

case 20:
	$table="angsuran";
$sql=" 

CREATE TABLE hr_emp_angsuran (
	id int(11) NOT NULL auto_increment,
	loan_number varchar (50) character set utf8 NOT NULL ,
	nip varchar (50) character set utf8 NOT NULL ,
	bulan int(2) NULL,
	tahun int(4) NULL,
	tanggal datetime null,
	angsuran double null,
	angsuran_bungan double null,
	bayar double null,
	bunga double,
	tanggal_bayar datetime null,
	no_bukti_bayar varchar(50) null,
	jenis_bayar int null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_emp_default_com (
	id int(11) NOT NULL auto_increment,
	nip varchar (50) character set utf8 NOT NULL ,
	def_com_code varchar (50) character set utf8 NULL ,
	def_com_value double NULL ,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_emp_level_com (
	id int(11) NOT NULL auto_increment,
	level_code varchar (50) character set utf8 NOT NULL ,
	no_urut varchar (50) character set utf8 NULL ,
	formula_string varchar (250) character set utf8 NULL ,
	take_home_pay int NULL ,
	salary_com_code varchar (50) character set utf8 NULL ,
	salary_com_name varchar (50) character set utf8 NULL ,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_emp_loan (
	loan_number varchar (50) character set utf8 NULL ,
	level_type varchar (50) character set utf8 NOT NULL ,
	date_loan datetime null ,
	loan_amount double NULL ,
	loan_balance double NULL ,
	angsuran double NULL ,
	loan_count int  NULL ,
	loan_last_to int  NULL ,
	loan_last_date datetime NULL ,
	approved_by varchar(50) null,
	pay_method int null,
	nip varchar(50) null,
	id int(11) NOT NULL auto_increment,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 
CREATE TABLE hr_pph (
	kode varchar (50) character set utf8 NULL ,
	percent_value real NULL ,
	low_value double NULL ,
	high_value double NULL ,
	PRIMARY KEY  (kode)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_pph_form (
	id int(11) NOT NULL auto_increment,
	kelompok varchar (50) character set utf8 NULL ,
	nomor varchar (50) character set utf8 NULL ,
	keterangan varchar (250) character set utf8 NULL ,
	jumlah double NULL ,
	header bit null,
	rumus varchar(250) null,
	template varchar(50) null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
	break;

case 2:
	$table="pph";
$sql=" 

CREATE TABLE employee_pph (
	id int(11) NOT NULL auto_increment,
	nip varchar (50) character set utf8 NULL ,
	nomor varchar (50) character set utf8 NULL ,
	jumlah double NULL ,
	tahun int NULL ,
	bulan int null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();
$sql=" 

CREATE TABLE hr_shift (
	kode varchar (50) character set utf8 NOT NULL ,
	time_in datetime NULL ,
	time_out datetime NULL ,
	different_day bit NULL ,
	PRIMARY KEY  (kode)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_shift (
	id int(11) NOT NULL auto_increment,
	nip varchar (50) character set utf8 NULL ,
	kode_shift varchar (50) character set utf8 NULL ,
	tanggal datetime NULL ,
	keterangan int NULL ,
	tcid varchar(50) null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_ptkp (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar(50) null,
	jumlah double NULL ,
	PRIMARY KEY  (kode)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

INSERT INTO hr_ptkp(kode,keterangan,jumlah)
values('K0','KAWIN ANAK 0',26326000),
('K1','KAWIN ANAK 1',28350000),
('K2','KAWIN ANAK 2',30375000),
('K3','KAWIN ANAK 3',32400000),
('TK','BELUM KAWIN',24300000);";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

case 41:
	$table='time_card';
	
$sql=" 

CREATE TABLE time_card_detail (
	id int(11) NOT NULL auto_increment,
	salary_no int not null,
	nip varchar(50) not null,
	absen_type int null,
	shift_code varchar(10) null,
	work_status int null,
	tanggal datetime NULL,
	time_in varchar(5) null,
	time_out varchar(5) null,
	time_hour varchar(5) null,
	ot_in varchar(5) null,
	ot_out varchar(5) null,
	ot_hour varchar(5) null,
	ot_type varchar(10) null,
	ot_exclude int null,
	ot_amount double null,
	tc_1 real null,
	tc_2 real null,
	tc_3 real null,
	tc_4 real null,
	tc_sum real null,
	tc_run real null,
	tc_exp real null,
	free_in varchar(5) null,
	free_out varchar(5) null,
	free_hour varchar(5) null,
	
	PRIMARY KEY  (id) 
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 

create view qry_payroll_component as 
select 'income' as jenis, kode,keterangan,sifat,is_variable,ref_column from jenis_tunjangan
union all
select  'deduct' as jenis,  kode,keterangan,sifat,is_variable,ref_column from jenis_potongan;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

$sql=" 


create table sys_log_run (
	id int(11) NOT NULL auto_increment,
	user_id varchar(50),
	url varchar(200),
	controller varchar(50),
	method varchar(50),
	param1 varchar(50),
	PRIMARY KEY  (id) 
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysql_query($sql))$msg="$table..OK";else $msg="$table..<br>ERROR -" . mysql_error();

}
	

ECHO $nomor. " - " .$msg;


?>
