<?php
 
$table="sysgrid";
$sql="

CREATE TABLE IF NOT EXISTS `sys_grid` (
  `selectionindex` int(11) NOT NULL auto_increment,
  `id` varchar(50) character set utf8 default NULL,
  `date_time` varchar(50) character set utf8 default NULL,
  `colstr1` varchar(250) character set utf8 default NULL,
  `colstr2` varchar(250) character set utf8 default NULL,
  `colstr3` varchar(250) character set utf8 default NULL,
  `colstr4` varchar(250) character set utf8 default NULL,
  `colstr5` varchar(250) character set utf8 default NULL,
  `colnum1` double default NULL,
  `colnum2` double default NULL,
  `colnum3` double default NULL,
  `colnum4` double default NULL,
  `colnum5` double default NULL,
  `colnum6` double default NULL,
  `colnum7` double default NULL,
  `colnum8` double default NULL,
  `colnum9` double default NULL,
  `colnum10` double default NULL,
  `colnum11` double default NULL,
  `colnum12` double default NULL,
  `colnum13` double default NULL,
  `colnum14` double default NULL,
  `colnum15` double default NULL,
  `colnum16` double default NULL,
  `colnum17` double default NULL,
  `colnum18` double default NULL,
  `colnum19` double default NULL,
  `colnum20` double default NULL,
  `coldate1` datetime default NULL,
  `coldate2` datetime default NULL,
  `coldate3` datetime default NULL,
  `coldate4` datetime default NULL,
  `coldate5` datetime default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`selectionindex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

CREATE TABLE IF NOT EXISTS `sys_objects` (
  `id` int(11) NOT NULL auto_increment,
  `obj_form` varchar(50) character set utf8 default NULL,
  `user_id` varchar(50) character set utf8 default NULL,
  `obj_name` varchar(50) character set utf8 default NULL,
  `obj_index` int(11) default NULL,
  `prop_name` varchar(50) character set utf8 default NULL,
  `prop_value` varchar(50) character set utf8 default NULL,
  `obj_child` varchar(50) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

CREATE TABLE IF NOT EXISTS `sys_tooltip` (
  `id` int(11) NOT NULL auto_increment,
  `date_created` datetime default NULL,
  `created_by` varchar(50) character set utf8 default NULL,
  `date_updated` datetime default NULL,
  `update_by` varchar(50) character set utf8 default NULL,
  `help_key` varchar(50) character set utf8 default NULL,
  `help_desc` varchar(250) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

CREATE TABLE IF NOT EXISTS `trans_type` (
  `type_id` varchar(50) character set utf8 NOT NULL,
  `type_inout` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

CREATE TABLE IF NOT EXISTS `type_of_account` (
  `type_of_account` varchar(20) character set utf8 NOT NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`type_of_account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

CREATE TABLE IF NOT EXISTS `type_of_payment` (
  `type_of_payment` varchar(50) character set utf8 NOT NULL,
  `discount_percent` double default NULL,
  `discount_days` int(11) default NULL,
  `days` int(11) default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`type_of_payment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="

INSERT INTO `type_of_payment` (`type_of_payment`, `discount_percent`, `discount_days`, `days`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
('Kredit 30 Hari', 0.12, 30, 30, 0, '', ''),
('Kredit15 hari', 0.15, 0, 15, 0, '', ''),
('60 Hari', 0, 30, 60, 0, '', ''),
('Kredi 90 Hari', 0.1, 30, 90, 0, '', '');
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
 

?>