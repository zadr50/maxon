<?

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."salesman` (
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
if($link->query($sql))echo mysqli_error($link);
$sql="

CREATE TABLE IF NOT EXISTS `".$cid."salesman_group` (
  `groupid` varchar(20) character set utf8 NOT NULL,
  `salesman` varchar(50) character set utf8 default NULL,
  `komisiprc` double(11,0) default NULL,
  `remarks` varchar(100) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))echo mysqli_error($link);
$sql="

CREATE TABLE IF NOT EXISTS `".$cid."salesman_group_komisi` (
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
if($link->query($sql))echo mysqli_error($link);
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
if($link->query($sql))echo mysqli_error($link);	
	?>