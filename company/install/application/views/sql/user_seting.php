<?php
 
$table="org_struct";

$sql="

CREATE TABLE IF NOT EXISTS `org_struct` (
  `org_id` varchar(50) character set utf8 NOT NULL,
  `org_name` varchar(50) character set utf8 default NULL,
  `address` varchar(250) character set utf8 default NULL,
  `phone` varchar(50) character set utf8 default NULL,
  `fax` varchar(50) character set utf8 default NULL,
  `contact_person` varchar(50) character set utf8 default NULL,
  `org_type` varchar(50) character set utf8 default NULL,
  `org_parent` varchar(50) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `source_id` varchar(50) character set utf8 default NULL,
  `is_head_office` bit(1) default NULL,
  PRIMARY KEY  (`org_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="user";



$sql="

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(50) character set utf8 NOT NULL,
  `username` varchar(50) character set utf8 default NULL,
  `password` varchar(50) character set utf8 default NULL,
  `path_image` varchar(255) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `disc_prc_max` double(11,0) default NULL,
  `disc_amt_max` double default NULL,
  `email` varchar(50) default NULL,
  `nip` varchar(50) default NULL,
  `userlevel` varchar(50) default NULL,
  `active` int(11) default '0',
  `cid` varchar(10) default NULL,
  `branch_code` varchar(50) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


$sql="

INSERT INTO `user` (`user_id`, `username`, `password`, `path_image`, `update_status`, `disc_prc_max`, `disc_amt_max`, `email`, `nip`, `userlevel`, `active`, `cid`) VALUES
('admin', 'admin', 'admin', '', 0, 0, 0, '', '', '', 0, 'C01'),
('Administrator', 'Administrator', 'admin', 'admin.gif', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
('andri', 'andri', '1', '', NULL, NULL, NULL, NULL, NULL, 'GUEST', 1, 'C01'),
('buyer', 'buyer', '1', '', 0, 0, 0, '', '', '', 0, 'T01'),
('Kasir', 'kasir', '1', 'kasir.gif', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
('sales', 'sales', '*sales', NULL, NULL, NULL, NULL, NULL, NULL, 'GUEST', 0, NULL),
('Spv', 'Supervisor', '1', '', NULL, NULL, NULL, NULL, NULL, 'SUPER', 0, NULL),
('usman', 'usman', '1', 'usman.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'T01'),
('ujang', 'ujang', 'ujang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'T01'),
('acong', 'acong', 'acong', '', 0, 0, 0, '', '', '', 0, 'T01');
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table.="user_group_modules";

$sql="

CREATE TABLE IF NOT EXISTS `user_group_modules` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` varchar(50) character set utf8 default NULL,
  `module_id` varchar(50) character set utf8 default NULL,
  `permission` int(11) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`group_id`,`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1655 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	
$sql="

INSERT INTO `user_group_modules` (`id`, `group_id`, `module_id`, `permission`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(1655, 'ADM', '_00000', NULL, NULL, NULL, NULL),
	(1656, 'ADM', '_00010', NULL, NULL, NULL, NULL),
	(1657, 'ADM', '_00020', NULL, NULL, NULL, NULL),
	(1658, 'ADM', '_00030', NULL, NULL, NULL, NULL),
	(1659, 'ADM', '_00040', NULL, NULL, NULL, NULL),
	(1660, 'ADM', '_00050', NULL, NULL, NULL, NULL),
	(1733, 'FIN', '_10064', NULL, NULL, NULL, NULL),
	(1732, 'FIN', '_10060', NULL, NULL, NULL, NULL),
	(1731, 'FIN', '_10030', NULL, NULL, NULL, NULL),
	(1730, 'FIN', '_10010', NULL, NULL, NULL, NULL),
	(1729, 'FIN', '_10000', NULL, NULL, NULL, NULL),
	(1666, 'PUR', '_40000', NULL, NULL, NULL, NULL),
	(1667, 'PUR', '_40010', NULL, NULL, NULL, NULL),
	(1668, 'PUR', '_40040', NULL, NULL, NULL, NULL),
	(1669, 'PUR', '_40046', NULL, NULL, NULL, NULL),
	(1670, 'PUR', '_40050', NULL, NULL, NULL, NULL),
	(1671, 'PUR', '_40060', NULL, NULL, NULL, NULL),
	(1672, 'PUR', '_40070', NULL, NULL, NULL, NULL),
	(1673, 'PUR', '_40080', NULL, NULL, NULL, NULL),
	(1674, 'PUR', '_40090', NULL, NULL, NULL, NULL),
	(1675, 'PUR', '_40100', NULL, NULL, NULL, NULL),
	(1676, 'PUR', '_40110', NULL, NULL, NULL, NULL),
	(1677, 'PUR', '_40120', NULL, NULL, NULL, NULL),
	(1678, 'SLS', '_30000', NULL, NULL, NULL, NULL),
	(1679, 'SLS', '_30000.0', NULL, NULL, NULL, NULL),
	(1680, 'SLS', '_30010', NULL, NULL, NULL, NULL),
	(1681, 'SLS', '_30020', NULL, NULL, NULL, NULL),
	(1682, 'SLS', '_30040', NULL, NULL, NULL, NULL),
	(1683, 'SLS', '_30050', NULL, NULL, NULL, NULL),
	(1684, 'SLS', '_30055', NULL, NULL, NULL, NULL),
	(1685, 'SLS', '_30060', NULL, NULL, NULL, NULL),
	(1686, 'SLS', '_30070', NULL, NULL, NULL, NULL),
	(1687, 'SLS', '_30080', NULL, NULL, NULL, NULL),
	(1688, 'SLS', '_30090', NULL, NULL, NULL, NULL),
	(1689, 'SLS', '_30100', NULL, NULL, NULL, NULL),
	(1690, 'SLS', '_30110', NULL, NULL, NULL, NULL),
	(1691, 'SLS', '_30130', NULL, NULL, NULL, NULL),
	(1692, 'SLS', '_30140', NULL, NULL, NULL, NULL),
	(1693, 'SLS', '_30150', NULL, NULL, NULL, NULL),
	(1694, 'SLS', '_30160', NULL, NULL, NULL, NULL),
	(1735, 'FIN', '_60010', NULL, NULL, NULL, NULL),
	(1734, 'FIN', '_60000', NULL, NULL, NULL, NULL),
	(1728, 'INV', '_80200', NULL, NULL, NULL, NULL),
	(1727, 'INV', '_80140', NULL, NULL, NULL, NULL),
	(1726, 'INV', '_80130', NULL, NULL, NULL, NULL),
	(1725, 'INV', '_80120', NULL, NULL, NULL, NULL),
	(1724, 'INV', '_80110', NULL, NULL, NULL, NULL),
	(1723, 'INV', '_80100', NULL, NULL, NULL, NULL),
	(1722, 'INV', '_80090', NULL, NULL, NULL, NULL),
	(1721, 'INV', '_80080', NULL, NULL, NULL, NULL),
	(1720, 'INV', '_80070', NULL, NULL, NULL, NULL),
	(1719, 'INV', '_80060', NULL, NULL, NULL, NULL),
	(1718, 'INV', '_80050', NULL, NULL, NULL, NULL),
	(1717, 'INV', '_80040', NULL, NULL, NULL, NULL),
	(1716, 'INV', '_80030', NULL, NULL, NULL, NULL),
	(1715, 'INV', '_80020', NULL, NULL, NULL, NULL),
	(1714, 'INV', '_80010', NULL, NULL, NULL, NULL),
	(1713, 'INV', '_80000', NULL, NULL, NULL, NULL),
	(1736, 'FIN', '_60020', NULL, NULL, NULL, NULL),
	(1737, 'FIN', '_60030', NULL, NULL, NULL, NULL),
	(1738, 'FIN', '_60040', NULL, NULL, NULL, NULL),
	(1739, 'FIN', '_60050', NULL, NULL, NULL, NULL),
	(1740, 'FIN', '_60060', NULL, NULL, NULL, NULL),
	(1741, 'FIN', '_60070', NULL, NULL, NULL, NULL),
	(1742, 'FIN', '_60080', NULL, NULL, NULL, NULL);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
$table="user_jobs";

$sql="

CREATE TABLE IF NOT EXISTS `user_job` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` varchar(50) character set utf8 default NULL,
  `group_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`user_id`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="branch";
$sql="
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `address_type` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `attention_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`branch_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="
REPLACE INTO `branch` (`branch_code`, `branch_name`, `address_type`, `attention_name`, `company_name`, `street`, `suite`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `other_phone`, `comments`, `update_status`) 
VALUES
	('KRW', 'KARAWANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CWG', 'CAWANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PST', 'PUSAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	

$sql="

INSERT INTO `user_job` (`id`, `user_id`, `group_id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(10, 'Spv', 'ADM', NULL, NULL, NULL),
	(11, 'Spv', 'BYR', NULL, NULL, NULL),
	(16, 'Kasir', 'INV', NULL, NULL, NULL),
	(17, 'Kasir', 'PUR', NULL, NULL, NULL),
	(18, 'Kasir', 'BYR', NULL, NULL, NULL),
	(19, 'usman', 'PUR', NULL, NULL, NULL),
	(20, 'usman', 'FIN', NULL, NULL, NULL),
	(45, 'Administrator', 'ADM', NULL, NULL, NULL),
	(115, 'andri', 'SYSMENU', NULL, NULL, NULL),
	(202, 'admin', 'Administrator', NULL, NULL, NULL),
	(50, 'sales', 'Administrator', NULL, NULL, NULL),
	(57, 'Spv', 'FIN', NULL, NULL, NULL),
	(59, 'sales', 'FIN', NULL, NULL, NULL),
	(60, 'Kasir', 'FIN', NULL, NULL, NULL),
	(61, 'Administrator', 'ANDRI', NULL, NULL, NULL),
	(200, 'bbb', 'DRV', NULL, NULL, NULL),
	(199, 'bbb', 'COL', NULL, NULL, NULL),
	(68, 'buyer', 'BYR', NULL, NULL, NULL),
	(111, 'andri', 'Gudang', NULL, NULL, NULL),
	(112, 'andri', 'INV', NULL, NULL, NULL),
	(113, 'andri', 'KSR', NULL, NULL, NULL),
	(114, 'andri', 'SPV', NULL, NULL, NULL),
	(116, 'andri', 'test', NULL, NULL, NULL),
	(201, 'admin', 'ADM', NULL, NULL, NULL),
	(203, 'admin', 'FIN', NULL, NULL, NULL),
	(204, 'admin', 'PUR', NULL, NULL, NULL),
	(205, 'admin', 'SLS', NULL, NULL, NULL),
	(206, 'admin', 'INV', NULL, NULL, NULL);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

?>