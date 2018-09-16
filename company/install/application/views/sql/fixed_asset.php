<?php

	$table="fa_asset";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


	$table="fa_asset_depreciation";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="fa_asset_depreciation_schedule";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


	$table="fa_asset_group";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="fa_asset_service_log";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


	$table="fa_asset_transaction";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


	$table="fa_cards";
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="fa_setting";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="fb_room";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

INSERT INTO `fb_room` (`room_code`, `room_name`, `regular_hour`, `happy_hour`, `status`, `nota`, `dept`, `RType`, `capacity`, `desciption`, `update_status`) VALUES
('Meja 1', 'Meja 1', 0, 0, 1, '', '', '', '', '', NULL),
('Meja 2', 'Meja 2', 0, 0, 1, '', '', '', '', '', NULL),
('Meja 3', 'Meja 3', 0, 0, 1, '', '', '', '', '', NULL);

";

if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	
	?>