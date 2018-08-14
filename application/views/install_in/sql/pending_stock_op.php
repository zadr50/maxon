<?
$table="pending_stock_opname";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."pending_stock_opname` (
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
if($link->query($sql))echo mysqli_error($link);
$table="pending_stock_opname_tmp";
$sql="

CREATE TABLE IF NOT EXISTS `".$cid."pending_stock_opname_tmp` (
  `id` int(11) NOT NULL auto_increment,
  `barcode` varchar(50) character set utf8 default NULL,
  `qty` int(11) default NULL,
  `trans` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);	
	?>