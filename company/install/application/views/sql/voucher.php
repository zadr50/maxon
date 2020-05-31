<?php
$msg="";
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="
CREATE TABLE IF NOT EXISTS `wilayah` (
  `wilayah` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `kode` varchar(50) character set utf8 NOT NULL,
  `ongkos_kirim` double default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="yescalendaricons";
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="yes_smartsearchdefinition";
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
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	
?>