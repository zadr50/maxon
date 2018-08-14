<?

$sql="

CREATE TABLE IF NOT EXISTS `shipping_locations` (
  `location_number` varchar(15) character set utf8 NOT NULL,
  `address_type` varchar(15) character set utf8 default NULL,
  `attention_name` varchar(50) character set utf8 default NULL,
  `company_name` varchar(50) character set utf8 default NULL,
  `street` varchar(250) character set utf8 default NULL,
  `suite` varchar(250) character set utf8 default NULL,
  `city` varchar(50) character set utf8 default NULL,
  `state` varchar(50) character set utf8 default NULL,
  `zip` varchar(50) character set utf8 default NULL,
  `country` varchar(50) character set utf8 default NULL,
  `phone` varchar(50) character set utf8 default NULL,
  `fax` varchar(20) character set utf8 default NULL,
  `other_phone` varchar(20) character set utf8 default NULL,
  `comments` double default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`location_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if($link->query($sql))$msg .="<br>- shipping_locations..OK";else $msg .="<br>- shipping_locations..<br>ERROR -" . mysql_error();

$sql="

INSERT INTO `shipping_locations` (`location_number`, `address_type`, `attention_name`, `company_name`, `street`, `suite`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `other_phone`, `comments`, `update_status`) VALUES
('Jakarta', 'Gudang', NULL, NULL, 'Jl. Raya Sadang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Jogja', 'Penyimpanan', '', '', 'JL. GARUDA KEMAYORAN', '', '', '', '', '', '', '', '', 0, 0),
('Bekasi', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Medan', 'Penyimpanan', '', '', 'Jl. Sunter 80', '', '', '', '', '', '', '', '', 0, 0),
('Purwakarta', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Surabaya', 'Penyimpanan', '', '', 'Jl. Raya pejaten timur no. 28', '', '', '', '', '', '', '', '', 0, 0),
('Ambon', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Bali', 'Penyimpanan', 'Husni', NULL, 'Jl. Raya Sabrang', NULL, 'Bali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
";
if($link->query($sql))$msg .="</br>- shipping_locations..OK";else $msg .="</br>- shipping_locations..<br>ERROR -" . mysql_error();


?>