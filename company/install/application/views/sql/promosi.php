<?php
 
$table="promosi_disc";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="promosi_extra_item";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="promosi_item";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="promosi_item_category";

$sql="

CREATE TABLE IF NOT EXISTS `promosi_item_category` (
  `id` int(11) NOT NULL auto_increment,
  `promosi_code` varchar(50) character set utf8 default NULL,
  `kode_category` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="promosi_item_customer";

$sql="

CREATE TABLE IF NOT EXISTS `promosi_item_customer` (
  `id` int(11) NOT NULL auto_increment,
  `promosi_code` varchar(50) character set utf8 default NULL,
  `cust_code` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="promosi_outlet";

$sql="

CREATE TABLE IF NOT EXISTS `promosi_outlet` (
  `outlet` varchar(50) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="promosi_point_transactions";

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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="promosi_time";

$sql="

CREATE TABLE IF NOT EXISTS `promosi_time` (
  `time_value` varchar(50) character set utf8 default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
?>