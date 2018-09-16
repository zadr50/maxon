<?php
 
$table="supplier";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

INSERT INTO `suppliers` (`supplier_number`, `active`, `supplier_other_vendor`, `supplier_account_number`, `type_of_vendor`, `supplier_name`, `salutation`, `first_name`, `middle_initial`, `last_name`, `street`, `suite`, `city`, `state`, `zip_postal_code`, `country`, `phone`, `fax`, `email`, `payment_terms`, `credit_limit`, `fed_tax_id`, `comments`, `credit_balance`, `default_account`, `x1099`, `x1099fedwithheld`, `x1099line`, `x1099statewithheld`, `print1099`, `state_tax_id`, `plafon_hutang`, `org_id`, `update_status`, `create_date`, `create_by`, `update_date`, `update_by`, `acc_biaya`) VALUES
('ALFAMART', 1, '', '1393', '', 'ALFAMART', '', '', '', '', 'JL. RAYA PURWAKARTA NO. 38', 'Gedung Indofood lantai 20', 'Jakarta', '', '', '', '62212002992', '0299200111', 'andri@talagasoft.com', 'Kredit 30 Hari', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2014-01-05 00:00:00', '', '2014-01-05 00:00:00', '', 1452),
('KS', 1, '', '1393', '', 'Krakatau Steel, PT', '', '', '', '', 'Jl. Raya Serang Km. 200', 'Banten', 'Banten', '', '', '', '029100000', '', '', '', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2013-08-18 00:00:00', '', '2013-08-18 00:00:00', '', 0),
('INDOMART', 1, '', '1393', '', 'INDOMART', '', '', '', '', 'Purwakarta', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2013-08-14 00:00:00', '', '2013-08-14 00:00:00', '', 1423),
('YOGYA', 1, '', '1393', '', 'YOGYA Dept Store', '', '', '', '', 'Jl. Jend. Sudirman', 'Purwakarta', '', '', '', '', '', '', 'yogya@localhost', '60 Hari', 0, '', '', 0, 0, b'0', 0, 0, 0, b'0', '', 0, '', 0, '2014-03-24 00:00:00', '', '2014-03-24 00:00:00', '', 1423);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

?>