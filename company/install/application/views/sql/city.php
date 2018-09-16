<?php

$table="city";

$sql="

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` varchar(50) character set utf8 NOT NULL default '',
  `city_name` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="crdb_memo";
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="crdb_memo_dtl";
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="credit_card_type";
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


$sql="

INSERT INTO `credit_card_type` (`id`, `card_type`, `update_status`, `sourceautonumber`, `sourcefile`, `card_name`, `to_date`, `from_date`, `disc_percent`) VALUES
(1, 'Citibank', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Mandiri Visa', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Mandiri Master', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Amex', NULL, NULL, NULL, 'Amex Card', '2010-02-11 00:00:00', '2009-07-24 00:00:00', 10);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="currencies";
$sql="

CREATE TABLE IF NOT EXISTS `currencies` (
  `currency_code` varchar(50) character set utf8 NOT NULL,
  `description` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`currency_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

INSERT INTO `currencies` (`currency_code`, `description`, `update_status`) VALUES
('IDR', 'Rupiah', NULL),
('USD', 'Dollar', NULL);
";

if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
?>