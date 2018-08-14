<?

	$table="bill_detail";

$sql="CREATE TABLE IF NOT EXISTS `".$cid."bill_detail` (
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

if($link->query($sql))echo mysqli_error($link);	
	
	$table="bill_header";

$sql="CREATE TABLE IF NOT EXISTS `".$cid."bill_header` (
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
if($link->query($sql))echo mysqli_error($link);	
	?>