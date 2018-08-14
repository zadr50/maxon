<?
$table='inventory_beginning_balance';

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
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();


?>
