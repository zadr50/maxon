<?php

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="customers_other_info";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
 

$table="customer_beginning_balance";

$sql="

CREATE TABLE IF NOT EXISTS `customer_beginning_balance` (
  `tanggal` datetime NOT NULL default '2000-01-01 00:00:00',
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="customer_shipto";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


$table="customer_statement_defaults";
 
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	
?>