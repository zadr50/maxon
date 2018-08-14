<?

	$table="gl_projects";

$sql="

CREATE TABLE IF NOT EXISTS `gl_projects` (
  `kode` varchar(255) character set utf8 default NULL,
  `keterangan` varchar(255) character set utf8 default NULL,
  `client` varchar(255) character set utf8 default NULL,
  `tgl_mulai` datetime default NULL,
  `tgl_selesai` datetime default NULL,
  `budget_amount` double default NULL,
  `project_amount` double default NULL,
  `lokasi` varchar(255) character set utf8 default NULL,
  `person_in_charge` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  `date_created` datetime default NULL,
  `last_update` datetime default NULL,
  `updated_by` varchar(255) character set utf8 default NULL,
  `status_project` varchar(255) character set utf8 default NULL,
  `category_project` varchar(255) character set utf8 default NULL,
  `sales` double default NULL,
  `cost` double default NULL,
  `expense` double default NULL,
  `labarugi` double default NULL,
  `finish_prc` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `invoice_number` double default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();

	$table="gl_projects_budget";


$sql="

CREATE TABLE IF NOT EXISTS `gl_projects_budget` (
  `id` int(11) NOT NULL auto_increment,
  `project_code` varchar(50) character set utf8 default NULL,
  `tahun` int(11) default NULL,
  `account_id` int(11) default NULL,
  `bulan_1` double default NULL,
  `bulan_2` double default NULL,
  `bulan_3` double default NULL,
  `bulan_4` double default NULL,
  `bulan_5` double default NULL,
  `bulan_6` double default NULL,
  `bulan_7` double default NULL,
  `bulan_8` double default NULL,
  `bulan_9` double default NULL,
  `bulan_10` double default NULL,
  `bulan_11` double default NULL,
  `bulan_12` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

	$table="gl_projects_saldo";


$sql="

CREATE TABLE IF NOT EXISTS `gl_projects_saldo` (
  `id` int(11) NOT NULL auto_increment,
  `project_code` varchar(50) character set utf8 default NULL,
  `start_date` datetime default NULL,
  `account_id` int(11) default NULL,
  `amount` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();

	$table="gl_report_groups";


$sql="
CREATE TABLE IF NOT EXISTS `gl_report_groups` (
  `id` int(11) NOT NULL auto_increment,
  `company_code` varchar(50) character set utf8 default NULL,
  `account_type` double default NULL,
  `group_type` varchar(10) character set utf8 default NULL,
  `group_name` varchar(50) character set utf8 default NULL,
  `parent_group_type` varchar(10) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `create_date` datetime default NULL,
  `create_by` varchar(50) character set utf8 default NULL,
  `update_date` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`group_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=271 ;
";
	if($link->query($sql))$msg .="</br>$table..OK";else $msg .="</br>$table..<br>ERROR -" . mysql_error();
	

?>